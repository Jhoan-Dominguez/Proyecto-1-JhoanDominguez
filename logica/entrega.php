<?php
requiere_once "persistencia/conexion.php";
requiere_once "persistencia/entregaDAO.php";

class entrega {
    
private $id_entrega;
private $estado_entrega;
private $direccion_entrega;
private $valor_entrega;
private $fecha_entrega;
private $id_domiciliario;
private $conexion;
private $entregaDAO;
    

    /**
     * @return
     */
    public function getid_entrega() {
        return $this -> id_entrega;
    }
    

    /**
     * @return
     */
    public function getestado_entrega() {
        return $this -> estado_entrega;
    }
    

    /**
     * @return
     */
    public function getdireccion_entrega() {
        return $this -> direccion_entrega;
    }
    

    /**
     * @return
     */
    public function getvalor_entrega() {
        return $this -> valor_entrega;
    }
    

    /**
     * @return
     */
    public function getfecha_entrega() {
        return $this -> fecha_entrega;
    }
    

    /**
     * @return
     */
    public function getid_domiciliario() {
        return $this -> id_domiciliario;
    }
    
    
    public function entrega( $id_entrega="",$estado_entrega="",$direccion_entrega="",$valor_entrega="",$fecha_entrega="",$id_domiciliario="" ) {
        
$this -> id_entrega = $id_entrega;
$this -> estado_entrega = $estado_entrega;
$this -> direccion_entrega = $direccion_entrega;
$this -> valor_entrega = $valor_entrega;
$this -> fecha_entrega = $fecha_entrega;
$this -> id_domiciliario = $id_domiciliario;
$this -> conexion = new conexion();
$this -> entregaDAO = new entregaDAO($this->id_entrega,$this->estado_entrega,$this->direccion_entrega,$this->valor_entrega,$this->fecha_entrega,$this->id_domiciliario);
    }
    
    public function consultarTodos() {
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> entregaDAO -> consultarTodos());
        
        $valoresRetornar = array();
        while( ($resultado = $this -> conexion -> extraer()) != null) {
            array_push($valoresRetornar, new entrega( $resultado[0],$resultado[1],$resultado[2],$resultado[3],$resultado[4],$resultado[5] ));
        }
        $this -> conexion -> cerrar();
        return $valoresRetornar;
    }
    
    public function consultarTotalFilas() {
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> entregaDAO -> consultarTotalFilas());
        $resultado = $this -> conexion -> extraer()[0];
        $this -> conexion -> cerrar();
        return $resultado;
    } 
    
    public function crear() {
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> entregaDAO -> crear());
        $this -> conexion -> cerrar();
    } 
    
}
?>