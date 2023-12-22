<?php
$servername = "localhost:3306";
$username = "root";
$password = "";
$database = "admin";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$conn->set_charset("utf8");
?>
