<?php

include('../../../../app/config.php');

$tipoevaluacion_tev = $_POST['tipoevaluacion_tev'];
$especialidad_tev = $_POST['especialidad_tev'];
$descripcion_tev = $_POST['descripcion_tev'];



    $sentencia = $pdo->prepare("INSERT INTO tipoevaluacion (tipoevaluacion_tev, especialidad_tev, descripcion_tev) 
                         VALUES(:tipoevaluacion_tev, :especialidad_tev, :descripcion_tev)");

    $sentencia->bindParam('tipoevaluacion_tev', $tipoevaluacion_tev);
    $sentencia->bindParam('especialidad_tev', $especialidad_tev);
    $sentencia->bindParam('descripcion_tev', $descripcion_tev);

    if ($sentencia->execute()) {
        session_start();
        $_SESSION['mensaje'] = "Responsable registrado correctamente";
        $_SESSION['icono'] = 'success';
        header('Location: ' . $URL . '/admin/maestros/evaluacion');
    } else {
        session_start();
        $_SESSION['mensaje'] = "Responsable NO creado";
        $_SESSION['icono'] = 'warning';
        header('Location: ' . $URL . '/admin/maestros/evaluacion');
    }

       
?>

    