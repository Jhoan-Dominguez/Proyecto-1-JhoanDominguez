<?php
class domiciliarioDAO {
    
private $id_domiciliario;
private $nombre_domiciliario;
private $apellido_domiciliario;
private $codigo_domiciliario;
private $estado_domiciliario;
private $id_usuario;
    
public function domiciliarioDAO( $id_domiciliario="",$nombre_domiciliario="",$apellido_domiciliario="",$codigo_domiciliario="",$estado_domiciliario="",$id_usuario="" ) {
    
$this -> id_domiciliario = $id_domiciliario;
$this -> nombre_domiciliario = $nombre_domiciliario;
$this -> apellido_domiciliario = $apellido_domiciliario;
$this -> codigo_domiciliario = $codigo_domiciliario;
$this -> estado_domiciliario = $estado_domiciliario;
$this -> id_usuario = $id_usuario;
}

public function crear() {
return "
insert into domiciliario (nombre_domiciliario,apellido_domiciliario,codigo_domiciliario,estado_domiciliario,id_usuario)
values (
 '" .$this -> nombre_domiciliario. "', 
 '" .$this -> apellido_domiciliario. "', 
 '" .$this -> codigo_domiciliario. "', 
 '" .$this -> estado_domiciliario. "', 
 '" .$this -> id_usuario. "'

)";
}
    
public function consultarTodos() {
    return "select * from domiciliario order by domiciliario.id_domiciliario asc ";
}

public function consultarTotalFilas() {
    return "select count(id_domiciliario) from domiciliario";
}

}
?>