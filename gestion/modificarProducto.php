<?php
include('conexion.php');

$idProducto = $_POST['idP'];

$sql = "SELECT * FROM productos WHERE id='".$idProducto."'";
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