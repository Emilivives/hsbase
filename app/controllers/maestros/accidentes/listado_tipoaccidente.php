<?php

$sql_ace_tipoaccidente = "SELECT * FROM ace_tipoaccidente";
$query_ace_tipoaccidente = $pdo->prepare($sql_ace_tipoaccidente);
$query_ace_tipoaccidente->execute();
$ace_tipoaccidente_datos = $query_ace_tipoaccidente->fetchAll(PDO::FETCH_ASSOC);

