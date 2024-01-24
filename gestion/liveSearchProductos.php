<?php
$q = $_GET['q'];
$provedor = $_GET['p'];
include('conexion.php');

if ($provedor == '' && $q != '') { //si provedor es vacio y nombre tiene algo
  //busqueda por nombre
  $sql = "SELECT * FROM productos WHERE nombre LIKE '%".$q."%'";
} else {
  if ($provedor != '' && $q == '') { //si provedor tiene algo y nombre es vacio
    //busqueda por provedor
    $sql = "SELECT * FROM productos WHERE provedor LIKE '%".$provedor."%'";
  } else {
    if($q == '' && $provedor == ''){ //si provedor y nombre es vacio 
      $sql = "SELECT * FROM productos";
    }else{
      $sql = "SELECT * FROM productos WHERE nombre LIKE '%".$q."%' AND provedor LIKE '%".$provedor."%'";
    }
  }
}

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
  if ($productosLive['imagen'] != null) {
    echo "<td><img src='".$productosLive['imagen']."' width='15%' height='15%'></td>";
  }
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
  if ($fila['imagen'] == 'imagen') {
    echo "<td><img src='".$fila['imagen']."' width='15%' height='15%'></td>";
  }
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

mysqli_close($conexion);
?>
</body>
</html>