<?php

$sql = "SELECT acc.id_actividad as id_actividad, acc.fecha_acc as fecha_acc, acc.horain_acc as horain_acc, acc.horafin_acc as horafin_acc, acc.responsable_acc as responsable_acc, 
acc.detalles_acc as detalles_acc
FROM ag_actividad as acc WHERE id_tarea = $id_tarea"; 

$query_actividades = $pdo->prepare($sql);
$query_actividades ->execute();
$actividades = $query_actividades->fetchAll(PDO::FETCH_ASSOC);
