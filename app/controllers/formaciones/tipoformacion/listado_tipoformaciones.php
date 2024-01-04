<?php

$sql = "SELECT * FROM tipoformacion";

$query_tipoformaciones = $pdo->prepare($sql);
$query_tipoformaciones ->execute();
$tipoformaciones_datos = $query_tipoformaciones->fetchAll(PDO::FETCH_ASSOC);


