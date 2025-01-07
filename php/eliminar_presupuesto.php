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
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($input['id_presupuesto'])) {
    $id_presupuesto = $input['id_presupuesto'];
    $id_usuario = $_SESSION['id_usuario'];

    // Eliminar el presupuesto
    $query = "DELETE FROM presupuestos WHERE id_presupuesto = ? AND id_usuario = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('ii', $id_presupuesto, $id_usuario);

    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Presupuesto eliminado correctamente.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error al eliminar el presupuesto.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Solicitud inválida.']);
}
?>