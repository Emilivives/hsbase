<?php

include('../../../app/config.php');

$id_maquina = $_POST['id_maquina'];
$fecha_mto = $_POST['fecha_mto'];
$operario_mto = $_POST['operario_mto'];
$detalles_mto = $_POST['detalles_mto'];

$sentencia = $pdo->prepare("INSERT INTO mto_maquinaria (id_maquina, fecha_mto, operario_mto, detalles_mto) 
VALUES(:id_maquina, :fecha_mto, :operario_mto, :detalles_mto)");

$sentencia->bindParam('id_maquina', $id_maquina);    
$sentencia->bindParam('fecha_mto', $fecha_mto);
$sentencia->bindParam('operario_mto', $operario_mto);
$sentencia->bindParam('detalles_mto', $detalles_mto);

if ($sentencia->execute()) {
session_start();
$_SESSION['mensaje'] = "Actividad registrada correctamente";
$_SESSION['icono'] = 'success';
header("Location: " . $URL . "/admin/inventario/controlmaquinas.php");

} else {
session_start();
$_SESSION['mensaje'] = "Formacion NO creada";
$_SESSION['icono'] = 'warning';
header("Location: " . $URL . "/admin/inventario/controlmaquinas.php");
}


?>
