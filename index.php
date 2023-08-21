<?php
	require('config.php');
	// Initialiser la session
	session_start();
//	session_start(); // la session a été ouverte avec config.php
	// Vérifiez si l'utilisateur est connecté, sinon redirigez-le vers la page de connexion
	if(!isset($_SESSION["username"])){
		header("Location: accueil.php");
		exit(); 
	}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Index</title>
        <link rel="stylesheet" href="style.css">
    </head>
	<body>
		<div class="success">
		<h1>Bienvenue <?php echo $_SESSION['username']; ?>!</h1>
		<p>C'est votre espace utilisateur.</p>
		<a href="deconnexion.php">Déconnexion</a>
		</div>
	</body>
</html>