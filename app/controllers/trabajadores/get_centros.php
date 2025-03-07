<?php
include('../../../app/config.php');


header('Content-Type: application/json');

try {
    $stmt = $pdo->query("SELECT id_centro, nombre_cen FROM centros ORDER BY nombre_cen");
    echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
} catch (Exception $e) {
    echo json_encode(['error' => $e->getMessage()]);
}