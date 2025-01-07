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
if (isset($_GET['id_inversion'])) {
    $id_inversion = $_GET['id_inversion'];
    $id_usuario = $_SESSION['id_usuario'];

    // Obtener los datos de la inversión
    $query = "SELECT id_inversion, monto, tipo, plazo, rendimiento, fecha_inicio, fecha_fin, descripcion, detalles, plataforma, estado 
              FROM inversiones 
              WHERE id_inversion = ? AND id_usuario = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('ii', $id_inversion, $id_usuario);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $inversion = $result->fetch_assoc();
        echo json_encode(['success' => true, 'inversion' => $inversion]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Inversión no encontrada.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Solicitud inválida.']);
}
?>
