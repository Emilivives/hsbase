<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('../../app/config.php');

if (!isset($_GET['id_trabajador'])) {
    http_response_code(400);
    die(json_encode(["error" => "ID del trabajador no definido"]));
}

$id_trabajador = $_GET['id_trabajador'];

try {
    $sql = "SELECT rm.id_reconocimiento, rm.fecha_rm, rm.caducidad_rm, rm.vigente_rm, rm.cita_rm
            FROM reconocimientos as rm
            WHERE rm.trabajador_rm = ?";
    
    $query = $pdo->prepare($sql);
    $query->execute([$id_trabajador]);
    $trabajador_reconocimientos = $query->fetchAll(PDO::FETCH_ASSOC);

    if (empty($trabajador_reconocimientos)) {
        echo '<div class="alert alert-info">No se encontraron reconocimientos para este trabajador.</div>';
    } else {
        echo '<div class="table-responsive">';
        echo '<table class="table table-striped">';
        echo '<thead><tr><th>ID</th><th>Fecha</th><th>Caducidad</th><th>Vigente</th><th>Cita</th></tr></thead>';
        echo '<tbody>';
        foreach ($trabajador_reconocimientos as $reconocimiento) {
            echo '<tr>';
            echo '<td>' . htmlspecialchars($reconocimiento['id_reconocimiento'] ?? '') . '</td>';
            echo '<td>' . htmlspecialchars($reconocimiento['fecha_rm'] ?? '') . '</td>';
            echo '<td>' . htmlspecialchars($reconocimiento['caducidad_rm'] ?? '') . '</td>';
            echo '<td>' . ($reconocimiento['vigente_rm'] ? 'Sí' : 'No') . '</td>';
            echo '<td>' . htmlspecialchars($reconocimiento['cita_rm'] ?? '') . '</td>';
            echo '</tr>';
        }
        echo '</tbody></table>';
        echo '</div>';
    }
} catch (Exception $e) {
    error_log("Error al obtener reconocimientos: " . $e->getMessage());
    echo '<div class="alert alert-danger">Error al cargar los reconocimientos.</div>';
}
?>
