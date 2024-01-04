<?php

include('../../../../app/config.php');

$nombre_resp = $_POST['nombre_resp'];
$cargo_resp = $_POST['cargo_resp'];
$email_resp = $_POST['email_resp'];



    $sentencia = $pdo->prepare("INSERT INTO responsables (nombre_resp, cargo_resp, email_resp) 
                         VALUES(:nombre_resp, :cargo_resp, :email_resp)");

    $sentencia->bindParam('nombre_resp', $nombre_resp);
    $sentencia->bindParam('cargo_resp', $cargo_resp);
    $sentencia->bindParam('email_resp', $email_resp);

    if ($sentencia->execute()) {
        session_start();
        $_SESSION['mensaje'] = "Responsable registrado correctamente";
        $_SESSION['icono'] = 'success';
        header('Location: ' . $URL . '/admin/maestros/varios');
    } else {
        session_start();
        $_SESSION['mensaje'] = "Responsable NO creado";
        $_SESSION['icono'] = 'warning';
        header('Location: ' . $URL . '/admin/maestros/varios');
    }

       
?>

    