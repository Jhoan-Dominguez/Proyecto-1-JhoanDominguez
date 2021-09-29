<?php
require_once "persistencia/conexion.php";
require_once "persistencia/tipoProductoDAO.php";

class tipoProducto {
    
private $id_tipoProducto;
private $nombre_tipoProducto;
private $conexion;
private $tipoProductoDAO;
    

    /**
     * @return
     */
    public function getid_tipoProducto() {
        return $this -> id_tipoProducto;
    }
    

    /**
     * @return
     */
    public function getnombre_tipoProducto() {
        return $this -> nombre_tipoProducto;
    }
    
    
    public function tipoProducto( $id_tipoProducto="",$nombre_tipoProducto="" ) {
        
$this -> id_tipoProducto = $id_tipoProducto;
$this -> nombre_tipoProducto = $nombre_tipoProducto;
$this -> conexion = new conexion();
$this -> tipoProductoDAO = new tipoProductoDAO($this->id_tipoProducto,$this->nombre_tipoProducto);
    }
    
    public function consultarTodos() {
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> tipoProductoDAO -> consultarTodos());
        
        $valoresRetornar = array();
        while( ($resultado = $this -> conexion -> extraer()) != null) {
            array_push($valoresRetornar, new tipoProducto( $resultado[0],$resultado[1] ));
        }
        $this -> conexion -> cerrar();
        return $valoresRetornar;
    }
    
    public function consultarTotalFilas() {
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> tipoProductoDAO -> consultarTotalFilas());
        $resultado = $this -> conexion -> extraer()[0];
        $this -> conexion -> cerrar();
        return $resultado;
    } 
    
    public function crear() {
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> tipoProductoDAO -> crear());
        $this -> conexion -> cerrar();
    } 
    
}
?>