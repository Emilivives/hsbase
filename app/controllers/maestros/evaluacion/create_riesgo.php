<?php

include('../../../../app/config.php');

$codigoriesgo = $_POST['codigoriesgo'];
$fraseriesgo = $_POST['fraseriesgo'];

    $sentencia = $pdo->prepare("INSERT INTO er_riesgos (codigoriesgo, fraseriesgo) 
                         VALUES(:codigoriesgo, :fraseriesgo)");

    $sentencia->bindParam('codigoriesgo', $codigoriesgo);
    $sentencia->bindParam('fraseriesgo', $fraseriesgo);


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
