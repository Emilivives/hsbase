<?php

include('../../../app/config.php');

$id_accion = $_GET['id_accion'];


$sentencia = $pdo->prepare("DELETE FROM ag_acciones WHERE id_accion = $id_accion");

$sentencia->execute();

session_start();
$_SESSION['mensaje'] = "Se elimino el registro de acciones preventivas correctamente";
$_SESSION['icono'] = "success";
header('Location: ' . $URL .'/admin/accionprl/index.php');
