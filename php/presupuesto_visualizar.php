<?php
$sql = "SELECT * FROM presupuestos";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "Nombre: " . $row["nombre"]. " - Monto: " . $row["monto"]. " - Fecha de Inicio: " . $row["fecha_inicio"]. " - Fecha de Fin: " . $row["fecha_fin"]. "<br>";
    }
} else {
    echo "No hay presupuestos";
}
?>
