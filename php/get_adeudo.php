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

// Validar que el id_adeudo se haya enviado
if (isset($_GET['id_adeudo'])) {
    $id_adeudo = $_GET['id_adeudo'];
    $id_usuario = $_SESSION['id_usuario'];

    // Consultar los datos del adeudo
    $query = "SELECT id_adeudo, acreedor, monto, fecha, categoria, estado
              FROM adeudos
              WHERE id_adeudo = ? AND id_usuario = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('ii', $id_adeudo, $id_usuario);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Convertir los datos a JSON
        $adeudo = $result->fetch_assoc();
        echo json_encode($adeudo);
    } else {
        echo json_encode(['error' => 'Adeudo no encontrado.']);
    }
} else {
    echo json_encode(['error' => 'ID de adeudo no proporcionado.']);
}
?>
