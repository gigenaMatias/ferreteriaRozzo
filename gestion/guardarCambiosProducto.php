<?php
include('conexion.php');

$id = $_POST['id'];
$nombre = $_POST['nombre'];
$cantidad = $_POST['cantidad'];
$divisible = $_POST['divisible'];
$imagen = $_POST['imagen'];
$provedor = $_POST['provedor'];

//consulta para guardar cambios
$consulta = "UPDATE productos SET nombre= '".$nombre."', cantidad= '".$cantidad."', divisible= '".$divisible."' ,
imagen= '".$imagen."', provedor= '".$provedor."' WHERE id= ".$id."";
$resultado = mysqli_query($conexion,$consulta);

header("location: productos.php");
?>