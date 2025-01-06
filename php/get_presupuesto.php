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
if (isset($_GET['id_presupuesto'])) {
    $id_presupuesto = $_GET['id_presupuesto'];
    $id_usuario = $_SESSION['id_usuario'];

    // Obtener los datos del presupuesto
    $query = "SELECT id_presupuesto, nombre, ingresos, gastos, fecha_inicio, fecha_fin, descripcion 
              FROM presupuestos WHERE id_presupuesto = ? AND id_usuario = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('ii', $id_presupuesto, $id_usuario);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $presupuesto = $result->fetch_assoc();
        echo json_encode(['success' => true, 'presupuesto' => $presupuesto]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Presupuesto no encontrado.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Solicitud inválida.']);
}
?>