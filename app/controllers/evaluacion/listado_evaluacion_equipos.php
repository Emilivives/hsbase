<?php


try {
    // Consulta para obtener todas las er_equipos_centro
    $sql = "SELECT er_equiposcentro.id_equiposcentro, er_equiposcentro.fecha, er_equiposcentro.descripcion, centros.nombre_cen
    FROM er_equiposcentro
    JOIN centros ON er_equiposcentro.id_centro = centros.id_centro
    ORDER BY er_equiposcentro.fecha DESC";

    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    // Obtener los resultados como un arreglo asociativo
    $er_equipos_centro = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error al obtener las er_equipos_centro: " . $e->getMessage();
    exit;
}

// Retornar los datos para ser utilizados
return $er_equipos_centro;
?>
