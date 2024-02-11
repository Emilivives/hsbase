<?php

include('../../../app/config.php');

$id_reconocimiento = $_GET['id_reconocimiento'];


$sentencia = $pdo->prepare("DELETE FROM reconocimientos WHERE id_reconocimiento = $id_reconocimiento");

$sentencia->execute();

session_start();
$_SESSION['mensaje'] = "Se elimino el registro de reconocimientos médicos correctamente";
$_SESSION['icono'] = "success";
header('Location: ' . $URL .'/admin/reconocimientos/index.php');
