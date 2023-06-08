<?php 
class userrespuesta{
    public  $user_id;
    public  $quiz_id;
    public  $respuesta;
 
   //metods
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
            $sql = "INSERT INTO user_answer (user_id, quiz_id, answers) VALUES ('$this->user_id','$this->quiz_id','$this->respuesta');";
            $resultado = $conexion->prepare($sql);
            $resultado->execute();
            Conexion::cerrar_conexion();
            return true;
        } catch (PDOException $ex){
            print "ERROR: ". $ex ->getMessage();
        }
    }
}