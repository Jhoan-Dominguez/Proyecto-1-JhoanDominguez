<?php 
class conexion {
    private $mysqli;
    private $resultado;

    public function abrir(){
        $this -> mysqli = new mysqli("localhost", "root", "", "prontoMuebles");
        $this -> mysqli -> set_charset("utf8");
    }

    public function cerrar(){
        $this -> mysqli -> close();
    }

    public function ejecutar($sentencia){
        $this -> resultado = $this -> mysqli -> query($sentencia);
        printf("Errormessage: %s\n", $this -> mysqli->error);
    }
    
    public function extraer(){
        return $this -> resultado -> fetch_row();
    }
    
    public function numFilas(){
        return ($this -> resultado != null) ? $this -> resultado -> num_rows : 0; 
    }
}
?>