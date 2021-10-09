
<?php 
    if(isset($_SESSION['usuario'])){

    $usuario = $_SESSION['usuario'];
    $idUsuario = $usuario[0] -> getid_usuario();

    $cliente = new cliente();
    $cliente = $cliente -> consultarCliente( $usuario[0] -> getid_usuario());
    $idCliente = $cliente[0] -> getid_cliente();

    $carrito = new carrito();
    $carrito = $carrito -> consultarCarritos( $usuario[0] -> getid_usuario());

    $producto = new producto();
    $producto = $producto -> consultarTodos();

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
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            
        <div class="col">
                <div style="">
                    <h1 style="text-align: center;">carrito</h1>
                    <table class="table" style="">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">N. articulos</th>
                        <th scope="col">valor</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        foreach ($carrito as $carrito_item){
                            if($carrito_item -> getestado_carrito() != 0){
                            ?>
                            <tr>
                                <th scope="row"> <?php echo $carrito_item->getid_carrito() ?> </th>
                                <td> <?php echo $carrito_item->getnumeroArticulos_carrito() ?> </td>
                                <td> <?php echo $carrito_item->getvalor_carrito() ?> </td>
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
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Understood</button>
        </div>
        </div>
    </div>
    </div>

    <!-- Modal Compra -->
    <?php foreach ($producto as $producto_item){
    ?>
    <div class="modal fade" id="modalComprarProducto<?php echo $producto_item->getid_producto() ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                    <th scope="col">comprar</th>
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
                        
                            <td><button type="button" class="btn btn-outline-success" data-bs-toggle="modal" 
                            value=" <?php echo $producto_item->getid_producto() ?> " data-bs-target="#modalComprarProducto<?php echo $producto_item->getid_producto() ?>">
                                Buy
                            </button></td>

                            <td> <button type="submit" value="<?php echo $producto_item->getid_producto() ?>" 
                            id="<?php echo $producto_item->getid_producto() ?>" class="btn btn-outline-warning">Add</button> </td>
                            
                        </tr>
                        <?php
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

  function comprarProducto( btn, idUsuario, tienda, idCliente ){
    let idProducto = btn.value
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

        if(response == 0){
            alert("Error")
        }else{
            alert('Compra Exitosa')
            location.replace("index.php?");
        }
    })

    }
</script>

