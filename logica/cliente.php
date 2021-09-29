<?php
require_once "persistencia/conexion.php";
require_once "persistencia/clienteDAO.php";

class cliente {
    
private $id_cliente;
private $nombre_cliente;
private $apellido_cliente;
private $direccion_cliente;
private $telefono_cliente;
private $fechaNacimiento_cliente;
private $id_usuario;
private $conexion;
private $clienteDAO;
    

    /**
     * @return
     */
    public function getid_cliente() {
        return $this -> id_cliente;
    }
    

    /**
     * @return
     */
    public function getnombre_cliente() {
        return $this -> nombre_cliente;
    }
    

    /**
     * @return
     */
    public function getapellido_cliente() {
        return $this -> apellido_cliente;
    }
    

    /**
     * @return
     */
    public function getdireccion_cliente() {
        return $this -> direccion_cliente;
    }
    

    /**
     * @return
     */
    public function gettelefono_cliente() {
        return $this -> telefono_cliente;
    }
    

    /**
     * @return
     */
    public function getfechaNacimiento_cliente() {
        return $this -> fechaNacimiento_cliente;
    }
    

    /**
     * @return
     */
    public function getid_usuario() {
        return $this -> id_usuario;
    }
    
    
    public function cliente( $id_cliente="",$nombre_cliente="",$apellido_cliente="",$direccion_cliente="",$telefono_cliente="",$fechaNacimiento_cliente="",$id_usuario="" ) {
        
$this -> id_cliente = $id_cliente;
$this -> nombre_cliente = $nombre_cliente;
$this -> apellido_cliente = $apellido_cliente;
$this -> direccion_cliente = $direccion_cliente;
$this -> telefono_cliente = $telefono_cliente;
$this -> fechaNacimiento_cliente = $fechaNacimiento_cliente;
$this -> id_usuario = $id_usuario;
$this -> conexion = new conexion();
$this -> clienteDAO = new clienteDAO($this->id_cliente,$this->nombre_cliente,$this->apellido_cliente,$this->direccion_cliente,$this->telefono_cliente,$this->fechaNacimiento_cliente,$this->id_usuario);
    }
    
    public function consultarTodos() {
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> clienteDAO -> consultarTodos());
        
        $valoresRetornar = array();
        while( ($resultado = $this -> conexion -> extraer()) != null) {
            array_push($valoresRetornar, new cliente( $resultado[0],$resultado[1],$resultado[2],$resultado[3],$resultado[4],$resultado[5],$resultado[6] ));
        }
        $this -> conexion -> cerrar();
        return $valoresRetornar;
    }

    public function consultarCliente($id_usuario) {
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> clienteDAO -> consultarCliente($id_usuario));
        
        $valoresRetornar = array();
        while( ($resultado = $this -> conexion -> extraer()) != null) {
            array_push($valoresRetornar, new cliente( $resultado[0],$resultado[1],$resultado[2],$resultado[3],$resultado[4],$resultado[5],$resultado[6] ));
        }
        $this -> conexion -> cerrar();
        return $valoresRetornar;
    }
    
    public function consultarTotalFilas() {
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> clienteDAO -> consultarTotalFilas());
        $resultado = $this -> conexion -> extraer()[0];
        $this -> conexion -> cerrar();
        return $resultado;
    } 
    
    public function crear() {
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> clienteDAO -> crear());
        $this -> conexion -> cerrar();
    } 
    
}
?>