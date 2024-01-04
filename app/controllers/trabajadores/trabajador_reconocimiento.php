<?php

$sql = "SELECT rm.id_reconocimiento as id_reconocimiento, rm.fecha_rm as fecha_rm, rm.caducidad_rm as caducidad_rm, rm.vigente_rm as vigente_rm, rm.cita_rm as cita_rm
FROM reconocimientos as rm WHERE id_trabajador = $id_trabajador";

$query = $pdo->prepare($sql);
$query->execute();
$trabajador_reconocimientos = $query->fetchAll(PDO::FETCH_ASSOC);


