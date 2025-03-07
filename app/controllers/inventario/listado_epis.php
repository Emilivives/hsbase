<?php



$sql_inventarioepis = "SELECT epi.id_epi as id_epi, ep.nombre_epi as nombre_epi, epi.clase_epi as clase_epi, epi.marca_epi as marca_epi, epi.modelo_epi as modelo_epi, epi.numserie_epi as numserie_epi, 
cen.nombre_cen as nombre_cen, epi.manual_epi as manual_epi, epi.marcace_epi as marcace_epi,epi.aniofab_epi as aniofab_epi, epi.vigencia_epi as vigencia_epi, 
epi.estado_epi as estado_epi, epi.observaciones_epi as observaciones_epi
FROM `inv_epis` as epi 
INNER JOIN centros as cen ON epi.centro_epi = cen.id_centro
INNER JOIN epis as ep ON epi.tipo_epi = ep.id_epi";

$query_inventarioepis = $pdo->prepare($sql_inventarioepis);
$query_inventarioepis->execute();
$inventarioepis_datos = $query_inventarioepis->fetchAll(PDO::FETCH_ASSOC);


