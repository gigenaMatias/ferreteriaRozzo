<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>productos</title>
</head>
<body>
<form>
  <input id='inputBusqueda' placeholder='Escriba el nombre del producto a buscar' type='text' size='35' onkeyup='showResult(this.value)'>
  <div id='livesearch'></div>

  <?php //carga dinamica SELECT
  include_once('conexion.php');
  $sql = "SELECT * FROM provedor";
  $result = mysqli_query($conexion,$sql);
  $provedores = mysqli_fetch_assoc($result);
  echo "<label for='provedores'>Provedor:</label>";
  echo "<select name='provedores' id='SelectProvedores' onchange='showResult(this.value)'>";
  echo "<option value='' selected >todos los provedores</option>"; //preterminado
    if (mysqli_num_rows($result)> 0){
      echo "<option value='".$provedores['nombre']."'>".$provedores['nombre']."</option>";
      while ($row = mysqli_fetch_assoc($result)) {
        echo "<option value='".$row['nombre']."'>".$row['nombre']."</option>"; //opciones del select
      }
    }else{
      echo "<option value=''>todos</option>"; //sin provedores
    }
  echo "</select>";
  ?>

  </form>
  <br>
  <div id='txtHint'><b>Datos del producto aqui...</b></div>
  <br>
  <button><a href='crearProducto.php' class='vuelta'>Crear Producto</a></button>
  <br>
  <br>
<?php
  include('conexion.php');
  $sql = "SELECT * FROM productos";
  $result = mysqli_query($conexion,$sql);
  
  $productosLive = mysqli_fetch_assoc($result);
  
  echo "<table>
  <tr>
  <th>Nombre</th>
  <th>Cantidad</th>
  <th>Divisible</th>
  <th>Valor</th>
  <th>Provedor</th>
  </tr>";
  if (mysqli_num_rows($result)> 0) {
    echo "<tr>";
    echo "<td>".$productosLive['nombre']."</td>"; //mostrar 1r elemento
    echo "<td>".$productosLive['cantidad']."</td>";
    if ($productosLive['divisible']) {
      echo "<td>si</td>";
    } else {
      echo "<td>no</td>";
    }
    echo "<td>".$productosLive['valor']."</td>";
    echo "<td>".$productosLive['provedor']."</td>";
    echo "<td><form action='modificarProducto.php' method='GET'>
                <input hidden type='number' name='id' value='".$productosLive['id']."'>
                <button type='submit'>Modificar producto</button>
          </form></td>";
    echo "<td><form action='borrarProducto.php' method='POST'>
            <input hidden type='number' name='idProducto' value='".$productosLive['id']."'>
            <input hidden type='text' name='imagen' value='".$productosLive['imagen']."'>
            <button type='submit'>Borrar Producto</button>
        </form></td>";
    echo "</tr>";
  } else {
    echo "<td>Sin</td>";
    echo "<td>Resultados</td>";
  }
  
  while($fila = mysqli_fetch_array($result)) { //mostrar despues del 1er elemento
    echo "<tr>";
    echo "<td>".$fila['nombre']."</td>";
    echo "<td>".$fila['cantidad']."</td>";
    if ($fila['divisible']) {
      echo "<td>si</td>";
    } else {
      echo "<td>no</td>";
    }
    echo "<td>".$fila['valor']."</td>";
    echo "<td>".$fila['provedor']."</td>";
    echo "<td><form action='modificarProducto.php' method='GET'>
                <input hidden type='number' name='id' value='".$fila['id']."'>
                <button type='submit'>Modificar producto</button>
          </form></td>";
  echo "<td><form action='borrarProducto.php' method='POST'>
            <input hidden type='number' name='idProducto' value='".$fila['id']."'>
            <input hidden type='text' name='imagen' value='".$fila['imagen']."'>
            <button type='submit'>Borrar Producto</button>
        </form></td>";
  echo "</tr>";
  }
  echo "</table>";
  
  //busqueda en vivo de productos
?>
  <script>
    function showResult(str) {
      var nombre = document.getElementById('inputBusqueda').value;
      var select = document.getElementById('SelectProvedores').value;
    if (nombre == '' && select == '') {
      document.getElementById('txtHint').innerHTML = '';
      return;
    } else {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById('txtHint').innerHTML = this.responseText;
      }
    };
    xmlhttp.open('GET','liveSearchProductos.php?q='+nombre+"&p="+select,true);
    xmlhttp.send();
  }
}
</script>
  <br>
  <br>
  <a href='../index.php' class='vuelta'>Volver a Home</a>
  <a href='cerrarSesion.php' class='vuelta'>Cerrar Sesion</a>
</body>
</html>
