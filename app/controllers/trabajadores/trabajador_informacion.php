<?php

$sql = "SELECT *, ifd.nombre_ifd as nombre_ifd, ifd.tipoinfo_ifd as tipoinfo_ifd, eif.fechaentrega as fechaentrega
FROM info_entregainfo as eif 
INNER JOIN info_documentos as ifd ON eif.id_infodoc = ifd.id_infodoc
INNER JOIN trabajadores as tr ON tr.id_trabajador = eif.id_trabajador
WHERE eif.id_trabajador = $id_trabajador ORDER BY eif.fechaentrega DESC";

$query = $pdo->prepare($sql);
$query->execute();
$trabajador_informaciones = $query->fetchAll(PDO::FETCH_ASSOC);


