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

// Consultar todas las inversiones del usuario actual
$query = "SELECT id_inversion, monto, tipo, estado, fecha_inicio, rendimiento, plazo, plataforma, descripcion 
          FROM inversiones 
          WHERE id_usuario = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('i', $id_usuario);
$stmt->execute();
$result = $stmt->get_result();

// Verificar si hay inversiones
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
            .inversion {
                margin-bottom: 20px;
                padding: 10px;
                border: 1px solid #ddd;
                border-radius: 5px;
            }
            .inversion h2 {
                color: #264d3e;
                margin-bottom: 10px;
            }
            .inversion .info {
                display: flex;
                justify-content: space-between;
                margin-bottom: 10px;
            }
            .inversion .info div {
                width: 48%;
            }
            .inversion p {
                margin: 5px 0;
            }
            .inversion .description {
                margin-top: 10px;
                font-style: italic;
                color: #555;
            }
        </style>
        <div class='header'>
            <h1>Reporte de Inversiones</h1>
        </div>";
    
    while ($row = $result->fetch_assoc()) {
        $html .= "
            <div class='inversion'>
                <h2>Inversión ID: {$row['id_inversion']}</h2>
                <div class='info'>
                    <div>
                        <p><strong>Monto:</strong> $" . number_format($row['monto'], 2) . "</p>
                        <p><strong>Tipo:</strong> {$row['tipo']}</p>
                        <p><strong>Estado:</strong> {$row['estado']}</p>
                        <p><strong>Descripción:</strong> {$row['descripcion']}</p>
                    </div>
                    <div>
                        <p><strong>Fecha de Inicio:</strong> {$row['fecha_inicio']}</p>
                        <p><strong>Rendimiento:</strong> " . number_format($row['rendimiento'], 2) . "% anual</p>
                        <p><strong>Duración:</strong> {$row['plazo']}</p>
                        <p><strong>Plataforma:</strong> {$row['plataforma']}</p>
                    </div>
                </div>
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
    $dompdf->stream("reporte_inversiones.pdf", ["Attachment" => true]);
    exit;
} else {
    echo "No hay inversiones registradas para exportar.";
}
?>
