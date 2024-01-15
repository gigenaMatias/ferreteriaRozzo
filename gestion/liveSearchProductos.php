<?php
$q = $_GET['q'];
include('conexion.php');

$sql="SELECT * FROM productos WHERE nombre LIKE '%".$q."%'";
$result = mysqli_query($conexion,$sql);

$row = mysqli_fetch_assoc($result);

//print_r($row["nombre"]);

echo " <table>
       <tr>
        <th>Nombre</th>
        <th>divisible</th>
        <th>imagen</th>
        <th>provedor</th>
       </tr>";

while($row = mysqli_fetch_assoc($result)) {
    print_r($row["nombre"]);
  echo "<tr>";
  echo "<td>" . $row["nombre"] . "</td>";
  echo "<td>" . $row["divisible"] . "</td>";
  echo "<td>" . $row["imagen"] . "</td>";
  echo "<td>" . $row["provedor"] . "</td>";
  echo "</tr>";
}
echo "</table>";
mysqli_close($conexion);
?>
</body>
</html>