<?php
include('../../../app/config.php');


// Obtener los parámetros de la URL
$id_revision = $_GET['id_revision'];
$id_maquina = $_GET['id_maquina'];

try {
    // Iniciar la transacción
    $pdo->beginTransaction();
    
    // Eliminar las respuestas asociadas a esta máquina y revisión
    $sql_respuestas = "DELETE FROM er_revisionmaq_respuestas WHERE id_revision_maquina IN (
        SELECT id_revision_maquina FROM er_revision_maquina WHERE id_revision = :id_revision AND id_maquina = :id_maquina
    )";
    $stmt_respuestas = $pdo->prepare($sql_respuestas);
    $stmt_respuestas->bindParam(':id_revision', $id_revision, PDO::PARAM_INT);
    $stmt_respuestas->bindParam(':id_maquina', $id_maquina, PDO::PARAM_INT);
    $stmt_respuestas->execute();
    
    // Eliminar el registro de la tabla er_revision_maquina
    $sql_maquina = "DELETE FROM er_revision_maquina WHERE id_revision = :id_revision AND id_maquina = :id_maquina";
    $stmt_maquina = $pdo->prepare($sql_maquina);
    $stmt_maquina->bindParam(':id_revision', $id_revision, PDO::PARAM_INT);
    $stmt_maquina->bindParam(':id_maquina', $id_maquina, PDO::PARAM_INT);
    $stmt_maquina->execute();
    
    // Si todo salió bien, confirmar la transacción
    $pdo->commit();
    
    // Redirigir al usuario después de la eliminación
    $_SESSION['mensaje'] = "La máquina ha sido eliminada correctamente.";
    $_SESSION['icono'] = "success";
    header("Location: ../../../admin/evaluacion/show_equiposcentro.php?id=" . urlencode($id_revision));
} catch (Exception $e) {
    // Si ocurre un error, revertir la transacción
    $pdo->rollBack();
    $_SESSION['mensaje'] = "Error al eliminar la máquina: " . $e->getMessage();
    $_SESSION['icono'] = "error";
    header("Location: ../../../admin/evaluacion/show_equiposcentro.php?id=" . urlencode($id_revision));
}
exit();
