<?php

$sql = "SELECT ta.id_tarea as id_tarea, py.nombre_py as nombre_py, ta.nombre_ta as nombre_ta, ta.fecha_ta as fecha_ta, ta.fechareal_ta as fechareal_ta, cen.nombre_cen as nombre_cen, resp.nombre_resp as nombre_resp, 
ta.prioridad_ta as prioridad_ta, ta.estado_ta as estado_ta, ta.programada_ta as programada_ta, ta.detalles_ta as detalles_ta, ta.categoria_ta as categoria_ta, acc.codigo_acc as codigo_acc 
FROM ag_tareas as ta 
INNER JOIN ag_proyecto as py ON ta.id_proyecto = py.id_proyecto 
INNER JOIN centros as cen ON ta.centro_ta = cen.id_centro 
INNER JOIN responsables as resp ON ta.responsable_ta = resp.id_responsable 
INNER JOIN ag_acciones as acc ON ta.accionprl_ta = acc.id_accion
ORDER BY ta.fecha_ta DESC"; 

$query_tareas = $pdo->prepare($sql);
$query_tareas ->execute();
$tareas = $query_tareas->fetchAll(PDO::FETCH_ASSOC);
