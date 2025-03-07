<?php

include('../../config.php');


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

$imagen1_acc = $_POST['imagen1_acc'];
$imagen2_acc = $_POST['imagen2_acc'];

$nombreDelArchivo = date("Y-m-d-h-i-s");
$filename = $nombreDelArchivo."__".$_FILES['imagen1_acc']['name'];
$location = "../../../admin/accionprl/image/".$filename;

move_uploaded_file($_FILES['imagen1_acc']['tmp_name'],$location);

$filename2 = $nombreDelArchivo."__".$_FILES['imagen2_acc']['name'];
$location2 = "../../../admin/accionprl/image/".$filename2;

move_uploaded_file($_FILES['imagen2_acc']['tmp_name'],$location2);

// Comprova si està buit
if (empty($fecha_acc)) {
    $fecha_acc = null;
}
if (empty($fechaprevista_acc)) {
    $fechaprevista_acc = null;
}
if (empty($fecharea_acc)) {
    $fecharea_acc = null;
}
if (empty($fechaveri_acc)) {
    $fechaveri_acc = null;
}
if (empty($recursos_acc)) {
    $recursos_acc = 0; // Proporciona un valor per defecte, per exemple 0
}


$sentencia = $pdo->prepare("INSERT INTO ag_acciones (codigo_acc, fecha_acc, centro_acc, prioridad_acc, origen_acc, detalleorigen_acc,  descripcion_acc, responsable_acc,  fechaprevista_acc, fecharea_acc, 
fechaveri_acc, avance_acc, estado_acc, accpropuesta_acc, accrealizada_acc, seguimiento_acc, recursos_acc, imagen1_acc, imagen2_acc)
VALUES (:codigo_acc, :fecha_acc, :centro_acc, :prioridad_acc, :origen_acc, :detalleorigen_acc, :descripcion_acc, :responsable_acc, :fechaprevista_acc, :fecharea_acc, :fechaveri_acc, :avance_acc, 
:estado_acc, :accpropuesta_acc, :accrealizada_acc, :seguimiento_acc, :recursos_acc, :imagen1_acc, :imagen2_acc)"); 


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
$sentencia->bindParam('accpropuesta_acc', $accpropuesta_acc);
$sentencia->bindParam('accrealizada_acc', $accrealizada_acc);
$sentencia->bindParam('seguimiento_acc', $seguimiento_acc);    
$sentencia->bindParam('recursos_acc', $recursos_acc);
$sentencia->bindParam('imagen1_acc', $filename);
$sentencia->bindParam('imagen2_acc', $filename2);

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