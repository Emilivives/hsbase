<?php

include('../../../app/config.php');

$id_tarea = $_GET['id_tarea'];
$id_proyecto = $_GET['id_proyecto'];

$sentencia = $pdo->prepare("DELETE FROM ag_tareas WHERE id_tarea = $id_tarea");

$sentencia->execute();

session_start();
$_SESSION['mensaje'] = "Se elimino el tarea de prevención correctamente";
$_SESSION['icono'] = "success";
header('Location: ' . $URL .'/admin/actividad/show.php?id_proyecto='.$id_proyecto.'');
