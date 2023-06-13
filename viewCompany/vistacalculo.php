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
                    <?php
                                Conexion::abrir_conexion();
                                $cfinal = informacionCompany::getJsonAnswer(Conexion::obtener_conexion(), $_SESSION['id'], $_GET['sid'], $_GET['fol']);

                                $cAmbienteTrabajo = informacionCompany::getAllBasedJsonAnswer(Conexion::obtener_conexion(), $_SESSION['id'], $_GET['sid'], $_GET['fol'], [2,1,3]);
                                $fPropiosDeActividad = informacionCompany::getAllBasedJsonAnswer(Conexion::obtener_conexion(), $_SESSION['id'], $_GET['sid'], $_GET['fol'], [4,9,5,6,7,8,41,42,43,10,11,12,13,20,21,22,18,19,26,27]);
                                $oDelTiempoDeTrabajo = informacionCompany::getAllBasedJsonAnswer(Conexion::obtener_conexion(), $_SESSION['id'], $_GET['sid'], $_GET['fol'], [14, 15,16,17]);
                                $lYRelacionesDeTrabajo = informacionCompany::getAllBasedJsonAnswer(Conexion::obtener_conexion(), $_SESSION['id'], $_GET['sid'], $_GET['fol'], [23, 24, 25,28, 29,30, 31, 32,44, 45, 46,33, 34, 35, 36, 37, 38, 39, 40]);
                                
                                $cAmbienteTrabajoDominio = informacionCompany::getAllBasedJsonAnswer(Conexion::obtener_conexion(), $_SESSION['id'], $_GET['sid'], $_GET['fol'], [1,2,3]);
                                $cargaTrabajoDominio = informacionCompany::getAllBasedJsonAnswer(Conexion::obtener_conexion(), $_SESSION['id'], $_GET['sid'], $_GET['fol'], [4,9,5, 6,7, 8,41, 42, 43,10, 11,12, 13]);
                                $fControlSobreTrabajoDominio = informacionCompany::getAllBasedJsonAnswer(Conexion::obtener_conexion(), $_SESSION['id'], $_GET['sid'], $_GET['fol'], [20, 21, 22,18, 19,26,27]);
                                $jTrabajoDominio = informacionCompany::getAllBasedJsonAnswer(Conexion::obtener_conexion(), $_SESSION['id'], $_GET['sid'], $_GET['fol'], [14, 15]);
                                $iTrabajofamiliaDominio = informacionCompany::getAllBasedJsonAnswer(Conexion::obtener_conexion(), $_SESSION['id'], $_GET['sid'], $_GET['fol'], [16,17]);
                                $liderazgoDominio = informacionCompany::getAllBasedJsonAnswer(Conexion::obtener_conexion(), $_SESSION['id'], $_GET['sid'], $_GET['fol'], [23,24,25,28,29]);
                                $rTrabajoDominio = informacionCompany::getAllBasedJsonAnswer(Conexion::obtener_conexion(), $_SESSION['id'], $_GET['sid'], $_GET['fol'], [30,31,32,44,45,46]);
                                $violeciaDominio = informacionCompany::getAllBasedJsonAnswer(Conexion::obtener_conexion(), $_SESSION['id'], $_GET['sid'], $_GET['fol'], [33,34,35, 36,37,38,39,40]);
                                Conexion::cerrar_conexion();
                    ?>
                    <h1 class="text-center my-3"><strong>RESULTADOS DE LA ENCUESTA</strong></h1><br>
                    <div class="col-md-6">
                    <?php
                   
                                    if ($cfinal < 20) {
                                         $estadoMental = "Nulo";
                                         $color = "#00c0f3";
                                         $mensaje="El riesgo resulta despreciable por lo que no se requiere medidas adicionales.";
                                    } elseif ($cfinal >= 20 && $cfinal < 45) {
                                         $estadoMental = "Bajo";
                                         $color = "#16a53f";
                                         $mensaje="Es necesario una mayor difusión de la política de prevención de riesgos psicosociales y programas para: la prevención de los factores de riesgo psicosocial, la promoción de un entorno organizacional favorable y la prevención de la violencia laboral.";
                                    } elseif ($cfinal >= 45 && $cfinal < 70) { 
                                         $estadoMental = "Medio";
                                            $color = "#ffff00";
                                            $mensaje="Se requiere revisar la política de prevención de riesgos psicosociales y programas para la prevención de los factores de riesgo psicosocial, la promoción de un entorno organizacional favorable y la prevención de la violencia laboral, así como reforzar su aplicación y difusión, mediante un Programa de intervención";
                                    } elseif ($cfinal >= 70 && $cfinal < 90) {     
                                          $estadoMental = "Alto";  
                                          $color = "#ff8000";
                                          $mensaje ="Se requiere realizar un análisis de cada categoría y dominio, de manera que se puedan determinar las acciones de intervención apropiadas a través de un Programa de intervención, que podrá incluir una evaluación específica1 y deberá incluir una campaña de sensibilización, revisar la política de prevención de riesgos psicosociales y programas para la prevención de los factores de riesgo psicosocial, la promoción de un entorno organizacional favorable y la prevención de la violencia laboral, así como reforzar su aplicación y difusión.";
                                    } elseif ($cfinal > 90) {
                                         $estadoMental = "Muy Alto";   
                                         $color = "#ff3600";   
                                         $mensaje ="Se requiere realizar el análisis de cada categoría y dominio para establecer las acciones de intervención apropiadas, mediante un Programa de intervención que deberá incluir evaluaciones específicas1, y contemplar campañas de sensibilización, revisar la política de prevención de riesgos psicosociales y programas para la prevención de los factores de riesgo psicosocial, la promoción de un entorno organizacional favorable y la prevención de la violencia laboral, así como reforzar su aplicación y difusión.                                        ";
                                    }
                                   ////////////////////////////////////////// PARA CALCULOS DE CATEGORIA
                                    if ($cAmbienteTrabajo<3) {                                    
                                        $estadoAmbiente = "Nulo";
                                        $estadoAmbienteColor = "#AEEEFF";
                                    }
                                    elseif ($cAmbienteTrabajo >= 3 && $cAmbienteTrabajo<5) {
                                        $estadoAmbiente = "Bajo";
                                        $estadoAmbienteColor = "#72E894";
                                    }
                                    elseif ($cAmbienteTrabajo >= 5 && $cAmbienteTrabajo<7) {
                                        $estadoAmbiente = "Medio";
                                        $estadoAmbienteColor = "#FFFF8F";
                                    }
                                    elseif ($cAmbienteTrabajo>=7 && $cAmbienteTrabajo<9) {
                                        $estadoAmbiente = "Alto";  
                                        $estadoAmbienteColor = "#FFBC79";
                                    }elseif ($cAmbienteTrabajo>9) {
                                        $estadoAmbiente = "Muy Alto";   
                                        $estadoAmbienteColor = "#EDADAD";   
                                    }

                                    if ($fPropiosDeActividad<10) {                                    
                                        $estadoFactoresPropios = "Nulo";
                                        $estadoFactoresColor = "#AEEEFF";
                                    }
                                    elseif ($fPropiosDeActividad >= 10 && $fPropiosDeActividad<20) {
                                        $estadoFactoresPropios = "Bajo";
                                        $estadoFactoresColor = "#72E894";
                                    }
                                    elseif ($fPropiosDeActividad >= 20 && $fPropiosDeActividad<30) {
                                        $estadoFactoresPropios = "Medio";
                                        $estadoFactoresColor = "#FFFF8F";
                                    }
                                    elseif ($fPropiosDeActividad>=30 && $fPropiosDeActividad<40) {
                                        $estadoFactoresPropios = "Alto";  
                                        $estadoFactoresColor = "#FFBC79";
                                    }elseif ($fPropiosDeActividad>40) {
                                        $estadoFactoresPropios = "Muy Alto";   
                                        $estadoFactoresColor = "#EDADAD";   
                                    }

                                    if ($oDelTiempoDeTrabajo<4) {                                    
                                        $estadoOrganicacionTiempo = "Nulo";
                                        $estadoOrgTiempoColor = "#AEEEFF";
                                    }
                                    elseif ($oDelTiempoDeTrabajo >= 4 && $oDelTiempoDeTrabajo<6) {
                                        $estadoOrganicacionTiempo = "Bajo";
                                        $estadoOrgTiempoColor = "#72E894";
                                    }
                                    elseif ($oDelTiempoDeTrabajo >= 6 && $oDelTiempoDeTrabajo<9) {
                                        $estadoOrganicacionTiempo = "Medio";
                                        $estadoOrgTiempoColor = "#FFFF8F";
                                    }
                                    elseif ($oDelTiempoDeTrabajo>=9 && $oDelTiempoDeTrabajo<12) {
                                        $estadoOrganicacionTiempo = "Alto";  
                                        $estadoOrgTiempoColor = "#FFBC79";
                                    }elseif ($oDelTiempoDeTrabajo>12) {
                                        $estadoOrganicacionTiempo = "Muy Alto";   
                                        $estadoOrgTiempoColor = "#EDADAD";   
                                    }

                                    if ($lYRelacionesDeTrabajo<4) {                                    
                                        $estadoLiderazgoTrabajo = "Nulo";
                                        $estadoLiderazgoColor = "#AEEEFF";
                                    }
                                    elseif ($lYRelacionesDeTrabajo >= 4 && $lYRelacionesDeTrabajo<6) {
                                        $estadoLiderazgoTrabajo = "Bajo";
                                        $estadoLiderazgoColor = "#72E894";
                                    }
                                    elseif ($lYRelacionesDeTrabajo >= 6 && $lYRelacionesDeTrabajo<9) {
                                        $estadoLiderazgoTrabajo = "Medio";
                                        $estadoLiderazgoColor = "#FFFF8F";
                                    }
                                    elseif ($lYRelacionesDeTrabajo>=9 && $lYRelacionesDeTrabajo<12) {
                                        $estadoLiderazgoTrabajo = "Alto";  
                                        $estadoLiderazgoColor = "#FFBC79";
                                    }elseif ($lYRelacionesDeTrabajo>12) {
                                        $estadoLiderazgoTrabajo = "Muy Alto";   
                                        $estadoLiderazgoColor = "#EDADAD";   
                                    }
                                        /////////////////////////////////////////////////////////////////////////////PARA CALCULO DE DOMINIO
                                    if ($cAmbienteTrabajoDominio<3) {                                    
                                        $estadoCondicionesTrabajoDominio = "Nulo";
                                        $estadoCondiconesDominioColor = "#AEEEFF";
                                    }
                                    elseif ($cAmbienteTrabajoDominio >= 3 && $cAmbienteTrabajoDominio<5) {
                                        $estadoCondicionesTrabajoDominio = "Bajo";
                                        $estadoCondiconesDominioColor = "#72E894";
                                    }
                                    elseif ($cAmbienteTrabajoDominio >= 5 && $cAmbienteTrabajoDominio<7) {
                                        $estadoCondicionesTrabajoDominio = "Medio";
                                        $estadoCondiconesDominioColor = "#FFFF8F";
                                    }
                                    elseif ($cAmbienteTrabajoDominio>=7 && $cAmbienteTrabajoDominio<9) {
                                        $estadoCondicionesTrabajoDominio = "Alto";  
                                        $estadoCondiconesDominioColor = "#FFBC79";
                                    }elseif ($cAmbienteTrabajoDominio>9) {
                                        $estadoCondicionesTrabajoDominio = "Muy Alto";   
                                        $estadoCondiconesDominioColor = "#EDADAD";   
                                    }

                                    if ($cargaTrabajoDominio<12) {                                    
                                        $estadoCargaTrabajoDominio = "Nulo";
                                        $estadoCargaDominioColor = "#AEEEFF";
                                    }
                                    elseif ($cargaTrabajoDominio >= 12 && $cargaTrabajoDominio<16) {
                                        $estadoCargaTrabajoDominio = "Bajo";
                                        $estadoCargaDominioColor = "#72E894";
                                    }
                                    elseif ($cargaTrabajoDominio >= 16 && $cargaTrabajoDominio<20) {
                                        $estadoCargaTrabajoDominio = "Medio";
                                        $estadoCargaDominioColor = "#FFFF8F";
                                    }
                                    elseif ($cargaTrabajoDominio>=20 && $cargaTrabajoDominio<24) {
                                        $estadoCargaTrabajoDominio = "Alto";  
                                        $estadoCargaDominioColor = "#FFBC79";
                                    }elseif ($cAmbienteTrabajoDominio>24) {
                                        $estadoCargaTrabajoDominio = "Muy Alto";   
                                        $estadoCargaDominioColor = "#EDADAD";   
                                    }

                                    if ($fControlSobreTrabajoDominio<1) {                                    
                                        $estadoControlTrabajoDominio = "Nulo";
                                        $estadoControlDominioColor = "#AEEEFF";
                                    }
                                    elseif ($fControlSobreTrabajoDominio >= 5 && $fControlSobreTrabajoDominio<8) {
                                        $estadoControlTrabajoDominio = "Bajo";
                                        $estadoControlDominioColor = "#72E894";
                                    }
                                    elseif ($fControlSobreTrabajoDominio >= 8 && $fControlSobreTrabajoDominio<11) {
                                        $estadoControlTrabajoDominio = "Medio";
                                        $estadoControlDominioColor = "#FFFF8F";
                                    }
                                    elseif ($fControlSobreTrabajoDominio>=11 && $fControlSobreTrabajoDominio<14) {
                                        $estadoControlTrabajoDominio = "Alto";  
                                        $estadoControlDominioColor = "#FFBC79";
                                    }elseif ($fControlSobreTrabajoDominio>14) {
                                        $estadoControlTrabajoDominio = "Muy Alto";   
                                        $estadoControlDominioColor = "#EDADAD";   
                                    }

                                    if ($jTrabajoDominio<1) {                                    
                                        $estadoControlDominio = "Nulo";
                                        $estadoJornadaDominioColor = "#AEEEFF";
                                    }
                                    elseif ($jTrabajoDominio >= 1 && $jTrabajoDominio<2) {
                                        $estadoControlDominio = "Bajo";
                                        $estadoJornadaDominioColor = "#72E894";
                                    }
                                    elseif ($jTrabajoDominio >= 2 && $jTrabajoDominio<4) {
                                        $estadoControlDominio = "Medio";
                                        $estadoJornadaDominioColor = "#FFFF8F";
                                    }
                                    elseif ($jTrabajoDominio>=4 && $jTrabajoDominio<6) {
                                        $estadoControlDominio = "Alto";  
                                        $estadoJornadaDominioColor = "#FFBC79";
                                    }elseif ($jTrabajoDominio>6) {
                                        $estadoControlDominio = "Muy Alto";   
                                        $estadoJornadaDominioColor = "#EDADAD";   
                                    }

                                    if ($iTrabajofamiliaDominio<1) {                                    
                                        $estadoFamiliaDominio = "Nulo";
                                        $estadoFamiliaDominioColor = "#AEEEFF";
                                    }
                                    elseif ($iTrabajofamiliaDominio >= 1 && $iTrabajofamiliaDominio<2) {
                                        $estadoFamiliaDominio = "Bajo";
                                        $estadoFamiliaDominioColor = "#72E894";
                                    }
                                    elseif ($iTrabajofamiliaDominio >= 2 && $iTrabajofamiliaDominio<4) {
                                        $estadoFamiliaDominio = "Medio";
                                        $estadoFamiliaDominioColor = "#FFFF8F";
                                    }
                                    elseif ($iTrabajofamiliaDominio>=4 && $iTrabajofamiliaDominio<6) {
                                        $estadoFamiliaDominio = "Alto";  
                                        $estadoFamiliaDominioColor = "#FFBC79";
                                    }elseif ($iTrabajofamiliaDominio>6) {
                                        $estadoFamiliaDominio = "Muy Alto";   
                                        $estadoFamiliaDominioColor = "#EDADAD";   
                                    }

                                    if ($liderazgoDominio<3) {                                    
                                        $estadoLiderazgoDominio = "Nulo";
                                        $estadoLiderazgoDominioColor = "#AEEEFF";
                                    }
                                    elseif ($liderazgoDominio >= 3 && $liderazgoDominio<5) {
                                        $estadoLiderazgoDominio = "Bajo";
                                        $estadoLiderazgoDominioColor = "#72E894";
                                    }
                                    elseif ($liderazgoDominio >= 5 && $liderazgoDominio<8) {
                                        $estadoLiderazgoDominio = "Medio";
                                        $estadoLiderazgoDominioColor = "#FFFF8F";
                                    }
                                    elseif ($liderazgoDominio>=8 && $liderazgoDominio<11) {
                                        $estadoLiderazgoDominio = "Alto";  
                                        $estadoLiderazgoDominioColor = "#FFBC79";
                                    }elseif ($liderazgoDominio>11) {
                                        $estadoLiderazgoDominio = "Muy Alto";   
                                        $estadoLiderazgoDominioColor = "#EDADAD";   
                                    }

                                    if ($rTrabajoDominio<5) {                                    
                                        $estadoRelacionesDominio = "Nulo";
                                        $estadoRelacionesDominioColor = "#AEEEFF";
                                    }
                                    elseif ($rTrabajoDominio >= 5 && $rTrabajoDominio<8) {
                                        $estadoRelacionesDominio = "Bajo";
                                        $estadoRelacionesDominioColor = "#72E894";
                                    }
                                    elseif ($rTrabajoDominio >= 8 && $rTrabajoDominio<11) {
                                        $estadoRelacionesDominio = "Medio";
                                        $estadoRelacionesDominioColor = "#FFFF8F";
                                    }
                                    elseif ($rTrabajoDominio>=11 && $rTrabajoDominio<14) {
                                        $estadoRelacionesDominio = "Alto";  
                                        $estadoRelacionesDominioColor = "#FFBC79";
                                    }
                                    elseif ($rTrabajoDominio>14) {
                                        $estadoRelacionesDominio = "Muy Alto";   
                                        $estadoRelacionesDominioColor = "#EDADAD";   
                                    }

                                    if ($violeciaDominio<7) {                                    
                                        $estadoViolenciaDominio = "Nulo";
                                        $estadoViolenciaDominioColor = "#AEEEFF";
                                    }
                                    elseif ($violeciaDominio >= 7 && $violeciaDominio<10) {
                                        $estadoViolenciaDominio = "Bajo";
                                        $estadoViolenciaDominioColor = "#72E894";
                                    }
                                    elseif ($violeciaDominio >= 10 && $violeciaDominio<13) {
                                        $estadoViolenciaDominio = "Medio";
                                        $estadoViolenciaDominioColor = "#FFFF8F";
                                    }
                                    elseif ($violeciaDominio>=13 && $violeciaDominio<16) {
                                        $estadoViolenciaDominio = "Alto";  
                                        $estadoViolenciaDominioColor = "#FFBC79";
                                    }
                                    elseif ($violeciaDominio>16) {
                                        $estadoViolenciaDominio = "Muy Alto";   
                                        $estadoViolenciaDominioColor = "#EDADAD";   
                                    }

                                ?>
                        <table class="table table-bordered border-2" style="border-color: <?php echo $color ?>;">
                            <thead>
                                <tr class="fs-4">
                                <th scope="col">Resultado del cuestionario</th>
                                <th scope="col">Calificacion final del cuestionario</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="fs-4 text-center">
                                <th scope="row">
                                <?php echo $estadoMental ?>
                                </th>
                                <td>
                                <h3><?php echo $cfinal ?></h3>
                                </td>
                                </tr>
                            </tbody>
                        </table>
                        </div>
                    </div>
                    <div class="row">
                        <?php 
                        ?>
                        <div class="col">
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <strong>Nota:</strong> <?php echo $mensaje ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3 mb-2">
                        <div class="col">
                            <h2><strong>Calificacion por categoria</strong></h2>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                        <table class="table table-bordered border-2">
                            <thead>
                                <tr class="fs-4">
                                <th scope="col">Calificacion de la categoria</th>
                                <th scope="col" class="text-center">Puntos obtenidos</th>
                                </tr>
                            </thead>
                            <tbody class="fs-4">
                                <tr>
                                <td scope="row" style="background-color:<?php echo $estadoAmbienteColor; ?>">
                                Ambiente de trabajo
                                </td>
                                <td class="text-center" style="background-color:<?php echo $estadoAmbienteColor; ?>">
                                <?php echo $cAmbienteTrabajo ?>
                                </td>
                                </tr>
                                <tr>
                                <td style="background-color:<?php echo $estadoFactoresColor; ?>">Factores propios de actividad</td>
                                <td class="text-center" style="background-color:<?php echo $estadoFactoresColor; ?>">
                                    <?php echo $fPropiosDeActividad ?>
                                </th>
                                </tr>
                                <tr>
                                    <td style="background-color:<?php echo $estadoOrgTiempoColor; ?>">
                                        Organización del tiempo de trabajo
                                    </th>
                                    <td class="text-center" style="background-color:<?php echo $estadoOrgTiempoColor; ?>">
                                        <?php echo $oDelTiempoDeTrabajo ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td  style="background-color:<?php echo $estadoLiderazgoColor; ?>">
                                        Liderazgo y relaciones en el trabajo
                                    </td>
                                    <td class="text-center"  style="background-color:<?php echo $estadoLiderazgoColor; ?>">
                                        <?php echo $lYRelacionesDeTrabajo ?>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        </div>
                    </div>
                    <div class="row mt-3 mb-2">
                        <div class="col">
                            <h2><strong>Calificacion por dominio</strong></h2>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                        <table class="table table-bordered border-2">
                            <thead>
                                <tr class="fs-4">
                                <th scope="col">Calificacion del dominio</th>
                                <th scope="col" class="text-center">Puntos obtenidos</th>
                                </tr>
                            </thead>
                            <tbody class="fs-4">
                                <tr>
                                    <td style="background-color:<?php echo $estadoCondiconesDominioColor; ?>">Condicion en el ambiente de trabajo</td>
                                    <td class="text-center" style="background-color:<?php echo $estadoCondiconesDominioColor; ?>"><?php echo $cAmbienteTrabajoDominio ?></td>
                                </tr>
                                <tr>
                                    <td style="background-color:<?php echo $estadoCargaDominioColor; ?>">Carga de trabajo</td>
                                    <td class="text-center" style="background-color:<?php echo $estadoCargaDominioColor; ?>"><?php echo $cargaTrabajoDominio ?></td>
                                </tr>
                                <tr>
                                    <td style="background-color:<?php echo $estadoControlDominioColor; ?>">Falta de control sobre el trabajo</td>
                                    <td class="text-center" style="background-color:<?php echo $estadoControlDominioColor; ?>"><?php echo $fControlSobreTrabajoDominio ?></td>
                                </tr>
                                <tr>
                                    <td style="background-color:<?php echo $estadoJornadaDominioColor; ?>">Jornada de trabajo</td>
                                    <td class="text-center" style="background-color:<?php echo $estadoJornadaDominioColor; ?>"><?php echo $jTrabajoDominio ?></td>
                                </tr>
                                <tr>
                                    <td style="background-color:<?php echo $estadoFamiliaDominioColor; ?>">Inferencia en la relacion trabajo-familia</td>
                                    <td class="text-center" style="background-color:<?php echo $estadoFamiliaDominioColor; ?>"><?php echo $iTrabajofamiliaDominio ?></td>
                                </tr>
                                <tr>
                                    <td style="background-color:<?php echo $estadoLiderazgoDominioColor; ?>">Liderazgo</td>
                                    <td class="text-center" style="background-color:<?php echo $estadoLiderazgoDominioColor; ?>"><?php echo $liderazgoDominio ?></td>
                                </tr>
                                <tr>
                                    <td style="background-color:<?php echo $estadoRelacionesDominioColor; ?>">Relaciones de trabajo</td>
                                    <td class="text-center" style="background-color:<?php echo $estadoRelacionesDominioColor; ?>"><?php echo $rTrabajoDominio ?></td>
                                </tr>
                                <tr>
                                    <td style="background-color:<?php echo $estadoViolenciaDominioColor; ?>">Violencia</td>
                                    <td class="text-center" style="background-color:<?php echo $estadoViolenciaDominioColor; ?>"><?php echo $violeciaDominio ?></td>
                                </tr>
                            </tbody>
                        </table>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-md-10">

                            <p>Las respuestas a los ítems del cuestionario para la identificación de los factores de riesgo psicosocial deberán ser calificados, de acuerdo con la puntación de la Tabla siguiente:</p>

                            <div class="p" style="text-align: center; direction: ltr; margin-left: 0px; text-indent: 0px;">
                                <table class="de_tbl_902 detbl" style="width: 902px; height: 0; margin-left: auto; margin-right: auto;">
                                    <colgroup>
                                        <col style="width: 351px;" class="de_col_1_351">
                                        <col style="width: 117px;" class="de_col_2_117">
                                        <col style="width: 117px;" class="de_col_3_117">
                                        <col style="width: 124px;" class="de_col_4_124">
                                        <col style="width: 104px;" class="de_col_5_104">
                                        <col style="width: 89px;" class="de_col_6_89">
                                    </colgroup>
                                    <tbody>
                                        <tr style="height: 0px;">
                                            <td class="de_td_351" style="padding: 2px; padding-bottom: 1px; border-left-style: dashed; border-left-width: 1px; border-left-color: #7f7f7f; border-right-style: dashed; border-right-width: 1px; border-right-color: #7f7f7f; border-top-style: dashed; border-top-width: 1px; border-top-color: #7f7f7f; border-bottom-style: dashed; border-bottom-width: 1px; border-bottom-color: #7f7f7f;  width: 351px; vertical-align: middle; background-color: #b9afac;" colspan="1" rowspan="2">
                                                <div class="p" style="text-align: center; direction: ltr; margin-left: 0px; text-indent: 0px;"><span class="de_418A1E8E42"><strong>Ítems</strong></span></div>
                                            </td>
                                            <td class="de_td_551" style="padding: 2px; padding-bottom: 1px; border-left-style: dashed; border-left-width: 1px; border-left-color: #7f7f7f; border-right-style: dashed; border-right-width: 1px; border-right-color: #7f7f7f; border-top-style: dashed; border-top-width: 1px; border-top-color: #7f7f7f; border-bottom-style: dashed; border-bottom-width: 1px; border-bottom-color: #7f7f7f;  width: 551px; vertical-align: top; background-color: #b9afac;" colspan="5" rowspan="1">
                                                <div class="p" style="text-align: center; direction: ltr; margin-left: 0px; text-indent: 0px;"><span class="de_418A1E8E42"><strong>Calificación de las opciones de respuesta</strong></span></div>
                                            </td>
                                        </tr>
                                        <tr style="height: 0px;">
                                            <td class="de_td_117" style="padding: 2px; padding-bottom: 1px; border-left-style: dashed; border-left-width: 1px; border-left-color: #7f7f7f; border-right-style: dashed; border-right-width: 1px; border-right-color: #7f7f7f; border-top-style: dashed; border-top-width: 1px; border-top-color: #7f7f7f; border-bottom-style: dashed; border-bottom-width: 1px; border-bottom-color: #7f7f7f;  width: 117px; vertical-align: middle; background-color: #b9afac;" colspan="1" rowspan="1">
                                                <div class="p" style="text-align: center; direction: ltr; margin-left: 0px; text-indent: 0px;"><span class="de_418A1E8E42"><strong>Siempre</strong></span></div>
                                            </td>
                                            <td class="de_td_117" style="padding: 2px; padding-bottom: 1px; border-left-style: dashed; border-left-width: 1px; border-left-color: #7f7f7f; border-right-style: dashed; border-right-width: 1px; border-right-color: #7f7f7f; border-top-style: dashed; border-top-width: 1px; border-top-color: #7f7f7f; border-bottom-style: dashed; border-bottom-width: 1px; border-bottom-color: #7f7f7f;  width: 117px; vertical-align: middle; background-color: #b9afac;" colspan="1" rowspan="1">
                                                <div class="p" style="text-align: center; direction: ltr; margin-left: 0px; text-indent: 0px;"><span class="de_418A1E8E42"><strong>Casi siempre</strong></span></div>
                                            </td>
                                            <td class="de_td_124" style="padding: 2px; padding-bottom: 1px; border-left-style: dashed; border-left-width: 1px; border-left-color: #7f7f7f; border-right-style: dashed; border-right-width: 1px; border-right-color: #7f7f7f; border-top-style: dashed; border-top-width: 1px; border-top-color: #7f7f7f; border-bottom-style: dashed; border-bottom-width: 1px; border-bottom-color: #7f7f7f;  width: 124px; vertical-align: middle; background-color: #b9afac;" colspan="1" rowspan="1">
                                                <div class="p" style="text-align: center; direction: ltr; margin-left: 0px; text-indent: 0px;"><span class="de_418A1E8E42"><strong>Algunas veces</strong></span></div>
                                            </td>
                                            <td class="de_td_104" style="padding: 2px; padding-bottom: 1px; border-left-style: dashed; border-left-width: 1px; border-left-color: #7f7f7f; border-right-style: dashed; border-right-width: 1px; border-right-color: #7f7f7f; border-top-style: dashed; border-top-width: 1px; border-top-color: #7f7f7f; border-bottom-style: dashed; border-bottom-width: 1px; border-bottom-color: #7f7f7f;  width: 104px; vertical-align: middle; background-color: #b9afac;" colspan="1" rowspan="1">
                                                <div class="p" style="text-align: center; direction: ltr; margin-left: 0px; text-indent: 0px;"><span class="de_418A1E8E42"><strong>Casi nunca</strong></span></div>
                                            </td>
                                            <td class="de_td_89" style="padding: 2px; padding-bottom: 1px; border-left-style: dashed; border-left-width: 1px; border-left-color: #7f7f7f; border-right-style: dashed; border-right-width: 1px; border-right-color: #7f7f7f; border-top-style: dashed; border-top-width: 1px; border-top-color: #7f7f7f; border-bottom-style: dashed; border-bottom-width: 1px; border-bottom-color: #7f7f7f;  width: 89px; vertical-align: middle; background-color: #b9afac;" colspan="1" rowspan="1">
                                                <div class="p" style="text-align: center; direction: ltr; margin-left: 0px; text-indent: 0px;"><span class="de_418A1E8E42"><strong>Nunca</strong></span></div>
                                            </td>
                                        </tr>
                                        <tr style="height: 0px;">
                                            <td class="de_td_351" style="padding: 2px; padding-bottom: 1px; border-left-style: dashed; border-left-width: 1px; border-left-color: #7f7f7f; border-right-style: dashed; border-right-width: 1px; border-right-color: #7f7f7f; border-top-style: dashed; border-top-width: 1px; border-top-color: #7f7f7f; border-bottom-style: dashed; border-bottom-width: 1px; border-bottom-color: #7f7f7f;  width: 351px; vertical-align: top;" colspan="1" rowspan="1">
                                                <div class="p" style="text-align: left; direction: ltr; margin-left: 0px; text-indent: 0px;">18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33</div>
                                            </td>
                                            <td class="de_td_117" style="padding: 2px; padding-bottom: 1px; border-left-style: dashed; border-left-width: 1px; border-left-color: #7f7f7f; border-right-style: dashed; border-right-width: 1px; border-right-color: #7f7f7f; border-top-style: dashed; border-top-width: 1px; border-top-color: #7f7f7f; border-bottom-style: dashed; border-bottom-width: 1px; border-bottom-color: #7f7f7f;  width: 117px; vertical-align: middle;" colspan="1" rowspan="1">
                                                <div class="p" style="text-align: center; direction: ltr; margin-left: 0px; text-indent: 0px;">0</div>
                                            </td>
                                            <td class="de_td_117" style="padding: 2px; padding-bottom: 1px; border-left-style: dashed; border-left-width: 1px; border-left-color: #7f7f7f; border-right-style: dashed; border-right-width: 1px; border-right-color: #7f7f7f; border-top-style: dashed; border-top-width: 1px; border-top-color: #7f7f7f; border-bottom-style: dashed; border-bottom-width: 1px; border-bottom-color: #7f7f7f;  width: 117px; vertical-align: middle;" colspan="1" rowspan="1">
                                                <div class="p" style="text-align: center; direction: ltr; margin-left: 0px; text-indent: 0px;">1</div>
                                            </td>
                                            <td class="de_td_124" style="padding: 2px; padding-bottom: 1px; border-left-style: dashed; border-left-width: 1px; border-left-color: #7f7f7f; border-right-style: dashed; border-right-width: 1px; border-right-color: #7f7f7f; border-top-style: dashed; border-top-width: 1px; border-top-color: #7f7f7f; border-bottom-style: dashed; border-bottom-width: 1px; border-bottom-color: #7f7f7f;  width: 124px; vertical-align: middle;" colspan="1" rowspan="1">
                                                <div class="p" style="text-align: center; direction: ltr; margin-left: 0px; text-indent: 0px;">2</div>
                                            </td>
                                            <td class="de_td_104" style="padding: 2px; padding-bottom: 1px; border-left-style: dashed; border-left-width: 1px; border-left-color: #7f7f7f; border-right-style: dashed; border-right-width: 1px; border-right-color: #7f7f7f; border-top-style: dashed; border-top-width: 1px; border-top-color: #7f7f7f; border-bottom-style: dashed; border-bottom-width: 1px; border-bottom-color: #7f7f7f;  width: 104px; vertical-align: middle;" colspan="1" rowspan="1">
                                                <div class="p" style="text-align: center; direction: ltr; margin-left: 0px; text-indent: 0px;">3</div>
                                            </td>
                                            <td class="de_td_89" style="padding: 2px; padding-bottom: 1px; border-left-style: dashed; border-left-width: 1px; border-left-color: #7f7f7f; border-right-style: dashed; border-right-width: 1px; border-right-color: #7f7f7f; border-top-style: dashed; border-top-width: 1px; border-top-color: #7f7f7f; border-bottom-style: dashed; border-bottom-width: 1px; border-bottom-color: #7f7f7f;  width: 89px; vertical-align: middle;" colspan="1" rowspan="1">
                                                <div class="p" style="text-align: center; direction: ltr; margin-left: 0px; text-indent: 0px;">4</div>
                                            </td>
                                        </tr>
                                        <tr style="height: 0px;">
                                            <td class="de_td_351" style="padding: 2px; padding-bottom: 1px; border-left-style: dashed; border-left-width: 1px; border-left-color: #7f7f7f; border-right-style: dashed; border-right-width: 1px; border-right-color: #7f7f7f; border-top-style: dashed; border-top-width: 1px; border-top-color: #7f7f7f; border-bottom-style: dashed; border-bottom-width: 1px; border-bottom-color: #7f7f7f;  width: 351px; vertical-align: top;" colspan="1" rowspan="1">
                                                <div class="p" style="text-align: left; direction: ltr; margin-left: 0px; text-indent: 0px;">1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 34, 35, 36, 37, 38, 39, 40, 41, 42, 43, 44, 45, 46</div>
                                            </td>
                                            <td class="de_td_117" style="padding: 2px; padding-bottom: 1px; border-left-style: dashed; border-left-width: 1px; border-left-color: #7f7f7f; border-right-style: dashed; border-right-width: 1px; border-right-color: #7f7f7f; border-top-style: dashed; border-top-width: 1px; border-top-color: #7f7f7f; border-bottom-style: dashed; border-bottom-width: 1px; border-bottom-color: #7f7f7f;  width: 117px; vertical-align: middle;" colspan="1" rowspan="1">
                                                <div class="p" style="text-align: center; direction: ltr; margin-left: 0px; text-indent: 0px;">4</div>
                                            </td>
                                            <td class="de_td_117" style="padding: 2px; padding-bottom: 1px; border-left-style: dashed; border-left-width: 1px; border-left-color: #7f7f7f; border-right-style: dashed; border-right-width: 1px; border-right-color: #7f7f7f; border-top-style: dashed; border-top-width: 1px; border-top-color: #7f7f7f; border-bottom-style: dashed; border-bottom-width: 1px; border-bottom-color: #7f7f7f;  width: 117px; vertical-align: middle;" colspan="1" rowspan="1">
                                                <div class="p" style="text-align: center; direction: ltr; margin-left: 0px; text-indent: 0px;">3</div>
                                            </td>
                                            <td class="de_td_124" style="padding: 2px; padding-bottom: 1px; border-left-style: dashed; border-left-width: 1px; border-left-color: #7f7f7f; border-right-style: dashed; border-right-width: 1px; border-right-color: #7f7f7f; border-top-style: dashed; border-top-width: 1px; border-top-color: #7f7f7f; border-bottom-style: dashed; border-bottom-width: 1px; border-bottom-color: #7f7f7f;  width: 124px; vertical-align: middle;" colspan="1" rowspan="1">
                                                <div class="p" style="text-align: center; direction: ltr; margin-left: 0px; text-indent: 0px;">2</div>
                                            </td>
                                            <td class="de_td_104" style="padding: 2px; padding-bottom: 1px; border-left-style: dashed; border-left-width: 1px; border-left-color: #7f7f7f; border-right-style: dashed; border-right-width: 1px; border-right-color: #7f7f7f; border-top-style: dashed; border-top-width: 1px; border-top-color: #7f7f7f; border-bottom-style: dashed; border-bottom-width: 1px; border-bottom-color: #7f7f7f;  width: 104px; vertical-align: middle;" colspan="1" rowspan="1">
                                                <div class="p" style="text-align: center; direction: ltr; margin-left: 0px; text-indent: 0px;">1</div>
                                            </td>
                                            <td class="de_td_89" style="padding: 2px; padding-bottom: 1px; border-left-style: dashed; border-left-width: 1px; border-left-color: #7f7f7f; border-right-style: dashed; border-right-width: 1px; border-right-color: #7f7f7f; border-top-style: dashed; border-top-width: 1px; border-top-color: #7f7f7f; border-bottom-style: dashed; border-bottom-width: 1px; border-bottom-color: #7f7f7f;  width: 89px; vertical-align: middle;" colspan="1" rowspan="1">
                                                <div class="p" style="text-align: center; direction: ltr; margin-left: 0px; text-indent: 0px;">0</div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <br>

                            <div class="text-start mb-0">
                                <p class="mb-1">Para obtener la calificación se deberá considerar la Tabla 2 que agrupa los ítems por categoría, dominio y dimensión, y proceder de la manera siguiente:</p>
                                <p class="mb-1">1) Calificación del dominio (Cdom). Se obtiene sumando el puntaje de cada uno de los ítems que integran el dominio;</p>
                                <p class="mb-1">2) Calificación de la categoría (Ccat). Se obtiene sumando el puntaje de cada uno de los ítems que integran la categoría, y</p>
                                <p class="mb-1">3) Calificación final del cuestionario (Cfinal). Se obtiene sumando el puntaje de todos y cada uno de los ítems que integran el cuestionario;</p>
                            </div>

                            <br>

                            <div class="row">
                                <div class="p" style="text-align: center; direction: ltr; margin-left: 0px; text-indent: 0px;">
                                    <table class="de_tbl_902 detbl" style="width: 902px; height: 29; margin-left: auto; margin-right: auto;">
                                        <colgroup>
                                            <col style="width: 208px;" class="de_col_1_208">
                                            <col style="width: 245px;" class="de_col_2_245">
                                            <col style="width: 323px;" class="de_col_3_323">
                                            <col style="width: 126px;" class="de_col_4_126">
                                        </colgroup>
                                        <tbody>
                                            <tr style="height: 0px;">
                                                <td class="de_td_208" style="padding: 2px; padding-bottom: 1px; border-left-style: dashed; border-left-width: 1px; border-left-color: #ebcbc4; border-right-style: dashed; border-right-width: 1px; border-right-color: #ebcbc4; border-top-style: dashed; border-top-width: 1px; border-top-color: #ebcbc4; border-bottom-style: dashed; border-bottom-width: 1px; border-bottom-color: #ebcbc4;  width: 208px; vertical-align: top; background-color: #b9afac;" colspan="1" rowspan="1">
                                                    <div class="p" style="text-align: center; direction: ltr; margin-left: 0px; text-indent: 0px;"><span class="de_418A1E8E42"><strong>Categoría</strong></span></div>
                                                </td>
                                                <td class="de_td_245" style="padding: 2px; padding-bottom: 1px; border-left-style: dashed; border-left-width: 1px; border-left-color: #ebcbc4; border-right-style: dashed; border-right-width: 1px; border-right-color: #ebcbc4; border-top-style: dashed; border-top-width: 1px; border-top-color: #ebcbc4; border-bottom-style: dashed; border-bottom-width: 1px; border-bottom-color: #ebcbc4;  width: 245px; vertical-align: top; background-color: #b9afac;" colspan="1" rowspan="1">
                                                    <div class="p" style="text-align: center; direction: ltr; margin-left: 0px; text-indent: 0px;"><span class="de_418A1E8E42"><strong>Dominio</strong></span></div>
                                                </td>
                                                <td class="de_td_323" style="padding: 2px; padding-bottom: 1px; border-left-style: dashed; border-left-width: 1px; border-left-color: #ebcbc4; border-right-style: dashed; border-right-width: 1px; border-right-color: #ebcbc4; border-top-style: dashed; border-top-width: 1px; border-top-color: #ebcbc4; border-bottom-style: dashed; border-bottom-width: 1px; border-bottom-color: #ebcbc4;  width: 323px; vertical-align: top; background-color: #b9afac;" colspan="1" rowspan="1">
                                                    <div class="p" style="text-align: center; direction: ltr; margin-left: 0px; text-indent: 0px;"><span class="de_418A1E8E42"><strong>Dimensión</strong></span></div>
                                                </td>
                                                <td class="de_td_126" style="padding: 2px; padding-bottom: 1px; border-left-style: dashed; border-left-width: 1px; border-left-color: #ebcbc4; border-right-style: dashed; border-right-width: 1px; border-right-color: #ebcbc4; border-top-style: dashed; border-top-width: 1px; border-top-color: #ebcbc4; border-bottom-style: dashed; border-bottom-width: 1px; border-bottom-color: #ebcbc4;  width: 126px; vertical-align: top; background-color: #b9afac;" colspan="1" rowspan="1">
                                                    <div class="p" style="text-align: center; direction: ltr; margin-left: 0px; text-indent: 0px;"><span class="de_418A1E8E42"><strong>Ítem</strong></span></div>
                                                </td>
                                            </tr>
                                            <tr style="height: 0px;">
                                                <td class="de_td_208" style="padding: 2px; padding-bottom: 1px; border-left-style: dashed; border-left-width: 1px; border-left-color: #ebcbc4; border-right-style: dashed; border-right-width: 1px; border-right-color: #ebcbc4; border-top-style: dashed; border-top-width: 1px; border-top-color: #ebcbc4; border-bottom-style: dashed; border-bottom-width: 1px; border-bottom-color: #ebcbc4;  width: 208px; vertical-align: middle;" colspan="1" rowspan="3">
                                                    <div class="p" style="text-align: justify; direction: ltr; margin-left: 0px; text-indent: 0px;"><span class="de_6D2D8B1FD4">Ambiente de trabajo</span></div>
                                                </td>
                                                <td class="de_td_245" style="padding: 2px; padding-bottom: 1px; border-left-style: dashed; border-left-width: 1px; border-left-color: #ebcbc4; border-right-style: dashed; border-right-width: 1px; border-right-color: #ebcbc4; border-top-style: dashed; border-top-width: 1px; border-top-color: #ebcbc4; border-bottom-style: dashed; border-bottom-width: 1px; border-bottom-color: #ebcbc4;  width: 245px; vertical-align: middle;" colspan="1" rowspan="3">
                                                    <div class="p" style="text-align: justify; direction: ltr; margin-left: 0px; text-indent: 0px;"><span class="de_6D2D8B1FD4">Condiciones en el ambiente de</span></div>
                                                    <div class="p" style="text-align: justify; direction: ltr; margin-left: 0px; text-indent: 0px;"><span class="de_6D2D8B1FD4">trabajo</span></div>
                                                </td>
                                                <td class="de_td_323" style="padding: 2px; padding-bottom: 1px; border-left-style: dashed; border-left-width: 1px; border-left-color: #ebcbc4; border-right-style: dashed; border-right-width: 1px; border-right-color: #ebcbc4; border-top-style: dashed; border-top-width: 1px; border-top-color: #ebcbc4; border-bottom-style: dashed; border-bottom-width: 1px; border-bottom-color: #ebcbc4;  width: 323px; vertical-align: middle;" colspan="1" rowspan="1">
                                                    <div class="p" style="text-align: justify; direction: ltr; margin-left: 0px; text-indent: 0px;"><span class="de_6D2D8B1FD4">Condiciones peligrosas e inseguras</span></div>
                                                </td>
                                                <td class="de_td_126" style="padding: 2px; padding-bottom: 1px; border-left-style: dashed; border-left-width: 1px; border-left-color: #ebcbc4; border-right-style: dashed; border-right-width: 1px; border-right-color: #ebcbc4; border-top-style: dashed; border-top-width: 1px; border-top-color: #ebcbc4; border-bottom-style: dashed; border-bottom-width: 1px; border-bottom-color: #ebcbc4;  width: 126px; vertical-align: middle;" colspan="1" rowspan="1">
                                                    <div class="p" style="text-align: center; direction: ltr; margin-left: 0px; text-indent: 0px;"><span class="de_6D2D8B1FD4">2</span></div>
                                                </td>
                                            </tr>
                                            <tr style="height: 0px;">
                                                <td class="de_td_323" style="padding: 2px; padding-bottom: 1px; border-left-style: dashed; border-left-width: 1px; border-left-color: #ebcbc4; border-right-style: dashed; border-right-width: 1px; border-right-color: #ebcbc4; border-top-style: dashed; border-top-width: 1px; border-top-color: #ebcbc4; border-bottom-style: dashed; border-bottom-width: 1px; border-bottom-color: #ebcbc4;  width: 323px; vertical-align: middle;" colspan="1" rowspan="1">
                                                    <div class="p" style="text-align: justify; direction: ltr; margin-left: 0px; text-indent: 0px;"><span class="de_6D2D8B1FD4">Condiciones deficientes e insalubres</span></div>
                                                </td>
                                                <td class="de_td_126" style="padding: 2px; padding-bottom: 1px; border-left-style: dashed; border-left-width: 1px; border-left-color: #ebcbc4; border-right-style: dashed; border-right-width: 1px; border-right-color: #ebcbc4; border-top-style: dashed; border-top-width: 1px; border-top-color: #ebcbc4; border-bottom-style: dashed; border-bottom-width: 1px; border-bottom-color: #ebcbc4;  width: 126px; vertical-align: middle;" colspan="1" rowspan="1">
                                                    <div class="p" style="text-align: center; direction: ltr; margin-left: 0px; text-indent: 0px;"><span class="de_6D2D8B1FD4">1</span></div>
                                                </td>
                                            </tr>
                                            <tr style="height: 29px;">
                                                <td class="de_td_323" style="padding: 2px; padding-bottom: 1px; border-left-style: dashed; border-left-width: 1px; border-left-color: #ebcbc4; border-right-style: dashed; border-right-width: 1px; border-right-color: #ebcbc4; border-top-style: dashed; border-top-width: 1px; border-top-color: #ebcbc4; border-bottom-style: dashed; border-bottom-width: 1px; border-bottom-color: #ebcbc4;  width: 323px; vertical-align: middle;" colspan="1" rowspan="1">
                                                    <div class="p" style="text-align: justify; direction: ltr; margin-left: 0px; text-indent: 0px;"><span class="de_6D2D8B1FD4">Trabajos peligrosos</span></div>
                                                </td>
                                                <td class="de_td_126" style="padding: 2px; padding-bottom: 1px; border-left-style: dashed; border-left-width: 1px; border-left-color: #ebcbc4; border-right-style: dashed; border-right-width: 1px; border-right-color: #ebcbc4; border-top-style: dashed; border-top-width: 1px; border-top-color: #ebcbc4; border-bottom-style: dashed; border-bottom-width: 1px; border-bottom-color: #ebcbc4;  width: 126px; vertical-align: middle;" colspan="1" rowspan="1">
                                                    <div class="p" style="text-align: center; direction: ltr; margin-left: 0px; text-indent: 0px;"><span class="de_6D2D8B1FD4">3</span></div>
                                                </td>
                                            </tr>
                                            <tr style="height: 0px;">
                                                <td class="de_td_208" style="padding: 2px; padding-bottom: 1px; border-left-style: dashed; border-left-width: 1px; border-left-color: #ebcbc4; border-right-style: dashed; border-right-width: 1px; border-right-color: #ebcbc4; border-top-style: dashed; border-top-width: 1px; border-top-color: #ebcbc4; border-bottom-style: dashed; border-bottom-width: 1px; border-bottom-color: #ebcbc4;  width: 208px; vertical-align: middle;" colspan="1" rowspan="9">
                                                    <div class="p" style="text-align: justify; direction: ltr; margin-left: 0px; text-indent: 0px;"><span class="de_6D2D8B1FD4">Factores propios de la actividad</span></div>
                                                </td>
                                                <td class="de_td_245" style="padding: 2px; padding-bottom: 1px; border-left-style: dashed; border-left-width: 1px; border-left-color: #ebcbc4; border-right-style: dashed; border-right-width: 1px; border-right-color: #ebcbc4; border-top-style: dashed; border-top-width: 1px; border-top-color: #ebcbc4; border-bottom-style: dashed; border-bottom-width: 1px; border-bottom-color: #ebcbc4;  width: 245px; vertical-align: middle;" colspan="1" rowspan="6">
                                                    <div class="p" style="text-align: justify; direction: ltr; margin-left: 0px; text-indent: 0px;"><span class="de_6D2D8B1FD4">Carga de Trabajo</span></div>
                                                </td>
                                                <td class="de_td_323" style="padding: 2px; padding-bottom: 1px; border-left-style: dashed; border-left-width: 1px; border-left-color: #ebcbc4; border-right-style: dashed; border-right-width: 1px; border-right-color: #ebcbc4; border-top-style: dashed; border-top-width: 1px; border-top-color: #ebcbc4; border-bottom-style: dashed; border-bottom-width: 1px; border-bottom-color: #ebcbc4;  width: 323px; vertical-align: middle;" colspan="1" rowspan="1">
                                                    <div class="p" style="text-align: justify; direction: ltr; margin-left: 0px; text-indent: 0px;"><span class="de_6D2D8B1FD4">Cargas cuantitativas</span></div>
                                                </td>
                                                <td class="de_td_126" style="padding: 2px; padding-bottom: 1px; border-left-style: dashed; border-left-width: 1px; border-left-color: #ebcbc4; border-right-style: dashed; border-right-width: 1px; border-right-color: #ebcbc4; border-top-style: dashed; border-top-width: 1px; border-top-color: #ebcbc4; border-bottom-style: dashed; border-bottom-width: 1px; border-bottom-color: #ebcbc4;  width: 126px; vertical-align: middle;" colspan="1" rowspan="1">
                                                    <div class="p" style="text-align: center; direction: ltr; margin-left: 0px; text-indent: 0px;"><span class="de_6D2D8B1FD4">4, 9</span></div>
                                                </td>
                                            </tr>
                                            <tr style="height: 0px;">
                                                <td class="de_td_323" style="padding: 2px; padding-bottom: 1px; border-left-style: dashed; border-left-width: 1px; border-left-color: #ebcbc4; border-right-style: dashed; border-right-width: 1px; border-right-color: #ebcbc4; border-top-style: dashed; border-top-width: 1px; border-top-color: #ebcbc4; border-bottom-style: dashed; border-bottom-width: 1px; border-bottom-color: #ebcbc4;  width: 323px; vertical-align: middle;" colspan="1" rowspan="1">
                                                    <div class="p" style="text-align: justify; direction: ltr; margin-left: 0px; text-indent: 0px;"><span class="de_6D2D8B1FD4">Ritmos de trabajo acelerado</span></div>
                                                </td>
                                                <td class="de_td_126" style="padding: 2px; padding-bottom: 1px; border-left-style: dashed; border-left-width: 1px; border-left-color: #ebcbc4; border-right-style: dashed; border-right-width: 1px; border-right-color: #ebcbc4; border-top-style: dashed; border-top-width: 1px; border-top-color: #ebcbc4; border-bottom-style: dashed; border-bottom-width: 1px; border-bottom-color: #ebcbc4;  width: 126px; vertical-align: middle;" colspan="1" rowspan="1">
                                                    <div class="p" style="text-align: center; direction: ltr; margin-left: 0px; text-indent: 0px;"><span class="de_6D2D8B1FD4">5, 6</span></div>
                                                </td>
                                            </tr>
                                            <tr style="height: 0px;">
                                                <td class="de_td_323" style="padding: 2px; padding-bottom: 1px; border-left-style: dashed; border-left-width: 1px; border-left-color: #ebcbc4; border-right-style: dashed; border-right-width: 1px; border-right-color: #ebcbc4; border-top-style: dashed; border-top-width: 1px; border-top-color: #ebcbc4; border-bottom-style: dashed; border-bottom-width: 1px; border-bottom-color: #ebcbc4;  width: 323px; vertical-align: middle;" colspan="1" rowspan="1">
                                                    <div class="p" style="text-align: justify; direction: ltr; margin-left: 0px; text-indent: 0px;"><span class="de_6D2D8B1FD4">Carga mental</span></div>
                                                </td>
                                                <td class="de_td_126" style="padding: 2px; padding-bottom: 1px; border-left-style: dashed; border-left-width: 1px; border-left-color: #ebcbc4; border-right-style: dashed; border-right-width: 1px; border-right-color: #ebcbc4; border-top-style: dashed; border-top-width: 1px; border-top-color: #ebcbc4; border-bottom-style: dashed; border-bottom-width: 1px; border-bottom-color: #ebcbc4;  width: 126px; vertical-align: middle;" colspan="1" rowspan="1">
                                                    <div class="p" style="text-align: center; direction: ltr; margin-left: 0px; text-indent: 0px;"><span class="de_6D2D8B1FD4">7, 8</span></div>
                                                </td>
                                            </tr>
                                            <tr style="height: 0px;">
                                                <td class="de_td_323" style="padding: 2px; padding-bottom: 1px; border-left-style: dashed; border-left-width: 1px; border-left-color: #ebcbc4; border-right-style: dashed; border-right-width: 1px; border-right-color: #ebcbc4; border-top-style: dashed; border-top-width: 1px; border-top-color: #ebcbc4; border-bottom-style: dashed; border-bottom-width: 1px; border-bottom-color: #ebcbc4;  width: 323px; vertical-align: middle;" colspan="1" rowspan="1">
                                                    <div class="p" style="text-align: justify; direction: ltr; margin-left: 0px; text-indent: 0px;"><span class="de_6D2D8B1FD4">Cargas psicológicas emocionales</span></div>
                                                </td>
                                                <td class="de_td_126" style="padding: 2px; padding-bottom: 1px; border-left-style: dashed; border-left-width: 1px; border-left-color: #ebcbc4; border-right-style: dashed; border-right-width: 1px; border-right-color: #ebcbc4; border-top-style: dashed; border-top-width: 1px; border-top-color: #ebcbc4; border-bottom-style: dashed; border-bottom-width: 1px; border-bottom-color: #ebcbc4;  width: 126px; vertical-align: middle;" colspan="1" rowspan="1">
                                                    <div class="p" style="text-align: center; direction: ltr; margin-left: 0px; text-indent: 0px;"><span class="de_6D2D8B1FD4">41, 42, 43</span></div>
                                                </td>
                                            </tr>
                                            <tr style="height: 0px;">
                                                <td class="de_td_323" style="padding: 2px; padding-bottom: 1px; border-left-style: dashed; border-left-width: 1px; border-left-color: #ebcbc4; border-right-style: dashed; border-right-width: 1px; border-right-color: #ebcbc4; border-top-style: dashed; border-top-width: 1px; border-top-color: #ebcbc4; border-bottom-style: dashed; border-bottom-width: 1px; border-bottom-color: #ebcbc4;  width: 323px; vertical-align: middle;" colspan="1" rowspan="1">
                                                    <div class="p" style="text-align: justify; direction: ltr; margin-left: 0px; text-indent: 0px;"><span class="de_6D2D8B1FD4">Cargas de alta responsabilidad</span></div>
                                                </td>
                                                <td class="de_td_126" style="padding: 2px; padding-bottom: 1px; border-left-style: dashed; border-left-width: 1px; border-left-color: #ebcbc4; border-right-style: dashed; border-right-width: 1px; border-right-color: #ebcbc4; border-top-style: dashed; border-top-width: 1px; border-top-color: #ebcbc4; border-bottom-style: dashed; border-bottom-width: 1px; border-bottom-color: #ebcbc4;  width: 126px; vertical-align: middle;" colspan="1" rowspan="1">
                                                    <div class="p" style="text-align: center; direction: ltr; margin-left: 0px; text-indent: 0px;"><span class="de_6D2D8B1FD4">10, 11</span></div>
                                                </td>
                                            </tr>
                                            <tr style="height: 0px;">
                                                <td class="de_td_323" style="padding: 2px; padding-bottom: 1px; border-left-style: dashed; border-left-width: 1px; border-left-color: #ebcbc4; border-right-style: dashed; border-right-width: 1px; border-right-color: #ebcbc4; border-top-style: dashed; border-top-width: 1px; border-top-color: #ebcbc4; border-bottom-style: dashed; border-bottom-width: 1px; border-bottom-color: #ebcbc4;  width: 323px; vertical-align: middle;" colspan="1" rowspan="1">
                                                    <div class="p" style="text-align: justify; direction: ltr; margin-left: 0px; text-indent: 0px;"><span class="de_6D2D8B1FD4">Cargas contradictorias o inconsistentes</span></div>
                                                </td>
                                                <td class="de_td_126" style="padding: 2px; padding-bottom: 1px; border-left-style: dashed; border-left-width: 1px; border-left-color: #ebcbc4; border-right-style: dashed; border-right-width: 1px; border-right-color: #ebcbc4; border-top-style: dashed; border-top-width: 1px; border-top-color: #ebcbc4; border-bottom-style: dashed; border-bottom-width: 1px; border-bottom-color: #ebcbc4;  width: 126px; vertical-align: middle;" colspan="1" rowspan="1">
                                                    <div class="p" style="text-align: center; direction: ltr; margin-left: 0px; text-indent: 0px;"><span class="de_6D2D8B1FD4">12, 13</span></div>
                                                </td>
                                            </tr>
                                            <tr style="height: 0px;">
                                                <td class="de_td_245" style="padding: 2px; padding-bottom: 1px; border-left-style: dashed; border-left-width: 1px; border-left-color: #ebcbc4; border-right-style: dashed; border-right-width: 1px; border-right-color: #ebcbc4; border-top-style: dashed; border-top-width: 1px; border-top-color: #ebcbc4; border-bottom-style: dashed; border-bottom-width: 1px; border-bottom-color: #ebcbc4;  width: 245px; vertical-align: middle;" colspan="1" rowspan="3">
                                                    <div class="p" style="text-align: left; direction: ltr; margin-left: 0px; text-indent: 0px;"><span class="de_6D2D8B1FD4">Falta de control sobre el trabajo</span></div>
                                                </td>
                                                <td class="de_td_323" style="padding: 2px; padding-bottom: 1px; border-left-style: dashed; border-left-width: 1px; border-left-color: #ebcbc4; border-right-style: dashed; border-right-width: 1px; border-right-color: #ebcbc4; border-top-style: dashed; border-top-width: 1px; border-top-color: #ebcbc4; border-bottom-style: dashed; border-bottom-width: 1px; border-bottom-color: #ebcbc4;  width: 323px; vertical-align: middle;" colspan="1" rowspan="1">
                                                    <div class="p" style="text-align: left; direction: ltr; margin-left: 0px; text-indent: 0px;"><span class="de_6D2D8B1FD4">Falta de control y autonomía sobre el trabajo</span></div>
                                                </td>
                                                <td class="de_td_126" style="padding: 2px; padding-bottom: 1px; border-left-style: dashed; border-left-width: 1px; border-left-color: #ebcbc4; border-right-style: dashed; border-right-width: 1px; border-right-color: #ebcbc4; border-top-style: dashed; border-top-width: 1px; border-top-color: #ebcbc4; border-bottom-style: dashed; border-bottom-width: 1px; border-bottom-color: #ebcbc4;  width: 126px; vertical-align: middle;" colspan="1" rowspan="1">
                                                    <div class="p" style="text-align: center; direction: ltr; margin-left: 0px; text-indent: 0px;"><span class="de_6D2D8B1FD4">20, 21, 22</span></div>
                                                </td>
                                            </tr>
                                            <tr style="height: 0px;">
                                                <td class="de_td_323" style="padding: 2px; padding-bottom: 1px; border-left-style: dashed; border-left-width: 1px; border-left-color: #ebcbc4; border-right-style: dashed; border-right-width: 1px; border-right-color: #ebcbc4; border-top-style: dashed; border-top-width: 1px; border-top-color: #ebcbc4; border-bottom-style: dashed; border-bottom-width: 1px; border-bottom-color: #ebcbc4;  width: 323px; vertical-align: middle;" colspan="1" rowspan="1">
                                                    <div class="p" style="text-align: left; direction: ltr; margin-left: 0px; text-indent: 0px;"><span class="de_6D2D8B1FD4">Limitada o nula posibilidad de desarrollo</span></div>
                                                </td>
                                                <td class="de_td_126" style="padding: 2px; padding-bottom: 1px; border-left-style: dashed; border-left-width: 1px; border-left-color: #ebcbc4; border-right-style: dashed; border-right-width: 1px; border-right-color: #ebcbc4; border-top-style: dashed; border-top-width: 1px; border-top-color: #ebcbc4; border-bottom-style: dashed; border-bottom-width: 1px; border-bottom-color: #ebcbc4;  width: 126px; vertical-align: middle;" colspan="1" rowspan="1">
                                                    <div class="p" style="text-align: center; direction: ltr; margin-left: 0px; text-indent: 0px;"><span class="de_6D2D8B1FD4">18, 19</span></div>
                                                </td>
                                            </tr>
                                            <tr style="height: 0px;">
                                                <td class="de_td_323" style="padding: 2px; padding-bottom: 1px; border-left-style: dashed; border-left-width: 1px; border-left-color: #ebcbc4; border-right-style: dashed; border-right-width: 1px; border-right-color: #ebcbc4; border-top-style: dashed; border-top-width: 1px; border-top-color: #ebcbc4; border-bottom-style: dashed; border-bottom-width: 1px; border-bottom-color: #ebcbc4;  width: 323px; vertical-align: middle;" colspan="1" rowspan="1">
                                                    <div class="p" style="text-align: left; direction: ltr; margin-left: 0px; text-indent: 0px;"><span class="de_6D2D8B1FD4">Limitada o inexistente capacitación</span></div>
                                                </td>
                                                <td class="de_td_126" style="padding: 2px; padding-bottom: 1px; border-left-style: dashed; border-left-width: 1px; border-left-color: #ebcbc4; border-right-style: dashed; border-right-width: 1px; border-right-color: #ebcbc4; border-top-style: dashed; border-top-width: 1px; border-top-color: #ebcbc4; border-bottom-style: dashed; border-bottom-width: 1px; border-bottom-color: #ebcbc4;  width: 126px; vertical-align: middle;" colspan="1" rowspan="1">
                                                    <div class="p" style="text-align: center; direction: ltr; margin-left: 0px; text-indent: 0px;"><span class="de_6D2D8B1FD4">26,27</span></div>
                                                </td>
                                            </tr>
                                            <tr style="height: 0px;">
                                                <td class="de_td_208" style="padding: 2px; padding-bottom: 1px; border-left-style: dashed; border-left-width: 1px; border-left-color: #ebcbc4; border-right-style: dashed; border-right-width: 1px; border-right-color: #ebcbc4; border-top-style: dashed; border-top-width: 1px; border-top-color: #ebcbc4; border-bottom-style: dashed; border-bottom-width: 1px; border-bottom-color: #ebcbc4;  width: 208px; vertical-align: middle;" colspan="1" rowspan="3">
                                                    <div class="p" style="text-align: left; direction: ltr; margin-left: 0px; text-indent: 0px;"><span class="de_6D2D8B1FD4">Organización del tiempo de trabajo</span></div>
                                                </td>
                                                <td class="de_td_245" style="padding: 2px; padding-bottom: 1px; border-left-style: dashed; border-left-width: 1px; border-left-color: #ebcbc4; border-right-style: dashed; border-right-width: 1px; border-right-color: #ebcbc4; border-top-style: dashed; border-top-width: 1px; border-top-color: #ebcbc4; border-bottom-style: dashed; border-bottom-width: 1px; border-bottom-color: #ebcbc4;  width: 245px; vertical-align: middle;" colspan="1" rowspan="1">
                                                    <div class="p" style="text-align: left; direction: ltr; margin-left: 0px; text-indent: 0px;"><span class="de_6D2D8B1FD4">Jornada de trabajo</span></div>
                                                </td>
                                                <td class="de_td_323" style="padding: 2px; padding-bottom: 1px; border-left-style: dashed; border-left-width: 1px; border-left-color: #ebcbc4; border-right-style: dashed; border-right-width: 1px; border-right-color: #ebcbc4; border-top-style: dashed; border-top-width: 1px; border-top-color: #ebcbc4; border-bottom-style: dashed; border-bottom-width: 1px; border-bottom-color: #ebcbc4;  width: 323px; vertical-align: middle;" colspan="1" rowspan="1">
                                                    <div class="p" style="text-align: left; direction: ltr; margin-left: 0px; text-indent: 0px;"><span class="de_6D2D8B1FD4">Jornadas de trabajo extensas</span></div>
                                                </td>
                                                <td class="de_td_126" style="padding: 2px; padding-bottom: 1px; border-left-style: dashed; border-left-width: 1px; border-left-color: #ebcbc4; border-right-style: dashed; border-right-width: 1px; border-right-color: #ebcbc4; border-top-style: dashed; border-top-width: 1px; border-top-color: #ebcbc4; border-bottom-style: dashed; border-bottom-width: 1px; border-bottom-color: #ebcbc4;  width: 126px; vertical-align: middle;" colspan="1" rowspan="1">
                                                    <div class="p" style="text-align: center; direction: ltr; margin-left: 0px; text-indent: 0px;"><span class="de_6D2D8B1FD4">14, 15</span></div>
                                                </td>
                                            </tr>
                                            <tr style="height: 0px;">
                                                <td class="de_td_245" style="padding: 2px; padding-bottom: 1px; border-left-style: dashed; border-left-width: 1px; border-left-color: #ebcbc4; border-right-style: dashed; border-right-width: 1px; border-right-color: #ebcbc4; border-top-style: dashed; border-top-width: 1px; border-top-color: #ebcbc4; border-bottom-style: dashed; border-bottom-width: 1px; border-bottom-color: #ebcbc4;  width: 245px; vertical-align: middle;" colspan="1" rowspan="2">
                                                    <div class="p" style="text-align: left; direction: ltr; margin-left: 0px; text-indent: 0px;"><span class="de_6D2D8B1FD4">Interferencia en la</span></div>
                                                    <div class="p" style="text-align: left; direction: ltr; margin-left: 0px; text-indent: 0px;"><span class="de_6D2D8B1FD4">relación trabajofamilia</span></div>
                                                </td>
                                                <td class="de_td_323" style="padding: 2px; padding-bottom: 1px; border-left-style: dashed; border-left-width: 1px; border-left-color: #ebcbc4; border-right-style: dashed; border-right-width: 1px; border-right-color: #ebcbc4; border-top-style: dashed; border-top-width: 1px; border-top-color: #ebcbc4; border-bottom-style: dashed; border-bottom-width: 1px; border-bottom-color: #ebcbc4;  width: 323px; vertical-align: middle;" colspan="1" rowspan="1">
                                                    <div class="p" style="text-align: left; direction: ltr; margin-left: 0px; text-indent: 0px;"><span class="de_6D2D8B1FD4">Influencia del trabajo fuera del centro laboral</span></div>
                                                </td>
                                                <td class="de_td_126" style="padding: 2px; padding-bottom: 1px; border-left-style: dashed; border-left-width: 1px; border-left-color: #ebcbc4; border-right-style: dashed; border-right-width: 1px; border-right-color: #ebcbc4; border-top-style: dashed; border-top-width: 1px; border-top-color: #ebcbc4; border-bottom-style: dashed; border-bottom-width: 1px; border-bottom-color: #ebcbc4;  width: 126px; vertical-align: middle;" colspan="1" rowspan="1">
                                                    <div class="p" style="text-align: center; direction: ltr; margin-left: 0px; text-indent: 0px;"><span class="de_6D2D8B1FD4">16</span></div>
                                                </td>
                                            </tr>
                                            <tr style="height: 0px;">
                                                <td class="de_td_323" style="padding: 2px; padding-bottom: 1px; border-left-style: dashed; border-left-width: 1px; border-left-color: #ebcbc4; border-right-style: dashed; border-right-width: 1px; border-right-color: #ebcbc4; border-top-style: dashed; border-top-width: 1px; border-top-color: #ebcbc4; border-bottom-style: dashed; border-bottom-width: 1px; border-bottom-color: #ebcbc4;  width: 323px; vertical-align: middle;" colspan="1" rowspan="1">
                                                    <div class="p" style="text-align: left; direction: ltr; margin-left: 0px; text-indent: 0px;"><span class="de_6D2D8B1FD4">Influencia de las responsabilidades familiares</span></div>
                                                </td>
                                                <td class="de_td_126" style="padding: 2px; padding-bottom: 1px; border-left-style: dashed; border-left-width: 1px; border-left-color: #ebcbc4; border-right-style: dashed; border-right-width: 1px; border-right-color: #ebcbc4; border-top-style: dashed; border-top-width: 1px; border-top-color: #ebcbc4; border-bottom-style: dashed; border-bottom-width: 1px; border-bottom-color: #ebcbc4;  width: 126px; vertical-align: middle;" colspan="1" rowspan="1">
                                                    <div class="p" style="text-align: center; direction: ltr; margin-left: 0px; text-indent: 0px;"><span class="de_6D2D8B1FD4">17</span></div>
                                                </td>
                                            </tr>
                                            <tr style="height: 0px;">
                                                <td class="de_td_208" style="padding: 2px; padding-bottom: 1px; border-left-style: dashed; border-left-width: 1px; border-left-color: #ebcbc4; border-right-style: dashed; border-right-width: 1px; border-right-color: #ebcbc4; border-top-style: dashed; border-top-width: 1px; border-top-color: #ebcbc4; border-bottom-style: dashed; border-bottom-width: 1px; border-bottom-color: #ebcbc4;  width: 208px; vertical-align: middle;" colspan="1" rowspan="5">
                                                    <div class="p" style="text-align: left; direction: ltr; margin-left: 0px; text-indent: 0px;"><span class="de_6D2D8B1FD4">Liderazgo y relaciones en el trabajo</span></div>
                                                </td>
                                                <td class="de_td_245" style="padding: 2px; padding-bottom: 1px; border-left-style: dashed; border-left-width: 1px; border-left-color: #ebcbc4; border-right-style: dashed; border-right-width: 1px; border-right-color: #ebcbc4; border-top-style: dashed; border-top-width: 1px; border-top-color: #ebcbc4; border-bottom-style: dashed; border-bottom-width: 1px; border-bottom-color: #ebcbc4;  width: 245px; vertical-align: middle;" colspan="1" rowspan="2">
                                                    <div class="p" style="text-align: left; direction: ltr; margin-left: 0px; text-indent: 0px;"><span class="de_6D2D8B1FD4">Liderazgo</span></div>
                                                </td>
                                                <td class="de_td_323" style="padding: 2px; padding-bottom: 1px; border-left-style: dashed; border-left-width: 1px; border-left-color: #ebcbc4; border-right-style: dashed; border-right-width: 1px; border-right-color: #ebcbc4; border-top-style: dashed; border-top-width: 1px; border-top-color: #ebcbc4; border-bottom-style: dashed; border-bottom-width: 1px; border-bottom-color: #ebcbc4;  width: 323px; vertical-align: middle;" colspan="1" rowspan="1">
                                                    <div class="p" style="text-align: left; direction: ltr; margin-left: 0px; text-indent: 0px;"><span class="de_6D2D8B1FD4">Escasa claridad de funciones</span></div>
                                                </td>
                                                <td class="de_td_126" style="padding: 2px; padding-bottom: 1px; border-left-style: dashed; border-left-width: 1px; border-left-color: #ebcbc4; border-right-style: dashed; border-right-width: 1px; border-right-color: #ebcbc4; border-top-style: dashed; border-top-width: 1px; border-top-color: #ebcbc4; border-bottom-style: dashed; border-bottom-width: 1px; border-bottom-color: #ebcbc4;  width: 126px; vertical-align: middle;" colspan="1" rowspan="1">
                                                    <div class="p" style="text-align: center; direction: ltr; margin-left: 0px; text-indent: 0px;"><span class="de_6D2D8B1FD4">23, 24, 25</span></div>
                                                </td>
                                            </tr>
                                            <tr style="height: 0px;">
                                                <td class="de_td_323" style="padding: 2px; padding-bottom: 1px; border-left-style: dashed; border-left-width: 1px; border-left-color: #ebcbc4; border-right-style: dashed; border-right-width: 1px; border-right-color: #ebcbc4; border-top-style: dashed; border-top-width: 1px; border-top-color: #ebcbc4; border-bottom-style: dashed; border-bottom-width: 1px; border-bottom-color: #ebcbc4;  width: 323px; vertical-align: middle;" colspan="1" rowspan="1">
                                                    <div class="p" style="text-align: left; direction: ltr; margin-left: 0px; text-indent: 0px;"><span class="de_6D2D8B1FD4">Características del liderazgo</span></div>
                                                </td>
                                                <td class="de_td_126" style="padding: 2px; padding-bottom: 1px; border-left-style: dashed; border-left-width: 1px; border-left-color: #ebcbc4; border-right-style: dashed; border-right-width: 1px; border-right-color: #ebcbc4; border-top-style: dashed; border-top-width: 1px; border-top-color: #ebcbc4; border-bottom-style: dashed; border-bottom-width: 1px; border-bottom-color: #ebcbc4;  width: 126px; vertical-align: middle;" colspan="1" rowspan="1">
                                                    <div class="p" style="text-align: center; direction: ltr; margin-left: 0px; text-indent: 0px;"><span class="de_6D2D8B1FD4">28, 29</span></div>
                                                </td>
                                            </tr>
                                            <tr style="height: 0px;">
                                                <td class="de_td_245" style="padding: 2px; padding-bottom: 1px; border-left-style: dashed; border-left-width: 1px; border-left-color: #ebcbc4; border-right-style: dashed; border-right-width: 1px; border-right-color: #ebcbc4; border-top-style: dashed; border-top-width: 1px; border-top-color: #ebcbc4; border-bottom-style: dashed; border-bottom-width: 1px; border-bottom-color: #ebcbc4;  width: 245px; vertical-align: middle;" colspan="1" rowspan="2">
                                                    <div class="p" style="text-align: left; direction: ltr; margin-left: 0px; text-indent: 0px;"><span class="de_6D2D8B1FD4">Relaciones en el trabajo</span></div>
                                                </td>
                                                <td class="de_td_323" style="padding: 2px; padding-bottom: 1px; border-left-style: dashed; border-left-width: 1px; border-left-color: #ebcbc4; border-right-style: dashed; border-right-width: 1px; border-right-color: #ebcbc4; border-top-style: dashed; border-top-width: 1px; border-top-color: #ebcbc4; border-bottom-style: dashed; border-bottom-width: 1px; border-bottom-color: #ebcbc4;  width: 323px; vertical-align: middle;" colspan="1" rowspan="1">
                                                    <div class="p" style="text-align: left; direction: ltr; margin-left: 0px; text-indent: 0px;"><span class="de_6D2D8B1FD4">Relaciones sociales en el trabajo</span></div>
                                                </td>
                                                <td class="de_td_126" style="padding: 2px; padding-bottom: 1px; border-left-style: dashed; border-left-width: 1px; border-left-color: #ebcbc4; border-right-style: dashed; border-right-width: 1px; border-right-color: #ebcbc4; border-top-style: dashed; border-top-width: 1px; border-top-color: #ebcbc4; border-bottom-style: dashed; border-bottom-width: 1px; border-bottom-color: #ebcbc4;  width: 126px; vertical-align: middle;" colspan="1" rowspan="1">
                                                    <div class="p" style="text-align: center; direction: ltr; margin-left: 0px; text-indent: 0px;"><span class="de_6D2D8B1FD4">30, 31, 32</span></div>
                                                </td>
                                            </tr>
                                            <tr style="height: 0px;">
                                                <td class="de_td_323" style="padding: 2px; padding-bottom: 1px; border-left-style: dashed; border-left-width: 1px; border-left-color: #ebcbc4; border-right-style: dashed; border-right-width: 1px; border-right-color: #ebcbc4; border-top-style: dashed; border-top-width: 1px; border-top-color: #ebcbc4; border-bottom-style: dashed; border-bottom-width: 1px; border-bottom-color: #ebcbc4;  width: 323px; vertical-align: middle;" colspan="1" rowspan="1">
                                                    <div class="p" style="text-align: left; direction: ltr; margin-left: 0px; text-indent: 0px;"><span class="de_6D2D8B1FD4">Deficiente relación con los colaboradores que supervisa</span></div>
                                                </td>
                                                <td class="de_td_126" style="padding: 2px; padding-bottom: 1px; border-left-style: dashed; border-left-width: 1px; border-left-color: #ebcbc4; border-right-style: dashed; border-right-width: 1px; border-right-color: #ebcbc4; border-top-style: dashed; border-top-width: 1px; border-top-color: #ebcbc4; border-bottom-style: dashed; border-bottom-width: 1px; border-bottom-color: #ebcbc4;  width: 126px; vertical-align: middle;" colspan="1" rowspan="1">
                                                    <div class="p" style="text-align: center; direction: ltr; margin-left: 0px; text-indent: 0px;"><span class="de_6D2D8B1FD4">44, 45, 46</span></div>
                                                </td>
                                            </tr>
                                            <tr style="height: 0px;">
                                                <td class="de_td_245" style="padding: 2px; padding-bottom: 1px; border-left-style: dashed; border-left-width: 1px; border-left-color: #ebcbc4; border-right-style: dashed; border-right-width: 1px; border-right-color: #ebcbc4; border-top-style: dashed; border-top-width: 1px; border-top-color: #ebcbc4; border-bottom-style: dashed; border-bottom-width: 1px; border-bottom-color: #ebcbc4;  width: 245px; vertical-align: middle;" colspan="1" rowspan="1">
                                                    <div class="p" style="text-align: left; direction: ltr; margin-left: 0px; text-indent: 0px;"><span class="de_6D2D8B1FD4">Violencia</span></div>
                                                </td>
                                                <td class="de_td_323" style="padding: 2px; padding-bottom: 1px; border-left-style: dashed; border-left-width: 1px; border-left-color: #ebcbc4; border-right-style: dashed; border-right-width: 1px; border-right-color: #ebcbc4; border-top-style: dashed; border-top-width: 1px; border-top-color: #ebcbc4; border-bottom-style: dashed; border-bottom-width: 1px; border-bottom-color: #ebcbc4;  width: 323px; vertical-align: middle;" colspan="1" rowspan="1">
                                                    <div class="p" style="text-align: left; direction: ltr; margin-left: 0px; text-indent: 0px;"><span class="de_6D2D8B1FD4">Violencia laboral</span></div>
                                                </td>
                                                <td class="de_td_126" style="padding: 2px; padding-bottom: 1px; border-left-style: dashed; border-left-width: 1px; border-left-color: #ebcbc4; border-right-style: dashed; border-right-width: 1px; border-right-color: #ebcbc4; border-top-style: dashed; border-top-width: 1px; border-top-color: #ebcbc4; border-bottom-style: dashed; border-bottom-width: 1px; border-bottom-color: #ebcbc4;  width: 126px; vertical-align: middle;" colspan="1" rowspan="1">
                                                    <div class="p" style="text-align: center; direction: ltr; margin-left: 0px; text-indent: 0px;"><span class="de_6D2D8B1FD4">33, 34, 35, 36,</span></div>
                                                    <div class="p" style="text-align: center; direction: ltr; margin-left: 0px; text-indent: 0px;"><span class="de_6D2D8B1FD4">37, 38, 39, 40</span></div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>


                            <!-- grafica -->
                         
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
</body>

</html>