<?php
class Worker{
    public $nombre;
    public $ap_paterno;
    public $ap_materno;
    public $rfc;
    public $telefono;
    public $correo;
    public $pass;
    public $passNoHash;
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
        $this->passNoHash = $pass;         
        $this->pass = password_hash($pass, PASSWORD_DEFAULT);
    }
    function get_pass(){
        return $this->pass;
    }
    function get_passNoHash(){
        return $this->passNoHash;
    }
    function set_idCompany($idCompany){
        $this->idCompany = $idCompany;
    }
    function get_idCompany(){
        return $this->idCompany;
    }
    function set_ap_paterno($ap_paterno){
        $this->ap_paterno = $ap_paterno;
    }
    function get_ap_paterno(){
        return $this->ap_paterno;
    }
    function set_ap_materno($ap_materno){
        $this->ap_materno = $ap_materno;
    }
    function get_ap_materno(){
        return $this->ap_materno;
    }
    function set_telefono($telefono){
        $this->telefono = $telefono;
    }
    function get_telefono(){
        return $this->telefono;
    }
    function save(){
        try{
            Conexion::abrir_conexion();
            $conexion = Conexion::obtener_conexion();
            $sql = "INSERT INTO user (nombre, rfc, correo, pass, company_id,telefono, ap_paterno, ap_materno) VALUES ('$this->nombre', '$this->rfc', '$this->correo', '$this->pass', '$this->idCompany', '$this->telefono', '$this->ap_paterno', '$this->ap_materno')";
            $resultado = $conexion->prepare($sql);
            $resultado->execute();
            Conexion::cerrar_conexion();
            return true;
        } catch (PDOException $ex){
            print "ERROR: ". $ex ->getMessage();
           
        }
    }
}