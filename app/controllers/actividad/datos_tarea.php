<?php

$sql = "SELECT *, py.nombre_py as nombre_py, ta.nombre_ta as nombre_ta, ta.fecha_ta as fecha_ta, ta.fechareal_ta as fechareal_ta, cen.nombre_cen as nombre_cen, resp.nombre_resp as nombre_resp, 
ta.prioridad_ta as prioridad_ta, ta.estado_ta as estado_ta, ta.programada_ta as programada_ta, ta.detalles_ta as detalles_ta, ta.categoria_ta as categoria_ta, acc.codigo_acc as codigo_acc 
FROM ag_tareas as ta 
INNER JOIN ag_proyecto as py ON ta.id_proyecto = py.id_proyecto 
INNER JOIN centros as cen ON ta.centro_ta = cen.id_centro 
INNER JOIN responsables as resp ON ta.responsable_ta = resp.id_responsable 
INNER JOIN ag_acciones as acc ON ta.accionprl_ta = acc.id_accion WHERE id_tarea = $id_tarea";

$query = $pdo->prepare($sql);
$query->execute();
$tareas = $query->fetchAll(PDO::FETCH_ASSOC);

foreach ($tareas as $tarea) {
    $id_proyecto = $tarea['nombre_py'];
    $nombre_ta = $tarea['nombre_ta'];
    $fecha_ta = $tarea['fecha_ta'];
    $fechareal_ta = $tarea['fechareal_ta'];
    $centro_ta = $tarea['nombre_cen'];
    $responsable_ta = $tarea['nombre_resp'];
    $prioridad_ta = $tarea['prioridad_ta'];
    $estado_ta = $tarea['estado_ta'];
    $programada_ta = $tarea['programada_ta'];
    $detalles_ta = $tarea['detalles_ta'];
    $categoria_ta = $tarea['categoria_ta'];
    $accionprl_ta = $tarea['codigo_acc'];

}
