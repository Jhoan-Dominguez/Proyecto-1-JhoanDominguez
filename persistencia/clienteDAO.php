
<?php
class clienteDAO {
    
private $id_cliente;
private $nombre_cliente;
private $apellido_cliente;
private $direccion_cliente;
private $telefono_cliente;
private $fechaNacimiento_cliente;
private $id_usuario;
    
public function clienteDAO( $id_cliente="",$nombre_cliente="",$apellido_cliente="",$direccion_cliente="",$telefono_cliente="",$fechaNacimiento_cliente="",$id_usuario="" ) {
    
$this -> id_cliente = $id_cliente;
$this -> nombre_cliente = $nombre_cliente;
$this -> apellido_cliente = $apellido_cliente;
$this -> direccion_cliente = $direccion_cliente;
$this -> telefono_cliente = $telefono_cliente;
$this -> fechaNacimiento_cliente = $fechaNacimiento_cliente;
$this -> id_usuario = $id_usuario;
}

public function crear() {
return "
insert into cliente (nombre_cliente,apellido_cliente,direccion_cliente,telefono_cliente,fechaNacimiento_cliente,id_usuario)
values (
 '" .$this -> nombre_cliente. "', 
 '" .$this -> apellido_cliente. "', 
 '" .$this -> direccion_cliente. "', 
 '" .$this -> telefono_cliente. "', 
 '" .$this -> fechaNacimiento_cliente. "', 
 '" .$this -> id_usuario. "'

)";
}
    
public function consultarTodos() {
    return "select * from cliente order by cliente.id_cliente asc ";
}

public function consultarTotalFilas() {
    return "select count(id_cliente) from cliente";
}

}
?>