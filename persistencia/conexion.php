<?php 
class conexion {
    private $mysql;
    private $resultado;

    public function abrir(){
        $this -> mysql = new mysql("localhost", "root", "", "prontoMuebles");
        $this -> mysql -> set_charset("utf8");
    }

    public function cerrar(){
        $this -> mysql -> close();
    }

    public function ejecutar($sentencia){
        $this -> resultado = $this -> mysqli -> query($sentencia);
    }
    
    public function extraer(){
        return $this -> resultado -> fetch_row();
    }
    
    public function numFilas(){
        return ($this -> resultado != null) ? $this -> resultado -> num_rows : 0; 
    }
}
?>