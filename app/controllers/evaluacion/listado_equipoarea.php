<?php

// Obtener el valor de la URL (GET) correctamente
$evaluacion_eq = $_GET['id_evaluacion']; // Obtener el valor de la evaluación desde la URL

// Consulta SQL para seleccionar los datos filtrados por evaluacion_eq
$sql = "SELECT *, 
    eq.evaluacion_eq as evaluacion_eq, 
    eq.area_eq as area_eq, 
    eq.descripcion_eq as descripcion_eq, 
    eq.factoresriesgo_eq as factoresriesgo_eq, 
    eq.epis_eq as epis_eq, 
    eq.metodos_eq as metodos_eq

FROM `er_equiposcentro` as eq 
WHERE eq.evaluacion_eq = :evaluacion_eq"; // Filtrar por id_evaluacion

// Preparar la consulta
$query = $pdo->prepare($sql);

// Vincular el parámetro de evaluación
$query->bindParam(':evaluacion_eq', $evaluacion_eq, PDO::PARAM_INT);

// Ejecutar la consulta
$query->execute();

// Obtener los resultados
$equipoareas_datos = $query->fetchAll(PDO::FETCH_ASSOC);

// Función para convertir la cadena separada por comas en una lista
function formatCommaSeparated($value) {
    return implode('<br>', explode(',', $value));
}
?>
