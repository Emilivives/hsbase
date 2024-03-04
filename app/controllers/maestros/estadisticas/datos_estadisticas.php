<?php

$sql = "SELECT * FROM estadisticas WHERE id_estadistica = $id_estadistica";
$query = $pdo->prepare($sql);
$query->execute();
$estadisticas_datos = $query->fetchAll(PDO::FETCH_ASSOC);

foreach ($estadisticas_datos as $estadisticas_dato) {
    $anio_est = $estadisticas_dato['anio_est'];
    $mediatr_est = $estadisticas_dato['mediatr_est'];
    $indinciden_est = $estadisticas_dato['indinciden_est'];
    $horastranual_est = $estadisticas_dato['horastranual_est'];
}
?>