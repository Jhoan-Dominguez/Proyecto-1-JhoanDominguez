<?php
class clienteDAO{

    private $nombre_cliente;

    public function clienteDAO($nombre_cliente=""){
        $this -> nombre_cliente = $nombre_cliente;
    }

    public function crear(){
        return "insert into cliente (nombre_cliente, apellido_cliente, direccion_cliente, telefono_cliente, 
        fechaNacimiento_cliente, id_usuario)
                values (
                '" . $this -> nombre_cliente . "'
                )";
    }

    public function consultarTodos($filas, $pag){
        return "select * from cliente order by cliente.id_cliente asc ";
    }

    public function consultarTotalFilas(){
        return "select count(id_cliente) from cliente";
    }

}
?>