<?php

$nroformacion = $_GET['nroformacion'];

$sql = "SELECT *, tr.nombre_tr as nombre_tr, tr.dni_tr as dni_tr FROM form_asistencia as fas 
INNER JOIN trabajadores as tr ON tr.id_trabajador = fas.idtrabajador_fas
WHERE fas.nroformacion =:nroformacion";

$query_asistenciaformacion = $pdo->prepare($sql);
$query_asistenciaformacion ->execute();
$asistenciaformacion_datos = $query_asistenciaformacion->fetchAll(PDO::FETCH_ASSOC);

