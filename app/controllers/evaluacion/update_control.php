<?php
include('../../../app/config.php');

$id_controleval = $_POST['id_controleval'];
$fecha_cev = !empty($_POST['fecha_cev']) ? $_POST['fecha_cev'] : NULL;
$fechacad_cev = !empty($_POST['fechacad_cev']) ? $_POST['fechacad_cev'] : NULL;
$noaplica_cev = isset($_POST['noaplica_cev']) ? $_POST['noaplica_cev'] : NULL;
$anotaciones_cev = $_POST['anotaciones_cev'];

$sentencia = $pdo->prepare("UPDATE er_controlevaluaciones SET 
    fecha_cev = :fecha_cev,
    fechacad_cev = :fechacad_cev,
    noaplica_cev = :noaplica_cev,
    anotaciones_cev = :anotaciones_cev
    WHERE id_controleval = :id_controleval");

$sentencia->bindParam(':fecha_cev', $fecha_cev);
$sentencia->bindParam(':fechacad_cev', $fechacad_cev);
$sentencia->bindParam(':noaplica_cev', $noaplica_cev);
$sentencia->bindParam(':anotaciones_cev', $anotaciones_cev);
$sentencia->bindParam(':id_controleval', $id_controleval);

session_start();

if ($sentencia->execute()) {
    $_SESSION['mensaje'] = "Evaluación actualizada correctamente";
    $_SESSION['icono'] = 'success';
} else {
    $_SESSION['mensaje'] = "Evaluación NO actualizada";
    $_SESSION['icono'] = 'warning';
}

header('Location: ' . $URL . '/admin/evaluacion/control.php');
?>