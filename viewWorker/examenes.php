<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/bootstrap.css">
    <title>Encuesta estres</title>
</head>
<body <?php 
   include "../clases/login.inc.php";
   include "../clases/database/conexion.inc.php";
   include "../clases/dataworker/informacionWorker.inc.php";
   include "../clases/modelos/userrespuesta.php";
   session_start();
    if (informacionWorker::checkAnswer($_SESSION['id'])) {
  ?> style="background-color: #C9FFBD;"><?php
}  
if(isset($_POST['cerrarsession'])){
    login::cerrarSession();
}?>
    <nav class="navbar bg-body-tertiary">
      <div class="container-fluid">
        <a class="navbar-brand">Encuestas</a>
        <div class="dropdown" style="margin-right: 30px;">
        <a class="fs-5 mt-1 icon-link icon-link-hover link-success link-underline-success link-underline-opacity-25" type="button" data-bs-toggle="dropdown" aria-expanded="false">
        <?php echo $_SESSION['correo']; ?>
        </a>
        <ul class="dropdown-menu">
            <li><a class="dropdown-item fs-5" href="#">Configuracion</a></li>
            <li><a class="dropdown-item fs-5 link-danger link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover" href="../clases/cerrar.inc.php">Salir</a></li>
        </ul>
        </div>
      </div>
    </nav>
    <div class="container">
        <div class="row">
            <div class="col">
                <h1>Encuesta del capitulo</h1>
            </div>
        </div>
        <div class="row">
            
        </div>
    </div>

<script src="../assets/js/bootstrap.bundle.js"></script>
</body>
</html>