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
          <div class="row">
            <div class="table-responsive">
              <table class="table table-striped">
                <thead class="text-center">
                  <tr class="table-dark">
                    <th scope="col">#</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">RFC</th>
                    <th scope="col">Correo</th>
                    <th scope="col">teléfono</th>
                    <th scope="col">acciones</th>
                  </tr>
                </thead>
                <tbody class="text-center">
                  <?php
                  Conexion::abrir_conexion();
                  informacionCompany::getWorkers(Conexion::obtener_conexion(), $_SESSION['id']);
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
              <label for="ap_paterno" class="form-label">Apellido paterno del empleado</label>
              <input type="text" class="form-control" id="nombre" placeholder="apellido paterno" aria-describedby="ap_paterno" name="ap_paterno" required>
              <div class="invalid-feedback">
                Escriba el apellido paterno del empleado
              </div>
            </div>
            <div class="mb-3">
              <label for="ap_materno" class="form-label">Apellido materno del empleado</label>
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
              <label for="telefono" class="form-label">teléfono del empleado</label>
              <input type="phone" class="form-control" id="rfc" placeholder="correo del empleado" aria-describedby="telefono" name="telefono" required>
              <div class="invalid-feedback">
                Escriba el teléfono del empleado
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
  <script src="../assets/js/bootstrap.bundle.js"></script>
  <script src="../assets/js/validaciones.js"></script>
</body>

</html>