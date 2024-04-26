<?php

$sql = "SELECT tr.id_trabajador as id_trabajador, tr.codigo_tr as codigo_tr, tr.dni_tr as dni_tr, tr.nombre_tr as nombre_tr, tr.fechanac_tr as fechanac_tr, tr.sexo_tr as sexo_tr, 
cat.nombre_cat as nombre_cat, tr.inicio_tr as inicio_tr, tr.activo_tr as activo_tr, tr.formacionpdt_tr as formacionpdt_tr, tr.informacion_tr as informacion_tr, cen.nombre_cen as nombre_cen, tr.anotaciones_tr as anotaciones_tr
FROM `trabajadores`as tr INNER JOIN `categorias` as cat ON tr.categoria_tr = cat.id_categoria
INNER JOIN `centros` as cen ON tr.centro_tr = cen.id_centro WHERE `id_trabajador` = '$id_trabajador'";
$query = $pdo->prepare($sql);
$query->execute();
$trabajador_datos = $query->fetchAll(PDO::FETCH_ASSOC);

foreach ($trabajador_datos as $trabajador_dato) {
    $codigo_tr = $trabajador_dato['codigo_tr'];
    $dni_tr = $trabajador_dato['dni_tr'];
    $nombre_tr = $trabajador_dato['nombre_tr'];
    $sexo_tr = $trabajador_dato['sexo_tr'];
    $fechanac_tr = $trabajador_dato['fechanac_tr'];
    $inicio_tr = $trabajador_dato['inicio_tr'];
    $centro_tr = $trabajador_dato['nombre_cen'];
    $categoria_tr = $trabajador_dato['nombre_cat'];
    $activo_tr = $trabajador_dato['activo_tr'];
    $anotaciones_tr = $trabajador_dato['anotaciones_tr'];
    $formacionpdt_tr = $trabajador_dato['formacionpdt_tr'];
    $informacion_tr = $trabajador_dato['informacion_tr'];


}
