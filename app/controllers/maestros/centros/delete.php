<?php

include('../../../config.php');

$id_centro = $_GET['id_centro'];


    $sentencia = $pdo->prepare("DELETE FROM centros WHERE id_centro = '$id_centro'");


    if ($sentencia->execute()) {
        session_start();
        $_SESSION['mensaje'] = "Centro eliminado correctamente";
        $_SESSION['icono'] = 'success';
        header('Location: ' . $URL . '/admin/maestros/centros');
    } else {
        session_start();
        $_SESSION['mensaje'] = "Centro no eliminado correctamente";
        $_SESSION['icono'] = 'error';
        header('Location: ' . $URL . '/admin/maestros/centros');
    }
