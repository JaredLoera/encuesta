<?php
include 'datosWorker.inc.php';
class informacionWorker{
    public static function capitulo($capitulo_id){
        Conexion::abrir_conexion();
        $conexion = Conexion::obtener_conexion();
        $sql = "SELECT * FROM capitulo WHERE id = ". $capitulo_id;
        $resultados = datosWorker::preguntaOnlyRow($conexion,$sql);
        Conexion::cerrar_conexion();
        return $resultados->numcapitulo;
    }
    public static function titulo($capitulo_id){
        Conexion::abrir_conexion();
        $conexion = Conexion::obtener_conexion();
        $sql = "SELECT * FROM capitulo WHERE id = ". $capitulo_id;
        $resultados = datosWorker::preguntaOnlyRow($conexion,$sql);
        Conexion::cerrar_conexion();
        return $resultados->nombre_examen;
    }
    public static function descripcion($capitulo_id){
        Conexion::abrir_conexion();
        $conexion = Conexion::obtener_conexion();
        $sql = "SELECT * FROM capitulo WHERE id = ". $capitulo_id;
        $resultados = datosWorker::preguntaOnlyRow($conexion,$sql);
        Conexion::cerrar_conexion();
        return $resultados->descripcion;
    }
    public static function preguntas($capitulo_id, $quiz_id){
        $contador = 1;
        Conexion::abrir_conexion();
        $conexion = Conexion::obtener_conexion();
        $sql_fecha = "SELECT fecha_inicio FROM quiz WHERE id =". $quiz_id;
        $resultados_fecha = datosWorker::preguntaOnlyRow($conexion,$sql_fecha);
        $fecha_inicio = $resultados_fecha->fecha_inicio;
        $sql = "SELECT * FROM question WHERE capitulo_id = ". $capitulo_id . " AND fecha_pregunta < '". $fecha_inicio ."'";
        $resultados = datosWorker::preguntas($conexion,$sql);
        Conexion::cerrar_conexion();
        if (!$resultados) {
            ?>
           <h1>No se encontraron preguntas</h1>
            <?php
        }
        foreach($resultados as $resultado){
            ?> 
        <div class="row align-items-start border border-primary text-center fs-5 mt-1" >
        <div class="col-md-4 d-flex align-items-center justify-content-center">
            <span>
                <h5><?php echo $contador .". ";   ?>  <?php echo $resultado->pregunta ?></h5> 
            </span>
        </div>
            <div class="col-md align-items-start">
                <div class="form-row">
                    <div class="col">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="inlineRadioOptions<?php echo $resultado->id;?>" id="inlineRadio1" value="Siempre" required>
                            <label class="form-check-label" for="inlineRadio1">Siempre</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="inlineRadioOptions<?php echo $resultado->id;?>" id="inlineRadio2" value="Casi siempre" required>
                            <label class="form-check-label" for="inlineRadio2">Casi siempre</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="inlineRadioOptions<?php echo $resultado->id;?>" id="inlineRadio3" value="Algunas veces" required>
                            <label class="form-check-label" for="inlineRadio3">Algunas veces</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="inlineRadioOptions<?php echo $resultado->id;?>" id="inlineRadio4" value="Casi nunca" required>
                            <label class="form-check-label" for="inlineRadio4">Casi nunca</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="inlineRadioOptions<?php echo $resultado->id;?>" id="inlineRadio5" value="Nunca" required>
                            <label class="form-check-label" for="inlineRadio5">Nunca</label>
                        </div>
                        <div class="invalid-feedback">More example invalid feedback text</div>
                    </div>
                </div>
            </div>
        </div>
            <?php
            $contador++;
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
    echo "<pre>";
    var_dump($resultados);
    echo "</pre>";
    if (!$resultados) {
        ?>
       <h1 style="color:#DC797F;">No se encontraron examenes</h1>
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
                    <h3 class="card-title">Capitulo <?php echo $resultado-> numcapitulo;?></h3>
                    <p class="card-text fs-5">
                    Descripcion:
                    <?php echo $resultado-> descripcion;?>
                    </p>
       
                    <p class="card-text fs-5">
                    Examenes pendientes:
                    <?php
                    Conexion::abrir_conexion();
                    $dato = datosWorker::preguntaOnlyRow(Conexion::obtener_conexion(),"SELECT count(*)  as num from (select CI.user_id_table,quiz_id,CI.empresa from (select user.id as user_id_table,company_id as empresa from user where contacto_id = $user_id ) as CI join user_answer on user_answer.user_id = CI.user_id_table)as UUA right join quiz on quiz.id = UUA.quiz_id where quiz.capitulo_id= $resultado->idcap and user_id_table is null;");
                    echo $dato->num;
                    Conexion::cerrar_conexion();
                     ?>
                    </div>
                    <div class="card-footer bg-transparent border-success">
                        <h3>
                            <?php if($dato->num == 0): ?>
                                <a href="examenes.php?bloque=<?php echo $resultado->idcap; ?>" class="btn btn-warning disabled" role="button">No hay examenes pendientes</a>
                            <?php else: ?>
                                    <a href="examenes.php?bloque=<?php echo $resultado->idcap; ?>" class="btn btn-success" role="button">Ver examenes</a>
                            <?php endif; ?>
                        </h3>
                    </div>
                </div>
                </div>
            <?php
        }
    }   
 }
 public static function getBlocksAnswersWorker($conexion,$user_id){
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
                    <h5 class="card-title">Respuestas del capitulo <?php echo $resultado-> numcapitulo;?></h5>
                    <p class="card-text">
                        Respuestas:
                    <?php echo $resultado-> descripcion;?>
                    </p>
                    </div>
                    <div class="card-footer bg-transparent border-success">
                    <a href="verexamen.php?bloque=<?php echo$resultado->idcap; ?>" class="btn btn-success" role="button">Ver examenes</a>
                    </div>
                </div>
                </div>
            <?php
        }
    }   
 }
 public static function getAnswersBlock($conexion,$capitulo_id,$user_id){
    $consulta ="SELECT * from (select CI.user_id_table,quiz_id,CI.empresa from (select user.id as user_id_table,company_id as empresa from user where contacto_id =  $user_id) as CI join user_answer on user_answer.user_id = CI.user_id_table)as UUA join quiz on quiz.id = UUA.quiz_id where quiz.capitulo_id= $capitulo_id;
    ";
    $resultados = datosWorker::preguntas($conexion,$consulta);
    if (!$resultados) {
        ?>
       <h1>No se encontraron examenes realizados</h1>
        <?php
    }
    else {
        foreach ($resultados as $info) {
            ?>
           <tr>
                    <th scope="row"><?php echo $info->id ?></th>
                    <td><?php echo $info->fecha_inicio ?></td>
                    <td><a href="respuestasexamen.php?cap=<?php echo $capitulo_id ?>&idExam=<?php echo $info->id ?>" role="button" class="btn btn-primary">Respuestas</a></td>
                    </tr>
        <?php
        }
    }
 }
 //TRABAJANDING EN ESTA FUNCION
 public static function getAnswer($conexion,$quiz_id){
    $consulta = "SELECT answers FROM user_answer where user_answer.id = ".$quiz_id;
    $resultados = datosWorker::preguntaOnlyRow($conexion,$consulta);
    if(!$resultados){
        ?>
        <div class="col">
            <h3>No se encontraron respuestas</h3>
        </div>
        <?php
    }
    else {
        $arreglo = json_decode($resultados->answers);
        foreach ($arreglo as $info) {
            $pregunta = "SELECT * from question where question.id = ".$info->idpregunta;
            $resultadoPregunta = datosWorker::preguntaOnlyRow($conexion,$pregunta);
           ?>
            <tr>
                <th scope="row"><?php echo $info->idpregunta; ?></th>
                <td><?php echo $resultadoPregunta->pregunta; ?></td>
                <td><?php echo $info->respuesta; ?></td>
            </tr>
           <?php 
        }
    }
    ?> 
        <div class="col">
            
        </div>
    <?php
 }
}