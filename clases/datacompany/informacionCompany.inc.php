<?php
include "datosCompany.inc.php";
class informacionCompany{
    
    public static function Encuestas($conexion, $id)
    {

        $consulta = "SELECT * from quiz where quiz.company_id= '$id'";
        $resultados = datosCompany::consultas($conexion,$consulta);
        if (!$resultados) {
            ?>
            <h1>No se encontraron encuestas</h1>
            <?php
        }
        foreach($resultados as $resultado){ 
         ?>
           <div class="col">
            <div class="card">
            <div class="card-body">
                <h5 class="card-title">Nombre: <?php echo $resultado->nombre ?></h5>
                <p class="card-text">Descripcion de la encuesta:<?php echo $resultado->descripcion ?></p>
            </div>
            <div class="card-footer bg-transparent"><a href="http://">Ver detalles</a> </div>
            </div>
        </div>
         <?php
         }
    }
    public static function getNum($conexion,$sql){
            $resultado = datosCompany::count($conexion,$sql);
            return $resultado[0]->num;
    }
    public static function getWorkers($conexion,$id){
        $consulta = "SELECT user.id ,concat(nombre, ' ',ap_paterno,' ',ap_materno) as nombre ,telefono,correo,rfc FROM user join contacto on  contacto.id = user.contacto_id where user.company_id=".$id;
        $resultados = datosCompany::consultas($conexion,$consulta);
        if (!$resultados) {
            ?>
            <tr>
                <td colspan="5" class="text-center"><?php echo "No hay datos";?></td>
            </tr>
            <?php
        }
        foreach ($resultados as $info) {
            ?>
            <tr>
                <td><?php echo $info->id; ?></td>
                <td><?php echo $info->nombre; ?></td>
                <td><?php echo $info->rfc; ?></td>
                <td><?php echo $info->correo; ?></td>
                <td><?php echo $info->telefono; ?></td>
                <td>
                    <form action="respuestasWorker.php?id=<?php echo $info->id; ?>" method="post">
                        <button type="submit" class="btn btn-outline-primary">Ver encuesta</button>
                    </form>
                </td>
            </tr>
            <?php
        }
    }
    public static function getAnswersUser($conexion,$id){
        $consulta ="SELECT pregunta.id as id_pregunta,pregunta.pregunta as pregunta,respuestasuser.respuesta as respuesta FROM pregunta join respuestasuser on pregunta.id = respuestasuser.pregunta_id where respuestasuser.user_id=" .$id;
        $resultados = datosCompany::consultas($conexion,$consulta);
        if (!$resultados) {
            ?>
            <tr>
                <td colspan="5" class="text-center"><?php echo "No hay datos";?></td>
            </tr>
            <?php
        }
        else {
            foreach ($resultados as $info) {
                ?>
                <tr>
                    <td><?php echo $info->id_pregunta; ?></td>
                    <td><?php echo $info->pregunta; ?></td>
                    <td><?php echo $info->respuesta; ?></td>
                </tr>
                <?php
            }
        }
    }
    public static function getCapitulos($conexion,$id){
        $consulta = "SELECT * from capitulo where company_id=".$id;
        $resultados = datosCompany::consultas($conexion,$consulta);
        if (!$resultados) {
            ?>
           <div class="col">
            <h1>
            no se encontraron capitulos
            </h1>
           </div>
            <?php
        }
        else {
            foreach ($resultados as $info) {
                ?>
                 <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1 ml-1">
                                             <h5>
                                                CAPITULO <?php echo $info->numcapitulo; ?>
                                             </h5>  
                                            </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800 text-center mt-3">
                                            <h6>
                                              Descripcion: <?php echo $info->descripcion; ?>
                                            </h6>
                                            </div>
                                            <div class="col mt-4">
                                            <!-- Button modal-->
						                    <div class="row">
                                                <div class="col">
                                                    <a href="encuestasall.php?bloque=<?php echo$info->numcapitulo; ?>&capId=<?php echo$info->id; ?>" class="btn btn-success" role="button">Ver encuestas</a>
                                                </div>
                                                </div>
                                            </div>
                                            
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-comments fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> 
                <?php
            }
        }
        ?>
        
        <?php
    }
    public static function getQuestions($conexion,$capitulo_id,$company_id){
        $consulta = "SELECT question.id as id, pregunta,estado from (SELECT capitulo.id from company join capitulo on company.id = capitulo.company_id where capitulo.id = $capitulo_id and company.id =$company_id) as CC join question on CC.id = question.capitulo_id  ;";
        $resultados = datosCompany::consultas($conexion,$consulta);
        if (!$resultados) {
            ?>
            <tr>
                <td colspan="5" class="text-center"><?php echo "No hay datos";?></td>
            </tr>
            <?php
        }
        else {
            foreach($resultados as $info){
                ?>
                <tr>
                    <td><?php echo $info->id; ?></td>
                    <td><?php echo $info->pregunta; ?></td>
                    <td>
                    <input class="form-check-input" type="checkbox" value="<?php echo $info->estado; ?>" id="flexCheckDefault">
                    <label class="form-check-label" for="flexCheckDefault">
                    </label>
                    </td>
                </tr>
            <?php
            }
        }
    }
    public static function getQuestionsModal($conexion,$capitulo_id,$company_id){
        $consulta = "SELECT question.id as id, pregunta,estado from (SELECT capitulo.id from company join capitulo on company.id = capitulo.company_id where capitulo.id = $capitulo_id and company.id =$company_id) as CC join question on CC.id = question.capitulo_id  ;";
        $resultados = datosCompany::consultas($conexion,$consulta);
        if (!$resultados) {
            ?>
            <div class="row">
                <div class="col text-center">No hay preguntas</div>
            </div>
            <?php
        }
        else {
            ?>
            <div class="row">
                <div class="col">
                <h2>
                Preguntas
                </h2>
            </div>
            </div>
            <?php
            foreach ($resultados as $info) {
               echo  '<div class="row mb-2">';
               echo '<h6 class="mb-1">';
               echo $info->pregunta; echo "<br>";
               echo '</h6>';
               echo '</div>';
            }?>
          
            <?php
        }
    }
    public function getAllAnswers($conexion,$company_id){
        $consulta = "SELECT * from pregunta";
        $resultados = datosCompany::consultas($conexion,$consulta);
        if (!$resultados) {
            ?>
            <tr>
                <td colspan="5" class="text-center"><?php echo "No hay datos";?></td>
            </tr>
            <?php
        }
        else {
            foreach ($resultados as $info) {
                ?>
                <tr>
                    <td><?php echo $info->id; ?></td>
                    <td><?php echo $info->pregunta; ?></td>
                    <td>
                    <?php 
                    Conexion::abrir_conexion();
                    echo $this->getNum(Conexion::obtener_conexion(),"SELECT COUNT(*) as num FROM respuestasuser JOIN pregunta on respuestasuser.pregunta_id = pregunta.id JOIN user on user.id = respuestasuser.user_id WHERE respuestasuser.respuesta = 'siempre' AND user.company_id= $company_id AND pregunta.id =".$info->id);
                    Conexion::cerrar_conexion();
                    ?>
                    </td>
                    <td>
                    <?php 
                    Conexion::abrir_conexion();
                    echo $this->getNum(Conexion::obtener_conexion(),"SELECT COUNT(*) as num FROM respuestasuser JOIN pregunta on respuestasuser.pregunta_id = pregunta.id JOIN user on user.id = respuestasuser.user_id WHERE respuestasuser.respuesta = 'Casi siempre' AND user.company_id= $company_id AND pregunta.id = ".$info->id);
                    Conexion::cerrar_conexion();
                    ?>
                    </td>
                    <td>
                    <?php 
                    Conexion::abrir_conexion();
                    echo $this->getNum(Conexion::obtener_conexion(),"SELECT COUNT(*) as num FROM respuestasuser JOIN pregunta on respuestasuser.pregunta_id = pregunta.id JOIN user on user.id = respuestasuser.user_id WHERE respuestasuser.respuesta = 'Algunas veces' AND user.company_id= $company_id  AND pregunta.id = ".$info->id);
                    Conexion::cerrar_conexion();
                    ?>
                    </td>
                    <td>
                    <?php 
                    Conexion::abrir_conexion();
                    echo $this->getNum(Conexion::obtener_conexion(),"SELECT COUNT(*) as num FROM respuestasuser JOIN pregunta on respuestasuser.pregunta_id = pregunta.id JOIN user on user.id = respuestasuser.user_id WHERE respuestasuser.respuesta = 'Casi nunca' AND $company_id AND pregunta.id = ".$info->id);
                    Conexion::cerrar_conexion();
                    ?>
                    </td>
                    <td>
                    <?php 
                    Conexion::abrir_conexion();
                    echo $this->getNum(Conexion::obtener_conexion(),"SELECT COUNT(*) as num FROM respuestasuser JOIN pregunta on respuestasuser.pregunta_id = pregunta.id JOIN user on user.id = respuestasuser.user_id WHERE respuestasuser.respuesta = 'Nunca' AND user.company_id= $company_id AND pregunta.id = ".$info->id);
                    Conexion::cerrar_conexion();
                    ?>
                    </td>
                </tr>
                <?php
            }
        }
    }
    public static function getQuizBlock($conexion,$id,$company_id){
        $consulta = "SELECT * from quiz join capitulo on quiz.capitulo_id = capitulo.id where company_id =".$company_id ." and capitulo_id =".$id.";";;   
        $resultados = datosCompany::consultas($conexion,$consulta);
        if (!$resultados) {
            ?>
            <tr>
                <td colspan="5" class="text-center"><?php echo "No hay datos";?></td>
            </tr>
            <?php
        }else {
            foreach ($resultados as $info) {
                ?>
                <tr>
                    <td><?php echo $info->id; ?></td>
                    <td><?php echo $info->fecha_inicio; ?></td>
                    <td><?php echo $info->capitulo_id; ?></td>
                </tr>
                <?php
            }
        }
    }
}