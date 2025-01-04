<?php
function sugerirLimiteGastos($usuario_id, $conn) {
    $sql = "SELECT AVG(monto_total) as promedio_gastos FROM deudas WHERE id_usuario = $usuario_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $promedioGastos = $row["promedio_gastos"];
        return $promedioGastos * 0.8; // Sugiere el 80% del promedio de gastos
    } else {
        return 0;
    }
}

$usuario_id = 1; // Cambia esto por el ID del usuario actual
$limiteSugerido = sugerirLimiteGastos($usuario_id, $conn);
echo "Límite de gasto sugerido: $limiteSugerido";
?>
