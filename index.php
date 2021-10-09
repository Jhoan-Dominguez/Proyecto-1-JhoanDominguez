<?php

  require_once "logica/usuario.php";
  require_once "logica/tipoUsuario.php";
  require_once "logica/tipoProducto.php";
  require_once "logica/tiendaProveedor.php";
  require_once "logica/tienda.php";
  require_once "logica/stock.php";
  require_once "logica/proveedor.php";
  require_once "logica/productoProveedor.php";
  require_once "logica/producto.php";
  require_once "logica/entrega.php";
  require_once "logica/domiciliario.php";
  require_once "logica/compraProducto.php";
  require_once "logica/compraCarrito.php";
  require_once "logica/compra.php";
  require_once "logica/cliente.php";
  require_once "logica/carritoProducto.php";
  require_once "logica/carrito.php";

  session_start();

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
          <?php if(!isset($_SESSION['usuario'])) {?>
          <button class="btn btn-outline-success" id="iniciarSesion" name="iniciarSesion" type="submit" value="iniciarSesion">Iniciar Sesion</button>
          <button class="btn btn-outline-success" id="crearCuenta" name="crearCuenta" type="submit" value="crearCuenta">Crear Cuenta</button>
          <?php }else{
            ?>
            <button class="btn btn-outline-success" id="carrito" name="carrito" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Carrito</button>
            <button class="btn btn-outline-success" id="cerrarSesion" name="cerrarSesion" type="submit" value="cerrarSesion">Cerrar Sesion</button>
          <?php  
          } ?>
        </form>
      </div>
    </div>
  </nav>

  <div class="div-body">

    <?php ?>
    <?php if(!isset($_SESSION['usuario'])) { ?>

    <?php if($opcion == 'default'):?>

    <div>
      <h1 style=" font-family: 'Brush Script MT', cursive; ">Bienvenido a Pronto-Muebles</h1>
        <!-- contenido de la vista principal -->
    </div>
    <?php elseif($opcion == 'iniciarSesion'):?>
    <div>
      <?php include "./presentacion/vistaInicioSesion.php"; ?>     
    </div>
    <?php elseif($opcion == 'crearCuenta'):?>
    <div>
    <?php include "./presentacion/vistaCrearCuenta.php"; ?>   
    </div>
    <?php else:?>
    <div>
      <h1>Error :c</h1>
    </div>
    <?php endif; ?>

    <?php } else{
      $usuario = $_SESSION['usuario'];

      if($usuario[0] -> getid_tipoUsuario() == 1){
        ?>
        <h1>administrador</h1>
        <?php
      }elseif ($usuario[0] -> getid_tipoUsuario() == 2){
          ?>
          <h1>domiciliario</h1>
          <?php
      }elseif ($usuario[0] -> getid_tipoUsuario() == 3){
          ?>
          <h1>cliente</h1>
          <?php include "presentacion/cliente/vistas/paginaGeneral.php" ?> 
          <?php
      }else{
          echo "Error :c";
      }
    } ?>


  </div>

</body>
</html>
<script src="./scripts.js"></script>
<script>

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

  $("#carrito").click(function(e){
    e.preventDefault(); 
  })
 
  $("#cerrarSesion").click(function(e){
    e.preventDefault(); 
    location.replace('presentacion/cerrarSesion.php')
  })

</script>