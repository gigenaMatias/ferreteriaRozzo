<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="../css/style.css">
	<link rel="icon" type="image/x-icon" href="../imagenes/iconos/ferreteria.ico">
	<title>Crear provedor</title>
</head>
<body>
<header>
    <?php
    session_start();
    include("conexion.php");
    if(empty($_SESSION["usuario"])){
        header("Location: gestion/iniciarSesion.php");
    }
    else{
      if($_SESSION["usuario"]!= "admin"){
        header("Location: gestion/iniciarSesion.php");
      }
      else{
        echo "<h2>Sesión de ".$_SESSION["usuario"]."</h2>";
      }
    }
?>
</header>
	<form action="validarProvedor.php" method="POST">
		<input required type="text" name="nombre" placeholder="ingrese su Nombre">
        <button type="submit">Enviar</button>
	</form>
<footer>
  <button><a href='../index.php' class='vuelta'>Volver a Home</a></button>
  <button><a href='cerrarSesion.php' class='vuelta'>Cerrar Sesion</a></button>
</footer>
</body>
</html>