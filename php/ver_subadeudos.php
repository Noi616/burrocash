<?php
$conexion = mysqli_connect('localhost', 'root', '', 'burrocash');
if (!$conexion) {
    die("Conexión fallida: " . mysqli_connect_error());
}

$id_adeudo = isset($_GET['id_adeudo']) ? intval($_GET['id_adeudo']) : 0;

if ($id_adeudo > 0) {
    $result = $conexion->query("SELECT * FROM registrarsubadeudo WHERE id_adeudo = $id_adeudo");

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . htmlspecialchars($row['descripcion']) . "</td>
                    <td>" . htmlspecialchars($row['monto']) . "</td>
                    <td>" . htmlspecialchars($row['fecha']) . "</td>
                  </tr>";
        }
    } else {
        echo "<tr><td colspan='3'>No hay subadeudos registrados.</td></tr>";
    }
} else {
    echo "<tr><td colspan='3'>ID de adeudo no válido.</td></tr>";
}

$conexion->close();
?>
