<?php
include('conexion.php');

$id = $_GET['q'];

$sql = "SELECT * FROM productos WHERE id = $id";

$resultado = mysqli_query($conexion,$sql);

$datosProducto = mysqli_fetch_assoc($resultado);

echo "<tr>";
echo "<td>".$datosProducto['id']."</td>";
echo "<td>".$datosProducto['cantidad']."</td>";
echo "<td>".$datosProducto['nombre']."</td>";
if ($datosProducto['divisible']) {
    echo "<td>si</td>";
} else {
    echo "<td>no</td>";
}
echo "<td>".$datosProducto['imagen']."</td>";
echo "<td>".$datosProducto['valor']."</td>";
echo "<td>".$datosProducto['provedor']."</td>";
echo "</tr>";

?>