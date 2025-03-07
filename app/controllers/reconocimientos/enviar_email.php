<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../emails/Exception.php';
require '../emails/PHPMailer.php';
require '../emails/SMTP.php';
include('../../../app/config.php');

$id_reconocimiento = $_POST['id_reconocimiento'];
$nombre_tr = $_POST['nombre_tr'];
$dni_tr = $_POST['dni_tr'];
$categoria_tr = $_POST['categoria_tr'];
$centro_tr = $_POST['centro_tr'];
$razonsocial_emp = $_POST['razonsocial_emp'];
$destinatario = $_POST['destinatario'];
$anotaciones_crm = $_POST['anotaciones_crm'];
$solicitudcita_rm = $fecha;


$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = 0;                      // Desactivar salida de depuración
    $mail->isSMTP();                            // Usar SMTP
    $mail->Host       = 'smtp.gmail.com';       // Servidor SMTP de Gmail
    $mail->SMTPAuth   = true;                   // Habilitar autenticación SMTP
    $mail->Username   = 'prevenciontrasmapi@gmail.com';    // Tu dirección de correo Gmail
    $mail->Password   = 'chft mdjo ewph nvjo';           // Tu contraseña o App Password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Cifrado TLS
    $mail->Port       = 587;                    // Puerto SMTP de Gmail

    // Destinatarios
    $mail->setFrom('prevenciontrasmapi@gmail.com', 'Prevencion Trasmapi');
    $mail->addAddress($destinatario);
    $mail->addAddress('prevencion@trasmapi.com'); // Si deseas agregar más destinatarios

        // Dirección para recibir respuestas
        $mail->addReplyTo('prevencion@trasmapi.com', 'Prevencion Trasmapi.com - hsbase');


    //Content
    $mail->isHTML(true);
    $mail->CharSet = 'UTF-8';                             //Set email format to HTML
    $mail->Subject = "SOLICITUD CITA RECONOCIMIENTO MÉDICO - $razonsocial_emp";
    $mail->Body    = "<html>
<body>
<p style='font-size:16px; font-weight:normal;'>Buenos días,</p>
<p style='font-size:14px; font-weight:normal;'>Agradezco que nos den cita para el/la trabajador/a:</p>
<p style='font-size:14px; font-weight:normal;'>
    EMPRESA: <b>$razonsocial_emp</b> <br>
    NOMBRE TRABAJADOR/A: <b>$nombre_tr</b> <br>
    DNI: <b>$dni_tr</b> <br>
    Puesto: <b>$categoria_tr</b> <br>
    Centro de trabajo: <b>$centro_tr</b> <br>
</p>
<p style='font-size:14px; font-weight:normal;'>Anotaciones/restricciones: <b>$anotaciones_crm</b></p>
<p style='font-size:14px; font-weight:normal;'>Quedo a vuestra disposición para cualquier duda o aclaración.</p>
<p style='font-size:14px; font-weight:normal;'>Un saludo,</p>
</body>
</html>";

    $mail->send();
    $sentencia = $pdo->prepare("UPDATE reconocimientos SET cita_rm ='1', solicitudcita_rm=:solicitudcita_rm WHERE id_reconocimiento=:id_reconocimiento");

    $sentencia->bindParam(':id_reconocimiento', $id_reconocimiento);
    $sentencia->bindParam(':solicitudcita_rm', $solicitudcita_rm);
    $sentencia->execute();

    session_start();

    $_SESSION['mensaje'] = "Email para cita de reconocimiento médico enviado";
    $_SESSION['icono'] = "success";
    header('Location: ' . $URL . '/admin/reconocimientos/index.php');
} catch (Exception $e) {
    echo "Error al enviar el email: {$mail->ErrorInfo}";
}
