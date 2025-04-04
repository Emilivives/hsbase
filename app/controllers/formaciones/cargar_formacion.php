<?php

$sql = "SELECT *, fr.detalle_fr as detalle_fr, tf.nombre_tf as nombre_tf, fas.idtrabajador_fas as idtrabajador_fas, tf.duracion_tf as duracion_tf, tf.detalles_tf as detalles_tf, 
resp.nombre_resp as nombre_resp FROM formacion as fr 
INNER JOIN tipoformacion as tf ON fr.tipo_fr = tf.id_tipoformacion 
INNER JOIN form_asistencia as fas ON fas.nroformacion = fr.nroformacion
INNER JOIN trabajadores as tr ON tr.id_trabajador = fas.idtrabajador_fas
INNER JOIN responsables as resp ON fr.formador_fr = resp.id_responsable
INNER JOIN centros as cen ON cen.id_centro = tr.centro_tr
INNER JOIN empresa as emp ON emp.id_empresa = cen.empresa_cen
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
$detalle_fr = $formaciondetalle_dato['detalle_fr'];

$empresa_fr = $formaciondetalle_dato['razonsocial_emp'];
$direccionemp_fr = $formaciondetalle_dato['direccion_emp'];
$logo_emp = $formaciondetalle_dato['logo_emp'];

}