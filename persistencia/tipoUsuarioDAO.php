<?php
class tipoUsuarioDAO{

    private $nombre_tipoUsuario;
    private $nivel_tipoUsuario;

    public function tipoUsuarioDAO($nombre_tipoUsuario="", $nivel_tipoUsuario=""){
        $this -> nombre_tipoUsuario = $nombre_tipoUsuario;
        $this -> nivel_tipoUsuario = $nivel_tipoUsuario;
    }

    public function crear(){
        return "insert into cliente (nombre_tipoUsuario, nivel_tipoUsuario)
                values (
                '" . $this -> nombre_tipoUsuario . "',
                '" . $this -> nivel_tipoUsuario . "'
                )";
    }

    public function consultarTodos($filas, $pag){
        return "select * from tipoUsuario order by tipoUsuario.id_tipoUsuario asc ";
    }

    public function consultarTotalFilas(){
        return "select count(id_tipoUsuario) from tipoUsuario";
    }

}
?>