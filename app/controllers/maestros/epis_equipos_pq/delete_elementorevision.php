<?php

include('../../../config.php');

$id = $_GET['id_elemento'];


    $sentencia = $pdo->prepare("DELETE FROM er_elementos_revisionmaq WHERE id_elemento = '$id'");


    if ($sentencia->execute()) {
        session_start();
        $_SESSION['mensaje'] = "Tipo maquina eliminado correctamente";
        $_SESSION['icono'] = 'success';
        header('Location: ' . $URL . '/admin/maestros/epis_equipos_pq/index.php');
    } else {
        session_start();
        $_SESSION['mensaje'] = "Tipo máquina no eliminado correctamente";
        $_SESSION['icono'] = 'error';
        header('Location: ' . $URL . '/admin/maestros/epis_equipos_pq/index.php');
    }
