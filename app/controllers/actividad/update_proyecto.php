<?php

include('../../../app/config.php');

$id_proyecto = $_POST['id_proyecto'];
$nombre_py = $_POST['nombre_py'];
$responsable_py = $_POST['responsable_py'];
$descripcion_py = $_POST['descripcion_py'];
$estado_py = $_POST['estado_py'];
$fechainicio_py = $_POST['fechainicio_py'];
$fechafin_py = $_POST['fechafin_py'];


$sentencia = $pdo->prepare("UPDATE ag_proyecto
SET 
nombre_py=:nombre_py, 
responsable_py=:responsable_py, 
descripcion_py=:descripcion_py, 
estado_py=:estado_py, 
fechainicio_py=:fechainicio_py, 
fechafin_py=:fechafin_py 
WHERE id_proyecto =:id_proyecto");

$sentencia->bindParam('id_proyecto', $id_proyecto);    
$sentencia->bindParam('nombre_py', $nombre_py);    
$sentencia->bindParam('responsable_py', $responsable_py);
$sentencia->bindParam('descripcion_py', $descripcion_py);
$sentencia->bindParam('estado_py', $estado_py);
$sentencia->bindParam('fechainicio_py', $fechainicio_py);
$sentencia->bindParam('fechafin_py', $fechafin_py);    


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