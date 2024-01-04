<?php

include('../../../app/config.php');


$tipo_fr = $_POST['tipo_fr'];
$nro_formacion = $_POST['nro_formacion'];
$fecha_fr = $_POST['fecha_fr'];
$fecha_cad = $_POST['fechacad_fr'];
$formador_fr = $_POST['formador_fr'];



$sentencia = $pdo->prepare("INSERT INTO formacion (id_formacion, tipo_fr, nroformacion, fecha_fr, fechacad_fr, formador_fr) 
VALUES(NULL, :tipo_fr, :nro_formacion, :fecha_fr, :fechacad_fr, :formador_fr)");

$sentencia->bindParam('tipo_fr', $tipo_fr);    
$sentencia->bindParam('nroformacion', $nroformacion); 
$sentencia->bindParam('fecha_fr', $fecha_fr);
$sentencia->bindParam('fechacad_fr', $fechacad_fr);
$sentencia->bindParam('formador_fr', $formador_fr);

if ($sentencia->execute()) {
session_start();
$_SESSION['mensaje'] = "Formacion registrada correctamente";
$_SESSION['icono'] = 'success';
header('Location: ' . $URL . '/admin/pruebas/create.php');
} else {
session_start();
$_SESSION['mensaje'] = "Formacion NO creada";
$_SESSION['icono'] = 'warning';
header('Location: ' . $URL . '/admin/pruebas/create.php');
}


?>

