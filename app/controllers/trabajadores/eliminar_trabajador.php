<?php
include('../../../app/config.php');  
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_trabajador = $_POST['id_trabajador'] ?? null;

    if (!$id_trabajador) {
        echo json_encode([
            'status' => 'error',
            'message' => 'ID de trabajador no proporcionado.'
        ]);
        exit;
    }

    try {
        $pdo->beginTransaction();

        // Eliminar formaciones e información asociadas
        $pdo->prepare("DELETE FROM formacion_trabajador WHERE id_trabajador = ?")->execute([$id_trabajador]);
        $pdo->prepare("DELETE FROM informacion_trabajador WHERE id_trabajador = ?")->execute([$id_trabajador]);

        // Eliminar trabajador
        $stmt = $pdo->prepare("DELETE FROM trabajadores WHERE id_trabajador = ?");
        $stmt->execute([$id_trabajador]);

        $pdo->commit();

        echo json_encode([
            'status' => 'success',
            'message' => 'Trabajador eliminado correctamente.'
        ]);
    } catch (Exception $e) {
        $pdo->rollBack();
        echo json_encode([
            'status' => 'error',
            'message' => 'Error al eliminar: ' . $e->getMessage()
        ]);
    }
} else {
    echo json_encode([
        'status' => 'error',
        'message' => 'Método no permitido.'
    ]);
}
