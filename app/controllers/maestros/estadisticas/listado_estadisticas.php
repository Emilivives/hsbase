<?php

$sql_estadisticas = "SELECT * FROM `estadisticas`";
$query_estadisticas = $pdo->prepare($sql_estadisticas);
$query_estadisticas->execute();
$estadisticas_datos = $query_estadisticas->fetchAll(PDO::FETCH_ASSOC);
