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
    $monto = $_POST['monto'];
    $descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : null;
    $fecha = $_POST['fecha'];
    $categoria = $_POST['categoria'];
    $id_usuario = $_SESSION['id_usuario'];

    // Preparar y ejecutar la consulta de inserción
    $query = "INSERT INTO ingreso (monto, descripcion, fecha, categoria, id_usuario) 
              VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('isssi', $monto, $descripcion, $fecha, $categoria, $id_usuario);

    if ($stmt->execute()) {
        // Redirigir con un mensaje de éxito
        header("Location: /burrocash/ingresos.php?mensaje=Ingreso registrado correctamente");
        exit;
    } else {
        // Redirigir con un mensaje de error
        header("Location: /burrocash/ingresos.php?error=Error al registrar el ingreso");
        exit;
    }
} else {
    header("Location: /burrocash/ingresos.php");
    exit;
}
?>

