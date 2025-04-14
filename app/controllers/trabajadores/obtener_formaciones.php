<?php
// Ensure no output before JSON
ob_start();

include('../../config.php');

// Set proper JSON header
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
        // Obtener el ID del trabajador
        $id_trabajador = $_POST['id_trabajador'] ?? '';
        
        if (empty($id_trabajador)) {
            throw new Exception("ID de trabajador no proporcionado");
        }
        
        // Obtener todas las formaciones disponibles
        $sql_todas = "SELECT id_tipoformacion, nombre_tf FROM tipoformacion ORDER BY nombre_tf ASC";
        $stmt_todas = $pdo->prepare($sql_todas);
        $stmt_todas->execute();
        $formaciones_todas = $stmt_todas->fetchAll(PDO::FETCH_ASSOC);
        
        // Obtener las formaciones asignadas al trabajador
        $sql_trabajador = "SELECT id_tipoformacion FROM formacion_trabajador WHERE id_trabajador = :id_trabajador";
        $stmt_trabajador = $pdo->prepare($sql_trabajador);
        $stmt_trabajador->execute([':id_trabajador' => $id_trabajador]);
        $formaciones_trabajador = $stmt_trabajador->fetchAll(PDO::FETCH_COLUMN);

        // Armar el array final con "completado"
        $formaciones = [];
        foreach ($formaciones_todas as $formacion) {
            $formaciones[] = [
                'id_formacion' => $formacion['id_tipoformacion'],
                'nombre_formacion' => $formacion['nombre_tf'],
                'completado' => in_array($formacion['id_tipoformacion'], $formaciones_trabajador) ? 'Si' : 'No'
            ];
        }

        // Clear any previous output
        ob_end_clean();
        
        echo json_encode([
            'status' => 'success',
            'formaciones' => $formaciones
        ]);
        
    } catch (Exception $e) {
        ob_end_clean();
        echo json_encode([
            'status' => 'error',
            'message' => 'Error: ' . $e->getMessage()
        ]);
    }
} else {
    ob_end_clean();
    echo json_encode([
        'status' => 'error',
        'message' => 'Método no permitido'
    ]);
}
?>
