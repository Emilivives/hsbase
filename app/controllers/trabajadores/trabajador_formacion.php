<?php

$sql = "SELECT *, tf.nombre_tf as nombre_tf, fr.fecha_fr as fecha_fr, fr.fechacad_fr as fechacad_fr, 
fas.idtrabajador_fas as idtrabajador_fas, tf.duracion_tf as duracion_tf, tf.detalles_tf as detalles_tf FROM formacion as fr 
INNER JOIN tipoformacion as tf ON fr.tipo_fr = tf.id_tipoformacion
INNER JOIN form_asistencia as fas ON fas.nroformacion = fr.nroformacion
INNER JOIN trabajadores as tr ON tr.id_trabajador = fas.idtrabajador_fas
WHERE fas.idtrabajador_fas = $id_trabajador ORDER BY fr.fecha_fr DESC";

$query = $pdo->prepare($sql);
$query->execute();
$trabajador_formaciones = $query->fetchAll(PDO::FETCH_ASSOC);


