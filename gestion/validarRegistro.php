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

    //para prevenir mysql injection
    $nombre= mysqli_real_escape_string($conexion, $_POST['Nombre']);
    $dni= mysqli_real_escape_string($conexion, $_POST['DNI']);
    $telefono= mysqli_real_escape_string($conexion, $_POST['Telefono']);
    $contra= mysqli_real_escape_string($conexion, $_POST['password']);


    if($nombre == 'admin')
    {
        $estado = 'administrador';
    }
    else{
        $estado = 'usuario';
    }
      
    $sql_verify = "SELECT nombre FROM usuario WHERE nombre = '$nombre'";
    $querys = mysqli_query($conexion,$sql_verify);
    if (mysqli_num_rows($querys) == 0){
        $sql_insert = "INSERT INTO usuario (nombre,telefono,dni,contra,estado)
        VALUES ('$nombre','$telefono','$dni','$contra','$estado');";
        $query= mysqli_query($conexion,$sql_insert);
        header('Location:iniciarSesion.php');
    }
    else{
        header('Location:registrarUsuario.php');
    }
?>