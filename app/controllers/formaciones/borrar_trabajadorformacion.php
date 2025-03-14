<?php
include('../../../app/config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_formasistencia = isset($_POST['id_formasistencia']) ? $_POST['id_formasistencia'] : null;

    if ($id_formasistencia) {
        // Iniciar una transacción
        $pdo->beginTransaction();

        try {
            // Obtener el nroformacion del registro a eliminar
            $sentencia_obtener_nroformacion = $pdo->prepare("SELECT nroformacion FROM form_asistencia WHERE id_formasistencia = :id_formasistencia");
            $sentencia_obtener_nroformacion->bindParam(':id_formasistencia', $id_formasistencia, PDO::PARAM_INT);
            $sentencia_obtener_nroformacion->execute();
            $nroformacion = $sentencia_obtener_nroformacion->fetchColumn();

            // Actualizar las filas relacionadas en formacion
            $sentencia_formacion = $pdo->prepare("UPDATE formacion SET nroformacion = NULL WHERE nroformacion = :nroformacion");
            $sentencia_formacion->bindParam(':nroformacion', $nroformacion, PDO::PARAM_INT);
            $sentencia_formacion->execute();

            // Eliminar solo el registro específico en form_asistencia
            $sentencia_asistencia = $pdo->prepare("DELETE FROM form_asistencia WHERE id_formasistencia = :id_formasistencia");
            $sentencia_asistencia->bindParam(':id_formasistencia', $id_formasistencia, PDO::PARAM_INT);
            $sentencia_asistencia->execute();

            // Confirmar la transacción
            $pdo->commit();

            echo "<script>location.href = '{$URL}/admin/formacion/index.php';</script>";
        } catch (Exception $e) {
            // Revertir la transacción en caso de error
            $pdo->rollBack();
            echo "<script>alert('Error al eliminar la asistencia: " . $e->getMessage() . "'); location.href = '{$URL}/admin/formacion/index.php';</script>";
        }
    } else {
        echo "<script>alert('ID de formación de asistencia no válido.'); location.href = '{$URL}/admin/formacion/index.php';</script>";
    }
} else {
    echo "<script>alert('Método no permitido.'); location.href = '{$URL}/admin/formacion/index.php';</script>";
}
?>
