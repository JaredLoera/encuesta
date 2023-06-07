<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/bootstrap.css">
    <title>Examen</title>
</head>
<body>
    <?php 
    include "../clases/login.inc.php";
    include "../clases/database/conexion.inc.php";
    include "../clases/dataworker/informacionWorker.inc.php";
    include "../clases/modelos/userrespuesta.php";
    login::sessionWorker();
    include "nav.php";
    ?>

    <div class="container py-4">
        <div class="row">
            <div class="col text-center">
                <h1 class="display-4 mb-2">Examen del capitulo</h1>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <h5 class="display-6">Titulo: <?php echo informacionWorker::titulo($_GET['cap']) ?></h5>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <h5 class="display-7 mb-5">Descripcion: <?php echo informacionWorker::descripcion($_GET['cap']) ?></h5>
            </div>
        </div>
        <?php
        if (isset($_POST['saveAnswers'])) {
            extract($_POST);
            Conexion::abrir_conexion();
            $id = datosWorker::preguntas(conexion::obtener_conexion(),"SELECT id FROM question where capitulo_id = ".$_GET['cap']);
            $inico = $id[0]->id;
            Conexion::cerrar_conexion();
            $arreglo_respuesta = '';
            $arreglo_respuesta = json_decode($arreglo_respuesta, TRUE);
            for ($i = 1; $i <= sizeof($_POST)-1; $i++) {
                $tipo = datosWorker::preguntaOnlyRow(conexion::obtener_conexion(), "SELECT calsificacion FROM question where id=$inico");
                $inlineRadioOptions = 'inlineRadioOptions' . $inico;
                if($tipo->calsificacion==1){
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
                }else {
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
            print_r($json);
           /* $userrespuesta = new userrespuesta();
            $userrespuesta->setUser_id($_SESSION['user_id']);
            $userrespuesta->setQuiz_id($_GET['idExam']);
            $userrespuesta->setRespuesta($json);
            if ($userrespuesta->save()) {
                echo "<script>alert('Respuestas guardadas');</script>";
                echo "<script>window.location.replace('index.php');</script>";
            } else {
                echo "<script>alert('Error al guardar las respuestas');</script>";
                echo "<script>window.location.replace('examenes.php?bloque=" . $_GET['cap'] . "');</script>";
            }*/
        }?>
        <form action="" method="post">
            <?php
            informacionWorker::preguntas($_GET['cap'], $_GET['idExam']);
            ?>
            <div class="row mt-3">
                <div class="col text-center">
                    <button type="submit" name="saveAnswers" class="btn btn-success btn-lg">Guardar</button>
                    <a href="examenes.php?bloque=<?php echo $_GET['cap'] ?>" class="btn btn-danger btn-lg">Cancelar</a>
                </div>
            </div>
        </form>
    </div>
   
    <script src="../assets/js/bootstrap.bundle.js"></script>
</body>
</html>