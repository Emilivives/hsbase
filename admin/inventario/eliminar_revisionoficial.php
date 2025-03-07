<?php
include('../../app/config.php');

// Obtener los datos enviados por AJAX
$data = json_decode(file_get_contents('php://input'), true);
$id_revisionoficial = $data['id_revisionoficial'];

// Preparar y ejecutar la consulta de eliminación
$sql = "DELETE FROM inv_revision_oficial WHERE id_revisionoficial = :id_revisionoficial";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':id_revisionoficial', $id_revisionoficial, PDO::PARAM_INT);

if ($stmt->execute()) {
    // Si la eliminación es exitosa, retornar éxito
    echo json_encode(['success' => true]);
} else {
    // Si hay un error, retornar un mensaje de error
    echo json_encode(['success' => false]);
}
?>
