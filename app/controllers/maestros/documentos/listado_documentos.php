<?php 
$sql_documentos = "SELECT * FROM `documentos`";
$query_documentos = $pdo->prepare($sql_documentos);
$query_documentos->execute();
$documentos_datos = $query_documentos->fetchAll(PDO::FETCH_ASSOC);

