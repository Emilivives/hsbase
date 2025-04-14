<?php 
$sql_info_documentos = "SELECT * FROM info_documentos"; // Corregido
$query_info_documentos = $pdo->prepare($sql_info_documentos);
$query_info_documentos->execute();
global $info_documentos_datos;// Declarar como global
$info_documentos_datos = $query_info_documentos->fetchAll(PDO::FETCH_ASSOC);
