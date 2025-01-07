<?php
session_start();
if (!isset($_SESSION['id_usuario'])) {
    echo json_encode(['success' => false, 'message' => 'No autorizado.']);
    exit;
}

// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "burrocash";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    echo json_encode(['success' => false, 'message' => 'Conexión fallida.']);
    exit;
}

// Validar que se haya enviado un ID
$input = json_decode(file_get_contents("php://input"), true); // Decodificar JSON
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($input['id_inversion'])) {
    $id_inversion = $input['id_inversion'];
    $id_usuario = $_SESSION['id_usuario'];

    // Eliminar la inversión
    $query = "DELETE FROM inversiones WHERE id_inversion = ? AND id_usuario = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('ii', $id_inversion, $id_usuario);

    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Inversión eliminada correctamente.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error al eliminar la inversión.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Solicitud inválida.']);
}
?>
