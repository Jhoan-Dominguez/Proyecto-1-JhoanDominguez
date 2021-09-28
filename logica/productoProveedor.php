<?php
requiere_once "persistencia/conexion.php";
requiere_once "persistencia/productoProveedorDAO.php";

class productoProveedor {
    
private $id_productoProveedor;
private $id_producto;
private $id_proveedor;
private $cantidad_productoProveedor;
private $fechaProduccion_productoProveedor;
private $conexion;
private $productoProveedorDAO;
    

    /**
     * @return
     */
    public function getid_productoProveedor() {
        return $this -> id_productoProveedor;
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
    public function getid_proveedor() {
        return $this -> id_proveedor;
    }
    

    /**
     * @return
     */
    public function getcantidad_productoProveedor() {
        return $this -> cantidad_productoProveedor;
    }
    

    /**
     * @return
     */
    public function getfechaProduccion_productoProveedor() {
        return $this -> fechaProduccion_productoProveedor;
    }
    
    
    public function productoProveedor( $id_productoProveedor="",$id_producto="",$id_proveedor="",$cantidad_productoProveedor="",$fechaProduccion_productoProveedor="" ) {
        
$this -> id_productoProveedor = $id_productoProveedor;
$this -> id_producto = $id_producto;
$this -> id_proveedor = $id_proveedor;
$this -> cantidad_productoProveedor = $cantidad_productoProveedor;
$this -> fechaProduccion_productoProveedor = $fechaProduccion_productoProveedor;
$this -> conexion = new conexion();
$this -> productoProveedorDAO = new productoProveedorDAO($this->id_productoProveedor,$this->id_producto,$this->id_proveedor,$this->cantidad_productoProveedor,$this->fechaProduccion_productoProveedor);
    }
    
    public function consultarTodos() {
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> productoProveedorDAO -> consultarTodos());
        
        $valoresRetornar = array();
        while( ($resultado = $this -> conexion -> extraer()) != null) {
            array_push($valoresRetornar, new productoProveedor( $resultado[0],$resultado[1],$resultado[2],$resultado[3],$resultado[4] ));
        }
        $this -> conexion -> cerrar();
        return $valoresRetornar;
    }
    
    public function consultarTotalFilas() {
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> productoProveedorDAO -> consultarTotalFilas());
        $resultado = $this -> conexion -> extraer()[0];
        $this -> conexion -> cerrar();
        return $resultado;
    } 
    
    public function crear() {
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> productoProveedorDAO -> crear());
        $this -> conexion -> cerrar();
    } 
    
}
?>