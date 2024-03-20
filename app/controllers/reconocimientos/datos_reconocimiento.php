<?php

$sql = "SELECT rm.id_reconocimiento as id_reconocimiento, rm.fecha_rm as fecha_rm, rm.caducidad_rm as caducidad_rm, 
tr.nombre_tr as nombre_tr, rm.vigente_rm as vigente_rm, rm.cita_rm as cita_rm, rm.anotaciones_rm as anotaciones_rm
FROM reconocimientos as rm INNER JOIN trabajadores as tr ON rm.id_trabajador = tr.id_trabajador 
WHERE id_reconocimiento = $id_reconocimiento";
$query = $pdo->prepare($sql);
$query->execute();
$reconocimientos_datos = $query->fetchAll(PDO::FETCH_ASSOC);

foreach ($reconocimientos_datos as $reconocimientos_dato) {
    $id_trabajador = $reconocimientos_dato['nombre_tr'];
    $fecha_rm = $reconocimientos_dato['fecha_rm'];
    $caducidad_rm = $reconocimientos_dato['caducidad_rm'];
    $vigente_rm = $reconocimientos_dato['vigente_rm'];
    $cita_rm = $reconocimientos_dato['cita_rm'];
    $anotaciones_rm = $reconocimientos_dato['anotaciones_rm'];
     

}


