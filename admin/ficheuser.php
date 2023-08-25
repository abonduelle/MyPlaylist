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
    <title>Fiche d'un membre</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <h1>Fiche Membre <?php $username ?></h1>
    <?php

    $IDuser = $_GET['IDuser'];

    ////Chargement de la page avec les valeurs modifiables

    $nom_table = 'users';
    // Requête SQL préparée
        $query = "SELECT `firstname`, `name`, `username`, `isAdmin` FROM $nom_table WHERE `id`=:IDuser";
        $req = $conn->prepare($query);
        $req->execute(array(
           ":IDuser" => $IDuser
        ));
        
        $etat = $req->rowCount();
        $resultat = $req->fetchAll(PDO::FETCH_ASSOC);
         $resultat1 = $resultat[0]['firstname'];
         $resultat2 = $resultat[0]['name'];
         $resultat3 = $resultat[0]['username'];
         $resultat4 = $resultat[0]['isAdmin'];

        $req->closeCursor();
    ?>

    <body>
        <section>
            <form action="modifiermembre.php" method="post">
                <div>
                    <label for="firstname">Prénom</label>
                    <input type="text" name="firstname" id="firstname" value="<?php echo $resultat3 ?>">
                </div>
                <div>
                    <label for="name">Nom</label>
                    <input type="text" name="name" id="name" value="<?php echo $resultat2 ?>">
                </div>
                <div>
                    <label for="username">Identifiant</label>
                    <input type="text" name="username" id="username" value="<?php echo $resultat1 ?>">
                </div>
                <div>
                    <label for="type">Administrateur ou Utilisateur</label>
                    <select class="box-input" name="type" id="type">
                        <option value="<?php echo $resultat4 ?>"><?php echo $resultat4 ?></option>
                        <option value="admin">admin</option>
                        <option value="user">user</option>
                    </select> 
                </div>
                <div>
                    <input type="hidden" name="IDuser" value="<?php echo $IDuser?>">
                </div>
                <input type="submit" name="submit" value="Modifier" class="box-button">
            </form>
            <form action="supprimermembre.php" method="post">
                    <input type="hidden" name="IDuser" value="<?php echo $IDuser?>">
                    <input type="submit" name="submit" value="Supprimer" class="box-button">
            </form>
        </section>
            
            <h3><a href="home.php">Retour accueil espace admin</a></h3>
            
        </body>
</html>