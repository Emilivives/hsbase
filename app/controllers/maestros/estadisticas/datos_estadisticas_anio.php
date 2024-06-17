<?php
$anio = date('Y');
$sql = "SELECT * FROM estadisticas WHERE anio_est = $anio";
$query = $pdo->prepare($sql);
$query->execute();
$estadisticas_datos_anio = $query->fetchAll(PDO::FETCH_ASSOC);

foreach ($estadisticas_datos_anio as $estadisticas_dato_anio) {
    $anio_est = $estadisticas_dato_anio['anio_est'];
    $mediatr_est = $estadisticas_dato_anio['mediatr_est'];
    $indinciden_est = $estadisticas_dato_anio['indinciden_est'];
    $horastranual_est = $estadisticas_dato_anio['horastranual_est'];
}
?>