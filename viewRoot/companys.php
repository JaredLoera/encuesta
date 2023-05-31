<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Panel empresas</title>
    <link href="../assets/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="../assets/css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/bootstrap-reboot.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../assets/css/bootstrap.css">
</head>
            <?php 
            include '../clases/dataroot/informacionRoot.inc.php';
            include '../clases/database/conexion.inc.php';  
            include '../clases/modelos/company.php'; 
            include '../clases/login.inc.php'; 
            include '../clases/correos/correos.php';
            login::sessionRoot();
            ?>
<body id="page-top">
    <div id="wrapper">
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">ENCUESTAS</div>
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
                <a class="nav-link text-white" href="#">Empresas</a>
                <a class="nav-link text-white" href="#">Encuestas</a>
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
                        <div class="topbar-divider d-none d-sm-block"></div>
                        <li class="nav-item dropdown no-arrow">
                        <div class="dropdown" style="margin-right: 30px;">
                        <a class="fs-5 mt-1 icon-link icon-link-hover link-success link-underline-success link-underline-opacity-25" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <?php echo $_SESSION['correo']; ?>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item fs-5" href="#">Configuracion</a></li>
                            <li><a class="dropdown-item fs-5 link-danger link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover" href="../clases/cerrar.inc.php">Salir</a></li>
                        </ul>
                        </div>
                        </li>
                    </ul>
                </nav>
                <div class="container-fluid">
                <!--INICIAN CARDS SUPERIORES-->
                    <div class="row">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead class="table-dark">
                                <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Regimen fiscal</th>
                                <th scope="col">Direccion</th>
                                <th scope="col">Correo</th>
                                <th scope="col">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                               <?php 
                               Conexion::abrir_conexion();
                               informacionRoot::informacion(conexion::obtener_conexion());
                               Conexion::cerrar_conexion();
                               ?>
                            </tbody>
                        </table>
                    </div>
                    </div>          
                </div>
                <!--TERMINAN CARDS SUPERIORES-->
                <!--MENSAJES DE CONFIRMACION EMPRESA AÑADIDAD-->
                    <?php 
                        if (isset($_POST['cerrarsession'])) {
                            login::cerrarSession();
                        }
                        if (isset($_POST['saveCompany'])) {
                            extract($_POST);
                            $company = new company();
                            $company->set_name($name);
                            $company->set_refimen($regimen);
                            $company->set_domicilio($domicilio);
                            $company->set_correo($email);
                            $company->set_pass($pass);
                            $company->save();
                            $mail = new Mail();
                            $mail->sendMailNewCompany($company);
                           ?> 
                           <script>
                                    window.setTimeout(function(){window.location.href="companys.php"}, 2000);
                            </script>
                            <?php
                        }
                    ?>
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
        <h1 class="modal-title fs-5" id="exampleModalLabel">Añadir empresa</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">

        </button>
      </div>
      <div class="modal-body">
      <form action="" method="Post" class="needs-validation" novalidate>
        <div class="mb-3">
                <label for="nombre" class="form-label">Nombre de la empresa</label>
                <input type="text" class="form-control" id="nombre" placeholder="nombre" aria-describedby="nombre" name="name" required>
                <div class="invalid-feedback">
                  Por favor escriba el nombre.
                </div>
            </div>
            <div class="mb-3">
                <label for="Refimen" class="form-label">Refimen fiscal</label>
                <input type="text" class="form-control" id="Refimen" placeholder="Refimen" aria-describedby="emailHelp" name="regimen" required>
                <div class="invalid-feedback">
                  Por favor escriba el regimen fiscal.
                </div>
            </div>
            <div class="mb-3">
                <label for="Domicilio" class="form-label">Domicilio</label>
                <input type="text" class="form-control" id="Domicilio" placeholder="domicilio" aria-describedby="emailHelp" name="domicilio" required>
            </div>
            <div class="mb-3">
                <label for="Email" class="form-label">Email de la empresa</label>
                <input type="email" class="form-control" id="Email" placeholder="Email" aria-describedby="emailHelp" name="email" required>
                <div class="invalid-feedback">
                  Por favor escriba el domicilio.
                </div>
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Contraseña</label>
                <input type="password" class="form-control" id="passcompany" name="pass" required>
                <div class="invalid-feedback">
                 La contraseña debe de tener mas de 8 caracteres.
                </div>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <button type="submit" name="saveCompany" class="btn btn-primary">Guardar</button>
        </form>
      </div>
    </div>
  </div>
</div>
    <script src="../assets/js/bootstrap.bundle.js"></script>
    <script src="../assets/js/validaciones.js"></script>
</body>
</html>