<?php
include "datosCompany.inc.php";
class informacionCompany
{

    public static function Encuestas($conexion, $id)
    {

        $consulta = "SELECT * from quiz where quiz.company_id= '$id'";
        $resultados = datosCompany::consultas($conexion, $consulta);
        if (!$resultados) {
?>
            <h1>No se encontraron encuestas</h1>
        <?php
        }
        foreach ($resultados as $resultado) {
        ?>
            <div class="col">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title">Nombre: <?php echo $resultado->nombre ?></h5>
                        <p class="card-text">Descripción de la encuesta:<?php echo $resultado->descripcion ?></p>
                    </div>
                    <div class="card-footer bg-transparent"><a href="http://">Ver detalles</a> </div>
                </div>
            </div>
        <?php
        }
    }
    public static function getNum($conexion, $sql)
    {
        $resultado = datosCompany::count($conexion, $sql);
        return $resultado[0]->num;
    }
    public static function getWorkers($conexion, $id)
    {
        $consulta = "SELECT user.id ,concat(nombre, ' ',ap_paterno,' ',ap_materno) as nombre ,telefono,correo,rfc FROM user join contacto on  contacto.id = user.contacto_id where user.company_id=" . $id;
        $resultados = datosCompany::consultas($conexion, $consulta);
        if (!$resultados) {
        ?>
            <tr>
                <td colspan="" class="text-center"><?php echo "No hay datos"; ?></td>
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
                    <form action="resultadosfinales.php" method="post">
                        <button type="submit" class="btn btn-outline-primary">Ver Resultados de Encuesta</button>
                    </form>
                </td>
            </tr>
        <?php
        }
    }
    //para ver los bloques que ya estan hechos
    public static function getWorkersId($conexion, $companyid)
    {
        Conexion::abrir_conexion();
        $query = "SELECT id FROM user WHERE company_id = $companyid";
        $resultado = datosCompany::consultas(conexion::obtener_conexion(), $query);
        Conexion::cerrar_conexion();
        return $resultado;
    }
    public static function getAnswersUser($conexion, $id)
    {
        $consulta = "SELECT pregunta.id as id_pregunta,pregunta.pregunta as pregunta,respuestasuser.respuesta as respuesta FROM pregunta join respuestasuser on pregunta.id = respuestasuser.pregunta_id where respuestasuser.user_id=" . $id;
        $resultados = datosCompany::consultas($conexion, $consulta);
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
                    <td><?php echo $info->id_pregunta; ?></td>
                    <td><?php echo $info->pregunta; ?></td>
                    <td><?php echo $info->respuesta; ?></td>
                </tr>
            <?php
            }
        }
    }
    public static function nextCap($id)
    {
        $consulta = "SELECT count(id) as num from capitulo where company_id=" . $id;
        Conexion::abrir_conexion();
        $resultados = datosCompany::preguntaOnlyRow(Conexion::obtener_conexion(), $consulta);
        Conexion::cerrar_conexion();
        return $resultados->num + 1;
    }
    public static function getCapitulos($conexion, $id)
    {
        $consulta = "SELECT * from capitulo where company_id=" . $id;
        $resultados = datosCompany::consultas($conexion, $consulta);
        if (!$resultados) {
            ?>
            <div class="col">
                <h1>
                    no se encontraron capítulos
                </h1>
            </div>
            <?php
        } else {
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
                                            Descripción: <?php echo $info->descripcion; ?>
                                        </h6>
                                    </div>
                                    <div class="col mt-4">
                                        <!-- Button modal-->
                                        <div class="row">
                                            <div class="col">
                                                <a href="encuestasall.php?bloque=<?php echo $info->numcapitulo; ?>&capId=<?php echo $info->id; ?>" class="btn btn-success" role="button">Ver encuestas</a>
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
    public static function getQuestions($conexion, $capitulo_id, $company_id)
    {
        $consulta = "SELECT question.id as id, pregunta, estado, fecha_pregunta from (SELECT capitulo.id from company join capitulo on company.id = capitulo.company_id where capitulo.id = $capitulo_id and company.id =$company_id) as CC join question on CC.id = question.capitulo_id  ;";
        $resultados = datosCompany::consultas($conexion, $consulta);
        $contador = 1;
        if (!$resultados) {
        ?>
            <tr>
                <td colspan="5" class="text-center"><?php echo "No hay datos"; ?></td>
            </tr>
            <?php
        } else {
            foreach ($resultados as $info) {
            ?>
                <tr class="text-center">
                    <td><?php echo $contador ?></td>
                    <td><?php echo $info->pregunta; ?></td>
                    <td><?php echo $info->fecha_pregunta; ?></td>
                </tr>
            <?php
                $contador++;
            }
        }
    }
    public static function getQuestionsModal($conexion, $capitulo_id, $company_id)
    {
        $consulta = "SELECT question.id as id, pregunta,estado from (SELECT capitulo.id from company join capitulo on company.id = capitulo.company_id where capitulo.id = $capitulo_id and company.id =$company_id) as CC join question on CC.id = question.capitulo_id  ;";
        $resultados = datosCompany::consultas($conexion, $consulta);
        if (!$resultados) {
            ?>
            <div class="row">
                <div class="col text-center">No hay preguntas</div>
            </div>
        <?php
        } else {
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
                echo $info->pregunta;
                echo "<br>";
                echo '</h6>';
                echo '</div>';
            } ?>

        <?php
        }
    }
    public static function getAllAnswers($conexion, $quiz_id)
    {
        $consulta = "SELECT * from question join (SELECT quiz.id as quiz_id, quiz.fecha_inicio, capitulo.id as cap_id from quiz join capitulo on quiz.capitulo_id = capitulo.id) as QC on QC.cap_id = question.capitulo_id where QC.quiz_id =" . $quiz_id;
        $resultados = datosCompany::consultas($conexion, $consulta);
        $sql_respuestas = "SELECT * FROM user_answer WHERE quiz_id = $quiz_id";
        $sql_resultados = datosCompany::consultas($conexion, $sql_respuestas);
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
    public static function getQuizBlock($conexion, $id, $company_id)
    {
        $consulta = "SELECT * from quiz join capitulo on quiz.capitulo_id = capitulo.id where company_id =" . $company_id . " and capitulo_id =" . $id . ";";;
        $resultados = datosCompany::consultas($conexion, $consulta);
        if (!$resultados) {
            ?>
            <tr>
                <td colspan="5" class="text-center"><?php echo "No hay datos"; ?></td>
            </tr>
            <?php
        } else {
            foreach ($resultados as $info) {
            ?>
                <tr class="text-center">
                    <td><?php echo $info->id; ?></td>
                    <td><?php echo $info->fecha_inicio; ?></td>
                    <td><?php echo $info->capitulo_id; ?></td>
                </tr>
            <?php
            }
        }
    }
    public static function capitulosRespuestas($company_id)
    {
        Conexion::abrir_conexion();
        $consulta = "SELECT * from capitulo where company_id =" . $company_id . ";";
        $resultados = datosCompany::consultas(Conexion::obtener_conexion(), $consulta);
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
                                    Total exámenes: <?php echo informacionCompany::getNum(Conexion::obtener_conexion(), "SELECT count(*) as num FROM quiz join capitulo on capitulo.id = quiz.capitulo_id where company_id= $company_id and capitulo.id =$info->id;") ?>
                                </div>
                                <br>
                            </div>
                        </div>
                        <div class="card-footer bg-transparent border-success"><a href="examenesrespuesta.php?idcap=<?php echo $info->id ?>">Ver exámenes del capitulo</a></div>
                    </div>
                </div>
            <?php
                Conexion::cerrar_conexion();
            }
        }
    }
    public static function getQuizAnswers($conexion, $capitulo_id, $company_id)
    {
        $consulta = "SELECT quiz.id as id_quiz,fecha_inicio,capitulo.id as id_cap from quiz join capitulo on quiz.capitulo_id= capitulo.id WHERE capitulo.company_id=$company_id and capitulo.id =$capitulo_id";
        $resultados = datosCompany::consultas($conexion, $consulta);
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
                    <td><?php echo $info->id_quiz; ?></td>
                    <td><?php echo $info->fecha_inicio; ?></td>
                    <td><?php echo $info->id_cap; ?></td>
                    <td>
                        <form action="respuestas.php?quizid=<?php echo $info->id_quiz; ?>" method="post">
                            <input type="hidden" value="<?php echo $capitulo_id; ?>" id="IdCaph<?php echo $info->id_quiz; ?>" name="IdCaph">
                            <input type="submit" id="submitForm<?php echo $info->id_quiz; ?>" value="Enviar" style="display: none;">
                            <a href="javascript:void(0);" id="verRespuestas<?php echo $info->id_quiz; ?>" role="button" class="btn btn-primary">Ver respuestas</a>
                        </form>
                    </td>
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
    public static function getAllSingleAnswers($user_id)
    {
        $consulta = "SELECT * FROM user WHERE id = $user_id";
        Conexion::abrir_conexion();
        $resultados = datosCompany::consultas(Conexion::obtener_conexion(), $consulta);
        Conexion::cerrar_conexion();
    }
    public static function getCapitulosCount($conexion, $company_id, $bloque_id)
    {
        $consulta = "SELECT * from capitulo where company_id=" . $company_id;
        $resultados = datosCompany::consultas($conexion, $consulta);
        if ($resultados) {
            foreach ($resultados as $info) {
                //echo $info->id;
                $quiz = new Quiz();
                $quiz->set_capitulo_id($info->id);
                $quiz->set_bloqueinfo_id($bloque_id);
                $quiz->saveBloque();
            }
            ?>
        <?php
            return true;
        }
        return false;
    }

    public static function getCapitulosPorBloque($conexion, $bloque_id, $company_id, $bloqueinfo_id)
    {
        $prueba = "SELECT bi.id, bi.nombre, COUNT(*) as num_capitulos
        FROM tercerEjemplo.bloque_info AS bi
        JOIN tercerEjemplo.capitulo AS c ON bi.id = c.bloqueinfo_id
        WHERE bi.id = 1 AND bi.company_id = 1 AND c.company_id = 1
        GROUP BY bi.id, bi.nombre;
        ";

        $consulta = "SELECT bi.id, bi.nombre, COUNT(*) as num_capitulos
        FROM tercerEjemplo.bloque_info AS bi
        JOIN tercerEjemplo.capitulo AS c ON bi.id = c.bloqueinfo_id
        WHERE bi.id = $bloqueinfo_id AND bi.company_id = $company_id AND c.company_id = $company_id
        GROUP BY bi.id, bi.nombre;";
        $resultados = datosCompany::consultas($conexion, $consulta);
        var_dump($resultados);

        if ($resultados) {
            foreach ($resultados as $info) {
                //echo $info->id;
                $quiz = new Quiz();
                $quiz->set_capitulo_id($info->id);
                $quiz->set_bloqueinfo_id($bloque_id);
                $quiz->saveBloque();
            }
        ?>
        <?php
            return true;
        }
        return false;
    }
    public static function getIdBloqueInfo($nombre_bloque, $company_id)
    {
        $consulta = "SELECT * from bloque_info where nombre = " . "'$nombre_bloque'" . " AND company_id = $company_id";
        $resultados = datosCompany::consultas(Conexion::obtener_conexion(), $consulta);
        return $resultados;
    }
    public static function getAllWorkersWhoHasAQuizBlock($company_id)
    {
        Conexion::abrir_conexion();
        $consulta = "SELECT u.id AS user_id, u.nombre, u.ap_paterno, u.ap_materno, u.rfc, u.telefono, b.folio AS folio_encuesta
        FROM user AS u
        INNER JOIN user_answer AS ua ON u.id = ua.user_id
        INNER JOIN quiz AS q ON ua.quiz_id = q.id
        INNER JOIN bloque AS b ON q.bloque_id = b.id
        WHERE u.company_id = $company_id
        GROUP BY u.id, b.folio;";

        $resultados = datosCompany::consultas(Conexion::obtener_conexion(), $consulta);
        if (!$resultados) {
        ?>
            <!-- colspan -->
            <div class="col text-center">
                <h2>
                    No se encontraron datos
                </h2>
            </div>
            <?php
        } else {
            foreach ($resultados as $info) {
            ?>
                <tr>
                    <td></td>
                    <td><?php echo $info->user_id; ?></td>
                    <td><?php echo $info->nombre . " " . $info->ap_paterno . " " . $info->ap_materno; ?></td>
                    <td><?php echo $info->folio_encuesta; ?></td>
                    <td>
                        <form action="vistacalculo.php?sid=<?php echo $info->user_id; ?>&fol=<?php echo $info->folio_encuesta; ?>" method="POST">
                            <button type="submit" class="btn btn-link">Ver resultados</button>
                        </form>
                    </td>
                    <td></td>
                </tr>
            <?php
                Conexion::cerrar_conexion();
            }
        }
    }
    public static function getAllWorkersWhoHasAQuizBlockPerFolio($company_id, $folio)
    {
        Conexion::abrir_conexion();
        $consulta = "SELECT u.id AS user_id, u.nombre, u.ap_paterno, u.ap_materno, u.rfc, u.telefono, b.folio AS folio_encuesta
        FROM user AS u
        INNER JOIN user_answer AS ua ON u.id = ua.user_id
        INNER JOIN quiz AS q ON ua.quiz_id = q.id
        INNER JOIN bloque AS b ON q.bloque_id = b.id
        WHERE u.company_id = $company_id && b.folio = " . "'$folio'" . " 
        GROUP BY u.id, b.folio;";

        $resultados = datosCompany::consultas(Conexion::obtener_conexion(), $consulta);
        if (!$resultados) {
            ?>
            <!-- colspan -->
            <div class="col text-center">
                <h2>
                    No se encontraron datos
                </h2>
            </div>
            <?php
        } else {
            foreach ($resultados as $info) {
            ?>
                <tr>
                    <td></td>
                    <td><?php echo $info->user_id; ?></td>
                    <td><?php echo $info->nombre . " " . $info->ap_paterno . " " . $info->ap_materno; ?></td>
                    <td><?php echo $info->folio_encuesta; ?></td>
                    <td>
                        <form action="vistacalculo.php?sid=<?php echo $info->user_id; ?>&fol=<?php echo $info->folio_encuesta; ?>" method="POST">
                            <button type="submit" class="btn btn-link">Ver resultados</button>
                        </form>
                    </td>
                    <td></td>
                </tr>
            <?php
                Conexion::cerrar_conexion();
            }
        }
    }
    public static function getAllFolios($company_id)
    {
        Conexion::abrir_conexion();
        $consulta = "SELECT DISTINCT b.folio AS folio_encuesta
        FROM user AS u
        INNER JOIN user_answer AS ua ON u.id = ua.user_id
        INNER JOIN quiz AS q ON ua.quiz_id = q.id
        INNER JOIN bloque AS b ON q.bloque_id = b.id
        WHERE u.company_id = $company_id;";

        $resultados = datosCompany::consultas(Conexion::obtener_conexion(), $consulta);
        if (!$resultados) {
            ?>
            <option value="" disabled>No hay folios actualmente</option>
            <?php
        } else {
            foreach ($resultados as $info) {
            ?>
                <option value="<?php echo $info->folio_encuesta; ?>"><?php echo $info->folio_encuesta; ?></option>
<?php
                Conexion::cerrar_conexion();
            }
        }
    }
    public static function getJsonAnswer($conexion, $company_id, $user_id, $folio)
    {
        $consulta = "SELECT 
        user.id AS user_id,  CONCAT(user.nombre,' ', 
        user.ap_paterno,' ',
        user.ap_materno) AS nombre_completo,
        bloque.folio,
        bloque_info.nombre AS bloque_nombre,
        capitulo.nombre_examen AS capitulo_nombre,
        capitulo.descripcion AS capitulo_descripcion,
        user_answer.answers,
        quiz.fecha_inicio AS fecha_inicio_quiz,
        bloque.fecha_ingreso AS fecha_ingreso_bloque
        FROM 
            user
        JOIN
            user_answer ON user.id = user_answer.user_id
        JOIN
            quiz ON user_answer.quiz_id = quiz.id
        JOIN
            bloque ON quiz.bloque_id = bloque.id
        JOIN
            bloque_info ON bloque.bloqueinfo_id = bloque_info.id
        JOIN
            capitulo ON quiz.capitulo_id = capitulo.id
            WHERE user.company_id = $company_id AND bloque.folio = " . "'$folio'" . " AND user.id = $user_id
        ORDER BY 
            user.id, 
            bloque.folio;";
        $resultados = datosCompany::consultas($conexion, $consulta);

        $cfinal = 0;

        foreach ($resultados as $info) {
            $user = $info->nombre_completo;
            $answers = json_decode($info->answers, true);

            foreach ($answers as $answer) {
                $cfinal += $answer['valor'];
            }
        }
        $array = array(
            "user" => $user,
            "cfinal" => $cfinal
        );
        return $array;
    }
    public static function getAllJsonAnswers($conexion, $company_id)
    {
        $consulta = "SELECT 
        user.id AS user_id, 
        user.nombre, 
        user.ap_paterno,
        user.ap_materno,
        bloque.folio,
        bloque_info.nombre AS bloque_nombre,
        capitulo.nombre_examen AS capitulo_nombre,
        capitulo.descripcion AS capitulo_descripcion,
        user_answer.answers,
        quiz.fecha_inicio AS fecha_inicio_quiz,
        bloque.fecha_ingreso AS fecha_ingreso_bloque
        FROM 
            user
        JOIN
            user_answer ON user.id = user_answer.user_id
        JOIN
            quiz ON user_answer.quiz_id = quiz.id
        JOIN
            bloque ON quiz.bloque_id = bloque.id
        JOIN
            bloque_info ON bloque.bloqueinfo_id = bloque_info.id
        JOIN
            capitulo ON quiz.capitulo_id = capitulo.id
            WHERE user.company_id = $company_id
        ORDER BY 
            user.id, 
            bloque.folio;";

        $resultados = datosCompany::consultas($conexion, $consulta);

        $totales_por_folio = [];
        $usuarios_por_folio = [];

        foreach ($resultados as $info) {
            $answers = json_decode($info->answers, true);

            foreach ($answers as $answer) {
                if (!isset($totales_por_folio[$info->folio])) {
                    $totales_por_folio[$info->folio] = 0;
                    $usuarios_por_folio[$info->folio] = [];
                }

                $totales_por_folio[$info->folio] += $answer['valor'];
                $usuarios_por_folio[$info->folio][$info->user_id] = true; // contamos los usuarios únicos
            }
        }

        // suma total y el total de usuarios por folio
        foreach ($totales_por_folio as $folio => $total) {
            $totales_por_folio[$folio] = $total / count($usuarios_por_folio[$folio]);
        }

        // Ahora, calculamos el promedio de todos los totales
        $promedio_total = array_sum($totales_por_folio) / count($totales_por_folio);

        return $promedio_total;
    }
    public static function getAllBasedJsonAnswer($conexion, $company_id, $user_id, $folio, $array_numeros)
    {
        $consulta = "SELECT 
        user.id AS user_id, 
        user.nombre, 
        user.ap_paterno,
        user.ap_materno,
        bloque.folio,
        bloque_info.nombre AS bloque_nombre,
        capitulo.nombre_examen AS capitulo_nombre,
        capitulo.descripcion AS capitulo_descripcion,
        user_answer.answers,
        quiz.fecha_inicio AS fecha_inicio_quiz,
        bloque.fecha_ingreso AS fecha_ingreso_bloque
        FROM 
            user
        JOIN
            user_answer ON user.id = user_answer.user_id
        JOIN
            quiz ON user_answer.quiz_id = quiz.id
        JOIN
            bloque ON quiz.bloque_id = bloque.id
        JOIN
            bloque_info ON bloque.bloqueinfo_id = bloque_info.id
        JOIN
            capitulo ON quiz.capitulo_id = capitulo.id
            WHERE user.company_id = $company_id AND bloque.folio = " . "'$folio'" . " AND user.id = $user_id
        ORDER BY 
            user.id, 
            bloque.folio;";
        $resultados = datosCompany::consultas($conexion, $consulta);

        $cfinal = 0;

        foreach ($resultados as $info) {
            $answers = json_decode($info->answers, true);
            foreach ($answers as $answer) {
                if (in_array($answer['item'], $array_numeros)) {
                    $cfinal += $answer['valor'];
                }
            }
        }
        return $cfinal;
    }
    public static function getAllJsonAnswersAllWorkers($conexion, $company_id, $array_numeros)
    {
        $consulta = "SELECT 
        user.id AS user_id, 
        user.nombre, 
        user.ap_paterno,
        user.ap_materno,
        bloque.folio,
        bloque_info.nombre AS bloque_nombre,
        capitulo.nombre_examen AS capitulo_nombre,
        capitulo.descripcion AS capitulo_descripcion,
        user_answer.answers,
        quiz.fecha_inicio AS fecha_inicio_quiz,
        bloque.fecha_ingreso AS fecha_ingreso_bloque
        FROM 
            user
        JOIN
            user_answer ON user.id = user_answer.user_id
        JOIN
            quiz ON user_answer.quiz_id = quiz.id
        JOIN
            bloque ON quiz.bloque_id = bloque.id
        JOIN
            bloque_info ON bloque.bloqueinfo_id = bloque_info.id
        JOIN
            capitulo ON quiz.capitulo_id = capitulo.id
            WHERE user.company_id = $company_id
        ORDER BY 
            user.id, 
            bloque.folio;";

        $resultados = datosCompany::consultas($conexion, $consulta);

        $totales_por_folio = [];
        $usuarios_por_folio = [];

        foreach ($resultados as $info) {
            $answers = json_decode($info->answers, true);

            foreach ($answers as $answer) {
                if (in_array($answer['item'], $array_numeros)) {
                    if (!isset($totales_por_folio[$info->folio])) {
                        $totales_por_folio[$info->folio] = 0;
                        $usuarios_por_folio[$info->folio] = [];
                    }

                    $totales_por_folio[$info->folio] += $answer['valor'];
                    $usuarios_por_folio[$info->folio][$info->user_id] = true; // contamos los usuarios únicos
                }
            }
        }

        // suma total y el total de usuarios por folio
        foreach ($totales_por_folio as $folio => $total) {
            $totales_por_folio[$folio] = $total / count($usuarios_por_folio[$folio]);
        }

        // Ahora, calculamos el promedio de todos los totales
        $promedio_total = array_sum($totales_por_folio) / count($totales_por_folio);

        return $promedio_total;
    }
}
