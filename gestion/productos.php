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
     //  "<img src='".$fila["imagen"]."'><br>".
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
  
  //busqueda en vivo de productos

  echo"
  
  <script>
    function showResult(str) {
    if (str == '') {
      document.getElementById('txtHint').innerHTML = '';
      return;
    } else {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById('txtHint').innerHTML = this.responseText;
      }
    };
    xmlhttp.open('GET','liveSearchProductos.php?q='+str,true);
    xmlhttp.send();
  }
}
</script>

  <form>
  <input type='text' size='30' onkeyup='showResult(this.value)'>
  <div id='livesearch'></div>
  </form>
  <br>
  <div id='txtHint'><b>Datos del producto aqui...</b></div>'";

mysqli_close($conexion);

?>