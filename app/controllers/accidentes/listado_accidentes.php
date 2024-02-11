<?php

$sql = "SELECT ace.id_accidente as id_accidente, ace.nroaccidente_ace as nroaccidente_ace, ace.comunicado_ace as comunicado_ace,
tr.nombre_tr as nombre_tr, cen.nombre_cen as nombre_cen, ta.tipoaccidente_ta as tipoaccidente_ta,ace.fecha_ace as fecha_ace,
tl.tipolesion_tl as tipolesion_tl, gr.gravedad_gr as gravedad_gr,partecuerpo_ace as partecuerpo_ace
FROM `accidentes`as ace 
INNER JOIN `trabajadores` as tr ON ace.trabajador_ace = tr.id_trabajador
INNER JOIN `centros` as cen ON ace.centro_ace = cen.id_centro
INNER JOIN `empresa` as emp ON cen.empresa_cen = emp.id_empresa
INNER JOIN `ace_tipoaccidente` as ta ON ace.tipoaccidente_ace = ta.id_tipoaccidente
INNER JOIN `ace_tipolesion` as tl ON ace.tipolesion_ace = tl.id_tipolesion
INNER JOIN `ace_gravedad` as gr ON ace.gradolesion_ace = gr.id_gravedad
ORDER BY ace.fecha_ace DESC";
$query = $pdo->prepare($sql);
$query ->execute();
$accidentes_datos = $query->fetchAll(PDO::FETCH_ASSOC);


// , emp.nombre_emp as nombre_emp 
// INNER JOIN `empresa` as emp ON cen.empresa_cen = emp.nombre_emp