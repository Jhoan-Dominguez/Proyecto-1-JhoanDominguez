<?php
require_once "persistencia/conexion.php";
require_once "persistencia/domiciliarioDAO.php";

class domiciliario {
    
private $id_domiciliario;
private $nombre_domiciliario;
private $apellido_domiciliario;
private $codigo_domiciliario;
private $estado_domiciliario;
private $id_usuario;
private $conexion;
private $domiciliarioDAO;
    

    /**
     * @return
     */
    public function getid_domiciliario() {
        return $this -> id_domiciliario;
    }
    

    /**
     * @return
     */
    public function getnombre_domiciliario() {
        return $this -> nombre_domiciliario;
    }
    

    /**
     * @return
     */
    public function getapellido_domiciliario() {
        return $this -> apellido_domiciliario;
    }
    

    /**
     * @return
     */
    public function getcodigo_domiciliario() {
        return $this -> codigo_domiciliario;
    }
    

    /**
     * @return
     */
    public function getestado_domiciliario() {
        return $this -> estado_domiciliario;
    }
    

    /**
     * @return
     */
    public function getid_usuario() {
        return $this -> id_usuario;
    }
    
    
    public function domiciliario( $id_domiciliario="",$nombre_domiciliario="",$apellido_domiciliario="",$codigo_domiciliario="",$estado_domiciliario="",$id_usuario="" ) {
        
        $this -> id_domiciliario = $id_domiciliario;
        $this -> nombre_domiciliario = $nombre_domiciliario;
        $this -> apellido_domiciliario = $apellido_domiciliario;
        $this -> codigo_domiciliario = $codigo_domiciliario;
        $this -> estado_domiciliario = $estado_domiciliario;
        $this -> id_usuario = $id_usuario;
        $this -> conexion = new conexion();
        $this -> domiciliarioDAO = new domiciliarioDAO($this->id_domiciliario,$this->nombre_domiciliario,$this->apellido_domiciliario,$this->codigo_domiciliario,$this->estado_domiciliario,$this->id_usuario);
    }
    
    public function consultarTodos() {
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> domiciliarioDAO -> consultarTodos());
        
        $valoresRetornar = array();
        while( ($resultado = $this -> conexion -> extraer()) != null) {
            array_push($valoresRetornar, new domiciliario( $resultado[0],$resultado[1],$resultado[2],$resultado[3],$resultado[4],$resultado[5] ));
        }
        $this -> conexion -> cerrar();
        return $valoresRetornar;
    }

    public function consultarIdsDomiciliario(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> domiciliarioDAO -> consultarIdsDomiciliario());
        
        $valoresRetornar = array();
        while( ($resultado = $this -> conexion -> extraer()) != null) {
            array_push($valoresRetornar, [$resultado[0],$resultado[1], $resultado[2]]);
        }
        $this -> conexion -> cerrar();
        return $valoresRetornar;
    }
    
    public function consultarTotalFilas() {
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> domiciliarioDAO -> consultarTotalFilas());
        $resultado = $this -> conexion -> extraer()[0];
        $this -> conexion -> cerrar();
        return $resultado;
    } 
    
    public function crear() {
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> domiciliarioDAO -> crear());
        $this -> conexion -> cerrar();
    } 
    
}
?>