<?php 
// Include configuration file 
include_once 'config.php'; 
 
// Include database connection file 
include_once 'dbConnect.php'; 
 
/* 
 * Read POST data 
 * reading posted data directly from $_POST causes serialization 
 * issues with array data in POST. 
 * Reading raw POST data from input stream instead. 
 */         
$raw_post_data = file_get_contents('php://input'); 
$raw_post_array = explode('&', $raw_post_data); 
$myPost = array(); 
foreach ($raw_post_array as $keyval) { 
    $keyval = explode ('=', $keyval); 
    if (count($keyval) == 2) 
        $myPost[$keyval[0]] = urldecode($keyval[1]); 
} 
 
// Read the post from PayPal system and add 'cmd' 
$req = 'cmd=_notify-validate'; 
if(function_exists('get_magic_quotes_gpc')) { 
    $get_magic_quotes_exists = true; 
} 
foreach ($myPost as $key => $value) { 
    if($get_magic_quotes_exists == true && get_magic_quotes_gpc() == 1) { 
        $value = urlencode(stripslashes($value)); 
    } else { 
        $value = urlencode($value); 
    } 
    $req .= "&$key=$value"; 
} 
 
/* 
 * Post IPN data back to PayPal to validate the IPN data is genuine 
 * Without this step anyone can fake IPN data 
 */ 
$paypalURL = PAYPAL_URL; 
$ch = curl_init($paypalURL); 
if ($ch == FALSE) { 
    return FALSE; 
} 
curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1); 
curl_setopt($ch, CURLOPT_POST, 1); 
curl_setopt($ch, CURLOPT_RETURNTRANSFER,1); 
curl_setopt($ch, CURLOPT_POSTFIELDS, $req); 
curl_setopt($ch, CURLOPT_SSLVERSION, 6); 
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1); 
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2); 
curl_setopt($ch, CURLOPT_FORBID_REUSE, 1); 
 
// Set TCP timeout to 30 seconds 
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30); 
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Connection: Close', 'User-Agent: company-name')); 
$res = curl_exec($ch); 
 
/* 
 * Inspect IPN validation result and act accordingly 
 * Split response headers and payload, a better way for strcmp 
 */  
$tokens = explode("\r\n\r\n", trim($res)); 
$res = trim(end($tokens)); 
if (strcmp($res, "VERIFIED") == 0 || strcasecmp($res, "VERIFIED") == 0) { 
     
    // Retrieve transaction data from PayPal 
    $paypalInfo = $_POST; 
 
    $txn_id = !empty($paypalInfo['txn_id'])?$paypalInfo['txn_id']:''; 
    $payment_gross =  !empty($paypalInfo['mc_gross'])?$paypalInfo['mc_gross']:0; 
    $currency_code = $paypalInfo['mc_currency']; 
    $payment_status = !empty($paypalInfo['payment_status'])?$paypalInfo['payment_status']:''; 
    $payerFirstName = !empty($_POST['first_name'])?$_POST['first_name']:''; 
    $payer_name = !empty($_POST['last_name'])?$payerFirstName.' '.$_POST['last_name']:$payerFirstName; 
    $payer_name = filter_var($payer_name,FILTER_SANITIZE_STRING,FILTER_FLAG_STRIP_HIGH); 
    $payer_email = $paypalInfo['payer_email']; 
     
    $num_cart_items = $_POST['num_cart_items']; 
     
    if(!empty($txn_id)){ 
        // Check if transaction data exists with the same TXN ID 
        $prevPayment = $db->query("SELECT id FROM payments WHERE txn_id = '".$txn_id."'"); 
         
        if($prevPayment->num_rows > 0){ 
            exit(); 
        }else{ 
            // Insert order data into the database 
            $insertOrder = $db->query("INSERT INTO orders(total_qty,total_amount) VALUES($num_cart_items,'".$payment_gross."')"); 
             
            if($insertOrder){ 
                $order_id = $db->insert_id; 
                 
                // Insert tansaction data into the database 
                $insertPayment = $db->query("INSERT INTO payments(order_id,payer_name,payer_email,txn_id,payment_gross,currency_code,payment_status) VALUES($order_id,'".$payer_name."','".$payer_email."','".$txn_id."','".$payment_gross."','".$currency_code."','".$payment_status."')"); 
                 
                if($insertPayment){ 
                    $payment_id = $db->insert_id; 
                     
                    // Insert order items into the database 
                    for($i=1;$i<=$num_cart_items;$i++){ 
                        $order_item_number = $_POST['item_number'.$i]; 
                        $order_item_quantity = $_POST['quantity'.$i]; 
                        $order_item_gross_amount = $_POST['mc_gross_'.$i]; 
                        $insertOrderItem = $db->query("INSERT INTO order_items(order_id,product_id,quantity,gross_amount) VALUES('".$order_id."','".$order_item_number."','".$order_item_quantity."','".$order_item_gross_amount."')"); 
                    } 
                } 
            } 
        } 
    } 
} 
die;