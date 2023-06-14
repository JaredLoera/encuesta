<?php

include '../clases/login.inc.php';
include '../clases/database/conexion.inc.php';
include '../clases/datacompany/informacionCompany.inc.php';
include '../clases/correos/correos.php';
include '../clases/modelos/worker.php';
login::sessionCompany();

header('Content-Type: application/json');

$correo = $_POST['correo'];


//$correo = "jiji@gmail.com";
Conexion::abrir_conexion();
$sql = "SELECT correo FROM contacto WHERE correo = '$correo'";
$consulta = datosCompany::consultas(Conexion::obtener_conexion(), $sql);
Conexion::cerrar_conexion();


if(count($consulta) > 0){
    echo json_encode(array('exists' => true)); // Si el correo ya existe, retorna 1
  } else {
    echo json_encode(array('exists' => false)); // Si el correo no existe, retorna 0
  }


?>
