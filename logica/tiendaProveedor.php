<?php
requiere_once "persistencia/conexion.php";
requiere_once "persistencia/tiendaProveedorDAO.php";

class tiendaProveedor {
    
private $id_tiendaProveedor;
private $id_proveedor;
private $id_tienda;
private $id_producto;
private $fechaCompra_tiendaProveedor;
private $cantidad_tiendaProveedor;
private $valorCompra_tiendaProveedor;
private $conexion;
private $tiendaProveedorDAO;
    

    /**
     * @return
     */
    public function getid_tiendaProveedor() {
        return $this -> id_tiendaProveedor;
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
    public function getid_tienda() {
        return $this -> id_tienda;
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
    public function getfechaCompra_tiendaProveedor() {
        return $this -> fechaCompra_tiendaProveedor;
    }
    

    /**
     * @return
     */
    public function getcantidad_tiendaProveedor() {
        return $this -> cantidad_tiendaProveedor;
    }
    

    /**
     * @return
     */
    public function getvalorCompra_tiendaProveedor() {
        return $this -> valorCompra_tiendaProveedor;
    }
    
    
    public function tiendaProveedor( $id_tiendaProveedor="",$id_proveedor="",$id_tienda="",$id_producto="",$fechaCompra_tiendaProveedor="",$cantidad_tiendaProveedor="",$valorCompra_tiendaProveedor="" ) {
        
        $this -> id_tiendaProveedor = $id_tiendaProveedor;
        $this -> id_proveedor = $id_proveedor;
        $this -> id_tienda = $id_tienda;
        $this -> id_producto = $id_producto;
        $this -> fechaCompra_tiendaProveedor = $fechaCompra_tiendaProveedor;
        $this -> cantidad_tiendaProveedor = $cantidad_tiendaProveedor;
        $this -> valorCompra_tiendaProveedor = $valorCompra_tiendaProveedor;
        $this -> conexion = new conexion();
        $this -> tiendaProveedorDAO = new tiendaProveedorDAO($this->id_tiendaProveedor,$this->id_proveedor,$this->id_tienda,$this->id_producto,$this->fechaCompra_tiendaProveedor,$this->cantidad_tiendaProveedor,$this->valorCompra_tiendaProveedor);
    }
    
    public function consultarTodos() {
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> tiendaProveedorDAO -> consultarTodos());
        
        $valoresRetornar = array();
        while( ($resultado = $this -> conexion -> extraer()) != null) {
            array_push($valoresRetornar, new tiendaProveedor( ,$resultado[0],$resultado[1],$resultado[2],$resultado[3],$resultado[4],$resultado[5],$resultado[6] ));
        }
        $this -> conexion -> cerrar();
        return $valoresRetornar;
    }
    
    public function consultarTotalFilas() {
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> tiendaProveedorDAO -> consultarTotalFilas());
        $resultado = $this -> conexion -> extraer()[0];
        $this -> conexion -> cerrar();
        return $resultado;
    } 
    
    public function crear() {
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> tiendaProveedorDAO -> crear());
        $this -> conexion -> cerrar();
    } 
    
}
?>
