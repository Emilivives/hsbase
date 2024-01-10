<?php

include('../../../app/config.php');

$id_trabajador = $_POST['id_trabajador'];
$codigo_tr = $_POST['codigo_tr'];
$dni_tr = $_POST['dni_tr'];
$nombre_tr = $_POST['nombre_tr'];
$fechanac_tr = $_POST['fechanac_tr'];
$categoria_tr = $_POST['categoria_tr'];
$inicio_tr = $_POST['inicio_tr'];
$centro_tr = $_POST['centro_tr'];
$activo_tr = $_POST['activo_tr'];
$anotaciones_tr = $_POST['anotaciones_tr'];


$sentencia = $pdo->prepare("UPDATE trabajadores SET id_trabajador=:id_trabajador, codigo_tr=:codigo_tr, nombre_tr=:nombre_tr, dni_tr=:dni_tr, fechanac_tr=:fechanac_tr, 
inicio_tr=:inicio_tr, centro_tr=:centro_tr, categoria_tr=:categoria_tr, activo_tr=:activo_tr, anotaciones_tr=:anotaciones_tr, fyh_actualizacion=:fyh_actualizacion 
WHERE id_trabajador = :id_trabajador");

$sentencia->bindParam('id_trabajador', $id_trabajador);
$sentencia->bindParam('codigo_tr', $codigo_tr);
$sentencia->bindParam('nombre_tr', $nombre_tr);
$sentencia->bindParam('dni_tr', $dni_tr);
$sentencia->bindParam('fechanac_tr', $fechanac_tr);
$sentencia->bindParam('categoria_tr', $categoria_tr);
$sentencia->bindParam('centro_tr', $centro_tr);
$sentencia->bindParam('activo_tr', $activo_tr);
$sentencia->bindParam('anotaciones_tr', $anotaciones_tr);
$sentencia->bindParam('fyh_actualizacion', $fechahora);



if ($sentencia->execute()) {
    session_start();
    $_SESSION['mensaje'] = "Datos actualizados correctamente";
    $_SESSION['icono'] = 'success';
    header('Location: ' . $URL . '/admin/trabajadores/index.php');
} else {
    session_start();
    $_SESSION['mensaje'] = "Error en la actualización";
    $_SESSION['icono'] = 'warning';
    header('Location: ' . $URL . '/admin/trabajadores/index.php');
}