<?php

include('../../../../app/config.php');

$nombre_tm = $_POST['nombre_tm'];
$clase_tm = $_POST['clase_tm'];

    $sentencia = $pdo->prepare("INSERT INTO tipomaquinas (nombre_tm, clase_tm) 
                         VALUES(:nombre_tm, :clase_tm)");

    $sentencia->bindParam('nombre_tm', $nombre_tm);
    $sentencia->bindParam('clase_tm', $clase_tm);


    if ($sentencia->execute()) {
        session_start();
        $_SESSION['mensaje'] = "Riesgo registrado correctamente";
        $_SESSION['icono'] = 'success';
        header('Location: ' . $URL . '/admin/maestros/epis_equipos_pq');
    } else {
        session_start();
        $_SESSION['mensaje'] = "Riesgo NO creado";
        $_SESSION['icono'] = 'warning';
        header('Location: ' . $URL . '/admin/maestros/epis_equipos_pq');
    }

       
?>
