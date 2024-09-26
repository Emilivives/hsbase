<?php

$sql = "SELECT *, fer.puestocentro_fer as puestocentro_fer, fer.frasefila_fer as frasefila_fer, 
fer.riesgo_fer as riesgo_fer, fer.probabilidad_fer as probabilidad_fer, fer.gravedad_fer as gravedad_fer, 
fer.nivelriesgo_fer as nivelriesgo_fer, m.id_medida as id_medida, m.codigomedida as codigomedida, m.frasemedida as frasemedida, 
rg.codigoriesgo as codigoriesgo, rg.fraseriesgo as fraseriesgo, fer.planresponsable_fer as planresponsable_fer, 
fer.plancoste_fer as plancoste_fer, fer.planaccion_fer as planaccion_fer, fer.planprioridad_fer as planprioridad_fer, 
fer.planmetodo_fer as planmetodo_fer, fer.planformacion_fer as planformacion_fer, fer.planinformacion_fer as planinformacion_fer 
    FROM er_filas as fer
    INNER JOIN er_riesgos as rg ON fer.riesgo_fer = rg.id_riesgo
    INNER JOIN er_filamedidas as fm ON fer.id_filaeval = fm.filaeval_fm
    INNER JOIN er_medidas as m ON fm.medida_fm = m.id_medida
    WHERE id_filaeval = $id_filaeval";

$query_filariesgo_datos = $pdo->prepare($sql);
$query_filariesgo_datos ->execute();
$filariesgo_datos = $query_filariesgo_datos->fetchAll(PDO::FETCH_ASSOC);


foreach ($filariesgo_datos as $filariesgo_dato) {
    $puestocentro_fer = $filariesgo_dato['puestocentro_fer'];
    $frasefila_fer = $filariesgo_dato['frasefila_fer'];
    $riesgo_fer = $filariesgo_dato['riesgo_fer'];
    $probabilidad_fer = $filariesgo_dato['probabilidad_fer'];
    $gravedad_fer = $filariesgo_dato['gravedad_fer'];
    $nivelriesgo_fer = $filariesgo_dato['nivelriesgo_fer'];
    $id_medida = $filariesgo_dato['id_medida'];
    $codigomedida = $filariesgo_dato['codigomedida'];
    $frasemedida = $filariesgo_dato['frasemedida'];
    $codigoriesgo = $filariesgo_dato['codigoriesgo'];
    $fraseriesgo = $filariesgo_dato['fraseriesgo'];
    $planresponsable_fer = $filariesgo_dato['planresponsable_fer'];
    $plancoste_fer = $filariesgo_dato['plancoste_fer'];
    $planaccion_fer = $filariesgo_dato['planaccion_fer'];
    $planprioridad_fer = $filariesgo_dato['planprioridad_fer'];
    $planmetodo_fer = $filariesgo_dato['planmetodo_fer'];
    $planformacion_fer = $filariesgo_dato['planformacion_fer'];
    $planinformacion_fer = $filariesgo_dato['planinformacion_fer'];
    $imgriesgo_fer = $filariesgo_dato['imgriesgo_fer'];
    $imgplan_fer = $filariesgo_dato['imgplan_fer'];
}
