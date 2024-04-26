<?php

include('../../../../app/config.php');

$id_responsable = $_GET['id_responsable'];


    $sentencia = $pdo->prepare("DELETE FROM responsables WHERE id_responsable = '$id_responsable'");


    if ($sentencia->execute()) {
        session_start();
        $_SESSION['mensaje'] = "Eliminado correctamente";
        $_SESSION['icono'] = 'success';
        header('Location: ' . $URL . '/admin/maestros/varios/index.php');
    } else {
        session_start();
        $_SESSION['mensaje'] = "NO eliminado correctamente";
        $_SESSION['icono'] = 'error';
        header('Location: ' . $URL . '/admin/maestros/varios/index.php');
    }
