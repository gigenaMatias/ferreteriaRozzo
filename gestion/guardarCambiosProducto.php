<?php
include('../conexion.php');

$id = $_POST['id'];
$nombre = $_POST['nombre'];
$cantidad = $_POST['cantidad'];
$divisible = $_POST['divisible'];
$imagen = $_POST['imagen'];
$provedor = $_POST['provedor'];

print_r($id);
print_r($nombre);
print_r($cantidad);
print_r($divisible);
print_r($imagen);
print_r($provedor);

//consulta para guardar cambios



?>