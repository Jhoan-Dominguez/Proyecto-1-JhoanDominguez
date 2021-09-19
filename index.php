<?php
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
    
  <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #e3f2fd;">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">Pronto Muebles</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarScroll">
        <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="./index.php?">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Nosotros</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Nuestros Proveedores</a>
          </li>
          <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarScrollingDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Categorias
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarScrollingDropdown">
            <li><a class="dropdown-item" href="#">Muebles</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Accesorios de Interiores</a></li>
          </ul>
          </li>
        </ul>
        <form class="d-flex" id="formInicioCrear" action="index.php" method="POST">
          <button class="btn btn-outline-success" onclick="mifunction()" id="iniciarSesion" name="iniciarSesion" type="submit" value="iniciarSesion">Iniciar Sesion</button>
          <button class="btn btn-outline-success" id="crearCuenta" name="crearCuenta" type="submit" value="crearCuenta">Crear Cuenta</button>
        </form>
      </div>
    </div>
  </nav>

  <div class="div-body">

    <?php ?>
    <?php ?>

    <?php if($opcion == 'default'):?>

    <div>
      <h1 style=" font-family: 'Brush Script MT', cursive; ">Bienvenido a Pronto-Muebles</h1>
        <!-- contenido de la vista principal -->
    </div>
    <?php elseif($opcion == 'iniciarSesion'):?>
    <div>
      <?php include "./presentacion/inicioSesion.php"; ?>     
    </div>
    <?php elseif($opcion == 'crearCuenta'):?>
    <div>
    <?php include "./presentacion/crearCuenta.php"; ?>   
    </div>
    <?php else:?>
    <div>
      <h1>Error :c</h1>
    </div>
    <?php endif; ?>

  </div>

</body>
</html>

<script>

  // function mifunction(){
  //   location.replace("index.php?opcion=");
  // }

  $("#iniciarSesion").click(function(e){
    let opcion = $(this).val();
    let url = "index.php?opcion=" + opcion;
    location.replace(url);
    e.preventDefault(); 
  })

  $("#crearCuenta").click(function(e){
    let opcion = $(this).val();
    let url = "index.php?opcion=" + opcion;
    location.replace(url);
    e.preventDefault(); 
  })

</script>