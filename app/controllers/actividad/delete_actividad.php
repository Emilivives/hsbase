<?php

include('../../../app/config.php');

$id_actividad = $_GET['id_actividad'];
$id_tarea = $_GET['id_tarea'];
$id_proyecto = $_GET['id_proyecto'];


    $sentencia = $pdo->prepare("DELETE FROM ag_actividad WHERE id_actividad = '$id_actividad'");


    if ($sentencia->execute()) {
        session_start();
        $_SESSION['mensaje'] = "Actividad eliminada correctamente";
        $_SESSION['icono'] = 'success';
        header('Location: ' . $URL . '/admin/actividad/showtareas.php?id_tarea='.$id_tarea.'$id_proyecto='.$id_proyecto.'');
    } else {
        session_start();
        $_SESSION['mensaje'] = "Actividad no eliminado correctamente";
        $_SESSION['icono'] = 'error';
        header('Location: ' . $URL . '/admin/usuarios');
    }



