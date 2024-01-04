<?php

$sql = "SELECT tr.id_trabajador as id_trabajador, tr.codigo_tr as codigo_tr, tr.dni_tr as dni_tr, tr.nombre_tr as nombre_tr, tr.fechanac_tr as fechanac_tr, tr.inicio_tr as inicio_tr, tr.activo_tr as activo_tr, cat.nombre_cat as nombre_cat, cen.nombre_cen as nombre_cen 
FROM `trabajadores`as tr INNER JOIN `categorias` as cat ON tr.categoria_tr = cat.id_categoria
INNER JOIN `centros` as cen ON tr.centro_tr = cen.id_centro";
$query = $pdo->prepare($sql);
$query ->execute();
$trabajadores = $query->fetchAll(PDO::FETCH_ASSOC);


