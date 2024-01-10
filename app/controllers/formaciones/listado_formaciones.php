<?php

$sql = "SELECT *, tf.nombre_tf as nombre_tf, fr.fecha_fr as fecha_fr, fr.fechacad_fr as fechacad_fr, 
fas.idtrabajador_fas as idtrabajador_fas, tf.duracion_tf as duracion_tf, tf.detalles_tf as detalles_tf FROM formacion as fr 
INNER JOIN tipoformacion as tf ON fr.tipo_fr = tf.id_tipoformacion
INNER JOIN form_asistencia as fas ON fas.nroformacion = fr.nroformacion
INNER JOIN trabajadores as tr ON tr.id_trabajador = fas.idtrabajador_fas
";

$query_formaciones = $pdo->prepare($sql);
$query_formaciones ->execute();
$formaciones_datos = $query_formaciones->fetchAll(PDO::FETCH_ASSOC);


