<?php
class tipoProductoDAO {
    
private $id_tipoProducto;
private $nombre_tipoProducto;
    
public function tipoProductoDAO( $id_tipoProducto="",$nombre_tipoProducto="" ) {
    
$this -> id_tipoProducto = $id_tipoProducto;
$this -> nombre_tipoProducto = $nombre_tipoProducto;
}

public function crear() {
return "
insert into tipoProducto (nombre_tipoProducto)
values (
 '" .$this -> nombre_tipoProducto. "'
)";
}
    
public function consultarTodos() {
    return "select * from tipoProducto order by tipoProducto.id_tipoProducto asc ";
}

public function consultarTotalFilas() {
    return "select count(id_tipoProducto) from tipoProducto";
}

}
?>