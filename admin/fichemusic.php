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
    <title>Fiche d'une musique</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <h1>Fiche Musique</h1>
    <?php

    $IDmusic = $_GET['IDmusic'];

    ////Chargement de la page avec les valeurs modifiables

    $nom_table = 'musics';
    // Requête SQL préparée
        $query = "SELECT `title`, `singer` FROM $nom_table WHERE `id`=:IDmusic";
        $req = $conn->prepare($query);
        $req->execute(array(
           ":IDmusic" => $IDmusic
        ));

        $resultat = $req->fetchAll(PDO::FETCH_ASSOC);
         $resultat1 = $resultat[0]['title'];
         $resultat2 = $resultat[0]['singer'];
        
        $req->closeCursor();
    ?>

    <body>
        <section>
            <form action="modifiermusic.php" method="post">
                <div>
                    <label for="title">Titre</label>
                    <input type="text" name="title" id="title" value="<?php echo $resultat1 ?>">
                </div>
                <div>
                    <label for="singer">Interprète</label>
                    <input type="text" name="singer" id="singer" value="<?php echo $resultat2 ?>">
                </div>
                >
                <div>
                    <input type="hidden" name="IDmusic" value="<?php echo $IDmusic?>">
                </div>
                <input type="submit" name="submit" value="Modifier" class="box-button">
            </form>
            <form action="supprimermusic.php" method="post">
                    <input type="hidden" name="IDmusic" value="<?php echo $IDmusic?>">
                    <input type="submit" name="submit" value="Supprimer" class="box-button">
            </form>
        </section>
            
            <h3><a href="home.php">Retour accueil espace admin</a></h3>
            
        </body>
</html>