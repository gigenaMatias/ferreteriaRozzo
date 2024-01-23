<?php
include('conexion.php');

$id = $_GET['q'];

$cantidad = $_GET['c'];

if ($cantidad <= 0) {
    $cantidad = 1;
}

$sql = "SELECT * FROM productos WHERE id = $id";

$resultado = mysqli_query($conexion,$sql);

$datosProducto = mysqli_fetch_assoc($resultado);

echo "<tr id=elementoCarrito".$datosProducto['id'].">";
echo "<td style='text-align: center;' >".$datosProducto['id']."</td>";
echo "<td style='text-align: center;' id=cantidadElemento contenteditable='true'>".$cantidad."</td>";
echo "<td style='text-align: right;' >".$datosProducto['nombre']."</td>";
if ($datosProducto['divisible']) {
    echo "<td style='text-align: center;' >si</td>";
} else {
    echo "<td style='text-align: center;' >no</td>";
}
echo "<td>".$datosProducto['imagen']."</td>";
echo "<td style='text-align: center;'>".$datosProducto['valor']."</td>";
echo "<td>".$datosProducto['provedor']."</td>";
echo "<button id=botonCarrito".$datosProducto['id']." onclick='borrarItemCarrito(".$datosProducto['id'].")'>borrar item</button>";
echo "</tr>";


?>