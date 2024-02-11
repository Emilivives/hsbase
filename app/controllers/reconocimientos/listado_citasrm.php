<?php

$sql = "SELECT *, tr.nombre_tr as nombre_tr, crm.fecha_crm as fecha_crm, crm.anotaciones_crm as anotaciones_crm
FROM citas_rm as crm 
INNER JOIN trabajadores as tr ON crm.trabajador_crm = tr.id_trabajador
INNER JOIN categorias as cat ON tr.categoria_tr = cat.id_categoria
INNER JOIN centros as cen ON tr.centro_tr = cen.id_centro";

$query_citasrm = $pdo->prepare($sql);
$query_citasrm ->execute();
$citasrm = $query_citasrm->fetchAll(PDO::FETCH_ASSOC);


