<?php

$sql = "SELECT *, erc.noaplica_cev as noaplica_cev, cen.nombre_cen as nombre_cen, tev.tipoevaluacion_tev as tipoevaluacion_tev, emp.nombre_emp as nombre_emp
        FROM er_controlevaluaciones as erc 
        INNER JOIN centros as cen ON erc.centro_cev = cen.id_centro
        INNER JOIN empresa as emp ON cen.empresa_cen = emp.id_empresa
        INNER JOIN tipoevaluacion as tev ON erc.tipoevaluacion_cev = tev.id_tipoevaluacion
WHERE `id_controleval` = '$id_controleval'";
$query = $pdo->prepare($sql);
$query->execute();
$controleval_datos = $query->fetchAll(PDO::FETCH_ASSOC);

foreach ($controleval_datos as $controleval_dato) {
    $centro_cev = $controleval_dato['nombre_cen'];
    $tipoevaluacion_cev = $controleval_dato['tipoevaluacion_tev'];
    $fecha_cev = $controleval_dato['fecha_cev'];
    $fechacad_cev = $controleval_dato['fechacad_cev'];
    $noaplica_cev = $controleval_dato['noaplica_cev'];
    $anotaciones_cev = $controleval_dato['anotaciones_cev'];

}
