<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/bootstrap.css">
    <title>Capitulo</title>
</head>
<body>
    <?php 
    include "../clases/login.inc.php";
    include "../clases/database/conexion.inc.php";
    include "../clases/dataworker/informacionWorker.inc.php";
    login::sessionWorker();
    include "nav.php";
    ?>

    <div class="container">
    <div class="row">
        <div class="col">
            <h1>Encuesta del capitulo  </h1>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <table class="table">
                <thead>
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">fecha de aplicacion</th>
                    <th scope="col">acciones</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                informacionWorker::quizNoFinished($_SESSION['id'],$_GET['bloque']);
                ?>
                </tbody>
            </table>
        </div>
    </div>
    </div>
    <script src="../assets/js/bootstrap.bundle.js"></script>
</body>
</html>