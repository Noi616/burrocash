<?php
session_start();
header('Content-Type: application/json'); // Asegura que la respuesta sea JSON

// Conexión a la base de datos
$conexion = mysqli_connect('localhost', 'root', '', 'burrocash');

// Verificar conexión
if (!$conexion) {
    echo json_encode(['success' => false, 'message' => 'Error al conectar con la base de datos.']);
    exit();
}

// Recuperar valores del formulario
$email = $_POST['email'] ?? '';
$contrasena = $_POST['password'] ?? '';

// Validar si los campos están completos
if (empty($email) || empty($contrasena)) {
    echo json_encode(['success' => false, 'message' => 'Por favor completa todos los campos.']);
    exit();
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
        // Guardar información del usuario en la sesión
        $_SESSION['id_usuario'] = $usuario['id_usuario'];
        $_SESSION['nombre'] = $usuario['nombre'];
        $_SESSION['apellido_paterno'] = $usuario['apellido_paterno'] ?? ''; // Manejo de valores nulos
        $_SESSION['apellido_materno'] = $usuario['apellido_materno'] ?? '';
        $_SESSION['numero_telefono'] = $usuario['numero_telefono'] ?? '';
        $_SESSION['correo'] = $usuario['correo'];
        $_SESSION['foto_perfil'] = $usuario['foto_perfil'] ?? 'uploads/perfil.png'; // Ruta por defecto si no hay foto
        

        // Respuesta de éxito
        echo json_encode(['success' => true, 'message' => 'Inicio de sesión exitoso.', 'redirect' => './inicio.php']);
        exit();
    } else {
        // Contraseña incorrecta
        echo json_encode(['success' => false, 'message' => 'La contraseña es incorrecta.']);
        exit();
    }
} else {
    // Usuario no encontrado
    echo json_encode(['success' => false, 'message' => 'El usuario no existe.']);
    exit();
}

// Cerrar conexión
mysqli_close($conexion);
?>
