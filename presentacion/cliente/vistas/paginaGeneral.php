
<?php 
    if(isset($_SESSION['usuario'])){

    $usuario = $_SESSION['usuario'];
    $idUsuario = $usuario[0] -> getid_usuario();

    $cliente = new cliente();
    if($cliente){
        $cliente = $cliente -> consultarCliente( $usuario[0] -> getid_usuario());
        $idCliente = $cliente[0] -> getid_cliente();
    }

    $carrito = new carrito();
    $carrito = $carrito -> consultarCarritos( $usuario[0] -> getid_usuario());
    
    $carritoProducto = new carritoProducto();

    if($carrito){
        $idCarrito = $carrito[0] -> getid_carrito();
        $carritoProducto = $carritoProducto -> consultarProductosCarrito( $carrito[0]->getid_carrito() );
    }

    $producto = new producto();
    $producto = $producto -> consultarTodos();

    $stock = new stock();
    $stock = $stock -> consultarTodos();

    $carritosComprados = $usuario[0] -> consultarCompraCarritos($idUsuario);
    $productoComprados = $usuario[0] -> consultarCompraProductos($idUsuario);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>  
    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalEditarPerfil">Editar Perfil</button>
    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalHistorialCompras">Historial de Compras</button>
    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalEditarPerfil">Eliminar Cuenta</button>

    <!-- Modal Editar Perfil -->
    <div class="modal fade" id="modalEditarPerfil" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="margin-left: 25%">
        <div class="modal-content" style="width: 600px;">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Datos Usuario</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            
        <div style="margin-top: 10px; margin-left: 5%; height: 100%; width: 500px">
            <div class="form-floating mb-3">
                <h1> <?php echo $cliente[0] -> getnombre_cliente(). " " . $cliente[0] -> getapellido_cliente(); ?> </h1>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" value="<?php echo $cliente[0] -> getnombre_cliente(); ?>" id="nombre" placeholder="Nombre">
                <label for="nombre">Nombre</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" value="<?php echo $cliente[0] -> getapellido_cliente(); ?>" id="apellido" placeholder="Apellido">
                <label for="apellido">Apellido</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" value="<?php echo $cliente[0] -> getdireccion_cliente(); ?>" id="direccion" placeholder="Direccion">
                <label for="direccion">Direccion</label>
            </div>
            <div class="form-floating mb-3">
                <input type="number" class="form-control" value="<?php echo $cliente[0] -> gettelefono_cliente(); ?>" id="numeroTelefono" placeholder="Telefono">
                <label for="numeroTelefono">Telefono</label>
            </div>
            <div class="form-floating mb-3">
                <input type="email" class="form-control" value="<?php echo $usuario[0] -> getcorreo_usuario(); ?>" id="correo" placeholder="Corre Electronico">
                <label for="correo">Correo Electronico</label>
            </div>
            <div class="form-floating mb-3">
                <input type="password" class="form-control" value="<?php echo $usuario[0] -> getpassword_usuario(); ?>" id="password" placeholder="Password">
                <label for="password">Password</label>
            </div>
            <!-- <div class="d-grid">
                <button onclick="crear()" name="btnCrearCuenta" class="btn btn-primary">Actualizar Datos</button>
            </div> -->
        </div>

        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
            <button type="button" class="btn btn-primary">Actualizar Datos</button>
        </div>
        </div>
    </div>
    </div>

    <!-- Modal Historial Compras -->
    <div class="modal fade" id="modalHistorialCompras" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="margin-left: 20%">
        <div class="modal-content" style="width: 1000px;">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            
        <h1 style="text-align: center;">carritos</h1>
                <table class="table" style="">
                <thead>
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Fecha de Compra</th>
                    <th scope="col">N. articulos</th>
                    <th scope="col">Entrega</th>
                    <th scope="col">Valor Total</th>
                    <th scope="col">Ver Factura</th>
                    </tr>
                </thead>
                <tbody>
                <?php                
                if($carrito){ 
                    $idAnterior = 0;
                    foreach ($carritosComprados as $carritosComprados_item){
                        $idSiguiente = $carritosComprados_item[5];
                        if($idAnterior != $idSiguiente){
                            $idAnterior = $carritosComprados_item[5];
                ?>
                    <tr>
                        <th scope="row"><?php echo $carritosComprados_item[5]; ?> </th>
                        <td> <?php echo $carritosComprados_item[6]; ?> </td>
                        <td> <?php echo $carritosComprados_item[7]; ?> </td>
                        <td> <?php echo $carritosComprados_item[8]; ?> </td>
                        <td> <?php echo $carritosComprados_item[9]; ?> </td>
                        <td> <button type="button" id="factura<?php echo $carritosComprados_item[5]; ?>" 
                        onclick="crearFacturaCarrito(<?php echo $carritosComprados_item[5]; ?>, 
                        <?php echo $idUsuario; ?>)" class="btn btn-danger" >Generar Factura</button> </td>
                    </tr>
                <?php
                        }
                    }
                ?>
                </tbody>
                </table>

                <h1 style="text-align: center;">Productos</h1>
                <table class="table" style="">
                <thead>
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Caracteristicas</th>
                    <th scope="col">Fecha de Compra</th>
                    <th scope="col">N. articulos</th>
                    <th scope="col">Entrega</th>
                    <th scope="col">Valor Producto</th>
                    <th scope="col">Valor Total</th>
                    <th scope="col">Ver Factura</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    foreach ($productoComprados as $productoComprados_item){
                ?>
                        <tr id="">
                            <th scope="row"> <?php echo $productoComprados_item[5]; ?> </th>
                            <td> <?php echo $productoComprados_item[11]; ?> </td>
                            <td> <?php echo $productoComprados_item[6]; ?> </td>
                            <td> <?php echo $productoComprados_item[7]; ?> </td>
                            <td> <?php echo $productoComprados_item[8]; ?> </td>
                            <td> <?php echo $productoComprados_item[12]; ?> </td>
                            <td> <?php echo $productoComprados_item[9]; ?> </td>
                            <td> <button type="button" class="btn btn-danger"
                            onclick="crearFacturaProducto(<?php echo $productoComprados_item[5]; ?>, 
                            <?php echo $idUsuario; ?>)" >Generar Factura</button> </td>
                        </tr>
                <?php 
                    }
                }
                ?>
                </tbody>
                </table>

        </div>
        </div>
    </div>
    </div>

    <!-- Modal Carrito -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" style="margin-left: 25%">
        <div class="modal-content" style="width: 800px;">
        <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">Ventana del Carrito</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" >
            
        <div class="col" >
                <div id = "modalCarrito">
                    <h1 style="text-align: center;">carrito</h1>
                    <table class="table" style="">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">N. articulos</th>
                        <th scope="col">valor</th>
                        <th scope="col">Entrega</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                    if($carrito){ 
                        foreach ($carrito as $carrito_item){
                            if($carrito_item -> getestado_carrito() != 0){
                            ?>
                            <tr>
                                <th scope="row"> <?php echo $carrito_item->getid_carrito() ?> </th>
                                <td> <?php echo $carrito_item->getnumeroArticulos_carrito() ?> </td>
                                <td> <?php echo $carrito_item->getvalor_carrito() ?> </td>
                                <td> <select id="carritoEntrega<?php echo $carrito_item->getid_carrito() ?>">
                                    <option value="1">Si</option>
                                    <option value="0">No</option>
                                </select> </td>
                            </tr>
                            <?php
                            }
                        }
                        ?>
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
                    <?php 
                        foreach ($carritoProducto as $carritoProducto_item){
                            foreach ($producto as $producto_item){
                                $idProducto = $producto_item -> getid_producto();
                                $idProductoCarrito = $carritoProducto_item -> getid_producto();
                                
                                if( $idProducto == $idProductoCarrito ){
                                ?>
                                <tr id="filaProducto<?php echo $idProducto; ?>">
                                    <th scope="row"> <?php echo $producto_item->getid_producto(); ?> </th>
                                    <td> <?php echo $producto_item->getcaracteristicas(); ?> </td>
                                    <td> <?php echo $producto_item->gety_producto(); ?> </td>
                                    <td> <?php echo $producto_item->getx_producto(); ?> </td>
                                    <td> <?php echo $producto_item->getz_producto(); ?> </td>
                                    <td> <?php echo $producto_item->getvalor_producto(); ?> </td>
                                    <td> <?php echo $carritoProducto_item->getcantidad_carritoProducto(); ?> </td>
                                    <td> <?php echo $carritoProducto_item->getvalor_carritoProducto(); ?> </td>
                                    <td><button id="EliminarProducto<?php echo $producto_item->getid_producto(); ?>" type="button" class="btn btn-outline-danger"
                                    onclick="eliminarProducto(<?php echo $idUsuario; ?>, <?php echo $idProducto; ?>, 
                                    <?php echo $idCarrito; ?>) ">X</button></td>
                                </tr>
                                <?php
                                }
                            }
                        }
                    }
                        ?>
                    </tbody>
                    </table>
                </div>
            </div>

        </div>
        <div class="modal-footer">
            <button type="button" id="closeModalCarrito" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" onclick="compraCarrito(
                <?php echo $idUsuario; ?>, <?php echo $idCarrito; ?>
            )">Comprar</button>
        </div> 
        </div>
    </div>
    </div>

    <!-- Modal Compra -->
    <?php foreach ($producto as $producto_item){
    ?>
    <div class="modal fade" id="modalComprarProducto<?php echo $producto_item->getid_producto(); ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        
        <div class="card" style="width: 18rem;">
        <div class="card-body">
            
            <h5 class="card-title"> <?php echo $producto_item->getid_producto(); ?>  </h5>
            <p class="card-text"> <?php echo $producto_item->getcaracteristicas(); ?> </p>
            <h5 class="card-title"> Dimensiones: </h5>
            <p class="card-text"> Alto: <?php echo $producto_item->gety_producto(); ?> </p>
            <p class="card-text"> Ancho: <?php echo $producto_item->getx_producto(); ?> </p>
            <p class="card-text"> Profundidad: <?php echo $producto_item->getz_producto(); ?> </p>
            <h5 class="card-title"> Valor: </h5>
            <p class="card-text"> <?php echo $producto_item->getvalor_producto(); ?>$</p>

            Cantidad de Productos: <br>
            <select id="cantidadProducto<?php echo $producto_item->getid_producto(); ?>" onchange="otroCantidad( <?php echo $producto_item->getid_producto(); ?> )" id="cantidadProducto" style="width:60px">
                <option value="1"> 1 </option>
                <option value="2"> 2 </option>
                <option value="3"> 3 </option>
                <option value="4"> 4 </option>
                <option value="otro">Otro</option>
            </select>
            <input id="cantidadProductoOtro<?php echo $producto_item->getid_producto(); ?>" type="number" min="1" max="10" style="display:none">
            <br>
            Deseas Entrega: </br>
            <select id="entrega<?php echo $producto_item->getid_producto(); ?>" id="entrega" style="width:60px">
                <option value="1"> Si </option>
                <option value="0"> No </option>
            </select>

        </div>
        </div>

        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
            <button type="button" value="<?php echo $producto_item->getid_producto(); ?>" 
            onclick="comprarProducto(this, <?php echo $idUsuario; ?>, <?php echo 1; ?>, <?php echo $idCliente; ?>)" class="btn btn-primary">Comprar</button>
        </div>
        </div>
    </div>
    </div>
    <?php }
    ?>

    <div class="container">
    <div class="row">

            <div class="col">
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
                    <tbody>
                        <?php 
                        foreach ($stock as $stock_item){
                            ?>
                            <tr>
                                <th scope="row"> <?php echo $stock_item->getid_stock() ?> </th>
                                <td> <?php echo $stock_item->getcantidad() ?> </td>
                                <td> <?php echo $stock_item->getdisponibilidad() ?> </td>
                                <td> <?php echo $stock_item->getid_producto() ?> </td>
                                <td> <?php echo $stock_item->getid_tienda() ?> </td>
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                    </table>
                </div>
            </div>

        <div class="col">
            <div style="">
                <h1 style="text-align: center;">PRODUCTOS</h1>
                <table class="table" style="">
                <thead>
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">alto</th>
                    <th scope="col">ancho</th>
                    <th scope="col">profundidad</th>
                    <th scope="col">caracteristicas</th>
                    <th scope="col">estado</th>
                    <th scope="col">valor</th>
                    <th scope="col">N. Unidades</th>
                    <th scope="col">add carrito</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    foreach ($producto as $producto_item){
                        foreach ($stock as $stock_item){
                            if($stock_item -> getid_producto() == $producto_item -> getid_producto() && 
                               $stock_item -> getcantidad() > 0 ){
                        ?>
                        <tr>
                            <th scope="row"> <?php echo $producto_item->getid_producto() ?> </th>
                            <td> <?php echo $producto_item->gety_producto() . "cm" ?> </td>
                            <td> <?php echo $producto_item->getx_producto() . "cm" ?> </td>
                            <td> <?php echo $producto_item->getz_producto() . "cm" ?> </td>
                            <td> <?php echo $producto_item->getcaracteristicas() ?> </td>
                            <td> <?php echo $producto_item->getestado_producto() ?> </td>
                            <td> <?php echo "$".$producto_item->getvalor_producto() ?> </td>
                            <td>
                            <select id="cantidadProductoAdd<?php echo $producto_item->getid_producto(); ?>" onchange="cantidadAdd( <?php echo $producto_item->getid_producto(); ?> )" id="cantidadProducto" style="width:60px">
                                <option value="1"> 1 </option>
                                <option value="2"> 2 </option>
                                <option value="3"> 3 </option>
                                <option value="4"> 4 </option>
                                <option value="otro">Otro</option>
                            </select>
                            <input id="cantidadProductoOtroAdd<?php echo $producto_item->getid_producto(); ?>" type="number" min="1" max="10" style="display:none">
                            </td>
                            <td><button type="button" class="btn btn-outline-success" data-bs-toggle="modal" 
                            value=" <?php echo $producto_item->getid_producto() ?> " data-bs-target="#modalComprarProducto<?php echo $producto_item->getid_producto() ?>">
                                Buy
                            </button></td>

                            <td> <button type="submit" value="<?php echo $producto_item->getid_producto() ?>" 
                            id="<?php echo $producto_item->getid_producto() ?>" onclick="addProducto(<?php echo $idUsuario; ?>, 
                            <?php echo $producto_item->getid_producto(); ?>)" class="btn btn-outline-warning">Add</button> </td>
                            
                        </tr>
                        <?php
                            }
                        }
                    }
                    ?>
                </tbody>
                </table>
            </div>
        </div>
    </div>
    </div>
