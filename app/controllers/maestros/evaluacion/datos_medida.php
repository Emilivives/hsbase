<?php

$sql = "SELECT * FROM er_medidas WHERE id_medida = $id_medida";
$query = $pdo->prepare($sql);
$query->execute();
$medida_datos = $query->fetchAll(PDO::FETCH_ASSOC);

foreach ($medida_datos as $medida_dato) {
    $codigomedida = $medida_dato['codigomedida'];
    $frasemedida = $medida_dato['frasemedida'];

}
?>