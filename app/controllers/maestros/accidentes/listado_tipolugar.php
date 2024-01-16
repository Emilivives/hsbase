<?php

$sql_ace_tipolugar = "SELECT * FROM ace_tipolugar";
$query_ace_tipolugar = $pdo->prepare($sql_ace_tipolugar);
$query_ace_tipolugar->execute();
$ace_tipolugar_datos = $query_ace_tipolugar->fetchAll(PDO::FETCH_ASSOC);

