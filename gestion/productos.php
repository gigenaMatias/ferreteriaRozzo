<?php
include('../conexion.php');

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
       " - provedor: " . $fila["provedor"]. //boton modificar
       "<form action='modificarProducto.php' method='post'>
                <button type='submit'>Modificar producto</button>
        </form>
        <form action='borrarProducto.php' method='post'>
            <input hidden type='number' value='".$fila["id"]."'>
            <button type='submit'>Borrar Producto</button>
        </form><br>";
    }
  } else {
    echo "Sin resultados";
  }
  
mysqli_close($conexion);

?>