<?php
    include("conexion.php");

    if(!$conexion)
    {
        echo 'Error en la conexion';
    }
    else
    {
        echo 'Conectado a la base de datos <br>';
    }

    $nombre= mysqli_real_escape_string($conexion, $_POST['nombre']);
    $cantidad= mysqli_real_escape_string($conexion, $_POST['cantidad']);
    $divisible= mysqli_real_escape_string($conexion, $_POST['divisible']);
    $imagen= mysqli_real_escape_string($conexion, $_POST['imagen']);
    $provedor= mysqli_real_escape_string($conexion, $_POST['provedor']);

    $sql_verify = "SELECT nombre FROM productos WHERE nombre = '$nombre'";
    $querys = mysqli_query($conexion,$sql_verify);
    if (mysqli_num_rows($querys) == 0){
        $sql_insert = "INSERT INTO productos (nombre,cantidad,divisible,imagen,provedor)
        VALUES ('$nombre','$cantidad','$divisible','$imagen','$provedor');";
        $query= mysqli_query($conexion,$sql_insert);
        header('Location:productos.php');
    }
    else{
        header('Location:crearProducto.php');
    }
?>