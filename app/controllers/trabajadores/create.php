<?php

include('../../../app/config.php');

$codigo_tr = $_POST['codigo_tr'];
$dni_tr = $_POST['dni_tr'];
$nombre_tr = $_POST['nombre_tr'];
$fechanac_tr = $_POST['fechanac_tr'];
$categoria_tr = $_POST['categoria_tr'];
$inicio_tr = $_POST['inicio_tr'];
$centro_tr = $_POST['centro_tr'];
$activo_tr = 1;

$sentencia = $pdo->prepare("INSERT INTO trabajadores (id_trabajador, codigo_tr, dni_tr, nombre_tr, fechanac_tr, categoria_tr, inicio_tr, centro_tr, activo_tr, fyh_creacion, fyh_actualizacion) 
VALUES(NULL, :codigo_tr, :dni_tr, :nombre_tr, :fechanac_tr, :categoria_tr, :inicio_tr, :centro_tr, :activo_tr, :fyh_creacion, :fyh_actualizacion)");

$sentencia->bindParam('codigo_tr', $codigo_tr);    
$sentencia->bindParam('dni_tr', $dni_tr);
$sentencia->bindParam('nombre_tr', $nombre_tr);
$sentencia->bindParam('fechanac_tr', $fechanac_tr);
$sentencia->bindParam('categoria_tr', $categoria_tr);
$sentencia->bindParam('inicio_tr', $inicio_tr);
$sentencia->bindParam('centro_tr', $centro_tr);
$sentencia->bindParam('activo_tr', $activo_tr);
$sentencia->bindParam('fyh_creacion', $fechahora);
$sentencia->bindParam('fyh_actualizacion', $fechahora);

if ($sentencia->execute()) {
session_start();
$_SESSION['mensaje'] = "Trabajador registrado correctamente";
$_SESSION['icono'] = 'success';
header('Location: ' . $URL . '/admin/trabajadores');
} else {
session_start();
$_SESSION['mensaje'] = "Trabajador NO registrado";
$_SESSION['icono'] = 'warning';
header('Location: ' . $URL . '/admin/trabajadores');
}


?>
