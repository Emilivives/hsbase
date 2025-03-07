<?php

$id_evaluacion = $_GET['id_evaluacion'] ?? null;

if (!$id_evaluacion) {
    die("El parámetro 'id_evaluacion' no está definido o es inválido.");
}

$sql = "SELECT *, eq.evaluacion_eq as evaluacion_eq, eq.area_eq as area_eq, eq.descripcion_eq as descripcion_eq, 
cen.nombre_cen as nombre_cen, cen.id_centro as id_centro, er.nombre_er as nombre_er, res.nombre_resp as nombre_resp
FROM `er_equiposcentro` as eq 
INNER JOIN er_evaluacion as er ON eq.evaluacion_eq = er.id_evaluacion
INNER JOIN centros as cen ON er.centro_er = cen.id_centro
INNER JOIN responsables as res ON er.responsable_er = res.id_responsable
WHERE er.id_evaluacion = $id_evaluacion";

$query = $pdo->prepare($sql);
$query->execute();
$equiposarea_datos = $query->fetchAll(PDO::FETCH_ASSOC);



foreach ($equiposarea_datos as $equiposarea_dato) {
    $evaluacion_eq = $equiposarea_dato['evaluacion_eq'];
    $area_eq = $equiposarea_dato['area_eq'];
    $descripcion_eq = $equiposarea_dato['descripcion_eq'];
    $factoresriesgo_eq = $equiposarea_dato['factoresriesgo_eq'];
    $epis_eq = $equiposarea_dato['epis_eq'];
    $descripcion_eq = $equiposarea_dato['descripcion_eq'];
    $metodos_eq = $equiposarea_dato['metodos_eq'];
    $id_centro = $equiposarea_dato['id_centro'];
    $nombre_cen = $equiposarea_dato['nombre_cen'];
    $nombre_resp = $equiposarea_dato['nombre_resp'];
}
