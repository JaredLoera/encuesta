<?php
class company{
    public $name;
    public $regimen;
    public $domicilio;
    public $correo;
    public $pass;
    public $passNoHash;
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
        $this->passNoHash = $pass;      
        $this->pass = password_hash($pass, PASSWORD_DEFAULT);
    }
    function get_passNoHash(){
        return $this->passNoHash;
    }
    function get_pass(){
        return $this->pass;
    }
    function save(){
        try {
        Conexion::abrir_conexion();
        $conexion = Conexion::obtener_conexion();
        $correo = "INSERT INTO contacto (correo,pass,tipo_user_id) VALUES ('$this->correo','$this->pass',2)";
        $resultado = Conexion::obtener_conexion()->prepare($correo);
        $resultado->execute();
        $consutla = "SELECT id FROM contacto WHERE correo = '$this->correo'";
        $sentenica = $conexion->query($consutla);
        $resp = $sentenica->fetch(PDO::FETCH_OBJ);
        $id = $resp->id;
        $sql = "INSERT INTO company (nombre,refimenFiscal,domicilio,contacto_id) VALUES ('$this->name','$this->regimen','$this->domicilio','$id')";
        $resultado = Conexion::obtener_conexion()->prepare($sql);
        $resultado->execute();
        $idEmpresa = $conexion->lastInsertId();
        $call = "CALL crearCapitulos($idEmpresa)";
        $sentenica = $conexion->query($call);
        $caps = "Call obtenerCapitulos($idEmpresa)";
        $sentenica = $conexion->query($caps);
        $resp = $sentenica->fetchAll(PDO::FETCH_OBJ);
        $i = 1;
        foreach ($resp as $ids) {
         $call =  "CALL preguntasCapitulo$i($ids->id)";
            $sentenica = $conexion->query($call);
            $i++;
        }
        return true;
        Conexion::cerrar_conexion();
        }catch (PDOException $ex) {
            echo "ERROR ".$ex->getMessage() ; 
        }  
    }
}