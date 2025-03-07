<?php

include('../../../app/config.php');

// Verificar si es una petición para obtener años únicos
if (isset($_GET['getAnios'])) {
    try {
        $query = "SELECT DISTINCT YEAR(fecha_inicio) AS anio FROM vacacion_gen ORDER BY anio DESC";
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        $anios = $stmt->fetchAll(PDO::FETCH_COLUMN);
        echo json_encode($anios); // Devolver los años como JSON
    } catch (Exception $e) {
        echo json_encode(['error' => $e->getMessage()]);
    }
    exit; // Detener la ejecución para evitar que se envíen otros datos
}

// Obtener parámetro de filtrado (año) para los datos de DataTables
$anio = isset($_GET['anio']) ? intval($_GET['anio']) : null;

// Consulta principal para obtener datos de vacaciones generadas y consumidas por trabajador
$query = "SELECT 
        t.id_trabajador,
        t.nombre_tr AS trabajador,
        t.dni_tr,
        t.codigo_tr,
        :anio AS anio,  -- Año que se filtra
        COALESCE(generado.total_generado, 0) AS total_generado,  -- Suma de todos los generados
        COALESCE(consumido.total_consumido, 0) AS total_consumido,  -- Suma de todos los consumidos donde descuenta = 1
        COALESCE(generado.total_generado, 0) - COALESCE(consumido.total_consumido, 0) AS saldo  -- Balance
    FROM trabajadores t
    LEFT JOIN (
        SELECT 
            id_trabajador, 
            SUM(generado) AS total_generado 
        FROM vacacion_gen
        WHERE :anio IS NULL OR YEAR(fecha_inicio) = :anio
        GROUP BY id_trabajador
    ) AS generado ON t.id_trabajador = generado.id_trabajador
    LEFT JOIN (
        SELECT 
            id_trabajador, 
            SUM(consumido) AS total_consumido 
        FROM vacacion_con
        WHERE 
            descuenta = 1  -- Solo sumar cuando descuenta = 1
            AND (:anio IS NULL OR YEAR(fecha_inicio) = :anio)
        GROUP BY id_trabajador
    ) AS consumido ON t.id_trabajador = consumido.id_trabajador
    ORDER BY t.nombre_tr ASC;
";




try {
    $stmt = $pdo->prepare($query);

    // Vincular parámetro de año si se proporciona
    if ($anio) {
        $stmt->bindParam(':anio', $anio, PDO::PARAM_INT);
    } else {
        $anio = null; // Pasamos NULL para que considere todos los años
        $stmt->bindParam(':anio', $anio, PDO::PARAM_NULL);
    }

    $stmt->execute();
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Devolver los datos en formato JSON para DataTables
    echo json_encode([
        "data" => $data
    ]);
} catch (Exception $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
?>
