<?php

include('../../../../app/config.php');

$id_tipoevaluacion = $_GET['id_tipoevaluacion'];


    $sentencia = $pdo->prepare("DELETE FROM tipoevaluacion WHERE id_tipoevaluacion = '$id_tipoevaluacion'");


    if ($sentencia->execute()) {
        session_start();
        $_SESSION['mensaje'] = "Eliminada correctamente";
        $_SESSION['icono'] = 'success';
        header('Location: ' . $URL . '/admin/maestros/evaluacion/index.php');
    } else {
        session_start();
        $_SESSION['mensaje'] = "NO eliminada";
        $_SESSION['icono'] = 'error';
        header('Location: ' . $URL . '/admin/maestros/evaluacion/index.php');
    }
