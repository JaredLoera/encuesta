<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Panel principal</title>
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="../assets/css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/bootstrap-reboot.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../assets/css/bootstrap.css">
</head>
<?php
include '../clases/login.inc.php';
include '../clases/dataroot/informacionRoot.inc.php';
include '../clases/database/conexion.inc.php';
include '../clases/modelos/company.php';
include '../clases/correos/correos.php';
include '../clases/modelos/bloque.php';
include '../clases/modelos/quiz.php';
include '../clases/modelos/userrespuesta.php';
login::sessionRoot();
?>

<body id="page-top">
    <div id="wrapper">
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">ENCUESTAS DE LA EMPRESA</div>
            </a>
            <hr class="border border-1 opacity-75">
            <li class="nav-item active">
                <a class="nav-link fs-5" href="index.php"> Panel principal </a>
            </li>
            <hr class="sidebar-divider">
            <div class="sidebar-heading fs-5">
                Interfaces
            </div>
            <nav class="nav flex-column ml-3 fw-bold">
                <?php
                include 'links.php';
                ?>
            </nav>
            <hr class="sidebar-divider">
            <div class="sidebar-heading">
                Componentes adicionales
            </div>
            <hr class="sidebar-divider d-none d-md-block">
        </ul>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <ul class="navbar-nav ml-auto">
                        <a href="encuestasall.php" class="btn btn-outline-warning" style="border-radius: 35%;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-arrow-return-left" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M14.5 1.5a.5.5 0 0 1 .5.5v4.8a2.5 2.5 0 0 1-2.5 2.5H2.707l3.347 3.346a.5.5 0 0 1-.708.708l-4.2-4.2a.5.5 0 0 1 0-.708l4-4a.5.5 0 1 1 .708.708L2.707 8.3H12.5A1.5 1.5 0 0 0 14 6.8V2a.5.5 0 0 1 .5-.5z"></path>
                            </svg>
                        </a>
                        <div class="topbar-divider d-none d-sm-block"></div>
                        <li class="nav-item dropdown no-arrow">
                            <div class="dropdown" style="margin-right: 30px;">
                                <a class="fs-5 mt-1 icon-link icon-link-hover link-success link-underline-success link-underline-opacity-25" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <?php echo $_SESSION['correo']; ?>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item fs-5" href="#">Configuración</a></li>
                                    <li><a class="dropdown-item fs-5 link-danger link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover" href="../clases/cerrar.inc.php">Salir</a></li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </nav>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col mb-4">
                            <h1 class="h3 mb-0 text-gray-800">Información de la encuesta</h1>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-4">
                            <h1 class="h3 mb-0 text-gray-800">Capítulos aplicados</h1>
                        </div>
                        <div class="col">
                            <button type="button" class="btn btn-primary btn-lg" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            Termianar encuesta
                            </button>
                        </div>
                    </div>
                    <?php
                    if (isset($_POST['aplicarBloqueRandom'])) {
                        $idBloqueInfo = informacionRoot::getIdBloqueInfo("Encuesta-1", $_GET['id']);
                        date_default_timezone_set('America/Mexico_City');
                        $tiempo_en_segundos = time();
                        $fecha_actual = date("d-m-Y h:i:s", $tiempo_en_segundos);
                        $bloque = new Bloque();
                        $bloque->set_folio($idBloqueInfo->nombre . " " . $fecha_actual);
                        $bloque->set_company_id($_GET['id']);
                        $bloque->set_bloqueinfo_id($idBloqueInfo->id);
                        $idlastBloque=$bloque->save();
                        Conexion::abrir_conexion();
                        $var = informacionRoot::getCapitulosCount(Conexion::obtener_conexion(), $_GET['id'], $idlastBloque);
                        Conexion::cerrar_conexion();
                        $idsWorkers = informacionRoot::workersCompany($_GET['id']);
                        $idQuizs= informacionRoot::getQuizs($idlastBloque);
                        foreach ($idsWorkers as $ifids)
                        { 
                            foreach ($idQuizs as $idQuiz) {
                                if(!informacionRoot::conprobarExamenesPendientes($ifids->id,$idQuiz->id)){
                                    $QuerynumQuestion ="SELECT * FROM question where capitulo_id = ".$idQuiz->capitulo_id;
                                    Conexion::abrir_conexion();
                                    $arreglo_respuesta = '';
                                    $arreglo_respuesta = json_decode($arreglo_respuesta, TRUE);
                                    $idsPreguntas = datosRoot::consultas(Conexion::obtener_conexion(),$QuerynumQuestion);
                                        foreach ($idsPreguntas as $idsPregunta) {
                                            $tipo = datosRoot::preguntaOnlyRow(conexion::obtener_conexion(), "SELECT calsificacion FROM question where id=$idsPregunta->id");
                                            $respuestas = array('Siempre', 'Casi siempre', 'Algunas veces', 'Casi nunca', 'Nunca');
                                            $respuesta_aleatoria = $respuestas[array_rand($respuestas)];
                                            if($tipo->calsificacion==1){
                                                 
                                               switch ($respuesta_aleatoria) {
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
                                            }else{
                                               switch ($respuesta_aleatoria) {
                                                   case 'Siempre':
                                                       $valor = 0;
                                                       break;
                                                   case 'Casi siempre':
                                                       $valor = 1;
                                                       break;
                                                   case 'Algunas veces':
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
                                            $arreglo_respuesta[] = ['idpregunta' => $idsPregunta->id, 'respuesta' => $respuesta_aleatoria, 'valor' => $valor];
                                        }
                                        Conexion::cerrar_conexion();
                                        $json = json_encode($arreglo_respuesta);
                                        $userrespuesta = new userrespuesta();
                                        $userrespuesta->setUser_id($ifids->id);
                                        $userrespuesta->setQuiz_id($idQuiz->id);
                                        $userrespuesta->setRespuesta($json);
                                        $userrespuesta->save();
                                        $json = null;
                                        $arreglo_respuesta = null;
                                }
                            }
                         
                        }
                     ?> 
                     <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>¡Quiz aplicado a la empresa!</strong> Se aplico aplico el bloque de quiz correctamente y se finalizaron correctamente.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                     <?php
                    } 
                    ?>
                    <div class="row row-cols-1 row-cols-md-3 g-4">
                        <?php
                        informacionRoot::capitulosRespuestas($_GET['id']);
                        ?>
                    </div>
                </div>
                <!--TERMINAN CARDS SUPERIORES-->
                <!--MENSAJES DE CONFIRMACION EMPRESA AÑADIDAD-->
            </div>
        </div>
    </div>
    <footer class="sticky-footer bg-white">
        <div class="container my-auto">
            <div class="copyright text-center my-auto">
                <span>Copyright &copy; Encuestas grupo conta pagos</span>
            </div>
        </div>
    </footer>
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
    <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                   <h4>¿Aplicar bloque y finalizar?</h4>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <form action="" method="post">
                    <button type="submit" class="btn btn-primary" name="aplicarBloqueRandom">Save changes</button>
                  </form>  
                </div>
                </div>
            </div>
            </div>
    <script src="../assets/js/bootstrap.bundle.js"></script>
    <script src="../assets/js/validaciones.js"></script>
</body>
</html>