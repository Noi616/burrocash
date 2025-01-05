<?php
// Configuración de la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "burrocash";

// Crear conexión
$conexion_subadeudo = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conexion_subadeudo->connect_error) {
    die("Conexión fallida: " . $conexion_subadeudo->connect_error);
} else {
    echo "Conexión exitosa";
}
?>
