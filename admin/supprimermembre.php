    <?php
    require('../config.php');
    require('../fonctions.php');
    // Vérifier si l'utilisateur est connecté, sinon le rediriger vers la page de connexion
    if(!isset($_SESSION["userID"])){
        header("Location: ../accueil.php");
        exit(); 
    }
	require('headeradmin.html');
    if(isset($_POST['IDuser'])){
        // récupérer l'identifiant
        $IDuser = $_POST['IDuser'];
        $nom_table = 'users';
        // Requête SQL préparée
       //"DELETE FROM users WHERE `users`.`id` = 27;";
        $queryusers ="DELETE FROM $nom_table WHERE $nom_table.`id` = $IDuser;";
        $requsers = $conn->prepare($queryusers);
        $requsers->execute();
        $userdeleted = $requsers->fetchAll();
        if($requsers){
            echo "<div class='success'>
            <h3>Vous avez fait la suppression avec succès.</h3>
            <p><a href='membres.php'> Revenir à la liste</a></p>";
        }else{
            echo "<div class='success'>
            <h3>La suppression du membre n'a pas pu être faite</h3>
            <p><a href='membres.php'> Revenir à la liste</a></p>";
        }
        $requsers->closeCursor();
    } else {
        echo "<div class='success'>
            <h3>La suppression du membre n'a pas pu être faite</h3>
            <p><a href='membres.php'> revenir à la liste</a></p>";
    }
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Suppression d'un membre</title>
    <link rel="stylesheet" href="../style.css">
</head>
