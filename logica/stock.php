<?php
require_once "persistencia/conexion.php";
require_once "persistencia/stockDAO.php";

class stock {
    
private $id_stock;
private $cantidad;
private $disponibilidad;
private $id_producto;
private $id_tienda;
private $conexion;
private $stockDAO;
    

    /**
     * @return
     */
    public function getid_stock() {
        return $this -> id_stock;
    }
    

    /**
     * @return
     */
    public function getcantidad() {
        return $this -> cantidad;
    }
    

    /**
     * @return
     */
    public function getdisponibilidad() {
        return $this -> disponibilidad;
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
    public function getid_tienda() {
        return $this -> id_tienda;
    }
    
    
    public function stock( $id_stock="",$cantidad="",$disponibilidad="",$id_producto="",$id_tienda="" ) {
        
        $this -> id_stock = $id_stock;
        $this -> cantidad = $cantidad;
        $this -> disponibilidad = $disponibilidad;
        $this -> id_producto = $id_producto;
        $this -> id_tienda = $id_tienda;
        $this -> conexion = new conexion();
        $this -> stockDAO = new stockDAO($this->id_stock,$this->cantidad,$this->disponibilidad,$this->id_producto,$this->id_tienda);
    }
    
    public function consultarTodos() {
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> stockDAO -> consultarTodos());
        
        $valoresRetornar = array();
        while( ($resultado = $this -> conexion -> extraer()) != null) {
            array_push($valoresRetornar, new stock( $resultado[0],$resultado[1],$resultado[2],$resultado[3],$resultado[4] ));
        }
        $this -> conexion -> cerrar();
        return $valoresRetornar;
    }
    
    public function consultarTotalFilas() {
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> stockDAO -> consultarTotalFilas());
        $resultado = $this -> conexion -> extraer()[0];
        $this -> conexion -> cerrar();
        return $resultado;
    }

    public function comprarProductoStock($idProducto, $cantidad){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> stockDAO -> comprarProductoStock($idProducto, $cantidad) );
        $this -> conexion -> cerrar();
    }

    public function actualizarProducto($id_producto, $cantidad){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> stockDAO -> actualizarProducto($id_producto, $cantidad) );
        $this -> conexion -> cerrar();
    }
    
    public function crear() {
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> stockDAO -> crear());
        $this -> conexion -> cerrar();
    }
    
}
?>