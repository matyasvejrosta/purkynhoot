<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "purkynhoot";

//Připojení k databázi
$conn = new mysqli($servername, $username, $password, $dbname);

//Kontrola spojení
if ($conn->connect_error) {
    die("Chyba při připojení: " . $conn->connect_error);
}

//Nastavení češtiny
$conn->set_charset("utf8mb4");
?>
