<?php
// Habilitar el reporte de errores para depuración
error_reporting(E_ALL);
ini_set('display_errors', 1);

include('../../app/config.php');

// Verificar si se ha recibido el ID del trabajador
if (!isset($_GET['id_trabajador'])) {
    http_response_code(400);
    die(json_encode(["error" => "ID del trabajador no definido"]));
}

$id_trabajador = $_GET['id_trabajador'];
error_log("ID de trabajador recibido: " . $id_trabajador);

try {
    $sql = "SELECT ifd.nombre_ifd, ifd.tipoinfo_ifd, eif.fechaentrega
            FROM info_entregainfo AS eif
            INNER JOIN info_documentos AS ifd ON eif.id_infodoc = ifd.id_infodoc
            WHERE eif.id_trabajador = ?
            ORDER BY eif.fechaentrega DESC";

    $query = $pdo->prepare($sql);
    $query->execute([$id_trabajador]);
    $trabajador_informaciones = $query->fetchAll(PDO::FETCH_ASSOC);

    // Log para depuración
    error_log("Información PRL encontrada: " . count($trabajador_informaciones));

    if (empty($trabajador_informaciones)) {
        echo '<div class="alert alert-info">No se encontró información PRL para este trabajador.</div>';
    } else {
        echo '<div class="table-responsive">';
        echo '<table class="table table-striped">';
        echo '<thead><tr><th>Tipo</th><th>Nombre</th><th>Fecha Entrega</th></tr></thead>';
        echo '<tbody>';
        foreach ($trabajador_informaciones as $info) {
            echo '<tr>';
            echo '<td>' . htmlspecialchars($info['tipoinfo_ifd'] ?? '') . '</td>';
            echo '<td>' . htmlspecialchars($info['nombre_ifd'] ?? '') . '</td>';
            echo '<td>' . htmlspecialchars($info['fechaentrega'] ?? '') . '</td>';
            echo '</tr>';
        }
        echo '</tbody></table>';
        echo '</div>';
    }
} catch (Exception $e) {
    error_log("Error al obtener la información PRL: " . $e->getMessage());
    echo '<div class="alert alert-danger">Error al cargar la información PRL: ' . htmlspecialchars($e->getMessage()) . '</div>';
}
?>
