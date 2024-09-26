<?php

include('../../../../app/config.php');

$nombre_epi = $_POST['nombre_epi'];
$normativa_epi = $_POST['normativa_epi'];

    $sentencia = $pdo->prepare("INSERT INTO epis (nombre_epi, normativa_epi) 
                         VALUES(:nombre_epi, :normativa_epi)");

    $sentencia->bindParam('nombre_epi', $nombre_epi);
    $sentencia->bindParam('normativa_epi', $normativa_epi);


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
