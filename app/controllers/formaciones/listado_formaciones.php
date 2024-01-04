<?php

$sql = "SELECT *, tf.nombre_tf as nombre_tf, fr.fecha_fr as fecha_fr, fr.fechacad_fr as fechacad_fr, tf.duracion_tf as duracion_tf, tf.detalles_tf as detalles_tf FROM formacion as fr 
INNER JOIN tipoformacion as tf ON fr.tipo_fr = tf.id_tipoformacion";

$query_formaciones = $pdo->prepare($sql);
$query_formaciones ->execute();
$formaciones_datos = $query_formaciones->fetchAll(PDO::FETCH_ASSOC);


