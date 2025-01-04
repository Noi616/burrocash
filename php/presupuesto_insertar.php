<?php
include 'presupuestos_conexion.php'; // Incluir el archivo de conexión a la base de datos

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $income = $_POST['income'];
    $expenses = $_POST['expenses'];
    $description = $_POST['description'];

    $sql = "INSERT INTO presupuestos (nombre, descripcion, ingresos, gastos, id_categoria, id_usuario)
            VALUES (?, ?, ?, ?, 1, 1)";

    $nombre = 'Presupuesto General';

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssii", $nombre, $description, $income, $expenses);

    if ($stmt->execute() === TRUE) {
        echo "Nuevo presupuesto creado correctamente";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>

