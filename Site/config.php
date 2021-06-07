<?php
// Informations d'identification
define('DB_HOST', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'zoo');
 
// Connexion à la base de données MySQL 
$conn = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
// Vérifier la connexion
if($conn === false){
    die("ERREUR : Impossible de se connecter. " . mysqli_connect_error());
}
?>
<?php  
// PayPal configuration  
define('PAYPAL_ID', 'info@codexworld.com'); 
define('PAYPAL_SANDBOX', TRUE); //TRUE or FALSE  
 
define('CONTINUE_SHOPPING_URL', 'http://localhost/site/welcome.php');  
define('PAYPAL_RETURN_URL', 'http://localhost/site/success.php');  
define('PAYPAL_CANCEL_URL', 'http://localhost/site/cancel.php');  
define('PAYPAL_NOTIFY_URL', 'http://localhost/site/paypal_ipn.php');  
define('PAYPAL_CURRENCY', 'EUR');  
    
// Change not required  
define('PAYPAL_URL', (PAYPAL_SANDBOX == true)?"https://www.sandbox.paypal.com/cgi-bin/webscr":"https://www.paypal.com/cgi-bin/webscr");
?>