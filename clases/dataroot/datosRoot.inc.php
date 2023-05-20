<?php
class datosRoot{
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
    public static function addCompany($conexion,company $company)
    {
        try {
            $cadena = "INSERT INTO company (nombre,refimenFiscal,domicilio,correo,pass) VALUES ('$company->name','$company->regimen','$company->domicilio','$company->correo','$company->pass')";
            $conexion->query($cadena);
        } catch (PDOException $ex) {
            echo "ERROR ".$ex->getMessage() ; 
        }  
    }
}