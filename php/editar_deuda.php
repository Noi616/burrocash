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

if (isset($input['id_deuda'], $input['acreedor'], $input['monto_total'], $input['fecha_vencimiento'], $input['tasa_interes'])) {
    $id_deuda = $input['id_deuda'];
    $acreedor = $input['acreedor'];
    $monto_total = $input['monto_total'];
    $fecha_vencimiento = $input['fecha_vencimiento'];
    $tasa_interes = $input['tasa_interes'];
    $descripcion = isset($input['descripcion']) ? $input['descripcion'] : null;
    $id_usuario = $_SESSION['id_usuario'];

    // Actualizar los datos en la base de datos
    $query = "UPDATE deudas SET acreedor = ?, monto_total = ?, fecha_vencimiento = ?, tasa_interes = ?, descripcion = ? 
              WHERE id_deuda = ? AND id_usuario = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('sdsdsii', $acreedor, $monto_total, $fecha_vencimiento, $tasa_interes, $descripcion, $id_deuda, $id_usuario);

    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Deuda actualizada correctamente.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error al actualizar la deuda.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Datos incompletos enviados.']);
}
?>
