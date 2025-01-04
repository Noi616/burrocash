<?php
session_start();

// Verificar si el usuario está autenticado
if (!isset($_SESSION['id_usuario'])) {
    header("Location: login.php");
    exit();
}

// Conexión a la base de datos (sustituye `conexion.php`)
$conn = new mysqli('localhost', 'root', '', 'burrocash'); // Cambia las credenciales según sea necesario
if ($conn->connect_error) {
    die("Error al conectar con la base de datos: " . $conn->connect_error);
}


// Verificar si se enviaron los datos del formulario
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'] ?? null;
    $apellido_paterno = $_POST['apellido_paterno'] ?? null;
    $apellido_materno = $_POST['apellido_materno'] ?? null;
    $email = $_POST['correo'] ?? null;
    $telefono = $_POST['telefono'] ?? null;
    $foto_perfil = $_FILES['foto_perfil'] ?? null;

    // Validación básica
    if (empty($nombre) || empty($email)) {
        die("Error: Los campos obligatorios deben estar completos.");
    }

    // Procesar la foto de perfil si fue subida
    if ($foto_perfil && $foto_perfil['error'] == 0) {
        $target_dir = "uploads/"; // Carpeta donde se guardarán las fotos
        $file_name = basename($foto_perfil['name']);
        $target_file = $target_dir . uniqid() . "_" . $file_name; // Nombre único para evitar conflictos
        $image_file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Validar tipo de archivo
        $valid_extensions = ['jpg', 'jpeg', 'png'];
        if (!in_array($image_file_type, $valid_extensions)) {
            die("Error: Solo se permiten archivos JPG, JPEG y PNG.");
        }

        // Mover el archivo subido
        if (!move_uploaded_file($foto_perfil['tmp_name'], $target_file)) {
            die("Error al subir la foto de perfil.");
        }

        // Actualizar la sesión con la nueva foto
        $_SESSION['foto_perfil'] = $target_file;
    } else {
        $target_file = $_SESSION['foto_perfil']; // Usar la foto anterior si no se subió una nueva
    }

    // Actualizar la base de datos
    $query = "UPDATE usuario SET 
              nombre = ?, 
              apellido_paterno = ?, 
              apellido_materno = ?, 
              correo = ?, 
              numero_telefono = ?, 
              foto_perfil = ? 
              WHERE id_usuario = ?";

    $stmt = $conn->prepare($query);
    $stmt->bind_param(
        "ssssssi",
        $nombre,
        $apellido_paterno,
        $apellido_materno,
        $email,
        $telefono,
        $target_file,
        $_SESSION['id_usuario']
    );

    if ($stmt->execute()) {
        // Actualizar variables de sesión
        $_SESSION['nombre'] = $nombre;
        $_SESSION['apellido_paterno'] = $apellido_paterno;
        $_SESSION['apellido_materno'] = $apellido_materno;
        $_SESSION['correo'] = $email;
        $_SESSION['telefono'] = $telefono;

        header("Location: ../perfil.php?mensaje=actualizado");

        exit();
    } else {
        die("Error al actualizar el perfil: " . $stmt->error);
    }
}
?>
