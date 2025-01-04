<?php
// Conexión a la base de datos
$host = "localhost";
$user = "root";
$password = "";
$database = "burrocash";

$conn = new mysqli($host, $user, $password, $database);

// Verificar conexión
if ($conn->connect_error) {
    die("Error en la conexión: " . $conn->connect_error);
}

// Configuración para manejar solicitudes API
header("Content-Type: application/json");

// Verificar el método HTTP
$method = $_SERVER['REQUEST_METHOD'];

// Gestionar operaciones CRUD
switch ($method) {
    case 'GET':
        if (isset($_GET['id_tarjeta'])) {
            // Obtener una tarjeta específica por ID
            $id_tarjeta = $_GET['id_tarjeta'];
            $query = "SELECT * FROM tarjeta WHERE id_tarjeta = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("i", $id_tarjeta);
            $stmt->execute();
            $result = $stmt->get_result();
            $tarjeta = $result->fetch_assoc();
            echo json_encode([$tarjeta]);
        } else {
            // Obtener todas las tarjetas
            $query = "SELECT * FROM tarjeta";
            $result = $conn->query($query);
            $tarjetas = [];
            while ($row = $result->fetch_assoc()) {
                $tarjetas[] = $row;
            }
            echo json_encode($tarjetas);
        }
        break;
    

        case 'POST':
            session_start(); // Asegúrate de que la sesión esté activa
            // Registrar una nueva tarjeta
            if (isset($_POST['numero'], $_POST['tipo'], $_POST['banco'], $_POST['limite'], $_POST['nombre_titular']) && isset($_SESSION['id_usuario'])) {
                $numero = $_POST['numero'];
                $tipo = $_POST['tipo'];
                $banco = $_POST['banco'];
                $limite = $_POST['limite'];
                $nombre_titular = $_POST['nombre_titular'];
                $id_usuario = $_SESSION['id_usuario']; // ID del usuario actual desde la sesión
        
                $query = "INSERT INTO tarjeta (numero, tipo, banco, limite, nombre_titular, id_usuario) VALUES (?, ?, ?, ?, ?, ?)";
                $stmt = $conn->prepare($query);
                $stmt->bind_param("sssisi", $numero, $tipo, $banco, $limite, $nombre_titular, $id_usuario);
        
                if ($stmt->execute()) {
                    // Mostrar mensaje de éxito y redirigir
                    header("Location: ../tarjetas.php?message=Tarjeta agregada exitosamente");
                    exit();
                } else {
                    echo json_encode(["error" => "Error al registrar la tarjeta: " . $stmt->error]);
                }
            } else {
                echo json_encode(["error" => "Faltan campos obligatorios o usuario no autenticado."]);
            }
            break;
        
        

    case 'PUT':
        // Modificar una tarjeta existente
        $data = json_decode(file_get_contents("php://input"), true);
        if (isset($data['id_tarjeta'], $data['numero'], $data['tipo'], $data['banco'], $data['limite'], $data['nombre_titular'])) {
            $id_tarjeta = $data['id_tarjeta'];
            $numero = $data['numero'];
            $tipo = $data['tipo'];
            $banco = $data['banco'];
            $limite = $data['limite'];
            $nombre_titular = $data['nombre_titular'];

            $query = "UPDATE tarjeta SET numero = ?, tipo = ?, banco = ?, limite = ?, nombre_titular = ? WHERE id_tarjeta = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("issisi", $numero, $tipo, $banco, $limite, $nombre_titular, $id_tarjeta);

            if ($stmt->execute()) {
                echo json_encode(["message" => "Tarjeta actualizada exitosamente."]);
            } else {
                echo json_encode(["error" => "Error al actualizar la tarjeta."]);
            }
        } else {
            echo json_encode(["error" => "Faltan campos obligatorios."]);
        }
        break;

    case 'DELETE':
        // Eliminar una tarjeta
        $data = json_decode(file_get_contents("php://input"), true);
        if (isset($data['id_tarjeta'])) {
            $id_tarjeta = $data['id_tarjeta'];
            $query = "DELETE FROM tarjeta WHERE id_tarjeta = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("i", $id_tarjeta);

            if ($stmt->execute()) {
                echo json_encode(["message" => "Tarjeta eliminada exitosamente."]);
            } else {
                echo json_encode(["error" => "Error al eliminar la tarjeta."]);
            }
        } else {
            echo json_encode(["error" => "ID de tarjeta no proporcionado."]);
        }
        break;

    default:
        echo json_encode(["error" => "Método no soportado."]);
        break;
}

$conn->close();
?>
