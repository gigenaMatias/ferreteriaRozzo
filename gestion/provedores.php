<!DOCTYPE html>
<?php
    session_start();
    if(empty($_SESSION['usuario'])){
    header("Location:index.php");
    }
    elseif($_SESSION['estado'] != "administrador")
    {
        header("Location:index.php");
    }
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/tabla.css">
    <title>Tabla Proveedores</title>
</head>
<body>
    <section>
        <?php
        include("conexion.php");
        //consulta de productos
        $sql = "SELECT * FROM provedor";
        $resultado = mysqli_query($conexion, $sql);
        
        //impresion de productos
        if (mysqli_num_rows($resultado) > 0) { 
            // output de datos
            while($fila = mysqli_fetch_assoc($resultado)) {
              echo 
               "id: " . $fila["id"].
               " - nombre: " . $fila["nombre"]. 
               "<form action='modificarProvedor.php' method='POST'>
                    <input hidden type='number' name='idP' value='".$fila["id"]."'>
                    <button type='submit'>Modificar provedor</button>
                </form>
                <form action='borrarProvedor.php' method='POST'>
                    <input hidden type='number' name='idP' value='".$fila["id"]."'>
                    <button type='submit'>Borrar Provedor</button>
                </form><br>";
            }
          } else {
            echo "Sin resultados";
          }
          
        mysqli_close($conexion);
        ?>
    </section>
        <a href='../index.php' class='vuelta'>Volver a Home</a>
        <button><a href='crearProvedor.php' class='vuelta'>Crear Provedor</a></button>
        <a href='cerrarSesion.php' class='vuelta'>Cerrar Sesion</a>
</body>        
</html>