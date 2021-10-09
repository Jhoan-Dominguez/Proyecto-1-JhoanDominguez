<?php
class productoDAO {
    
private $id_producto;
private $y_producto;
private $x_producto;
private $z_producto;
private $caracteristicas;
private $estado_producto;
private $valor_producto;
private $id_tipoProducto;
    
public function productoDAO( $id_producto="",$y_producto="",$x_producto="",$z_producto="",$caracteristicas="",$estado_producto="",$valor_producto="",$id_tipoProducto="" ) {
    
$this -> id_producto = $id_producto;
$this -> y_producto = $y_producto;
$this -> x_producto = $x_producto;
$this -> z_producto = $z_producto;
$this -> caracteristicas = $caracteristicas;
$this -> estado_producto = $estado_producto;
$this -> valor_producto = $valor_producto;
$this -> id_tipoProducto = $id_tipoProducto;
}

public function crear() {
return "
insert into producto (y_producto,x_producto,z_producto,caracteristicas,estado_producto,valor_producto,id_tipoProducto)
values (
 " .$this -> y_producto. ", 
 " .$this -> x_producto. ", 
 " .$this -> z_producto. ", 
 '" .$this -> caracteristicas. "', 
 " .$this -> estado_producto. ", 
 " .$this -> valor_producto. ", 
 " .$this -> id_tipoProducto. "
)";
}

public function consultarProducto($idProducto){
    return "select * from producto where producto.id_producto = ".$idProducto;
}
    
public function consultarTodos() {
    return "select * from producto order by producto.id_producto asc ";
}

public function consultarTotalFilas() {
    return "select count(id_producto) from producto";
}

}
?>
