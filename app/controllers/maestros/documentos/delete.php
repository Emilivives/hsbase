<?php

include('../../../app/config.php');

$id = $_GET['id'];


    $sentencia = $pdo->prepare("DELETE FROM documentos WHERE id = '$id'");


    if ($sentencia->execute()) {
        session_start();
        $_SESSION['mensaje'] = "Documentos eliminado correctamente";
        $_SESSION['icono'] = 'success';
        header('Location: ' . $URL . '/admin/maestros/documentos');
    } else {
        session_start();
        $_SESSION['mensaje'] = "Documento no eliminado correctamente";
        $_SESSION['icono'] = 'error';
        header('Location: ' . $URL . '/admin/maestros/documentos');
    }
