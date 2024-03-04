<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <link rel="icon" type="image/x-icon" href="../imagenes/iconos/ferreteria.ico">
    <title>Tabla Proveedores</title>
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
      if($_SESSION["usuario"]!= "admin"){
        header("Location: gestion/iniciarSesion.php");
      }
      else{
        echo "<h2>Sesión de ".$_SESSION["usuario"]."</h2>";
      }
    }
?>
</header>
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
        <button><a href='crearProvedor.php' class='vuelta'>Crear Provedor</a></button>
        <br>
        <br>

<footer>
<button><a href='../index.php' class='vuelta'>Volver a Home</a></button>
  <button><a href='cerrarSesion.php' class='vuelta'>Cerrar Sesion</a></button>
</footer>
</body>        
</html>