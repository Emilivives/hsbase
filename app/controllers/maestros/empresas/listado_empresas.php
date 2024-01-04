<?php

$sql_empresas = "SELECT * FROM `empresa`";
$query_empresas = $pdo->prepare($sql_empresas);
$query_empresas->execute();
$empresas_datos = $query_empresas->fetchAll(PDO::FETCH_ASSOC);
