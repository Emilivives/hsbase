<?php

$sql = "SELECT acc.id_accion as id_accion, acc.codigo_acc as codigo_acc, acc.fecha_acc as fecha_acc, cen.nombre_cen as nombre_cen, acc.prioridad_acc as prioridad_acc, acc.descripcion_acc as descripcion_acc, acc.responsable_acc as responsable_acc,
 acc.detalleorigen_acc as detalleorigen_acc, acc.origen_acc as origen_acc, acc.fechaprevista_acc as fechaprevista_acc, acc.fecharea_acc as fecharea_acc, acc.fechaveri_acc as fechaveri_acc, acc.avance_acc as avance_acc, acc.estado_acc as estado_acc,
acc.accpropuesta_acc as accpropuesta_acc, acc.accrealizada_acc as accrealizada_acc, acc.seguimiento_acc as seguimiento_acc, acc.recursos_acc as recursos_acc, acc.imagen1_acc as imagen1_acc, acc.imagen2_acc as imagen2_acc
FROM ag_acciones as acc 
INNER JOIN centros as cen ON acc.centro_acc = cen.id_centro 
ORDER BY acc.fecha_acc DESC"; 

$query_accionprl_datos = $pdo->prepare($sql);
$query_accionprl_datos ->execute();
$accionprl_datos = $query_accionprl_datos->fetchAll(PDO::FETCH_ASSOC);
