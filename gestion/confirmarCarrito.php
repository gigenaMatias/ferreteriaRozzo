<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <link rel="icon" type="image/x-icon" href="../imagenes/iconos/ferreteria.ico">
    <title>Confirmar Carrito</title>
</head>
<body>
<header>
    <?php
    session_start();
    include("conexion.php");
    if(empty($_SESSION["usuario"])){
        header("Location: gestion/iniciarSesion.php");
    }
    else{
        echo "<h2>Sesión de ".$_SESSION["usuario"]."</h2>";
    }
?>
</header>
<table id='tablaCarrito'>
    <th>ID del producto</th>
    <th>Cantidad</th>
    <th>Nombre</th>
    <th>divisible</th>
    <th>Imagen</th>
    <th>Valor por Paquete/Unidad</th>
    <th>Provedor</th>
    <th class="resultado">ResultadoXcantidad</th>
    <tbody id="bodyCarrito"> <!--nombre para POST-->
        <?php
        include('conexion.php');
        $ids = $_POST['idPro'];
        $arrayIds = explode(',',$ids);
        $cantidades = $_POST['cantPro'];
        $arrayCant = explode(',',$cantidades);
        $i = 0;
        foreach($arrayIds as $id) {
            $consulta = "SELECT * from productos WHERE id='".$id."'";
            $resultado = mysqli_query($conexion,$consulta);
            while($datosProducto = $resultado->fetch_assoc()){
                echo "<tr id=elementoCarrito".$datosProducto['id'].">";
                echo "<td style='text-align: center;' >".$datosProducto['id']."</td>";
                echo "<td style='text-align: center;' id=cantidadElemento>".$arrayCant[$i]."</td>";
                echo "<td style='text-align: center;' >".$datosProducto['nombre']."</td>";
                if ($datosProducto['divisible']) {
                    echo "<td style='text-align: center;' >si</td>";
                } else {
                    echo "<td style='text-align: center;' >no</td>";
                }
                echo "<td>".$datosProducto['imagen']."</td>";
                echo "<td style='text-align: center;'>".$datosProducto['valor']."</td>";
                echo "<td style='text-align: center;'>".$datosProducto['provedor']."</td>";
                echo "<td style='text-align: center;'>".intval($arrayCant[$i])*$datosProducto['valor']."</td>";
                echo "</tr>";
                $i++;
            }
        }
        ?>
    </tbody>
    <tfoot>
        <tr>
        <td colspan='8'>
            <form action="remito.php" method="POST">
            <input hidden type="text" name="idPro" value=<?php echo $_POST['idPro'];?>>
            <input hidden type="text" name="cantPro" value=<?php echo $_POST['cantPro'];?>>
            <button type='submit'>GENERAR PDF</button>
            </form>
            <form action="ventas.php" method="POST">
                <input hidden type="text" name="idPro" value=<?php echo $_POST['idPro'];?>>
                <input hidden type="text" name="cantPro" value=<?php echo $_POST['cantPro'];?>>
                <button type='submit'>CANCELAR</button>
            </form>
        </td>
      </tr>;
    </tfoot>
<footer>
  <button><a href='../index.php' class='vuelta'>Volver a Home</a></button>
  <button><a href='cerrarSesion.php' class='vuelta'>Cerrar Sesion</a></button>
</footer>
</body>
</html>