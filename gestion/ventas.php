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
<br>
<br>
<div id='carrito'><b>Datos del carrito</b>
  <br>
  <br>
  <a>Cantidad puede ser editado!<a>
  <table id='tablaCarrito'>
    <th>ID del producto</th>
    <th>Cantidad</th>
    <th>Nombre</th>
    <th>divisible</th>
    <th>Imagen</th>
    <th>Valor por Paquete o Unidad</th>
    <th>Provedor</th>
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
    //verificarRepetidos(str); funcion comentada (muy bugueada)
  }
  };
  xhttp.open("GET", "carrito.php?q="+str, true);
  xhttp.send();
}

/* (muy bugeado al cargar otros items y repetir uno en la lista)
function verificarRepetidos(id) {
  var elementoCarrito = document.getElementById('elementoCarrito'+id).id;
  var tabla = document.getElementById('tablaCarrito');
  var largoTabla = document.getElementById('tablaCarrito').rows.length;
  if (largoTabla > 1 && elementoCarrito != null) { //si cargo el elemento empieza a recorrer
    var elementList = tabla.querySelectorAll("tr"); //seleccionamos todos los tr en busca de una coincidencia
    for (let i = 0; i < elementList.length; i++) {
      if (elementList[i].id == elementoCarrito) {
        elementList[i].cells[1].innerHTML ++; //aumentamos en 1 la cantidad
      }
    }
  }//borrar el repetido
  if (largoTabla > 1 && elementoCarrito != null) { //si cargo el elemento empieza a recorrer
    var elementList = tabla.querySelectorAll("tr"); //seleccionamos todos los tr en busca de una coincidencia
    var botonItem = document.getElementById('botonCarrito'+id); //boton del repetido
    var aux = false;
    for (let i = 1; i < elementList.length; i++) {
      if (elementList[i].id == elementoCarrito && aux == false) { //buscamos el repetido
        aux = true;
        i++;
        elementList[i].remove();
        botonItem.remove();
      }else{
        console.log("no es el "+i);
      }
    }
  }

}*/

function borrarItemCarrito(id) {
  var nodoTabla = document.getElementById('elementoCarrito'+id);
  var botonItem = document.getElementById('botonCarrito'+id);
  botonItem.remove();
  nodoTabla.parentNode.removeChild(nodoTabla); //elimina la fila con los datos del carrito
}

</script>