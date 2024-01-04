<?php

$sql = "SELECT * FROM categorias WHERE id_categoria = $id_categoria";
$query = $pdo->prepare($sql);
$query->execute();
$categorias_datos = $query->fetchAll(PDO::FETCH_ASSOC);

foreach ($categorias_datos as $categorias_dato) {
    $nombre_cat = $categorias_dato['nombre_cat'];
    $descripcion_cat = $categorias_dato['descripcion_cat'];
}
?>