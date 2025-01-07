<?php
session_start();
if (!isset($_SESSION['id_usuario'])) {
    header("Location: login.php");
    exit;
}

// Conexión a la base de datos
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
    // Línea para depuración de los datos enviados desde el formulario
    error_log(print_r($_POST, true)); // Esto imprimirá los datos enviados en los logs de PHP

    $descripcion = $_POST['descripcion'];
    $monto = $_POST['monto'];
    $tipo = $_POST['tipo'];
    $plazo = $_POST['plazo'];
    $rendimiento = $_POST['rendimiento'];
    $fecha_inicio = $_POST['fecha_inicio'];
    $fecha_fin = $_POST['fecha_fin'] ?: null; // Si no se envía fecha_fin, usar NULL
    $estado = $_POST['estado'];
    $plataforma = $_POST['plataforma'];
    $detalles = $_POST['detalles'];
    $id_usuario = $_SESSION['id_usuario'];

    // Preparar y ejecutar la consulta de inserción
    $query = "INSERT INTO inversiones (descripcion, monto, tipo, plazo, rendimiento, fecha_inicio, fecha_fin, estado, plataforma, detalles, id_usuario) 
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('sdsdssssssi', $descripcion, $monto, $tipo, $plazo, $rendimiento, $fecha_inicio, $fecha_fin, $estado, $plataforma, $detalles, $id_usuario);

    if ($stmt->execute()) {
        // Redirigir con un mensaje de éxito
        header("Location: /burrocash/inversiones.php?mensaje=Inversión registrada correctamente");
        exit;
    } else {
        // Redirigir con un mensaje de error
        error_log("Error en la consulta: " . $stmt->error); // Depuración del error en la consulta
        header("Location: /burrocash/inversiones.php?error=Error al registrar la inversión");
        exit;
    }
} else {
    header("Location: /burrocash/inversiones.php");
    exit;
}
?>
