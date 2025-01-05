<?php
session_start();
if (!isset($_SESSION['id_usuario'])) {
    echo json_encode([]);
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

$id_usuario = $_SESSION['id_usuario'];

// Consulta las tarjetas del usuario
$query = "SELECT id_tarjeta, numero, tipo, banco FROM tarjeta WHERE id_usuario = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $id_usuario);
$stmt->execute();
$result = $stmt->get_result();

$tarjetas = [];
while ($row = $result->fetch_assoc()) {
    $row['numero'] = str_pad(substr($row['numero'], -4), strlen($row['numero']), '*', STR_PAD_LEFT); // Enmascarar número
    $tarjetas[] = $row;
}

echo json_encode($tarjetas);
?>
