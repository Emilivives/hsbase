<?php

include('../../../app/config.php');

$evaluacion_pc = $_POST['evaluacion_pc'];
$puestoarea_pc = $_POST['puestoarea_pc'];
$descripcion_pc = $_POST['descripcion_pc'];

$sentencia = $pdo->prepare("INSERT INTO er_puestocentro (evaluacion_pc, puestoarea_pc, descripcion_pc) 
VALUES(:evaluacion_pc, :puestoarea_pc, :descripcion_pc) ");

$sentencia->bindParam('evaluacion_pc', $evaluacion_pc);
$sentencia->bindParam('puestoarea_pc', $puestoarea_pc);
$sentencia->bindParam('descripcion_pc', $descripcion_pc);



if ($sentencia->execute()) {
session_start();
$ultimotr = $pdo->lastInsertId();
$_SESSION['mensaje'] = "Puesto/area registrado correctamente";
$_SESSION['icono'] = 'success';
header('Location: ' . $URL . "/admin/pruebas/show_er.php?id_evaluacion=$evaluacion_pc");
} else {
session_start();
$_SESSION['mensaje'] = "Evaluacion NO registrado";
$_SESSION['icono'] = 'warning';
header('Location: ' . $URL . "/admin/pruebas/show_er.php?id_evaluacion=$evaluacion_pc");
}


?>
