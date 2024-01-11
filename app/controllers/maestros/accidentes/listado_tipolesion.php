<?php

$sql_ace_tipolesion = "SELECT * FROM ace_tipolesion";
$query_ace_tipolesion = $pdo->prepare($sql_ace_tipolesion);
$query_ace_tipolesion->execute();
$ace_tipolesion_datos = $query_ace_tipolesion->fetchAll(PDO::FETCH_ASSOC);


