<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/bootstrap.css">
    <title>Empresa encuesas</title>
</head>
<body>
    <?php 
    include '../clases/login.inc.php';
    include '../clases/datacompany/informacionCompany.inc.php';
    include '../clases/database/conexion.inc.php';
    include '../clases/modelos/worker.php';
    session_start();
    if (isset($_SESSION['id'])) {

    }
    else{
        header("Location: ../index.php");
    }
    ?>
<nav class="navbar bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand">Encuestas <?php echo $_SESSION['nombre'] ?> </a>
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
<?php
if (isset($_POST['cerrarsession'])) {
    login::cerrarSession();
}
?>
<div class="container">
<div class="row align-items-start">
      <div class="col"> 
       <h1 class="text-center">Encuestas</h1>
      </div>
      <div class="col mt-3">
      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Añadir empleado</button>
      </div>
</div>
<div class="row">
  <?php 
  if (isset($_POST['saveWorker'])) {
    extract($_POST);
    $worker = new Worker();
    $worker->set_nombre($nombre);
    $worker->set_rfc($rfc);
    $worker->set_correo($correo);
    $worker->set_idCompany($_SESSION['id']);
    $worker->set_ap_paterno($ap_paterno);
    $worker->set_ap_materno($ap_materno);
    $worker->set_telefono($telefono);
    $partes = explode("@", $correo);
    $password = $partes[0];
    $worker->set_pass($password."123");
    if ($worker->save()) {
    ?><div class="alert alert-success" role="alert">
      Empleado agregado correctamente
      </div>
    <?php
    header("Refresh:2; url=index.php");
    }else{
     ?>
     <div class="alert alert-danger" role="alert">
      Error al agregar empleado
      </div>
     
     <?php
    }
  }
  ?>
</div>
  <div class="row mt-5">
    <div class="col">
    <div class="card border-info mb-3" style="max-width: 18rem;">
  <div class="card-header"><h5>Encuestas</h5></div>
      <div class="card-body text-center">
        <h5 class="card-title">Total terminadas</h5>
        <p class="card-text"><h3>
          <?php 
          $sql ="SELECT count(DISTINCT user.id) as num from user join respuestasuser on user.id =respuestasuser.user_id where user.company_id = ".$_SESSION['id'];
          Conexion::abrir_conexion();
          echo informacionCompany::getNum(Conexion::obtener_conexion(),$sql); 
          Conexion::cerrar_conexion();
          ?>
        </h3></p>
        <div class="card-footer bg-transparent border-success"><a href="estadisticas.php?id=<?php echo $_SESSION['id'] ?>">ver encuestas</a></div>
      </div>
  </div>
    </div>
    <div class="col">
    <div class="card border-info mb-3" style="max-width: 18rem;">
  <div class="card-header"><h5>Empleados</h5></div>
      <div class="card-body text-center">
        <h5 class="card-title">Total de empleados</h5>
        <p class="card-text"><h3>
          <?php
          $sql= "SELECT count(*) as num FROM user where user.company_id = ".$_SESSION['id'];
          Conexion::abrir_conexion();
          echo informacionCompany::getNum(Conexion::obtener_conexion(),$sql);
          Conexion::cerrar_conexion();
           ?></h3>
          </p>
          <div class="card-footer bg-transparent border-success"><a href="trabajadores.php?id=<?php echo $_SESSION['id'] ?>">ver empleados</a></div>
      </div>
  </div>
    </div>
  </div>
  <div class="row">
  
  </div>
  </div>
  <div class="row">
  <div class="row row-cols-1 row-cols-md-3 g-4">
  <?php 
 
  ?>
</div>
  </div>
</div>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Añadir empleado</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form action="index.php?id=<?php echo $_SESSION['id'] ?>" method="Post" class="needs-validation" novalidate>
        <div class="mb-3">
                <label for="nombre" class="form-label">Nombre del empleado</label>
                <input type="text" class="form-control" id="nombre" placeholder="nombre" aria-describedby="nombre" name="nombre" required>
                <div class="invalid-feedback">
                  Escriba el nombre del empleado
                </div>
            </div>
            <div class="mb-3">
                <label for="ap_paterno" class="form-label">Apellido del empleado</label>
                <input type="text" class="form-control" id="nombre" placeholder="apellido paterno" aria-describedby="ap_paterno" name="ap_paterno" required>
                <div class="invalid-feedback">
                  Escriba el apellido paterno del empleado
                </div>
            </div>
            <div class="mb-3">
                <label for="ap_materno" class="form-label">Apellido del empleado</label>
                <input type="text" class="form-control" id="nombre" placeholder="apellido materno" aria-describedby="ap_materno" name="ap_materno" required>
                <div class="invalid-feedback">
                  Escriba el apellido materno del empleado
                </div>
            </div>
            <div class="mb-3">
                <label for="rfc" class="form-label">rfc del empleado</label>
                <input type="text" class="form-control" id="rfc" placeholder="Descrpcion" aria-describedby="rfc" name="rfc" required>
                <div class="invalid-feedback">
                  Escriba el rfc del empleado
                </div>
            </div>
            <div class="mb-3">
                <label for="telefono" class="form-label">telefono del empleado</label>
                <input type="phone" class="form-control" id="rfc" placeholder="correo del empleado" aria-describedby="telefono" name="telefono" required>
                <div class="invalid-feedback">
                  Escriba el telefono del empleado
                </div>
            </div>
            <div class="mb-3">
                <label for="correo" class="form-label">correo del empleado</label>
                <input type="email" class="form-control" id="rfc" placeholder="correo del empleado" aria-describedby="correo" name="correo" required>
                <div class="invalid-feedback">
                  Escriba el correo del empleado
                </div>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <button type="submit" name="saveWorker" class="btn btn-primary">Guardar</button>
        </form>
      </div>
    </div>
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