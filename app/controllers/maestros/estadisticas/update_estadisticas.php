<?php

$id_estadisticas_get = $_GET['id_estadistica'];

$sql_estadisticas = "SELECT * FROM estadisticas WHERE id_estadistica = $id_estadistica_get";
$query_estadisticas = $pdo->prepare($sql_estadisticas);
$query_estadisticas->execute();
$estadisticas_datos = $query_estadisticas->fetchAll(PDO::FETCH_ASSOC);

foreach ($estadisticas_datos as $estadisticas_dato) {
    $anio_est = $estadisticas_dato['anio_est'];
    $mediatr_est = $estadisticas_dato['mediatr_est'];
    $indinciden_est = $estadisticas_dato['indinciden_est'];
    $horastranual_est = $estadisticas_dato['horastranual_est'];

}
?>