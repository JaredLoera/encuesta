<?php
class Quiz{
    public $nombre;
    public $fecha;
    public $capitulo_id;
    //methods
    public function set_nombre($nombre){
        $this->nombre = $nombre;
    }
    public function set_fecha($fecha){
        $this->fecha = $fecha;
    }
    public function set_capitulo_id($capitulo_id){
        $this->capitulo_id = $capitulo_id;
    }
    public function save(){
        Conexion::abrir_conexion();
        $sql = "INSERT INTO quiz (nombre, fecha, capitulo_id) VALUES ('$this->nombre','$this->fecha',$this->capitulo_id)";
        $resultado = Conexion::obtener_conexion()->prepare($sql);
        $resultado->execute();
        Conexion::cerrar_conexion();
        if ($resultado) {
            ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>¡Quiz añadido!</strong> El quiz se añadio correctamente.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php
        }else{
            ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>¡Error!</strong> El quiz no se añadio correctamente.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php
        }
    }
}