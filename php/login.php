<?php
session_start(); // Iniciar sesión
$conexion = mysqli_connect('localhost', 'root', '', 'burrocash');

// Verificar conexión
if (!$conexion) {
    die('Error al conectar con la base de datos: ' . mysqli_connect_error());
}

// Recuperar valores del formulario
$email = $_POST['email'] ?? '';
$contrasena = $_POST['password'] ?? '';

// Validar si los campos están completos
if (empty($email) || empty($contrasena)) {
    echo 'Por favor completa todos los campos.';
    exit;
}

// Preparar consulta para evitar inyección SQL
$consulta = "SELECT * FROM usuario WHERE correo = ?";
$stmt = mysqli_prepare($conexion, $consulta);
mysqli_stmt_bind_param($stmt, 's', $email);
mysqli_stmt_execute($stmt);
$resultado = mysqli_stmt_get_result($stmt);

if ($resultado && mysqli_num_rows($resultado) > 0) {
    $usuario = mysqli_fetch_assoc($resultado);
    // Verificar contraseña
    if (password_verify($contrasena, $usuario['contraseña'])) {
        // Guardar el nombre del usuario en la sesión
        $_SESSION['nombre_usuario'] = $usuario['nombre'];
        // Redirigir al inicio si es correcto
        header("Location: ../prueba10.php");
        exit;
    } else {
        echo 'La contraseña es incorrecta.';
    }
} else {
    echo 'El usuario no existe.';
}

// Cerrar conexión
mysqli_close($conexion);
?>
