<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ventas</title>
</head>
<body>
  
<form>
  <input id='inputBusqueda' placeholder='Nombre del producto' type='text' size='30' onkeyup='showResult()'>
  <div id='livesearch'></div>

  <?php //carga dinamica SELECT
  include_once('conexion.php');
  $sql = "SELECT * FROM provedor";
  $result = mysqli_query($conexion,$sql);
  $provedores = mysqli_fetch_assoc($result);

  echo "<label for='provedores'>Provedor:</label>";
  echo "<select name='provedores' id='SelectProvedores' onchange='showResult()'>";
  echo "<option value='' selected >todos los provedores</option>"; //preterminado
    if (mysqli_num_rows($result)> 0){
      echo "<option value='".$provedores['nombre']."'>".$provedores['nombre']."</option>";
      while ($row = mysqli_fetch_array($result)) {
        echo "<option value='".$row['nombre']."'>".$row['nombre']."</option>"; //opciones del select
      }
    }else{
      echo "<option value=''>todos</option>"; //sin provedores
    }
  echo "</select>";
  ?>

</form id="formTabla">
  

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
  <table id='tablaCarrito' name="tablaCarrito" style="border: 1px solid;border-collapse: separate;border-spacing: 10px 5px;">
    <th>ID del producto</th>
    <th>Cantidad</th>
    <th>Nombre</th>
    <th>divisible</th>
    <th>Imagen</th>
    <th>Valor por Paquete/Unidad</th>
    <th>Provedor</th>
    <th class="resultado">ResultadoXcantidad</th>
    <tbody id="bodyCarrito"> <!--nombre para POST-->
    <!--productos cargador por AJAX-->
    </tbody>
    <tfoot>
      <tr>
        <td colspan="8">Total</td>
        <td id="totalResult">0</td>
      </tr>
        <tr>
        <td colspan='8'>
        <form action='remito.php' method='POST'>
          <input hidden id="inputJson" name="jsonData" type="text">
            <button type='submit'>ENVIAR</button>
        </td>
      </tr>;
    </tfoot>
  </table>
</div>

</body>
</html>

<script>
function showResult() {
  var nombre = document.getElementById('inputBusqueda');
  var provedor = document.getElementById('SelectProvedores').value;
    if (nombre == '' && provedor == '') {
      document.getElementById('txtHint').innerHTML = '';
      return;
    } else {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById('txtHint').innerHTML = this.responseText;
        
      }
    };
    xmlhttp.open('GET','buscadorVentas.php?q='+nombre.value+'&p='+provedor,true);
    xmlhttp.send();
  }
}

function agregarCarrito(str) { //agregar producto
  var cantidad = document.getElementById('cantidadVenta'+str).value;
  var xhttp;
  var resultado;
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
    document.getElementById("bodyCarrito").innerHTML += this.responseText;
    calcularTotal();
    cargarArreglos();
    }
  };
  xhttp.open("GET", "carrito.php?q="+str+"&c="+cantidad, true);
  xhttp.send();
}

function calcularTotal(){
  let total = 0;
  const tablaCarrito = document.getElementById("tablaCarrito");
  for(let i = 1; i < tablaCarrito.rows.length-2; i++){
    let valorTotal = tablaCarrito.rows[i].cells[7].innerHTML;
    total = total + Number(valorTotal);
  }
  const tdTotal = document.getElementById("totalResult");
  tdTotal.textContent = "$"+total;

  //crear JSON (prueba debug) falta cargar todos los rows recorriendo con la forma de arriba
  let input = document.getElementById("inputJson");
  let id = tablaCarrito.rows[1].cells[0].innerHTML;
  let cantidad = tablaCarrito.rows[1].cells[1].innerHTML;
  let valor = tablaCarrito.rows[1].cells[5].innerHTML;
  
  let productos = '{ "productos" : [' +
        '{ "id":"'+id+
        '", "cantidad":"'+cantidad+
        '", "valor por Paquete/Unidad":"'+valor+
        '"} ]}';
  let objetoprueba = JSON.parse(productos);
  input.value = objetoprueba; //cargar el input para enviarlo por POST
  console.log(objetoprueba); //mostrar JSON

}

function cargarArreglos(){
  let ids = [];
  let cantidades = [];
  const tablaCarrito = document.getElementById("tablaCarrito");
  for(let i = 1; i < tablaCarrito.rows.length-2; i++){
    ids.push = tablaCarrito.rows[i].cells[0].innerHTML;
  }
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
  calcularTotal();
}

</script>