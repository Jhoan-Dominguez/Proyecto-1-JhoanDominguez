<?php
class usuarioDAO {
    
private $id_usuario;
private $correo_usuario;
private $password_usuario;
private $estado_usuario;
private $id_tipoUsuario;
    
public function usuarioDAO( $id_usuario="",$correo_usuario="",$password_usuario="",$estado_usuario="",$id_tipoUsuario="" ) {
    
$this -> id_usuario = $id_usuario;
$this -> correo_usuario = $correo_usuario;
$this -> password_usuario = $password_usuario;
$this -> estado_usuario = $estado_usuario;
$this -> id_tipoUsuario = $id_tipoUsuario;
}

public function crear() {
return "
insert into usuario (correo_usuario,password_usuario,estado_usuario,id_tipoUsuario)
values (
 '" .$this -> correo_usuario. "', 
 '" .$this -> password_usuario. "', 
 '" .$this -> estado_usuario. "', 
 '" .$this -> id_tipoUsuario. "'

)";
}
    
public function consultarTodos() {
    return "select * from usuario order by usuario.id_usuario asc ";
}

public function consultarTotalFilas() {
    return "select count(id_usuario) from usuario";
}

}
?>
