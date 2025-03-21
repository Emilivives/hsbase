<?php

include('../../../../app/config.php');

$id_responsable = $_GET['id_responsable'] ?? null;

if (!$id_responsable) {
    die("Error: ID no proporcionado.");
}

$sentencia = $pdo->prepare("DELETE FROM `responsables` WHERE id_responsable = :id_responsable");
$sentencia->bindParam(':id_responsable', $id_responsable, PDO::PARAM_INT);
$sentencia->execute();

if ($sentencia->rowCount() > 0) {
    session_start();
    $_SESSION['mensaje'] = "Eliminado correctamente";
    $_SESSION['icono'] = 'success';
} else {
    session_start();
    $_SESSION['mensaje'] = "No se eliminó ningún registro, verifica el ID.";
    $_SESSION['icono'] = 'error';
}

header('Location: ' . $URL . '/admin/maestros/varios');
exit();
