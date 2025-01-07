<?php
session_start();
if (!isset($_SESSION['id_usuario'])) {
    header("Location: login.html");
    exit;
}

// Incluir la librería Dompdf
require '../vendor/autoload.php';

// Usar la clase Dompdf
use Dompdf\Dompdf;

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
$query = "SELECT id_deuda, acreedor, monto_total, fecha_vencimiento, tasa_interes, descripcion, estado 
          FROM deudas 
          WHERE id_usuario = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('i', $id_usuario);
$stmt->execute();
$result = $stmt->get_result();

// Verificar si hay deudas
if ($result->num_rows > 0) {
    $dompdf = new Dompdf();

    // Construir el HTML para el PDF
    $html = "
        <style>
            body {
                font-family: Arial, sans-serif;
                margin: 20px;
            }
            .header {
                text-align: center;
                margin-bottom: 30px;
            }
            .header h1 {
                color: #264d3e;
            }
            .deuda {
                margin-bottom: 20px;
                padding: 10px;
                border: 1px solid #ddd;
                border-radius: 5px;
            }
            .deuda h2 {
                color: #264d3e;
                margin-bottom: 10px;
            }
            .deuda .info {
                display: flex;
                justify-content: space-between;
                margin-bottom: 10px;
            }
            .deuda .info div {
                width: 48%;
            }
            .deuda p {
                margin: 5px 0;
            }
            .deuda .description {
                margin-top: 10px;
                font-style: italic;
                color: #555;
            }
        </style>
        <div class='header'>
            <h1>Reporte de Deudas</h1>
        </div>";
    
    while ($row = $result->fetch_assoc()) {
        $html .= "
            <div class='deuda'>
                <h2>Deuda con {$row['acreedor']}</h2>
                <div class='info'>
                    <div>
                        <p><strong>ID:</strong> {$row['id_deuda']}</p>
                        <p><strong>Monto:</strong> $" . number_format($row['monto_total'], 2) . "</p>
                        <p><strong>Tasa de Interés:</strong> " . number_format($row['tasa_interes'], 2) . "%</p>
                        <p><strong>Estado:</strong> {$row['estado']}</p>
                    </div>
                    <div>
                        <p><strong>Fecha de Vencimiento:</strong> {$row['fecha_vencimiento']}</p>
                    </div>
                </div>
                <p class='description'><strong>Descripción:</strong> {$row['descripcion']}</p>
            </div>";
    }

    $html .= "</body>";

    // Cargar el HTML en Dompdf
    $dompdf->loadHtml($html);

    // Configurar el tamaño del papel y la orientación
    $dompdf->setPaper('A4', 'portrait');

    // Renderizar el PDF
    $dompdf->render();

    // Enviar el PDF al navegador
    $dompdf->stream("reporte_deudas.pdf", ["Attachment" => true]);
    exit;
} else {
    echo "No hay deudas registradas para exportar.";
}
?>
