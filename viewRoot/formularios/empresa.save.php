<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Agregar Empresa</title>
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="../../assets/css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../assets/css/bootstrap-reboot.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../../assets/css/bootstrap.css">
</head>
<?php
include_once '../../clases/dataroot/informacionRoot.inc.php';
include_once '../../clases/database/conexion.inc.php';
include_once '../../clases/modelos/company.php';
include_once '../../clases/login.inc.php';
include_once '../../clases/correos/correos.php';
login::sessionRoot();
?>

<body id="page-top">
    <div id="wrapper">
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="../index.php">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">ENCUESTAS</div>
            </a>
            <hr class="border border-1 opacity-75">
            <li class="nav-item active">
                <a class="nav-link fs-5" href="../index.php"> Panel principal </a>
            </li>
            <hr class="sidebar-divider">
            <div class="sidebar-heading fs-5">
                Interfaces
            </div>
            <nav class="nav flex-column ml-3 fw-bold">
                <?php include('links.php') ?>
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
                    <div class="row">
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
                            if ($company->save()) {
                                //$mail = new Mail();
                                //$mail->sendMailNewCompany($company);
                        ?>
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <strong>¡Empresa añadida!</strong> La empresa se añadió correctamente.
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            <?php
                            } else {
                            ?>
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <strong>¡Error!</strong> La empresa no se añadió correctamente.
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                        <?php
                            }
                            $company = null;
                        }
                        ?>
                    </div>
                    <div class="row">
                        <form action="" method="Post" class="needs-validation" novalidate>
                            <div class="mb-3">
                                <label for="tipopersona">Tipo de Persona</label>
                                <select name="tipopersona" id="tipopersona" class="form-select" required> 
                                    <option value="" selected disabled>Seleccione tipo de persona:</option>
                                    <option value="1">Física</option>
                                    <option value="2">Moral</option>
                                </select>
                                <div class="invalid-feedback">
                                    Seleccione una opción
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="rfc" class="form-label">RFC del empleado:</label>
                                <input type="text" class="form-control" id="rfc" placeholder="RFC del empleado" aria-describedby="rfc" name="rfc" pattern="[A-ZÑ&]{3,4}\d{6}[A-V1-9][A-Z1-9][0-9A]" required>
                                <div class="invalid-feedback">
                                    Tiene que ser un rfc valido
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="razon-nombre" class="form-label">Razón Social o Nombre Completo:</label>
                                <input type="text" class="form-control" id="razon-nombre" placeholder="Razón Social o Nombre Completo" aria-describedby="razon-nombre" name="razon-nombre" required>
                                <div class="invalid-feedback">
                                    Tiene que ser un rfc valido
                                </div>
                            </div>
                            <!-- <div class="mb-3">
                                <label for="nombre" class="form-label">Nombre</label>
                                <input type="text" class="form-control" id="nombre" placeholder="Ingrese su nombre" name="nombre" required>
                                <div class="invalid-feedback">
                                    Por favor escriba su nombre.
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="apellidoPaterno" class="form-label">Apellido Paterno</label>
                                <input type="text" class="form-control" id="apellidoPaterno" placeholder="Ingrese su apellido paterno" name="apellidoPaterno" required>
                                <div class="invalid-feedback">
                                    Por favor escriba su apellido paterno.
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="apellidoMaterno" class="form-label">Apellido Materno</label>
                                <input type="text" class="form-control" id="apellidoMaterno" placeholder="Ingrese su apellido materno" name="apellidoMaterno" required>
                                <div class="invalid-feedback">
                                    Por favor escriba su apellido materno.
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="RegimenFiscal" class="form-label">Régimen Fiscal</label>
                                <select class="form-control" id="RegimenFiscal" name="regimenFiscal" required>
                                    <option value="" disabled selected>Seleccione un régimen fiscal</option>
                                    <option value="1">Régimen General de Ley Personas Morales</option>
                                    <option value="2">Régimen de Incorporación Fiscal</option>
                                </select>
                                <div class="invalid-feedback">
                                    Por favor seleccione un régimen fiscal.
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="calle" class="form-label">Calle</label>
                                <input type="text" class="form-control" id="calle" placeholder="Ingrese la calle" name="calle" required>
                                <div class="invalid-feedback">
                                    Por favor escriba la calle.
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="numeroCasa" class="form-label">Número de Casa</label>
                                <input type="text" class="form-control" id="numeroCasa" placeholder="Ingrese el número de casa" name="numeroCasa" required>
                                <div class="invalid-feedback">
                                    Por favor escriba el número de casa.
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="colonia" class="form-label">Colonia</label>
                                <input type="text" class="form-control" id="colonia" placeholder="Ingrese la colonia" name="colonia" required>
                                <div class="invalid-feedback">
                                    Por favor escriba la colonia.
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="ciudad" class="form-label">Ciudad</label>
                                <input type="text" class="form-control" id="ciudad" placeholder="Ingrese la ciudad" name="ciudad" required>
                                <div class="invalid-feedback">
                                    Por favor escriba la ciudad.
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="estado" class="form-label">Estado</label>
                                <input type="text" class="form-control" id="estado" placeholder="Ingrese el estado" name="estado" required>
                                <div class="invalid-feedback">
                                    Por favor escriba el estado.
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="codigoPostal" class="form-label">Código Postal</label>
                                <input type="text" class="form-control" id="codigoPostal" placeholder="Ingrese el código postal" name="codigoPostal" required pattern="[0-9]{5}">
                                <div class="invalid-feedback">
                                    Por favor escriba un código postal válido.
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" placeholder="Ingrese el email" name="email" required>
                                <div class="invalid-feedback">
                                    Por favor escriba el email.
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="passcompany" class="form-label">Contraseña</label>
                                <input type="password" class="form-control" id="passcompany" name="pass" placeholder="Ingrese la contraseña" required minlength="8">
                                <div class="invalid-feedback">
                                    La contraseña debe de tener más de 8 caracteres.
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                <button type="submit" name="saveCompany" class="btn btn-primary">Guardar</button>
                            </div> -->
                        </form>
                    </div>
                </div>
                <!--TERMINAN CARDS SUPERIORES-->
                <!--MENSAJES DE CONFIRMACION EMPRESA AÑADIDAD-->

            </div>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Añadir empresa</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">

                    </button>
                </div>
                <div class="modal-body">
                    <!-- <form action="" method="Post" class="needs-validation" novalidate>
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre de la empresa</label>
                            <input type="text" class="form-control" id="nombre" placeholder="Ingrese el nombre de la empesa" aria-describedby="nombre" name="name" required>
                            <div class="invalid-feedback">
                                Por favor escriba el nombre.
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="Refimen" class="form-label">Regimen fiscal</label>
                            <input type="text" class="form-control" id="Refimen" placeholder="Ingrese el regimen de la empesa" aria-describedby="emailHelp" name="regimen" required>
                            <div class="invalid-feedback">
                                Por favor escriba el regimen fiscal.
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="Domicilio" class="form-label">Domicilio</label>
                            <input type="text" class="form-control" id="Domicilio" placeholder="Ingrese el domicilio de la empesa" aria-describedby="emailHelp" name="domicilio" required>
                            <div class="invalid-feedback">
                                Por favor escriba el domicilio.
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email de la empresa</label>
                            <input type="email" class="form-control" id="email" placeholder="Ingrese el email de la empesa" aria-describedby="emailHelp" name="email" required>
                            <div class="invalid-feedback">
                                Por favor escriba el email.
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Contraseña</label>
                            <input type="password" class="form-control" id="passcompany" name="pass" placeholder="Ingrese la contraseña" required minlength="8">
                            <div class="invalid-feedback">
                                La contraseña debe de tener mas de 8 caracteres.
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" name="saveCompany" class="btn btn-primary">Guardar</button>
                    </form> -->
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
    </div>
    <script src="../assets/js/bootstrap.bundle.js"></script>
    <script src="../assets/js/validaciones.js"></script>
    <script>
        document.querySelectorAll('input,select').forEach(function(input) {
            input.addEventListener('keydown', function(e) {
                if (e.key == "Enter") {
                    e.preventDefault();
                    let nextInput = getNextInput(input);
                    if (nextInput) nextInput.focus();
                }
            });
        });

        function getNextInput(input) {
            let form = input.form;
            for (let i = 0; i < form.elements.length; i++) {
                if (form[i] == input) {
                    if (i + 1 < form.elements.length) return form.elements[i + 1];
                }
            }
            return null;
        }
    </script>

</body>

</html>