<?php

$sql_ace_agentematerialdesv = "SELECT * FROM ace_agentematerialdesv";
$query_ace_agentematerialdesv = $pdo->prepare($sql_ace_agentematerialdesv);
$query_ace_agentematerialdesv->execute();
$ace_agentematerialdesv_datos = $query_ace_agentematerialdesv->fetchAll(PDO::FETCH_ASSOC);

