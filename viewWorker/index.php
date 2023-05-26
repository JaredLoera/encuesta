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
   if (isset($_POST['guardarEncuesta'])) {
    extract($_POST);
    for ($i=1; $i <= sizeof($_POST)-1; $i++) {
      $inlineRadioOptions = 'inlineRadioOptions'.$i;
      $userrespuesta = new userrespuesta($_SESSION['id'],$i,$$inlineRadioOptions);
      $userrespuesta->save();
    }
    header("Refresh:2; url=index.php");
    }
    if (informacionWorker::checkAnswer($_SESSION['id'])) {
  ?> style="background-color: #C9FFBD;"
<?php } ?>  >
    <?php 
 
    
    if(isset($_POST['cerrarsession'])){
        login::cerrarSession();
    }
    
    ?>
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
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
      <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasRightLabel">Configuracion</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body">
      <form action="" method="post"><button type="submit" class="btn btn-outline-danger" name="cerrarsession">Cerrar session</button></form>
      </div>
    </div>
    <div class="container">
    <div class="row row-cols-1 row-cols-md-3 g-4 mt-5">
    <?php 
    Conexion::abrir_conexion();
    informacionWorker::getBlocksWorker(conexion::obtener_conexion(),$_SESSION['id']);
    Conexion::cerrar_conexion();
    ?>
   </div>
    </div>
    <script>
      (() => {
  'use strict'

  // Fetch all the forms we want to apply custom Bootstrap validation styles to
  const forms = document.querySelectorAll('.needs-validation')

  // Loop over them and prevent submission
  Array.from(forms).forEach(form => {
    form.addEventListener('submit', event => {
      if (!form.checkValidity()) {
        event.preventDefault()
        event.stopPropagation()
      }

      form.classList.add('was-validated')
    }, false)
  })
})()
    </script>
<script src="../assets/js/bootstrap.bundle.js"></script>
</body>
</html>
               
               
               