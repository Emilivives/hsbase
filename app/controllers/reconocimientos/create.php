<?php

include('../../../app/config.php');

$id_trabajador = $_POST['id_trabajador'];
$fecha_rm = $_POST['fecha_rm'];
$caducidad_rm = $_POST['caducidad_rm'];
$vigente_rm = $_POST['vigente_rm'];
$cita_rm = $_POST['cita_rm'];
$anotaciones_rm = $_POST['anotaciones_rm'];




$sentencia = $pdo->prepare("INSERT INTO reconocimientos (id_trabajador, fecha_rm, caducidad_rm, vigente_rm, cita_rm, anotaciones_rm) 
VALUES(:id_trabajador, :fecha_rm, :caducidad_rm, :vigente_rm, :cita_rm, :anotaciones_rm)");

$sentencia->bindParam('id_trabajador', $id_trabajador);    
$sentencia->bindParam('fecha_rm', $fecha_rm);
$sentencia->bindParam('caducidad_rm', $caducidad_rm);
$sentencia->bindParam('vigente_rm', $vigente_rm);
$sentencia->bindParam('cita_rm', $cita_rm);
$sentencia->bindParam('anotaciones_rm', $anotaciones_rm);

if ($sentencia->execute()) {
session_start();
$_SESSION['mensaje'] = "Reconocimiento registrado correctamente";
$_SESSION['icono'] = 'success';
header('Location: ' . $URL . '/admin/reconocimientos');
} else {
session_start();
$_SESSION['mensaje'] = "Formacion NO creada";
$_SESSION['icono'] = 'warning';
header('Location: ' . $URL . '/admin/reconocimientos');
}


?>
