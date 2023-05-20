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
  ?>
<div class="container text-center">
  <div class="row align-items-start">
    <div class="col">
    
    <?php
  
    if (isset($_POST['login'])) {
      extract($_POST);
      Conexion::abrir_conexion();
      login::iniciarSession(Conexion::obtener_conexion(),$email,$pass);
      Conexion::cerrar_conexion();
    }
  ?>
    </div>
    <div class="col">
    <div class="col"><h1 class="text-center">Login</h1></div>
    <form method="post" action="">
      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Email address</label>
        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email">
      </div>
      <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Password</label>
        <input type="password" class="form-control" id="exampleInputPassword1" name="pass">
      </div>
      <button type="submit" class="btn btn-primary" name="login">Submit</button>
      
    </form>
    </div>
    </div>
  </div>
</div>
</body>
</html>