<?php
class tipoUsuarioDAO {
    
private $id_tipoUsuario;
private $nombre_tipoUsuario;
private $nivel_tipoUsuario;
    
public function tipoUsuarioDAO( $id_tipoUsuario="",$nombre_tipoUsuario="",$nivel_tipoUsuario="" ) {
    
$this -> id_tipoUsuario = $id_tipoUsuario;
$this -> nombre_tipoUsuario = $nombre_tipoUsuario;
$this -> nivel_tipoUsuario = $nivel_tipoUsuario;
}

public function crear() {
return "
insert into tipoUsuario (nombre_tipoUsuario,nivel_tipoUsuario)
values (
 '" .$this -> nombre_tipoUsuario. "', 
 " .$this -> nivel_tipoUsuario. "

)";
}
    
public function consultarTodos() {
    return "select * from tipoUsuario order by tipoUsuario.id_tipoUsuario asc ";
}

public function consultarTotalFilas() {
    return "select count(id_tipoUsuario) from tipoUsuario";
}

}
?>