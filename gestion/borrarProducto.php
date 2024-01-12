<?php
include('../conexion.php');

$id = $_POST['idProducto'];

$sql = "DELETE FROM productos WHERE id = '".$id."'";
$resultado = mysqli_query($conexion, $sql);

header("location: productos.php"); //redireccion a productos

?>