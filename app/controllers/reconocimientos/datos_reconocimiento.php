<?php

$sql = "SELECT fr.id_formacion as id_formacion, fr.fecha_fr as fecha_fr, fr.fechacad_fr as fechacad_fr, 
tr.nombre_tf as nombre_tf, tr.nombre_tr as nombre_tr
FROM formacion as fr INNER JOIN trabajadores as tr ON fr.trabajador_fr = tr.id_trabajador
INNER JOIN tipoformacion as tr ON fr.tipo_fr = tf.id_tipoformacion WHERE id_formacion = $id_formacion";
$query = $pdo->prepare($sql);
$query->execute();
$formaciones = $query->fetchAll(PDO::FETCH_ASSOC);

foreach ($formaciones as $formacion) {
    $tipo_fr = $formacion['nombre_tf'];
    $trabajador_fr = $formacion['nombre_tr'];
    $fecha_fr = $formacion['fecha_fr'];
    $fechacad_fr = $formacion['fechacad_fr'];
     

}
