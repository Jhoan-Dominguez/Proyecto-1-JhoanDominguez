<?php
requiere_once "persistencia/conexion.php";
requiere_once "persistencia/tiendaDAO.php";

class tienda {
    
private $id_tienda;
private $nombre_tienda;
private $telefono_tienda;
private $direccion_tienda;
private $conexion;
private $tiendaDAO;
    

    /**
     * @return
     */
    public function getid_tienda() {
        return $this -> id_tienda;
    }
    

    /**
     * @return
     */
    public function getnombre_tienda() {
        return $this -> nombre_tienda;
    }
    

    /**
     * @return
     */
    public function gettelefono_tienda() {
        return $this -> telefono_tienda;
    }
    

    /**
     * @return
     */
    public function getdireccion_tienda() {
        return $this -> direccion_tienda;
    }
    
    
    public function tienda( $id_tienda="",$nombre_tienda="",$telefono_tienda="",$direccion_tienda="" ) {
        
$this -> id_tienda = $id_tienda;
$this -> nombre_tienda = $nombre_tienda;
$this -> telefono_tienda = $telefono_tienda;
$this -> direccion_tienda = $direccion_tienda;
$this -> conexion = new conexion();
$this -> tiendaDAO = new tiendaDAO($this->id_tienda,$this->nombre_tienda,$this->telefono_tienda,$this->direccion_tienda);
    }
    
    public function consultarTodos() {
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> tiendaDAO -> consultarTodos());
        
        $valoresRetornar = array();
        while( ($resultado = $this -> conexion -> extraer()) != null) {
            array_push($valoresRetornar, new tienda( $resultado[0],$resultado[1],$resultado[2],$resultado[3] ));
        }
        $this -> conexion -> cerrar();
        return $valoresRetornar;
    }
    
    public function consultarTotalFilas() {
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> tiendaDAO -> consultarTotalFilas());
        $resultado = $this -> conexion -> extraer()[0];
        $this -> conexion -> cerrar();
        return $resultado;
    } 
    
    public function crear() {
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> tiendaDAO -> crear());
        $this -> conexion -> cerrar();
    } 
    
}
?>