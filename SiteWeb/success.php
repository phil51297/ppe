<?php 
// Include configuration file  
include_once 'config.php';  
  
// Include database connection file  
include_once 'dbConnect.php';  
 
$paymentData = ''; 
if(!empty($_GET['tx']) && !empty($_GET['amt']) && $_GET['st'] == 'Completed'){ 
    // Get transaction information from URL  
    $txn_id = $_GET['tx'];  
    $payment_gross = $_GET['amt'];  
    $currency_code = $_GET['cc'];  
    $payment_status = $_GET['st']; 
     
    // Check if transaction data exists with the same TXN ID.  
    $prevPaymentResult = $db->query("SELECT * FROM payments WHERE txn_id = '".$txn_id."'");  
     
    if($prevPaymentResult->num_rows > 0){ 
        // Get subscription info from database 
        $paymentData = $prevPaymentResult->fetch_assoc(); 
         
        // Order details 
        $orderResult = $db->query("SELECT * FROM orders WHERE id = ".$paymentData['order_id']); 
        $orderData = $orderResult->fetch_assoc(); 
         
        // Order items 
        $orderItemsResult = $db->query("SELECT i.*,pr.name FROM payments as p LEFT JOIN order_items as i ON i.order_id=p.order_id LEFT JOIN products as pr ON pr.id = i.product_id WHERE p.id = ".$paymentData['id']); 
    } 
} 
?>

<div class="status">
<?php if(!empty($paymentData)){ ?>
    <h1 class="success">Your Payment has been Successful!</h1>
	
    <h4>Order Information</h4>
    <p><b>Order ID:</b> <?php echo $orderData['id']; ?></p>
    <p><b>Total Items:</b> <?php echo $orderData['total_qty']; ?></p>
    <p><b>Order Total:</b> <?php echo $orderData['total_amount']; ?></p>
	
    <h4>Payment Information</h4>
    <p><b>Reference Number:</b> <?php echo $paymentData['id']; ?></p>
    <p><b>Transaction ID:</b> <?php echo $paymentData['txn_id']; ?></p>
    <p><b>Paid Amount:</b> <?php echo $paymentData['payment_gross'].' '.$paymentData['currency_code']; ?></p>
    <p><b>Payment Status:</b> <?php echo $paymentData['payment_status']; ?></p>
	
    <h4>Order Items</h4>
    <?php if($orderItemsResult->num_rows > 0){ ?>
        <table>
            <tr>
                <th>#</th>
                <th>Product Name</th>
                <th>Quantity</th> 
                <th>Gross Amount</th>
            </tr>
        <?php $i=0; while($item = $orderItemsResult->fetch_assoc()){ $i++; ?>
            <tr>
                <td align="center"><?php echo $i; ?></td>
                <td align="center"><?php echo $item['name']; ?></td>
                <td align="center"><?php echo $item['quantity']; ?></td> 
                <td align="center"><?php echo '$'.$item['gross_amount']; ?></td>
            </tr>
        <?php } ?>
        </table>
    <?php } ?>
<?php }else{ ?>
    <h1 class="error">Your payment was unsuccessful, please try again.</h1>
<?php } ?>
</div>