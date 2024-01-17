<?php
$q = $_GET['q'];
include('conexion.php');

$sql = "SELECT * FROM productos WHERE nombre LIKE '%".$q."%'";
$result = mysqli_query($conexion,$sql);

$productosLive = mysqli_fetch_assoc($result);

echo "<table>
<tr>
<th>Nombre</th>
<th>Cantidad</th>
<th>Divisible</th>
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
  echo "<td>".$productosLive['provedor']."</td>";
  echo "</tr>";
} else {
  echo "<td>no</td>";
  echo "<td>hay</td>";
  echo "<td>productos</td>";
  echo "<td>disponibles</td>";
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
  echo "<td>".$row['provedor']."</td>";
  echo "</tr>";
}
echo "</table>";

mysqli_close($conexion);
?>
</body>
</html>