<?php
session_start();
if (!isset($_SESSION['id_usuario'])) {
    header("Location: login.php");
    exit;
}

// Conexión directa a la base de datos
$host = 'localhost';
$user = 'root';
$password = ''; // Cambiar si tienes una contraseña configurada
$dbname = 'burrocash';

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Validar que los datos se hayan enviado correctamente
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $ingresos = $_POST['ingresos'];
    $gastos = $_POST['gastos'];
    $fecha_inicio = $_POST['fecha_inicio'];
    $fecha_fin = $_POST['fecha_fin'];
    $descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : null;
    $id_usuario = $_SESSION['id_usuario'];

    // Preparar y ejecutar la consulta de inserción
    $query = "INSERT INTO presupuestos (nombre, ingresos, gastos, fecha_inicio, fecha_fin, descripcion, id_usuario) 
              VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('sddsssi', $nombre, $ingresos, $gastos, $fecha_inicio, $fecha_fin, $descripcion, $id_usuario);

    if ($stmt->execute()) {
        // Redirigir con un mensaje de éxito
        header("Location: /burrocash/presupuestos.php?mensaje=Presupuesto registrado correctamente");
        exit;
    } else {
        // Redirigir con un mensaje de error
        header("Location: /burrocash/presupuestos.php?error=Error al registrar el presupuesto");
        exit;
    }
} else {
    header("Location: /burrocash/presupuestos.php");
    exit;
}
?>