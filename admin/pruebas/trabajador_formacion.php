<?php
// Añade manejo de errores más detallado
error_reporting(E_ALL);
ini_set('display_errors', 1);

include('../../app/config.php');

// Añade un log o impresión para verificar que se está recibiendo el ID
error_log("ID de trabajador recibido: " . $_GET['id_trabajador']);

if (!isset($_GET['id_trabajador'])) {
    http_response_code(400);
    die(json_encode(["error" => "ID del trabajador no definido"]));
}

$id_trabajador = $_GET['id_trabajador'];

try {
    $sql = "SELECT fr.id_formacion, fr.detalle_fr, tf.nombre_tf, fr.fecha_fr, fr.fechacad_fr, tf.duracion_tf, tf.detalles_tf 
            FROM formacion as fr 
            INNER JOIN tipoformacion as tf ON fr.tipo_fr = tf.id_tipoformacion
            INNER JOIN form_asistencia as fas ON fas.nroformacion = fr.nroformacion
            WHERE fas.idtrabajador_fas = ? 
            ORDER BY fr.fecha_fr DESC";

    $query = $pdo->prepare($sql);
    $query->execute([$id_trabajador]);
    $trabajador_formaciones = $query->fetchAll(PDO::FETCH_ASSOC);

    // Añade un log para verificar las formaciones encontradas
    error_log("Formaciones encontradas: " . count($trabajador_formaciones));

    if (empty($trabajador_formaciones)) {
        echo '<div class="alert alert-info">No se encontraron formaciones para este trabajador.</div>';
    } else {
        echo '<div class="table-responsive">';
        echo '<table class="table table-striped">';
        echo '<thead><tr><th>Tipo</th><th>Detalle</th><th>Fecha</th><th>Caducidad</th><th></th></tr></thead>';
        echo '<tbody>';
        foreach ($trabajador_formaciones as $formacion) {
            echo '<tr>';
            echo '<td>' . htmlspecialchars($formacion['nombre_tf'] ?? '') . '</td>';
            echo '<td>' . htmlspecialchars($formacion['detalle_fr'] ?? '') . '</td>';
            echo '<td>' . htmlspecialchars($formacion['fecha_fr'] ?? '') . '</td>';
            echo '<td>' . htmlspecialchars($formacion['fechacad_fr'] ?? '') . '</td>';
            echo '<td><a href="../formacion/show.php?id_formacion=' . $formacion['id_formacion'] . '" class="btn btn-primary btn-sm" title="Ver detalles"><i class="bi bi-folder-fill"></i> Ver</a></td>';
            
            echo '</tr>';
        }
        echo '</tbody></table>';
        echo '</div>';
    }
} catch (Exception $e) {
    // Manejo de errores de base de datos
    error_log("Error al obtener formaciones: " . $e->getMessage());
    echo '<div class="alert alert-danger">Error al cargar las formaciones: ' . htmlspecialchars($e->getMessage()) . '</div>';
}
?>