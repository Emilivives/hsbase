<?php
// Obtener los tipos de evaluación
$sql_riesgos = "SELECT id_riesgo, codigoriesgo, fraseriesgo FROM er_riesgos";
$query_riesgos = $pdo->prepare($sql_riesgos);
$query_riesgos->execute();
$riesgos_datos = $query_riesgos->fetchAll(PDO::FETCH_ASSOC);