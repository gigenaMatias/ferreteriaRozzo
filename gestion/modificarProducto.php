<?php
include('../conexion.php');

$idProducto = $_POST['idP'];

$sql = "SELECT * FROM productos WHERE id='".$idProducto."'";
$resultado = mysqli_query($conexion, $sql);

//impresion de productos
if (mysqli_num_rows($resultado) > 0) { 
    // output de datos
    while($fila = mysqli_fetch_assoc($resultado)) {
      echo 
       "<form action='guardarCambiosProducto.php' method='post'>".
            "<input hidden type='number' name='id' value='".$fila["id"]."'>". //id de referencia
            "nombre: <input required name='nombre' type='text' value='".$fila["nombre"]."'><br>".
            "cantidad <input required name='cantidad' type='text' value='".$fila["cantidad"]."'><br>".
            "divisible?: <input required name='divisible' type='text' value='".$fila["divisible"]."'><br>".
            "imagen: <input required name='imagen' type='text' value='".$fila["imagen"]."'><br>".
            "provedor: <input required name='provedor' type='text' value='".$fila["provedor"]."'><br>    
            <button type='submit'>Guardar Cambios</button>
        </form>";
    }
  } else {
    echo "Sin resultados";
  }
  
mysqli_close($conexion);


?>