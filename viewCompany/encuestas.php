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
include '../clases/database/conexion.inc.php';
include '../clases/datacompany/informacionCompany.inc.php';
include '../clases/correos/correos.php';
include '../clases/modelos/worker.php';
include '../clases/modelos/capitulo.php';
include '../clases/modelos/bloque.php';
include '../clases/modelos/quiz.php';
login::sessionCompany();
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
                        <a href="index.php" class="btn btn-outline-warning" style="border-radius: 35%;">
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
                    <div class="row mb-4">
                        <div class="col">
                            <h1 class="h3 mb-0 text-gray-800">Capítulos</h1>
                        </div>
                        <div class="col">
                            <button class="btn btn-primary btn-lg" data-bs-toggle="modal" data-bs-target="#exampleModal">Añadir capitulo</button>
                        </div>
                        <div class="col-12 col-md mb-3 mb-md-0">
                            <form action="" method="post">
                                <button type="submit" class="btn btn-warning btn-lg w-100" name="aplicarBloque">Aplicar bloque de preguntas</button>
                            </form>
                        </div>
                    </div>
                    <div class="row">
                        <?php
                        if (isset($_POST['aplicarBloque'])) {
                            Conexion::abrir_conexion();
                            $idBloqueInfo = informacionCompany::getIdBloqueInfo("Encuesta-1", $_SESSION['id']);
                            Conexion::cerrar_conexion();

                            if ($idBloqueInfo[0]->id == 1) {
                                date_default_timezone_set('America/Mexico_City');

                                $tiempo_en_segundos = time();
                                $fecha_actual = date("d-m-Y h:i:s", $tiempo_en_segundos);
                                $bloque = new Bloque();
                                $bloque->set_folio($idBloqueInfo[0]->nombre . " " . $fecha_actual);
                                $bloque->set_company_id($_SESSION['id']);
                                $bloque->set_bloqueinfo_id($idBloqueInfo[0]->id);
                                $idBloque = $bloque->save();
                                Conexion::abrir_conexion();
                                $var = informacionCompany::getCapitulosCount(Conexion::obtener_conexion(), $_SESSION['id'], $idBloque);
                                Conexion::cerrar_conexion();

                                if ($var == true) {
                        ?>
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        <strong>¡Bloque añadido!</strong> El bloque se añadio correctamente.
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>

                                <?php
                                }
                            }
                        }

                        if (isset($_POST['guardarCapitulo'])) {
                            extract($_POST);
                            $capitulo = new Capitulo();
                            $capitulo->set_numcapitulo(informacionCompany::nextCap($_SESSION['id']));
                            $capitulo->set_descripcion($descripcion);
                            $capitulo->set_nombre_examen($nombre_examen);
                            $capitulo->set_company_id($_SESSION['id']);

                            die();
                            if ($capitulo->save()) {
                                ?>
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <strong>¡Capitulo añadido!</strong> El capitulo se añadio correctamente.
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            <?php
                            } else {
                            ?>
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <strong>¡Error!</strong> El capitulo no se añadio correctamente.
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                        <?php
                            }
                        }
                        Conexion::abrir_conexion();
                        informacionCompany::getCapitulos(Conexion::obtener_conexion(), $_SESSION['id']);
                        Conexion::cerrar_conexion();
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
    <script src="../assets/js/bootstrap.bundle.js"></script>
    <script src="../assets/js/validaciones.js"></script>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Añadir Capitulo</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post" action="">
                        <div class="mb-3 text-center">
                            <h4>Se va a añadir el capitulo No# "<?php echo informacionCompany::nextCap($_SESSION['id']) ?>" </h4>
                        </div>
                        <div class="mb-3">
                            <label for="nombreexamen" class="form-label">Nombre del examen</label>
                            <input type="text" class="form-control" id="nombre_examen" aria-describedby="emailHelp" name="nombre_examen" require>
                        </div>
                        <div class="mb-3">
                            <label for="descripcion" class="form-label">descripcion</label>
                            <input type="text" class="form-control" id="descripcion" aria-describedby="emailHelp" name="descripcion" require>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary" name="guardarCapitulo">Guardar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>