<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="../css/style.css">
  <link rel="icon" type="image/x-icon" href="../imagenes/iconos/ferreteria.ico">
  <title>Modificar Producto</title>
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
<?php
include('conexion.php');

$id = $_GET['id'];

$sql = "SELECT * FROM productos WHERE id='".$id."'";
$resultado = mysqli_query($conexion, $sql);
$consultaProvedores = "SELECT * FROM provedor";
$resultadoProvedores = mysqli_query($conexion,$consultaProvedores);
//impresion de productos
if (mysqli_num_rows($resultado) > 0) { 
    // output de datos
    while($fila = mysqli_fetch_assoc($resultado)) {
      echo 
       "<form action='guardarCambiosProducto.php' method='post'>".
            "<input hidden type='number' name='id' value='".$fila["id"]."'>". //id de referencia
            "nombre: <input required name='nombre' type='text' value='".$fila["nombre"]."'><br>".
            "valor: <input required name='valor' type='text' value='".$fila["valor"]."'><br>".
            "cantidad <input required name='cantidad' type='text' value='".$fila["cantidad"]."'><br>".
            "divisible?:
                <input required type='radio' id='verdad' name='divisible' value='1'>
                  <label for='verdad'>Si</label>
                <input required type='radio' id='falso' name='divisible' value='0'>
                  <label for='falso'>No</label><br>".
            "<input hidden name='imagen' type='text' value='".$fila["imagen"]."'>".
           
           //select provedores
            "<label for='provedor'>Provedor: </label>";
            echo "<select name='provedor' id='selectorProvedor'>";
            while ($provedores = mysqli_fetch_assoc($resultadoProvedores)) {
              echo "<option value='".$provedores['nombre']."'>".$provedores['nombre']."</option>";
            }
            echo "</select><br>";
            echo "<button type='submit'>Guardar Cambios</button>
        </form>";
    }
  } else {
    echo "Sin resultados";
  }
  
mysqli_close($conexion);


?>
<footer>
  <button><a href='../index.php' class='vuelta'>Volver a Home</a></button>
  <button><a href='cerrarSesion.php' class='vuelta'>Cerrar Sesion</a></button>
</footer>
</body>
</html>
