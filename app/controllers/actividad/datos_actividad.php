<?php

$id_actividad = $_GET['id_actividad'];

$sql = "SELECT 
    ag_actividad.id_actividad,
    ag_actividad.id_tarea,
    ag_actividad.fecha_acc,
    ag_actividad.horain_acc,
    ag_actividad.horafin_acc, 
    ag_actividad.horas_acc,
    ag_actividad.responsable_acc,
    ag_actividad.detalles_acc,
    ag_tareas.nombre_ta,
    ag_proyecto.nombre_py,
    centros.nombre_cen,
    responsables.nombre_resp
FROM ag_actividad
JOIN ag_tareas ON ag_actividad.id_tarea = ag_tareas.id_tarea
JOIN ag_proyecto ON ag_tareas.id_proyecto = ag_proyecto.id_proyecto  
JOIN centros ON ag_tareas.centro_ta = centros.id_centro
JOIN responsables ON ag_actividad.responsable_acc = responsables.id_responsable
WHERE ag_actividad.id_actividad = :id_actividad";

$stmt = $pdo->prepare($sql);
$stmt->bindParam(':id_actividad', $id_actividad);
$stmt->execute();
$activity = $stmt->fetch(PDO::FETCH_ASSOC);

if ($activity) {
    $id_actividad = $activity['id_actividad'];
    $id_tarea = $activity['id_tarea'];
    $nombre_ta = $activity['nombre_ta'];
    $nombre_py = $activity['nombre_py'];
    $nombre_cen = $activity['nombre_cen'];
    $nombre_resp = $activity['nombre_resp'];
    $fecha_acc = $activity['fecha_acc'];
    $horain_acc = $activity['horain_acc'];
    $horafin_acc = $activity['horafin_acc'];
    $horas_acc = $activity['horas_acc'];
    $responsable_acc = $activity['responsable_acc'];
    $detalles_acc = $activity['detalles_acc'];
} else {
    // Manejar el caso en que no se encuentra la actividad
    echo "No se encontró la actividad solicitada.";
    exit;
}
?>
