<?php
require('../config.php');
require('../fonctions.php');
// Vérifier si l'utilisateur est connecté, sinon le rediriger vers la page de connexion
//if(!isset($_SESSION["userID"]) && ($_SESSION["isAdmin"] != 'admin')){
if(!isset($_SESSION["userID"])){
    header("Location: ../accueil.php");
    exit(); 
}
require('headeradmin.html');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des membres</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <h1>Liste des membres</h1>
        <table>
        <thead>
            <tr>
                <!-- <th>ID</th> -->
                <th>Identifiant</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Type de membre</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (isset($_GET["IDuser"])) {
                $IDuser =  $_GET["IDuser"];
            } else {
                $IDuser = "";
            }  
            $nom_table = 'users';
            // Requête SQL préparée
            //SELECT * FROM `users`;
                $queryusers = "SELECT * FROM $nom_table";
                $requsers = $conn->prepare($queryusers);
                $requsers->execute();
                $listeusers = $requsers->fetchAll();
            foreach($listeusers as $key =>$user){
                $IDuser=$user[0];
                echo ('<tr>
                <td><a href="ficheuser.php?IDuser=' . $IDuser.'">'.$user[1].'</a></td>
                <td>'.$user[3].'</td>
                <td>'.$user[4].'</td>
                <td>'.$user[5].'</td>
                </tr>');
            }
            ?>
        </tbody>
    </table>
    
    <h3><a href="home.php">Retour à l'espace administrateur</a></h3>





</body>
</html>