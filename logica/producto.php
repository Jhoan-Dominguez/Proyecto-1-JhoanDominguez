<?php
require_once "persistencia/conexion.php";
require_once "persistencia/productoDAO.php";

class producto {
    
private $id_producto;
private $y_producto;
private $x_producto;
private $z_producto;
private $caracteristicas;
private $estado_producto;
private $valor_producto;
private $id_tipoProducto;
private $conexion;
private $productoDAO;
    

    /**
     * @return
     */
    public function getid_producto() {
        return $this -> id_producto;
    }
    

    /**
     * @return
     */
    public function gety_producto() {
        return $this -> y_producto;
    }
    

    /**
     * @return
     */
    public function getx_producto() {
        return $this -> x_producto;
    }
    

    /**
     * @return
     */
    public function getz_producto() {
        return $this -> z_producto;
    }
    

    /**
     * @return
     */
    public function getcaracteristicas() {
        return $this -> caracteristicas;
    }
    

    /**
     * @return
     */
    public function getestado_producto() {
        return $this -> estado_producto;
    }
    

    /**
     * @return
     */
    public function getvalor_producto() {
        return $this -> valor_producto;
    }
    

    /**
     * @return
     */
    public function getid_tipoProducto() {
        return $this -> id_tipoProducto;
    }
    
    
    public function producto( $id_producto="",$y_producto="",$x_producto="",$z_producto="",$caracteristicas="",$estado_producto="",$valor_producto="",$id_tipoProducto="" ) {
        
        $this -> id_producto = $id_producto;
        $this -> y_producto = $y_producto;
        $this -> x_producto = $x_producto;
        $this -> z_producto = $z_producto;
        $this -> caracteristicas = $caracteristicas;
        $this -> estado_producto = $estado_producto;
        $this -> valor_producto = $valor_producto;
        $this -> id_tipoProducto = $id_tipoProducto;
        $this -> conexion = new conexion();
        $this -> productoDAO = new productoDAO($this->id_producto,$this->y_producto,$this->x_producto,$this->z_producto,$this->caracteristicas,$this->estado_producto,$this->valor_producto,$this->id_tipoProducto);
    }
    
    public function consultarTodos() {
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> productoDAO -> consultarTodos());
        
        $valoresRetornar = array();
        while( ($resultado = $this -> conexion -> extraer()) != null) {
            array_push($valoresRetornar, new producto( $resultado[0],$resultado[1],$resultado[2],$resultado[3],$resultado[4],$resultado[5],$resultado[6],$resultado[7] ));
        }
        $this -> conexion -> cerrar();
        return $valoresRetornar;
    }

    public function consultarProducto($idProducto) {
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> productoDAO -> consultarProducto($idProducto));
        
        $valoresRetornar = array();
        while( ($resultado = $this -> conexion -> extraer()) != null) {
            array_push($valoresRetornar, new producto( $resultado[0],$resultado[1],$resultado[2],$resultado[3],$resultado[4],$resultado[5],$resultado[6],$resultado[7] ));
        }

        $this -> conexion -> cerrar();
        return $valoresRetornar;
    }
    
    public function consultarTotalFilas() {
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> productoDAO -> consultarTotalFilas());
        $resultado = $this -> conexion -> extraer()[0];
        $this -> conexion -> cerrar();
        return $resultado;
    } 
    
    public function crear() {
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> productoDAO -> crear());
        $this -> conexion -> cerrar();
    } 
    
}
?>