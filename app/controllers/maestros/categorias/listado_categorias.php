<?php

$sql_categorias = "SELECT * , nombre_dpo as dpo_nombre_dpo FROM `categorias` as cat
INNER JOIN departamentos as dpo WHERE cat.departamento_cat = dpo.id_departamento";
$query_categorias = $pdo->prepare($sql_categorias);
$query_categorias->execute();
$categorias_datos = $query_categorias->fetchAll(PDO::FETCH_ASSOC);
