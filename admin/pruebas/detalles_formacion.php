<?php
// Configuración de errores
error_reporting(E_ALL);
ini_set('display_errors', 1);

include('../../app/config.php');

// Verificación del ID (usando POST para consistencia con el otro código)
if (!isset($_POST['id_trabajador'])) {
    http_response_code(400);
    die(json_encode(["error" => "ID del trabajador no definido"]));
}

$id_trabajador = $_POST['id_trabajador'];

try {
    // Consulta mejorada para formaciones del trabajador
    $sql = "SELECT 
                fr.id_formacion, 
                fr.detalle_fr, 
                tf.nombre_tf, 
                fr.fecha_fr, 
                fr.fechacad_fr,
                tf.duracion_tf, 
                tf.detalles_tf,
                ft.estado AS estado_trabajador
                        FROM formacion as fr 
            INNER JOIN tipoformacion as tf ON fr.tipo_fr = tf.id_tipoformacion
            INNER JOIN form_asistencia as fas ON fas.nroformacion = fr.nroformacion
            LEFT JOIN formacion_trabajador ft ON (ft.id_tipoformacion = tf.id_tipoformacion AND ft.id_trabajador = ?)
            WHERE fas.idtrabajador_fas = ? 
            ORDER BY fr.fecha_fr DESC";

    $query = $pdo->prepare($sql);
    $query->execute([$id_trabajador, $id_trabajador]);
    $formaciones = $query->fetchAll(PDO::FETCH_ASSOC);

    if (empty($formaciones)) {
        echo '<div class="alert alert-info">No se encontraron formaciones para este trabajador.</div>';
    } else {
        echo '<div class="table-responsive">';
        echo '<table class="table table-striped table-hover">';
        echo '<thead class="table-primary">
                <tr>
                    <th>Formación</th>
                    <th>Realizada</th>
                    <th>Vence</th>
                    <th>Detalle</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
              </thead>';
        echo '<tbody>';

        foreach ($formaciones as $formacion) {
            $estado = $formacion['estado_trabajador'] ?? 'Pendiente';
            $badgeClass = ($estado === 'Completado') ? 'bg-success' : 'bg-warning';

            echo '<tr>';
            echo '<td>' . htmlspecialchars($formacion['nombre_tf'] ?? 'N/A') . '</td>';
            echo '<td>' . ($formacion['fecha_fr'] ? date('d/m/Y', strtotime($formacion['fecha_fr'])) : 'N/A') . '</td>';
            echo '<td>' . ($formacion['fechacad_fr'] ? date('d/m/Y', strtotime($formacion['fechacad_fr'])) : 'N/A') . '</td>';
            echo '<td>' . htmlspecialchars($formacion['detalle_fr'] ?? '') . '</td>';
            echo '<td><span class="badge ' . $badgeClass . '">' . htmlspecialchars($estado) . '</span></td>';
  
            echo '<td>
                    <a href="../formacion/show.php?id_formacion=' . $formacion['id_formacion'] . '" 
                       class="btn btn-sm btn-outline-primary" 
                       title="Ver detalles">
                       <i class="bi bi-eye"></i>
                    </a>
                  </td>';
            echo '</tr>';
        }

        echo '</tbody></table>';
        echo '</div>';
    }
} catch (PDOException $e) {
    error_log("Error en base de datos: " . $e->getMessage());
    echo '<div class="alert alert-danger">Error al cargar formaciones: ' . htmlspecialchars($e->getMessage()) . '</div>';
} catch (Exception $e) {
    error_log("Error general: " . $e->getMessage());
    echo '<div class="alert alert-danger">Ocurrió un error inesperado</div>';
}
