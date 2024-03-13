<?php

include('../../../app/config.php');

$id_accion = $_POST['id_accion'];
$codigo_acc = $_POST['codigo_acc'];
$fecha_acc = $_POST['fecha_acc'];
$centro_acc = $_POST['centro_acc'];
$responsable_acc = $_POST['responsable_acc'];
$prioridad_acc = $_POST['prioridad_acc'];
$descripcion_acc = $_POST['descripcion_acc'];
$origen_acc = $_POST['origen_acc'];
$detalleorigen_acc = $_POST['detalleorigen_acc'];
$accpropuesta_acc = $_POST['accpropuesta_acc'];
$accrealizada_acc = $_POST['accrealizada_acc'];
$fechaprevista_acc = $_POST['fechaprevista_acc'];
$fecharea_acc = $_POST['fecharea_acc'];
$fechaveri_acc = $_POST['fechaveri_acc'];
$recursos_acc = $_POST['recursos_acc'];
$seguimiento_acc = $_POST['seguimiento_acc'];
$avance_acc = $_POST['avance_acc'];
$estado_acc = $_POST['estado_acc'];
$image = $_POST['image'];

$nombreDelArchivo = date("Y-m-d-h-i-s");
$filename = $nombreDelArchivo."__".$_FILES['image']['name'];
$location = "../../../admin/accionprl/image/".$filename;

move_uploaded_file($_FILES['image']['tmp_name'],$location);




$sentencia = $pdo->prepare("UPDATE ag_acciones
SET codigo_acc=:codigo_acc, 
fecha_acc=:fecha_acc, 
centro_acc=:centro_acc, 
responsable_acc=:responsable_acc, 
prioridad_acc=:prioridad_acc, 
descripcion_acc=:descripcion_acc, 
origen_acc=:origen_acc, 
detalleorigen_acc=:detalleorigen_acc, 
accpropuesta_acc=:accpropuesta_acc, 
accrealizada_acc=:accrealizada_acc, 
fechaprevista_acc=:fechaprevista_acc,
fechaveri_acc=:fechaveri_acc,
fecharea_acc=:fecharea_acc, 
recursos_acc=:recursos_acc, 
seguimiento_acc=:seguimiento_acc,
avance_acc=:avance_acc, 
estado_acc=:estado_acc,
imagen1_acc=:imagen1_acc
WHERE id_accion =:id_accion");

$sentencia->bindParam('id_accion', $id_accion);   
$sentencia->bindParam('codigo_acc', $codigo_acc);    
$sentencia->bindParam('fecha_acc', $fecha_acc);    
$sentencia->bindParam('centro_acc', $centro_acc);
$sentencia->bindParam('prioridad_acc', $prioridad_acc);
$sentencia->bindParam('origen_acc', $origen_acc);
$sentencia->bindParam('detalleorigen_acc', $detalleorigen_acc);    
$sentencia->bindParam('descripcion_acc', $descripcion_acc);
$sentencia->bindParam('responsable_acc', $responsable_acc);
$sentencia->bindParam('fechaprevista_acc', $fechaprevista_acc);
$sentencia->bindParam('fecharea_acc', $fecharea_acc);
$sentencia->bindParam('fechaveri_acc', $fechaveri_acc);
$sentencia->bindParam('avance_acc', $avance_acc);
$sentencia->bindParam('estado_acc', $estado_acc);
$sentencia->bindParam('accrealizada_acc', $accrealizada_acc);
$sentencia->bindParam('accpropuesta_acc', $accpropuesta_acc);
$sentencia->bindParam('seguimiento_acc', $seguimiento_acc);    
$sentencia->bindParam('recursos_acc', $recursos_acc);
$sentencia->bindParam('imagen1_acc', $filename);


if ($sentencia->execute()) {
session_start();
$_SESSION['mensaje'] = "Tarea editada correctamente";
$_SESSION['icono'] = 'success';
header("Location: " . $URL . "/admin/accionprl/index.php");
} else {
session_start();
$_SESSION['mensaje'] = "Tarea NO editada";
$_SESSION['icono'] = 'warning';
header("Location: " . $URL . "/admin/accionprl/index.php");
}


?>