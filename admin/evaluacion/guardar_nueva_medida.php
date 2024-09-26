<?php
// Conexión a la base de datos

include('../../app/config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_medida_anterior = $_POST['id_medida'];
    $codigomedida = $_POST['codigomedida'];
    $frasemedida = $_POST['frasemedida'];

    try {
        $pdo->beginTransaction();

        // Insertar una nueva medida en er_medidas
        $stmt = $pdo->prepare("INSERT INTO er_medidas (codigomedida, frasemedida) VALUES (:codigomedida, :frasemedida)");
        $stmt->bindParam(':codigomedida', $codigomedida);
        $stmt->bindParam(':frasemedida', $frasemedida);
        $stmt->execute();
        
        $nuevo_id_medida = $pdo->lastInsertId();  // Obtener el id de la nueva medida insertada

        // Actualizar la tabla er_filamedidas
        $stmt2 = $pdo->prepare("UPDATE er_filamedidas SET medida_fm = :nuevo_id_medida WHERE medida_fm = :id_medida_anterior");
        $stmt2->bindParam(':nuevo_id_medida', $nuevo_id_medida);
        $stmt2->bindParam(':id_medida_anterior', $id_medida_anterior);
        $stmt2->execute();

        $pdo->commit();

        // Responder con éxito
        echo json_encode(['success' => true]);
    } catch (Exception $e) {
        $pdo->rollBack();
        echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    }
}
?>
