<?php

include('../../../app/config.php');

$id_usuario = $_POST['id_usuario'];


    $sentencia = $pdo->prepare("DELETE FROM tb_usuarios WHERE id_usuario = '$id_usuario'");


    if ($sentencia->execute()) {
        session_start();
        $_SESSION['mensaje'] = "Usuario eliminado correctamente";
        $_SESSION['icono'] = 'success';
        header('Location: ' . $URL . '/admin/usuarios');
    } else {
        session_start();
        $_SESSION['mensaje'] = "Usuario no eliminado correctamente";
        $_SESSION['icono'] = 'error';
        header('Location: ' . $URL . '/admin/usuarios');
    }
