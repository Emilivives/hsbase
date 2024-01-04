<?php

include('../../../app/config.php');

$id_perfil = $_POST['id_perfil'];
$nombre_pf = $_POST['nombre_pf'];


$sentencia = $pdo->prepare("UPDATE tb_perfiles SET nombre_pf=:nombre_pf, fyh_actualizacion:=:fyh_actualizacion WHERE id_perfil = :id_perfil");
$sentencia->bindParam('nombre_pf', $nombre_pf);
$sentencia->bindParam('fyh_actualizacion', $fechahora);
$sentencia->bindParam('id_perfil', $id_perfil);


if ($sentencia->execute()) {
    session_start();
    $_SESSION['mensaje'] = "Datos actualizados correctamente";
    $_SESSION['icono'] = 'success';
    header('Location: ' . $URL . '/admin/perfiles/');
} else {
    session_start();
    $_SESSION['mensaje'] = "Error en la actualización";
    $_SESSION['icono'] = 'warning';
    header('Location: ' . $URL . '/admin/perfiles/update.php?id_perfil=' . $id_perfil);
}


