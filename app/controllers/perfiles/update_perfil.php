<?php

$id_perfil_get = $_GET['id_perfil'];

$sql_perfiles = "SELECT * FROM tb_perfiles WHERE id_perfil = $id_perfil_get";
$query_perfiles = $pdo->prepare($sql_perfiles);
$query_perfiles->execute();
$perfiles_datos = $query_perfiles->fetchAll(PDO::FETCH_ASSOC);

foreach ($perfiles_datos as $perfiles_dato) {
    $nombre_pf = $perfiles_dato['nombre_pf'];
}
?>