</body>
</html>

<?php 

} else{
    echo "error";
}
?>

<script>
  
function cantidadAdd(id){
    let opcion = document.getElementById("cantidadProductoAdd"+id);
    let input = document.getElementById("cantidadProductoOtroAdd"+id);
    let eleccion = opcion.value

    if(eleccion == "otro"){
        input.style.display = "inline"
    }else{
        input.style.display = "none"
    }
}

function otroCantidad(id){
    let opcion = document.getElementById("cantidadProducto"+id);
    let input = document.getElementById("cantidadProductoOtro"+id);
    let eleccion = opcion.value

    if(eleccion == "otro"){
        input.style.display = "inline"
    }else{
        input.style.display = "none"
    }
}

function crearFacturaProducto(idCompra, idUsuario){
    $.ajax({
        url: "crearPdf.php",
        type: 'POST',
        data: {
            opcion: 'producto',
            idCompra: idCompra,
            idUsuario: idUsuario,
        },

    }).done(function(response){
        console.log(response)
    })
}


function crearFacturaCarrito(idCompra, idUsuario){
    $.ajax({
        url: "crearPdf.php",
        type: 'POST',
        data: {
            opcion: 'carrito',
            idCompra: idCompra,
            idUsuario: idUsuario,
        },

    }).done(function(response){
        console.log(response)
    })
}

