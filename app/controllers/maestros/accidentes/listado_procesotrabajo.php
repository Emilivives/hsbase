<?php

$sql_ace_procesotrabajo = "SELECT * FROM ace_procesotrabajo";
$query_ace_procesotrabajo = $pdo->prepare($sql_ace_procesotrabajo);
$query_ace_procesotrabajo->execute();
$ace_procesotrabajo_datos = $query_ace_procesotrabajo->fetchAll(PDO::FETCH_ASSOC);

