<?php
// Mostrar errores para depuración
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Incluir el archivo de conexión
include 'C:/wamp64/www/burrocash/php/subadeudo_conexion.php';

// Verificar si la conexión se estableció
if ($conexion_subadeudo->connect_error) {
    die("Error: No se estableció la conexión con la base de datos.");
}

// Ejecutar la consulta para obtener los subadeudos
$query = "SELECT * FROM registrarsubadeudo";
$result = $conexion_subadeudo->query($query);

if ($result->num_rows > 0) {
    echo "<table border='1'>";
    echo "<tr><th>ID Subadeudo</th><th>ID Adeudo</th><th>ID Categoría</th><th>Acreedor</th><th>Descripción</th><th>Monto</th><th>Fecha</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['id_subadeudo'] . "</td>";
        echo "<td>" . $row['id_adeudo'] . "</td>";
        echo "<td>" . $row['id_categoria'] . "</td>";
        echo "<td>" . $row['acreedor'] . "</td>";
        echo "<td>" . $row['descripcion'] . "</td>";
        echo "<td>" . $row['monto'] . "</td>";
        echo "<td>" . $row['fecha'] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "No se encontraron subadeudos.";
}

$conexion_subadeudo->close();
?>
