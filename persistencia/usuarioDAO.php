<?php
class usuarioDAO {
    
private $id_usuario;
private $correo_usuario;
private $password_usuario;
private $estado_usuario;
private $id_tipoUsuario;
    
public function usuarioDAO( $id_usuario="",$correo_usuario="",$password_usuario="",$estado_usuario="",$id_tipoUsuario="" ) {
    
$this -> id_usuario = $id_usuario;
$this -> correo_usuario = $correo_usuario;
$this -> password_usuario = $password_usuario;
$this -> estado_usuario = $estado_usuario;
$this -> id_tipoUsuario = $id_tipoUsuario;
}

public function crear() {
return "
insert into usuario (correo_usuario,password_usuario,estado_usuario,id_tipoUsuario)
values (
 '" .$this -> correo_usuario. "', 
 '" .$this -> password_usuario. "', 
 " .$this -> estado_usuario. ", 
 " .$this -> id_tipoUsuario. "

)";
}

public function actualizarDatos( $idUsuario, $correo, $pass){
    return "
        update usuario set correo_usuario = '" .$correo. "', password_usuario = '" .$pass. "' 
        where id_usuario = ".$idUsuario;
}

public function actualizarEStado( $idUsuario, $estado){
    return "
        update usuario set estado_usuario = " .$estado. "
        where id_usuario = ".$idUsuario;
}

public function consultarCompraCarritos($idUsuario){
    return "
        select cliente.id_cliente, cliente.nombre_cliente, cliente.apellido_cliente, cliente.direccion_cliente, 
        cliente.telefono_cliente, compra.id_compra, compra.fecha_compra, compra.numeroArticulos_compra, 
        compra.compraConEntrega, compra.valorTotal_compra, carritoProducto.id_producto, 
        carritoProducto.cantidad_carritoProducto, carritoProducto.valor_carritoProducto, producto.caracteristicas, 
        producto.valor_producto
        from cliente inner join compra on 
        cliente.id_usuario = compra.id_usuario inner join compraCarrito on
        compra.id_compra = compraCarrito.id_compra inner join carrito on
        compraCarrito.id_carrito = carrito.id_carrito inner join carritoProducto on 
        carrito.id_carrito = carritoProducto.id_carrito inner join producto on
        carritoProducto.id_producto = producto.id_producto
        where compra.id_usuario = ".$idUsuario;
}

public function consultarCompraProductos($idUsuario){
    return "
        select cliente.id_cliente, cliente.nombre_cliente, cliente.apellido_cliente, cliente.direccion_cliente, 
        cliente.telefono_cliente, compra.id_compra, compra.fecha_compra, compra.numeroArticulos_compra, 
        compra.compraConEntrega, compra.valorTotal_compra, compraProducto.id_producto, 
        compraProducto.cantidad_compraProducto, producto.caracteristicas, producto.valor_producto
        from cliente inner join compra on 
        cliente.id_usuario = compra.id_usuario inner join compraProducto on
        compra.id_compra = compraProducto.id_compra inner join producto on
        compraProducto.id_producto = producto.id_producto
        where compra.id_usuario = ".$idUsuario;
}

public function buscarUsuario($correo, $password){
    return "select * from usuario where usuario.correo_usuario = '".$correo."' 
            and usuario.password_usuario = '".$password."' and usuario.estado_usuario = 1 ";
}

public function productosMasCompradosProducto($idUsuario){
    return "
    select compra.id_usuario, sum(compraProducto.cantidad_compraProducto),
    compraProducto.id_producto 
    from compra inner join compraProducto on
    compra.id_compra = compraProducto.id_compra where 
    compra.id_usuario = ".intval($idUsuario)." GROUP by compraProducto.id_producto limit 0,5";
}

public function productosMasCompradosCarrito($idUsuario){
    return "
    select carrito.id_usuario, sum(carritoProducto.cantidad_carritoProducto), carritoProducto.id_producto
    from carrito inner join carritoProducto on 
    carrito.id_carrito = carritoProducto.id_carrito
    where carrito.estado_carrito = 0 and carrito.id_usuario = ".intval($idUsuario)."
    GROUP by carritoProducto.id_producto";
}

public function consultarTodos() {
    return "select * from usuario order by usuario.id_usuario asc ";
}

public function consultarTotalFilas() {
    return "select count(id_usuario) from usuario";
}

}
?>
