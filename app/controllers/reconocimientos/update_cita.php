<?php

include('../../../app/config.php');

$id_citarm = $_POST['id_citarm'];
$fecha_crm = $_POST['fecha_crm'];
$anotaciones_crm = $_POST['anotaciones_crm'];




$sentencia = $pdo->prepare("UPDATE citas_rm SET id_citarm=:id_citarm, fecha_crm=:fecha_crm, anotaciones_crm=:anotaciones_crm WHERE id_citarm=:id_citarm");

$sentencia->bindParam(':id_citarm', $id_citarm);    
$sentencia->bindParam(':fecha_crm', $fecha_crm);
$sentencia->bindParam(':anotaciones_crm', $anotaciones_crm);

if ($sentencia->execute()) {
session_start();
$_SESSION['mensaje'] = "Reconocimiento actualizado correctamente";
$_SESSION['icono'] = 'success';
header('Location: ' . $URL . '/admin/reconocimientos');
} else {
session_start();
$_SESSION['mensaje'] = "reonocimiento NO actualizado";
$_SESSION['icono'] = 'warning';
header('Location: ' . $URL . '/admin/reconocimientos');
}


?>
