<?php
    require_once ("controleur/controleur.class.php");
    // Include configuration file  
    include_once 'config.php';  
  
    // Include database connection file  
    include_once 'dbConnect.php'; 

    include('functions.php');
    if (!isLoggedIn()) {
    $_SESSION['msg'] = "Vous devez vous connecter";
    header('location: login.php');
}
?>
<!DOCTYPE html>
<html>
   <head>
      <!-- basic -->
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <!-- mobile metas -->
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="viewport" content="initial-scale=1, maximum-scale=1">
      <!-- site metas -->
      <title>Zoo d'Orleans</title>
      <meta name="keywords" content="">
      <meta name="description" content="">
      <meta name="author" content="">
      <!-- bootstrap css -->
      <link rel="stylesheet" href="css/bootstrap.min.css">
      <!-- style css -->
      <link rel="stylesheet" href="css/style.css">
      <!-- Responsive-->
      <link rel="stylesheet" href="css/responsive.css">
      <!-- fevicon -->
      <link rel="icon" href="images/fevicon.png" type="image/gif" />
      <!-- Scrollbar Custom CSS -->
      <link rel="stylesheet" href="css/jquery.mCustomScrollbar.min.css">
      <!-- Tweaks for older IEs-->
      <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">
      <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
   </head>
<body>
        <header>
         <!-- header inner -->
         <div class="header">
         <div class="container">
            <div class="row">
               <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col logo_section">
                  <div class="full">
                     <div class="center-desk">
                        <div class="logo"> <a href="index.php">Zoo</a> </div>
                     </div>
                  </div>
               </div>
               <div class="col-xl-9 col-lg-9 col-md-9 col-sm-9">
                  <div class="menu-area">
                     <div class="limit-box">
                        <nav class="main-menu">
                           <ul class="menu-area-main">
                              <li class="active"> <a href="welcome.php">Produits</a> </li>
                              <li> <a href="animal.php">Animaux</a> </li>
                              <li> <a href="evenement.php">Evenement</a> </li>
                              <li> <a href="logout.php">Deconnexion</a> </li>
                           </ul>
                        </nav>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <!-- end header inner --> 
      </header>
    </body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <style type="text/css">
        body{ font: 14px sans-serif; text-align: center; }
    </style>
    <link rel="stylesheet" type="text/css" href="css/login.css">
</head>
<body>
<header>
<div class="header_e">
    <h2>Utilisateur</h2>
  </div>
  <div class="content_e">
    <!-- notification message -->
    <?php if (isset($_SESSION['success'])) : ?>
      <div class="error_e success_e" >
        <h3>
          <?php 
            echo $_SESSION['success']; 
            unset($_SESSION['success']);
          ?>
        </h3>
      </div>
    <?php endif ?>
    <!-- logged in user information -->
    <div class="profile_info_e">
      <img src="images/user_profile.png"  >

      <div>
        <?php  if (isset($_SESSION['user'])) : ?>
          <strong><?php echo $_SESSION['user']['username']; ?></strong>

          <small>
            <i  style="color: #888;">(<?php echo ucfirst($_SESSION['user']['user_type']); ?>)</i> 
            <br>
            <a href="welcome.php?logout='1'" style="color: red;">Déconnexion</a>
          </small>
        <?php endif ?>
      </div>
    </div>
  </div>
  </header>
    <center>
    <h2> Liste des produits </h2>
    </center>
    <div class="container">
    <?php 
        // Fetch products from the database 
        $results = $db->query("SELECT * FROM products"); 
        while($row = $results->fetch_assoc()){ 
    ?>
    <div class="pro-box">
        <img src="images/<?php echo $row['image']; ?>" width="250" height="250"/>
        <p><?php echo $row['name']; ?></p>
        <p>Prix: <?php echo $row['price'];?>€</p>
        <form target="_self" action="<?php echo PAYPAL_URL; ?>" method="post">
            <!-- Identify your business so that you can collect the payments. -->
            <input type="hidden" name="business" value="<?php echo PAYPAL_ID; ?>">
      
            <!-- Specify a PayPal Shopping Cart Add to Cart button. -->
            <input type="hidden" name="cmd" value="_cart">
            <input type="hidden" name="add" value="1">
      
            <!-- Specify details about the item that buyers will purchase. -->
            <input type="hidden" name="item_name" value="<?php echo $row['name']; ?>">
            <input type="hidden" name="item_number" value="<?php echo $row['id']; ?>">
            <input type="hidden" name="amount" value="<?php echo $row['price']; ?>">
            <input type="hidden" name="currency_code" value="<?php echo PAYPAL_CURRENCY; ?>">
      
            <!-- Specify URLs -->
            <input type="hidden" name="shopping_url" value="<?php echo CONTINUE_SHOPPING_URL; ?>">
            <input type="hidden" name="cancel_return" value="<?php echo PAYPAL_CANCEL_URL; ?>">
            <input type="hidden" name="return" value="<?php echo PAYPAL_RETURN_URL; ?>">
            <input type="hidden" name="notify_url" value="<?php echo PAYPAL_NOTIFY_URL; ?>">
      
            <!-- Display the payment button. -->
            <input type="image" name="submit" src="https://www.paypalobjects.com/webstatic/en_US/i/btn/png/btn_addtocart_120x26.png" alt="Ajouter au panier">
            <img alt="" width="1" height="1" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif">
        </form>
    </div>
    <?php } ?>
    </div>
    <p>
        <a href="logout.php" class="btn btn-danger">Deconnectez vous de votre compte. </a>
    </p>
</body>
</html>