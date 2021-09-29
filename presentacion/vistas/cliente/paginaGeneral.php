<?php ?>
<?php 
    $cliente = new cliente();
    $cliente = $cliente -> consultarCliente( $usuario[0] -> getid_usuario());

    $carrito = new carrito();
    $carrito = $carrito -> consultarCarritos( $usuario[0] -> getid_usuario());

    

?>

