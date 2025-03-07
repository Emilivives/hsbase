<?php

$sql = "SELECT *, tr.nombre_tr as nombre_tr, cat.nombre_cat as nombre_cat, rm.fecha_rm as fecha_fr, rm.caducidad_rm as caducidad_rm, rm.cita_rm as cita_rm, rm.vigente_rm as vigente_rm, 
rm.cita_rm as cita_rm, rm.anotaciones_rm as anotaciones_rm  
FROM reconocimientos as rm 
INNER JOIN trabajadores as tr ON rm.trabajador_rm = tr.id_trabajador
INNER JOIN centros as cen ON tr.centro_tr = cen.id_centro
INNER JOIN `empresa` as emp ON cen.empresa_cen = emp.id_empresa 
INNER JOIN categorias as cat ON tr.categoria_tr = cat.id_categoria";

$query_reconocimientos = $pdo->prepare($sql);
$query_reconocimientos ->execute();
$reconocimientos = $query_reconocimientos->fetchAll(PDO::FETCH_ASSOC);


