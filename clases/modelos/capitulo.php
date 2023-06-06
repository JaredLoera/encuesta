<?php
class Capitulo{
    public $numcapitulo;
    public $descripcion;
    public $company_id;
    public $nombre_examen;
    //methods
    function set_numcapitulo($numcapitulo){
        $this->numcapitulo = $numcapitulo;
    }
    function get_numcapitulo(){
        return $this->numcapitulo;
    }
    function set_descripcion($descripcion){
        $this->descripcion = $descripcion;
    }
    function get_descripcion(){
        return $this->descripcion;
    }
    function set_company_id($company_id){
        $this->company_id = $company_id;
    }
    function get_company_id(){
        return $this->company_id;
    }
    function set_nombre_examen($nombre_examen){
        $this->nombre_examen = $nombre_examen;
    }
    function get_nombre_examen(){
        return $this->nombre_examen;
    }
    function save(){
        try {
            Conexion::abrir_conexion();
            $sql = "INSERT INTO capitulo (numcapitulo,descripcion,company_id) VALUES ('$this->numcapitulo','$this->descripcion','$this->company_id')";
            $resultado = Conexion::obtener_conexion()->prepare($sql);
            $resultado->execute();
            return true;
            Conexion::cerrar_conexion();
        }catch (PDOException $ex) {
            print "ERROR: ". $ex->getMessage();
        }
    }
}