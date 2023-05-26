<?php
class question{
    public $pregunta;
    public $capitulo;
    //methods
    public function set_pregunta($pregunta){
        $this->pregunta = $pregunta;
    }
    public function set_capitulo($capitulo){
        $this->capitulo = $capitulo;
    }
    public function save(){
        Conexion::abrir_conexion();
        $sql = "INSERT INTO question (pregunta, capitulo_id) VALUES ('$this->pregunta',$this->capitulo)";
        $resultado = Conexion::obtener_conexion()->prepare($sql);
        $resultado->execute();
        Conexion::cerrar_conexion();
        if ($resultado) {
            ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>¡Pregunta añadida!</strong> La pregunta se añadio correctamente.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php
        }else{
            ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>¡Error!</strong> La pregunta no se añadio correctamente.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php
        }
    }
}