<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $income = $_POST['income'];
    $expenses = $_POST['expenses'];

    $sql = "INSERT INTO presupuestos (nombre, descripcion, monto, fecha_inicio, fecha_fin, categoria_id)
            VALUES ('Presupuesto General', 'Presupuesto mensual', $income - $expenses, NOW(), DATE_ADD(NOW(), INTERVAL 1 MONTH), 1)";

    if ($conn->query($sql) === TRUE) {
        echo "Nuevo presupuesto creado correctamente";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>
