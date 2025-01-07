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

// Consultar todas las deudas del usuario actual
$query = "SELECT id_deuda, acreedor, monto_total, fecha_vencimiento, tasa_interes, descripcion 
          FROM deudas 
          WHERE id_usuario = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('i', $id_usuario);
$stmt->execute();
$result = $stmt->get_result();

// Verificar si hay deudas
if ($result->num_rows > 0) {
    // Incluir la librería Dompdf
    require '../vendor/autoload.php';
    use Dompdf\Dompdf;

    $dompdf = new Dompdf();

    // Construir el HTML para el PDF
    $html = "
        <h1 style='text-align: center;'>Reporte de Deudas</h1>
        <table border='1' style='width: 100%; border-collapse: collapse;'>
            <thead>
                <tr style='background-color: #264d3e; color: white;'>
                    <th>ID</th>
                    <th>Acreedor</th>
                    <th>Monto Total</th>
                    <th>Fecha de Vencimiento</th>
                    <th>Tasa de Interés</th>
                    <th>Descripción</th>
                </tr>
            </thead>
            <tbody>";
    
    while ($row = $result->fetch_assoc()) {
        $html .= "
            <tr>
                <td>{$row['id_deuda']}</td>
                <td>{$row['acreedor']}</td>
                <td>$" . number_format($row['monto_total'], 2) . "</td>
                <td>{$row['fecha_vencimiento']}</td>
                <td>" . number_format($row['tasa_interes'], 2) . "%</td>
                <td>{$row['descripcion']}</td>
            </tr>";
    }

    $html .= "
            </tbody>
        </table>";

    // Cargar el HTML en Dompdf
    $dompdf->loadHtml($html);

    // Configurar el tamaño del papel y la orientación
    $dompdf->setPaper('A4', 'landscape');

    // Renderizar el PDF
    $dompdf->render();

    // Enviar el PDF al navegador
    $dompdf->stream("reporte_deudas.pdf", ["Attachment" => true]);
    exit;
} else {
    echo "No hay deudas registradas para exportar.";
}
?>
