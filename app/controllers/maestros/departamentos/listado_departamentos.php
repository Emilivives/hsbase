<?php

$sql_departamentos = "SELECT * FROM `departamentos`";
$query_departamentos = $pdo->prepare($sql_departamentos);
$query_departamentos->execute();
$departamentos_datos = $query_departamentos->fetchAll(PDO::FETCH_ASSOC);