function compraCarrito(idUsuario, idCarrito){
    
    let entregaBOOL = document.getElementById("carritoEntrega"+idCarrito).value;

    $.ajax({
        url: "funciones.php",
        type: 'POST',
        data: {
            opcion: 'compraCarrito',
            idUsuario: idUsuario,
            idCarrito: idCarrito,
            entregaBOOL: entregaBOOL,
        },

    }).done(function(response){

        if(response == 1){
            alert("Compra Exitosa");          
        }else{
            alert("Error"+response);          
        }
    })

}

function actualizarModalCarrito( idUsuario, idCarrito ){

    $.ajax({
        url: "funciones.php",
        type: 'POST',
        data: {
            opcion: 'actualizarModalCarrito',
            idUsuario: idUsuario,
            idCarrito: idCarrito,
        },
        dataType: 'text',

    }).done(function(response){
        document.getElementById("modalCarrito").innerHTML = response;    
    })
    
}

function eliminarProducto(idUsuario, idProducto, idCarrito){
    let fila = document.getElementById("filaProducto"+idProducto);

    $.ajax({
        url: "funciones.php",
        type: 'POST',
        data: {
            opcion: 'eliminarCarritoProducto',
            idProducto: idProducto,
            idUsuario: idUsuario,
            idCarrito: idCarrito,
        }
    }).done(function(response){

        if(response == 1){
            fila.style.display = "none";
            actualizarModalCarrito( idUsuario, idCarrito );
        }else{
            alert("Error"+response)            
        }
    })
}

