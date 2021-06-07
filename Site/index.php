<?php
   require_once ("controleur/controleur.class.php");
   require_once("config.php"); 
   include('functions.php');
?>
<html lang="en">
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
   <!-- body -->
   <body class="main-layout">
      <!-- loader  -->
      <div class="loader_bg">
         <div class="loader"><img src="images/loading.gif" alt="#" /></div>
      </div>
      <!-- end loader --> 
      <!-- header -->
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
                              <li> <a href="#download">Photos</a> </li>
                              <li> <a href="#testimonial">Contactez-nous</a> </li>
                              <li> <a href="login.php">Connexion</a> </li>
                           </ul>
                        </nav>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <!-- end header inner --> 
      </header>
      <!-- end header -->
      <section class="slider_section">
         <div id="myCarousel" class="carousel slide banner-main" data-ride="carousel">
            <div class="carousel-inner">
               <div class="carousel-item active">
                  <img class="first-slide" src="images/banner2.jpg" alt="First slide">
                  <div class="container">
                     <div class="carousel-caption relative">
                        <h1>Bienvenue</h1>
                        <p>Classé parmi les plus beaux zoos de France, le Zoo d'Orleans présente plus de 800 espèces animaux sur 40 hectares de parc. Des espèces uniques en France : pandas géants, koalas, diables de Tasmanie... ! Venez passer un moment exceptionnel entre amis ou en famille dans notre parc animalier.</p>
                        <a  href="#">En savoir plus</a>
                     </div>
                  </div>
               </div>
               <div class="carousel-item">
                  <img class="second-slide" src="images/banner3.jpg" alt="Second slide">
                  <div class="container">
                     <div class="carousel-caption relative">
                        <h1>Chose a faire</h1>
                        <p>Envie d'un hébergement au top pour explorer les alentours d'Orleans, de bonnes adresses pour découvrir les trésors gastronomiques de la vallée ou encore des découvertes et visites insolites à ne pas manquer ? Vous êtes au bon endroit pour commencer votre aventure autour du célèbre zoo d'Orleans!</p>
                        <a  href="#">En savoir plus</a>
                     </div>
                  </div>
               </div>
               <div class="carousel-item">
                  <img class="third-slide" src="images/banner4.jpg" alt="Third slide">
                  <div class="container">
                     <div class="carousel-caption relative">
                        <h1>Nouveaux animaux</h1>
                        <p>L’arrivée d’un groupe de langurs de Douc à Beauval est un grand événement ! Déjà pour le plaisir des yeux. Ces primates figurent parmi les plus beaux de l’espèce : pattes rousses, pelage noir ou gris, face orange, paupières bleues, queue blanche…</p>
                        <a  href="#">En savoir plus</a>
                     </div>
                  </div>
               </div>
            </div>
            <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
            <i class='fa fa-angle-left'></i>
            </a>
            <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
            <i class='fa fa-angle-right'></i>
            </a>
         </div>
      </section>
      <!-- about  -->
      <!-- end abouts -->
      <!-- service --> 
      <!-- end service -->
      <!-- Download -->
      <div id="download" class="download">
         <div class="container">
            <div class="row">
               <div class="col-md-12">
                  <div class="titlepage">
                     <h2>Photos</h2>
                  </div>
               </div>
            </div>
            <div class="row"  style="height: 500px;">
               <div class="col-md-12">
                  <div id="main_slider" class="carousel slide banner-main" data-ride="carousel">
                     <div class="carousel-inner">
                        <div class="carousel-item active"> <img class="first-slide" src="images/banner.jpg" alt="First slide"> </div>
                        <div class="carousel-item"> <img class="second-slide" src="images/zoo.jpg" alt="Second slide"> </div>
                        <div class="carousel-item"> <img class="third-slide" src="images/zoo1.jpg" alt="Third slide"> </div>
                     </div>
                     <a class="carousel-control-prev" href="#main_slider" role="button" data-slide="prev"> <i class='fa fa-angle-left'></i></a> <a class="carousel-control-next" href="#main_slider" role="button" data-slide="next"> <i class='fa fa-angle-right'></i></a> 
                  </div>
                  <div class="read-more">
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- end Download -->
      <!-- Testimonial -->
      <div id="testimonial" class="testimonial">
         <div class="container">
            <div class="row">
               <div class="col-md-12">
               </div>
            </div>
               <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                  <div class="contact">
                     <h3>Contactez-nous</h3>
                     <form>
                        <div class="row">
                           <div class="col-sm-12">
                              <input class="contactus" placeholder="Nom" type="text" name="nomcontact" value="<?php echo $nomcontact; ?>">
                           </div>
                           <div class="col-sm-12">
                              <input class="contactus" placeholder="Telephone" type="text" name="tel" value="<?php echo $tel; ?>">
                           </div>
                           <div class="col-sm-12">
                              <input class="contactus" placeholder="Email" type="text" name="email" value="<?php echo $email; ?>">
                           </div>
                           <div class="col-sm-12">
                              <textarea class="textarea" placeholder="Message" type="text" name="message" value="<?php echo $message; ?>"></textarea>
                           </div>
                           <div class="col-sm-12">
                              <button class="send" name="add_btn_contact">Envoyer</button>
                           </div>
                        </div>
                     </form>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- end Testimonial --> 
      <!--  footer --> 
      <footr>
         <div class="footer">
            <div class="container">
               <div class="row">
                  <div class="col-lg-2 col-md-6 col-sm-12 width">
                     <div class="address">
                        <h3>Addresse</h3>
                        <i><img src="icon/3.png">Locations</i>
                     </div>
                  </div>
                  <div class="col-lg-2 col-md-6 col-sm-12 width">
                     <div class="address">
                        <h3>Menus</h3>
                        <i><img src="icon/2.png">Locations</i>
                     </div>
                  </div>
                  <div class="col-lg-2 col-md-6 col-sm-12 width">
                     <div class="address">
                        <h3>Réseaux sociaux</h3>
                        <ul class="contant_icon">
                           <li><img src="icon/fb.png" alt="icon"/></li>
                           <li><img src="icon/tw.png" alt="icon"/></li>
                           <li><img src="icon/lin (2).png" alt="icon"/></li>
                           <li><img src="icon/instagram.png" alt="icon"/></li>
                        </ul>
                     </div>
                  </div>
                  <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 width">
                     <div class="address">
                        <h3>Newsletter </h3>
                        <input class="form-control" placeholder="Entrer votre adresse mail" type="type" name="Enter your email">
                        <button class="submit-btn">Abonnez-vous</button>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </footr>
      <!-- end footer -->
      <!-- Javascript files--> 
      <script src="js/jquery.min.js"></script> 
      <script src="js/popper.min.js"></script> 
      <script src="js/bootstrap.bundle.min.js"></script> 
      <script src="js/jquery-3.0.0.min.js"></script> 
      <script src="js/plugin.js"></script> 
      <!-- sidebar --> 
      <script src="js/jquery.mCustomScrollbar.concat.min.js"></script> 
      <script src="js/custom.js"></script>
      <script src="https:cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>
      <script>
         $(document).ready(function(){
         $(".fancybox").fancybox({
         openEffect: "none",
         closeEffect: "none"
         });
         
         $(".zoom").hover(function(){
         
         $(this).addClass('transition');
         }, function(){
         
         $(this).removeClass('transition');
         });
         });
         
      </script> 
   </body>
</html>