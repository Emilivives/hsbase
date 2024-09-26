<?php
// Obtener los tipos de evaluación
$sql_epis = "SELECT id_epi, nombre_epi, normativa_epi FROM epis";
$query_epis = $pdo->prepare($sql_epis);
$query_epis->execute();
$epis_datos = $query_epis->fetchAll(PDO::FETCH_ASSOC);