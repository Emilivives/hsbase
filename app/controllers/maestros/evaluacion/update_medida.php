<?php

$id_medida_get = $_GET['id_medida'];

$sql_medida = "SELECT * FROM er_medidas WHERE id_medida = $id_medida_get";
$query_medida = $pdo->prepare($sql_medida);
$query_medida->execute();
$medida_datos = $query_medida->fetchAll(PDO::FETCH_ASSOC);

foreach ($medida_datos as $medida_dato) {
    $codigomedida = $medida_dato['codigomedida'];
    $frasemedida = $medida_dato['frasemedida'];

}
?>