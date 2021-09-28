<?php
class proveedorDAO {
    
private $id_proveedor;
private $nombre_proveedor;
private $telefono_proveedor;
private $direccion_proveedor;
    
public function proveedorDAO( $id_proveedor="",$nombre_proveedor="",$telefono_proveedor="",$direccion_proveedor="" ) {
    
$this -> id_proveedor = $id_proveedor;
$this -> nombre_proveedor = $nombre_proveedor;
$this -> telefono_proveedor = $telefono_proveedor;
$this -> direccion_proveedor = $direccion_proveedor;
}

public function crear() {
return "
insert into proveedor (nombre_proveedor,telefono_proveedor,direccion_proveedor)
values (
 '" .$this -> nombre_proveedor. "', 
 '" .$this -> telefono_proveedor. "', 
 '" .$this -> direccion_proveedor. "'

)";
}
    
public function consultarTodos() {
    return "select * from proveedor order by proveedor.id_proveedor asc ";
}

public function consultarTotalFilas() {
    return "select count(id_proveedor) from proveedor";
}

}
?>