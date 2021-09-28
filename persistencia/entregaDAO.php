<?php
class entregaDAO {
    
private $id_entrega;
private $estado_entrega;
private $direccion_entrega;
private $valor_entrega;
private $fecha_entrega;
private $id_domiciliario;
    
public function entregaDAO( $id_entrega="",$estado_entrega="",$direccion_entrega="",$valor_entrega="",$fecha_entrega="",$id_domiciliario="" ) {
    
$this -> id_entrega = $id_entrega;
$this -> estado_entrega = $estado_entrega;
$this -> direccion_entrega = $direccion_entrega;
$this -> valor_entrega = $valor_entrega;
$this -> fecha_entrega = $fecha_entrega;
$this -> id_domiciliario = $id_domiciliario;
}

public function crear() {
return "
insert into entrega (estado_entrega,direccion_entrega,valor_entrega,fecha_entrega,id_domiciliario)
values (
 '" .$this -> estado_entrega. "', 
 '" .$this -> direccion_entrega. "', 
 '" .$this -> valor_entrega. "', 
 '" .$this -> fecha_entrega. "', 
 '" .$this -> id_domiciliario. "'

)";
}
    
public function consultarTodos() {
    return "select * from entrega order by entrega.id_entrega asc ";
}

public function consultarTotalFilas() {
    return "select count(id_entrega) from entrega";
}

}
?>