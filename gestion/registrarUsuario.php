<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <link rel="icon" type="image/x-icon" href="../imagenes/iconos/ferreteria.ico">
	<title>Registrar usuario</title>
</head>
<body>
	<form action="validarRegistro.php" method="POST">
		<input type="text" name="nombre" placeholder="ingrese su Nombre">
        <input type="number" name="dni" placeholder="ingrese su DNI">
        <input type="text" name="contra" placeholder="ingrese su Contraseña">
        <input list="usuarios" name="estado">
        <datalist id="usuarios">
        <option value='usuario'>
        <option value='socio'>
        </datalist>
        <button type="submit">Enviar</button>
	</form>
<footer>
  <button><a href='../index.php' class='vuelta'>Volver a Home</a></button>
  <button><a href="iniciarSesion.php">Loguearse</a></button>
</footer>
</body>
</html>