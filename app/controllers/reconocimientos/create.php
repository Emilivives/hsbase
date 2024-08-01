<?php

include('../../../app/config.php');

$trabajador_rm = $_POST['trabajador_rm'];
$fecha_rm = $_POST['fecha_rm'];
$caducidad_rm = $_POST['caducidad_rm'];
$vigente_rm = $_POST['vigente_rm'];
$cita_rm = $_POST['cita_rm'];
$fechacita_rm = $_POST['fechacita_rm'];
$solicitudcita_rm = $_POST['solicitudcita_rm'];
$anotaciones_rm = $_POST['anotaciones_rm'];




$sentencia = $pdo->prepare("INSERT INTO reconocimientos (trabajador_rm, fecha_rm, caducidad_rm, vigente_rm, cita_rm, fechacita_rm, solicitudcita_rm, anotaciones_rm) 
VALUES(:trabajador_rm, :fecha_rm, :caducidad_rm, :vigente_rm, :cita_rm, :fechacita_rm, :solicitudcita_rm, :anotaciones_rm)");

$sentencia->bindParam(':trabajador_rm', $trabajador_rm);    
$sentencia->bindParam(':fecha_rm', $fecha_rm);
$sentencia->bindParam(':caducidad_rm', $caducidad_rm);
$sentencia->bindParam(':vigente_rm', $vigente_rm);
$sentencia->bindParam(':cita_rm', $cita_rm);
$sentencia->bindParam(':fechacita_rm', $fechacita_rm);
$sentencia->bindParam(':solicitudcita_rm', $solicitudcita_rm);
$sentencia->bindParam(':anotaciones_rm', $anotaciones_rm);

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
