<?php

include('../../../app/config.php');

$id_trabajador = $_GET['id_trabajador'];

$sentencia = $pdo->prepare("DELETE FROM trabajadores WHERE id_trabajador = $id_trabajador");

$sentencia->execute();

session_start();
$_SESSION['mensaje'] = "Se elimino el Trabajador correctamente";
$_SESSION['icono'] = "success";
header('Location: ' . $URL .'/admin/trabajadores');
