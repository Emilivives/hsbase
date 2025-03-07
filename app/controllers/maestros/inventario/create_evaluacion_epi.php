<?php
include('../../../app/config.php');


// Recoger los datos del formulario
$id_epi = $_POST['id_epi'];
$fecha_revision = $_POST['fecha_revision'];
$items = $_POST['item'];  // Recoger los ítems (nombre y cumple/no cumple)

// Insertar la revisión en la tabla `checklists`
$sql_checklist = "INSERT INTO checklists (id_epi, fecha_revision) VALUES (:id_epi, :fecha_revision)";
$query = $pdo->prepare($sql_checklist);
$query->execute([':id_epi' => $id_epi, ':fecha_revision' => $fecha_revision]);

// Obtener el ID del checklist recién insertado
$id_checklist = $pdo->lastInsertId();

// Insertar los ítems del checklist en la tabla `checklist_items`
foreach ($items as $nombre_item => $cumple) {
    $sql_item = "INSERT INTO checklist_items (id_checklist, nombre_item, cumple) VALUES (:id_checklist, :nombre_item, :cumple)";
    $query_item = $pdo->prepare($sql_item);
    $query_item->execute([
        ':id_checklist' => $id_checklist,
        ':nombre_item' => $nombre_item,
        ':cumple' => $cumple
    ]);
}

// Redirigir o mostrar mensaje de éxito
header('Location: lista_checklists.php');