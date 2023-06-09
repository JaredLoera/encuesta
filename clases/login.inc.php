<?php 
class login{
    public static function iniciarSession($conexion,$correo,$pass){
        $sql = "SELECT contacto.id, pass, correo, nombre as tipouser FROM contacto join tipo_user on contacto.tipo_user_id = tipo_user.id WHERE correo = '$correo'";
        $sentencia = $conexion->query($sql);
        $resultado = $sentencia->fetch(PDO::FETCH_OBJ);
        if (!$resultado) {
          ?>
          <div class="alert alert-danger" role="alert">
            Correo o contrasñea incorrecta
          </div> 
          <?php    
        }else{
            if (password_verify($pass, $resultado->pass)) {
                if ($resultado->tipouser == "root") {
                    session_start();
                    $_SESSION['tipo'] = "ROOT";
                    $_SESSION['id'] = $resultado->id;
                    $_SESSION['correo']= $resultado->correo;
                    header("Location: viewRoot/index.php");
                }
                elseif ($resultado->tipouser == "company") {
                    $sql = "SELECT * FROM company WHERE contacto_id = $resultado->id";
                    $sentencia = $conexion->query($sql);
                    $dataCompany = $sentencia->fetch(PDO::FETCH_OBJ);
                    session_start();
                    $_SESSION['id_contacto'] = $resultado->id;
                    $_SESSION['id'] = $dataCompany->id;
                    $_SESSION['nombre']= $dataCompany->nombre;
                    $_SESSION['correo']= $resultado->correo;
                    $_SESSION['tipo'] = "COMPANY";
                    header("Location: viewCompany/index.php");
                }
                else {
                    session_start();
                    $sql ="SELECT user.id from user join contacto on user.contacto_id = contacto.id where contacto.id = $resultado->id";
                    $sentencia = $conexion->query($sql);
                    $dataUser = $sentencia->fetch(PDO::FETCH_OBJ);
                    $_SESSION['user_id'] = $dataUser->id;
                    $_SESSION['tipo'] = "WORKER";
                    $_SESSION['id'] = $resultado->id;
                    $_SESSION['correo']= $resultado->correo;
                    header("Location: viewWorker/index.php");
                }
            }
            else {
                ?>
                <div class="alert alert-danger" role="alert">
                Correo o contrasñea incorrecta
                </div> 
                <?php   
            }
           
        }
    }
    public static function desiblebutton():bool{
       Conexion::abrir_conexion();
       $conexion = Conexion::obtener_conexion();
       $sql = "select * from contacto where tipo_user_id = 1;";
       $sentencia = $conexion->query($sql);     
       $resultado = $sentencia->fetchAll();
       if(!$resultado){
        return false;
       }   
       else{
        return true;
       }
    }
   public static function cerrarSession(){
        session_start();    
        session_unset();
        session_destroy();
        header("Location: ../index.php");
    }
    public static function sessionRoot(){
        session_start();
        if (!isset($_SESSION['tipo'])) {
            header("Location: ../index.php");
        }
        elseif ($_SESSION['tipo'] === "COMPANY") {
            header("Location: ../viewCompany/index.php");
        }
        elseif ($_SESSION['tipo'] === "WORKER") {
            header("Location: ../viewWorker/index.php");
        }
    }
    public static function sessionCompany(){
        session_start();
        if (!isset($_SESSION['tipo'])) {
            header("Location: ../index.php");
        }
        elseif ($_SESSION['tipo'] === "ROOT") {
            header("Location: ../viewRoot/index.php");
        }
        elseif ($_SESSION['tipo'] === "WORKER") {
            header("Location: ../viewWorker/index.php");
        }
    }
    public static function sessionWorker(){
        session_start();
        if (!isset($_SESSION['tipo'])) {
            header("Location: ../index.php");
        }
        elseif ($_SESSION['tipo'] === "ROOT") {
            header("Location: ../viewRoot/index.php");
        }
        elseif ($_SESSION['tipo'] === "COMPANY") {
            header("Location: ../viewCompany/index.php");
        }
    }
}