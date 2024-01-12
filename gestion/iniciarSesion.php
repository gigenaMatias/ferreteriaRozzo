<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
        <a href="registrarUsuario.php">Registrarse</a>
        <br>
        <a href="../index.php">Volver al home</a>   
    </form>
</body>
</html>