function comprarProducto( btn, idUsuario, tienda, idCliente ){
    let idProducto = btn.value
    let modalCarrito = document.getElementById("staticBackdrop")
    let cantidad = document.getElementById("cantidadProducto"+idProducto).value;
    let cantidadOtro = document.getElementById("cantidadProductoOtro"+idProducto).value;
    let entrega = document.getElementById("entrega"+idProducto).value;

    $.ajax({
        url: "funciones.php",
        type: 'POST',
        data: {
            opcion: 'comprarProducto',
            idProducto: idProducto ,
            idUsuario: idUsuario,
            tienda: tienda,
            idCliente: idCliente,
            cantidad: cantidad,
            cantidadOtro: cantidadOtro,
            entrega: entrega,
        }
    }).done(function(response){

        if(response == 1){
            alert('Compra Exitosa');
            setTimeout(function(){ modalCarrito.modal('hide');},500);
            location.replace("index.php?");
        }else{
            alert("Error")            
        }
    })

}

function addProducto(idUsuario, idProducto){
    // alert(idUsuario + " " + idProducto)
    let cantidad = document.getElementById("cantidadProductoAdd"+idProducto).value;
    let cantidadOtro = document.getElementById("cantidadProductoOtroAdd"+idProducto).value;

    $.ajax({
        url: "funciones.php",
        type: "POST",
        data: {
            opcion: 'addProducto',
            idUsuario: idUsuario,
            idProducto: idProducto,
            cantidad: cantidad,
            cantidadOtro: cantidadOtro,
        }
    }).done(function(response){
        if(response == 1){
            location.replace("index.php?");
        }else{
            alert("Error"+response)
        }
    })

}
</script>

