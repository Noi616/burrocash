    <?php
    session_start();
    $conexion = mysqli_connect('localhost', 'root', '', 'burrocash');

    // Verificar conexión
    if (!$conexion) {
        die('Error al conectar con la base de datos: ' . mysqli_connect_error());
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Recuperar valores del formulario
        $nombre = $_POST['nombre'] ?? '';
        $correo = $_POST['correo'] ?? '';
        $contraseña = $_POST['contraseña'] ?? '';
        $apellido_paterno = $_POST['apellido_paterno'] ?? '';
        $apellido_materno = $_POST['apellido_materno'] ?? '';
        $numero_telefono = $_POST['numero_telefono'] ?? '';

        // Validar datos obligatorios
        if (empty($nombre) || empty($correo) || empty($contraseña) || empty($apellido_paterno)) {
            echo json_encode(['success' => false, 'message' => 'Error: Todos los campos obligatorios deben ser completados.']);
            exit;
        }

        // Validar formato de correo
        if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
            echo json_encode(['success' => false, 'message' => 'Error: El formato del correo electrónico es inválido.']);
            exit;
        }

        // Comprobar si el correo ya existe
        $consultaVerificacion = "SELECT * FROM usuario WHERE correo = ?";
        $stmtVerificacion = mysqli_prepare($conexion, $consultaVerificacion);
        mysqli_stmt_bind_param($stmtVerificacion, 's', $correo);
        mysqli_stmt_execute($stmtVerificacion);
        $resultadoVerificacion = mysqli_stmt_get_result($stmtVerificacion);

        if (mysqli_num_rows($resultadoVerificacion) > 0) {
            echo json_encode(['success' => false, 'message' => 'Error: El correo ya está registrado.']);
            exit;
        }

        // Cifrado de contraseña
        $contraseñaCifrada = password_hash($contraseña, PASSWORD_BCRYPT);

        // Insertar datos en la base de datos
        $stmt = mysqli_prepare($conexion, "INSERT INTO usuario (nombre, apellido_paterno, apellido_materno, numero_telefono, correo, contraseña) VALUES (?, ?, ?, ?, ?, ?)");
        mysqli_stmt_bind_param($stmt, 'ssssss', $nombre, $apellido_paterno, $apellido_materno, $numero_telefono, $correo, $contraseñaCifrada);

        if (mysqli_stmt_execute($stmt)) {
            // Puedes guardar el id del usuario en la sesión si es necesario
            $_SESSION['user_id'] = mysqli_insert_id($conexion);
            // Redirigir al login
            header("Location: ../login.html");
            exit;
        }
        else {
            echo json_encode(['success' => false, 'message' => 'Error al registrar los datos: ' . mysqli_error($conexion)]);
        }

        mysqli_stmt_close($stmt);    
    } else {
        echo json_encode(['success' => false, 'message' => 'Método no permitido.']);
    }

    mysqli_close($conexion);
    ?>
