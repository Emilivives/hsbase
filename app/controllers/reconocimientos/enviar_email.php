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
    $mail->addAddress('emilivives@gmail.com', 'User');     //Add a recipient
    $mail->addAddress('prevencion@trasmapi.com');               //Name is optional

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Asunto';
    $mail->Body    = "<html>
    <body>
    <h3>Destinatario: $destinatario</h3>
    <br>
    <br>
    <h3>Centro: $centro_tr</h3>
    <br>
    <br>
        <h3>Nombre: $nombre_tr</h3>
        <br>
        <h3>Apellido: $dni_tr</h3>
        <br>
        <br>
        <h3>Correo: $categoria_tr</h3>
        <br>
        <br>
        <h3>Mensaje: </h3>
        <p>$anotaciones_crm</p>
    </body>
    </html>";

    $mail->send();
    echo 'Email enviado correctamente';
} catch (Exception $e) {
    echo "Error al enviar el email: {$mail->ErrorInfo}";
}
