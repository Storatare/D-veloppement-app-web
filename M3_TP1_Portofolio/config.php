<?php
// Connexion à la base de données
$servername = "localhost";
$username = "root";
$password  = "";
$dbname = "MySQL";

$conn = new mysqli($servername, $username, $password, $dbname);

// Vérification de la connexion
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
