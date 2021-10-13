<?php
class compraProductoDAO {
    
private $id_compraProducto;
private $id_compra;
private $id_producto;
private $cantidad_compraProducto;
private $valor_compraProducto;
    
public function compraProductoDAO( $id_compraProducto="",$id_compra="",$id_producto="",$cantidad_compraProducto="",$valor_compraProducto="" ) {
    
$this -> id_compraProducto = $id_compraProducto;
$this -> id_compra = $id_compra;
$this -> id_producto = $id_producto;
$this -> cantidad_compraProducto = $cantidad_compraProducto;
$this -> valor_compraProducto = $valor_compraProducto;
}

public function crear() {
return "
insert into compraProducto (id_compra,id_producto,cantidad_compraProducto,valor_compraProducto)
values (
" .$this -> id_compra. ", 
" .$this -> id_producto. ", 
" .$this -> cantidad_compraProducto. ", 
" .$this -> valor_compraProducto. ")";
}

public function consultarCantidadProductos(){
    return "
    SELECT id_producto, sum(cantidad_compraProducto) as cantidad 
    from compraProducto GROUP by id_producto;
    ";
}
    
public function consultarTodos() {
    return "select * from compraProducto order by compraProducto.id_compraProducto asc ";
}

public function consultarTotalFilas() {
    return "select count(id_compraProducto) from compraProducto";
}

}
?>