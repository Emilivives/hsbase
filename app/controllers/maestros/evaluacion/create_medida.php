<?php

include('../../../../app/config.php');

$codigomedida = $_POST['codigomedida'];
$frasemedida = $_POST['frasemedida'];

    $sentencia = $pdo->prepare("INSERT INTO er_medidas (codigomedida, frasemedida) 
                         VALUES(:codigomedida, :frasemedida)");

    $sentencia->bindParam('codigomedida', $codigomedida);
    $sentencia->bindParam('frasemedida', $frasemedida);


    if ($sentencia->execute()) {
        session_start();
        $_SESSION['mensaje'] = "Riesgo registrado correctamente";
        $_SESSION['icono'] = 'success';
        header('Location: ' . $URL . '/admin/maestros/evaluacion');
    } else {
        session_start();
        $_SESSION['mensaje'] = "Riesgo NO creado";
        $_SESSION['icono'] = 'warning';
        header('Location: ' . $URL . '/admin/maestros/evaluacion');
    }

       
?>
