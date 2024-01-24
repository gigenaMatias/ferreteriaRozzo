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
<th>Imagen (si esta disponible)</th>
<th></th>
<th></th>
<th></th>"; //boton compra
echo "</tr>";
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
  if ($productosLive['imagen'] != '') {
    echo "<td><img src='".$productosLive['imagen']."' width='15%' height='15%'></td>";
  }else {
    echo "<td></td>";
  }
  echo "<td><input id='cantidadVenta".$productosLive['id']."' required placeholder='ingrese cantidad' type='number'></td>";
  echo "<td><button type='submit' onclick='agregarCarrito(".$productosLive['id'].")'>Agregar al carrito</button></td>";
  echo "</tr>";
} else {
  echo "<td>Sin</td>";
  echo "<td>Resultados</td>";
}

while($row = mysqli_fetch_array($result)) { //mostrar despues del 1er elemento
  echo "<tr>";
  echo "<td>".$row['nombre']."</td>";
  echo "<td>".$row['cantidad']."</td>";
  if ($row['divisible']) {
    echo "<td>si</td>";
  } else {
    echo "<td>no</td>";
  }
  echo "<td>".$row['valor']."</td>";
  echo "<td>".$row['provedor']."</td>";
  if ($row['imagen'] != 'imagen') {
    echo "<td><img src='".$row['imagen']."' width='15%' height='15%'></td>";
  }
  echo "<td><input id='cantidadVenta".$row['id']."' required placeholder='ingrese cantidad' type='number'></td>";
  echo "<td><button type='submit' onclick='agregarCarrito(".$row['id'].")'>Agregar al carrito</button></td>";
  echo "</tr>";

}
echo "</table>";

mysqli_close($conexion);
?>
</body>
</html>