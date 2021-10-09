<?php
require_once "persistencia/conexion.php";
require_once "persistencia/compraDAO.php";

class compra {
    
private $id_compra;
private $fecha_compra;
private $numeroArticulos_compra;
private $compraConEntrega;
private $valorTotal_compra;
private $id_usuario;
private $id_entrega;
private $id_tienda;
private $conexion;
private $compraDAO;
    

    /**
     * @return
     */
    public function getid_compra() {
        return $this -> id_compra;
    }
    

    /**
     * @return
     */
    public function getfecha_compra() {
        return $this -> fecha_compra;
    }
    

    /**
     * @return
     */
    public function getnumeroArticulos_compra() {
        return $this -> numeroArticulos_compra;
    }
    

    /**
     * @return
     */
    public function getcompraConEntrega() {
        return $this -> compraConEntrega;
    }
    

    /**
     * @return
     */
    public function getvalorTotal_compra() {
        return $this -> valorTotal_compra;
    }
    

    /**
     * @return
     */
    public function getid_usuario() {
        return $this -> id_usuario;
    }
    

    /**
     * @return
     */
    public function getid_entrega() {
        return $this -> id_entrega;
    }
    

    /**
     * @return
     */
    public function getid_tienda() {
        return $this -> id_tienda;
    }
    
    
    public function compra( $id_compra="",$fecha_compra="",$numeroArticulos_compra="",$compraConEntrega="",$valorTotal_compra="",$id_usuario="",$id_entrega="",$id_tienda="" ) {
        
        $this -> id_compra = $id_compra;
        $this -> fecha_compra = $fecha_compra;
        $this -> numeroArticulos_compra = $numeroArticulos_compra;
        $this -> compraConEntrega = $compraConEntrega;
        $this -> valorTotal_compra = $valorTotal_compra;
        $this -> id_usuario = $id_usuario;
        $this -> id_entrega = $id_entrega;
        $this -> id_tienda = $id_tienda;
        $this -> conexion = new conexion();
        $this -> compraDAO = new compraDAO($this->id_compra,$this->fecha_compra,$this->numeroArticulos_compra,$this->compraConEntrega,$this->valorTotal_compra,$this->id_usuario,$this->id_entrega,$this->id_tienda);
    }
    
    public function consultarTodos() {
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> compraDAO -> consultarTodos());
        
        $valoresRetornar = array();
        while( ($resultado = $this -> conexion -> extraer()) != null) {
            array_push($valoresRetornar, new compra( $resultado[0],$resultado[1],$resultado[2],$resultado[3],$resultado[4],$resultado[5],$resultado[6],$resultado[7] ));
        }
        $this -> conexion -> cerrar();
        return $valoresRetornar;
    }
    
    public function consultarTotalFilas() {
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> compraDAO -> consultarTotalFilas());
        $resultado = $this -> conexion -> extraer()[0];
        $this -> conexion -> cerrar();
        return $resultado;
    } 
    
    public function crear() {
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> compraDAO -> crear());
        $this -> conexion -> cerrar();
    } 
    
}
?>