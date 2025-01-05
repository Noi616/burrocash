<?php
session_start();
if (!isset($_SESSION['id_usuario'])) {
    echo json_encode(['success' => false, 'message' => 'Usuario no autenticado.']);
    exit;
}

// Configurar la conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "burrocash";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    echo json_encode(['success' => false, 'message' => 'Error de conexión a la base de datos.']);
    exit;
}

// Leer los datos enviados en JSON
$input = json_decode(file_get_contents('php://input'), true);

if (isset($input['id_deuda'])) {
    $id_deuda = $input['id_deuda'];
    $id_usuario = $_SESSION['id_usuario'];

    // Preparar la consulta de eliminación
    $query = "DELETE FROM deudas WHERE id_deuda = ? AND id_usuario = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('ii', $id_deuda, $id_usuario);

    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Deuda eliminada correctamente.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error al eliminar la deuda.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Solicitud inválida.']);
}
?>
