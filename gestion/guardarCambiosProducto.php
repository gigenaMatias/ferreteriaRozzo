<?php
include('conexion.php');

$id = $_POST['id'];
$nombre = $_POST['nombre'];
$cantidad = $_POST['cantidad'];
$divisible = $_POST['divisible'];
$imagen = $_POST['imagen'];
$provedor = $_POST['provedor'];
$sql_verify = "SELECT nombre FROM productos WHERE nombre = '$nombre'";
$querys = mysqli_query($conexion,$sql_verify);
if (mysqli_num_rows($querys) == 0){
    $tipoDeImagen = strtolower(pathinfo($imagen,PATHINFO_EXTENSION));
    rename($imagen,'imgSubida/'.$nombre.'.'.$tipoDeImagen);
    $consulta = "UPDATE productos SET nombre= '".$nombre."', cantidad= '".$cantidad."', divisible= '".$divisible."' ,
    imagen= '".'imgSubida/'.$nombre.'.'.$tipoDeImagen."', provedor= '".$provedor."' WHERE id= ".$id."";
    $resultado = mysqli_query($conexion,$consulta);
    echo'<script type="text/javascript">
    alert("MODIFICADO CORRECTAMENTE");
    window.location.href="productos.php";
    </script>';
}
else{
    echo'<script type="text/javascript">
    alert("NOMBRE REGISTRADO, INGRESE OTRO");
    window.location.href="modificarProducto.php?id='.$id.'";
    </script>';
}

?>