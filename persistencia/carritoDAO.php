<?php
class carritoDAO {
    
private $id_carrito;
private $numeroArticulos_carrito;
private $valor_carrito;
private $estado_carrito;
private $id_usuario;
    
public function carritoDAO( $id_carrito="",$numeroArticulos_carrito="",$valor_carrito="",$estado_carrito="",$id_usuario="" ) {
    
$this -> id_carrito = $id_carrito;
$this -> numeroArticulos_carrito = $numeroArticulos_carrito;
$this -> valor_carrito = $valor_carrito;
$this -> estado_carrito = $estado_carrito;
$this -> id_usuario = $id_usuario;
}

public function crear() {
return "
insert into carrito (numeroArticulos_carrito,valor_carrito,estado_carrito,id_usuario)
values (
 " .$this -> numeroArticulos_carrito. ", 
 " .$this -> valor_carrito. ", 
 " .$this -> estado_carrito. ", 
 " .$this -> id_usuario. "

)";
}

public function consultarCarritos($id_usuario){
    return "select * from carrito where carrito.id_usuario =".$id_usuario." and carrito.estado_carrito = 1";
}

public function actualizarUnidades($idCarrito, $cantidad, $precio, $tipoOperacion){
    if( $tipoOperacion == "Agregar"){
        return "update carrito set numeroArticulos_carrito = numeroArticulos_carrito + " .$cantidad. ",
        valor_carrito = valor_carrito + " . $precio . "
        where id_carrito = ". $idCarrito ." and estado_carrito = 1";
    }else{
        return "update carrito set numeroArticulos_carrito = numeroArticulos_carrito - " .$cantidad. ",
        valor_carrito = valor_carrito - " . $precio . "
        where id_carrito = ". $idCarrito ." and estado_carrito = 1";
    }
}

public function consultarCarritosComprados() {
    return "
    select * from carrito where estado_carrito = 0 order by carrito.id_carrito asc 
    ";
}

public function  actualizarEstado($idCarrito){
    return "update carrito set estado_carrito = 0 where id_carrito = ". $idCarrito;
}
    
public function consultarTodos() {
    return "select * from carrito order by carrito.id_carrito asc ";
}

public function consultarTotalFilas() {
    return "select count(id_carrito) from carrito";
}

}
?>
