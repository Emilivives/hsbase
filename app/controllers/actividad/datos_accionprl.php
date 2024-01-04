<?php

$sql = "SELECT acc.id_accion as id_accion, acc.codigo_acc as codigo_acc, acc.fecha_acc as fecha_acc, cen.nombre_cen as nombre_cen, acc.descripcion_acc as descripcion_acc, acc.responsable_acc as responsable_acc, 
acc.medida_acc as medida_acc, acc.fechaprevista_acc as fechaprevista_acc, acc.fecharea_acc as fecharea_acc, acc.fechaveri_acc as fechaveri_acc, acc.avance_acc as avance_acc, acc.estado_acc as estado_acc,
acc.accpropuesta_acc as accpropuesta_acc, acc.accrealizada_acc as accrealizada_acc, acc.seguimiento_acc as seguimiento_acc, acc.recursos_acc as recursos_acc, acc.imagen1_acc as imagen1_acc, acc.imagen2_acc as imagen2_acc,
FROM ag_acciones as acc 
INNER JOIN centros as cen ON acc.centro_acc = cen.id_centro 
WHERE id_accion = $id_accion"; 

$query_accionprl_datos = $pdo->prepare($sql);
$query_accionprl_datos ->execute();
$accionprl = $query_accionprl_datos->fetchAll(PDO::FETCH_ASSOC);


foreach ($accionprl_datos as $accionprl_dato) {
    $codigo_acc = $accionprl_dato['codigo_acc'];
    $fecha_acc = $accionprl_dato['fecha_acc'];
    $fecha_ta = $accionprl_dato['fecha_ta'];
    $nombre_cen = $accionprl_dato['nombre_cen'];
    $descripcion_acc = $accionprl_dato['descripcion_acc'];
    $responsable_acc = $accionprl_dato['responsable_acc'];
    $medida_acc = $accionprl_dato['medida_acc'];
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
