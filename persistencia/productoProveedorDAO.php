<?php
class productoProveedorDAO {
    
private $id_productoProveedor;
private $id_producto;
private $id_proveedor;
private $cantidad_productoProveedor;
private $fechaProduccion_productoProveedor;
    
public function productoProveedorDAO( $id_productoProveedor="",$id_producto="",$id_proveedor="",$cantidad_productoProveedor="",$fechaProduccion_productoProveedor="" ) {
    
$this -> id_productoProveedor = $id_productoProveedor;
$this -> id_producto = $id_producto;
$this -> id_proveedor = $id_proveedor;
$this -> cantidad_productoProveedor = $cantidad_productoProveedor;
$this -> fechaProduccion_productoProveedor = $fechaProduccion_productoProveedor;
}

public function crear() {
return "
insert into productoProveedor (id_producto,id_proveedor,cantidad_productoProveedor,fechaProduccion_productoProveedor)
values (
 " .$this -> id_producto. ", 
 " .$this -> id_proveedor. ", 
 " .$this -> cantidad_productoProveedor. ", 
 '" .$this -> fechaProduccion_productoProveedor. "'

)";
}
    
public function consultarTodos() {
    return "select * from productoProveedor order by productoProveedor.id_productoProveedor asc ";
}

public function consultarTotalFilas() {
    return "select count(id_productoProveedor) from productoProveedor";
}

}
?>