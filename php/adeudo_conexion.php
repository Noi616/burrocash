<?php
// Configuración de la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "burrocash";

// Crear conexión
$conexion_adeudo = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conexion_adeudo->connect_error) {
    die("Conexión fallida: " . $conexion_adeudo->connect_error);
} else {
    echo "Conexión exitosa";
}
?>
