<?php



$sql_evaluaciones = "SELECT er.id_evaluacion as id_evaluacion, er.codigo_er as codigo_er, er.nombre_er as nombre_er, er.tipoevaluacion_er as tipoevaluacion_er, 
er.fecha_er as fecha_er, cen.nombre_cen as nombre_cen, res.nombre_resp as nombre_resp 
FROM `er_evaluacion` as er 
INNER JOIN centros as cen ON er.centro_er = cen.id_centro
INNER JOIN responsables as res ON er.responsable_er = res.id_responsable ";

$query_evaluaciones = $pdo->prepare($sql_evaluaciones);
$query_evaluaciones->execute();
$evaluaciones_datos = $query_evaluaciones->fetchAll(PDO::FETCH_ASSOC);
