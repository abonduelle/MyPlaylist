<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Playlist</title>
        <link rel="stylesheet" href="Style.css">
    </head>
<?php
require('config.php');
require('fonctions.php');

if(!isset($_SESSION['userID'])){
    header("Location:index.php");
    exit();
}
require('header.html');

$nom_table1 = 'musics';
$nom_table2 = 'users';
// Requête SQL préparée
//SELECT m.* , u.username FROM musics m LEFT JOIN users u ON u.id = m.userID;
    $query = "SELECT m.* , u.username FROM $nom_table1 m 
    LEFT JOIN $nom_table2 u ON u.id = m.userID";
    $req = $conn->prepare($query);
    $req->execute();
    $musiques = $req->fetchAll();
   
?>
    <body>
        <h1>Les prochains titres...</h1>
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
                foreach($musiques as $key =>$musique){
                   echo ('<tr><td>'.$musique[1].'</td><td>'.$musique[2].'</td><td>'.$musique[4].'</td></tr>');
                }
                ?>
            </tbody>
        </table>
        
        <h1>Et vous que souhaitez vous écouter?</h1>
        <h3><a href="ajoutenouveautitre.php">Ajouter une musique</a></h3>
    </body>
</html>