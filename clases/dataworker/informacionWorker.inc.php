<?php
include 'datosWorker.inc.php';
class informacionWorker{
    public static function preguntas($conexion){
        $sql = "SELECT * FROM pregunta";
        $resultados = datosWorker::preguntas($conexion,$sql);
        if (!$resultados) {
            ?>
           <h1>No se encontraron preguntas</h1>
            <?php
        }
        foreach($resultados as $resultado){
            ?>
            
        <div class="row align-items-start border border-primary">
            <div class="col">
                <?php echo $resultado->id ." ";   ?>  <?php echo $resultado->pregunta ?> 
            </div>
            <div class="col border border-warning align-items-start">
            <div class="row">
            <div class="col">
                <div class="row algin-items-start">
                <div class="col">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="inlineRadioOptions<?php echo $resultado->id;?>" id="inlineRadio1" value="siempre" required>
                    <label class="form-check-label" for="inlineRadio1">1</label>
                </div>
                </div>
                <div class="col">
                <div class="col form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="inlineRadioOptions<?php echo $resultado->id;?>" id="inlineRadio2" value="Casi siempre" required>
                    <label class="form-check-label" for="inlineRadio2">2</label>
                </div>
                </div>
                <div class="col">
                <div class="col form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="inlineRadioOptions<?php echo $resultado->id;?>" id="inlineRadio2" value="Algunas veces" required>
                    <label class="form-check-label" for="inlineRadio2">3</label>
                </div>
                </div>
                <div class="col"> 
                    <div class="col form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="inlineRadioOptions<?php echo $resultado->id;?>" id="inlineRadio2" value="Casi nunca" required>
                    <label class="form-check-label" for="inlineRadio2">4</label>
                    </div>
                </div>
                <div class="col">
                    <div class="col form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="inlineRadioOptions<?php echo $resultado->id;?>" id="inlineRadio2" value="Nunca" required>
                    <label class="form-check-label" for="inlineRadio2">5</label>
                    </div>
                </div>
                <div class="invalid-feedback">More example invalid feedback text</div>
                    </div>
                    
                </div>
            </div>
            </div>
        </div>
            <?php
        }
    }
    public static function getNum($conexion,$sql){
        $resultado = datosWorker::count($conexion,$sql);
        return $resultado[0]->num;
}
public static function checkAnswer($user_id):bool{
    $sql="SELECT * FROM respuestasuser WHERE respuestasuser.user_id =". $user_id;
    Conexion::abrir_conexion();
    $resultados = datosWorker::preguntas(Conexion::obtener_conexion(),$sql);
    Conexion::cerrar_conexion();
    if (!$resultados) {
     return false;
    }
    return true;
}
}