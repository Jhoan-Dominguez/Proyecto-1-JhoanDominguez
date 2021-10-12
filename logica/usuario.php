<?php
require_once "persistencia/conexion.php";
require_once "persistencia/usuarioDAO.php";

class usuario {
    
private $id_usuario;
private $correo_usuario;
private $password_usuario;
private $estado_usuario;
private $id_tipoUsuario;
private $conexion;
private $usuarioDAO;
    

    /**
     * @return
     */
    public function getid_usuario() {
        return $this -> id_usuario;
    }
    

    /**
     * @return
     */
    public function getcorreo_usuario() {
        return $this -> correo_usuario;
    }
    

    /**
     * @return
     */
    public function getpassword_usuario() {
        return $this -> password_usuario;
    }
    

    /**
     * @return
     */
    public function getestado_usuario() {
        return $this -> estado_usuario;
    }
    

    /**
     * @return
     */
    public function getid_tipoUsuario() {
        return $this -> id_tipoUsuario;
    }
    
    
    public function usuario( $id_usuario="",$correo_usuario="",$password_usuario="",$estado_usuario="",$id_tipoUsuario="" ) {
        
        $this -> id_usuario = $id_usuario;
        $this -> correo_usuario = $correo_usuario;
        $this -> password_usuario = $password_usuario;
        $this -> estado_usuario = $estado_usuario;
        $this -> id_tipoUsuario = $id_tipoUsuario;
        $this -> conexion = new conexion();
        $this -> usuarioDAO = new usuarioDAO($this->id_usuario,$this->correo_usuario,$this->password_usuario,$this->estado_usuario,$this->id_tipoUsuario);
    }
    
    public function buscarUsuario($correo, $password){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> usuarioDAO -> buscarUsuario($correo, $password));
        
        $valoresRetornar = array();
        while( ($resultado = $this -> conexion -> extraer()) != null) {
            array_push($valoresRetornar, new usuario( $resultado[0],$resultado[1],$resultado[2],$resultado[3],$resultado[4] ));
        }
        $this -> conexion -> cerrar();
        return $valoresRetornar;
    }

    public function actualizarDatos($idUsuario, $correo, $pass){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> usuarioDAO -> actualizarDatos($idUsuario, $correo, $pass) );
        return $valoresRetornar;
    }

    public function consultarTodos() {
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> usuarioDAO -> consultarTodos());
        
        $valoresRetornar = array();
        while( ($resultado = $this -> conexion -> extraer()) != null) {
            array_push($valoresRetornar, new usuario( $resultado[0],$resultado[1],$resultado[2],$resultado[3],$resultado[4] ));
        }
        $this -> conexion -> cerrar();
        return $valoresRetornar;
    }

    public function consultarCompraCarritos($idUsuario){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> usuarioDAO -> consultarCompraCarritos($idUsuario) );
        
        $valoresRetornar = array();
        while( ($resultado = $this -> conexion -> extraer()) != null) {
            array_push($valoresRetornar, [ $resultado[0],$resultado[1],$resultado[2],$resultado[3],$resultado[4],
            $resultado[5],$resultado[6],$resultado[7],$resultado[8],$resultado[9], $resultado[10],$resultado[11],
            $resultado[12],$resultado[13], $resultado[14] ] );
        }
        $this -> conexion -> cerrar();
        return $valoresRetornar;
    }

    public function consultarCompraProductos($idUsuario){

        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> usuarioDAO -> consultarCompraProductos($idUsuario) );
        
        $valoresRetornar = array();
        while( ($resultado = $this -> conexion -> extraer()) != null) {
            array_push($valoresRetornar, [ $resultado[0],$resultado[1],$resultado[2],$resultado[3],$resultado[4],
            $resultado[5],$resultado[6],$resultado[7],$resultado[8],$resultado[9], $resultado[10],$resultado[11],
            $resultado[12], $resultado[13] ] );
        }
        $this -> conexion -> cerrar();
        return $valoresRetornar;

    }
    
    public function consultarTotalFilas() {
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> usuarioDAO -> consultarTotalFilas());
        $resultado = $this -> conexion -> extraer()[0];
        $this -> conexion -> cerrar();
        return $resultado;
    } 
    
    public function crear() {
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> usuarioDAO -> crear());
        $this -> conexion -> cerrar();
    } 
    
}
?>