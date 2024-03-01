<?php

$sql = "SELECT * FROM departamentos WHERE id_departamento = $id_departamento";
$query = $pdo->prepare($sql);
$query->execute();
$departamentos_datos = $query->fetchAll(PDO::FETCH_ASSOC);

foreach ($departamentos_datos as $departamentos_dato) {
    $nombre_dpo = $departamentos_dato['nombre_dpo'];
    $descripcion_dpo = $departamentos_dato['descripcion_dpo'];
}
?>