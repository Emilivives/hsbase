<?php

include('../../../../app/config.php');

$id_categoria = $_POST['id_categoria'];
$nombre_cat = $_POST['nombre_cat'];
$descripcion_cat = $_POST['descripcion_cat'];


$sentencia = $pdo->prepare("UPDATE categorias SET nombre_cat=:nombre_cat, descripcion_cat=:descripcion_cat WHERE id_categoria = :id_categoria");
$sentencia->bindParam('id_categoria', $id_categoria);
$sentencia->bindParam('nombre_cat', $nombre_cat);
$sentencia->bindParam('descripcion_cat', $descripcion_cat);

if ($sentencia->execute()) {
    session_start();
    $_SESSION['mensaje'] = "Datos actualizados correctamente";
    $_SESSION['icono'] = 'success';
    header('Location: ' . $URL . '/admin/maestros/categorias');
} else {
    session_start();
    $_SESSION['mensaje'] = "Error en la actualización";
    $_SESSION['icono'] = 'warning';
    header('Location: ' . $URL . '/admin/maestros/categorias/update.php?id_categoria=' . $id_categoria);
}


