<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Panel principal</title>
    <link href="../assets/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="../assets/css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>
            <?php 
            include '../clases/dataroot/informacionRoot.inc.php';
            include '../clases/database/conexion.inc.php';  
            include '../clases/modelos/company.php'; 
            include '../clases/login.inc.php'; 
            include '../clases/correos/correos.php';
            ?>
<body id="page-top">
    <div id="wrapper">
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">ENCUESTAS</div>
            </a>
            <hr class="sidebar-divider my-0">
            <li class="nav-item active">
              <h4>  <a class="nav-link" href="index.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                   
                    <span>Panel principal</span>
                </a>
                </h4>
            </li>
            <hr class="sidebar-divider">
            <div class="sidebar-heading">
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
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>
                        <div class="topbar-divider d-none d-sm-block"></div>
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">root@gmail.com</span>
                                <img class="rounded-circle" src="../assets/img/iconusere.png" width="60px" height="60px">
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Settings
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Activity Log
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>
                    </ul>
                </nav>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                            <h5>
                                            Encuestas  
                                            </h5>  
                                            </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800 text-center mt-3">
                                            <h2>
                                                <?php
                                                Conexion::abrir_conexion();
                                                echo informacionRoot::getNumCompanys(Conexion::obtener_conexion(),"SELECT count(*) as num from quiz;");
                                                Conexion::cerrar_conexion();
                                                ?>
                                            </h2>
                                            </div>
                                            <div class="col mt-4">
                                                <div class="row">
                                                <div class="col">
                                                    <button type="button" class="btn btn-success">Ver encuestas</button>
                                                </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                             <h5>
                                             Empresas
                                             </h5>  
                                            </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800 text-center mt-3">
                                            <h2>
                                                <?php
                                                Conexion::abrir_conexion();
                                                echo informacionRoot::getNumCompanys(Conexion::obtener_conexion(),"SELECT count(*) as num FROM company;");
                                                Conexion::cerrar_conexion();
                                                ?>
                                            </h2>
                                            </div>
                                            <div class="col mt-4">
                                                <div class="row">
                                                <div class="col">
                                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Añadir Empresa</button>
                                                </div>
                                                <div class="col">
                                                    <button type="button" class="btn btn-success">Ver empresas</button>
                                                </div>
                                                </div>
                                            </div>
                                            
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-comments fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
                            header("Refresh:2; url=index.php");
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
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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