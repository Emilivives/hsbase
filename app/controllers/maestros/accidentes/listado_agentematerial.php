<?php

$sql_ace_agentematerial = "SELECT * FROM ace_agentematerial";
$query_ace_agentematerial = $pdo->prepare($sql_ace_agentematerial);
$query_ace_agentematerial->execute();
$ace_agentematerial_datos = $query_ace_agentematerial->fetchAll(PDO::FETCH_ASSOC);

