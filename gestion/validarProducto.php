<?php
    include("conexion.php");
    
    $nombre= mysqli_real_escape_string($conexion, $_POST['nombre']);
    $cantidad= mysqli_real_escape_string($conexion, $_POST['cantidad']);
    $divisible= mysqli_real_escape_string($conexion, $_POST['divisible']);
    $provedor= mysqli_real_escape_string($conexion, $_POST['provedor']);

    $carpetaDestino = "imgSubida/";
    $id= 1; //definimos un nombre nuevo para el archivo
    $archivo = $carpetaDestino . basename($_FILES["archivoAsubir"]["name"]); //recibimos el archivo completo con nombre y extension para concatenarlo con la carpeta destino
    $subio = 1;
    $tipoDeImagen = strtolower(pathinfo($archivo,PATHINFO_EXTENSION)); //devuelve el tipo de extension del archivo
    
    //var_dump($carpetaDestino.$id.".".$tipoDeImagen); //ver la carpeta destino, el nuevo nombre y la extension del archivo.
    
    // Chequea si el archivo es una imagen
    if(isset($_POST["submit"])) {
      $check = getimagesize($_FILES["archivoAsubir"]["tmp_name"]);
      if($check !== false) {
        $subio = 1;
      } else {
        echo "El archivo no es una imagen.";
        $subio = 0;
      }
    }
    
    // Chequea si el archivo existe
    if (file_exists($archivo)) {
      echo "El archivo \"". htmlspecialchars( basename( $_FILES["archivoAsubir"]["name"]))."\"  ya existe";
      $subio = 0;
    }
    
    // si subio esta en 0, los criterios de la imagen no ocurrieron
    if ($subio == 0) {
      echo ", no fue subido.";
    // si todo esta ok, trata de subir el archivo
    } else {
      if (move_uploaded_file($_FILES["archivoAsubir"]["tmp_name"], $carpetaDestino.$id.".".$tipoDeImagen)) { //movemos el archivo desde memoria a una carpeta destino, reescribimos su nombre, le agregamos "." y su extension al final
        echo "El archivo ". htmlspecialchars( basename( $_FILES["archivoAsubir"]["name"])). " fue subido como:  \"".$id.".".$tipoDeImagen."\""; //mensaje de subida con el nuevo nombre
      } else {
        echo "Hubo un error subiendo tu archivo.";
      }
    }
    
    //si quisieramos guardar la url de la imagen para subirla a una BD, deberiamos usar $carpetaDestino.$id."."$tipoDeImagen , todas esta linea como tipo STRING
    ?>


        $imagen = "$carpetaDestino"."$id"."."."$tipoDeImagen";
        $sql_insert = "INSERT INTO productos (nombre,cantidad,divisible,imagen,provedor)
        VALUES ('$nombre','$cantidad','$divisible','$imagen','$provedor');";
        $query= mysqli_query($conexion,$sql_insert);
    $sql_verify = "SELECT nombre FROM productos WHERE nombre = '$nombre'";
    $querys = mysqli_query($conexion,$sql_verify);
    if (mysqli_num_rows($querys) == 0){
        
        //header('Location:productos.php');
    }
    else{
        //header('Location:crearProducto.php');
    }
?>