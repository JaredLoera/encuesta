<?php

include '../clases/login.inc.php';
include '../clases/database/conexion.inc.php';
include '../clases/datacompany/informacionCompany.inc.php';
include '../clases/correos/correos.php';
include '../clases/modelos/worker.php';
login::sessionCompany();
$response = [];

if (isset($_POST['nombre'])) {
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
    $worker->set_pass($password . "123");

    if ($worker->save()) {
        $response = ["status" => 1, "message" => "¡Empleado añadido! El empleado se añadió correctamente."];
    } else {
        $response = ["status" => 0, "message" => "¡Error! El empleado no se añadió correctamente."];
    }
} else {
    $response = ["status" => 0, "message" => "No se recibieron los datos necesarios."];
}

echo json_encode($response);
?>
