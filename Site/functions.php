<?php 
session_start();

// connect to database
$db = mysqli_connect('localhost', 'root', '', 'zoo');

// variable declaration (login and register)
$username = "";
$nom = "";
$prenom = "";
$date_naissance = "";
$tel = "";
$adresse = "";
$email = "";
//errors
$errors = array(); 

// variable declaration (animal table)
$id_animal = "";
$nomanimal = "";
$datenaiss = "";
$datedeces = "";
$sexe = "";
$id_espece = "";
$num_enclos = "";

// variable declaration (product table)
$id = "";
$name = "";
$image = "";
$price = "";
$status = "";

// variable declaration (evenement table)
$id_evenement = "";
$nom_evenement = "";
$datedeb = "";
$datefin = "";

// variable declaration (contact table)
$id_contact = "";
$nomcontact = "";
$tel = "";
$email = "";
$message = "";

// call the register() function if register_btn is clicked
if (isset($_POST['register_btn'])) {
	register();
}

// REGISTER USER
function register(){
	// call these variables with the global keyword to make them available in function
	global $db, $errors, $username, $nom, $prenom, $date_naissance, $tel, $adresse, $email;

	// receive all input values from the form. Call the e() function
    // defined below to escape form values
	$username = e($_POST['username']);
	$nom = e($_POST['nom']);
	$prenom = e($_POST['prenom']);
	$date_naissance = e($_POST['date_naissance']);
	$tel = e($_POST['tel']);
	$adresse = e($_POST['adresse']);
	$email = e($_POST['email']);
	$password_1 = e($_POST['password_1']);
	$password_2 = e($_POST['password_2']);


	// form validation: ensure that the form is correctly filled
	if (empty($username)) { 
		array_push($errors, "Entrer votre nom d'utilisateur"); 
	}
	if (empty($email)) { 
		array_push($errors, "Entrer votre email"); 
	}
	if (empty($nom)) { 
		array_push($errors, "Entrer votre nom"); 
	}
	if (empty($prenom)) { 
		array_push($errors, "Entrer votre prenom"); 
	}
	if (empty($date_naissance)) { 
		array_push($errors, "Entrer votre date de naissance"); 
	}
	if (empty($tel)) { 
		array_push($errors, "Entrer votre telephone"); 
	}
	if (empty($adresse)) { 
		array_push($errors, "Entrer votre adresse"); 
	}
	if (empty($password_1)) { 
		array_push($errors, "Entrer votre mot de passe"); 
	}
	if ($password_1 != $password_2) {
		array_push($errors, "Le mot de passe ne correspond pas");
	}

	// register user if there are no errors in the form
	if (count($errors) == 0) {
		$password = md5($password_1);//encrypt the password before saving in the database

		if (isset($_POST['user_type'])) {
			$user_type = e($_POST['user_type']);
			$query = "INSERT INTO users (username, nom, prenom, date_naissance, tel, adresse, email, user_type, password) 
					  VALUES('$username', '$nom', '$prenom', '$date_naissance', '$tel', '$adresse', '$email', '$user_type', '$password')";
			mysqli_query($db, $query);
			$_SESSION['success']  = "L'utilisateur a été créer!";
			header('location: home.php');
		}else{
			$query = "INSERT INTO users (username, nom, prenom, date_naissance, tel, adresse, email, user_type, password) 
					  VALUES('$username', '$nom', '$prenom', '$date_naissance', '$tel', '$adresse', '$email', 'user', '$password')";
			mysqli_query($db, $query);

			// get id of the created user
			$logged_in_user_id = mysqli_insert_id($db);

			$_SESSION['user'] = getUserById($logged_in_user_id); // put logged in user in session
			$_SESSION['success']  = "You are now logged in";

			header('location: welcome.php');				
		}
	}
}

// return user array from their id
function getUserById($id){
	global $db;
	$query = "SELECT * FROM users WHERE id=" . $id;
	$result = mysqli_query($db, $query);

	$user = mysqli_fetch_assoc($result);
	return $user;
}

// escape string
function e($val){
	global $db;
	return mysqli_real_escape_string($db, trim($val));
}

function display_error() {
	global $errors;

	if (count($errors) > 0){
		echo '<div class="error">';
			foreach ($errors as $error){
				echo $error .'<br>';
			}
		echo '</div>';
	}
}	
function isLoggedIn()
{
	if (isset($_SESSION['user'])) {
		return true;
	}else{
		return false;
	}
}
// log user out if logout button clicked
if (isset($_GET['logout'])) {
	session_destroy();
	unset($_SESSION['user']);
	header("location: login.php");
}

// call the login() function if register_btn is clicked
if (isset($_POST['login_btn'])) {
	login();
}

// LOGIN USER
function login(){
	global $db, $username, $errors;

	// grap form values
	$username = e($_POST['username']);
	$password = e($_POST['password']);

	// make sure form is filled properly
	if (empty($username)) {
		array_push($errors, "Le nom d'utilisateur est requis");
	}
	if (empty($password)) {
		array_push($errors, "Le mot de passe est requis");
	}

	// attempt login if no errors on form
	if (count($errors) == 0) {

		$query = "SELECT * FROM users WHERE username='$username' AND password='$password' LIMIT 1";
		$results = mysqli_query($db, $query);

		if (mysqli_num_rows($results) == 1) { // user found
			// check if user is admin or user
			$logged_in_user = mysqli_fetch_assoc($results);
			if ($logged_in_user['user_type'] == 'admin') {

				$_SESSION['user'] = $logged_in_user;
				$_SESSION['success']  = "Vous etes connecté";
				header('location: admin/home.php');		  
			}else{
				$_SESSION['user'] = $logged_in_user;
				$_SESSION['success']  = "Vous etes connecté";

				header('location: welcome.php');
			}
		}else {
			array_push($errors, "Le nom d'utilisateur ou le mot de passe est incorrect.");
		}
	}
}
function isAdmin()
{
	if (isset($_SESSION['user']) && $_SESSION['user']['user_type'] == 'admin' ) {
		return true;
	}else{
		return false;
	}
}


