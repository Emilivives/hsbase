<?php

include('../../../app/config.php');

$nombre_pf = $_POST['nombre_pf'];




    $sentencia = $pdo->prepare("INSERT INTO tb_perfiles (nombre_pf, fyh_creacion) 
                         VALUES(:nombre_pf, :fyh_creacion)");

    $sentencia->bindParam('nombre_pf', $nombre_pf);
    $sentencia->bindParam('fyh_creacion', $fechahora);

    if ($sentencia->execute()) {
        session_start();
        $_SESSION['mensaje'] = "Registro de perfil correctamente";
        $_SESSION['icono'] = 'success';
        header('Location: ' . $URL . '/admin/perfiles');
    } else {
        session_start();
        $_SESSION['mensaje'] = "Perfil NO creado";
        $_SESSION['icono'] = 'warning';
        header('Location: ' . $URL . '/admin/perfiles/create.php');
    }

       


    