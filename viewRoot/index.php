<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../assets/css/bootstrap.css">
    <title>Login</title>
  </head>
  <body>
        <?php 
            include '../clases/dataroot/informacionRoot.inc.php';
            include '../clases/database/conexion.inc.php';  
            include '../clases/modelos/company.php'; 
            include '../clases/login.inc.php'; 
        ?>
     <nav class="navbar bg-body-tertiary">
      <div class="container-fluid">
        <a class="navbar-brand">Encuestas  </a>
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
        <div class="row">
        <div class="container text-center">
      <div class="row align-items-start">
      <div class="col"> 
       <h1 class="text-center">Informacion de las empresas</h1>
      </div>
      <div class="col mt-2">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Añadir Empresa</button>
    </div>
      </div>
      <?php 
      if (isset($_POST['saveCompany'])) {
        extract($_POST);
          $company = new company();
          $company->set_name($name);
          $company->set_refimen($regimen);
          $company->set_domicilio($domicilio);
          $company->set_correo($email);
          $company->set_pass($pass);
          $company->save();
          header("Refresh:2; url=index.php");
      }
      if (isset($_POST['cerrarsession'])) {
        login::cerrarSession();
      }
    ?>
    </div>    
        <table class="table">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Nombre completo</th>
              <th scope="col">regimen fiscal</th>
              <th scope="col">Domicilio</th>
              <th scope="col">Correo</th>
            </tr>
          </thead>
          <tbody>
            <?php 
                Conexion::abrir_conexion();
                informacionRoot::informacion(Conexion::obtener_conexion());
                Conexion::cerrar_conexion();
            ?>
          </tbody>
        </table>
        </div>
    </div>
  
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
                <input type="password" class="form-control" id="exampleInputPassword1" name="pass" required>
                <div class="invalid-feedback">
                  Por favor escriba la contraseña de la empresa.
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