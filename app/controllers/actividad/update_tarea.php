<?php

include('../../../app/config.php');

$id_tarea = $_POST['id_tarea'];
$id_proyecto = $_POST['id_proyecto'];
$nombre_ta = $_POST['nombre_ta'];
$fecha_ta = $_POST['fecha_ta'];
$fechareal_ta = $_POST['fechareal_ta'];
$centro_ta = $_POST['centro_ta'];
$responsable_ta = $_POST['responsable_ta'];
$prioridad_ta = $_POST['prioridad_ta'];
$estado_ta = $_POST['estado_ta'];
$programada_ta = $_POST['programada_ta'];
$detalles_ta = $_POST['detalles_ta'];
$categoria_ta = $_POST['categoria_ta'];
$accionprl_ta = $_POST['accionprl_ta'];


$sentencia = $pdo->prepare("UPDATE ag_tareas
SET id_proyecto=:id_proyecto, 
nombre_ta=:nombre_ta, 
fecha_ta=:fecha_ta, 
fechareal_ta=:fecha_ta, 
centro_ta=:centro_ta, 
responsable_ta=:responsable_ta, 
prioridad_ta=:prioridad_ta, 
estado_ta=:estado_ta, 
programada_ta=:programada_ta, 
detalles_ta=:detalles_ta, 
categoria_ta=:categoria_ta, accionprl_ta=:accionprl_ta 
WHERE id_tarea =:id_tarea");

$sentencia->bindParam('id_tarea', $id_tarea);  
$sentencia->bindParam('id_proyecto', $id_proyecto);    
$sentencia->bindParam('nombre_ta', $nombre_ta);    
$sentencia->bindParam('fecha_ta', $fecha_ta);
$sentencia->bindParam('fechareal_ta', $fechareal_ta);
$sentencia->bindParam('centro_ta', $centro_ta);
$sentencia->bindParam('responsable_ta', $responsable_ta);
$sentencia->bindParam('prioridad_ta', $prioridad_ta);    
$sentencia->bindParam('estado_ta', $estado_ta);
$sentencia->bindParam('programada_ta', $programada_ta);
$sentencia->bindParam('detalles_ta', $detalles_ta);
$sentencia->bindParam('categoria_ta', $categoria_ta);
$sentencia->bindParam('accionprl_ta', $accionprl_ta);

if ($sentencia->execute()) {
session_start();
$_SESSION['mensaje'] = "Tarea editada correctamente";
$_SESSION['icono'] = 'success';
header("Location: " . $URL . "/admin/actividad/show.php?id_proyecto=$id_proyecto");
} else {
session_start();
$_SESSION['mensaje'] = "Tarea NO editada";
$_SESSION['icono'] = 'warning';
header("Location: " . $URL . "/admin/actividad/show.php?id_proyecto=$id_proyecto");
}


?>