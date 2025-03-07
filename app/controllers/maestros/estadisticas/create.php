<?php

include('../../../../app/config.php');

$anio_est = $_POST['anio_est'];
$mediatr_est = $_POST['mediatr_est'];
$indinciden_est = $_POST['indinciden_est'];
$horastranual_est = $_POST['horastranual_est'];



$sentencia = $pdo->prepare("INSERT INTO estadisticas (anio_est, mediatr_est, indinciden_est, horastranual_est) 
                         VALUES(:anio_est, :mediatr_est, :indinciden_est, :horastranual_est)");

$sentencia->bindParam('anio_est', $anio_est);
$sentencia->bindParam('mediatr_est', $mediatr_est);
$sentencia->bindParam('indinciden_est', $indinciden_est);
$sentencia->bindParam('horastranual_est', $horastranual_est);


if ($sentencia->execute()) {
    session_start();
    $_SESSION['mensaje'] = "Estadistica registrada correctamente";
    $_SESSION['icono'] = 'success';
    header('Location: ' . $URL . '/admin/maestros/varios');
} else {
    session_start();
    $_SESSION['mensaje'] = "Estadistica NO creado";
    $_SESSION['icono'] = 'warning';
    header('Location: ' . $URL . '/admin/maestros/varios');
}
