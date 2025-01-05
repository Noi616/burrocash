<?php
// Consulta para obtener los adeudos
$result = $conexion->query("SELECT * FROM registraradeudo");

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row['acreedor'] . "</td>
                <td>" . $row['monto'] . "</td>
                <td>" . $row['fecha'] . "</td>
                <td>" . $row['categoria'] . "</td>
                <td>" . $row['estado'] . "</td>
                <td><button onclick=\"verSubadeudos(" . $row['id'] . ")\">Ver Subadeudos</button></td>
              </tr>";

        // Consulta para obtener los subadeudos relacionados con el id_adeudo actual
        $subadeudos = $conexion->query("SELECT * FROM subadeudos WHERE id_adeudo=" . $row['id']);
        if ($subadeudos->num_rows > 0) {
            echo "<tr>
                    <td colspan='6'>
                        <table>
                            <thead>
                                <tr>
                                    <th>Descripción</th>
                                    <th>Monto</th>
                                    <th>Fecha</th>
                                </tr>
                            </thead>
                            <tbody>";
            while ($subadeudo = $subadeudos->fetch_assoc()) {
                echo "<tr>
                        <td>" . $subadeudo['descripcion'] . "</td>
                        <td>" . $subadeudo['monto'] . "</td>
                        <td>" . $subadeudo['fecha'] . "</td>
                      </tr>";
            }
            echo "</tbody></table></td></tr>";
        }
    }
} else {
    echo "<tr><td colspan='6'>No hay adeudos registrados.</td></tr>";
}
$conexion->close();
?>
