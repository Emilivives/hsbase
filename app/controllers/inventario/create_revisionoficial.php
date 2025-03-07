<?php

include('../../../app/config.php');

$id_equipo = $_POST['id_equipo'];
$tipo_revof = $_POST['tipo_revof'];
$proveedor_revof = $_POST['proveedor_revof'];
$fecha_revof = $_POST['fecha_revof'];
$caducidad_revof = $_POST['caducidad_revof'];
$vigente_revof = $_POST['vigente_revof'];
$observaciones_revof = $_POST['observaciones_revof'];

$sentencia = $pdo->prepare("INSERT INTO inv_revision_oficial (id_equipo, tipo_revof, proveedor_revof, fecha_revof, caducidad_revof, vigente_revof, observaciones_revof) 
VALUES(:id_equipo, :tipo_revof, :proveedor_revof, :fecha_revof, :caducidad_revof, :vigente_revof, :observaciones_revof)");

$sentencia->bindParam('id_equipo', $id_equipo);    
$sentencia->bindParam('tipo_revof', $tipo_revof);
$sentencia->bindParam('proveedor_revof', $proveedor_revof);
$sentencia->bindParam('fecha_revof', $fecha_revof);
$sentencia->bindParam('caducidad_revof', $caducidad_revof);
$sentencia->bindParam('vigente_revof', $vigente_revof);
$sentencia->bindParam('observaciones_revof', $observaciones_revof);

if ($sentencia->execute()) {
session_start();
$_SESSION['mensaje'] = "Actividad registrada correctamente";
$_SESSION['icono'] = 'success';
header("Location: " . $URL . "/admin/inventario/revisionoficial.php");

} else {
session_start();
$_SESSION['mensaje'] = "Formacion NO creada";
$_SESSION['icono'] = 'warning';
header("Location: " . $URL . "/admin/inventario/revisionoficial.php");
}


?>
