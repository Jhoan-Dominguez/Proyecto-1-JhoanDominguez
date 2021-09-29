<?php
require_once "persistencia/conexion.php";
require_once "persistencia/compraCarritoDAO.php";

class compraCarrito {
    
private $id_compraCarrito;
private $id_compra;
private $id_carrito;
private $conexion;
private $compraCarritoDAO;
    

    /**
     * @return
     */
    public function getid_compraCarrito() {
        return $this -> id_compraCarrito;
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
    public function getid_carrito() {
        return $this -> id_carrito;
    }
    
    
    public function compraCarrito( $id_compraCarrito="",$id_compra="",$id_carrito="" ) {
        
$this -> id_compraCarrito = $id_compraCarrito;
$this -> id_compra = $id_compra;
$this -> id_carrito = $id_carrito;
$this -> conexion = new conexion();
$this -> compraCarritoDAO = new compraCarritoDAO($this->id_compraCarrito,$this->id_compra,$this->id_carrito);
    }
    
    public function consultarTodos() {
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> compraCarritoDAO -> consultarTodos());
        
        $valoresRetornar = array();
        while( ($resultado = $this -> conexion -> extraer()) != null) {
            array_push($valoresRetornar, new compraCarrito( $resultado[0],$resultado[1],$resultado[2] ));
        }
        $this -> conexion -> cerrar();
        return $valoresRetornar;
    }
    
    public function consultarTotalFilas() {
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> compraCarritoDAO -> consultarTotalFilas());
        $resultado = $this -> conexion -> extraer()[0];
        $this -> conexion -> cerrar();
        return $resultado;
    } 
    
    public function crear() {
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> compraCarritoDAO -> crear());
        $this -> conexion -> cerrar();
    } 
    
}
?>