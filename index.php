<!DOCTYPE html>
<?php
    session_start();
    include("conexion.php");
    if(empty($_SESSION["usuario"])){
        header("Location:iniciarSesion.php");
    }
    else{
        echo "conectado admin";
    }
    session_destroy();
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
</body>
</html>