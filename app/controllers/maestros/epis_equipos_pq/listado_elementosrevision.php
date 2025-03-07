<?php
// Obtener los tipos de evaluación
$sql_elementosrevision = "SELECT id_elemento, grupo, descripcion, tipo FROM er_elementos_revisionmaq";
$query_elementosrevision = $pdo->prepare($sql_elementosrevision);
$query_elementosrevision->execute();
$elementos_revision_datos = $query_elementosrevision->fetchAll(PDO::FETCH_ASSOC);