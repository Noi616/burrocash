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

if (isset($input['id_adeudo'], $input['acreedor'], $input['monto'], $input['fecha'], $input['categoria'], $input['estado'])) {
    $id_adeudo = $input['id_adeudo'];
    $acreedor = $input['acreedor'];
    $monto = $input['monto'];
    $fecha = $input['fecha'];
    $categoria = $input['categoria'];
    $estado = $input['estado'];
    $id_usuario = $_SESSION['id_usuario'];

    // Actualizar los datos en la base de datos
    $query = "UPDATE adeudos SET acreedor = ?, monto = ?, fecha = ?, categoria = ?, estado = ?
              WHERE id_adeudo = ? AND id_usuario = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('sdsssii', $acreedor, $monto, $fecha, $categoria, $estado, $id_adeudo, $id_usuario);

    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Adeudo actualizado correctamente.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error al actualizar el adeudo.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Datos incompletos enviados.']);
}
?>
