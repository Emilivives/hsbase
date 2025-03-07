<?php

include('../../../config.php');

$id_tipomaquina = $_GET['id_tipomaquina'];


    $sentencia = $pdo->prepare("DELETE FROM tipomaquinas WHERE id_tipomaquina = '$id_tipomaquina'");


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
