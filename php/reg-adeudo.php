<?php
session_start(); // Iniciar sesión
header('Content-Type: text/html; charset=utf-8');
$conexion = mysqli_connect('localhost', 'root', '', 'burrocash');

// Verificar conexión
if (!$conexion) {
    die('Error al conectar con la base de datos: ' . mysqli_connect_error());
}

// Recuperar valores del formulario para registrar adeudo
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $acreedor = $_POST['acreedor'] ?? '';
    $descripcion = $_POST['descripcion'] ?? '';
    $monto = $_POST['monto'] ?? 0;
    $fecha = $_POST['fecha'] ?? '';
    $categoria = $_POST['categoria'] ?? '';
    $estado = $_POST['estado'] ?? '';

    // Preparar consulta para evitar inyección SQL
    $consulta = "INSERT INTO registraradeudo (acreedor, descripcion, monto, fecha, categoria, estado) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conexion, $consulta);
    mysqli_stmt_bind_param($stmt, 'ssdsss', $acreedor, $descripcion, $monto, $fecha, $categoria, $estado);

    if (mysqli_stmt_execute($stmt)) {
        echo "Nuevo adeudo registrado correctamente";
    } else {
        echo "Error: " . mysqli_error($conexion);
    }
}

// Cerrar conexión
mysqli_close($conexion);

?>
