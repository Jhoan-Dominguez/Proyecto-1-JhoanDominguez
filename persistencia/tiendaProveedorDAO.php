
<?php
class tiendaProveedorDAO {
    
private $id_tiendaProveedor;
private $id_proveedor;
private $id_tienda;
private $id_producto;
private $fechaCompra_tiendaProveedor;
private $cantidad_tiendaProveedor;
private $valorCompra_tiendaProveedor;
    
public function tiendaProveedorDAO( $id_tiendaProveedor="",$id_proveedor="",$id_tienda="",$id_producto="",$fechaCompra_tiendaProveedor="",$cantidad_tiendaProveedor="",$valorCompra_tiendaProveedor="" ) {
    
$this -> id_tiendaProveedor = $id_tiendaProveedor;
$this -> id_proveedor = $id_proveedor;
$this -> id_tienda = $id_tienda;
$this -> id_producto = $id_producto;
$this -> fechaCompra_tiendaProveedor = $fechaCompra_tiendaProveedor;
$this -> cantidad_tiendaProveedor = $cantidad_tiendaProveedor;
$this -> valorCompra_tiendaProveedor = $valorCompra_tiendaProveedor;
}

public function crear() {
return "
insert into tiendaProveedor (id_proveedor,id_tienda,id_producto,fechaCompra_tiendaProveedor,cantidad_tiendaProveedor,valorCompra_tiendaProveedor)
values (
 '" .$this -> id_proveedor. "', 
 '" .$this -> id_tienda. "', 
 '" .$this -> id_producto. "', 
 '" .$this -> fechaCompra_tiendaProveedor. "', 
 '" .$this -> cantidad_tiendaProveedor. "', 
 '" .$this -> valorCompra_tiendaProveedor. "'

)";
}
    
public function consultarTodos() {
    return "select * from tiendaProveedor order by tiendaProveedor.id_tiendaProveedor asc ";
}

public function consultarTotalFilas() {
    return "select count(id_tiendaProveedor) from tiendaProveedor";
}

}
?>
