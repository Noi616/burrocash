<?php
// Mostrar errores para depuración
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Incluir el archivo de conexión
include 'C:/wamp64/www/burrocash/php/subadeudo_conexion.php';

// Verificar si la conexión se estableció
if ($conexion_subadeudo->connect_error) {
    die("Error: No se estableció la conexión con la base de datos.");
}

// Capturar los valores del formulario
$id_categoria = isset($_POST['id_categoria']) ? intval($_POST['id_categoria']) : null;
$acreedor = isset($_POST['acreedor']) ? $conexion_subadeudo->real_escape_string($_POST['acreedor']) : null;
$descripcion = isset($_POST['descripcion']) ? $conexion_subadeudo->real_escape_string($_POST['descripcion']) : null;
$monto = isset($_POST['monto']) ? floatval($_POST['monto']) : null;
$fecha = isset($_POST['fecha']) ? $conexion_subadeudo->real_escape_string($_POST['fecha']) : null;

// Verificar que los valores no estén vacíos
if (empty($id_categoria) || empty($acreedor) || empty($descripcion) || empty($monto) || empty($fecha)) {
    die('Error: Todos los campos del formulario son obligatorios.');
}

// Ejecutar la consulta SQL para insertar datos en la tabla correcta
$query = "INSERT INTO registrarsubadeudo (id_adeudo, id_categoria, acreedor, descripcion, monto, fecha) VALUES (1, ?, ?, ?, ?, ?)";
$stmt = $conexion_subadeudo->prepare($query);
$stmt->bind_param('issss', $id_categoria, $acreedor, $descripcion, $monto, $fecha);

if ($stmt->execute()) {
    echo 'Registro insertado correctamente.';
} else {
    die('Error en la consulta: ' . $stmt->error);
}
?>
