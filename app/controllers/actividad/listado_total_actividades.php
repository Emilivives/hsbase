<?php

$sql = "SELECT *, py.id_proyecto as id_proyecto, py.nombre_py as nombre_py, ta.nombre_ta as nombre_ta, cen.nombre_cen as nombre_cen
 FROM ag_actividad as acc
INNER JOIN ag_tareas as ta ON acc.id_tarea = ta.id_tarea
INNER JOIN centros as cen ON ta.centro_ta = cen.id_centro 
INNER JOIN ag_proyecto as py ON ta.id_proyecto = py.id_proyecto 
ORDER BY fecha_acc DESC
"; 

$query_total_actividades = $pdo->prepare($sql);
$query_total_actividades ->execute();
$total_actividades = $query_total_actividades->fetchAll(PDO::FETCH_ASSOC);
