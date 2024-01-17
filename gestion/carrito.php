<?php

$mysqli = new mysqli("localhost", "root","", "ferreteriarozzo");
if($mysqli->connect_error) {
  exit('sin conexion a la base de datos');
}

$sql = "SELECT * FROM productos WHERE id = ?";

$stmt = $mysqli->prepare($sql);
$stmt->bind_param("s", $_GET['q']);
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($id, $nombre, $cantidad, $divisible, $imagen, $valor, $provedor);
$stmt->fetch();
$stmt->close();


echo "<table>";
echo "<th>ID del producto</th>";
echo "<th>Cantidad</th>";
echo "<th>Nombre</th>";
echo "<th>divisible</th>";
echo "<th>Imagen</th>";
echo "<th>Valor</th>";
echo "<th>Provedor</th>";
echo "<tr>";
echo "<td>" . $id . "</td>";
echo "<td>" . $nombre . "</td>";
echo "<td>" . $cantidad . "</td>";
echo "<td>" . $divisible . "</td>";
echo "<td>" . $imagen . "</td>";
echo "<td>" . $valor . "</td>";
echo "<td>" . $provedor . "</td>";
echo "</tr>";
echo "</table>";
?>