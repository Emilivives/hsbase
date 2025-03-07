<?php
$sql = "
SELECT 
    maq.id_maquina AS id_maquina,
    tm.nombre_tm AS nombre_tm,
    tm.clase_tm AS clase_tm,
    maq.marca_maq AS marca_maq,
    maq.modelo_maq AS modelo_maq,
    maq.numserie_maq AS numserie_maq,
    maq.proveedor_maq AS proveedor_maq,
    maq.manual_maq AS manual_maq,
    maq.marcace_maq AS marcace_maq,
    maq.aniofab_maq AS aniofab_maq,
    cen.nombre_cen AS nombre_cen,
    maq.estado_maq AS estado_maq,
    maq.observaciones_maq AS observaciones_maq,
    maq.img1_maq AS img1_maq,
    maq.img2_maq AS img2_maq,
    maq.imgmto1_maq AS imgmto1_maq,
    maq.imgmto2_maq AS imgmto2_maq,
    rev.id_revisionoficial AS id_revisionoficial,
    rev.tipo_revof AS tipo_revof,
    rev.proveedor_revof AS proveedor_revof,
    rev.fecha_revof AS fecha_revof,
    rev.caducidad_revof AS caducidad_revof,
    rev.vigente_revof AS vigente_revof,
    rev.observaciones_revof AS observaciones_revof
FROM 
    inv_maquinaria AS maq
INNER JOIN 
    inv_revision_oficial AS rev 
    ON maq.id_maquina = rev.id_equipo
INNER JOIN 
    tipomaquinas AS tm 
    ON maq.tipo_maq = tm.id_tipomaquina
INNER JOIN 
    centros AS cen 
    ON maq.centro_maq = cen.id_centro
INNER JOIN (
    -- Subconsulta para obtener el último registro por máquina
    SELECT 
        id_equipo,
        MAX(fecha_revof) AS ultima_fecha
    FROM 
        inv_revision_oficial
    GROUP BY 
        id_equipo
) ult_rev 
    ON rev.id_equipo = ult_rev.id_equipo AND rev.fecha_revof = ult_rev.ultima_fecha
ORDER BY 
    rev.vigente_revof DESC, -- Priorizar registros con vigente_revof = 1
    maq.aniofab_maq DESC";

$query_listarevisionoficial_datos = $pdo->prepare($sql);
$query_listarevisionoficial_datos->execute();
$listarevisionoficial_datos = $query_listarevisionoficial_datos->fetchAll(PDO::FETCH_ASSOC);
