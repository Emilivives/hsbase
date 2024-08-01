<?php

$sql = "SELECT *, rm.id_reconocimiento as id_reconocimiento, rm.fecha_rm as fecha_rm, rm.caducidad_rm as caducidad_rm, 
tr.nombre_tr as nombre_tr, tr.activo_tr as activo_tr, rm.vigente_rm as vigente_rm, rm.cita_rm as cita_rm, rm.anotaciones_rm as anotaciones_rm
FROM reconocimientos as rm INNER JOIN trabajadores as tr ON rm.trabajador_rm = tr.id_trabajador 
WHERE id_reconocimiento = $id_reconocimiento";
$query = $pdo->prepare($sql);
$query->execute();
$reconocimientos_datos = $query->fetchAll(PDO::FETCH_ASSOC);

foreach ($reconocimientos_datos as $reconocimientos_dato) {
    $trabajador_rm = $reconocimientos_dato['nombre_tr'];
    $tractivo_rm = $reconocimientos_dato['activo_tr'];
    $fecha_rm = $reconocimientos_dato['fecha_rm'];
    $caducidad_rm = $reconocimientos_dato['caducidad_rm'];
    $vigente_rm = $reconocimientos_dato['vigente_rm'];
    $cita_rm = $reconocimientos_dato['cita_rm'];
    $fechacita_rm = $reconocimientos_dato['fechacita_rm'];
    $solicitudcita_rm = $reconocimientos_dato['solicitudcita_rm'];
    $anotaciones_rm = $reconocimientos_dato['anotaciones_rm'];
     

}


