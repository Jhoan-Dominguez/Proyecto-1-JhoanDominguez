<?php
class stockDAO {
    
private $id_stock;
private $cantidad;
private $disponibilidad;
private $id_producto;
private $id_tienda;
    
public function stockDAO( $id_stock="",$cantidad="",$disponibilidad="",$id_producto="",$id_tienda="" ) {
    
$this -> id_stock = $id_stock;
$this -> cantidad = $cantidad;
$this -> disponibilidad = $disponibilidad;
$this -> id_producto = $id_producto;
$this -> id_tienda = $id_tienda;
}

public function crear() {
return "
    insert into stock (cantidad,disponibilidad,id_producto,id_tienda)
    values (
    " .$this -> cantidad. ", 
    " .$this -> disponibilidad. ", 
    " .$this -> id_producto. ", 
    " .$this -> id_tienda. "

    )";
}

public function actualizarProducto($id_producto, $cantidad){
return "
    update stock set cantidad = cantidad - " .$cantidad. "
    where stock.id_producto = ". $id_producto ."
";
}

public function comprarProductoStock($idProducto, $cantidad){
return "
    update stock set cantidad = cantidad + ".intval($cantidad)."
    where stock.id_producto = ". intval($idProducto);
}
    
public function consultarTodos() {
    return "select * from stock order by stock.id_stock asc ";
}

public function consultarTotalFilas() {
    return "select count(id_stock) from stock";
}

}
?>