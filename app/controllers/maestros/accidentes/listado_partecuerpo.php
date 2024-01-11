<?php

$sql_ace_partecuerpo = "SELECT * FROM ace_partecuerpo";
$query_ace_partecuerpo = $pdo->prepare($sql_ace_partecuerpo);
$query_ace_partecuerpo->execute();
$ace_partecuerpo_datos = $query_ace_partecuerpo->fetchAll(PDO::FETCH_ASSOC);

