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

// Validar que se haya enviado un ID válido
if (isset($_GET['id_ingreso'])) {
    $id_ingreso = $_GET['id_ingreso'];
    $id_usuario = $_SESSION['id_usuario'];

    // Obtener los datos del ingreso
    $query = "SELECT id_ingreso, monto, fecha, categoria, descripcion FROM ingreso WHERE id_ingreso = ? AND id_usuario = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('ii', $id_ingreso, $id_usuario);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $ingreso = $result->fetch_assoc();
        echo json_encode(['success' => true, 'ingreso' => $ingreso]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Ingreso no encontrado.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Solicitud inválida.']);
}
?>
