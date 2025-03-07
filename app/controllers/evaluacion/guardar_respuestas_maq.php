<?php
require_once('../../../app/config.php');

// Validar los datos POST
if (!isset($_POST['id_revision'], $_POST['id_maquina'])) {
    die("Error: Faltan datos necesarios para guardar las respuestas.");
}

$id_revision = $_POST['id_revision'];
$id_maquina = $_POST['id_maquina'];
$respuestas = $_POST['respuestas'] ?? []; // Preguntas de tipo RESPUESTA
$observaciones = $_POST['observaciones'] ?? []; // Observaciones asociadas
$planificaciones = $_POST['planificaciones'] ?? []; // Planificaciones (checkbox)
$nivel_riesgo = $_POST['nivel_riesgo'] ?? []; // Nueva (usando el mismo nombre que en el formulario)
$valoracion_equipo = $_POST['valoracion_equipo'] ?? null;
$evaluacion_final = $_POST['evaluacion_final'] ?? [];
$evaluacion_final_str = implode(',', $evaluacion_final);

try {
    // Iniciar una transacción para asegurar consistencia en los datos
    $pdo->beginTransaction();

    // Obtener el id_revision_maquina desde la tabla er_revision_maquina
    $sql_revision_maquina = "SELECT id_revision_maquina 
                             FROM er_revision_maquina 
                             WHERE id_revision = :id_revision AND id_maquina = :id_maquina";
    $stmt_revision_maquina = $pdo->prepare($sql_revision_maquina);
    $stmt_revision_maquina->bindParam(':id_revision', $id_revision, PDO::PARAM_INT);
    $stmt_revision_maquina->bindParam(':id_maquina', $id_maquina, PDO::PARAM_INT);
    $stmt_revision_maquina->execute();
    $revision_maquina = $stmt_revision_maquina->fetch(PDO::FETCH_ASSOC);

    if (!$revision_maquina) {
        throw new Exception("Error: No se encontró la combinación de revisión y máquina.");
    }

    $id_revision_maquina = $revision_maquina['id_revision_maquina'];

    // Insertar las respuestas, observaciones y planificaciones en la tabla er_revisionmaq_respuestas
    $sql_insert = "INSERT INTO er_revisionmaq_respuestas (id_revision_maquina, id_elemento, respuesta, observacion, planificacion, gradoriesgo) 
                   VALUES (:id_revision_maquina, :id_elemento, :respuesta, :observacion, :planificacion, :gradoriesgo)";
    $stmt_insert = $pdo->prepare($sql_insert);

    $sql_update_revision = "UPDATE er_revision_maquina 
                        SET valoracion_equipo = :valoracion_equipo, 
                            evaluacion_final = :evaluacion_final 
                        WHERE id_revision_maquina = :id_revision_maquina";

    $stmt_update_revision = $pdo->prepare($sql_update_revision);
    $stmt_update_revision->execute([
        ':valoracion_equipo' => $valoracion_equipo,
        ':evaluacion_final' => $evaluacion_final_str,
        ':id_revision_maquina' => $id_revision_maquina
    ]);

    // Procesar las preguntas de tipo RESPUESTA
    foreach ($respuestas as $id_elemento => $respuesta) {
        $observacion = $observaciones[$id_elemento] ?? null;
        $planificacion = isset($planificaciones[$id_elemento]) ? 1 : 0;
        $nivel_riesgo_valor = $nivel_riesgo[$id_elemento] ?? null; // Añadir esta línea


        // Insertar la respuesta para preguntas de tipo RESPUESTA
        $stmt_insert->execute([
            ':id_revision_maquina' => $id_revision_maquina,
            ':id_elemento' => $id_elemento,
            ':respuesta' => $respuesta,
            ':observacion' => $observacion,
            ':planificacion' => $planificacion,
            ':gradoriesgo' => $nivel_riesgo_valor // Usar la nueva variable
        ]);
    }

    // Procesar los elementos de tipo OBSERVACION
    foreach ($observaciones as $id_elemento => $observacion) {
        // Si la observación no fue procesada como respuesta, la guardamos
        if (!isset($respuestas[$id_elemento])) {
            $planificacion = isset($planificaciones[$id_elemento]) ? 1 : 0;
            $nivel_riesgo_valor = $nivel_riesgo[$id_elemento] ?? null; // Añadir esta línea

            // Insertar solo la observación, sin respuesta (ya que no hay respuesta para estos elementos)
            $stmt_insert->execute([
                ':id_revision_maquina' => $id_revision_maquina,
                ':id_elemento' => $id_elemento,
                ':respuesta' => null, // No hay respuesta
                ':observacion' => $observacion,
                ':planificacion' => $planificacion,
                ':gradoriesgo' => $nivel_riesgo_valor // Usar la nueva variable

            ]);
        }
    }

    // Confirmar la transacción
    $pdo->commit();

    // Redirigir con un mensaje de éxito
    session_start();
    $_SESSION['mensaje'] = "Respuestas y observaciones guardadas correctamente.";
    $_SESSION['icono'] = "success";
    header("Location: ../../../admin/evaluacion/show_equiposcentro.php?id=" . urlencode($id_revision));
    exit();
} catch (Exception $e) {
    // Revertir la transacción en caso de error
    $pdo->rollBack();
    session_start();
    $_SESSION['mensaje'] = "Error al guardar los datos: " . $e->getMessage();
    $_SESSION['icono'] = "error";
    header("Location: ../../../admin/evaluacion/show_equiposcentro.php?id=" . urlencode($id_revision));
    exit();
}
