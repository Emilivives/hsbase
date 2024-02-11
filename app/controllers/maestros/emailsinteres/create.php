<?php

include('../../../../app/config.php');

$nombre_ei = $_POST['nombre_ei'];
$email_ei = $_POST['email_ei'];
$telefono_ei = $_POST['telefono_ei'];



    $sentencia = $pdo->prepare("INSERT INTO emailsinteres (nombre_ei, email_ei, telefono_ei) 
                         VALUES(:nombre_ei, :email_ei, :telefono_ei)");

    $sentencia->bindParam('nombre_ei', $nombre_ei);
    $sentencia->bindParam('email_ei', $email_ei);
    $sentencia->bindParam('telefono_ei', $telefono_ei);

    if ($sentencia->execute()) {
        session_start();
        $_SESSION['mensaje'] = "Contacto de interés registrado correctamente";
        $_SESSION['icono'] = 'success';
        header('Location: ' . $URL . '/admin/maestros/varios');
    } else {
        session_start();
        $_SESSION['mensaje'] = "Error: NO creado";
        $_SESSION['icono'] = 'warning';
        header('Location: ' . $URL . '/admin/maestros/varios');
    }

       
?>

    