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
        
        // Consultar los datos del trabajador
$sql = "SELECT t.*, c.empresa_cen AS id_empresa 
        FROM trabajadores t
        LEFT JOIN centros c ON t.centro_tr = c.id_centro
        WHERE t.id_trabajador = :id";


        $stmt = $pdo->prepare($sql);
        $stmt->execute([':id' => $id_trabajador]);
        
        if ($stmt->rowCount() === 0) {
            throw new Exception("Trabajador no encontrado");
        }
        
        $trabajador = $stmt->fetch(PDO::FETCH_ASSOC);
        
        // Clear any previous output
        ob_end_clean();
        
        echo json_encode([
            'status' => 'success',
            'trabajador' => $trabajador
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