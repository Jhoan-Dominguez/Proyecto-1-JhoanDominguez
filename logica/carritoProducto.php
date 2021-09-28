<?php
requiere_once "persistencia/conexion.php";
requiere_once "persistencia/carritoProductoDAO.php";

class carritoProducto {
    
private $id_carritoProducto;
private $cantidad_carritoProducto;
private $valor_carritoProducto;
private $id_carrito;
private $id_producto;
private $conexion;
private $carritoProductoDAO;
    

    /**
     * @return
     */
    public function getid_carritoProducto() {
        return $this -> id_carritoProducto;
    }
    

    /**
     * @return
     */
    public function getcantidad_carritoProducto() {
        return $this -> cantidad_carritoProducto;
    }
    

    /**
     * @return
     */
    public function getvalor_carritoProducto() {
        return $this -> valor_carritoProducto;
    }
    

    /**
     * @return
     */
    public function getid_carrito() {
        return $this -> id_carrito;
    }
    

    /**
     * @return
     */
    public function getid_producto() {
        return $this -> id_producto;
    }
    
    
    public function carritoProducto( $id_carritoProducto="",$cantidad_carritoProducto="",$valor_carritoProducto="",$id_carrito="",$id_producto="" ) {
        
$this -> id_carritoProducto = $id_carritoProducto;
$this -> cantidad_carritoProducto = $cantidad_carritoProducto;
$this -> valor_carritoProducto = $valor_carritoProducto;
$this -> id_carrito = $id_carrito;
$this -> id_producto = $id_producto;
$this -> conexion = new conexion();
$this -> carritoProductoDAO = new carritoProductoDAO($this->id_carritoProducto,$this->cantidad_carritoProducto,$this->valor_carritoProducto,$this->id_carrito,$this->id_producto);
    }
    
    public function consultarTodos() {
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> carritoProductoDAO -> consultarTodos());
        
        $valoresRetornar = array();
        while( ($resultado = $this -> conexion -> extraer()) != null) {
            array_push($valoresRetornar, new carritoProducto( $resultado[0],$resultado[1],$resultado[2],$resultado[3],$resultado[4] ));
        }
        $this -> conexion -> cerrar();
        return $valoresRetornar;
    }
    
    public function consultarTotalFilas() {
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> carritoProductoDAO -> consultarTotalFilas());
        $resultado = $this -> conexion -> extraer()[0];
        $this -> conexion -> cerrar();
        return $resultado;
    } 
    
    public function crear() {
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> carritoProductoDAO -> crear());
        $this -> conexion -> cerrar();
    } 
    
}
?>
