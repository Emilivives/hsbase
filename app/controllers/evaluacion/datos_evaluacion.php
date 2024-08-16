<?php

$sql = "SELECT *, er.codigo_er as codigo_er, er.nombre_er as nombre_er, er.tipoevaluacion_er as tipoevaluacion_er, 
er.fecha_er as fecha_er, cen.nombre_cen as nombre_cen, res.nombre_resp as nombre_resp 
FROM `er_evaluacion` as er 
INNER JOIN centros as cen ON er.centro_er = cen.id_centro
INNER JOIN responsables as res ON er.responsable_er = res.id_responsable 
WHERE id_evaluacion = $id_evaluacion";

$query = $pdo->prepare($sql);
$query->execute();
$evaluacion_datos = $query->fetchAll(PDO::FETCH_ASSOC);



foreach ($evaluacion_datos as $evaluacion_dato) {
    $codigo_er = $evaluacion_dato['codigo_er'];
    $nombre_er = $evaluacion_dato['nombre_er'];
    $tipoevaluacion_er = $evaluacion_dato['tipoevaluacion_er'];
    $fecha_er = $evaluacion_dato['fecha_er'];
    $nombre_cen = $evaluacion_dato['nombre_cen'];
    $nombre_resp = $evaluacion_dato['nombre_resp'];
     

}
