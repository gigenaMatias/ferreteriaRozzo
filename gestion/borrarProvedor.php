<?php
include('conexion.php');

$id = $_POST['idP'];

$sql = "DELETE FROM provedor WHERE id = '".$id."'";
$resultado = mysqli_query($conexion, $sql);

header("location: tablaProvedores.php"); //redireccion a tabla provedor

?>