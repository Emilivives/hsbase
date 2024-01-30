<?php

include('../../../app/config.php');

$id_accidente = $_GET['id_accidente'];


$sentencia = $pdo->prepare("DELETE FROM accidentes WHERE id_accidente = $id_accidente");

$sentencia->execute();

session_start();
$_SESSION['mensaje'] = "Se elimino el registro de accidente correctamente";
$_SESSION['icono'] = "success";
header('Location: ' . $URL .'/admin/accidentes/index.php');
