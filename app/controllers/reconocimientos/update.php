<?php

include('../../../app/config.php');

$id_citarm = $_POST['id_citarm'];
$id_reconocimiento = $_POST['id_reconocimiento'];
$trabajador_rm = $_POST['trabajador_rm'];
$fecha_rm = $_POST['fecha_rm'];
$caducidad_rm = $_POST['caducidad_rm'];
$vigente_rm = $_POST['vigente_rm'];
$cita_rm = $_POST['cita_rm'];
$anotaciones_rm = $_POST['anotaciones_rm'];




$sentencia = $pdo->prepare("UPDATE reconocimientos SET id_reconocimiento=:id_reconocimiento, trabajador_rm=:trabajador_rm, fecha_rm=:fecha_rm, caducidad_rm=:caducidad_rm, 
vigente_rm=:vigente_rm, cita_rm=:cita_rm, anotaciones_rm=:anotaciones_rm WHERE id_reconocimiento=:id_reconocimiento");

$sentencia->bindParam(':id_reconocimiento', $id_reconocimiento);    
$sentencia->bindParam(':trabajador_rm', $trabajador_rm);    
$sentencia->bindParam(':fecha_rm', $fecha_rm);
$sentencia->bindParam(':caducidad_rm', $caducidad_rm);
$sentencia->bindParam(':vigente_rm', $vigente_rm);
$sentencia->bindParam(':cita_rm', $cita_rm);
$sentencia->bindParam(':anotaciones_rm', $anotaciones_rm);

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