<?php
include('../../app/config.php');


header('Content-Type: application/json');

$data = json_decode(file_get_contents('php://input'), true);
$id_maquina = $data['id_maquina'] ?? null;

if ($id_maquina) {
    $sql = "SELECT 
                id_revisionoficial, 
                tipo_revof, 
                proveedor_revof, 
                fecha_revof, 
                caducidad_revof, 
                vigente_revof, 
                observaciones_revof 
            FROM inv_revision_oficial 
            WHERE id_equipo = :id_maquina
            ORDER BY fecha_revof DESC";

    $query = $pdo->prepare($sql);
    $query->execute(['id_maquina' => $id_maquina]);
    $records = $query->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($records);
} else {
    echo json_encode([]);
}