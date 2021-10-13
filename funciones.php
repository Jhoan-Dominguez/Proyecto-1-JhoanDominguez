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

    if($_POST['opcion'] == 'addProducto'){
        addProducto();
    }

    if($_POST['opcion'] == 'eliminarCarritoProducto'){
        eliminarCarritoProducto();
    }

    if($_POST['opcion'] == 'actualizarModalCarrito'){
        actualizarModalCarrito();
    }

    if($_POST['opcion'] == 'compraCarrito'){
        compraCarrito();
    }
    
    if($_POST['opcion'] == 'actualizarDatos'){
        actualizarDatos();
    }

    if($_POST['opcion'] == 'actualizarEStado'){
        actualizarEStado();
    }

    //funciones asociadas al administrador
    if($_POST['opcion'] == 'crearNuevoProducto'){
        crearNuevoProducto();
    }

    if($_POST['opcion'] == 'crearNuevoDomiciliario'){
        crearNuevoDomiciliario();
    }

    if($_POST['opcion'] == 'actualizarGraphicAndTableStock'){
        actualizarGraphicAndTableStock();
    }

    if($_POST['opcion'] == 'drawPieChartCliente'){
        drawPieChartCliente();
    }

    if($_POST['opcion'] == 'comprarProductoStock'){
        comprarProductoStock();
    }
    
}

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

function obtenerDomiciliarioAleatorio(){
    $domiciliario = new domiciliario();
    $domiciliario = $domiciliario -> consultarIdsDomiciliario();
    $indexDomiciliario = 0;
    $idDomiciliario = 0;

    if($domiciliario){
        $indexDomiciliario = rand( 0, count($domiciliario) - 1 );
        $idDomiciliario = $domiciliario[$indexDomiciliario][0];
    }
    return $idDomiciliario;
}

function idNuevaEntrega($direccionCliente, $valorTotal, $dateEntrega, $idDomiciliario){
    $entrega = new entrega(0, 0, $direccionCliente, intval($valorTotal), $dateEntrega, 
    intval($idDomiciliario) );
    $entrega -> crear();

    $idEntrega = $entrega -> consultarTotalFilas();
    return $idEntrega;
}

function comprarProductoStock(){
    if( isset($_SESSION['usuario']) && isset($_POST['idProducto']) && isset($_POST['cantidad']) 
    && isset($_POST['cantidadOtro'])){

        $idProducto = $_POST['idProducto'];
        $cantidad = $_POST['cantidad'];
        $cantidadOtro = $_POST['cantidadOtro'];

        if($cantidad == 'otro'){
            $cantidad = $cantidadOtro;
        }
    
        $stock = new stock();
        $stock = $stock -> consultarTodos();

        if($stock){
            foreach( $stock as $stock_item ){
                if($stock_item -> getid_producto() == $idProducto){
                    $stock_item -> comprarProductoStock($idProducto, $cantidad);
                    echo 1;
                }
            }
        }
    
    }
}

function drawPieChartCliente(){
    
    $valores = [];
    
    if( isset($_SESSION['usuario']) && isset($_POST['idUsuario']) ){
        
        $idUsuario = $_POST['idUsuario'];
        $producto = new producto();
        $cantidadProducto = $producto -> consultarTotalFilas();
        $producto = $producto -> consultarTodos();

        $usuario = new usuario();
        $productosProducto = $usuario -> productosMasCompradosProducto($idUsuario);
        $productosCarrito = $usuario -> productosMasCompradosCarrito($idUsuario);

        $valores = [];

        foreach($productosProducto as $productosProducto_item){
            if( isset($valores[$productosProducto_item[2]]) ){
                $valores[$productosProducto_item[2]] += $productosProducto_item[1];
            }else{
                $valores[$productosProducto_item[2]] = $productosProducto_item[1];
            }
        }


        for($i = 0; $i < $cantidadProducto; $i++){
            foreach($productosCarrito as $productosCarrito_item){
                if( isset($valores[$productosCarrito_item[2]]) ){
                    $valores[$productosCarrito_item[2]] += $productosCarrito_item[1];
                }else{
                    $valores [$productosCarrito_item[2]] = $productosCarrito_item[1];
                }
            }
        }
        $my_json_string = json_encode($valores);

        echo $my_json_string;
        
    }
}

function idNuevaCompra( $date, $cantidad, $entregaBOOL, $valorTotal, $idUsuario, $idEntrega ){
    $compra = new compra(0, $date, intval($cantidad), intval($entregaBOOL), intval($valorTotal), intval($idUsuario),
    $idEntrega, 1);
    $compra -> crear();
    $idCompra = $compra -> consultarTotalFilas();
    return $idCompra;
}

function buscarProducto($idProducto){
    $producto = new producto();
    $producto = $producto -> consultarProducto($idProducto);

    return $producto;
}

