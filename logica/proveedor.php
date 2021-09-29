<?php
require_once "persistencia/conexion.php";
require_once "persistencia/proveedorDAO.php";

class proveedor {
    
private $id_proveedor;
private $nombre_proveedor;
private $telefono_proveedor;
private $direccion_proveedor;
private $conexion;
private $proveedorDAO;
    

    /**
     * @return
     */
    public function getid_proveedor() {
        return $this -> id_proveedor;
    }
    

    /**
     * @return
     */
    public function getnombre_proveedor() {
        return $this -> nombre_proveedor;
    }
    

    /**
     * @return
     */
    public function gettelefono_proveedor() {
        return $this -> telefono_proveedor;
    }
    

    /**
     * @return
     */
    public function getdireccion_proveedor() {
        return $this -> direccion_proveedor;
    }
    
    
    public function proveedor( $id_proveedor="",$nombre_proveedor="",$telefono_proveedor="",$direccion_proveedor="" ) {
        
$this -> id_proveedor = $id_proveedor;
$this -> nombre_proveedor = $nombre_proveedor;
$this -> telefono_proveedor = $telefono_proveedor;
$this -> direccion_proveedor = $direccion_proveedor;
$this -> conexion = new conexion();
$this -> proveedorDAO = new proveedorDAO($this->id_proveedor,$this->nombre_proveedor,$this->telefono_proveedor,$this->direccion_proveedor);
    }
    
    public function consultarTodos() {
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> proveedorDAO -> consultarTodos());
        
        $valoresRetornar = array();
        while( ($resultado = $this -> conexion -> extraer()) != null) {
            array_push($valoresRetornar, new proveedor( $resultado[0],$resultado[1],$resultado[2],$resultado[3] ));
        }
        $this -> conexion -> cerrar();
        return $valoresRetornar;
    }
    
    public function consultarTotalFilas() {
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> proveedorDAO -> consultarTotalFilas());
        $resultado = $this -> conexion -> extraer()[0];
        $this -> conexion -> cerrar();
        return $resultado;
    } 
    
    public function crear() {
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> proveedorDAO -> crear());
        $this -> conexion -> cerrar();
    } 
    
}
?>