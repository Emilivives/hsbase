<?php
include('../../app/config.php');

header('Content-Type: application/json');

// Leer los datos enviados desde el cliente
$data = json_decode(file_get_contents('php://input'), true);

// Extraer los valores
$id_revisionoficial = $data['id_revisionoficial'] ?? null;
$tipo_revof = $data['tipo_revof'] ?? null;
$proveedor_revof = $data['proveedor_revof'] ?? null;
$fecha_revof = $data['fecha_revof'] ?? null;
$caducidad_revof = $data['caducidad_revof'] ?? null;
$vigente_revof = $data['vigente_revof'] ?? null;
$observaciones_revof = $data['observaciones_revof'] ?? null;

// Verificar que todos los campos necesarios estén presentes
if ($id_revisionoficial && $tipo_revof && $proveedor_revof && $fecha_revof && $caducidad_revof && $vigente_revof !== null) {
    $sql = "UPDATE inv_revision_oficial 
            SET 
                tipo_revof = :tipo_revof, 
                proveedor_revof = :proveedor_revof, 
                fecha_revof = :fecha_revof, 
                caducidad_revof = :caducidad_revof, 
                vigente_revof = :vigente_revof, 
                observaciones_revof = :observaciones_revof 
            WHERE 
                id_revisionoficial = :id_revisionoficial";

    $stmt = $pdo->prepare($sql);
    $success = $stmt->execute([
        'tipo_revof' => $tipo_revof,
        'proveedor_revof' => $proveedor_revof,
        'fecha_revof' => $fecha_revof,
        'caducidad_revof' => $caducidad_revof,
        'vigente_revof' => $vigente_revof,
        'observaciones_revof' => $observaciones_revof,
        'id_revisionoficial' => $id_revisionoficial
    ]);

    echo json_encode(['success' => $success]);
} else {
    echo json_encode(['success' => false, 'message' => 'Datos incompletos.']);
}

