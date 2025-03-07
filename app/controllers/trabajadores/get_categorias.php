<?php
include('../../../app/config.php');
header('Content-Type: application/json');

try {
    $stmt = $pdo->query("SELECT id_categoria, nombre_cat FROM categorias ORDER BY nombre_cat");
    echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
} catch (Exception $e) {
    echo json_encode(['error' => $e->getMessage()]);
}