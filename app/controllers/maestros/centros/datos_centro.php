<?php

$sql_centros = "SELECT cen.id_centro as id_centro, cen.nombre_cen as nombre_cen, cen.direccion_cen as direccion_cen, emp.nombre_emp as nombre_emp, tc.nombre_tc as nombre_tc 
FROM `centros` as cen INNER JOIN empresa as emp ON cen.empresa_cen = emp.id_empresa WHERE id_centro = $id_centro
INNER JOIN tipocentros as tc ON cen.tipo_cen = tc.id_tipocentro WHERE id_centro = $id_centro";
$query_centros = $pdo->prepare($sql_centros);
$query_centros->execute();
$centros_datos = $query_centros->fetchAll(PDO::FETCH_ASSOC);

foreach ($centros_datos as $centros_dato) {
    $nombre_cen = $centros_dato['nombre_cen'];
    $empresa_cen = $centros_dato['nombre_cen'];
    $tipo_cen = $centros_dato['nombre_tc'];
    $direccion_cen = $centros_dato['direccion_cen'];
}
