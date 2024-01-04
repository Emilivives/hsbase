<?php

include('../../../app/config.php');

$id_empresa = $_POST['id_empresa'];


    $sentencia = $pdo->prepare("DELETE FROM empresa WHERE id_empresa = '$id_empresa'");


    if ($sentencia->execute()) {
        session_start();
        $_SESSION['mensaje'] = "Usuario eliminado correctamente";
        $_SESSION['icono'] = 'success';
        header('Location: ' . $URL . '/admin/maestros/centros');
    } else {
        session_start();
        $_SESSION['mensaje'] = "Usuario no eliminado correctamente";
        $_SESSION['icono'] = 'error';
        header('Location: ' . $URL . '/admin/maestros/centros');
    }
