<?php

include('../../../app/config.php');

$id_formacion = $_POST['id_formacion'];


    $sentencia = $pdo->prepare("DELETE FROM formacion WHERE id_formacion = '$id_formacion'");


    if ($sentencia->execute()) {
        session_start();
        $_SESSION['mensaje'] = "Departamento eliminado correctamente";
        $_SESSION['icono'] = 'success';
        header('Location: ' . $URL . '/admin/formacion/index.php');
    } else {
        session_start();
        $_SESSION['mensaje'] = "Departamento no eliminado correctamente";
        $_SESSION['icono'] = 'error';
        header('Location: ' . $URL . '/admin/formacion/index.php');
    }
