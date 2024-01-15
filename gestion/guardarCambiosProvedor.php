<?php
include('conexion.php');

$id = $_POST['id'];
$nombre = $_POST['nombre'];

header("location: tablaProvedores.php");
//consulta para guardar cambios
?>