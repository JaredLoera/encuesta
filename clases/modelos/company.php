<?php
class company{
    public $name;
    public $regimen;
    public $domicilio;
    public $correo;
    public $pass;
    // Methods
    function set_name($name) {
      $this->name = $name;
    }
    function get_name() {
      return $this->name;
    }
    function set_refimen($regimen){
        $this->regimen = $regimen;
    }
    function get_refimen(){
        return $this->regimen;
    }
    function set_domicilio($domicilio){
        $this->domicilio = $domicilio;
    }
    function get_domicilio(){
        return $this->domicilio;
    }
    function set_correo($correo){
        $this->correo = $correo;
    }
    function get_correo(){
        return $this->correo;
    }
    function set_pass($pass){
        $this->pass = password_hash($pass, PASSWORD_DEFAULT);
    }
    function get_pass(){
        return $this->pass;
    }
    function save(){
        try {
        Conexion::abrir_conexion();
       ;
        $sql = "INSERT INTO company (nombre,refimenFiscal,domicilio,correo,pass) VALUES ('$this->name','$this->regimen','$this->domicilio','$this->correo','$this->pass')";
        $resultado = Conexion::obtener_conexion()->prepare($sql);
        $resultado->execute();
        Conexion::cerrar_conexion();
        }catch (PDOException $ex) {
            echo "ERROR ".$ex->getMessage() ; 
        }  
    }
}