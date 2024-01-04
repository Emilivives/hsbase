<?php

$sql = "SELECT *, tr.nombre_tr as nombre_tr, rm.fecha_rm as fecha_fr, rm.caducidad_rm as caducidad_rm, rm.vigente_rm as vigente_rm, rm.cita_rm as cita_rm, rm.anotaciones_rm as anotaciones_rm 
FROM reconocimientos as rm 
INNER JOIN trabajadores as tr ON rm.id_trabajador = tr.id_trabajador";

$query_reconocimientos = $pdo->prepare($sql);
$query_reconocimientos ->execute();
$reconocimientos = $query_reconocimientos->fetchAll(PDO::FETCH_ASSOC);


