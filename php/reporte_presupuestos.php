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

// Consultar todos los presupuestos del usuario actual
$query = "SELECT id_presupuesto, nombre, ingresos, gastos, (ingresos - gastos) AS balance, fecha_inicio, fecha_fin, descripcion 
          FROM presupuestos 
          WHERE id_usuario = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('i', $id_usuario);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Configurar cabeceras HTTP para descargar el CSV
    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename="todos_los_presupuestos.csv"');

    // Abrir el flujo de salida
    $output = fopen('php://output', 'w');

    // Escribir el encabezado del CSV (en UTF-8)
    fprintf($output, chr(0xEF).chr(0xBB).chr(0xBF)); // Marca BOM para UTF-8
    fputcsv($output, ['ID', 'Nombre', 'Ingresos', 'Gastos', 'Balance', 'Fecha de Inicio', 'Fecha Fin', 'Descripción'], ',');

    // Escribir las filas al CSV
    while ($row = $result->fetch_assoc()) {
        fputcsv($output, [
            $row['id_presupuesto'],
            $row['nombre'],
            number_format($row['ingresos'], 2),
            number_format($row['gastos'], 2),
            number_format($row['balance'], 2),
            $row['fecha_inicio'],
            $row['fecha_fin'],
            $row['descripcion']
        ], ',');
    }

    // Cerrar el flujo de salida
    fclose($output);
    exit;
} else {
    echo "No hay presupuestos registrados para exportar.";
}
?>