function buscarCliente($idUsuario){
    $cliente = new cliente();
    $cliente = $cliente -> consultarCliente( $idUsuario );

    return $cliente;
}

function crearCarrito($idUsuario){
    $carrito = new carrito(0, 0, 0, 1, $idUsuario);
    $carrito -> crear();    
}

function buscarCarrito($idUsuario){
    $carrito = new carrito();
    $carrito = $carrito -> consultarCarritos( $idUsuario );

    return $carrito;
}

function buscarCarritoProducto($idCarrito){
    $carritoProducto = new carritoProducto();
    $carritoProducto = $carritoProducto -> consultarProductosCarrito($idCarrito);
    return $carritoProducto;
}

function actualizarEStado(){
    if( isset($_SESSION['usuario']) && isset($_POST['idUsuario'])  && isset($_POST['estado']) ){
        $idUsuario = $_POST['idUsuario'];
        $estado = $_POST['estado'];

        $usuario = new usuario();
        $usuario -> actualizarEStado( $idUsuario, $estado);
        echo 1;
    }
}

function crearNuevoProducto(){
    if( isset($_SESSION['usuario']) && isset($_POST['altura'])  && isset($_POST['ancho']) && isset($_POST['profundidad'])
    && isset($_POST['caracteristicas'])  && isset($_POST['valor']) ){
        
        $altura = $_POST['altura'];
        $ancho = $_POST['ancho'];
        $profundidad = $_POST['profundidad'];
        $caracteristicas = $_POST['caracteristicas'];
        $valor = $_POST['valor'];

        $producto = new producto(0, $altura, $ancho, $profundidad, $caracteristicas, 1, $valor, 1);
        $producto -> crear();

        echo 1;
    }
}

function actualizarGraphicAndTableStock(){
    if( isset($_SESSION['usuario']) ){
        $dataDiv = '';

        $stock = new stock();
        $stock = $stock -> consultarTodos();

        $dataDiv.='<div class="row">
            <div class="col-6">
                <div style="">
                    <h1 style="text-align: center;">STOCK</h1>
                    <table class="table" style="">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Cantidad</th>
                        <th scope="col">Disponibilidad</th>
                        <th scope="col">Producto</th>
                        <th scope="col">Tienda</th>
                        </tr>
                    </thead>
                    <tbody>';

        foreach ($stock as $stock_item){
            $dataDiv .= '<tr>
                <th scope="row">'.$stock_item->getid_stock().'</th>
                <td> '. $stock_item->getcantidad() .' </td>
                <td> '. $stock_item->getdisponibilidad() .'</td>
                <td> '. $stock_item->getid_producto().' </td>
                <td> '. $stock_item->getid_tienda() .' </td>
            </tr>';
        }

        $dataDiv .= '</tbody>
                    </table>
                </div>
            </div>
            <div id="grafica" class="col-6" style="background: #ACACAC; padding:0;"></div>         
        </div>';

        echo $dataDiv;

    }
}

function crearNuevoDomiciliario(){
    if( isset($_SESSION['usuario']) && isset($_POST['nombre'])  && isset($_POST['apellido']) && isset($_POST['codigo'])
    && isset($_POST['correo'])  && isset($_POST['password']) ){
        
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $codigo = $_POST['codigo'];
        $correo = $_POST['correo'];
        $password = $_POST['password'];

        $usuario = new usuario(0,$correo, $password, 1, 2);
        $usuario -> crear();
        $idUsuario = $usuario -> consultarTotalFilas();

        if($idUsuario){
            $domiciliario = new domiciliario(0, $nombre, $apellido, $codigo, 1, $idUsuario);
            $domiciliario -> crear();
            echo 1;
        }
        }
}

function actualizarDatos(){
    if( isset($_SESSION['usuario']) && isset($_POST['nombre'])  && isset($_POST['apellido']) && isset($_POST['direccion'])
    && isset($_POST['numero'])  && isset($_POST['correo']) && isset($_POST['password']) && isset($_POST['idUsuario']) ){

        $idUsuario = $_POST['idUsuario'];
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $direccion = $_POST['direccion'];
        $numero = $_POST['numero'];
        $correo = $_POST['correo'];
        $password = $_POST['password'];

        $usuario = new usuario();
        $usuario -> actualizarDatos($idUsuario, $correo, $password);

        $cliente = new cliente();
        $cliente -> actualizarDatos($idUsuario, $nombre, $apellido, $direccion, $numero);

        echo 1;
            
    }
}

