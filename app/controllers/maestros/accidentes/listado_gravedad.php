<?php

$sql_ace_gravedad = "SELECT * FROM ace_gravedad";
$query_ace_gravedad = $pdo->prepare($sql_ace_gravedad);
$query_ace_gravedad->execute();
$ace_gravedad_datos = $query_ace_gravedad->fetchAll(PDO::FETCH_ASSOC);

