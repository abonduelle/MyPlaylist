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
if (isset($_POST['title'], $_POST['singer'], $_POST['IDmusic'])){
////récupérer les variables

$title = stripslashes($_POST['title']);
$singer = stripslashes($_POST['singer']);
$IDmusic = $_POST['IDmusic'];
$nom_table = 'musics';
// Requête SQL préparée
$query = "UPDATE $nom_table SET `title` = :title, `singer` = :singer WHERE `musics`.`id` = $IDmusic;";
$req = $conn->prepare($query);
$req->execute(array(
":title" => $title,
":singer" => $singer,         
));

if($req){
    echo "<div class='success'>
    <h3>Vous avez fait la modification avec succès.</h3>
    <p>Cliquez ici pour <a href='musiques.php'> revenir à la liste</a></p>
    </div>";
}else{
    echo "<h3>Vous n'avez pas effectué la modification.</h3>";
}
$req->closeCursor();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modification d'une musique</title>
    <link rel="stylesheet" href="../style.css">
</head>
</html>