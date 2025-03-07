<?php

include('../../../app/config.php');

$id = $_GET['id'];


$sentencia = $pdo->prepare("DELETE FROM er_equiposcentro WHERE id_equiposcentro = $id");

$sentencia->execute();

session_start();
$_SESSION['mensaje'] = "Se elimino el registro de acciones preventivas correctamente";
$_SESSION['icono'] = "success";
header('Location: ' . $URL . '/admin/evaluacion/index_equipos.php');
