<?php

$sql = "SELECT fr.id_formacion as id_formacion, tr.nombre_tr as nombre_tr, fr.fecha_fr as fecha_fr, fr.fechacad_fr as fechacad_fr, tf.nombre_tf as nombre_tf
FROM formacion as fr INNER JOIN tipoformacion as tf ON fr.tipo_fr = tf.id_tipoformacion 
INNER JOIN trabajadores as tr ON fr.trabajador_fr = tr.id_trabajador
WHERE trabajador_fr = $id_trabajador ORDER BY fr.fecha_fr DESC";

$query = $pdo->prepare($sql);
$query->execute();
$trabajador_formaciones = $query->fetchAll(PDO::FETCH_ASSOC);


