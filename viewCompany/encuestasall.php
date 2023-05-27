<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Panel principal</title>
    <link href="../assets/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="../assets/css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/bootstrap-reboot.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../assets/css/bootstrap.css">
</head>
            <?php 
            include '../clases/database/conexion.inc.php';  
            include '../clases/datacompany/informacionCompany.inc.php';
            include '../clases/correos/correos.php';
            include '../clases/modelos/worker.php';
            include '../clases/modelos/capitulo.php';
            include '../clases/modelos/quiz.php';
            session_start();
            ?>
<body id="page-top">
    <div id="wrapper">
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">ENCUESTA <?php echo $_SESSION['nombre']; ?></div>
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
                <a class="nav-link text-white" href="trabajadores.php">Trabajadores</a>
                <a class="nav-link text-white" href="encuestas.php">Encuestas</a>
                <a class="nav-link text-white" href="encuesats.php">Encuestas realizadas</a>
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
                        <div class="topbar-divider d-none d-sm-block"></div>
                        <li class="nav-item dropdown no-arrow">
                        <div class="dropdown" style="margin-right: 30px;">
                        <a class="fs-5 mt-1 icon-link icon-link-hover link-success link-underline-success link-underline-opacity-25" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <?php echo $_SESSION['correo']; ?>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item fs-5" href="#">Configuracion</a></li>
                            <li><a class="dropdown-item fs-5 link-danger link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover" href="../clases/cerrar.inc.php">Salir</a></li>
                        </ul>
                        </div>
                        </li>
                    </ul>
                </nav>
                <div class="container-fluid">
                    <div class="row mb-4">
                        <div class="col">
                            <h1 class="h3 mb-0 text-gray-800">Cuestionarios</h1>
                        </div>
                        <div class="col">
                            <a href="preguntas.php?bloque=<?php echo $_GET['bloque']?>&capId=<?php echo $_GET['capId'] ?>" class="btn btn-primary btn-lg">Ver preguntas del bloque</a>
                        </div>
                        <div class="col">
                        <button type="button" class="btn btn-primary btn-lg" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            Previsualizar cuestionario
                            </button>
                        </div>
                        <div class="col">
                            <form action="" method="post"><button type="submit" class="btn btn-primary btn-lg" name="aplicarQuiz">Aplicar</button></form>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                        <?php
                            if(isset($_POST['aplicarQuiz'])){
                               $quiz = new Quiz();
                               $quiz->set_fecha(date("Y-m-d"));
                               $quiz->set_capitulo_id($_GET['capId']);
                               $quiz->save();
                            }
                        ?>
                        </div>
                   
                    </div>
                    <div class="row">
                        <div class="col">
                        <table class="table">
                            <thead>
                                <tr>
                                <th scope="col">#</th>
                                <th scope="col">fecha</th>
                                <th scope="col">capitulo</th>
                                </tr>
                            </thead>
                            <tbody>
                               <?php
                               Conexion::abrir_conexion();
                               informacionCompany::getQuizBlock(Conexion::obtener_conexion(),$_GET['capId'],$_SESSION['id']);
                               Conexion::cerrar_conexion();
                               ?>     
                            </tbody>
                            </table>
                        </div>
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
    <script src="../assets/js/bootstrap.bundle.js"></script>
    <script src="../assets/js/validaciones.js"></script>
    <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Preguntas de capitulo <?php echo $_GET['bloque']?></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <tbody>
                            <?php
                            Conexion::abrir_conexion();
                            informacionCompany::getQuestionsModal(Conexion::obtener_conexion(),$_GET['capId'],$_SESSION['id']);
                            Conexion::cerrar_conexion();
                            ?>
                        </tbody>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
                </div>
            </div>
            </div>
</body>
</html>