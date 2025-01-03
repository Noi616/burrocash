<?php
header('Content-Type: application/json'); // Asegura que las respuestas sean JSON
session_start(); // Inicia la sesión

$conexion = mysqli_connect('localhost', 'root', '', 'burrocash');

// Verificar conexión
if (!$conexion) {
    echo json_encode(['success' => false, 'message' => 'Error al conectar con la base de datos: ' . mysqli_connect_error()]);
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recuperar valores del formulario
    $nombre = $_POST['nombre'] ?? '';
    $email = $_POST['email'] ?? '';
    $contrasena = $_POST['password'] ?? '';
    $APaterno = $_POST['apellidoPaterno'] ?? '';
    $AMaterno = $_POST['apellidoMaterno'] ?? '';
    $telefono = $_POST['telefono'] ?? '';

    // Validar datos obligatorios
    if (empty($nombre) || empty($email) || empty($contrasena) || empty($APaterno) || empty($AMaterno) || empty($telefono) ) {
        echo json_encode(['success' => false, 'message' => 'Error: Todos los campos obligatorios deben ser completados.']);
        exit();
    }

    // Validar formato de correo
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(['success' => false, 'message' => 'Error: El formato del correo electrónico es inválido.']);
        exit();
    }

    // Comprobar si el correo o el usuario ya existen
    $consultaVerificacion = "SELECT * FROM usuario WHERE correo = ?";
    $stmtVerificacion = mysqli_prepare($conexion, $consultaVerificacion);
    mysqli_stmt_bind_param($stmtVerificacion, 's', $email);
    mysqli_stmt_execute($stmtVerificacion);
    $resultadoVerificacion = mysqli_stmt_get_result($stmtVerificacion);

    if (mysqli_num_rows($resultadoVerificacion) > 0) {
        echo json_encode(['success' => false, 'message' => 'Error: El correo ya esta registrado.']);
        exit();
    }

    // Cifrado de contraseña
    $contrasenaCifrada = password_hash($contrasena, PASSWORD_BCRYPT);

    // Insertar datos en la base de datos
    $stmt = mysqli_prepare($conexion, "INSERT INTO usuario (nombre, correo, contraseña, apellido_paterno, apellido_materno, numero_telefono) VALUES (?, ?, ?, ?, ?, ?)");
    mysqli_stmt_bind_param($stmt, 'ssssss', $nombre, $email, $contrasenaCifrada, $APaterno, $AMaterno, $telefono);
    
    if (mysqli_stmt_execute($stmt)) {
        // Guardar el usuario en la sesión
        $usuarioRegistrado = mysqli_insert_id($conexion);
        $_SESSION['id_usuario'] = $usuarioRegistrado;
        $_SESSION['foto_perfil'] = 'uploads/perfil.jpg'; // Ruta por defecto si no hay foto
        $_SESSION['numero_telefono'] = $telefono;
        $_SESSION['correo'] = $email;
        $_SESSION['nombre'] = $nombre;
        $_SESSION['apellido_paterno'] = $APaterno;
        $_SESSION['apellido_materno'] = $AMaterno;


        // Respuesta de éxito
        echo json_encode(['success' => true, 'message' => '¡Registro exitoso!']);
        exit();
    } else {
        echo json_encode(['success' => false, 'message' => 'Error al registrar los datos: ' . mysqli_error($conexion)]);
        exit();
    }

    mysqli_stmt_close($stmt); 
       
} else {
    echo json_encode(['success' => false, 'message' => 'Método no permitido.']);
}

mysqli_close($conexion);
?>