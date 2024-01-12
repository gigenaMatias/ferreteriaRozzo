<?php
include('../conexion.php');

$id = $_POST['idProducto'];

print_r($id); //debug

$sql = "DELETE * FROM productos WHERE id = $id";
$resultado = mysqli_query($conexion, $sql);

print_r($resultado);


?>