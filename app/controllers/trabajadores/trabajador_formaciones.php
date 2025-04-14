<?php
// Ensure no output before JSON
ob_start();

include('../../config.php');

// Set proper JSON header
header('Content-Type: application/json');

$idTrabajador = $_GET['id_trabajador'] ?? 0;

$query = $pdo->prepare("
    SELECT 
        COUNT(*) AS total_formaciones,
        SUM(CASE WHEN estado = 'Completado' THEN 1 ELSE 0 END) AS completadas
    FROM formacion_trabajador
    WHERE id_trabajador = :id_trabajador
");
$query->bindParam(':id_trabajador', $idTrabajador, PDO::PARAM_INT);
$query->execute();

echo json_encode($query->fetch(PDO::FETCH_ASSOC));
?>