<?php

$sql_detallesmaq_datos = "SELECT maq.id_maquina as id_maquina, tm.nombre_tm as nombre_tm, tm.clase_tm as clase_tm, 
maq.marca_maq as marca_maq, maq.modelo_maq as modelo_maq, maq.numserie_maq as numserie_maq, maq.proveedor_maq as proveedor_maq,
cen.nombre_cen as nombre_cen, maq.manual_maq as manual_maq, maq.marcace_maq as marcace_maq, maq.aniofab_maq as aniofab_maq, 
maq.estado_maq as estado_maq, maq.observaciones_maq as observaciones_maq, maq.img1_maq, maq.img2_maq, maq.imgmto1_maq, maq.imgmto2_maq
FROM inv_maquinaria as maq
INNER JOIN tipomaquinas as tm ON maq.tipo_maq = tm.id_tipomaquina
INNER JOIN centros as cen ON maq.centro_maq = cen.id_centro
WHERE maq.id_maquina = :id_maquina";

$query = $pdo->prepare($sql_detallesmaq_datos);
$query->execute();
$detallesmaq_datos = $query->fetchAll(PDO::FETCH_ASSOC);


foreach ($detallesmaq_datos as $detallesmaq_dato) {
    $tipo_maq = $detallesmaq_dato['nombre_tm'];
    $clase_maq = $detallesmaq_dato['clase_tm'];
    $marca_maq = $detallesmaq_dato['marca_maq'];
    $modelo_maq = $detallesmaq_dato['modelo_maq'];
    $numserie_maq = $detallesmaq_dato['numserie_maq'];
    $proveedor_maq = $detallesmaq_dato['proveedor_maq'];
    $centro_maq = $detallesmaq_dato['nombre_cen'];
    $manual_maq = $detallesmaq_dato['manual_maq'];
    $marcace_maq = $detallesmaq_dato['marcace_maq'];
    $aniofab_maq = $detallesmaq_dato['aniofab_maq'];
    $estado_maq = $detallesmaq_dato['estado_maq'];
    $observaciones_maq = $detallesmaq_dato['observaciones_maq'];
    $img1_maq = $detallesmaq_dato['img1_maq'];
    $img2_maq = $detallesmaq_dato['img2_maq'];
    $imgmto1_maq = $detallesmaq_dato['imgmto1_maq'];
    $imgmto2_maq = $detallesmaq_dato['imgmto2_maq'];
} 
