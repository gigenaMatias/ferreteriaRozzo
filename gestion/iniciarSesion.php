<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <link rel="icon" type="image/x-icon" href="../imagenes/iconos/ferreteria.ico">
    <title>Iniciar Sesion</title>
</head>
<body>
    <form action="validarSesion.php" method="POST">
        <h2>Loguearse</h2>
        <div>
            <div>
                <label>Nombre</label>
                <input type="text" name="usuario" required class="form_input">
            </div>

            <div>
                <label>Contraseña</label>
                <input type="password" name="password" required class="form_input">
            </div>
                <button type="submit">Enviar</button>
         </div>
         <br><br>
        

    </form>
<footer>
  <button><a href='../index.php' class='vuelta'>Volver a Home</a></button>
  <button><a href="registrarUsuario.php">Registrarse</a></button>
</footer>
</body>
</html>