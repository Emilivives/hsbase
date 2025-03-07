<?php
require_once('../../../app/config.php');

// Verificar que se reciben los parámetros necesarios
if (!isset($_POST['respuesta_id'], $_POST['planificacion'], $_POST['id_revision'], $_POST['id_maquina'])) {
    echo json_encode(['success' => false, 'message' => 'Faltan parámetros']);
    exit();
}

$respuesta_id = $_POST['respuesta_id'];
$planificacion = $_POST['planificacion'];
$id_revision = $_POST['id_revision'];
$id_maquina = $_POST['id_maquina'];

// Actualizar el valor de la planificación en la base de datos
$sql = "UPDATE er_revisionmaq_respuestas 
        SET planificacion = :planificacion 
        WHERE id_respuesta = :respuesta_id 
        AND id_revision_maquina IN (
            SELECT id_revision_maquina 
            FROM er_revision_maquina 
            WHERE id_revision = :id_revision 
            AND id_maquina = :id_maquina
        )";

$stmt = $pdo->prepare($sql);
$stmt->execute([
    ':planificacion' => $planificacion,
    ':respuesta_id' => $respuesta_id,
    ':id_revision' => $id_revision,
    ':id_maquina' => $id_maquina
]);

// Ahora contamos cuántos checkboxes están activados para la máquina
$sql_count = "SELECT COUNT(*) AS planificaciones_activadas
              FROM er_revisionmaq_respuestas
              WHERE id_revision_maquina IN (
                  SELECT id_revision_maquina 
                  FROM er_revision_maquina 
                  WHERE id_revision = :id_revision 
                  AND id_maquina = :id_maquina
              ) 
              AND planificacion = 1";

$stmt_count = $pdo->prepare($sql_count);
$stmt_count->execute([
    ':id_revision' => $id_revision,
    ':id_maquina' => $id_maquina
]);

$result = $stmt_count->fetch(PDO::FETCH_ASSOC);

// Devolver el resultado como JSON
echo json_encode([
    'success' => true,
    'nuevo_conteo' => $result['planificaciones_activadas']
]);
