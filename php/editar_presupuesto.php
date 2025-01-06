<?php
session_start();
if (!isset($_SESSION['id_usuario'])) {
    header("Location: login.php");
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

// Validar los datos enviados
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_presupuesto = $_POST['id_presupuesto'];
    $nombre = $_POST['nombre'];
    $ingresos = $_POST['ingresos'];
    $gastos = $_POST['gastos'];
    $fecha_inicio = $_POST['fecha_inicio'];
    $fecha_fin = $_POST['fecha_fin'];
    $descripcion = $_POST['descripcion'];
    $id_usuario = $_SESSION['id_usuario'];

    // Actualizar el presupuesto
    $query = "UPDATE presupuestos SET nombre = ?, ingresos = ?, gastos = ?, fecha_inicio = ?, fecha_fin = ?, descripcion = ? 
              WHERE id_presupuesto = ? AND id_usuario = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('sddsssii', $nombre, $ingresos, $gastos, $fecha_inicio, $fecha_fin, $descripcion, $id_presupuesto, $id_usuario);

    if ($stmt->execute()) {
        header("Location: /burrocash/presupuestos.php?mensaje=Presupuesto actualizado correctamente");
        exit;
    } else {
        header("Location: /burrocash/presupuestos.php?error=Error al actualizar el presupuesto");
        exit;
    }
} else {
    header("Location: /burrocash/presupuestos.php?error=Solicitud inválida");
    exit;
}
?>