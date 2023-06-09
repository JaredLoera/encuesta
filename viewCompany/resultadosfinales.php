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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>
<?php
include '../clases/login.inc.php';
include '../clases/datacompany/informacionCompany.inc.php';
include '../clases/database/conexion.inc.php';
include '../clases/correos/correos.php';
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
                    <div class="row justify-content-center">


                        <!-- form de elegir si todos o unos pocos -->
                        <form action="" method="post" class="form-inline">
                            <h4>Selecciona por:</h4>
                            <select class="form-select form-select-lg mb-3" name="filtrarDatos" aria-label=".form-select-lg example">
                                <option value="1" selected>Trabajador individual</option>
                                <option value="2">Todos los trabajadores</option>
                            </select>
                            <button type="submit" class="btn btn-primary btn-block mb-4" name="listaTrabajadores">Filtrar</button>
                        </form>

                        <?php if (isset($_POST['listaTrabajadores'])) {

                            $value = $_POST['filtrarDatos'];

                            if ($value == '1') { ?>
                                <div class="col-md-6">
                                    <h4>Selecciona el folio que deseas verificar:</h4>
                                    <form action="" method="post" class="form-inline text-center">
                                        <div class="form-group w-100">
                                            <select name="filtrarFolios" class="form-select form-select-lg mb-3 w-100" aria-label=".form-select-lg example">
                                                <option value="Todos" selected>Todos</option>
                                                <?php
                                                informacionCompany::getAllFolios($_SESSION['id']);
                                                ?>
                                            </select>
                                        </div>
                                        <button type="submit" class="btn btn-warning btn-block mb-4" name="listaFolios">Filtrar Folios</button>
                                    </form>
                                </div><?php
                                    } elseif ($value == '2') { ?>

                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead class="text-center">
                                            <tr class="table-dark">
                                                <th scope="col">Todos los trabajadores</th>
                                            </tr>
                                        </thead>
                                        <tbody class="text-center">
                                            <td>
                                                <form action="vistacalculoall.php" method="get">
                                                    <button type="submit" class="btn btn-danger"> Ver resultados </button>
                                                </form>
                                            </td>
                                        </tbody>
                                    </table>
                                </div>
                            <?php
                                    }
                                }
                                $selectvalue = "Todos";
                                if (isset($_POST['listaFolios'])) {

                                    $selectvalue = $_POST['filtrarFolios'];

                                    if ($selectvalue == 'Todos') { ?>
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead class="text-center">
                                            <tr class="table-dark">
                                                <th></th>
                                                <th scope="col">#</th>
                                                <th scope="col">Nombre completo</th>
                                                <th scope="col">Folio de Encuesta</th>
                                                <th scope="col">Resultados</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody class="text-center">
                                            <?php informacionCompany::getAllWorkersWhoHasAQuizBlock($_SESSION['id']); ?>
                                        </tbody>
                                    </table>
                                </div><?php
                                    } elseif ($selectvalue != "Todos") { ?>
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead class="text-center">
                                            <tr class="table-dark">
                                                <th></th>
                                                <th scope="col">#</th>
                                                <th scope="col">Nombre completo</th>
                                                <th scope="col">Folio de Encuesta</th>
                                                <th scope="col">Resultados</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody class="text-center">
                                            <?php
                                            informacionCompany::getAllWorkersWhoHasAQuizBlockPerFolio($_SESSION['id'], $selectvalue);
                                            ?>
                                        </tbody>
                                    </table>
                                </div><?php

                                    }
                                }
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
</body>

</html>