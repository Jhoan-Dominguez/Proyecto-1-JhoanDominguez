
<?php 
    if(isset($_SESSION['usuario'])){

    $usuario = $_SESSION['usuario'];
    $idUsuario = $usuario[0] -> getid_usuario();

    $todosUsuarios = $usuario[0] -> consultarTodos();

    $producto = new producto();
    $producto = $producto -> consultarTodos();

    $cliente = new cliente();
    $cliente = $cliente -> consultarTodos();
        
    $domiciliario = new domiciliario();
    $domiciliario = $domiciliario -> consultarTodos();

    $stock = new stock();
    $stock = $stock -> consultarTodos();
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
    <!-- <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalHistorialCompras">Historial de Compras</button> -->
    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalEliminarPerfil">Eliminar Cuenta</button>

    <!-- Modal Eliminar Cuenta -->
    <div class="modal fade" id="modalEliminarPerfil" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

        <p>Seguro Desea Eliminar Su Cuenta?</p>

        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
            <button type="button" class="btn btn-primary" onclick="actualizarEStado(<?php echo $idUsuario; ?>)">Eliminar</button>
        </div>
        </div>
    </div>
    </div>

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
                <h1>  </h1>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" value="" id="nombre" placeholder="Nombre">
                <label for="nombre">Nombre</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" value="" id="apellido" placeholder="Apellido">
                <label for="apellido">Apellido</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" value="" id="direccion" placeholder="Direccion">
                <label for="direccion">Direccion</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" value="" id="numeroTelefono" placeholder="Telefono">
                <label for="numeroTelefono">Telefono</label>
            </div>
            <div class="form-floating mb-3">
                <input type="email" class="form-control" value="" id="correo" placeholder="Corre Electronico">
                <label for="correo">Correo Electronico</label>
            </div>
            <div class="form-floating mb-3">
                <input type="password" class="form-control" value="" id="password" placeholder="Password">
                <label for="password">Password</label>
            </div>
            <!-- <div class="d-grid">
                <button onclick="crear()" name="btnCrearCuenta" class="btn btn-primary">Actualizar Datos</button>
            </div> -->
        </div>

        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
            <button type="button" class="btn btn-primary"
            onclick="actualizarDatos( <?php echo $idUsuario ?> )" >Actualizar Datos</button>
        </div>
        </div>
    </div>
    </div>



    <div class="container">
    <div class="row">
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
        <div class="col-6" style="background: #ACACAC; height: 500px;"></div>         
    </div>
    </div>

    <!-- Tabla Producto -->

        <div class="col-12">
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
                            <option value="1"> 10 </option>
                            <option value="2"> 20 </option>
                            <option value="3"> 30 </option>
                            <option value="4"> 40 </option>
                            <option value="otro">Otro</option>
                        </select>
                        <input id="cantidadProductoOtroAdd<?php echo $producto_item->getid_producto(); ?>" type="number" min="1" max="10" style="display:none">
                        </td>
                        <td><button type="button" class="btn btn-outline-success" data-bs-toggle="modal" 
                        value=" <?php echo $producto_item->getid_producto() ?> " data-bs-target="#modalComprarProducto<?php echo $producto_item->getid_producto() ?>">
                            Buy
                        </button></td> 
                    </tr>
                    <?php
                }
                ?>
            </tbody>
            </table>
            </div>
        </div>

    <!-- Tabla Clientes -->
        <div class="col-12">
            <div style="">
            <h1 style="text-align: center;">Clientes</h1>
            <table class="table" style="">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">nombre</th>
                <th scope="col">apellido</th>
                <th scope="col">direccion</th>
                <th scope="col">telefono</th>
                <th scope="col">f.nacimiento</th>
                <th scope="col">Editar</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                foreach ($cliente as $cliente_item){
                    ?>
                    <tr>
                        <th scope="row"> <?php echo $cliente_item->getid_cliente() ?> </th>
                        <td> <?php echo $cliente_item->getnombre_cliente() ?> </td>
                        <td> <?php echo $cliente_item->getapellido_cliente() ?> </td>
                        <td> <?php echo $cliente_item->getdireccion_cliente() ?> </td>
                        <td> <?php echo $cliente_item->gettelefono_cliente() ?> </td>
                        <td> <?php echo $cliente_item->getfechaNacimiento_cliente() ?> </td>
                        <td><button type="button" class="btn btn-outline-success" data-bs-toggle="modal" 
                        value="" data-bs-target="">
                            Editar
                        </button></td> 
                        <td><button type="button" class="btn btn-outline-success" data-bs-toggle="modal" 
                        value="" data-bs-target="">
                            Cambiar Estado
                        </button></td> 
                    </tr>
                    <?php
                }
                ?>
            </tbody>
            </table>
            </div>
        </div>

    <!-- Tabla Domiciliario -->
    <div class="col-12">
        <div style="">
        <h1 style="text-align: center;">Domiciliarios</h1>
        <table class="table" style="">
        <thead>
            <tr>
            <th scope="col">#</th>
            <th scope="col">nombre</th>
            <th scope="col">apellido</th>
            <th scope="col">codigo</th>
            <th scope="col">Estado</th>
            <th scope="col">Editar</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            foreach ($domiciliario as $domiciliario_item){
                ?>
                <tr>
                    <th scope="row"> <?php echo $domiciliario_item->getid_domiciliario() ?> </th>
                    <td> <?php echo $domiciliario_item->getnombre_domiciliario() ?> </td>
                    <td> <?php echo $domiciliario_item->getapellido_domiciliario() ?> </td>
                    <td> <?php echo $domiciliario_item->getcodigo_domiciliario() ?> </td>
                    <td> <?php echo $domiciliario_item->getestado_domiciliario() ?> </td>
                    <td><button type="button" class="btn btn-outline-success" data-bs-toggle="modal" 
                    value="" data-bs-target="">
                        Editar
                    </button></td> 
                    <td><button type="button" class="btn btn-outline-success" data-bs-toggle="modal" 
                    value="" data-bs-target="">
                        Cambiar Estado
                    </button></td> 
                </tr>
                <?php
            }
            ?>
        </tbody>
        </table>
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

function actualizarEStado(idUsuario){
    $.ajax({
        url: "funciones.php",
        type: 'POST',
        data: {
            opcion: 'actualizarEStado',
            idUsuario: idUsuario,
            estado: 0,
        },

    }).done(function(response){

        if(response == 1){
            alert("Estado del Usuario Actualizado");          
        }else{
            alert("Error"+response);          
        }
    })
}

function actualizarDatos(idUsuario){

    let nombre = document.getElementById("nombre").value;
    let apellido = document.getElementById("apellido").value;
    let direccion = document.getElementById("direccion").value;
    let numero = document.getElementById("numeroTelefono").value;
    let correo = document.getElementById("correo").value;
    let password = document.getElementById("password").value;

    $.ajax({
        url: "funciones.php",
        type: 'POST',
        data: {
            opcion: 'actualizarDatos',
            idUsuario: idUsuario,
            nombre: nombre,
            apellido: apellido,
            direccion: direccion,
            numero: numero,
            correo: correo,
            password: password,
        },

    }).done(function(response){

        if(response == 1){
            alert("Datos Actualizados");          
        }else{
            alert("Error"+response);          
        }
    })
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

