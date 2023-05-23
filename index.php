<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="assets/css/bootstrap.css">
  <title>Login</title>
</head>
<body>
<?php
    include 'clases/database/conexion.inc.php';
    include 'clases/login.inc.php'; 
  session_start();
  if (isset($_SESSION['id'])) {
    if ($_SESSION['tipo'] == "WORKER") {
        header("Location: viewWorker/index.php");
    }
    elseif ($_SESSION['tipo'] == "ROOT") {
        header("Location: viewRoot/index.php");
    }
    else{
        header("Location: viewCompany/index.php");
    }
  }
  if (isset($_POST['login'])) {
    extract($_POST);
    Conexion::abrir_conexion();
    login::iniciarSession(Conexion::obtener_conexion(),$email,$pass);
    Conexion::cerrar_conexion();
  }
  ?>
<!-- Section: Design Block -->
<section class="background-radial-gradient overflow-hidden">
  <style>
    .background-radial-gradient {
      background-color: hsl(218, 41%, 15%);
      background-image: radial-gradient(650px circle at 0% 0%,
          hsl(218, 41%, 35%) 15%,
          hsl(218, 41%, 30%) 35%,
          hsl(218, 41%, 20%) 75%,
          hsl(218, 41%, 19%) 80%,
          transparent 100%),
        radial-gradient(1250px circle at 100% 100%,
          hsl(218, 41%, 45%) 15%,
          hsl(218, 41%, 30%) 35%,
          hsl(218, 41%, 20%) 75%,
          hsl(218, 41%, 19%) 80%,
          transparent 100%);
    }
    .bg-glass {
      background-color: hsla(0, 0%, 100%, 0.9) !important;
      backdrop-filter: saturate(200%) blur(25px);
    }
  </style>
  <div class="container px-4 py-5 px-md-5 text-center text-lg-start my-5">
    <div class="row gx-lg-5 align-items-center mb-5">
      <div class="col-lg-6 mb-5 mb-lg-0" style="z-index: 10">
        <h1 class="my-5 display-5 fw-bold ls-tight" style="color: hsl(218, 81%, 95%)">
          Las mejores encuestas <br />
          <span style="color: hsl(218, 81%, 75%)">para tus empelados</span>
        </h1>
        <p class="mb-4 opacity-70">  
        <h3 style="color: hsl(218, 81%, 85%)">
        Encuestas para tu negocio, para comprender mejor a tus trabajadores para mejorar tu negocio y el servico hacia los clientes.
        </h3>
        </p>
      </div>
      <div class="col-lg-6 mb-5 mb-lg-0 position-relative">
        <div class="card bg-glass">
          <div class="card-body px-4 py-5 px-md-5">
            <div>
              <p>
               <h3>Iniciar sesion</h3> 
              </p>
            </div>
            <form method="post">
              <div class="form-outline mb-4 mt-3">
                <input type="email" id="form3Example3" class="form-control form-control-lg" name="email">
                <label class="form-label" for="form3Example3">Correo electronico</label>
              </div>
              <div class="form-outline mb-4">
                <input type="password" id="form3Example4" class="form-control form-control-lg" name="pass">
                <label class="form-label" for="form3Example4">Contraseña</label>
              </div>
              <button type="submit" class="btn btn-primary btn-block mb-4 btn-lg" name="login">
              Iniciar sesion
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
</body>
</html>



