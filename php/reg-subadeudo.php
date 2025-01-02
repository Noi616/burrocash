<?php
session_start(); // Iniciar sesión
$conexion = mysqli_connect('localhost', 'root', '', 'burrocash');

// Verificar conexión
if (!$conexion) {
    die('Error al conectar con la base de datos: ' . mysqli_connect_error());
}

// Recuperar valores del formulario para registrar subadeudo
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_adeudo = $_POST['id_adeudo'] ?? 0;
    $acreedor = $_POST['acreedor'] ?? '';
    $descripcion = $_POST['descripcion'] ?? '';
    $monto = $_POST['monto'] ?? 0;
    $fecha = $_POST['fecha'] ?? '';

    // Validar si los campos están completos
    if (empty($id_adeudo) || empty($acreedor) || empty($descripcion) || empty($monto) || empty($fecha)) {
        echo 'Por favor completa todos los campos.';
        exit;
    }

    // Preparar consulta para evitar inyección SQL
    $consulta = "INSERT INTO registrarsubadeudo (id_adeudo, acreedor, descripcion, monto, fecha) VALUES (?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conexion, $consulta);
    mysqli_stmt_bind_param($stmt, 'issds', $id_adeudo, $acreedor, $descripcion, $monto, $fecha);

    if (mysqli_stmt_execute($stmt)) {
        echo "Nuevo subadeudo registrado correctamente";
    } else {
        echo "Error: " . mysqli_error($conexion);
    }
}

// Cerrar conexión
mysqli_close($conexion);
?>
