<?php

$sql_puestocentro = "SELECT *, er.tipoevaluacion_er as tipoevaluacion_er,  cen.nombre_cen as nombre_cen FROM `er_puestocentro` as pc
        INNER JOIN er_evaluacion as er ON pc.evaluacion_pc = er.id_evaluacion
INNER JOIN centros as cen ON er.centro_er = cen.id_centro";


$query_puestocentro = $pdo->prepare($sql_puestocentro);
$query_puestocentro->execute();
$puestocentro_listado = $query_puestocentro->fetchAll(PDO::FETCH_ASSOC);
