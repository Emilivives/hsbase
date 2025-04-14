<?php
// Configuración de errores
error_reporting(E_ALL);
ini_set('display_errors', 1);

include('../../app/config.php');

// Verificación del ID
if (!isset($_POST['id_trabajador'])) {
    http_response_code(400);
    die(json_encode(["error" => "ID del trabajador no definido"]));
}

$id_trabajador = $_POST['id_trabajador'];

try {
    // Consulta actualizada con JOIN a informacion_trabajador
    $sql = "SELECT  
                it.id_infodoc,
                it.estado,
                ifd.nombre_ifd,
                it.fecha_asignacion,
                it.fecha_completado
            FROM informacion_trabajador AS it
            INNER JOIN info_documentos AS ifd ON it.id_infodoc = ifd.id_infodoc
            WHERE it.id_trabajador = ?
            ORDER BY it.fecha_asignacion DESC";

    $query = $pdo->prepare($sql);
    $query->execute([$id_trabajador]);
    $informaciones = $query->fetchAll(PDO::FETCH_ASSOC);

    if (empty($informaciones)) {
        echo '<div class="alert alert-info">No se encontró información para este trabajador.</div>';
    } else {
        echo '<div class="table-responsive">';
        echo '<table class="table table-striped table-hover">';
        echo '<thead class="table-primary">
                <tr>
                    <th>Documento</th>
                    <th>estado</th>
                    <th>Fecha Asignación</th>
                    <th>Fecha Completado</th>
                    <th>Acciones</th>
                </tr>
              </thead>';
        echo '<tbody>';
        
        foreach ($informaciones as $info) {
             // Determinar clase CSS según el estado
             $estado = $info['estado'] ?? 'Pendiente';
             $badgeClass = '';
             
             if (stripos($estado, 'completado') !== false || stripos($estado, 'valido') !== false) {
                 $badgeClass = 'bg-success';
             } elseif (stripos($estado, 'pendiente') !== false || stripos($estado, 'caducado') !== false) {
                 $badgeClass = 'bg-warning text-dark';
             } else {
                 $badgeClass = 'bg-info';
             }
            // Formatear fechas
            $fechaAsignacion = $info['fecha_asignacion'] ? date('d/m/Y', strtotime($info['fecha_asignacion'])) : 'N/A';
            $fechaCompletado = $info['fecha_completado'] ? date('d/m/Y', strtotime($info['fecha_completado'])) : 'N/A';
            
            echo '<tr>';
            echo '<td>' . htmlspecialchars($info['nombre_ifd'] ?? 'N/A') . '</td>';
            echo '<td><span class="badge ' . $badgeClass . '" data-bs-toggle="tooltip" title="' . 
                 ($estado ? 'Completado: ' . $estado : 'Pendiente') . '">' . 
                 htmlspecialchars($estado) . '</span></td>';
            echo '<td>' . $fechaAsignacion . '</td>';
            echo '<td>' . $fechaCompletado . '</td>';
            echo '<td>
                    <a href="../documentos/show.php?id_doc=' . $info['id_infodoc'] . '" 
                       class="btn btn-sm btn-outline-secondary" 
                       title="Ver documento"
                       target="_blank">
                       <i class="bi bi-eye"></i>
                    </a>
                  </td>';
            echo '</tr>';
        }
        
        echo '</tbody></table>';
        echo '</div>';
    }
} catch (PDOException $e) {
    error_log("Error en base de datos PRL: " . $e->getMessage());
    echo '<div class="alert alert-danger">Error al cargar información PRL: ' . htmlspecialchars($e->getMessage()) . '</div>';
} catch (Exception $e) {
    error_log("Error general PRL: " . $e->getMessage());
    echo '<div class="alert alert-danger">Ocurrió un error al cargar la información PRL</div>';
}
?>
