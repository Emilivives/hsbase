<?php

$id_centro = $_GET['id_centro'];

$sql = "SELECT 
    maq.id_maquina as id_maquina, 
    tm.nombre_tm as nombre_tm, 
    tm.clase_tm as clase_tm, 
    maq.marca_maq as marca_maq, 
    maq.modelo_maq as modelo_maq, 
    maq.numserie_maq as numserie_maq, 
    maq.proveedor_maq as proveedor_maq, 
    maq.manual_maq as manual_maq, 
    maq.marcace_maq as marcace_maq, 
    maq.aniofab_maq as aniofab_maq, 
    cen.nombre_cen as nombre_cen, 
    maq.estado_maq as estado_maq, 
    maq.observaciones_maq as observaciones_maq, 
    maq.img1_maq as img1_maq, 
    maq.img2_maq as img2_maq,
    maq.imgmto1_maq as imgmto1_maq, 
    maq.imgmto2_maq as imgmto2_maq
FROM 
    inv_maquinaria as maq 
INNER JOIN 
    tipomaquinas as tm ON maq.tipo_maq = tm.id_tipomaquina
INNER JOIN 
    centros as cen ON maq.centro_maq = cen.id_centro 
WHERE 
    id_centro = $id_centro
ORDER BY 
    maq.aniofab_maq DESC";

$query_maquinascentro_datos = $pdo->prepare($sql);
$query_maquinascentro_datos->execute();
$maquinascentro_datos = $query_maquinascentro_datos->fetchAll(PDO::FETCH_ASSOC);
