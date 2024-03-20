<?php

$sql_categorias = "SELECT cat.id_categoria as id_categoria, cat.nombre_cat as nombre_cat, cat.descripcion_cat as descripcion_cat, dpo.nombre_dpo as nombre_dpo FROM `categorias` as cat
INNER JOIN departamentos as dpo WHERE cat.departamento_cat = dpo.id_departamento";
$query_categorias = $pdo->prepare($sql_categorias);
$query_categorias->execute();
$categorias_datos = $query_categorias->fetchAll(PDO::FETCH_ASSOC);
