<?php
session_start();
// Détruire la session et Redirection vers la page de connexion
	if(session_destroy()){
			header("Location: accueil.php");
	}
?>