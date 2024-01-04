<?php

$sql_perfiles = "SELECT * FROM `tb_perfiles`";
$query_perfiles = $pdo->prepare($sql_perfiles);
$query_perfiles->execute();
$perfiles_datos = $query_perfiles->fetchAll(PDO::FETCH_ASSOC);
