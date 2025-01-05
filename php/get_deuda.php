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

// Validar que el id_deuda se haya enviado
if (isset($_GET['id_deuda'])) {
    $id_deuda = $_GET['id_deuda'];
    $id_usuario = $_SESSION['id_usuario'];

    // Consultar los datos de la deuda
    $query = "SELECT id_deuda, acreedor, monto_total, fecha_vencimiento, tasa_interes, descripcion
              FROM deudas 
              WHERE id_deuda = ? AND id_usuario = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('ii', $id_deuda, $id_usuario);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Convertir los datos a JSON
        $deuda = $result->fetch_assoc();
        echo json_encode($deuda);
    } else {
        echo json_encode(['error' => 'Deuda no encontrada.']);
    }
} else {
    echo json_encode(['error' => 'ID de deuda no proporcionado.']);
}
?>