function compraCarrito(){

    if(isset($_SESSION['usuario']) && isset($_POST['idUsuario'])  && isset($_POST['idCarrito']) && 
    isset($_POST['entregaBOOL']) ){
        
        $entregaBOOL = $_POST['entregaBOOL'];
        $idUsuario = $_POST['idUsuario'];
        $idCarrito = $_POST['idCarrito'];
        $idEntrega = 0;

        $idDomiciliario = obtenerDomiciliarioAleatorio();
        $cliente = buscarCliente($idUsuario);
        $carrito = buscarCarrito($idUsuario);
        
        $carritoProducto = buscarCarritoProducto($idCarrito);

        if($carrito){
            $direccionCliente = $cliente[0] -> getdireccion_cliente();
            $valorTotal = $carrito[0] -> getvalor_carrito();
            $cantidad = $carrito[0] -> getnumeroArticulos_carrito();

            $date = date("Y-m-d");
            $dateEntrega = date("Y-m-d",strtotime($date."+ 5 days")); 

            if($entregaBOOL == 1)
                $idEntrega = idNuevaEntrega($direccionCliente, $valorTotal, $dateEntrega, $idDomiciliario);

            $idCompra = idNuevaCompra( $date, $cantidad, $entregaBOOL, $valorTotal, $idUsuario, $idEntrega ); 

            $compraCarrito = new compraCarrito(0, $idCompra, $idCarrito);
            $compraCarrito -> crear();
            $stock = new stock();            

            foreach( $carritoProducto as $carritoProducto_item){
                $idProducto = $carritoProducto_item -> getid_producto();
                $cantidad = $carritoProducto_item -> getcantidad_carritoProducto();
                $stock -> actualizarProducto($idProducto, $cantidad);
            }

            $carrito[0] -> actualizarEstado($idCarrito);
            echo 1;

        }else{
            echo "no carrito";
        }
    }else{
        echo "no ingresa";
    }

}

function actualizarModalCarrito(){

    if(isset($_SESSION['usuario']) && isset($_POST['idUsuario'])  && 
    isset($_POST['idCarrito']) ) {

        $tabla = '';

        $idUsuario = $_POST['idUsuario'];
        $idCarrito = $_POST['idCarrito'];

        $producto = new producto();
        $producto = $producto -> consultarTodos();


        $carrito = buscarCarrito($idUsuario);
        $carritoProducto = buscarCarritoProducto($idCarrito);

        $tabla .= '<h1 style="text-align: center;">carrito</h1>
                <table class="table" style="">
                <thead>
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">N. articulos</th>
                    <th scope="col">valor</th>
                    <th scope="col">Entrega</th>
                    </tr>
                </thead>
                <tbody>';
                
                if($carrito){ 
                    foreach ($carrito as $carrito_item){
                        if($carrito_item -> getestado_carrito() != 0){
                        $tabla .= '
                        <tr>
                            <th scope="row">'.$carrito_item->getid_carrito().' </th>
                            <td> ' . $carrito_item->getnumeroArticulos_carrito().' </td>
                            <td> ' . $carrito_item->getvalor_carrito().' </td>
                            <td> <select id="carritoEntrega'. $carrito_item->getid_carrito() .'">
                                    <option value="1">Si</option>
                                    <option value="0">No</option>
                                </select> </td>
                        </tr>
                        ';

                        }
                    }
                    $tabla .= '
                </tbody>
                </table>

                <h1 style="text-align: center;">Productos</h1>
                <table class="table" style="">
                <thead>
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Caracteristicas</th>
                    <th scope="col">Alto</th>
                    <th scope="col">Ancho</th>
                    <th scope="col">Profundidad</th>
                    <th scope="col">Valor Producto</th>
                    <th scope="col">Cantidad</th>
                    <th scope="col">V. Total</th>
                    <th scope="col"> Eliminar </th>

                    </tr>
                </thead>
                <tbody>
                ';
                    foreach ($carritoProducto as $carritoProducto_item){
                        foreach ($producto as $producto_item){
                            $idProducto = $producto_item -> getid_producto();
                            $idProductoCarrito = $carritoProducto_item -> getid_producto();
                            
                            if( $idProducto == $idProductoCarrito ){
                            $tabla .= '
                            <tr id="filaProducto' . $idProducto . '">
                                <th scope="row"> ' . $producto_item->getid_producto(). ' </th>
                                <td> ' . $producto_item->getcaracteristicas(). ' </td>
                                <td> ' . $producto_item->gety_producto(). ' </td>
                                <td> ' . $producto_item->getx_producto(). ' </td>
                                <td> ' . $producto_item->getz_producto(). ' </td>
                                <td> ' . $producto_item->getvalor_producto(). ' </td>
                                <td> ' . $carritoProducto_item->getcantidad_carritoProducto(). ' </td>
                                <td> ' . $carritoProducto_item->getvalor_carritoProducto(). ' </td>
                                <td><button id="EliminarProducto' . $producto_item->getid_producto(). '" type="button" class="btn btn-outline-danger"
                                onclick="eliminarProducto('. $idUsuario. ','. $idProducto. ','. $idCarrito. ') ">X</button></td>
                            </tr>
                            ';
                            }
                        }
                    }
                }
                    $tabla.= '
                </tbody>
                </table>';

                echo $tabla;

    }else{
        echo 'hola';
    }

}

