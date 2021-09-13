<?php
require_once "logica/categoria.php";
require_once "logica/producto.php";

  $opcion = 'default';

  if(isset($_GET["opcion"])){
    $opcion = $_GET["opcion"];
  }

  $pid = "";
  if (isset($_GET["pid"])) {
      $pid = base64_decode($_GET["pid"]);
  }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./style.css" type="text/css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.1/css/all.css" />
    <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css"
    rel="stylesheet">
      <script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
    <script 
    src="https://cdn.jsdelivr.net/npm/jquery@3.2.1/dist/jquery.min.js"></script>	

</head>
<body>
    
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="container-fluid">
        <a class="navbar-brand" href="./index.php">SPORT-SP</a>
        
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" onClick="cambiarPagina" href="./index.php">Home</a>
            </li>
            <li class="nav-item dropdown">

              <select class="nav-link dropdown-toggle" style="border: none" id="opcion">
              <option value="default" <?php if($opcion=='default') echo "selected"?> > Opciones </option>
              <option value="insertar" <?php if($opcion=='insertar') echo "selected"?> >Insertar</option>
              <option value="consultar" <?php if($opcion=='consultar') echo "selected"?> >Consultar</option>
							</select>
              
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <div class="div-body">
      <h1 style=" font-family: 'Brush Script MT', cursive; ">Bienvenido a SPORT SHOP</h1>

      <?php
      if ($pid != "" ) {
          include $pid;
      } else {
      if ($opcion && $opcion=='default') {
        ?>
        <div class="body-imagen"></div>
        <?php
       }
      else if ($opcion && $opcion=='insertar'){
        include "./presentacion/insert.php";
      }
      else if ($opcion && $opcion=='consultar'){
        include "./presentacion/read.php";
      }
    }?>
      
    </div>

</body>
</html>

<script>
$("#opcion").change(function() {
	let filas = $("#opcion").val();
  if(filas != 'default'){
    let url = "index.php?opcion=" + filas;
	  location.replace(url);
  }else{
    let url = "index.php";
	  location.replace(url);
  }
});
</script>