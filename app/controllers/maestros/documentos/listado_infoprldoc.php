<?php
include('../../../../app/config.php');
header('Content-Type: application/json');

try {
    $sql = "SELECT id_infodoc, tipoinfo_ifd, nombre_ifd FROM info_documentos";
    $stmt = $pdo->query($sql);
    $documentos = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo json_encode($documentos);
    
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Error al cargar documentos: ' . $e->getMessage()]);
}