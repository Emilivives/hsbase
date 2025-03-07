<?php

include('../../../app/config.php');

$id_epi = $_GET['id_epi'];


$sentencia = $pdo->prepare("DELETE FROM inv_epis WHERE id_epi = $id_epi");

$sentencia->execute();

session_start();
$_SESSION['mensaje'] = "Se elimino el registro de epis correctamente";
$_SESSION['icono'] = "success";
header('Location: ' . $URL .'/admin/inventario/controlepis.php');
