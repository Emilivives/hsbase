<?php

$sql = "SELECT acc.id_accion as id_accion, acc.codigo_acc as codigo_acc, acc.fecha_acc as fecha_acc, cen.nombre_cen as nombre_cen, 
emp.nombre_emp as nombre_emp, emp.razonsocial_emp as razonsocial_emp, emp.logo_emp as logo_emp, acc.prioridad_acc as prioridad_acc, acc.descripcion_acc as descripcion_acc, resp.nombre_resp as nombre_resp,
acc.detalleorigen_acc as detalleorigen_acc, acc.origen_acc as origen_acc, acc.fechaprevista_acc as fechaprevista_acc, acc.fecharea_acc as fecharea_acc, 
acc.fechaveri_acc as fechaveri_acc, acc.avance_acc as avance_acc, acc.estado_acc as estado_acc,
acc.accpropuesta_acc as accpropuesta_acc, acc.accrealizada_acc as accrealizada_acc, acc.seguimiento_acc as seguimiento_acc, acc.recursos_acc as recursos_acc
FROM ag_acciones as acc 
INNER JOIN centros as cen ON cen.id_centro = acc.centro_acc 
INNER JOIN empresa as emp ON emp.id_empresa = cen.empresa_cen 
INNER JOIN responsables as resp ON acc.responsable_acc = resp.id_responsable
ORDER BY acc.fecha_acc DESC"; 

$query_accionprl_datos = $pdo->prepare($sql);
$query_accionprl_datos ->execute();
$accionprl_datos = $query_accionprl_datos->fetchAll(PDO::FETCH_ASSOC);

