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