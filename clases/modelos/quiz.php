<?php
class Quiz{
    public $fecha;
    public $capitulo_id;
    public $bloqueinfo_id;
    //methods
    public function set_capitulo_id($capitulo_id){
        $this->capitulo_id = $capitulo_id;
    }
    public function set_bloqueinfo_id($bloqueinfo_id){
        $this->bloqueinfo_id = $bloqueinfo_id;
    }   
    public function save(){
        try {
            Conexion::abrir_conexion();
            $sql = "INSERT INTO quiz (capitulo_id,bloque_id) VALUES ($this->capitulo_id, $this->bloqueinfo_id)";
            $resultado = Conexion::obtener_conexion()->prepare($sql);
            $resultado->execute();
            Conexion::cerrar_conexion();
            if ($resultado) {
                ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>¡Quiz añadido!</strong> El quiz se añadió correctamente.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <?php
            }else{
                ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>¡Error!</strong> El quiz no se añadió correctamente.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <?php
            }
        }
        catch (PDOException $ex) {
            echo "ERROR ".$ex->getMessage() ; 
        }

    }
    public function saveBloque(){
        try {
            Conexion::abrir_conexion();
            $sql = "INSERT INTO quiz (capitulo_id,bloque_id) VALUES ($this->capitulo_id, $this->bloqueinfo_id)";
            $resultado = Conexion::obtener_conexion()->prepare($sql);
            $resultado->execute();
            Conexion::cerrar_conexion();
        }
        catch (PDOException $ex) {
            echo "ERROR ".$ex->getMessage() ; 
        }

    }
}