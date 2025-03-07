<?php

$sql = "SELECT 
    mto.id_mtomaquina as id_mtomaquina, 
    mto.id_maquina as id_maquina, 
mto.fecha_mto as fecha_mto,
mto.operatio_mto as operario_mto,
mto.detalles_mto as detalles_mto,
FROM 
    mto_maquinaria as mto 
ORDER BY 
    mto.fecha_mto DESC";

$query_mtomaquinas_datos = $pdo->prepare($sql);
$query_mtomaquinas_datos->execute();
$mtomaquinas_datos = $query_mtomaquinas_datos->fetchAll(PDO::FETCH_ASSOC);
