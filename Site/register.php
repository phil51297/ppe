<?php include('functions.php') ?> 
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
                              <li class="active"> <a href="index.php">Accueil</a> </li>
                              <li> <a href="index.php#download">Photos</a> </li>
                              <li> <a href="index.php#testimonial">Contactez-nous</a> </li>
                              <li> <a href="index.php">Retour</a> </li>
                           </ul>
                        </nav>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <!-- end header inner --> 
      </header>
    </html>

<!DOCTYPE html>
<html>
<head>
  <title>Inscription</title>
  <link rel="stylesheet" href="css/login.css">
</head>
<body>
<div class="header_e">
  <h2>S'inscrire</h2>
</div>
<form method="post" action="register.php">
  <?php echo display_error(); ?>
  <div class="input-group_e">
    <label>Nom d'utilisateur</label>
    <input type="text" name="username" value="<?php echo $username; ?>">
  </div>
  <div class="input-group_e">
    <label>Nom</label>
    <input type="text" name="nom" value="<?php echo $nom; ?>">
  </div>
  <div class="input-group_e">
    <label>Prénom</label>
    <input type="text" name="prenom" value="<?php echo $prenom; ?>">
  </div>
  <div class="input-group_e">
    <label>Date de naissance</label>
    <input type="date" name="date_naissance" value="<?php echo $date_naissance; ?>">
  </div>
  <div class="input-group_e">
    <label>Telephone</label>
    <input type="tel" name="tel" value="<?php echo $tel; ?>">
  </div>
  <div class="input-group_e">
    <label>Adresse</label>
    <input type="text" name="adresse" value="<?php echo $adresse; ?>">
  </div>
  <div class="input-group_e">
    <label>Email</label>
    <input type="email" name="email" value="<?php echo $email; ?>">
  </div>
  <div class="input-group_e">
    <label>Mot de passe</label>
    <input type="password" name="password_1">
  </div>
  <div class="input-group_e">
    <label>Confirmer Mot de passe</label>
    <input type="password" name="password_2">
  </div>
  <div class="input-group_e">
    <button type="submit" class="btn" name="register_btn">S'inscrire</button>
  </div>
  <p>
    Vous avez déja un compte? <a href="login.php">Connectez-vous ici</a>
  </p>
</form>
</body>
</html>
