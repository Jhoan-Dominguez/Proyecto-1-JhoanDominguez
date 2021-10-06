<?php
class compraDAO {
    
private $id_compra;
private $fecha_compra;
private $numeroArticulos_compra;
private $compraConEntrega;
private $valorTotal_compra;
private $id_usuario;
private $id_entrega;
private $id_tienda;
    
public function compraDAO( $id_compra="",$fecha_compra="",$numeroArticulos_compra="",$compraConEntrega="",$valorTotal_compra="",$id_usuario="",$id_entrega="",$id_tienda="" ) {
    
$this -> id_compra = $id_compra;
$this -> fecha_compra = $fecha_compra;
$this -> numeroArticulos_compra = $numeroArticulos_compra;
$this -> compraConEntrega = $compraConEntrega;
$this -> valorTotal_compra = $valorTotal_compra;
$this -> id_usuario = $id_usuario;
$this -> id_entrega = $id_entrega;
$this -> id_tienda = $id_tienda;
}

public function crear() {
return "
insert into compra (fecha_compra,numeroArticulos_compra,compraConEntrega,valorTotal_compra,id_usuario,id_entrega,id_tienda)
values (
 '" .$this -> fecha_compra. "', 
 " .$this -> numeroArticulos_compra. ", 
 " .$this -> compraConEntrega. ", 
 " .$this -> valorTotal_compra. ", 
 " .$this -> id_usuario. ", 
 " .$this -> id_entrega. ", 
 " .$this -> id_tienda. "

)";
}
    
public function consultarTodos() {
    return "select * from compra order by compra.id_compra asc ";
}

public function consultarTotalFilas() {
    return "select count(id_compra) from compra";
}

}
?>