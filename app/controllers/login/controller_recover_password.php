<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../emails/Exception.php';
require '../emails/PHPMailer.php';
require '../emails/SMTP.php';
include('../../../app/config.php');

// Obtenemos el correo enviado por el formulario
$email = $_POST['email'];

// Verificamos si el correo existe en la base de datos
$sql = "SELECT * FROM tb_usuarios WHERE email_usr = :email";
$query = $pdo->prepare($sql);
$query->execute(['email' => $email]);
$usuario = $query->fetch(PDO::FETCH_ASSOC);

if ($usuario) {
    // Generamos un token único y un enlace de recuperación
    $token = bin2hex(random_bytes(50)); // Genera un token aleatorio
    $url_recuperacion = $URL . "/app/controllers/login/new_password.php?token=$token";

    // Guardamos el token y su vencimiento (1 hora) en la base de datos
    $sql_update = "UPDATE tb_usuarios SET reset_token = :token, reset_expires = DATE_ADD(NOW(), INTERVAL 1 HOUR) WHERE email_usr = :email";
    $query_update = $pdo->prepare($sql_update);
    $query_update->execute(['token' => $token, 'email' => $email]);

    // Configuramos PHPMailer para enviar el correo
    $mail = new PHPMailer(true);
    try {
        $mail->SMTPDebug = 0;                      // Desactivar salida de depuración
        $mail->isSMTP();                            // Usar SMTP
        $mail->Host       = 'smtp.gmail.com';       // Servidor SMTP de Gmail
        $mail->SMTPAuth   = true;                   // Habilitar autenticación SMTP
        $mail->Username   = 'prevenciontrasmapi@gmail.com';    // Tu dirección de correo Gmail
        $mail->Password   = 'chft mdjo ewph nvjo';           // Tu contraseña o App Password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Cifrado TLS
        $mail->Port       = 587;                    // Puerto SMTP de Gmail
    
              // Configuración del correo
        $mail->setFrom('prevenciontrasmapi@gmail.com', 'Soporte - Recuperación de Contraseña');
        $mail->addAddress($email); // Correo del destinatario
        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8';
        $mail->Subject = 'HSBASE-Recuperación de Contraseña';
        $mail->Body = "
        <html>
        <body>
            <h4>Hola,</h4>
            <p>Hemos recibido una solicitud para restablecer la contraseña de tu cuenta. Si fuiste tú quien realizó la solicitud, haz clic en el siguiente enlace:</p>
            <p><a href='$url_recuperacion' style='background-color: #4CAF50; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;'>Restablecer Contraseña</a></p>
            <p>Este enlace es válido por 1 hora. Si no solicitaste el restablecimiento, puedes ignorar este correo.</p>
            <br>
            <p>Saludos,<br>Equipo de Soporte</p>
        </body>
        </html>";

        // Enviamos el correo
        $mail->send();
        echo "Correo enviado correctamente.";
    } catch (Exception $e) {
        echo "Error al enviar el correo: {$mail->ErrorInfo}";
    }
} else {
    echo "El correo electrónico no existe en el sistema.";
}
?>
