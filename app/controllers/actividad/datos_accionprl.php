<?php

$sql = "SELECT *, acc.codigo_acc as codigo_acc, acc.fecha_acc as fecha_acc, cen.nombre_cen as nombre_cen, acc.prioridad_acc as prioridad_acc, acc.descripcion_acc as descripcion_acc, 
acc.responsable_acc as responsable_acc, acc.detalleorigen_acc as detalleorigen_acc, acc.origen_acc as origen_acc, acc.fechaprevista_acc as fechaprevista_acc, acc.fecharea_acc as fecharea_acc, 
acc.fechaveri_acc as fechaveri_acc, acc.avance_acc as avance_acc, acc.estado_acc as estado_acc, acc.accpropuesta_acc as accpropuesta_acc, 
acc.accrealizada_acc as accrealizada_acc, acc.seguimiento_acc as seguimiento_acc, acc.recursos_acc as recursos_acc
FROM ag_acciones as acc 
INNER JOIN centros as cen ON acc.centro_acc = cen.id_centro 
INNER JOIN responsables as resp ON acc.responsable_acc = resp.id_responsable 
WHERE id_accion = $id_accion"; 

$query_accionprl_datos = $pdo->prepare($sql);
$query_accionprl_datos ->execute();
$accionprl_datos = $query_accionprl_datos->fetchAll(PDO::FETCH_ASSOC);


foreach ($accionprl_datos as $accionprl_dato) {
    $codigo_acc = $accionprl_dato['codigo_acc'];
    $fecha_acc = $accionprl_dato['fecha_acc'];
    $centro_acc = $accionprl_dato['nombre_cen'];
    $origen_acc = $accionprl_dato['origen_acc'];
    $detalleorigen_acc = $accionprl_dato['detalleorigen_acc'];
    $prioridad_acc = $accionprl_dato['prioridad_acc'];
    $descripcion_acc = $accionprl_dato['descripcion_acc'];
    $responsable_acc = $accionprl_dato['nombre_resp'];
    $fechaprevista_acc = $accionprl_dato['fechaprevista_acc'];
    $fechaprevista_acc = $accionprl_dato['fechaprevista_acc'];
    $fecharea_acc = $accionprl_dato['fecharea_acc'];
    $fechaveri_acc = $accionprl_dato['fechaveri_acc'];
    $avance_acc = $accionprl_dato['avance_acc'];
    $estado_acc = $accionprl_dato['estado_acc'];
    $accpropuesta_acc = $accionprl_dato['accpropuesta_acc'];
    $accrealizada_acc = $accionprl_dato['accrealizada_acc'];
    $seguimiento_acc = $accionprl_dato['seguimiento_acc'];
    $recursos_acc = $accionprl_dato['recursos_acc'];
    $imagen1_acc = $accionprl_dato['imagen1_acc'];
    $imagen2_acc = $accionprl_dato['imagen2_acc'];
}
