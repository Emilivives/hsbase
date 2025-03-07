<?php

include('../../../app/config.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../emails/Exception.php';
require '../emails/PHPMailer.php';
require '../emails/SMTP.php';

$id_vac_generada = $_GET['id_vac_generada'];
$id_trabajador = $_GET['id_trabajador'];
$usuarionombre = USUARIO;

try {
    // Consulta para obtener datos del trabajador
    $sql = "SELECT tr.id_trabajador, tr.codigo_tr, tr.dni_tr, tr.nombre_tr, 
                   tr.sexo_tr, cen.nombre_cen, emp.nombre_emp, cat.nombre_cat 
            FROM trabajadores AS tr
            INNER JOIN categorias AS cat ON tr.categoria_tr = cat.id_categoria
            INNER JOIN centros AS cen ON tr.centro_tr = cen.id_centro
            INNER JOIN empresa AS emp ON cen.empresa_cen = emp.id_empresa
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

    // Consulta para obtener datos de vacaciones generadas
    $sql2 = "SELECT vgen.id_trabajador, vgen.id_centro, vgen.fecha_inicio, vgen.fecha_fin, 
                    vgen.concepto, vgen.regimen, vgen.generado 
             FROM vacacion_gen AS vgen
             WHERE vgen.id_vac_generada = :id_vac_generada";
    $query = $pdo->prepare($sql2);
    $query->bindParam(':id_vac_generada', $id_vac_generada, PDO::PARAM_INT);
    $query->execute();
    $vac_gen_datos = $query->fetch(PDO::FETCH_ASSOC);

    if (!$vac_gen_datos) {
        throw new Exception("No se encontraron datos de las vacaciones generadas.");
    }

    $fechain = date("d-m-Y", strtotime($vac_gen_datos['fecha_inicio']));
    $fechafin = date("d-m-Y", strtotime($vac_gen_datos['fecha_fin']));
    $regimen = htmlspecialchars($vac_gen_datos['regimen']);
    $generado = htmlspecialchars($vac_gen_datos['generado']);

    // Eliminar registro de vacaciones generadas
    $sentencia = $pdo->prepare("DELETE FROM vacacion_gen WHERE id_vac_generada = :id_vac_generada");
    $sentencia->bindParam(':id_vac_generada', $id_vac_generada, PDO::PARAM_INT);
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
    $mail->Subject = "GESTIÓN VACACIONES";
    $mail->Body = "<html><body>
                   <h5>Buenos días,</h5>
                   <p>Se ha eliminado un registro de vacaciones generadas:</p>
                   <p><strong>Trabajador:</strong> $nombre_tr - <strong>DNI:</strong> $dni_tr<br>
                   <strong>Puesto:</strong> $categoria_tr</p>
   <p>Detalles:</p> 
                     <p><strong>Fecha inicio:</strong> $fechain - <strong>Fecha fin:</strong> $fechafin<br>
                    <strong>Generado:</strong> $generado dias (Regimen: $regimen)
                   <br>
 <strong>Usuario:</strong> $usuarionombre</p>


                   <p>Quedamos a su disposición para cualquier consulta.</p>
                   </body></html>";

    $mail->send();

    session_start();
    $_SESSION['mensaje'] = "Se elimino el registro de vacaciones correctamente";
    $_SESSION['icono'] = "success";
    header('Location: ' . $URL . '/admin/vacaciones/detalles_trabajador.php?id_trabajador=' . $id_trabajador);
    exit();
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
