<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="../css/style.css">
  <link rel="icon" type="image/x-icon" href="../imagenes/iconos/ferreteria.ico">
  <title>Ventas</title>
</head>
<body>
<header>
    <?php
    session_start();
    include("conexion.php");
    if(empty($_SESSION["usuario"])){
        header("Location: gestion/iniciarSesion.php");
    }
    else{
        echo "<h2>Sesión de ".$_SESSION["usuario"]."</h2>";
    }
?>
</header>
<form>
  <input id='inputBusqueda' placeholder='Nombre del producto' type='text' size='30' onkeyup='showResult()'>
  <div id='livesearch'></div>

  <?php //carga dinamica SELECT
  include_once('conexion.php');
  if(isset($_POST['idPro'])){
    $i = 0;
    $ids = $_POST['idPro'];
    $arrayIds = explode(',',$ids);
    $cantidades = $_POST['cantPro'];
    $arrayCant = explode(',',$cantidades);
    foreach($arrayIds as $id) {
      echo "<script>";
      echo "recuperarCarrito(".$id.",".$arrayCant[$i].")";
      echo "</script>";
      $i++;
    }

  }
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

<div id='txtHint'><b>Datos del producto aqui...</b></div>
<div id='carrito'><b>Datos del carrito</b>
  <a>Cantidad puede ser editado!<a>
  <table id='tablaCarrito' name="tablaCarrito">
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
        <form id="formCarrito" action='confirmarCarrito.php' method='POST'>
          <input hidden id="idsPro" type='text' name='idPro' value="">
          <input hidden id="cantsPro" type='text' name='cantPro' value="">
          <button id="enviar" type='submit' disabled="disabled">ENVIAR</button>
        </form>
        </td>
      </tr>;
    </tfoot>
  </table>
</div>
<footer>
  <button><a href='../index.php' class='vuelta'>Volver a Home</a></button>
  <button><a href='cerrarSesion.php' class='vuelta'>Cerrar Sesion</a></button>
</footer>
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

function recuperarCarrito(id,cant){
  document.getElementById('cantidadVenta'+id).value = cant;
  agregarCarrito(id);
}

function agregarCarrito(str) { //agregar producto
  var cantidad = document.getElementById('cantidadVenta'+str).value;
  var xhttp;
  var resultado;
  let repetido = verificarRepetidos(str);;
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
    if(repetido > 0){
      borrarItemCarrito(str);
    }
    document.getElementById("bodyCarrito").innerHTML += this.responseText;
    calcularTotal();
    cargarArreglos();
  }
  };
  console.log(Number(cantidad)+Number(repetido))
  xhttp.open("GET", "carrito.php?q="+str+"&c="+(Number(cantidad)+Number(repetido)), true);
  xhttp.send();
}

function cargarArreglos(){
  const tablaCarrito = document.getElementById("tablaCarrito");
  const idsPro = document.getElementById("idsPro");
  const cantsPro = document.getElementById("cantsPro");
  document.getElementById("enviar").disabled = "disabled";
  var ids = [];
  var cants = [];
  for(let i = 1; i < tablaCarrito.rows.length-2; i++){
    ids[i-1] = tablaCarrito.rows[i].cells[0].innerHTML;
    cants[i-1] = tablaCarrito.rows[i].cells[1].innerHTML;
    document.getElementById("enviar").disabled = false;
  }
  idsPro.value = ids.join();
  cantsPro.value = cants.join();
  //alert(idsPro.value);

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

}

function verificarRepetidos(id){
  let bandera = 0;
  const tablaCarrito = document.getElementById("tablaCarrito");
  for(let i = 1; i < tablaCarrito.rows.length-2; i++){
    let existente = tablaCarrito.rows[i].cells[0].innerHTML;
    if(id == existente){
      bandera = tablaCarrito.rows[i].cells[1].innerHTML;
    }
  }
  return bandera;
}

function borrarItemCarrito(id) {
  var nodoTabla = document.getElementById('elementoCarrito'+id);
  var botonItem = document.getElementById('botonCarrito'+id);
  botonItem.remove();
  nodoTabla.parentNode.removeChild(nodoTabla); //elimina la fila con los datos del carrito
  calcularTotal();
  cargarArreglos();
}

</script>