<?php
// Incluir la configuración
include('../../../../app/config.php');

// Obtener los tipos de evaluación
$sql_medidas = "SELECT id_medida, codigomedida, frasemedida FROM er_medidas ORDER BY codigomedida ASC";
$query_medidas = $pdo->prepare($sql_medidas);
$query_medidas->execute();
$medidas_datos = $query_medidas->fetchAll(PDO::FETCH_ASSOC);

// Establecer el encabezado de tipo de contenido a JSON
header('Content-Type: application/json');

// Devolver los datos en formato JSON
echo json_encode($medidas_datos);
?>