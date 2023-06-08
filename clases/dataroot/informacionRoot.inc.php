<?php
include 'datosRoot.inc.php';
class informacionRoot
{

    public static function informacion($conexion)
    {
        $sql = "SELECT company.id as id_company,nombre,refimenFiscal,domicilio,pass,correo from company join contacto on contacto.id = company.contacto_id ;";
        $resultados = datosRoot::consultas($conexion, $sql);
        if (!$resultados) {
?>
            <tr>
                <td colspan="5" class="text-center"><?php echo "No hay datos"; ?></td>
            </tr>
        <?php
        }
        foreach ($resultados as $resultado) {
        ?>
            <tr>
                <td><?php echo $resultado->id_company; ?></td>
                <td><?php echo $resultado->nombre; ?></td>
                <td><?php echo $resultado->refimenFiscal; ?></td>
                <td><?php echo $resultado->domicilio; ?></td>
                <td><?php echo $resultado->correo; ?></td>
                <td>
                    <form action="companyquiz.php?id=<?php echo $resultado->id_company; ?>" method="post">
                        <button type="submit" class="btn btn-outline-primary">Ver encuestas</button>
                    </form>
                </td>
            </tr>
        <?php
        }
    }
    public static function getQuizesCompanys($conexion, $id)
    {
        $sql = "SELECT * FROM quiz WHERE company_id = '$id'";
        $resultados = datosRoot::consultas($conexion, $sql);
        if (!$resultados) {
        ?>
            <tr>
                <td colspan="5" class="text-center"><?php echo "No hay datos"; ?></td>
            </tr>
        <?php
        }
        foreach ($resultados as $resultado) { ?>
            <tr>
                <td><?php echo $resultado->id; ?></td>
                <td>
                    <?php echo $resultado->nombre; ?>
                </td>
            </tr>
        <?php
        }
    }
    public static function getNumCompanys($conexion, $sql)
    {
        $resultado = datosRoot::count($conexion, $sql);
        return $resultado[0]->num;
    }
    public static function getTableCaps($conexion)
    {
        $sql = "SELECT company.id as id_company,nombre,domicilio,pass,correo from company join contacto on contacto.id = company.contacto_id ;";
        $resultados = datosRoot::consultas($conexion, $sql);
        if (!$resultados) {
        ?>
            <tr>
                <td colspan="5" class="text-center"><?php echo "No hay datos"; ?></td>
            </tr>
        <?php
        }
        foreach ($resultados as $resultado) {
            $sql_trbajadores = "SELECT count(*) as num FROM user where company_id = $resultado->id_company;";
            $resultados_trabajadores = datosRoot::consultas($conexion, $sql_trbajadores);
        ?>
            <tr>
                <td style="font-weight: bold;"><?php echo $resultado->id_company; ?></td>
                <td><?php echo $resultado->nombre; ?></td>
                <td><?php echo $resultados_trabajadores[0]->num; ?></td>
                <td><?php echo $resultado->domicilio; ?></td>
                <td>
                    <form action="viewcapitulos.php?id=<?php echo $resultado->id_company; ?>" method="post">
                        <button type="submit" class="btn btn-outline-primary">Ver Capitulos</button>
                    </form>
                </td>
            </tr>
        <?php
        }
    }
    public static function capitulosRespuestas($company_id)
    {
        Conexion::abrir_conexion();
        $consulta = "SELECT * from capitulo where company_id =" . $company_id . ";";
        $resultados = datosRoot::consultas(Conexion::obtener_conexion(), $consulta);
        if (!$resultados) {
        ?>
            <div class="col text-center">
                <h2>
                    No se encontraron capítulos
                </h2>
            </div>
            <?php
        } else {
            foreach ($resultados as $info) {
            ?>
                <div class="col">
                    <div class="card h-100">
                        <div class="card-body">
                            <h3 class="card-title">Capitulo <?php echo $info->numcapitulo ?></h3>
                            <p class="card-text">
                            <div class="row">
                                <div class="col fs-5">
                                    Descripción: <?php echo $info->descripcion ?>.</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col fs-5">
                                    Total exámenes: <?php echo informacionRoot::getNum(Conexion::obtener_conexion(), "SELECT count(*) as num FROM quiz join capitulo on capitulo.id = quiz.capitulo_id where company_id= $company_id and capitulo.id =$info->id;") ?>
                                </div>
                                <br>
                            </div>
                        </div>
                        <div class="card-footer bg-transparent border-success"><a href="listarespuestas.php?idcap=<?php echo $info->id; ?>&compyid=<?php echo $company_id; ?>">Ver exámenes del capitulo</a></div>
                    </div>
                </div>
            <?php
                Conexion::cerrar_conexion();
            }
        }
    }
    public static function getNum($conexion, $sql)
    {
        $resultado = datosRoot::count($conexion, $sql);
        return $resultado[0]->num;
    }
    public static function getQuizAnswers($conexion, $capitulo_id, $company_id)
    {   
        $queryNumEmpleados = "SELECT count(id) as num from user where user.company_id=". $company_id .";";
        $numEmpleados = datosRoot::preguntaOnlyRow($conexion,$queryNumEmpleados);
        $consulta = "SELECT Qdates.id as id_quiz,fecha_inicio,capitulo.id as id_cap, numcapitulo from (select * from quiz)as Qdates join capitulo on Qdates.capitulo_id = capitulo.id WHERE capitulo.company_id=$company_id and capitulo.id=$capitulo_id ORDER BY fecha_inicio DESC;";
        $resultados = datosRoot::consultas($conexion, $consulta);
        if (!$resultados) {
            ?>
            <tr>
                <td colspan="5" class="text-center"><?php echo "No hay datos"; ?></td>
            </tr>
            <?php
        } else {
            foreach ($resultados as $info) {
            ?>
                <tr>
                    <td></td>
                    <td><?php echo $info->id_quiz; ?></td>
                    <td><?php echo $info->fecha_inicio; ?></td>
                    <td><?php echo $info->numcapitulo; ?></td>
                    <td>
                    <?php 
                    $queryNumAnswersQuiz="SELECT count(*) as num FROM user_answer where quiz_id =$info->id_quiz;";
                    $numAnswersQuiz = datosRoot::preguntaOnlyRow($conexion,$queryNumAnswersQuiz);
                    if ($numAnswersQuiz->num == $numEmpleados->num) {
                        ?>
                            <button class="btn btn-success disabled">Todos terminados</button>
                         <?php
                    }else{
                        ?>
                       <form action="" method="post">
                            <input type="hidden" value="<?php echo $info->id_quiz; ?>" name="idQuiz">
                            <input type="hidden" value="<?php echo $info->id_cap; ?>" name="idCap">
                            <button type="submit" name="radWay" class="btn btn-warning">Terminar random</button>
                        </form>
                        <?php
                    }
                    ?> 
                    
                    </td>
                    <td>
                        <form action="respuestas.php?quizid=<?php echo $info->id_quiz; ?>&compyid=<?php echo $company_id; ?>" method="post">
                            <input type="hidden" value="<?php echo $capitulo_id; ?>" id="IdCaph<?php echo $info->id_quiz; ?>" name="IdCaph">
                            <input type="submit" id="submitForm<?php echo $info->id_quiz; ?>" value="Enviar" style="display: none;">
                            <a href="javascript:void(0);" id="verRespuestas<?php echo $info->id_quiz; ?>" role="button" class="btn btn-primary">Ver respuestas</a>
                        </form>
                    </td>
                    <td></td>
                </tr>
                <script>
                    document.getElementById('verRespuestas<?php echo $info->id_quiz; ?>').addEventListener('click', function() {
                        document.getElementById('submitForm<?php echo $info->id_quiz; ?>').click();
                    });
                </script>
            <?php
            }
        }
    }
    public static function getAllAnswers($conexion, $quiz_id, $company_id)
    {
        $consulta = "SELECT * from question join (SELECT quiz.id as quiz_id, quiz.fecha_inicio, capitulo.id as cap_id from quiz join capitulo on quiz.capitulo_id = capitulo.id) as QC on QC.cap_id = question.capitulo_id where QC.quiz_id =" . $quiz_id;
        $resultados = datosRoot::consultas($conexion, $consulta);
        $sql_respuestas = "SELECT * FROM user_answer WHERE quiz_id = $quiz_id";
        $sql_resultados = datosRoot::consultas($conexion, $sql_respuestas);
        $conteo_respuestas = [];
        $contador = 1;
        foreach ($sql_resultados as $objeto) {
            $respuestas = $objeto->answers;
            $respuestas_decodificadas = json_decode($respuestas);

            foreach ($respuestas_decodificadas as $respuesta) {
                $idPregunta = $respuesta->idpregunta;
                $respuesta_usuario = $respuesta->respuesta;
                if (!isset($conteo_respuestas[$idPregunta])) {
                    $conteo_respuestas[$idPregunta] = [
                        "Siempre" => 0,
                        "Casi siempre" => 0,
                        "Algunas veces" => 0,
                        "Casi nunca" => 0,
                        "Nunca" => 0,
                    ];
                }

                $conteo_respuestas[$idPregunta][$respuesta_usuario]++;
            }
        }

        if (!$resultados) {
            ?>
            <tr>
                <td colspan="7" class="text-center"><?php echo "No hay datos"; ?></td>
            </tr>
            <?php
        } else {
            foreach ($resultados as $info) {
                if (isset($conteo_respuestas[$info->id])) {
                    $respuestas = $conteo_respuestas[$info->id];
            ?>
                    <tr>
                        <td><?php echo $contador ?></td>
                        <td><?php echo $info->pregunta; ?></td>
                        <td class="text-center"><?php echo $respuestas["Siempre"]; ?></td>
                        <td class="text-center"><?php echo $respuestas["Casi siempre"]; ?></td>
                        <td class="text-center"><?php echo $respuestas["Algunas veces"]; ?></td>
                        <td class="text-center"><?php echo $respuestas["Casi nunca"]; ?></td>
                        <td class="text-center"><?php echo $respuestas["Nunca"]; ?></td>
                    </tr>
                <?php
                } else {
                ?>
                    <tr>
                        <td><?php echo $contador; ?></td>
                        <td><?php echo $info->pregunta; ?></td>
                        <td class="text-center">0</td>
                        <td class="text-center">0</td>
                        <td class="text-center">0</td>
                        <td class="text-center">0</td>
                        <td class="text-center">0</td>
                    </tr>
            <?php
                }
                $contador++;
            }
        }
    }
    public static function conprobarExamenesPendientes($user_id,$quiz_id){
        Conexion::abrir_conexion();
        $query = "SELECT * FROM user_answer WHERE user_id = $user_id AND quiz_id = $quiz_id";
        $resultado = datosRoot::consultas(conexion::obtener_conexion(),$query);
        Conexion::cerrar_conexion();
        if(!$resultado){
            return false;
        }
        return true;
    }
    public static function workersCompany($company_id){
        Conexion::abrir_conexion();
        $query = "SELECT id FROM user WHERE company_id = $company_id";
        $resultado = datosRoot::consultas(conexion::obtener_conexion(),$query);
        Conexion::cerrar_conexion();
        return $resultado;
    }
}
