<?php

$sql_ace_actividadfisica = "SELECT * FROM ace_actividadfisica";
$query_ace_actividadfisica = $pdo->prepare($sql_ace_actividadfisica);
$query_ace_actividadfisica->execute();
$ace_actividadfisica_datos = $query_ace_actividadfisica->fetchAll(PDO::FETCH_ASSOC);

