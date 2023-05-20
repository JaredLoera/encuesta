<?php 
class login{
    public static function iniciarSession($conexion,$correo){
        $sql = "SELECT * FROM company WHERE correo = '$correo'";
        $sentencia = $conexion->query($sql);
        $resultado = $sentencia->fetch(PDO::FETCH_OBJ);
        if (!$resultado) {
            $sql = "SELECT * FROM user WHERE correo = '$correo'";
            $sentencia = $conexion->query($sql);
            $resultado = $sentencia->fetch(PDO::FETCH_OBJ);
            if (!$resultado) {
                $sql = "SELECT * FROM userRoot WHERE correo = '$correo'";
                $sentencia = $conexion->query($sql);
                $resultado = $sentencia->fetch(PDO::FETCH_OBJ);
                if (!$resultado) {
                    ?>
                    <div class="alert alert-danger mt-5" role="alert">
                        <?php echo "Usuario o contraseña incorrectos";?>
                    </div>
                    <?php
                }else{
                    session_start();
                    $_SESSION['id'] = $resultado->id;
                    $_SESSION['nombre'] = $resultado->nombre;
                    $_SESSION['correo'] = $resultado->correo;
                    $_SESSION['tipo'] = "ROOT";
                    header("Location: viewRoot/index.php");
                }
              
            }else{
                session_start();
                $_SESSION['id'] = $resultado->id;
                $_SESSION['nombre'] = $resultado->nombre;
                $_SESSION['correo'] = $resultado->correo;
                $_SESSION['rfc'] = $resultado->rfc;
                $_SESSION['tipo'] = "WORKER";
                header("Location: viewWorker/index.php");
            }
        }else{
            session_start();
            $_SESSION['id'] = $resultado->id;
            $_SESSION['nombre'] = $resultado->nombre;
            $_SESSION['regimen'] = $resultado->refimenFiscal;
            $_SESSION['domicilio'] = $resultado->domicilio;
            $_SESSION['correo'] = $resultado->correo;
            $_SESSION['pass'] = $resultado->pass;
            $_SESSION['tipo'] = "COMPANY";
            header("Location: viewCompany/index.php");
        }
    }
   public static function cerrarSession(){
        session_start();    
        session_unset();
        session_destroy();
        header("Location: ../index.php");
    }
    public static function session(){
        session_start();
        if (isset($_SESSION['tipo'])) {
            header("Location: index.php");
        }elseif ($_SESSION['tipo'] == "COMPANY") {
            header("Location: ../viewCompany/index.php");
        }
        elseif ($_SESSION['tipo'] == "WORKER") {
            header("Location: ../viewWorker/index.php");
        }
        elseif ($_SESSION['tipo'] == "ROOT") {
            header("Location: ../viewRoot/index.php");
        }
        else{
            header("Location: ../index.php");
        }
    }
}