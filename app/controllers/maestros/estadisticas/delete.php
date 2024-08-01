<?php

include('../../../../app/config.php');

$id_estadistica = $_GET['id_estadistica'];


    $sentencia = $pdo->prepare("DELETE FROM estadisticas WHERE id_estadistica = '$id_estadistica'");


    if ($sentencia->execute()) {
        session_start();
        $_SESSION['mensaje'] = "Departamento eliminado correctamente";
        $_SESSION['icono'] = 'success';
        header('Location: ' . $URL . '/admin/maestros/varios');
    } else {
        session_start();
        $_SESSION['mensaje'] = "Departamento no eliminado correctamente";
        $_SESSION['icono'] = 'error';
        header('Location: ' . $URL . '/admin/maestros/varios');
    }
