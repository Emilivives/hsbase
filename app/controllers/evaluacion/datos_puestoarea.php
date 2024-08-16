<?php

$sql = "SELECT *, pc.evaluacion_pc as evaluacion_pc, pc.puestoarea_pc as puestoarea_pc, pc.descripcion_pc as descripcion_pc, 
cen.nombre_cen as nombre_cen, er.nombre_er as nombre_er, res.nombre_resp as nombre_resp
FROM `er_puestocentro` as pc 
INNER JOIN er_evaluacion as er ON pc.evaluacion_pc = er.id_evaluacion
INNER JOIN centros as cen ON er.centro_er = cen.id_centro
INNER JOIN responsables as res ON er.responsable_er = res.id_responsable 
WHERE id_puestocentro = $id_puestocentro";

$query = $pdo->prepare($sql);
$query->execute();
$puestoarea_datos = $query->fetchAll(PDO::FETCH_ASSOC);



foreach ($puestoarea_datos as $puestoarea_dato) {
    $evaluacion_pc = $puestoarea_dato['evaluacion_pc'];
    $puestoarea_pc = $puestoarea_dato['puestoarea_pc'];
    $descripcion_pc = $puestoarea_dato['descripcion_pc'];
    $nombre_cen = $puestoarea_dato['nombre_cen'];
    $nombre_cen = $puestoarea_dato['nombre_cen'];
    $nombre_resp = $puestoarea_dato['nombre_resp'];
     

}
