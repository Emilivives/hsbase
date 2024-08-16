<?php

include('../../../app/config.php');

$codigo_er = $_POST['codigo_er'];
$nombre_er = $_POST['nombre_er'];
$tipoevaluacion_er = $_POST['tipoevaluacion_er'];
$fecha_er = $_POST['fecha_er'];
$centro_er = $_POST['centro_er'];
$responsable_er = $_POST['responsable_er'];



$sentencia = $pdo->prepare("INSERT INTO er_evaluacion (codigo_er, nombre_er, tipoevaluacion_er, fecha_er, centro_er, responsable_er) 
VALUES(:codigo_er, :nombre_er, :tipoevaluacion_er, :fecha_er, :centro_er, :responsable_er) ");

$sentencia->bindParam('codigo_er', $codigo_er);    
$sentencia->bindParam('nombre_er', $nombre_er);
$sentencia->bindParam('tipoevaluacion_er', $tipoevaluacion_er);
$sentencia->bindParam('fecha_er', $fecha_er);
$sentencia->bindParam('centro_er', $centro_er);
$sentencia->bindParam('responsable_er', $responsable_er);



if ($sentencia->execute()) {
session_start();
$ultimotr = $pdo->lastInsertId();
$_SESSION['mensaje'] = "Evaluacion registrada correctamente";
$_SESSION['icono'] = 'success';
header('Location: ' . $URL . "/admin/pruebas/index.php");
} else {
session_start();
$_SESSION['mensaje'] = "Evaluacion NO registrado";
$_SESSION['icono'] = 'warning';
header('Location: ' . $URL . '/admin/pruebas/index.php');
}


?>
