<?php 
class userrespuesta{
    public  $user_id;
    public  $quiz_id;
    public  $respuesta;
    public  $fecha_respondido;
   //metods
    public function __construct(){
         $this-> fecha_respondido = date("Y-m-d");
    }
    public function getUser_id(){
        return $this->user_id;
    }
    public function getQuiz_id(){
        return $this->quiz_id;
    }
    public function getRespuesta(){
        return $this->respuesta;
    }
    public function setUser_id($user_id){
        $this->user_id = $user_id;
    }
    public function setquiz_id($quiz_id){
        $this->quiz_id = $quiz_id;
    }
    public function setRespuesta($respuesta){
        $this->respuesta = $respuesta;
    }
    function save(){
        try{
            Conexion::abrir_conexion();
            $conexion = Conexion::obtener_conexion();
            $sql = "INSERT INTO user_answer (user_id, quiz_id, answers,fecha_respondido) VALUES ('$this->user_id','$this->quiz_id','$this->respuesta','$this->fecha_respondido');";
            $resultado = $conexion->prepare($sql);
            $resultado->execute();
            Conexion::cerrar_conexion();
            return true;
        } catch (PDOException $ex){
            print "ERROR: ". $ex ->getMessage();
        }
    }
}