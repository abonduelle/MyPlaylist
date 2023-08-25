<?php
require('../config.php');
// Vérifier si l'utilisateur est connecté, sinon le rediriger vers la page de connexion
//if(!isset($_SESSION["userID"]) && ($_SESSION["isAdmin"] != 'admin')){
if(!isset($_SESSION["userID"])){
		header("Location: ../accueil.php");
		exit(); 
	}
    require('headeradmin.html');?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des musiques</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <h1>Liste des musiques</h1>
    <table>
        <thead>
            <tr>
                <!-- <th>ID</th> -->
                <th>Titre</th>
                <th>Interprète</th>
                <th>Ajouté par</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (isset($_GET["IDuser"])) {
                $IDuser =  $_GET["IDuser"];
            } else {
                $IDuser = "";
            }  
            $nom_table1 = 'musics';
            $nom_table2 = 'users';
            // Requête SQL préparée
            //SELECT m.* , u.username FROM musics m LEFT JOIN users u ON u.id = m.userID;
            $querymusics = "SELECT m.* , u.username FROM $nom_table1 m 
            LEFT JOIN $nom_table2 u ON u.id = m.userID";

            // // Requête SQL préparée
            // //SELECT * FROM `musics`;
            //     $querymusics = "SELECT * FROM $nom_table";
                $reqmusics = $conn->prepare($querymusics);
                $reqmusics->execute();
                $listemusics = $reqmusics->fetchAll();
            foreach($listemusics as $key =>$music){
                $IDmusic=$music[0];
                echo ('<tr>
                <td><a href="fichemusic.php?IDmusic=' . $IDmusic.'">'.$music[1].'</a></td>
                <td>'.$music[2].'</td>
                <td>'.$music[4].'</td>
                </tr>');
            }
            ?>
        </tbody>
    </table>
    
    <h3><a href="home.php">Retour accueil espace admin</a></h3>
</body>
</html>