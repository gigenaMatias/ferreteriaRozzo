<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <title>Gestion Ferreteria Rozzo</title>
    <link rel="icon" type="image/x-icon" href="imagenes/iconos/ferreteria.ico">
</head>
<body>
    <header>
    <?php
    session_start();
    include("gestion/conexion.php");
    if(empty($_SESSION["usuario"])){
        header("Location: gestion/iniciarSesion.php");
    }
    else{
        echo "<h2>Bienvenido ".$_SESSION["usuario"]."</h2>";
    }
?>
    </header>
    <!--Menu Navegacion-->
    <div class="menuIndex">
    <ul>
        <li>
            <form action="gestion/ventas.php" method="post">
                <button type="submit">Ventas</button>
            </form> <!--Ventas-->
        </li>
        <li>
            <form action="gestion/credito.php" method="post">
                <button type="submit">Credito</button>
            </form> <!--Credito-->
        </li>
        <li>
            <form action="gestion/productos.php" method="post">
                <button type="submit">Ver Productos</button>
            </form> <!--Ver Productos-->
        </li>
        <li>
            <form action="gestion/provedores.php" method="post">
                <button type="submit">Ver Provedores</button>
            </form> <!--Ver Provedores-->
        </li>
    </ul>
    </div>

<footer>
    <button><a href='gestion/cerrarSesion.php' class='vuelta'>Cerrar Sesion</a></button>
</footer>
</body>
</html>