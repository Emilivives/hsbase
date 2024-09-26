<?php

include('../../../app/config.php');

$id_evaluacion = $_GET['id_evaluacion'];


$sentencia = $pdo->prepare("DELETE FROM er_evaluacion WHERE id_evaluacion = $id_evaluacion");

$sentencia->execute();

session_start();
$_SESSION['mensaje'] = "Se elimino el registro de acciones preventivas correctamente";
$_SESSION['icono'] = "success";
header('Location: ' . $URL .'/admin/evaluacion/index.php');
