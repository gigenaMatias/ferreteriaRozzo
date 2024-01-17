<?php
include('conexion.php');

$id = $_POST['id'];
$nombre = $_POST['nombre'];
$cantidad = $_POST['cantidad'];
$divisible = $_POST['divisible'];
$imagen = $_POST['imagen'];
$provedor = $_POST['provedor'];
$tipoDeImagen = strtolower(pathinfo($imagen,PATHINFO_EXTENSION));
rename($imagen,'imgSubida/'.$nombre.'.'.$tipoDeImagen);
//consulta para guardar cambios
$consulta = "UPDATE productos SET nombre= '".$nombre."', cantidad= '".$cantidad."', divisible= '".$divisible."' ,
imagen= '".$nombre.'.'.$tipoDeImagen."', provedor= '".$provedor."' WHERE id= ".$id."";
$resultado = mysqli_query($conexion,$consulta);

header("location: productos.php");
?>