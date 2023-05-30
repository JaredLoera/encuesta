<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/bootstrap.css">
    <title>Encuesta estres</title>
</head>
<body 
<?php 
    include "../clases/login.inc.php";
    include "../clases/database/conexion.inc.php";
    include "../clases/dataworker/informacionWorker.inc.php";
    include "../clases/modelos/userrespuesta.php";
    login::sessionWorker();
    ?> style="background-color: #324B77;" >
    <?php 
 
    
    if(isset($_POST['cerrarsession'])){
        login::cerrarSession();
    }
    include "nav.php";
    ?>
   
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
               
               
               