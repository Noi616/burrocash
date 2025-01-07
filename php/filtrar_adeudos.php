<?php
$conexion = mysqli_connect('localhost', 'root', '', 'burrocash');
if (!$conexion) {
    die("Conexión fallida: " . mysqli_connect_error());
}

$categoria = isset($_GET['categoria']) ? mysqli_real_escape_string($conexion, $_GET['categoria']) : '';
$estado = isset($_GET['estado']) ? mysqli_real_escape_string($conexion, $_GET['estado']) : '';

$query = "SELECT * FROM registraradeudo WHERE 1";

if (!empty($categoria)) {
    $query .= " AND categoria = '$categoria'";
}

if (!empty($estado)) {
    $query .= " AND estado = '$estado'";
}

$result = $conexion->query($query);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . htmlspecialchars($row['acreedor']) . "</td>
                <td>" . htmlspecialchars($row['monto']) . "</td>
                <td>" . htmlspecialchars($row['fecha']) . "</td>
                <td>" . htmlspecialchars($row['categoria']) . "</td>
                <td>" . htmlspecialchars($row['estado']) . "</td>
                <td>
                    <button onclick=\"registrarSubadeudo(" . $row['id_adeudo'] . ")\">Registrar Subadeudo</button>
                    <button onclick=\"verSubadeudos(" . $row['id_adeudo'] . ")\">Ver Subadeudos</button>
                </td>
                <td>
                    <button onclick=\"editarAdeudo(" . $row['id_adeudo'] . ")\">Editar</button>
                    <button onclick=\"eliminarAdeudo(" . $row['id_adeudo'] . ")\">Eliminar</button>
                </td>
            </tr>
            <tr id=\"subadeudos-" . $row['id_adeudo'] . "\" style=\"display:none;\">
                <td colspan='7'>
                    <table>
                        <thead>
                            <tr>
                                <th>Descripción</th>
                                <th>Monto</th>
                                <th>Fecha</th>
                            </tr>
                        </thead>
                        <tbody id=\"subadeudos-body-" . $row['id_adeudo'] . "\">
                            <!-- Los subadeudos se insertarán aquí -->
                        </tbody>
                    </table>
                </td>
            </tr>";
    }
} else {
    echo "<tr><td colspan='7'>No hay adeudos registrados.</td></tr>";
}

$conexion->close();
?>
