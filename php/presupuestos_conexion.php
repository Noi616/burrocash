<?php
$host = "localhost";
$user = "root";
$password = "";
$database = "burrocash";

// Crear conexión
$conn = new mysqli($host, $user, $password, $database);

// Comprobar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>
