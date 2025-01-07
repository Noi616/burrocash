<?php
$conexion = mysqli_connect('localhost', 'root', '', 'burrocash');
if (!$conexion) {
    die("Conexión fallida: " . mysqli_connect_error());
}

$id_adeudo = intval($_POST['id_adeudo']);
$id_categoria = intval($_POST['id_categoria']);
$acreedor = mysqli_real_escape_string($conexion, $_POST['acreedor']);
$descripcion = mysqli_real_escape_string($conexion, $_POST['descripcion']);
$monto = floatval($_POST['monto']);
$fecha = mysqli_real_escape_string($conexion, $_POST['fecha']);

$sql = "INSERT INTO registrarsubadeudo (id_adeudo, id_categoria, acreedor, descripcion, monto, fecha) VALUES ($id_adeudo, $id_categoria, '$acreedor', '$descripcion', $monto, '$fecha')";

if ($conexion->query($sql) === TRUE) {
    echo "Nuevo subadeudo registrado exitosamente.";
} else {
    echo "Error: " . $sql . "<br>" . $conexion->error;
}

$conexion->close();
?>
