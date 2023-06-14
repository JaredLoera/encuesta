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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
</head>
<?php
include '../clases/login.inc.php';
include '../clases/database/conexion.inc.php';
include '../clases/datacompany/informacionCompany.inc.php';
include '../clases/correos/correos.php';
include '../clases/modelos/worker.php';
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
                        <div class="col mb-4">
                            <h1 class="h3 mb-0 text-gray-800">Principal</h1>
                        </div>
                    </div>
                    <div class="row" id="alertas"></div>
                    <!-- <div class="row">
                        <?php
                        // if (isset($_POST['saveWorker'])) {
                        //     extract($_POST);
                        //     $worker = new Worker();
                        //     $worker->set_nombre($nombre);
                        //     $worker->set_rfc($rfc);
                        //     $worker->set_correo($correo);
                        //     $worker->set_idCompany($_SESSION['id']);
                        //     $worker->set_ap_paterno($ap_paterno);
                        //     $worker->set_ap_materno($ap_materno);
                        //     $worker->set_telefono($telefono);
                        //     $partes = explode("@", $correo);
                        //     $password = $partes[0];
                        //     $worker->set_pass($password . "123");
                        //$mail = new Mail();
                        //$mail->sendMailNewWorker($worker);
                        // if ($worker->save()) {
                        ?>
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <strong>¡Empleado añadido!</strong> El empleado se añadió correctamente.
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            <?php
                            // } else {
                            ?>
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <strong>¡Error!</strong> El empleado no se añadió correctamente.
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                        <?php
                        //}
                        //}
                        ?>
                    </div> -->
                    <div class="row">
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                <h5>
                                                    Capítulos
                                                </h5>
                                            </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800 text-center mt-3">
                                                <h2>
                                                    <?php
                                                    Conexion::abrir_conexion();
                                                    echo informacionCompany::getNum(Conexion::obtener_conexion(), "SELECT count(*) as num from capitulo where company_id=" . $_SESSION['id'] . ";");
                                                    Conexion::cerrar_conexion();
                                                    ?>
                                                </h2>
                                            </div>
                                            <div class="col mt-4">
                                                <div class="row">
                                                    <div class="col">
                                                        <a href="encuestas.php" type="button" class="btn btn-primary">Ver capitulos</a>
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
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                <h5>
                                                    Encuestas realizadas
                                                </h5>
                                            </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800 text-center mt-3">
                                                <h2>
                                                    <?php
                                                    Conexion::abrir_conexion();
                                                    echo informacionCompany::getNum(Conexion::obtener_conexion(), "SELECT count(*) as num FROM capitulo join quiz on capitulo.id = quiz.capitulo_id where company_id  =" . $_SESSION['id'] . ";");
                                                    Conexion::cerrar_conexion();
                                                    ?>
                                                </h2>
                                            </div>
                                            <div class="col mt-4">
                                                <div class="row">
                                                    <div class="col">
                                                        <a href="respuestasWorker.php" type="button" class="btn btn-success">Ver encuestas</a>
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
                                                    Trabajadores
                                                </h5>
                                            </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800 text-center mt-3">
                                                <h2>
                                                    <?php
                                                    Conexion::abrir_conexion();
                                                    echo informacionCompany::getNum(Conexion::obtener_conexion(), "SELECT count(*) as num from user where company_id =" . $_SESSION['id'] . "");
                                                    Conexion::cerrar_conexion();
                                                    ?>
                                                </h2>
                                            </div>
                                            <div class="col mt-4">
                                                <div class="row">
                                                    <div class="col">
                                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Añadir trabajador</button>
                                                    </div>
                                                    <div class="col">
                                                        <a href="trabajadores.php" class="btn btn-success" role="button">Ver trabajadores</a>
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
                    <div class="row">
                    </div>
                </div>
                <!--TERMINAN CARDS SUPERIORES-->
                <!--MENSAJES DE CONFIRMACION EMPRESA AÑADIDAD-->
                <?php
                if (isset($_POST['cerrarsession'])) {
                    login::cerrarSession();
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
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Añadir empleado</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="index.php" method="Post" class="needs-validation" id="addPersona" novalidate>
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre del empleado</label>
                            <input type="text" class="form-control" id="nombre" placeholder="Ingresa el nombre del empleado" aria-describedby="nombre" name="nombre" required>
                            <div class="invalid-feedback">
                                Escriba el nombre del empleado
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="ap_paterno" class="form-label">Apellido paterno</label>
                            <input type="text" class="form-control" id="nombre" placeholder="Ingresa el apellido paterno del empleado" aria-describedby="ap_paterno" name="ap_paterno" required>
                            <div class="invalid-feedback">
                                Escriba el apellido paterno del empleado
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="ap_materno" class="form-label">Apellido materno</label>
                            <input type="text" class="form-control" id="nombre" placeholder="Ingresa el apellido materno del empleado" aria-describedby="ap_materno" name="ap_materno" required>
                            <div class="invalid-feedback">
                                Escriba el apellido materno del empleado
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="rfc" class="form-label">RFC del empleado</label>
                            <input type="text" class="form-control" id="rfc" placeholder="RFC del empleado" aria-describedby="rfc" name="rfc" pattern="[A-ZÑ&]{3,4}\d{6}[A-V1-9][A-Z1-9][0-9A]" required>
                            <div class="invalid-feedback">
                                Tiene que ser un rfc valido
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="telefono" class="form-label">Telefono del empleado</label>
                            <input type="tel" class="form-control" id="telefono" placeholder="Ingresa el telefono del empleado" aria-describedby="telefono" name="telefono" required minlength="10" maxlength="10" pattern="\d*" onblur="validarTel(this);">
                            <div class="invalid-feedback">
                                El número de teléfono debe tener exactamente 10 dígitos sin espacios.
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="correo" class="form-label">Correo del empleado</label>
                            <input type="email" class="form-control" id="correo" placeholder="Ingresa el correo del empleado" aria-describedby="correo" name="correo" required>
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
    <script>
        const inputCorreo = document.getElementById('correo');
        inputCorreo.addEventListener('keyup', function() {
            console.log(inputCorreo.value);
        });

        inputCorreo.addEventListener('input', function() {
            $('#correo').removeClass('is-invalid');
        });

        (() => {
            'use strict'

            const forms = document.querySelectorAll('.needs-validation')

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

        function validarTel(input) {
            var originalValue = input.value;
            var noSpaceValue = originalValue.replace(/\s+/g, '');

            if (noSpaceValue.length != 10) {
                input.setCustomValidity("El número de teléfono debe tener exactamente 10 dígitos sin espacios.");
            } else {
                input.setCustomValidity("");
                input.value = noSpaceValue;
            }
        }

        function validarForm(form) {
            var telefonoInput = form['telefono'];
            validarTel(telefonoInput);
            return telefonoInput.reportValidity();
        }

        $('#exampleModal').on('hidden.bs.modal', function(e) {
            $('#addPersona')[0].reset();
        })

        $(document).ready(function() {
            $('#addPersona').on('submit', function(event) {
                event.preventDefault();

                if (this.checkValidity()) {
                    var correo = $('#correo').val();

                    if (correo) {
                        $.ajax({
                            url: 'verificarcorreo.php',
                            type: 'post',
                            dataType: 'json',
                            data: {
                                correo: correo
                            },
                            success: function(data) {
                                if (data.exists === true) {
                                    $('#correo').addClass('is-invalid');
                                    $('#correo').siblings('.invalid-feedback').text('Este correo ya está ocupado.');
                                    console.log(data);
                                } else {
                                    console.log('Correo does not exist');
                                    $('#correo').removeClass('is-invalid');
                                    console.log(data);

                                    $.ajax({
                                        url: 'saveWorker.php',
                                        type: 'post',
                                        dataType: 'json',
                                        data: $('#addPersona').serialize(),
                                        success: function(response) {
                                            if (response.status === 1) {
                                                console.log(response);
                                                $('#exampleModal').modal('hide');
                                                showAlert("¡Empleado añadido! El empleado se añadió correctamente.", "success");
                                            } else {
                                                console.log(response, "error");
                                                showAlert("¡Error! El empleado no se añadió correctamente.", "danger");
                                            }
                                        },
                                        error: function(jqXHR, textStatus, errorThrown) {}
                                    });
                                }
                            }
                        });
                    }
                }
            });
        });

        function showAlert(message, type) {
            var alertTemplate = `
    <div class="alert alert-${type} alert-dismissible fade show" role="alert">
        <strong>${message}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
`;

            $('#alertas').prepend(alertTemplate);
        }
    </script>



</body>

</html>