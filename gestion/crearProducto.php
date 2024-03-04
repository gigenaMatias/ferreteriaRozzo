<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="../css/style.css">
  <link rel="icon" type="image/x-icon" href="../imagenes/iconos/ferreteria.ico">
	<title>Crear producto</title>
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
	<form action="validarProducto.php" method="POST" enctype="multipart/form-data">
        Nombre: <input required name='nombre' type='text'><br>
        Valor: <input required name='valor' type='text'><br>
        Cantidad: <input required name='cantidad' type='number'><br>
        Divisible: <input required type='radio' id='verdad' name='divisible' value='1'>
                  <label for='verdad'>Si</label>
                <input required type='radio' id='falso' name='divisible' value='0'>
                  <label for='falso'>No</label><br>
        Imagen:  <input type="file" name="archivoAsubir" id="archivoAsubir">
        <br><br><br>
        Provedor: <select name='provedor' id='selectorProvedor'>
        <?php 
        include('conexion.php');
        $consultaProvedores = "SELECT * FROM provedor";
        $resultadoProvedores = mysqli_query($conexion,$consultaProvedores);
        while ($provedores = mysqli_fetch_assoc($resultadoProvedores)) {
              echo "<option value='".$provedores['nombre']."'>".$provedores['nombre']."</option>";
            }
            echo "</select><br>";
        ?>
    <button type='submit'>Crear Producto</button>
    <a href='../index.php' class='vuelta'>Volver a Home</a>
	</form>
<footer>
  <button><a href='../index.php' class='vuelta'>Volver a Home</a></button>
  <button><a href='cerrarSesion.php' class='vuelta'>Cerrar Sesion</a></button>
</footer>
</body>
</html>