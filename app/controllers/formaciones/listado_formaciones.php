<?php

$sql = "SELECT *, tf.nombre_tf as nombre_tf, fr.fecha_fr as fecha_fr, fr.fechacad_fr as fechacad_fr, fr.detalle_fr as detalle_fr,
fas.idtrabajador_fas as idtrabajador_fas, tf.duracion_tf as duracion_tf, tf.detalles_tf as detalles_tf, cat.nombre_cat as nombre_cat, emp.nombre_emp as nombre_emp, 
resp.nombre_resp as nombre_resp FROM formacion as fr 
INNER JOIN tipoformacion as tf ON fr.tipo_fr = tf.id_tipoformacion
INNER JOIN form_asistencia as fas ON fas.nroformacion = fr.nroformacion
INNER JOIN trabajadores as tr ON tr.id_trabajador = fas.idtrabajador_fas
INNER JOIN categorias as cat ON cat.id_categoria = tr.categoria_tr
INNER JOIN centros as cen ON tr.centro_tr = cen.id_centro
INNER JOIN empresa as emp ON cen.empresa_cen = emp.id_empresa
INNER JOIN responsables as resp ON fr.formador_fr = resp.id_responsable
ORDER BY fecha_fr DESC
";

$query_formaciones = $pdo->prepare($sql);
$query_formaciones ->execute();
$formaciones_datos = $query_formaciones->fetchAll(PDO::FETCH_ASSOC);


