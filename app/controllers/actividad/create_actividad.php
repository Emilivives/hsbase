<?php

include('../../../app/config.php');

$id_proyecto=$_POST['id_proyecto'];
$id_tarea = $_POST['id_tarea'];

$fecha_acc = $_POST['fecha_acc'];
$horain_acc = $_POST['horain_acc'];
$horafin_acc = $_POST['horafin_acc'];
$responsable_acc = $_POST['responsable_acc'];
$detalles_acc = $_POST['detalles_acc'];
$fecha1 = new DateTime($horain_acc);//fecha inicial
$fecha2 = new DateTime($horafin_acc);//fecha de cierre
$interval = $fecha1->diff($fecha2);
$horas_acc = $interval->format('%H:%i:%s');






$sentencia = $pdo->prepare("INSERT INTO ag_actividad (id_actividad, id_tarea, fecha_acc, horain_acc, horafin_acc, horas_acc, responsable_acc, detalles_acc) 
VALUES(NULL, :id_tarea, :fecha_acc, :horain_acc, :horafin_acc, :horas_acc, :responsable_acc, :detalles_acc)");

$sentencia->bindParam('id_tarea', $id_tarea);    
$sentencia->bindParam('fecha_acc', $fecha_acc);
$sentencia->bindParam('horain_acc', $horain_acc);
$sentencia->bindParam('horafin_acc', $horafin_acc);
$sentencia->bindParam('horas_acc', $horas_acc);
$sentencia->bindParam('responsable_acc', $responsable_acc);
$sentencia->bindParam('detalles_acc', $detalles_acc);

if ($sentencia->execute()) {
session_start();
$_SESSION['mensaje'] = "Actividad registrada correctamente";
$_SESSION['icono'] = 'success';
header("Location: " . $URL . "/admin/actividad/updatetareas.php?id_tarea=$id_tarea&id_proyecto=$id_proyecto");

} else {
session_start();
$_SESSION['mensaje'] = "Formacion NO creada";
$_SESSION['icono'] = 'warning';
header("Location: " . $URL . "/admin/actividad/updatetareas.php?id_tarea=$id_tarea&id_proyecto=$id_proyecto");
}


?>
