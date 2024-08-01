<?php

include('../../../app/config.php');

$centro_cev = $_POST['centro_cev'];
$tipoevaluacion_cev = $_POST['tipoevaluacion_cev'];
$fecha_cev = $_POST['fecha_cev'];
$fechacad_cev = $_POST['fechacad_cev'];
$noaplica_cev = isset($_POST['noaplica_cev']) ? $_POST['noaplica_cev'] : null; // Ajuste para checkbox
$anotaciones_cev = $_POST['anotaciones_cev'];

$sentencia = $pdo->prepare("INSERT INTO er_controlevaluaciones (centro_cev, tipoevaluacion_cev, fecha_cev, fechacad_cev, noaplica_cev, anotaciones_cev) 
VALUES(:centro_cev, :tipoevaluacion_cev, :fecha_cev, :fechacad_cev, :noaplica_cev, :anotaciones_cev)");

$sentencia->bindParam(':centro_cev', $centro_cev);
$sentencia->bindParam(':tipoevaluacion_cev', $tipoevaluacion_cev);
$sentencia->bindParam(':fecha_cev', $fecha_cev);
$sentencia->bindParam(':fechacad_cev', $fechacad_cev);
$sentencia->bindParam(':noaplica_cev', $noaplica_cev);
$sentencia->bindParam(':anotaciones_cev', $anotaciones_cev);

if ($sentencia->execute()) {
    session_start();
    $ultimotr = $pdo->lastInsertId();
    $_SESSION['mensaje'] = "Evaluación registrada correctamente";
    $_SESSION['icono'] = 'success';
    header('Location: ' . $URL . '/admin/evaluacion/control.php');
} else {
    session_start();
    $_SESSION['mensaje'] = "Evaluación NO registrada";
    $_SESSION['icono'] = 'warning';
    header('Location: ' . $URL . '/admin/evaluacion/control.php');
}

?>
