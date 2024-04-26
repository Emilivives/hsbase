<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../emails/Exception.php';
require '../emails/PHPMailer.php';
require '../emails/SMTP.php';
include('../../../app/config.php');

$nombre_tr = $_POST['nombre_tr'];
$dni_tr = $_POST['dni_tr'];
$categoria_tr = $_POST['categoria_tr'];
$centro_tr = $_POST['centro_tr'];
$razonsocial_emp = $_POST['razonsocial_emp'];
$destinatario = $_POST['destinatario'];
$anotaciones_crm = $_POST['anotaciones_crm'];




$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = 0;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp-mail.outlook.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'prevencion@trasmapi.com';                     //SMTP username
    $mail->Password   = 'S3rcomis@2020/*';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            //Enable implicit TLS encryption
    $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('prevencion@trasmapi.com', 'Prevencion Trasmapi');
    $mail->addAddress($destinatario);     //Add a recipient
    $mail->addAddress('prevenci@trasmapi.com');     //Add a recipient

    //Name is optional


    //Content
    $mail->isHTML(true);
    $mail->CharSet = 'UTF-8';                             //Set email format to HTML
    $mail->Subject = 'SOLICITUD CITA RECONOCIMIENTO MÉDICO';
    $mail->Body    = "<html>
    <body>
    <h4>
    <br>
   <b> Buenos dias,</b>
 <br> <br>
    Agradezco que nos den cita para el trabajador:  
     <br><br>
    <h5>EMPRESA: $razonsocial_emp 
    <br> <br>
    NOMBRE TRABAJADOR: $nombre_tr
    <br>
    DNI: $dni_tr
    <br>
    Puesto: $categoria_tr
    <br>
    Centro de trabajo: $centro_tr
<br><br>
**Anotaciones/restricciones: $anotaciones_crm **
<br><br><br>
Quedo a vuestra disposición para cualquier duda o aclaración.
<br><br>
Un saludo,
<br>

    </body>
    </html>";

    $mail->send();
    session_start();
    $_SESSION['mensaje'] = "Email para cita de reconocimiento médico enviado";
    $_SESSION['icono'] = "success";
    header('Location: ' . $URL . '/admin/reconocimientos/index.php');
} catch (Exception $e) {
    echo "Error al enviar el email: {$mail->ErrorInfo}";
}
