<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../emails/Exception.php';
require '../emails/PHPMailer.php';
require '../emails/SMTP.php';

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
    $mail->Body    = "<html>
    <body>
    <h5>
    <br>
    Buenos dias,
 <br> <br>
    Agradezco que nos den cita para el trabajador:  
     <br><br>
    EMPRESA:$razonsocial_emp
    <br>
    NOMBRE TRABAJADOR: $nombre_tr
    <br>
    DNI: $dni_tr
    <br>
    Puesto: $categoria_tr
<br><br>
**Anotaciones/restricciones: $anotaciones_crm **
<br><br><br>

Emili Vives Garcia
Depto. PRL 





    </body>
    </html>";

    $mail->send();
    echo 'Email enviado correctamente';
} catch (Exception $e) {
    echo "Error al enviar el email: {$mail->ErrorInfo}";
}
