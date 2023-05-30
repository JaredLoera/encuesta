<?php
include 'datosWorker.inc.php';
class informacionWorker{
    public static function preguntas($capitulo_id){
        Conexion::abrir_conexion();
        $conexion = Conexion::obtener_conexion();
        $sql = "SELECT * from question where question.capitulo_id =". $capitulo_id;
        $resultados = datosWorker::preguntas($conexion,$sql);
        Conexion::cerrar_conexion();
        if (!$resultados) {
            ?>
           <h1>No se encontraron preguntas</h1>
            <?php
        }
        foreach($resultados as $resultado){
            ?>
            
        <div class="row align-items-start border border-primary">
            <div class="col-4 d-flex align-items-center">
                <span class="align-middle mt-2">
               <h6><?php echo $resultado->id ." ";   ?>  <?php echo $resultado->pregunta ?></h6> 
                </span>
            </div>
            <div class="col border border-warning align-items-start">
            <div class="row mt-3">
            <div class="col">
                <div class="row algin-items-start">
                <div class="col">
                <div class="form-check form-check-inline mb-1">
                    <input class="form-check-input" type="radio" name="inlineRadioOptions<?php echo $resultado->id;?>" id="inlineRadio1" value="Siempre" required>
                    <label class="form-check-label" for="inlineRadio1">Siempre</label>
                </div>
                </div>
                <div class="col">
                <div class="col form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="inlineRadioOptions<?php echo $resultado->id;?>" id="inlineRadio2" value="Casi siempre" required>
                    <label class="form-check-label" for="inlineRadio2">Casi siempre</label>
                </div>
                </div>
                <div class="col">
                <div class="col form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="inlineRadioOptions<?php echo $resultado->id;?>" id="inlineRadio2" value="Algunas veces" required>
                    <label class="form-check-label" for="inlineRadio2">Algunas veces</label>
                </div>
                </div>
                <div class="col"> 
                    <div class="col form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="inlineRadioOptions<?php echo $resultado->id;?>" id="inlineRadio2" value="Casi nunca" required>
                    <label class="form-check-label" for="inlineRadio2">Casi nunca</label>
                    </div>
                </div>
                <div class="col">
                    <div class="col form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="inlineRadioOptions<?php echo $resultado->id;?>" id="inlineRadio2" value="Nunca" required>
                    <label class="form-check-label" for="inlineRadio2">Nunca</label>
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
public static function quizNoFinished($contacto_id,$capitulo_id){
    $sql = "SELECT * from (select CI.user_id_table,quiz_id,CI.empresa from (select user.id as user_id_table,company_id as empresa from user where contacto_id =  $contacto_id ) as CI join user_answer on user_answer.user_id = CI.user_id_table)as UUA right join quiz on quiz.id = UUA.quiz_id where quiz.capitulo_id= $capitulo_id and user_id_table is null;";
    Conexion::abrir_conexion();
    $resultados = datosWorker::preguntas(Conexion::obtener_conexion(),$sql);
    Conexion::cerrar_conexion();
    if (!$resultados) {
        ?>
       <h1>No se encontraron examenes</h1>
        <?php
    }
    else {
        foreach ($resultados as $info) {
            ?>
           <tr>
                    <th scope="row"><?php echo $info->id ?></th>
                    <td><?php echo $info->fecha_inicio ?></td>
                    <td><a href="responder.php?cap=<?php echo $capitulo_id ?>&idExam=<?php echo $info->id ?>" role="button" class="btn btn-primary">Responder</a></td>
                    </tr>
        <?php
        }
    }
}
public static function getBlocksWorker($conexion,$user_id){
    $consulta = "SELECT DISTINCT capitulo.descripcion,capitulo.id as idcap,numcapitulo FROM quiz join capitulo on capitulo.id = quiz.capitulo_id join user on user.company_id = capitulo.company_id join contacto on contacto.id = user.contacto_id where contacto_id =" . $user_id;
    $resultados = datosWorker::preguntas($conexion,$consulta);
    if (!$resultados) {
        ?>
       <h1>No se encontraron contenedores asignados</h1>
        <?php
    }else {
        foreach($resultados as $resultado){
            ?>
             <div class="col">
                <div class="card h-100">
                    <div class="card-body">
                    <h5 class="card-title">Capitulo <?php echo $resultado-> numcapitulo;?></h5>
                    <p class="card-text">
                    <?php echo $resultado-> descripcion;?>
                    </p>
                    </div>
                    <div class="card-footer bg-transparent border-success">
                    <a href="examenes.php?bloque=<?php echo$resultado->idcap; ?>" class="btn btn-success" role="button">Ver encuestas</a>
                    </div>
                </div>
                </div>
            <?php
        }
    }
   
}
}