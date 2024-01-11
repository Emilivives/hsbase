<?php

$sql_ace_formacontacto = "SELECT * FROM ace_formacontacto";
$query_ace_formacontacto = $pdo->prepare($sql_ace_formacontacto);
$query_ace_formacontacto->execute();
$ace_formacontacto_datos = $query_ace_formacontacto->fetchAll(PDO::FETCH_ASSOC);


