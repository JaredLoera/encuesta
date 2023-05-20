<?php 
class userrespuesta{
   public $user_id;
   public $pregunta_id;
   public $respuesta;
   //metods
    public function __construct($user_id,$pregunta_id,$respuesta){
         $this->user_id = $user_id;
         $this->pregunta_id = $pregunta_id;
         $this->respuesta = $respuesta;
    }
    public function getUser_id(){
        return $this->user_id;
    }
    public function getPregunta_id(){
        return $this->pregunta_id;
    }
    public function getRespuesta(){
        return $this->respuesta;
    }
    public function setUser_id($user_id){
        $this->user_id = $user_id;
    }
    public function setPregunta_id($pregunta_id){
        $this->pregunta_id = $pregunta_id;
    }
    public function setRespuesta($respuesta){
        $this->respuesta = $respuesta;
    }
    function save(){
        try{
            Conexion::abrir_conexion();
            $conexion = Conexion::obtener_conexion();
            $sql = "INSERT INTO respuestasuser (user_id, pregunta_id, respuesta) VALUES ('$this->user_id','$this->pregunta_id','$this->respuesta');";
            $resultado = $conexion->prepare($sql);
            $resultado->execute();
            Conexion::cerrar_conexion();
            return true;
        } catch (PDOException $ex){
            print "ERROR: ". $ex ->getMessage();
           
        }
    }
}