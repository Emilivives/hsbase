<?php

include('../../../app/config.php');

$id_maquina = $_GET['id_maquina'];

$sentencia = $pdo->prepare("DELETE FROM inv_maquinaria WHERE id_maquina = $id_maquina");

$sentencia->execute();

session_start();
$_SESSION['mensaje'] = "Se elimino el tarea de prevención correctamente";
$_SESSION['icono'] = "success";
header('Location: ' . $URL .'/admin/inventario/controlmaquinas.php');
