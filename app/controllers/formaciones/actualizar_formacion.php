<?php
// actualizar_formacion.php
include('../../../app/config.php');

header('Content-Type: application/json; charset=utf-8');

// Check if it's a POST request
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode([
        'status' => 'error',
        'message' => 'Método no permitido'
    ]);
    exit;
}

try {
    // Validate and get POST data
    $nroformacion = isset($_POST['nroformacion']) ? $_POST['nroformacion'] : '';
    $tipo_fr = isset($_POST['tipo_fr']) ? $_POST['tipo_fr'] : '';
    $fecha_fr = isset($_POST['fecha_fr']) ? $_POST['fecha_fr'] : '';
    $fechacad_fr = isset($_POST['fechacad_fr']) ? $_POST['fechacad_fr'] : '';
    $formador_fr = isset($_POST['formador_fr']) ? $_POST['formador_fr'] : '';
    $detalle_fr = isset($_POST['detalle_fr']) ? $_POST['detalle_fr'] : '';
    // Start transaction
    $pdo->beginTransaction();

    // Update query
    $sentencia = $pdo->prepare("UPDATE formacion 
        SET tipo_fr = :tipo_fr, 
            fecha_fr = :fecha_fr, 
            fechacad_fr = :fechacad_fr, 
            formador_fr = :formador_fr,
            detalle_fr = :detalle_fr
        WHERE nroformacion = :nroformacion");

    // Bind parameters
    $sentencia->bindParam(':nroformacion', $nroformacion);
    $sentencia->bindParam(':tipo_fr', $tipo_fr);
    $sentencia->bindParam(':fecha_fr', $fecha_fr);
    $sentencia->bindParam(':fechacad_fr', $fechacad_fr);
    $sentencia->bindParam(':formador_fr', $formador_fr);
    $sentencia->bindParam(':detalle_fr', $detalle_fr);

    // Execute and check result
    if ($sentencia->execute()) {
        // Get updated data
        $stmt = $pdo->prepare("SELECT * FROM formacion WHERE nroformacion = :nroformacion");
        $stmt->bindParam(':nroformacion', $nroformacion);
        $stmt->execute();
        $updated_data = $stmt->fetch(PDO::FETCH_ASSOC);

        $pdo->commit();
        
        echo json_encode([
            'status' => 'success',
            'message' => 'Formación actualizada correctamente',
            'data' => $updated_data
        ]);
    } else {
        throw new Exception("Error al actualizar la formación");
    }

} catch (Exception $e) {
    if ($pdo->inTransaction()) {
        $pdo->rollBack();
    }
    
    echo json_encode([
        'status' => 'error',
        'message' => $e->getMessage()
    ]);
}
?>
