<?php

include('../../../app/config.php');

$codigo_tr = $_POST['codigo_tr'];
$dni_tr = $_POST['dni_tr'];
$nombre_tr = $_POST['nombre_tr'];
$sexo_tr = $_POST['sexo_tr'];
$fechanac_tr = $_POST['fechanac_tr'];
$categoria_tr = $_POST['categoria_tr'];
$inicio_tr = $_POST['inicio_tr'];
$centro_tr = $_POST['centro_tr'];
$activo_tr = 1;
$formacionpdt_tr = $_POST['formacionpdt_tr'];
$anotaciones_tr = $_POST['anotaciones_tr'];


$sentencia = $pdo->prepare("INSERT INTO trabajadores (codigo_tr, dni_tr, nombre_tr, sexo_tr, fechanac_tr, categoria_tr, inicio_tr, centro_tr, activo_tr, formacionpdt_tr, informacion_tr, anotaciones_tr, fyh_creacion, fyh_actualizacion) 
VALUES(:codigo_tr, :dni_tr, :nombre_tr, :sexo_tr, :fechanac_tr, :categoria_tr, :inicio_tr, :centro_tr, :activo_tr, :formacionpdt_tr, :informacion_tr, :anotaciones_tr, :fyh_creacion, :fyh_actualizacion) ");

$sentencia->bindParam('codigo_tr', $codigo_tr);    
$sentencia->bindParam('dni_tr', $dni_tr);
$sentencia->bindParam('nombre_tr', $nombre_tr);
$sentencia->bindParam('sexo_tr', $sexo_tr);
$sentencia->bindParam('fechanac_tr', $fechanac_tr);
$sentencia->bindParam('categoria_tr', $categoria_tr);
$sentencia->bindParam('inicio_tr', $inicio_tr);
$sentencia->bindParam('centro_tr', $centro_tr);
$sentencia->bindParam('activo_tr', $activo_tr);
$sentencia->bindParam('formacionpdt_tr', $formacionpdt_tr);
$sentencia->bindParam('informacion_tr', $informacion_tr);
$sentencia->bindParam('anotaciones_tr', $anotaciones_tr);
$sentencia->bindParam('fyh_creacion', $fechahora);
$sentencia->bindParam('fyh_actualizacion', $fechahora);


if ($sentencia->execute()) {
session_start();
$ultimotr = $pdo->lastInsertId();
$_SESSION['mensaje'] = "Trabajador registrado correctamente";
$_SESSION['icono'] = 'success';
header('Location: ' . $URL . '/admin/trabajadores/trabajadorshow.php?id_trabajador='.$ultimotr.'');
} else {
session_start();
$_SESSION['mensaje'] = "Trabajador NO registrado";
$_SESSION['icono'] = 'warning';
header('Location: ' . $URL . '/admin/trabajadores/trabajadorshow.php?id_trabajador=1');
}


?>
