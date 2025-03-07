<?php
session_start();
include('../../../app/config.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../emails/Exception.php';
require '../emails/PHPMailer.php';
require '../emails/SMTP.php';

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['sesion_email'])) {
    header('Location: ' . $URL . '/login.php');
    exit();
}

// Verificar si el usuario tiene permiso para eliminar (ADMINISTRADOR o USUARIO_RRHH)
if ($_SESSION['perfil_usr'] !== 'ADMINISTRADOR' && $_SESSION['perfil_usr'] !== 'USUARIO_RRHH') {
    header('Location: ' . $URL . '/admin/acceso_nopermitido.php');
    exit();
}

$id_vac_consumida = $_GET['id_vac_consumida'];
$id_trabajador = $_GET['id_trabajador'];
$usuarionombre = $_SESSION['sesion_email'];

try {
    // Consulta para obtener datos del trabajador
    $sql = "SELECT tr.id_trabajador, tr.nombre_tr, tr.dni_tr, cat.nombre_cat 
            FROM trabajadores AS tr
            INNER JOIN categorias AS cat ON tr.categoria_tr = cat.id_categoria
            WHERE tr.id_trabajador = :id_trabajador";
    $query = $pdo->prepare($sql);
    $query->bindParam(':id_trabajador', $id_trabajador, PDO::PARAM_INT);
    $query->execute();
    $trabajador_datos = $query->fetch(PDO::FETCH_ASSOC);

    if (!$trabajador_datos) {
        throw new Exception("No se encontraron datos del trabajador.");
    }

    $nombre_tr = htmlspecialchars($trabajador_datos['nombre_tr']);
    $dni_tr = htmlspecialchars($trabajador_datos['dni_tr']);
    $categoria_tr = htmlspecialchars($trabajador_datos['nombre_cat']);

    // Consulta para obtener datos de la vacación consumida
    $sql2 = "SELECT fecha_inicio, fecha_fin, consumido 
             FROM vacacion_con 
             WHERE id_vac_consumida = :id_vac_consumida";
    $query = $pdo->prepare($sql2);
    $query->bindParam(':id_vac_consumida', $id_vac_consumida, PDO::PARAM_INT);
    $query->execute();
    $vac_con_datos = $query->fetch(PDO::FETCH_ASSOC);

    if (!$vac_con_datos) {
        throw new Exception("No se encontraron datos de la vacación consumida.");
    }

    $fechain = date("d-m-Y", strtotime($vac_con_datos['fecha_inicio']));
    $fechafin = date("d-m-Y", strtotime($vac_con_datos['fecha_fin']));
    $dias_consumidos = htmlspecialchars($vac_con_datos['consumido']);

    // Eliminar el registro
    $sentencia = $pdo->prepare("DELETE FROM vacacion_con WHERE id_vac_consumida = :id_vac_consumida");
    $sentencia->bindParam(':id_vac_consumida', $id_vac_consumida, PDO::PARAM_INT);
    $sentencia->execute();

    // Enviar correo
    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'prevenciontrasmapi@gmail.com';
    $mail->Password = 'chft mdjo ewph nvjo';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    $mail->setFrom('prevencion@trasmapi.com', 'Prevencion Trasmapi');
    $mail->addAddress('prevencion@trasmapi.com');

    $mail->isHTML(true);
    $mail->CharSet = 'UTF-8';
    $mail->Subject = "GESTIÓN VACACIONES - Eliminación";
    $mail->Body = "<html><body>
                   <h5>Buenos días,</h5>
                   <p>Se ha eliminado un registro de vacaciones consumidas:</p>
                   <p><strong>Trabajador:</strong> $nombre_tr - <strong>DNI:</strong> $dni_tr<br>
                   <strong>Puesto:</strong> $categoria_tr</p>
                   <p>Detalles:</p>
                   <p><strong>Fecha inicio:</strong> $fechain - <strong>Fecha fin:</strong> $fechafin<br>
                   <strong>Días consumidos:</strong> $dias_consumidos</p>
                   <p><strong>Usuario:</strong> $usuarionombre</p>
                   <p>Quedamos a su disposición para cualquier consulta.</p>
                   </body></html>";

    $mail->send();

    $_SESSION['mensaje'] = "Se eliminó el registro correctamente";
    $_SESSION['icono'] = "success";
    header('Location: ' . $URL . '/admin/vacaciones/detalles_trabajador.php?id_trabajador=' . $id_trabajador);
    exit();
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
