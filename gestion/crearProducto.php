<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>registrar usuario</title>
</head>
<body>
	<form action="validarProducto.php" method="POST" enctype="multipart/form-data">
        Nombre: <input required name='nombre' type='text'><br>
        Valor: <input required name='valor' type='text'><br>
        Cantidad: <input required name='cantidad' type='number'><br>
        Divisible: <input required type='radio' id='verdad' name='divisible' value='1'>
                  <label for='verdad'>Si</label>
                <input required type='radio' id='falso' name='divisible' value='0'>
                  <label for='falso'>No</label><br>
        Imagen:  <input type="file" name="archivoAsubir" id="archivoAsubir">
        <br><br><br>
        Provedor: <select name='provedor' id='selectorProvedor'>
        <?php 
        include('conexion.php');
        $consultaProvedores = "SELECT * FROM provedor";
        $resultadoProvedores = mysqli_query($conexion,$consultaProvedores);
        while ($provedores = mysqli_fetch_assoc($resultadoProvedores)) {
              echo "<option value='".$provedores['nombre']."'>".$provedores['nombre']."</option>";
            }
            echo "</select><br>";
        ?>
    <button type='submit'>Crear Producto</button>
    <a href='../index.php' class='vuelta'>Volver a Home</a>
	</form>
</body>
</html>