<?php 
class datosCompany{
public static function consultas($conexion,$sql){
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
    public static function count($conexion,$sql){
        try{
            $sentencia = $conexion->query($sql);
            $resultado  = $sentencia -> fetchAll(PDO::FETCH_OBJ);
            return $resultado; 
        }catch(PDOException $ex){
            echo "ERROR ".$ex->getMessage() ; 
        }
    } 
}