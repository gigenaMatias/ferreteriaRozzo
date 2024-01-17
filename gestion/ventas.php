<?php

  //busqueda en vivo de productos

  echo"
  
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
</script>

  <form>
  <input id='inputBusqueda' placeholder='Escriba el nombre del producto' type='text' size='30' onkeyup='showResult(this.value)'>
  <div id='livesearch'></div>
  </form>
  <br>
  <div id='txtHint'><b>Datos del producto aqui...</b></div>";

?>
<br>
<a href='../index.php' class='vuelta'>Volver a Home</a>
<a href='cerrarSesion.php' class='vuelta'>Cerrar Sesion</a>