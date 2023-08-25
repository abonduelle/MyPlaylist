<?php
require('../config.php');
// Vérifier si l'utilisateur est connecté, sinon le rediriger vers la page de connexion
	//if(!isset($_SESSION["userID"]) && ($_SESSION["isAdmin"]!="admin")){
	if(!isset($_SESSION["userID"])){
		header("Location: ../accueil.php");
		exit(); 
	}
	require('headeradmin.html');
	//var_dump($_SESSION);
?>
<!DOCTYPE html>
<html>
	<head>
	<link rel="stylesheet" href="../style.css" />
	</head>
	<body>
		<div class="success">
		<h1>Bienvenue! </h1>
		<h2>C'est votre espace administrateur.</h2>
		<a href="membres.php">Liste des Membres</a>
		<a href="musiques.php">Liste des Musiques</a>
		</ul>
		</div>
	</body>
</html>
