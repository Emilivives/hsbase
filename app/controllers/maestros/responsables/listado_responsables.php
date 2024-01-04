<?php

$sql_responsables = "SELECT * FROM `responsables`";
$query_responsables = $pdo->prepare($sql_responsables);
$query_responsables->execute();
$responsables_datos = $query_responsables->fetchAll(PDO::FETCH_ASSOC);
