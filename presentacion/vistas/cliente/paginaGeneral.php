
<?php 
    if(isset($_SESSION)){
    // inicializacion objetos necesarios
    $cliente = new cliente();
    $cliente = $cliente -> consultarCliente( $usuario[0] -> getid_usuario());

    $carrito = new carrito();
    $carrito = $carrito -> consultarCarritos( $usuario[0] -> getid_usuario());

    $tienda = new tienda();
    $tienda = $tienda -> consultarTodos();

    $producto = new producto();
    $producto = $producto -> consultarTodos();

    $stock = new stock();
    $stock = $stock -> consultarTodos();

    $entrega = new entrega();
    $compraCarrito = new compraCarrito();
    $compraProducto = new compraProducto();
    $compra = new compra();

    if(isset($_GET['buy']) && $_GET['buy'] == 'true'){
        require "./comprarProducto.php";
    }

?>

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
                    <th scope="col">fecha</th>
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
                            <td> <?php echo $carrito_item->getfecha_carrito() ?> </td>
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
                        
                        <td> <button type="submit" value=" <?php echo $producto_item->getid_producto() ?> " 
                        id="<?php echo $producto_item->getid_producto() ?>" onclick='clickBuy(this)' class="btn btn-outline-success">Buy</button> </td>
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

<?php 

} else{
    echo "error";
}
?>

<script>
function clickBuy(bton){
    let id = 0;
    id = bton.value;   
    location.replace("index.php?id_producto=" + id);
}
</script>