function eliminarCarritoProducto(){
    if( isset($_SESSION['usuario']) && isset($_POST['idUsuario']) && isset($_POST['idProducto'])
    && isset($_POST['idCarrito']) ){
        
        $idUsuario = $_POST['idUsuario'];
        $idProducto =  $_POST['idProducto'];
        $idCarrito = $_POST['idCarrito'];

        $carrito = buscarCarrito($idUsuario);

        $carritoProducto = new carritoProducto();
        $carritoProducto = $carritoProducto -> consultarProductosCarrito($idCarrito);
        
        foreach( $carritoProducto as $carritoProducto_item ){
            if( $carritoProducto_item -> getid_producto() == $idProducto ){

                $cantidad = $carritoProducto_item -> getcantidad_carritoProducto();
                $precio = $carritoProducto_item -> getvalor_carritoProducto();

                $carritoProducto_item -> actualizarUnidades($idCarrito, $idProducto, 0, 0, 'Eliminar');
                $carrito[0] -> actualizarUnidades($idCarrito, $cantidad, $precio, 'Eliminar');

                echo 1;
            }
        }
    }
}

function addProducto(){
    if( isset($_SESSION['usuario']) && isset($_POST['idUsuario']) && isset($_POST['idProducto']) 
    && isset($_POST['cantidad']) && isset($_POST['cantidadOtro']) ){

        $idUsuario = $_POST['idUsuario'];
        $idProducto = $_POST['idProducto'];
        $cantidad = $_POST['cantidad'];
        $cantidadOtro = $_POST['cantidadOtro'];
        $carrito = buscarCarrito($idUsuario);
        $producto = buscarProducto($idProducto);
        $precio = $producto[0] -> getvalor_producto() * $cantidad;

        if($cantidad == "otro")
            $cantidad = $cantidadOtro;

        if($carrito){
        //existe un carrito para agregar el producto

        $idCarrito = $carrito[0] -> getid_carrito();
        $carritoProducto = buscarCarritoProducto( $idCarrito );
        $productoEncontrado = false;

        if($carritoProducto){
        //existe el carritoProducto
            foreach($carritoProducto as $carritoProducto_item){
                
                if( $carritoProducto_item -> getid_carrito() == $idCarrito && $carritoProducto_item -> getid_producto() == $idProducto ){
                    
                    $carritoProducto_item -> actualizarUnidades($idCarrito, $idProducto, $cantidad, $precio, "Agregar");
                    $carrito[0] -> actualizarUnidades($idCarrito, $cantidad, $precio, "Agregar");
                    $productoEncontrado = true;
                    echo 1;
                }
            }
        }
            //no existe el carritoProducto (producto nuevo para add en el carrito)
            if(!$productoEncontrado){
                $carritoProducto = new carritoProducto(0, $cantidad, $precio, $idCarrito, $idProducto);
                $carritoProducto -> crear();
                $carrito[0] -> actualizarUnidades($idCarrito, $cantidad, $precio, "Agregar");
                echo 1;
            }

        }else{
            //crea un carrito
            crearCarrito($idUsuario);
            $carrito = buscarCarrito($idUsuario);
            $idCarrito = $carrito[0] -> getid_carrito();
            
            $carritoProducto = new carritoProducto(0, $cantidad, $precio, $idCarrito, $idProducto);
            $carritoProducto -> crear();
            $carrito[0] -> actualizarUnidades($idCarrito, $cantidad, $precio, "Agregar");
            echo 1;
        }

    }else{
        echo 0;
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
        $idEntrega = 0;

        $producto = buscarProducto($idProducto);
        $cliente = buscarCliente($idUsuario);

        if($cantidad == 'otro'){
            $valorTotal = $producto[0] -> getvalor_producto() * $cantidadOtro;
            $cantidad = $cantidadOtro;
        }else{
            $valorTotal = $producto[0] -> getvalor_producto() * $cantidad;
        }

        $date = date("Y-m-d");
        $dateEntrega = date("Y-m-d",strtotime($date."+ 5 days")); 
        
        if($entregaBOOL == 1){
            $idDomiciliario = obtenerDomiciliarioAleatorio();     
            $direccionCliente = $cliente[0] -> getdireccion_cliente();
            $idEntrega = idNuevaEntrega($direccionCliente, $valorTotal, $dateEntrega, $idDomiciliario);
        }

        $idCompra = idNuevaCompra( $date, $cantidad, $entregaBOOL, $valorTotal, $idUsuario, $idEntrega );

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
