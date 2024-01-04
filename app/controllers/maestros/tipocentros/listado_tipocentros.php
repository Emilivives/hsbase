<?php

$sql_tipocentros = "SELECT * FROM `tipocentros`";
$query_tipocentros = $pdo->prepare($sql_tipocentros);
$query_tipocentros->execute();
$tipocentros_datos = $query_tipocentros->fetchAll(PDO::FETCH_ASSOC);
