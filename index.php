<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion Ferreteria Rozzo</title>
    <link rel="icon" type="image/x-icon" href="imagenes/iconos/ferreteria.ico">
</head>
<body>
    <!--Menu Navegacion-->
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

</body>
</html>