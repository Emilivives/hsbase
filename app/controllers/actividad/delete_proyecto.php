<?php

include('../../../app/config.php');

$id_proyecto = filter_input(INPUT_GET, 'id_proyecto', FILTER_VALIDATE_INT);

if (!$id_proyecto) {
    session_start();
    $_SESSION['mensaje'] = "ID de proyecto no válido";
    $_SESSION['icono'] = "error";
    header('Location: ' . $URL . '/admin/actividad/proyectos.php');
    exit();
}

try {
    $sentencia = $pdo->prepare("DELETE FROM ag_proyecto WHERE id_proyecto = :id_proyecto");
    $sentencia->bindParam(':id_proyecto', $id_proyecto);
    $sentencia->execute();

    session_start();
    $_SESSION['mensaje'] = "Se eliminó el proyecto de prevención correctamente";
    $_SESSION['icono'] = "success";
    header('Location: ' . $URL . '/admin/actividad/proyectos.php');
} catch (PDOException $e) {
    if ($e->getCode() == 23000) { 
        session_start();
        $_SESSION['mensaje'] = "Para eliminar este proyecto, primero debe eliminar las tareas asociadas";
        $_SESSION['icono'] = "warning";
        header('Location: ' . $URL . '/admin/actividad/proyectos.php');
    } else {
        session_start();
        $_SESSION['mensaje'] = "Error al eliminar el proyecto: " . $e->getMessage();
        $_SESSION['icono'] = "error";
        header('Location: ' . $URL . '/admin/actividad/proyectos.php');
    }
}
?>
