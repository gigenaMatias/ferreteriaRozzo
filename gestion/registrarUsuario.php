<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>registrar usuario</title>
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
</body>
</html>