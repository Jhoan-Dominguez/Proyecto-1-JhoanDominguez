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

if(isset($_POST['opcion'])){
    //funciones principales
    if($_POST['opcion'] == 'iniciarSesion'){
        inciarSesion();
    }
    if($_POST['opcion'] == 'crearCuenta'){
        crearCuenta();
    }

    //funciones asociadas al cliente
    if($_POST['opcion'] == 'comprarProducto'){
        comprarProducto();
    }

}

function comprarProducto(){
    
    if(isset( $_SESSION['usuario']) && isset($_POST['idProducto']) && isset($_POST['idUsuario'])
    && isset($_POST['tienda']) && isset($_POST['idCliente']) && isset($_POST['cantidad'])
    && isset($_POST['cantidadOtro']) && isset($_POST['entrega']) ){
        
        $idProducto = $_POST['idProducto'];
        $idUsuario = $_POST['idUsuario'];
        $tienda = $_POST['tienda'];
        $idCliente = $_POST['idCliente'];
        $cantidad = $_POST['cantidad'];
        $cantidadOtro = $_POST['cantidadOtro'];
        $entregaBOOL = $_POST['entrega'];
        $valorTotal = 0;

        $producto = new producto();
        $producto = $producto -> consultarProducto($idProducto);

        $cliente = new cliente();
        $cliente = $cliente -> consultarCliente( $idUsuario );

        if($cantidad == 'otro'){
            $valorTotal = $producto[0] -> getvalor_producto() * $cantidadOtro;
            $cantidad = $cantidadOtro;
        }else{
            $valorTotal = $producto[0] -> getvalor_producto() * $cantidad;
        }
        

        $domiciliario = new domiciliario();
        $domiciliario = $domiciliario -> consultarIdsDomiciliario();
        $indexDomiciliario = rand( 0, count($domiciliario) - 1 );        

        $date = date("Y-m-d");
        $dateEntrega = date("Y-m-d",strtotime($date."+ 5 days")); 
        
        $entrega = new entrega(0, 0, $cliente[0] -> getdireccion_cliente(), intval($valorTotal), $dateEntrega, 
        intval($domiciliario[$indexDomiciliario][0]) );
        $entrega -> crear();

        $idEntrega = $entrega -> consultarTotalFilas();

        $compra = new compra(0, $date, intval($cantidad), intval($entregaBOOL), intval($valorTotal), intval($idUsuario),
        $idEntrega, 1);
        $compra -> crear();
        $idCompra = $compra -> consultarTotalFilas();


        $compraProducto = new compraProducto(0, intval($idCompra), intval($idProducto), intval($cantidad), 
        intval($valorTotal) );
        $compraProducto -> crear();

        $stock = new stock();
        $stock -> actualizarProducto($idProducto, $cantidad);

        echo 1;
    }else{
        echo 0;
    }   
    
}


function inciarSesion(){
    if(isset($_POST['correo']) && isset($_POST['password'])){
        $correo = $_POST['correo'];
        $password = $_POST['password'];
            
        $usuario = new usuario();
        $usuario = $usuario->buscarUsuario($correo, $password);
    
        if($usuario){
            $_SESSION['usuario'] = $usuario;
            echo 1;
        }else{ 
            echo 0;
        }
    }
}

function crearCuenta(){
    $resultado = 0;
    if(isset($_POST['nombre']) && isset($_POST['apellido']) && isset($_POST['direccion']) && isset($_POST['telefono']) 
    && isset($_POST['yearBorn']) && isset($_POST['correo']) && isset($_POST['password'])){
    
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $direccion = $_POST['direccion'];
    $telefono = $_POST['telefono'];
    $yearBorn = $_POST['yearBorn'];
    $correo = $_POST['correo'];
    $password = $_POST['password'];
        
    $usuario = new usuario(0,$correo, $password, 1, 3);
    $usuario -> crear();
    
    $idUsuario = $usuario -> consultarTotalFilas();

    $cliente = new cliente(0,$nombre, $apellido, $direccion, $telefono, $yearBorn, $idUsuario);
    $cliente = $cliente -> crear();
    $resultado = 1;
  }else{
    $resultado = 0;
  }
  echo $resultado;
}

?>
