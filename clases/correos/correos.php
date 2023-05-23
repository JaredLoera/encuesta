<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'configMailer/Exception.php';
require 'configMailer/PHPMailer.php';
require 'configMailer/SMTP.php';
require_once 'configMailer/configmail.inc.php';
class Mail{
   
    public PHPMailer $mail;
    function __construct()
    {
        $this->mail = new PHPMailer(true);                      //Enable verbose debug output
        $this->mail->isSMTP();                                  //Send using SMTP
        $this->mail->Host       = HOSTMAIL;                     //Set the SMTP server to send through
        $this->mail->SMTPAuth   = true;                         //Enable SMTP authentication
        $this->mail->Username   = USERMAIL;                     //SMTP username
        $this->mail->Password   = PASSMAIL;                     //SMTP password
        $this->mail->SMTPSecure = 'tls';                        //Enable implicit TLS encryption
        $this->mail->Port       = PORTSMTP;                     //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
        $this->mail->setFrom(USERMAIL, 'Mailer');
        $this->mail->setFrom(USERMAIL, 'EMPRESA');
        $this->mail->isHTML(true);  //Set email format to HTML
    }
    public function sendMailNewWorker(Worker $worker){
        try {
        $this->mail->addAddress($worker->get_correo());     // Add a recipient              
        $this->mail->Subject = 'Bienvenido a la empresa '.$worker->get_nombre() ;
        $this->mail->Body    = '<!doctype html>
                            <html lang="en">
                            <head>
                                <meta charset="utf-8">
                                <meta name="viewport" content="width=device-width, initial-scale=1">
                                <title>Bootstrap demo</title>
                                <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
                            </head>
                            <body>
                                <div class="container">
                                    <div class="row">
                                    <h1>Bienvendi@ '. $worker->get_nombre().'!</h1>
                                    <br>
                                    Tu correo es  '.$worker->get_correo().';
                                    <br>
                                    Tu contraseña es '.$worker->get_passNoHash().';
                                    </div>
                                </div>
                                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
                            </body>
                            </html>';
        $this->mail->send();
        } catch (Exception  $e) {
            echo "Message could not be sent. Mailer Error: {$this->mail->ErrorInfo}";
        }
    }
    public function sendMailNewCompany(company $company){
        try {
            $this->mail->addAddress($company->get_correo());    
            $this->mail->Subject = 'Empresa Cuenta '.$company->get_name();
            $this->mail->Body    = '<!doctype html>
                            <html lang="en">
                            <head>
                                <meta charset="utf-8">
                                <meta name="viewport" content="width=device-width, initial-scale=1">
                                <title>Bootstrap demo</title>
                                <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
                            </head>
                            <body>
                                <div class="container">
                                    <div class="row">
                                    <h1>Se a registrado la empresa '. $company->get_name().'!</h1>
                                    <br>
                                    El Correo de la empresa es  '.$company->get_correo().';
                                    <br>
                                    La contraseña con la que se registro '.$company->get_passNoHash().';
                                    </div>
                                </div>
                                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
                            </body>
                            </html>';
            $this->mail->send();
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$this->mail->ErrorInfo}";
        }
        
    }
}