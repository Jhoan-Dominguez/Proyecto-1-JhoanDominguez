<?php
requiere_once "persistencia/conexion.php";
requiere_once "persistencia/carritoDAO.php";

class carrito {
    
private $id_carrito;
private $fecha_carrito;
private $numeroArticulos_carrito;
private $estado_carrito;
private $id_usuario;
private $conexion;
private $carritoDAO;
    

    /**
     * @return
     */
    public function getid_carrito() {
        return $this -> id_carrito;
    }
    

    /**
     * @return
     */
    public function getfecha_carrito() {
        return $this -> fecha_carrito;
    }
    

    /**
     * @return
     */
    public function getnumeroArticulos_carrito() {
        return $this -> numeroArticulos_carrito;
    }
    

    /**
     * @return
     */
    public function getestado_carrito() {
        return $this -> estado_carrito;
    }
    

    /**
     * @return
     */
    public function getid_usuario() {
        return $this -> id_usuario;
    }
    
    
    public function carrito( $id_carrito="",$fecha_carrito="",$numeroArticulos_carrito="",$estado_carrito="",$id_usuario="" ) {
        
$this -> id_carrito = $id_carrito;
$this -> fecha_carrito = $fecha_carrito;
$this -> numeroArticulos_carrito = $numeroArticulos_carrito;
$this -> estado_carrito = $estado_carrito;
$this -> id_usuario = $id_usuario;
$this -> conexion = new conexion();
$this -> carritoDAO = new carritoDAO($this->id_carrito,$this->fecha_carrito,$this->numeroArticulos_carrito,$this->estado_carrito,$this->id_usuario);
    }
    
    public function consultarTodos() {
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> carritoDAO -> consultarTodos());
        
        $valoresRetornar = array();
        while( ($resultado = $this -> conexion -> extraer()) != null) {
            array_push($valoresRetornar, new carrito( $resultado[0],$resultado[1],$resultado[2],$resultado[3],$resultado[4] ));
        }
        $this -> conexion -> cerrar();
        return $valoresRetornar;
    }
    
    public function consultarTotalFilas() {
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> carritoDAO -> consultarTotalFilas());
        $resultado = $this -> conexion -> extraer()[0];
        $this -> conexion -> cerrar();
        return $resultado;
    } 
    
    public function crear() {
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> carritoDAO -> crear());
        $this -> conexion -> cerrar();
    } 
    
}
?>