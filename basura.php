<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="../assets/css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/bootstrap-reboot.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../assets/css/bootstrap.css">

    <title>Resultados</title>
</head>
<?php
include '../clases/login.inc.php';
include '../clases/datacompany/informacionCompany.inc.php';
include '../clases/database/conexion.inc.php';
include '../clases/correos/correos.php';
login::sessionCompany();
?>

<body id="page-top">
    
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
            <div class="content">
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <ul class="navbar-nav ml-auto">
                        <a href="resultadosfinales.php" class="btn btn-outline-warning" style="border-radius: 35%;">
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
                        <div class="col-md-10">
                            <!-- Tabla 1 -->
                            <h1 class="text-center my-3"><strong>RESULTADOS DE LA ENCUESTA</strong></h1><br>
                            <p>Las respuestas a los ítems del cuestionario para la identificación de los factores de riesgo psicosocial deberán ser calificados, de acuerdo con la puntación de la Tabla siguiente:</p>
                            <div class="row justify-content-center">
                                <div class="col-lg-6">
                                    <table class="table table-striped">
                                        <caption>Tabla 1. Valor de las opciones de respuesta</caption>
                                        <thead>
                                            <tr>
                                                <th scope="col">Preguntas</th>
                                                <th scope="col">Siempre</th>
                                                <th scope="col">Casi siempre</th>
                                                <th scope="col">Algunas veces</th>
                                                <th scope="col">Casi nunca</th>
                                                <th scope="col">Nunca</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33</td>
                                                <td>0</td>
                                                <td>1</td>
                                                <td>2</td>
                                                <td>3</td>
                                                <td>4</td>
                                            </tr>
                                            <tr>
                                                <td>1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 34, 35, 36, 37, 38, 39, 40, 41, 42, 43, 44, 45, 46</td>
                                                <td>4</td>
                                                <td>3</td>
                                                <td>2</td>
                                                <td>1</td>
                                                <td>0</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <!-- Tabla 2 -->
                            <div class="row">
                                <div class="col-lg-12">
                                    <table class="table table-striped">
                                        <caption>Tabla 2. Grupos de ítems por dimensión, dominio y categoría</caption>
                                        <thead>
                                            <tr>
                                                <th scope="col">Categoría</th>
                                                <th scope="col">Dominio</th>
                                                <th scope="col">Dimensión</th>
                                                <th scope="col">Ítem</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td rowspan="12">Ambiente de trabajo</td>
                                                <td rowspan="3">Condiciones en el ambiente de trabajo</td>
                                                <td>Condiciones peligrosas e inseguras</td>
                                                <td>2</td>
                                            </tr>
                                            <tr>
                                                <td>Condiciones deficientes e insalubres</td>
                                                <td>1</td>
                                            </tr>
                                            <tr>
                                                <td>Trabajos peligrosos</td>
                                                <td>3</td>
                                            </tr>
                                            <tr>
                                                <td rowspan="9">Factores propios de la actividad</td>
                                                <td>Cargas cuantitativas</td>
                                                <td>4, 9</td>
                                            </tr>
                                            <tr>
                                                <td>Ritmos de trabajo acelerado</td>
                                                <td>5, 6</td>
                                            </tr>
                                            <tr>
                                                <td>Carga mental</td>
                                                <td>7, 8</td>
                                            </tr>
                                            <tr>
                                                <td>Cargas psicológicas emocionales</td>
                                                <td>41, 42, 43</td>
                                            </tr>
                                            <tr>
                                                <td>Cargas de alta responsabilidad</td>
                                                <td>10, 11</td>
                                            </tr>
                                            <tr>
                                                <td>Cargas contradictorias o inconsistentes</td>
                                                <td>12, 13</td>
                                            </tr>
                                            <tr>
                                                <td rowspan="2">Falta de control sobre el trabajo</td>
                                                <td>Falta de control y autonomía sobre el trabajo</td>
                                                <td>20, 21, 22</td>
                                            </tr>
                                            <tr>
                                                <td>Limitada o nula posibilidad de desarrollo</td>
                                                <td>18, 19</td>
                                            </tr>
                                            <tr>
                                                <td>Limitada o inexistente capacitación</td>
                                                <td>26, 27</td>
                                            </tr>
                                            <tr>
                                                <td rowspan="2">Organización del tiempo de trabajo</td>
                                                <td>Jornadas de trabajo extensas</td>
                                                <td>14, 15</td>
                                            </tr>
                                            <tr>
                                                <td>Interferencia en la relación trabajo-familia</td>
                                                <td>16, 17</td>
                                            </tr>
                                            <tr>
                                                <td rowspan="6">Liderazgo y relaciones en el trabajo</td>
                                                <td rowspan="3">Liderazgo</td>
                                                <td>Escasa claridad de funciones</td>
                                                <td>23, 24, 25</td>
                                            </tr>
                                            <tr>
                                                <td>Características del liderazgo</td>
                                                <td>28, 29</td>
                                            </tr>
                                            <tr>
                                                <td rowspan="2">Relaciones en el trabajo</td>
                                                <td>Relaciones sociales en el trabajo</td>
                                                <td>30, 31, 32</td>
                                            </tr>
                                            <tr>
                                                <td>Deficiente relación con los colaboradores que supervisa</td>
                                                <td>44, 45, 46</td>
                                            </tr>
                                            <tr>
                                                <td rowspan="2">Violencia</td>
                                                <td>Violencia laboral</td>
                                                <td>33, 34, 35, 36, 37, 38, 39, 40</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <p>Para obtener la calificación se deberá considerar la Tabla 2 que agrupa los ítems por categoría, dominio y dimensión, y proceder de la manera siguiente:</p>
                            <p>1) Calificación del dominio (Cdom). Se obtiene sumando el puntaje de cada uno de los ítems que integran el dominio;</p>
                            <p>2) Calificación de la categoría (Ccat). Se obtiene sumando el puntaje de cada uno de los ítems que integran la categoría, y</p>
                            <p>3) Calificación final del cuestionario (Cfinal). Se obtiene sumando el puntaje de todos y cada uno de los ítems que integran el cuestionario;</p>

                            <!-- Aquí puedes poner tu gráfico pastel -->
                            <div id="piechart" style="width: 900px; height: 500px;"></div>
                        </div>
                    </div>
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