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

// Obtener el ID del usuario
$id_usuario = $_SESSION['id_usuario'];

// Consultar todas las inversiones del usuario actual
$query = "SELECT id_inversion, monto, tipo, estado, rendimiento, descripcion 
          FROM inversiones 
          WHERE id_usuario = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('i', $id_usuario);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Configurar cabeceras HTTP para descargar el CSV
    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename="todas_las_inversiones.csv"');

    // Abrir el flujo de salida
    $output = fopen('php://output', 'w');

    // Escribir el encabezado del CSV (en UTF-8)
    fprintf($output, chr(0xEF).chr(0xBB).chr(0xBF)); // Marca BOM para UTF-8
    fputcsv($output, ['ID', 'Monto', 'Tipo', 'Estado', 'Rendimiento', 'Descripción'], ',');

    // Escribir las filas al CSV
    while ($row = $result->fetch_assoc()) {
        fputcsv($output, [
            $row['id_inversion'],
            number_format($row['monto'], 2),
            $row['tipo'],
            $row['estado'],
            $row['rendimiento'] . '%',
            $row['descripcion']
        ], ',');
    }

    // Cerrar el flujo de salida
    fclose($output);
    exit;
} else {
    echo "No hay inversiones registradas para exportar.";
}
?>
