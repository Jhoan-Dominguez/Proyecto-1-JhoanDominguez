<?php
class carritoProductoDAO {
    
private $id_carritoProducto;
private $cantidad_carritoProducto;
private $valor_carritoProducto;
private $id_carrito;
private $id_producto;
    
public function carritoProductoDAO( $id_carritoProducto="",$cantidad_carritoProducto="",$valor_carritoProducto="",$id_carrito="",$id_producto="" ) {
    
$this -> id_carritoProducto = $id_carritoProducto;
$this -> cantidad_carritoProducto = $cantidad_carritoProducto;
$this -> valor_carritoProducto = $valor_carritoProducto;
$this -> id_carrito = $id_carrito;
$this -> id_producto = $id_producto;
}

public function crear() {
return "
insert into carritoProducto (cantidad_carritoProducto,valor_carritoProducto,id_carrito,id_producto)
values (
 " .$this -> cantidad_carritoProducto. ", 
 " .$this -> valor_carritoProducto. ", 
 " .$this -> id_carrito. ", 
 " .$this -> id_producto. "

)";
}
    
public function consultarTodos() {
    return "select * from carritoProducto order by carritoProducto.id_carritoProducto asc ";
}

public function consultarTotalFilas() {
    return "select count(id_carritoProducto) from carritoProducto";
}

}
?>