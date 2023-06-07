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
        $consulta = "SELECT quiz.id as id_quiz,fecha_inicio,capitulo.id as id_cap, numcapitulo from quiz join capitulo on quiz.capitulo_id= capitulo.id WHERE capitulo.company_id=$company_id and capitulo.id =$capitulo_id";

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


        // echo '<pre>';
        // print_r($resultados_sql);
        // echo '</pre>';

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
    public static function ramdom($conexion, $id_company)
    {
        $sql_users = "SELECT * FROM user WHERE company_id = $id_company";
        $resultados = datosRoot::consultas($conexion, $sql_users);
        if ($resultados == null) {
            ?>
            <tr>
                <td colspan="7" class="text-center"><?php echo "No hay datos"; ?></td>
            </tr>
            <?php
        } else {
            foreach ($resultados as $user) {
                $sql_nohechos = "SELECT *, quiz.id as quizid FROM
                (SELECT user_answer.id as uaid, user_id, quiz_id, answers, fecha_respondido, UC.id as userid, UC.nombre, UC.ap_paterno, UC.ap_materno, UC.rfc, UC.telefono, UC.company_id, UC.contacto_id FROM
                (SELECT * FROM user WHERE id = $user->id) AS UC
                JOIN user_answer
                ON user_answer.user_id = UC.id) AS UAUC
                RIGHT JOIN quiz ON quiz.id = UAUC.quiz_id
                WHERE capitulo_id = " . $_GET['idcap'] . " AND answers IS NULL";
                $resultados_nohechos = datosRoot::consultas($conexion, $sql_nohechos);
                if ($resultados_nohechos == null) {
            ?>
                    <tr>
                        <td colspan="7" class="text-center"><?php echo "No hay datos"; ?></td>
                    </tr>
                    <?php
                } else {

                    $indice = 0;
                    foreach ($resultados_nohechos as $nohecho) {

                        if (isset($_POST['saveAnswers'])) {

                            extract($_POST);
                            Conexion::abrir_conexion();
                            //consulta que trae el id de la pregunta del capitulo en especifico
                            $id = datosRoot::consultas(conexion::obtener_conexion(), "SELECT id FROM question where capitulo_id = " . $_GET['idcap']);

                            $inico = $id[0]->id;
                            Conexion::cerrar_conexion();

                            $arreglo_respuesta = '';
                            $arreglo_respuesta = json_decode($arreglo_respuesta, TRUE);
                            for ($i = 1; $i <= sizeof($_POST) - 1; $i++) {
                                $tipo = datosRoot::preguntaOnlyRow(conexion::obtener_conexion(), "SELECT calsificacion FROM question where id=$inico");
                                $inlineRadioOptions = 'inlineRadioOptions' . $inico;
                                if ($tipo->calsificacion == 1) {
                                    switch ($$inlineRadioOptions) {
                                        case 'Siempre':
                                            $valor = 4;
                                            break;
                                        case 'Casi siempre':
                                            $valor = 3;
                                            break;
                                        case 'Algunas veces':
                                            $valor = 2;
                                            break;
                                        case 'Casi nunca':
                                            $valor = 1;
                                            break;
                                        case 'Nunca':
                                            $valor = 0;
                                            break;
                                        default:
                                            echo "Error";
                                            die();
                                            break;
                                    }
                                } else {
                                    switch ($$inlineRadioOptions) {
                                        case 'Siempre':
                                            $valor = 0;
                                            break;
                                        case 'Casi siempre':
                                            $valor = 1;
                                            break;
                                        case 'A veces':
                                            $valor = 2;
                                            break;
                                        case 'Casi nunca':
                                            $valor = 3;
                                            break;
                                        case 'Nunca':
                                            $valor = 4;
                                            break;
                                        default:
                                            echo "Error";
                                            die();
                                            break;
                                    }
                                }
                                $arreglo_respuesta[] = ['idpregunta' => $inico, 'respuesta' => $$inlineRadioOptions, 'valor' => $valor];
                                $inico++;
                            }

                            $json = json_encode($arreglo_respuesta);
                            //print_r($json);
                            $userrespuesta = new userrespuesta();
                            $userrespuesta->setUser_id($user->id);
                            $userrespuesta->setQuiz_id($nohecho->quizid);
                            $userrespuesta->setRespuesta($json);
                            
                            if ($userrespuesta->save()) {
                                echo "<script>alert('Respuestas guardadas');</script>";
                                echo "<script>window.location.replace('listarespuestas.php?idcap=<?php echo " .  $_GET['idcap'] . "; ?>&compyid=<?php echo " .  $_GET['compyid'] . "; ?>');</script>";
                            } else {
                                echo "<script>alert('Error al guardar las respuestas');</script>";
                                echo "<script>window.location.replace('listarespuestas.php?idcap=<?php echo " .  $_GET['idcap'] . "; ?>&compyid=<?php echo " .  $_GET['compyid'] . "; ?>');</script>";
                            }
                        }
                    ?>
                        <tr>
                            <td></td>
                            <td><?php echo $user->id; ?></td>
                            <td><?php echo $user->nombre . " " . $user->ap_paterno . " " . $user->ap_materno;; ?></td>
                            <td><?php echo $nohecho->fecha_inicio; ?></td>
                            <td>
                                <form action="" method="post">
                                    <?php
                                    // echo '<pre>';
                                    // var_dump($resultados2);
                                    // echo '</pre>';

                                    $quiz_id = $nohecho->quizid;
                                    Conexion::cerrar_conexion();
                                    informacionRoot::preguntas($_GET['idcap'], $quiz_id);

                                    ?>
                                    <button type="submit" name="saveAnswers" class="btn btn-warning btn">Finalizar</button>
                                </form>
                            </td>
                            <td></td>
                        </tr>
<?php
                        $indice++;
                    }
                }
            }
        }
    }
    public static function preguntas($capitulo_id, $quiz_id)
    {
        $contador = 1;
        Conexion::abrir_conexion();
        $conexion = Conexion::obtener_conexion();
        $sql_fecha = "SELECT fecha_inicio FROM quiz WHERE id =" . $quiz_id;
        $resultados_fecha = datosRoot::preguntaOnlyRow($conexion, $sql_fecha);
        $fecha_inicio = $resultados_fecha->fecha_inicio;
        $sql = "SELECT * FROM question WHERE capitulo_id = " . $capitulo_id . " AND fecha_pregunta < '" . $fecha_inicio . "'";
        $resultados = datosRoot::consultas($conexion, $sql);
        Conexion::cerrar_conexion();
        if (!$resultados) {
            echo "No se encontraron preguntas";
            return;
        }

        $respuestas = array('Siempre', 'Casi siempre', 'Algunas veces', 'Casi nunca', 'Nunca');
        $respuestasFinales = array();

        foreach ($resultados as $resultado) {
            // seleccionar aleatoriamente
            $respuesta_aleatoria = $respuestas[array_rand($respuestas)];
            array_push($respuestasFinales, $respuesta_aleatoria);

            // echo "Pregunta #" . $contador . ": " . $resultado->pregunta . "<br>";
            // echo "Respuesta: " . end($respuestasFinales) . "<br>";
            echo "<input type='hidden' name='inlineRadioOptions" . $contador . "' value='" . $respuesta_aleatoria . "'>";

            $contador++;
        }
    }
}
