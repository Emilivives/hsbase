<?php

include('../../../app/config.php');

$id_puestocentro = $_GET['id_puestocentro'];
$id_evaluacion = $_GET['id_evaluacion'];

$sentencia = $pdo->prepare("DELETE FROM er_puestocentro WHERE id_puestocentro = $id_puestocentro");

$sentencia->execute();

session_start();
$_SESSION['mensaje'] = "Se elimino el registro de acciones preventivas correctamente";
$_SESSION['icono'] = "success";
header('Location: ' . $URL .'/admin/evaluacion/show_er.php?id_evaluacion='.$id_evaluacion.'');
