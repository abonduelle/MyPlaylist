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
if (isset($_POST['firstname'], $_POST['name'], $_POST['username'], $_POST['type'], $_POST['IDuser'])){
////récupérer les variables

$firstname = stripslashes($_POST['firstname']);
$name = stripslashes($_POST['name']);
$username = stripslashes($_POST['username']);
$type = $_POST['type'];
$IDuser = $_POST['IDuser'];
$nom_table = 'users';
// Requête SQL préparée
// en SQL UPDATE `users` SET `username` = 'Toto 1', `name` = 'Toto Nom', `firstname` = 'Toto Prénom', `isAdmin` = 'admin' WHERE `users`.`id` = 5;
$query = "UPDATE $nom_table SET `username` = :username, `name` = :name, `firstname` = :firstname, `isAdmin` = :isAdmin WHERE `users`.`id` = $IDuser;";
$req = $conn->prepare($query);
$req->execute(array(
":username" => $username,
":name" => $name,
":firstname" => $firstname,
":isAdmin" => $type               
));

if($req){
    echo "<div class='success'>
    <h3>Vous avez fait la modification avec succès.</h3>
    <p><a href='membres.php'> Revenir à la liste</a></p>
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
    <title>Modification d'un membre</title>
    <link rel="stylesheet" href="../style.css">
</head>
</html>