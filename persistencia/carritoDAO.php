<?php
class carritoDAO {
    
private $id_carrito;
private $fecha_carrito;
private $numeroArticulos_carrito;
private $valor_carrito;
private $estado_carrito;
private $id_usuario;
    
public function carritoDAO( $id_carrito="",$fecha_carrito="",$numeroArticulos_carrito="",$valor_carrito="",$estado_carrito="",$id_usuario="" ) {
    
$this -> id_carrito = $id_carrito;
$this -> fecha_carrito = $fecha_carrito;
$this -> numeroArticulos_carrito = $numeroArticulos_carrito;
$this -> valor_carrito = $valor_carrito;
$this -> estado_carrito = $estado_carrito;
$this -> id_usuario = $id_usuario;
}

public function crear() {
return "
insert into carrito (fecha_carrito,numeroArticulos_carrito,valor_carrito,estado_carrito,id_usuario)
values (
 '" .$this -> fecha_carrito. "', 
 '" .$this -> numeroArticulos_carrito. "', 
 '" .$this -> valor_carrito. "', 
 '" .$this -> estado_carrito. "', 
 '" .$this -> id_usuario. "'

)";
}

public function consultarCarritos($id_usuario){
    return "select * from carrito where carrito.id_usuario = '".$id_usuario."';";
}
    
public function consultarTodos() {
    return "select * from carrito order by carrito.id_carrito asc ";
}

public function consultarTotalFilas() {
    return "select count(id_carrito) from carrito";
}

}
?>
