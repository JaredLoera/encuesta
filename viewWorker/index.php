<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/bootstrap.css">
    <title>Encuesta estres</title>
</head>
<body>
    <?php 
    include "../clases/login.inc.php";
    include "../clases/database/conexion.inc.php";
    include "../clases/dataworker/informacionWorker.inc.php";
    include "../clases/modelos/userrespuesta.php";
    session_start();
    if(isset($_POST['cerrarsession'])){
        login::cerrarSession();
    }
    if (isset($_POST['guardarEncuesta'])) {
    extract($_POST);
    for ($i=1; $i <= sizeof($_POST)-1; $i++) {
      $inlineRadioOptions = 'inlineRadioOptions'.$i;
      $userrespuesta = new userrespuesta($_SESSION['id'],$i,$$inlineRadioOptions);
      if ($userrespuesta->save()) {
        echo "Guardado";
      }
      else{
        echo "No guardado";
      }
    }
    header("Refresh:2; url=index.php");
    }
    ?>
    <nav class="navbar bg-body-tertiary">
      <div class="container-fluid">
        <a class="navbar-brand">Encuestas</a>
        <a class="btn btn-primary" class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-gear-fill" viewBox="0 0 16 16">
      <path d="M9.405 1.05c-.413-1.4-2.397-1.4-2.81 0l-.1.34a1.464 1.464 0 0 1-2.105.872l-.31-.17c-1.283-.698-2.686.705-1.987 1.987l.169.311c.446.82.023 1.841-.872 2.105l-.34.1c-1.4.413-1.4 2.397 0 2.81l.34.1a1.464 1.464 0 0 1 .872 2.105l-.17.31c-.698 1.283.705 2.686 1.987 1.987l.311-.169a1.464 1.464 0 0 1 2.105.872l.1.34c.413 1.4 2.397 1.4 2.81 0l.1-.34a1.464 1.464 0 0 1 2.105-.872l.31.17c1.283.698 2.686-.705 1.987-1.987l-.169-.311a1.464 1.464 0 0 1 .872-2.105l.34-.1c1.4-.413 1.4-2.397 0-2.81l-.34-.1a1.464 1.464 0 0 1-.872-2.105l.17-.31c.698-1.283-.705-2.686-1.987-1.987l-.311.169a1.464 1.464 0 0 1-2.105-.872l-.1-.34zM8 10.93a2.929 2.929 0 1 1 0-5.86 2.929 2.929 0 0 1 0 5.858z"/>
        </svg>
        </a>
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
    <div class="row">
            <div class="col">
                <h1 class="text-center">Encuesta estres</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 ms-auto border border-danger">
                <div class="row algin-items-start">
                <div class="col">Siempre</div>
                <div class="col">Casi siempre</div>
                <div class="col">Algunas veces</div>
                <div class="col">Casi nunca</div>
                <div class="col">Nunca</div>
                </div>
            </div>
        </div>
       <!--preguntas-->

       <form action="" method="post">
        <?php 
        Conexion::abrir_conexion();
        informacionWorker::preguntas(conexion::obtener_conexion());
        Conexion::cerrar_conexion();
        ?>
        <button type="submit" name="guardarEncuesta">Guardar</button>
        </form>
        <div class="row">

        </div>
    </div>
<script src="../assets/js/bootstrap.bundle.js"></script>
</body>
</html>
               
               
               