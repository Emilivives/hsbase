<?php
// Obtener las evaluaciones
$sql = "SELECT *, erc.noaplica_cev as noaplica_cev, cen.nombre_cen as nombre_cen, tev.tipoevaluacion_tev as tipoevaluacion_tev, emp.nombre_emp as nombre_emp
        FROM er_controlevaluaciones as erc 
        INNER JOIN centros as cen ON erc.centro_cev = cen.id_centro
        INNER JOIN empresa as emp ON cen.empresa_cen = emp.id_empresa
        INNER JOIN tipoevaluacion as tev ON erc.tipoevaluacion_cev = tev.id_tipoevaluacion";
$query = $pdo->prepare($sql);
$query->execute();
$control_evaluaciones = $query->fetchAll(PDO::FETCH_ASSOC);