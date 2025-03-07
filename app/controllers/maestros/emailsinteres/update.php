<?php
include('../../../../app/config.php');

$id_emailinteres = $_POST['id_emailinteres'];
$nombre_ei = $_POST['nombre_ei'];
$email_ei = $_POST['email_ei'];
$telefono_ei = $_POST['telefono_ei'];

$sentencia = $pdo->prepare("UPDATE emailsinteres 
                            SET nombre_ei = :nombre_ei, 
                                email_ei = :email_ei, 
                                telefono_ei = :telefono_ei 
                            WHERE id_emailinteres = :id_emailinteres");

$sentencia->bindParam(':nombre_ei', $nombre_ei);
$sentencia->bindParam(':email_ei', $email_ei);
$sentencia->bindParam(':telefono_ei', $telefono_ei);
$sentencia->bindParam(':id_emailinteres', $id_emailinteres);

if ($sentencia->execute()) {
    session_start();
    $_SESSION['mensaje'] = "Contacto de interés actualizado correctamente";
    $_SESSION['icono'] = 'success';
    header('Location: ' . $URL . '/admin/maestros/varios');
} else {
    session_start();
    $_SESSION['mensaje'] = "Error: No se pudo actualizar el contacto";
    $_SESSION['icono'] = 'warning';
    header('Location: ' . $URL . '/admin/maestros/varios');
}
?>