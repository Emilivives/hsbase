<?php

include('../../../../app/config.php');

$nombre_tf = $_POST['nombre_tf'];
$duracion_tf = $_POST['duracion_tf'];
$validez_tf = $_POST['validez_tf'];
$detalles_tf = $_POST['detalles_tf'];
$normativa_tf = $_POST['normativa_tf'];


$sentencia = $pdo->prepare("INSERT INTO tipoformacion (nombre_tf, duracion_tf, validez_tf, detalles_tf, normativa_tf) 
VALUES(:nombre_tf, :duracion_tf, :validez_tf, :detalles_tf, :normativa_tf)");

$sentencia->bindParam('nombre_tf', $nombre_tf);    
$sentencia->bindParam('duracion_tf', $duracion_tf);
$sentencia->bindParam('validez_tf', $validez_tf);
$sentencia->bindParam('detalles_tf', $detalles_tf);
$sentencia->bindParam('normativa_tf', $normativa_tf);

if ($sentencia->execute()) {
session_start();
$_SESSION['mensaje'] = "Formacion registrada correctamente";
$_SESSION['icono'] = 'success';
header('Location: ' . $URL . '/admin/formacion/tipoformaciones.php');
} else {
session_start();
$_SESSION['mensaje'] = "Formacion NO creada";
$_SESSION['icono'] = 'warning';
header('Location: ' . $URL . '/admin/formacion/tipoformaciones.php');
}


?>

