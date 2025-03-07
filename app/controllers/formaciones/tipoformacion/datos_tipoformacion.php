<?php

$sql = "SELECT fr.id_formacionr as id_formacion, fr.fecha_fr as fecha_fr, fr.fechacad_fr as fechacad_fr, 
tr.nombre_tf as nombre_tf, tr.nombre_tr as nombre_tr
FROM formacion as fr INNER JOIN trabajadores as tr ON fr.trabajador_fr = tr.id_trabajador
INNER JOIN tipoformacion as tr ON fr.tipo_fr = tf.id_tipoformacion WHERE id_formacion = $id_formacion";
$query = $pdo->prepare($sql);
$query->execute();
$tipoformaciones = $query->fetchAll(PDO::FETCH_ASSOC);

foreach ($tipoformaciones_datos as $tipoformaciones_dat) {
    $tipo_fr = $tipoformaciones_dato['nombre_tf'];
    $trabajador_fr = $tipoformaciones_dato['nombre_tr'];
    $fecha_fr = $tipoformaciones_dato['fecha_fr'];
    $fechacad_fr = $tipoformaciones_dato['fechacad_fr'];
     

}
