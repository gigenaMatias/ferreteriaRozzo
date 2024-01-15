<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>productos</title>
</head>
<body>
<?php
  include('conexion.php');

  //consulta de productos
  $sql = "SELECT * FROM productos";
  $resultado = mysqli_query($conexion, $sql);

  //impresion de productos
  if (mysqli_num_rows($resultado) > 0) { 
      // output de datos
      while($fila = mysqli_fetch_assoc($resultado)) {
        echo 
        "id: " . $fila["id"].
        " - nombre: " . $fila["nombre"]. 
        " - cantidad: " . $fila["cantidad"]. 
        " - divisible: " . $fila["divisible"].
        " - imagen: " . $fila["imagen"].
        " - provedor: " . $fila["provedor"]. //tomar nombre provedor de acuerdo a su id
        "<form action='modificarProducto.php' method='POST'>
              <input hidden type='number' name='idP' value='".$fila["id"]."'>
              <button type='submit'>Modificar producto</button>
          </form>
          <form action='borrarProducto.php' method='POST'>
              <input hidden type='number' name='idProducto' value='".$fila["id"]."'>
              <button type='submit'>Borrar Producto</button>
          </form><br>";
      }
    } else {
      echo "Sin resultados";
    }
    
  mysqli_close($conexion);
?>
  <button><a href='crearProducto.php' class='vuelta'>Crear Producto</a></button>
  <a href='cerrarSesion.php' class='vuelta'>Cerrar Sesion</a>
</body>
</html>
