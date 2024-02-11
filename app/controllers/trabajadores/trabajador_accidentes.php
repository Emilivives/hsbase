<?php

$sql = "SELECT *, ta.tipoaccidente_ta as tipoaccidente_ta, ace.fecha_ace as fecha_ace, ace.fechabaja_ace as fechabaja_ace, cen.nombre_cen as nombre_cen
FROM accidentes as ace 
INNER JOIN ace_tipoaccidente as ta ON ace.tipoaccidente_ace = ta.id_tipoaccidente
INNER JOIN centros as cen ON ace.centro_ace = cen.id_centro
WHERE  ace.trabajador_ace = $id_trabajador ORDER BY ace.fecha_ace DESC";

$query = $pdo->prepare($sql);
$query->execute();
$trabajador_accidentes = $query->fetchAll(PDO::FETCH_ASSOC);


