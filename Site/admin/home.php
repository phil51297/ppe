<?php 
include('../functions.php');

if (!isAdmin()) {
	$_SESSION['msg'] = "Vous devez vous connecter";
	header('location: ../login.php');
}

if (isset($_GET['logout'])) {
	session_destroy();
	unset($_SESSION['user']);
	header("location: ../login.php");
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Accueil</title>
	<link rel="stylesheet" type="text/css" href="../css/login.css">
	<style>
	.header {
		background: #003366;
	}
	button[name=register_btn] {
		background: #003366;
	}
	</style>
</head>
<body>
	<div class="header_e">
		<h2>Admin - Page d'accueil</h2>
	</div>
	<div class="content_e">
		<!-- notification message -->
		<?php if (isset($_SESSION['success'])) : ?>
			<div class="error success" >
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
			<img src="../images/user_profile.png"  >

			<div>
				<?php  if (isset($_SESSION['user'])) : ?>
					<strong><?php echo $_SESSION['user']['username']; ?></strong>

					<small>
						<i  style="color: #888;">(<?php echo ucfirst($_SESSION['user']['user_type']); ?>)</i> 
						<br>
						<a href="home.php?logout='1'" style="color: red;">Déconnexion</a>
                       &nbsp; <a href="create_user.php"> + ajouter utilisateur</a>
					</small>

				<?php endif ?>
			</div>
		</div>
	</div>
		<center>
			<h2>Animal</h2>
		</center>
	<form action="home.php" method="post">
    <p>
        <label>Nom animal</label>
    	<input type="text" name="nomanimal" value="<?php echo $nomanimal; ?>">
    </p>
    <p>
        <label>Date de naissance</label>
    	<input type="date" name="datenaiss" value="<?php echo $datenaiss; ?>">
    </p>
    <p>
        <label for="sexe">Sexe</label>
    	<select name="sexe" value="<?php echo $sexe; ?>">
    		<option value="">--Choisir une option--</option>
    		<option value="male">M</option>
    		<option value="female">F</option>
    	</select>
    </p>
    <p>
        <label>Identifiant espèce</label>
    	<input type="number" name="id_espece" min=1 max=3 value="<?php echo $id_espece; ?>">
    </p>
    <p>
        <label>Numéro enclos</label>
    	<input type="number" name="num_enclos" min=1 max=6 value="<?php echo $num_enclos; ?>">
    </p>
    <button type="submit" name="add_btn_animal">Ajouter</button> 
</form>
		<center>
			<h2>Article</h2>
		</center>
	<form action="home.php" method="post">
    <p>
        <label>Nom article</label>
    	<input type="text" name="name" value="<?php echo $name; ?>">
    </p>
    <p>
        <label>Image</label>
  		<input type="file" name="image" value="<?php echo $image; ?>">
    </p>
    <p>
        <label>Prix (€)</label>
    	<input type="number" name="price" step="0.01" value="<?php echo $price; ?>">
    </p>
    <button type="submit" name="add_btn_article">Ajouter</button> 
</form>
		<center>
			<h2>Evenement</h2>
		</center>
	<form action="home.php" method="post">
    <p>
        <label>Nom de l'evenement</label>
    	<input type="text" name="nom_evenement" value="<?php echo $nom_evenement; ?>">
    </p>
    <p>
        <label>Debut de l'evenement</label>
  		<input type="date" name="datedeb" value="<?php echo $datedeb; ?>">
    </p>
    <p>
        <label>Fin de l'evenement</label>
    	<input type="date" name="datefin" value="<?php echo $datefin; ?>">
    </p>
    <button type="submit" name="add_btn_evenement">Ajouter</button> 
</form>
</body>
</html>