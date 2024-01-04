<?php

include('../../../../app/config.php');

$id_categoria = $_POST['id_categoria'];


    $sentencia = $pdo->prepare("DELETE FROM categorias WHERE id_categoria = '$id_categoria'");


    if ($sentencia->execute()) {
        session_start();
        $_SESSION['mensaje'] = "Usuario eliminado correctamente";
        $_SESSION['icono'] = 'success';
        header('Location: ' . $URL . '/admin/maestros/categorias');
    } else {
        session_start();
        $_SESSION['mensaje'] = "Usuario no eliminado correctamente";
        $_SESSION['icono'] = 'error';
        header('Location: ' . $URL . '/admin/maestros/categorias');
    }
