<?php
class tiendaDAO {
    
private $id_tienda;
private $nombre_tienda;
private $telefono_tienda;
private $direccion_tienda;
    
public function tiendaDAO( $id_tienda="",$nombre_tienda="",$telefono_tienda="",$direccion_tienda="" ) {
    
$this -> id_tienda = $id_tienda;
$this -> nombre_tienda = $nombre_tienda;
$this -> telefono_tienda = $telefono_tienda;
$this -> direccion_tienda = $direccion_tienda;
}

public function crear() {
return "
insert into tienda (nombre_tienda,telefono_tienda,direccion_tienda)
values (
 '" .$this -> nombre_tienda. "', 
 '" .$this -> telefono_tienda. "', 
 '" .$this -> direccion_tienda. "'

)";
}
    
public function consultarTodos() {
    return "select * from tienda order by tienda.id_tienda asc ";
}

public function consultarTotalFilas() {
    return "select count(id_tienda) from tienda";
}

}
?>