<?php
session_start();
if (!isset($_SESSION['id_usuario'])) {
    header("Location: login.html");
    exit;
}

// Configurar la conexión a la base de datos directamente en el archivo
$servername = "localhost"; 
$username = "root";        
$password = "";            
$dbname = "burrocash";     

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Validar que los datos se hayan enviado correctamente
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $acreedor = $_POST['acreedor'];
    $monto_total = $_POST['monto_total'];
    $fecha_vencimiento = $_POST['fecha_vencimiento'];
    $tasa_interes = $_POST['tasa_interes'];
    $descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : null;
    $id_usuario = $_SESSION['id_usuario'];

    // Preparar y ejecutar la consulta de inserción
    $query = "INSERT INTO deudas (acreedor, descripcion, monto_total, fecha_vencimiento, tasa_interes, id_usuario) 
    VALUES (?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($query);
$stmt->bind_param('ssdssi', $acreedor, $descripcion, $monto_total, $fecha_vencimiento, $tasa_interes, $id_usuario);



    if ($stmt->execute()) {
        // Redirigir con un mensaje de éxito
        header("Location: /burrocash/deudas.php?mensaje=Deuda registrada correctamente");
        exit;
    } else {
        // Redirigir con un mensaje de error
        header("Location: /burrocash/deudas.php?error=Error al registrar la deuda");
        exit;
    }
} else {
    header("Location: /burrocash/deudas.php");
    exit;
}
?>
