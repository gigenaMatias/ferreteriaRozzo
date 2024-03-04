<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="../css/style.css">
  <link rel="icon" type="image/x-icon" href="../imagenes/iconos/ferreteria.ico">
  <title>Modificar productor</title>
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

$idProvedor = $_POST['idP'];

$sql = "SELECT * FROM provedor WHERE id='".$idProvedor."'";
$resultado = mysqli_query($conexion, $sql);

//impresion de productos
if (mysqli_num_rows($resultado) > 0) { 
    // output de datos
    while($fila = mysqli_fetch_assoc($resultado)) {
      echo 
       "<form action='guardarCambiosProvedor.php' method='post'>".
            "<input hidden type='number' name='id' value='".$fila["id"]."'>". //id de referencia
            "nombre: <input required name='nombre' type='text' value='".$fila["nombre"]."'><br>".  
            "<button type='submit'>Guardar Cambios</button>
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
