<?php

$sql_ace_desviacion = "SELECT * FROM ace_desviacion";
$query_ace_desviacion = $pdo->prepare($sql_ace_desviacion);
$query_ace_desviacion->execute();
$ace_desviacion_datos = $query_ace_desviacion->fetchAll(PDO::FETCH_ASSOC);