if (isset($_POST['add_btn_animal'])) {
	addAnimal();
}

function addAnimal(){
	// call these variables with the global keyword to make them available in function
	global $db, $errors, $id_animal, $nomanimal, $datenaiss, $datedeces, $sexe, $id_espece, $num_enclos;

	// receive all input values from the form. Call the e() function
    // defined below to escape form values
	$nomanimal = e($_POST['nomanimal']);
	$datenaiss = e($_POST['datenaiss']);
	$sexe = e($_POST['sexe']);
	$id_espece = e($_POST['id_espece']);
	$num_enclos = e($_POST['num_enclos']);

	// form validation: ensure that the form is correctly filled

	if (empty($nomanimal)) { 
		array_push($errors, "Entrer le nom de l'animal"); 
	}
	if (empty($datenaiss)) { 
		array_push($errors, "Entrer la date de naissance");
	}
	
	if (empty($sexe)) { 
		array_push($errors, "Entrer le sexe"); 
	}
	if (empty($id_espece)) { 
		array_push($errors, "Entrer l'id espece"); 
	}
	if (empty($num_enclos)) { 
		array_push($errors, "Entrer le numero de l'enclos"); 
	}


	// register animal if there are no errors in the form
	if (count($errors) == 0) {

		    $query = "INSERT INTO animal (id_animal, nomanimal, datenaiss, datedeces, sexe, id_espece, num_enclos) 
					  VALUES(null, '$nomanimal', '$datenaiss', null, '$sexe', '$id_espece', '$num_enclos')";
			mysqli_query($db, $query);
				echo "L'animal a été ajouté avec succes.";
		} else{
    			echo "ERREUR: La base de données n'a pas pu etre executé. ";
		}	
	}

if (isset($_POST['add_btn_article'])) {
	addArticle();
}

function addArticle(){
	// call these variables with the global keyword to make them available in function
	global $db, $errors, $id, $name, $image, $price;

	// receive all input values from the form. Call the e() function
    // defined below to escape form values
 $name = e($_POST['name']);
 $image = e($_POST['image']);
 $price = e($_POST['price']);
 
	// form validation: ensure that the form is correctly filled
 	if (empty($name)) { 
		array_push($errors, "Donner un nom"); 
	}
	if (empty($image)) { 
		array_push($errors, "Insérer une image"); 
	}
	if (empty($price)) { 
		array_push($errors, "Insérer le prix");
	}
	

	// register animal if there are no errors in the form
	if (count($errors) == 0) {

			$query = "INSERT INTO products (id, name, image, price) 
					  VALUES(null, '$image', '$image', '$price')";
			mysqli_query($db, $query);
				echo "L'article a été ajouté avec succes.";
		} else{
    			echo "ERREUR: La base de données n'a pas pu etre executé. ";
		}
		
	}

if (isset($_POST['add_btn_evenement'])) {
	addEvenement();
}

function addEvenement(){
	// call these variables with the global keyword to make them available in function
	global $db, $errors, $id_evenement, $nom_evenement, $datedeb, $datefin;

	// receive all input values from the form. Call the e() function
    // defined below to escape form values
 $nom_evenement = e($_POST['nom_evenement']);
 $datedeb = e($_POST['datedeb']);
 $datefin = e($_POST['datefin']);
 
	// form validation: ensure that the form is correctly filled
 	if (empty($nom_evenement)) { 
		array_push($errors, "Donner un nom"); 
	}
	if (empty($datedeb)) { 
		array_push($errors, "Donner une date"); 
	}
	if (empty($datefin)) { 
		array_push($errors, "Donner une date");
	}
	

	// register animal if there are no errors in the form
	if (count($errors) == 0) {

			$query = "INSERT INTO evenement (id_evenement, nom_evenement, datedeb, datefin) 
					  VALUES(null, '$nom_evenement', '$datedeb', '$datefin')";
			mysqli_query($db, $query);
				echo "L'evenement a été ajouté avec succes.";
		} else{
    			echo "ERREUR: La base de données n'a pas pu etre executé. ";
		}
		
	}

	if (isset($_POST['add_btn_contact'])) {
	addContact();
}

function addContact(){
	// call these variables with the global keyword to make them available in function
	global $db, $errors, $id_contact, $nomcontact, $tel, $email, $message;

	// receive all input values from the form. Call the e() function
    // defined below to escape form values
 $nomcontact = e($_POST['nomcontact']);
 $tel = e($_POST['tel']);
 $email = e($_POST['email']);
 $message = e($_POST['message']);
 
	// form validation: ensure that the form is correctly filled
 	if (empty($nomcontact)) { 
		array_push($errors, "Donner un nom"); 
	}
	if (empty($tel)) { 
		array_push($errors, "Donner un numéro de telephone"); 
	}
	if (empty($email)) { 
		array_push($errors, "Donner un email");
	}
	if (empty($message)) { 
		array_push($errors, "Rédiger un message");
	}
	

	// register animal if there are no errors in the form
	if (count($errors) == 0) {

			$query = "INSERT INTO contact (id_contact, nomcontact, tel, email, message) 
					  VALUES(null, '$nomcontact', '$tel', '$email', '$message')";
			mysqli_query($db, $query);
				echo "L'evenement a été ajouté avec succes.";
		} else{
    			echo "ERREUR: La base de données n'a pas pu etre executé. ";
		}
		
	}


?>