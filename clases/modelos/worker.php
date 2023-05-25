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
            $sqlContacto = "INSERT INTO contacto (correo,pass,tipo_user_id) VALUES ('$this->correo','$this->pass',3)";
            $resultadoContacto = $conexion->prepare($sqlContacto);
            $resultadoContacto->execute();
            $idContacto = $conexion->lastInsertId();
            $sql = "INSERT INTO user (nombre,ap_paterno,ap_materno,rfc,telefono,contacto_id,company_id) VALUES ('$this->nombre', '$this->ap_paterno', '$this->ap_materno', '$this->rfc', '$this->telefono', $idContacto,$this->idCompany)";
            $resultado = $conexion->prepare($sql);
            $resultado->execute();
            Conexion::cerrar_conexion();
            return true;
        } catch (PDOException $ex){
            print "ERROR: ". $ex ->getMessage();
           
        }
    }
}
//ERROR: SQLSTATE[23000]: Integrity constraint violation: 1452 Cannot add or update a child row: a foreign key constraint fails (`segundoejemplo`.`user`, CONSTRAINT `user_ibfk_1` FOREIGN KEY (`company_id`) REFERENCES `company` (`id`))
