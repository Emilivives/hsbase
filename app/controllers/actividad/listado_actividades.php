<?php
if (!isset($id_tarea)) {
    throw new Exception('La variable $id_tarea no está definida.');
}

$sql = "SELECT * FROM ag_actividades WHERE id_tarea = :id_tarea";
$query = $pdo->prepare($sql);
$query->execute(['id_tarea' => $id_tarea]);
$actividades = $query->fetchAll(PDO::FETCH_ASSOC);
?>