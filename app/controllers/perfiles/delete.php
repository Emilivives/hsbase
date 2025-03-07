<?php

include('../../../app/config.php');

$id_perfil = $_GET['id_perfil'];


    $sentencia = $pdo->prepare("DELETE FROM tb_perfiles WHERE id_perfil = '$id_perfil'");


    if ($sentencia->execute()) {
        session_start();
        $_SESSION['mensaje'] = "Perfil eliminado correctamente";
        $_SESSION['icono'] = 'success';
        header('Location: ' . $URL . '/admin/perfiles');
    } else {
        session_start();
        $_SESSION['mensaje'] = "Perfil no eliminado correctamente";
        $_SESSION['icono'] = 'error';
        header('Location: ' . $URL . '/admin/perfiles');
    }
