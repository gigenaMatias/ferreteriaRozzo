<!DOCTYPE html>
<?php
    session_start();
    include("conexion.php");
    if(empty($_SESSION['usuario'])){
        header("Location:index.php");
    }
    elseif($_SESSION['estado'] != "admin"){
        header("Location:index.php");
    }
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