<?php

include('../../../app/config.php');

$id_citarm = $_GET['id_citarm'];


$sentencia = $pdo->prepare("DELETE FROM citas_rm WHERE id_citarm = $id_citarm");

$sentencia->execute();

session_start();
$_SESSION['mensaje'] = "Se elimino el la cita correctamentee";
$_SESSION['icono'] = "success";
header('Location: ' . $URL .'/admin/reconocimientos/index.php');
