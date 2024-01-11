<?php

$sql_ace_tipotrabajo = "SELECT * FROM ace_tipotrabajo";
$query_ace_tipotrabajo = $pdo->prepare($sql_ace_tipotrabajo);
$query_ace_tipotrabajo->execute();
$ace_tipotrabajo_datos = $query_ace_tipotrabajo->fetchAll(PDO::FETCH_ASSOC);

