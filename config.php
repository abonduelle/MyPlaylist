<?php
session_start();

$host= 'localhost';
$dbname = 'maplaylist';
$username = 'root';
$password = '';

try {
    $conn = new PDO("mysql:host={$host};dbname={$dbname};charset=utf8", $username, $password,
    array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    //echo "Connecté à $dbname sur $host avec succès.";
  } catch (PDOException $e) {
    die("Impossible de se connecter à la base de données $dbname :" . $e->getMessage());
}

?>