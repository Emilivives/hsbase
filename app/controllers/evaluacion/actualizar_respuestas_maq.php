<?php
require_once('../../../app/config.php');

// Habilitar todos los errores para depuración
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Log para debugging
error_log("POST recibido: " . print_r($_POST, true));

// Verificar si se reciben los datos necesarios
if (!isset($_POST['id_revision'], $_POST['id_maquina'], $_POST['respuestas'])) {
    error_log("Faltan datos necesarios");
    header('Content-Type: application/json');
    echo json_encode([
        'status' => 'error',
        'message' => 'Faltan datos necesarios para actualizar las respuestas',
        'received' => $_POST
    ]);
    exit;
}

try {
    // Obtener el id_revision_maquina
    $sql_get_revision = "SELECT id_revision_maquina 
                        FROM er_revision_maquina 
                        WHERE id_revision = ? AND id_maquina = ?";
    $stmt_get_revision = $pdo->prepare($sql_get_revision);
    $stmt_get_revision->execute([$_POST['id_revision'], $_POST['id_maquina']]);
    $revision_maquina = $stmt_get_revision->fetch(PDO::FETCH_ASSOC);

    if (!$revision_maquina) {
        throw new Exception("No se encontró la revisión de máquina especificada");
    }

    $pdo->beginTransaction();

    // Actualizar los campos de "valoracion_equipo" y "evaluacion_final"
    $valoracion_equipo = $_POST['valoracion_equipo'] ?? null;
    $evaluacion_final = isset($_POST['evaluacion_final']) ? implode(',', $_POST['evaluacion_final']) : '';

    $sql_update_revision = "UPDATE er_revision_maquina 
                            SET valoracion_equipo = :valoracion_equipo, 
                                evaluacion_final = :evaluacion_final 
                            WHERE id_revision_maquina = :id_revision_maquina";
    $stmt_update_revision = $pdo->prepare($sql_update_revision);
    $stmt_update_revision->execute([
        ':valoracion_equipo' => $valoracion_equipo,
        ':evaluacion_final' => $evaluacion_final,
        ':id_revision_maquina' => $revision_maquina['id_revision_maquina']
    ]);

    // Procesar las respuestas
    foreach ($_POST['respuestas'] as $id_respuesta => $datos) {
        error_log("Procesando respuesta ID: $id_respuesta");
        error_log("Datos de respuesta: " . print_r($datos, true));

        // Verificar si el campo de planificación está presente y marcado
        $planificacion = isset($datos['planificacion']) && $datos['planificacion'] == '1' ? 1 : 0;
        $gradoriesgo = isset($datos['gradoriesgo']) ? $datos['gradoriesgo'] : null;

        $sql = "UPDATE er_revisionmaq_respuestas 
                SET respuesta = :respuesta,
                    observacion = :observacion,
                    planificacion = :planificacion,
                    gradoriesgo = :gradoriesgo
                WHERE id_respuesta = :id_respuesta
                AND id_revision_maquina = :id_revision_maquina";

        $stmt = $pdo->prepare($sql);
        $params = [
            ':respuesta' => $datos['respuesta'],
            ':observacion' => isset($datos['observacion']) ? $datos['observacion'] : null,
            ':planificacion' => $planificacion,
            ':gradoriesgo' => $gradoriesgo, // Nuevo campo agregado
            ':id_respuesta' => $id_respuesta,
            ':id_revision_maquina' => $revision_maquina['id_revision_maquina']
        ];

        error_log("Ejecutando query con parámetros: " . print_r($params, true));

        $stmt->execute($params);

        if ($stmt->rowCount() === 0) {
            error_log("No se actualizó ninguna fila para la respuesta ID: $id_respuesta");
        }
    }

    $pdo->commit();

    header('Content-Type: application/json');
    echo json_encode([
        'status' => 'success',
        'message' => 'Respuestas actualizadas correctamente'
    ]);

} catch (Exception $e) {
    if ($pdo->inTransaction()) {
        $pdo->rollBack();
    }

    error_log("Error en actualización: " . $e->getMessage());
    error_log("Stack trace: " . $e->getTraceAsString());

    header('Content-Type: application/json');
    echo json_encode([
        'status' => 'error',
        'message' => 'Error al actualizar las respuestas: ' . $e->getMessage(),
        'details' => $e->getTraceAsString()
    ]);
}
