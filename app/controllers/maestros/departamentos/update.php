<?php

include('../../../../app/config.php');

$id_departamento = $_POST['id_departamento'];
$nombre_dpo = $_POST['nombre_dpo'];
$descripcion_dpo = $_POST['descripcion_dpo'];


$sentencia = $pdo->prepare("UPDATE departamentos SET nombre_dpo=:nombre_dpo, descripcion_dpo=:descripcion_dpo WHERE id_departamento = :id_departamento");
$sentencia->bindParam('id_departamento', $id_departamento);
$sentencia->bindParam('nombre_dpo', $nombre_dpo);
$sentencia->bindParam('descripcion_dpo', $descripcion_dpo);

if ($sentencia->execute()) {
    session_start();
    $_SESSION['mensaje'] = "Datos actualizados correctamente";
    $_SESSION['icono'] = 'success';
    header('Location: ' . $URL . '/admin/maestros/categorias');
} else {
    session_start();
    $_SESSION['mensaje'] = "Error en la actualización";
    $_SESSION['icono'] = 'warning';
    header('Location: ' . $URL . '/admin/maestros/departamentos/update.php?id_departamento=' . $id_departamento);
}
