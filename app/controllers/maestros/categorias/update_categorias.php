<?php

$id_categorias_get = $_GET['id_categoria'];

$sql_categorias = "SELECT * FROM categorias WHERE id_categoria = $id_categoria_get";
$query_categorias = $pdo->prepare($sql_categorias);
$query_categorias->execute();
$categorias_datos = $query_categorias->fetchAll(PDO::FETCH_ASSOC);

foreach ($categorias_datos as $categorias_dato) {
    $nombre_cat = $categorias_dato['nombre_cat'];
    $descripcion_cat = $categorias_dato['descripcion_cat'];

}
?>