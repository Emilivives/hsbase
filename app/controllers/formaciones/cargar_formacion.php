<?php

$sql = "SELECT *, tf.nombre_tf as nombre_tf, fas.idtrabajador_fas as idtrabajador_fas, tf.duracion_tf as duracion_tf, tf.detalles_tf as detalles_tf, tf.normativa_tf as normativa_tf,
resp.nombre_resp as nombre_resp FROM formacion as fr 
INNER JOIN tipoformacion as tf ON fr.tipo_fr = tf.id_tipoformacion 
INNER JOIN form_asistencia as fas ON fas.nroformacion = fr.nroformacion
INNER JOIN trabajadores as tr ON tr.id_trabajador = fas.idtrabajador_fas
INNER JOIN responsables as resp ON fr.formador_fr = resp.id_responsable
WHERE fr.id_formacion = $id_formacion_get";


$query_formacionesdetalle = $pdo->prepare($sql);
$query_formacionesdetalle ->execute();
$formaciondetalle_datos = $query_formacionesdetalle->fetchAll(PDO::FETCH_ASSOC);


foreach($formaciondetalle_datos as $formaciondetalle_dato){
$nroformacion = $formaciondetalle_dato['nroformacion'];
$id_formacion = $formaciondetalle_dato['id_formacion'];
$tipo_fr = $formaciondetalle_dato['nombre_tf'];
$fecha_fr = $formaciondetalle_dato['fecha_fr'];
$fechacad_fr = $formaciondetalle_dato['fechacad_fr'];
$formador_fr = $formaciondetalle_dato['nombre_resp'];
$detalles_fr = $formaciondetalle_dato['detalles_tf'];
$normativa_fr = $formaciondetalle_dato['normativa_tf'];
}