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
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'emilivives@gmail.com';                     //SMTP username
    $mail->Password   = 'xapi vxtn rcvs ubaf';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('emilivives@gmail.com', 'Prevencion Trasmapi');
    $mail->addAddress($destinatario);     //Add a recipient
    //Name is optional


    //Content
    $mail->isHTML(true);
    $mail->CharSet = 'UTF-8';                             //Set email format to HTML
    $mail->Subject = 'SOLICITUD CITA RECONOCIMIENTO MÉDICO';
    $mail->addStringEmbeddedImage(file_get_contents('../../../public/img/trasmapi50.png'),'logo');
    $mail->addStringEmbeddedImage(file_get_contents('../../../public/img/LOGO-eslogan mini.jpg'),'hsbase');

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
**Anotaciones/restricciones: $anotaciones_crm **</h5>
<br><br><br>
Quedo a vuestra disposición para cualquier duda o aclaración.
<br><br>
Un saludo,
<br><br>

Emili Vives<br>
Prevención riesgos laborales<br></h4>
<h5>Muelle Pesquero, Varadero Ibiza s/n Piso 1 (antiguo Edificio Portuario)<br>
07800 Ibiza (Islas Baleares) <br>
Telf.	(+34) 971 87 63 37<br>
E-mail	prevencion@trasmapi.com <br>
Web	https://www.trasmapi.com <br>


<br><br>
<img src='cid:logo'>
<br>powered by </h5>
<img src='cid:hsbase'>

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
