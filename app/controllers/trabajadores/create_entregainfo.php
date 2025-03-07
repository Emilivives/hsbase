<?php

include('../../../app/config.php');

$id_trabajador = $_POST['id_trabajador'];
$id_infodoc = $_POST['id_infodoc'];
$fechaentrega = $_POST['fechaentrega'];



$sentencia = $pdo->prepare("INSERT INTO info_entregainfo (id_trabajador, id_infodoc, fechaentrega) 
VALUES(:id_trabajador, :id_infodoc, :fechaentrega)");

$sentencia->bindParam('id_trabajador', $id_trabajador);    
$sentencia->bindParam('id_infodoc', $id_infodoc);
$sentencia->bindParam('fechaentrega', $fechaentrega);


if ($sentencia->execute()) {
session_start();
$_SESSION['mensaje'] = "Formacion registrada correctamente";
$_SESSION['icono'] = 'success';
header('Location: ' . $URL . "/admin/trabajadores/trabajadorshow.php?id_trabajador=".$id_trabajador);
} else {
session_start();
$_SESSION['mensaje'] = "Formacion NO creada";
$_SESSION['icono'] = 'warning';
header('Location: ' . $URL . "/admin/trabajadores/trabajadorshow.php?id_trabajador=".$id_trabajador);
}


?>
