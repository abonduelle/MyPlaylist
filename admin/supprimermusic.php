<?php
    require('../config.php');
    require('../fonctions.php');
	require('headeradmin.html');
    // Vérifier si l'utilisateur est connecté, sinon le rediriger vers la page de connexion
    if(!isset($_SESSION["userID"])){
        header("Location: ../accueil.php");
        exit(); 
    }
    if (isset($_POST['IDmusic'])){
        // récupérer l'identifiant
        $IDmusic = $_POST['IDmusic'];
        $nom_table = 'musics';
        // Requête SQL préparée
       //"DELETE FROM users WHERE `users`.`id` = 27;";
        $queryusers ="DELETE FROM $nom_table WHERE $nom_table.`id` = $IDmusic;";
        $requsers = $conn->prepare($queryusers);
        $requsers->execute();
        $userdeleted = $requsers->fetchAll();
        if($requsers){
            echo "<div class='success'>
            <h3>Vous avez fait la suppression avec succès.</h3>
            <p><a href='musiques.php'> revenir à la liste</a></p>";
        }else{
            echo "<div class='success'>
            <h3>La suppression de la musique n'a pas pu être faite</h3>
            <p>Cliquez ici pour <a href='musiques.php'> revenir à la liste</a></p>";
        }
        $requsers->closeCursor();
    }else{
        echo "<div class='success'>
            <h3>La suppression de la musique n'a pas pu être faite</h3>
            <p><a href='musiques.php'> revenir à la liste</a></p>";
    }
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Suppression d'une musique</title>
    <link rel="stylesheet" href="../style.css">
</head>