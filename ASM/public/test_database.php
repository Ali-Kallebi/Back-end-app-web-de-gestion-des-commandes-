<?php

$conn = new mysqli("localhost", "root", "", "asm");

if ($conn->connect_error) {
    die("Échec de la connexion à la base de données : " . $conn->connect_error);
}
echo "Connexion réussie à la base de données MySQL!";
$conn->close();
?>
