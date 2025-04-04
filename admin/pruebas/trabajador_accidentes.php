<?php
// Manejo de errores detallado
error_reporting(E_ALL);
ini_set('display_errors', 1);

include('../../app/config.php');

// Verificamos si se recibe el ID del trabajador
if (!isset($_GET['id_trabajador'])) {
    http_response_code(400);
    die(json_encode(["error" => "ID del trabajador no definido"]));
}

$id_trabajador = $_GET['id_trabajador'];

try {
    $sql = "SELECT *, ta.tipoaccidente_ta as tipoaccidente_ta, ace.fecha_ace as fecha_ace, ace.fechabaja_ace as fechabaja_ace, cen.nombre_cen as nombre_cen
            FROM accidentes as ace 
            INNER JOIN ace_tipoaccidente as ta ON ace.tipoaccidente_ace = ta.id_tipoaccidente
            INNER JOIN centros as cen ON ace.centro_ace = cen.id_centro
            WHERE ace.trabajador_ace = :id_trabajador
            ORDER BY ace.fecha_ace DESC";

    $query = $pdo->prepare($sql);
    $query->execute(['id_trabajador' => $id_trabajador]);
    $trabajador_accidentes = $query->fetchAll(PDO::FETCH_ASSOC);

    if (empty($trabajador_accidentes)) {
        echo '<div class="alert alert-info">No se encontraron accidentes para este trabajador.</div>';
    } else {
        echo '<div class="table-responsive">';
        echo '<table class="table table-striped">';
        echo '<thead><tr><th>Tipo Accidente</th><th>Fecha</th><th>Fecha Baja</th><th>Centro</th></tr></thead>';
        echo '<tbody>';
        foreach ($trabajador_accidentes as $accidente) {
            echo '<tr>';
            echo '<td>' . htmlspecialchars($accidente['tipoaccidente_ta'] ?? '') . '</td>';
            echo '<td>' . htmlspecialchars($accidente['fecha_ace'] ?? '') . '</td>';
            echo '<td>' . htmlspecialchars($accidente['fechabaja_ace'] ?? '') . '</td>';
            echo '<td>' . htmlspecialchars($accidente['nombre_cen'] ?? '') . '</td>';
            echo '</tr>';
        }
        echo '</tbody></table>';
        echo '</div>';
    }
} catch (Exception $e) {
    // Manejo de errores
    error_log("Error al obtener accidentes: " . $e->getMessage());
    echo '<div class="alert alert-danger">Error al cargar los accidentes: ' . htmlspecialchars($e->getMessage()) . '</div>';
}
?>
