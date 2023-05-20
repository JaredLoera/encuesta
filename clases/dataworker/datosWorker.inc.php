<?php
class datosWorker{
    public static function preguntas($conexion,$sql){
        try{
        if (isset($conexion)) {
            $sentencia = $conexion->query($sql);
            $resultado  = $sentencia -> fetchAll(PDO::FETCH_OBJ);
            return $resultado;
        }
        }catch(PDOException $ex){
            echo "ERROR ".$ex->getMessage() ; 
        }
    }
}