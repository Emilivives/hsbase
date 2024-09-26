<?php

// Obtener el valor de la URL (GET) correctamente
$evaluacion_pc = $_GET['id_evaluacion']; // Obtener el valor de la evaluación desde la URL

// Consulta SQL para seleccionar los datos filtrados por evaluacion_pc
$sql = "SELECT *, 
    pc.evaluacion_pc as evaluacion_pc, 
    pc.puestoarea_pc as puestoarea_pc, 
    pc.descripcion_pc as descripcion_pc, 
    pc.factoresriesgo_pc as factoresriesgo_pc, 
    pc.sensible_pc as sensible_pc, 
    pc.siniestralidad_pc as siniestralidad_pc, 
    pc.epis_pc as epis_pc, 
    pc.equipos_pc as equipos_pc, 
    pc.prodquim_pc as prodquim_pc, 
    pc.metodos_pc as metodos_pc, 
    pc.factorpsico_pc as factorpsico_pc
FROM `er_puestocentro` as pc 
WHERE pc.evaluacion_pc = :evaluacion_pc"; // Filtrar por id_evaluacion

// Preparar la consulta
$query = $pdo->prepare($sql);

// Vincular el parámetro de evaluación
$query->bindParam(':evaluacion_pc', $evaluacion_pc, PDO::PARAM_INT);

// Ejecutar la consulta
$query->execute();

// Obtener los resultados
$puestoareas_datos = $query->fetchAll(PDO::FETCH_ASSOC);

// Función para convertir la cadena separada por comas en una lista
function formatCommaSeparated($value) {
    return implode('<br>', explode(',', $value));
}
?>
