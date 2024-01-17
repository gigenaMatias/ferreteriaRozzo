<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ventas</title>
</head>
<body>
  
<form>
  <input id='inputBusqueda' placeholder='Escriba el nombre del producto' type='text' size='30' onkeyup='showResult(this.value)'>
  <div id='livesearch'></div>
</form>
<br>
<div id='txtHint'><b>Datos del producto aqui...</b></div>

<br>
<a href='../index.php' class='vuelta'>Volver a Home</a>
<a href='cerrarSesion.php' class='vuelta'>Cerrar Sesion</a>

<div id='carrito'><b>Datos del carrito</b>
  <table id='tablaCarrito'>
    <th>ID del producto</th>
    <th>Cantidad</th>
    <th>Nombre</th>
    <th>divisible</th>
    <th>Imagen</th>
    <th>Valor</th>
    <th>Provedor</th>
    revisar repetidos + calculadora precios
    <tbody id="bodyCarrito">
    <!--productos cargador por AJAX-->
    </tbody>
  </table>
</div>

</body>
</html>

<script>
function showResult(str) {
    if (str == '') {
      document.getElementById('txtHint').innerHTML = '';
      return;
    } else {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById('txtHint').innerHTML = this.responseText;
      }
    };
    xmlhttp.open('GET','buscadorVentas.php?q='+str,true);
    xmlhttp.send();
  }
}

function agregarCarrito(str) { //agregar producto
  var xhttp;
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
    document.getElementById("bodyCarrito").innerHTML += this.responseText;
  }
  };
  xhttp.open("GET", "carrito2.php?q="+str, true);
  xhttp.send();
}

</script>