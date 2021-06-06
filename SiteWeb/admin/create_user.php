<?php include('../functions.php') ?>
<!DOCTYPE html>
<html>
<head>
	<title>Créer utilisateur</title>
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
		<h2>Admin - créer un utilisateur</h2>
	</div>
	
	<form method="post" action="create_user.php">

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
    		<input type="text" name="tel" value="<?php echo $tel; ?>">
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
			<label>Type d'utilisateur</label>
			<select name="user_type" id="user_type" >
				<option value=""></option>
				<option value="admin">Admin</option>
				<option value="user">User</option>
			</select>
		</div>
		<div class="input-group_e">
			<label>Mot de passe</label>
			<input type="password" name="password_1">
		</div>
		<div class="input-group_e">
			<label>Confirmer mot de passe</label>
			<input type="password" name="password_2">
		</div>
		<div class="input-group_e">
			<button type="submit" class="btn" name="register_btn"> + Créer utilisateur</button>
		</div>
	</form>
</body>
</html>