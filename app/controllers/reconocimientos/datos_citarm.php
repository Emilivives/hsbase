<?php

$sql = "SELECT crm.id_citarm as id_citarm, tr.nombre_tr as nombre_tr, crm.fecha_crm as fecha_crm, crm.anotaciones_crm as anotaciones_crm
FROM citas_rm as crm INNER JOIN trabajadores as tr ON crm.trabajador_crm = tr.id_trabajador 
WHERE id_citarm = $id_citarm";
$query = $pdo->prepare($sql);
$query->execute();
$citarm_datos = $query->fetchAll(PDO::FETCH_ASSOC);

foreach ($citarm_datos as $citarm_dato) {
    $trabajador_crm = $reconocimientos_dato['nombre_tr'];
    $fecha_crm = $reconocimientos_dato['fecha_crm'];
    $anotaciones_crm = $reconocimientos_dato['anotaciones_crm'];
     

}


