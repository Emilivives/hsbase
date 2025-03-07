<?php

include('../../../config.php');

$nombre_ifd = $_POST['nombre_ifd'];
$tipoinfo_ifd = $_POST['tipoinfo_ifd'];
$fecha_ifd = $_POST['fecha_ifd'];
$vigente_ifd = $_POST['vigente_ifd'];





$sentencia = $pdo->prepare("INSERT INTO info_documentos (nombre_ifd, tipoinfo_ifd, fecha_ifd, vigente_ifd) 
VALUES(:nombre_ifd, :tipoinfo_ifd, :fecha_ifd, :vigente_ifd)");

$sentencia->bindParam(':nombre_ifd', $nombre_ifd);    
$sentencia->bindParam(':tipoinfo_ifd', $tipoinfo_ifd);
$sentencia->bindParam(':fecha_ifd', $fecha_ifd);
$sentencia->bindParam(':vigente_ifd', $vigente_ifd);


if ($sentencia->execute()) {
session_start();
$_SESSION['mensaje'] = "Documento informativo registrado correctamente";
$_SESSION['icono'] = 'success';
header('Location: ' . $URL . '/admin/maestros/documentos');
} else {
session_start();
$_SESSION['mensaje'] = "Formacion NO creada";
$_SESSION['icono'] = 'warning';
header('Location: ' . $URL . '/admin/maestros/documentos');
}


?>
