<?php
class Worker{
    public $nombre;
    public $rfc;
    public $correo;
    public $pass;
    public $idCompany;
    // Methods 
    function set_nombre($nombre) {
      $this->nombre = $nombre;
    }
    function get_nombre() {
      return $this->nombre;
    }
    function set_rfc($rfc){
        $this->rfc = $rfc;
    }
    function get_rfc(){
        return $this->rfc;
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
    function set_idCompany($idCompany){
        $this->idCompany = $idCompany;
    }
    function save(){
        try{
            Conexion::abrir_conexion();
            $conexion = Conexion::obtener_conexion();
            $sql = "INSERT INTO user (nombre, rfc, correo, pass, company_id) VALUES ('$this->nombre', '$this->rfc', '$this->correo', '$this->pass', '$this->idCompany')";
            $resultado = $conexion->prepare($sql);
            $resultado->execute();
            Conexion::cerrar_conexion();
            return true;
        } catch (PDOException $ex){
            print "ERROR: ". $ex ->getMessage();
           
        }
    }
}