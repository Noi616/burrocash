<?php
include 'presupuestos_conexion.php'; // Incluir el archivo de conexión a la base de datos

$sql = "SELECT id_presupuesto, ingresos, gastos, descripcion FROM presupuestos WHERE id_usuario = 1"; // Cambia el ID del usuario según corresponda
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $income = $row["ingresos"];
        $expenses = $row["gastos"];
        $balance = $income - $expenses;
        echo "<tr>
                <td>" . $row["id_presupuesto"] . "</td>
                <td>" . $income . "</td>
                <td>" . $expenses . "</td>
                <td>" . $balance . "</td>
                <td>" . $row["descripcion"] . "</td>
              </tr>";
    }
} else {
    echo "<tr><td colspan='5'>No hay presupuestos</td></tr>";
}
?>
