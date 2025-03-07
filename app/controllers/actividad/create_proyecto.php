<?php

include('../../../app/config.php');

$nombre_py = $_POST['nombre_py'];
$empresa_py = $_POST['empresa_py'];
$responsable_py = $_POST['responsable_py'];
$descripcion_py = $_POST['descripcion_py'];
$estado_py = $_POST['estado_py'];
$fechainicio_py = $_POST['fechainicio_py'];
$fechafin_py = $_POST['fechafin_py'];



$sentencia = $pdo->prepare("INSERT INTO ag_proyecto (nombre_py, empresa_py, responsable_py, descripcion_py, estado_py, fechainicio_py, fechafin_py) 
VALUES(:nombre_py, :empresa_py, :responsable_py, :descripcion_py, :estado_py, :fechainicio_py, :fechafin_py)");

$sentencia->bindParam('nombre_py', $nombre_py);    
$sentencia->bindParam('empresa_py', $empresa_py);
$sentencia->bindParam('responsable_py', $responsable_py);
$sentencia->bindParam('descripcion_py', $descripcion_py);
$sentencia->bindParam('estado_py', $estado_py);
$sentencia->bindParam('fechainicio_py', $fechainicio_py);
$sentencia->bindParam('fechafin_py', $fechafin_py);

if ($sentencia->execute()) {
session_start();
$_SESSION['mensaje'] = "Formacion registrada correctamente";
$_SESSION['icono'] = 'success';
header('Location: ' . $URL . '/admin/actividad/proyectos.php');
} else {
session_start();
$_SESSION['mensaje'] = "Formacion NO creada";
$_SESSION['icono'] = 'warning';
header('Location: ' . $URL . '/admin/actividad/proyectos.php');
}


?>
