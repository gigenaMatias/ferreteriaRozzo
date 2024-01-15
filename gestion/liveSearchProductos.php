<?php
$q = $_GET['q'];
include('conexion.php');

$sql = "SELECT * FROM productos WHERE nombre LIKE '%".$q."%'";
$result = mysqli_query($conexion,$sql);

$productosLive = mysqli_fetch_assoc($result);
//print_r($productosLive);

echo "<table>
<tr>
<th>Firstname</th>
<th>Lastname</th>
<th>Age</th>
<th>Hometown</th>
<th>Job</th>
</tr>";
while($row = mysqli_fetch_array($result)) {
  echo "<tr>";
  echo "<td>" . $row['nombre'] . "</td>";
  echo "<td>" . $row['cantidad'] . "</td>";
  echo "<td>" . $row['divisible'] . "</td>";
  echo "<td>" . $row['imagen'] . "</td>";
  echo "<td>" . $row['provedor'] . "</td>";
  echo "</tr>";
}
echo "</table>";

mysqli_close($conexion);
?>
</body>
</html>