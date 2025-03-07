<?php

$sql_detallesepi_datos = "SELECT epi.id_epi as id_epi, ep.nombre_epi as nombre_epi, epi.clase_epi as clase_epi, epi.marca_epi as marca_epi, 
epi.modelo_epi as modelo_epi, epi.numserie_epi as numserie_epi, cen.nombre_cen as nombre_cen, epi.manual_epi as manual_epi, 
epi.marcace_epi as marcace_epi, epi.aniofab_epi as aniofab_epi, epi.vigencia_epi as vigencia_epi, epi.estado_epi as estado_epi, 
epi.observaciones_epi as observaciones_epi, epi.img1_epi, epi.img2_epi
FROM `inv_epis` as epi 
INNER JOIN centros as cen ON epi.centro_epi = cen.id_centro
INNER JOIN epis as ep ON epi.tipo_epi = ep.id_epi
WHERE epi.id_epi = :id_epi";

$query_detallesepi_datos = $pdo->prepare($sql_detallesepi_datos);
$query_detallesepi_datos->execute([':id_epi' => $id_epi]);
$detallesepi_dato = $query_detallesepi_datos->fetch(PDO::FETCH_ASSOC);

if ($detallesepi_dato) {
    $tipo_epi = $detallesepi_dato['nombre_epi'];
    $clase_epi = $detallesepi_dato['clase_epi'];
    $marca_epi = $detallesepi_dato['marca_epi'];
    $modelo_epi = $detallesepi_dato['modelo_epi'];
    $numserie_epi = $detallesepi_dato['numserie_epi'];
    $centro_epi = $detallesepi_dato['nombre_cen'];
    $manual_epi = $detallesepi_dato['manual_epi'];
    $marcace_epi = $detallesepi_dato['marcace_epi'];
    $aniofab_epi = $detallesepi_dato['aniofab_epi'];
    $vigencia_epi = $detallesepi_dato['vigencia_epi'];
    $estado_epi = $detallesepi_dato['estado_epi'];
    $observaciones_epi = $detallesepi_dato['observaciones_epi'];
    $img1_epi = $detallesepi_dato['img1_epi'];
    $img2_epi = $detallesepi_dato['img2_epi'];
} else {
    // Manejar el caso en que no se encuentre el registro
    echo "No se encontraron datos para el id especificado.";
}

