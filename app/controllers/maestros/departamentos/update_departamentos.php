<?php

$id_departamentos_get = $_GET['id_departamento'];

$sql_departamentos = "SELECT * FROM departamentos WHERE id_departamento = $id_departamento_get";
$query_departamentos = $pdo->prepare($sql_departamentos);
$query_departamentos->execute();
$departamentos_datos = $query_departamentos->fetchAll(PDO::FETCH_ASSOC);

foreach ($departamentos_datos as $departamentos_dato) {
    $nombre_dpo = $departamentos_dato['nombre_dpo'];
    $descripcion_dpo = $departamentos_dato['descripcion_dpo'];

}
?>