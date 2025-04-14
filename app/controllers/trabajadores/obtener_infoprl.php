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
        
        // Obtener toda la información PRL disponible
        $sql_todas = "SELECT id_infodoc, nombre_ifd FROM info_documentos ORDER BY nombre_ifd ASC";
        $stmt_todas = $pdo->prepare($sql_todas);
        $stmt_todas->execute();
        $info_todas = $stmt_todas->fetchAll(PDO::FETCH_ASSOC);
        
        // Obtener la información PRL asignada al trabajador
        $sql_trabajador = "SELECT it.id_infodoc, id.nombre_ifd 
                           FROM informacion_trabajador it
                           JOIN info_documentos id ON it.id_infodoc = id.id_infodoc
                           WHERE it.id_trabajador = :id_trabajador";
        
        $stmt_trabajador = $pdo->prepare($sql_trabajador);
        $stmt_trabajador->execute([':id_trabajador' => $id_trabajador]);
        $info_trabajador = $stmt_trabajador->fetchAll(PDO::FETCH_ASSOC);
        
        // Clear any previous output
        ob_end_clean();
        
        echo json_encode([
            'status' => 'success',
            'info_todas' => $info_todas,
            'info_trabajador' => $info_trabajador
        ]);
        
    } catch (Exception $e) {
        // Clear any previous output
        ob_end_clean();
        
        echo json_encode([
            'status' => 'error',
            'message' => 'Error: ' . $e->getMessage()
        ]);
    }
} else {
    // Clear any previous output
    ob_end_clean();
    
    echo json_encode([
        'status' => 'error',
        'message' => 'Método no permitido'
    ]);
}
?>