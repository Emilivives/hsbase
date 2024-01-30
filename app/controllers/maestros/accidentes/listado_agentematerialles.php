<?php

$sql_ace_agentematerialles = "SELECT * FROM ace_agentematerialles";
$query_ace_agentematerialles = $pdo->prepare($sql_ace_agentematerialles);
$query_ace_agentematerialles->execute();
$ace_agentematerialles_datos = $query_ace_agentematerialles->fetchAll(PDO::FETCH_ASSOC);

