<?php
class compraCarritoDAO {
    
private $id_compraCarrito;
private $id_compra;
private $id_carrito;
    
public function compraCarritoDAO( $id_compraCarrito="",$id_compra="",$id_carrito="" ) {
    
$this -> id_compraCarrito = $id_compraCarrito;
$this -> id_compra = $id_compra;
$this -> id_carrito = $id_carrito;
}

public function crear() {
return "
insert into compraCarrito (id_compra,id_carrito)
values (
 '" .$this -> id_compra. "', 
 '" .$this -> id_carrito. "'

)";
}
    
public function consultarTodos() {
    return "select * from compraCarrito order by compraCarrito.id_compraCarrito asc ";
}

public function consultarTotalFilas() {
    return "select count(id_compraCarrito) from compraCarrito";
}

}
?>