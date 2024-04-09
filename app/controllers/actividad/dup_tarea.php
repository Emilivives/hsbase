<?php

include('../../../app/config.php');

$id_tarea = $_GET['id_tarea'];
$id_proyecto = $_GET['id_proyecto'];

$query = "SELECT MAX(id_tarea) FROM ag_tareas";


$sentencia = $pdo->prepare("INSERT INTO ag_tareas (id_tarea, id_proyecto, nombre_ta, fecha_ta, centro_ta, responsable_ta, prioridad_ta, estado_ta, programada_ta, detalles_ta, categoria_ta, accionprl_ta) 
SELECT NULL, id_proyecto, nombre_ta, fecha_ta, centro_ta, responsable_ta, prioridad_ta, estado_ta, programada_ta, detalles_ta, categoria_ta, accionprl_ta 
FROM ag_tareas WHERE id_tarea = $id_tarea");

$sentencia->execute();

session_start();
$_SESSION['mensaje'] = "Se duplico la tarea de prevención correctamente";
$_SESSION['icono'] = "success";
header('Location: ' . $URL .'/admin/actividad/show.php?id_proyecto='.$id_proyecto.'');
