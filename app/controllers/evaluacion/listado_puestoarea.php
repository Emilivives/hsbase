<?php

$sql = "SELECT *, pc.evaluacion_pc as evaluacion_pc, pc.puestoarea_pc as puestoarea_pc, pc.descripcion_pc as descripcion_pc 
FROM `er_puestocentro` as pc";

$query = $pdo->prepare($sql);
$query->execute();
$puestoareas_datos = $query->fetchAll(PDO::FETCH_ASSOC);

