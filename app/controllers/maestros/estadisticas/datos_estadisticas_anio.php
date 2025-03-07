<?php
// Obtener el año actual
$anio = date('Y');

// Consulta SQL para obtener los datos del año actual
$sql = "SELECT * FROM estadisticas WHERE anio_est = :anio";

try {
    // Preparar y ejecutar la consulta
    $query = $pdo->prepare($sql);
    $query->bindParam(':anio', $anio, PDO::PARAM_INT);
    $query->execute();
    $estadisticas_datos_anio = $query->fetchAll(PDO::FETCH_ASSOC);

    // Verificar si hay resultados
    if (count($estadisticas_datos_anio) > 0) {
        foreach ($estadisticas_datos_anio as $estadisticas_dato_anio) {
            // Asignar los valores a las variables
            $anio_est = $estadisticas_dato_anio['anio_est'] ?? null;
            $mediatr_est = $estadisticas_dato_anio['mediatr_est'] ?? 0;
            $indinciden_est = $estadisticas_dato_anio['indinciden_est'] ?? null;
            $horastranual_est = $estadisticas_dato_anio['horastranual_est'] ?? null;
        }
    } else {
        // Si no hay resultados, asignar valores predeterminados o mostrar mensaje
        $anio_est = null;
        $mediatr_est = 0; // Evitar problemas de división por cero
        $indinciden_est = null;
        $horastranual_est = null;

        echo '<p>No se encontraron datos para el año ' . $anio . '.</p>';
    }
} catch (PDOException $e) {
    // Manejo de errores de la base de datos
    echo '<p>Error en la consulta: ' . $e->getMessage() . '</p>';
}
?>
