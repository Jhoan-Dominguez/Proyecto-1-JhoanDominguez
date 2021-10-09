<?php
require_once "persistencia/conexion.php";
require_once "persistencia/compraProductoDAO.php";

class compraProducto {
    
private $id_compraProducto;
private $id_compra;
private $id_producto;
private $cantidad_compraProducto;
private $valor_compraProducto;
private $conexion;
private $compraProductoDAO;
    

    /**
     * @return
     */
    public function getid_compraProducto() {
        return $this -> id_compraProducto;
    }
    

    /**
     * @return
     */
    public function getid_compra() {
        return $this -> id_compra;
    }
    

    /**
     * @return
     */
    public function getid_producto() {
        return $this -> id_producto;
    }
    

    /**
     * @return
     */
    public function getcantidad_compraProducto() {
        return $this -> cantidad_compraProducto;
    }
    

    /**
     * @return
     */
    public function getvalor_compraProducto() {
        return $this -> valor_compraProducto;
    }
    
    
    public function compraProducto( $id_compraProducto="",$id_compra="",$id_producto="",$cantidad_compraProducto="",$valor_compraProducto="" ) {
        
        $this -> id_compraProducto = $id_compraProducto;
        $this -> id_compra = $id_compra;
        $this -> id_producto = $id_producto;
        $this -> cantidad_compraProducto = $cantidad_compraProducto;
        $this -> valor_compraProducto = $valor_compraProducto;
        $this -> conexion = new conexion();
        $this -> compraProductoDAO = new compraProductoDAO($this->id_compraProducto,$this->id_compra,$this->id_producto,$this->cantidad_compraProducto,$this->valor_compraProducto);
    }
    
    public function consultarTodos() {
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> compraProductoDAO -> consultarTodos());
        
        $valoresRetornar = array();
        while( ($resultado = $this -> conexion -> extraer()) != null) {
            array_push($valoresRetornar, new compraProducto( $resultado[0],$resultado[1],$resultado[2],$resultado[3],$resultado[4] ));
        }
        $this -> conexion -> cerrar();
        return $valoresRetornar;
    }
    
    public function consultarTotalFilas() {
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> compraProductoDAO -> consultarTotalFilas());
        $resultado = $this -> conexion -> extraer()[0];
        $this -> conexion -> cerrar();
        return $resultado;
    } 
    
    public function crear() {
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> compraProductoDAO -> crear());
        $this -> conexion -> cerrar();
    } 
    
}
?>