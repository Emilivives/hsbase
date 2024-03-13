<?php

include('../../../app/config.php');

$id_proyecto = $_GET['id_proyecto'];


$sentencia = $pdo->prepare("DELETE FROM ag_proyecto WHERE id_proyecto = $id_proyecto");

$sentencia->execute();

session_start();
$_SESSION['mensaje'] = "Se elimino el proyecto de prevención correctamente";
$_SESSION['icono'] = "success";
header('Location: ' . $URL .'/admin/actividad/proyectos.php');
