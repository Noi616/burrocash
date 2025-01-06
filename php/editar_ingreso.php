<?php
session_start();
if (!isset($_SESSION['id_usuario'])) {
    header("Location: login.html");
    exit;
}

// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "burrocash";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Validar los datos enviados
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_ingreso = $_POST['id_ingreso'];
    $monto = $_POST['monto'];
    $fecha = $_POST['fecha'];
    $categoria = $_POST['categoria'];
    $descripcion = $_POST['descripcion'];
    $id_usuario = $_SESSION['id_usuario'];

    // Actualizar el ingreso
    $query = "UPDATE ingreso SET monto = ?, fecha = ?, categoria = ?, descripcion = ? 
              WHERE id_ingreso = ? AND id_usuario = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('dsssii', $monto, $fecha, $categoria, $descripcion, $id_ingreso, $id_usuario);

    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Ingreso actualizado correctamente.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error al actualizar el ingreso.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Solicitud inválida.']);
}
?>

