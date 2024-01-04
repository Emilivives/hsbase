<?php

include('../../../app/config.php');

$id_usuario = $_POST['id_usuario'];
$nombre_usr = $_POST['nombre_usr'];
//$email_usr = $_POST['email_usr'];
$perfil = $_POST['perfil'];
$password_usr = $_POST['password_usr'];
$password_verify = $_POST['password_verify'];


if ($password_usr == "") {
    $sentencia = $pdo->prepare("UPDATE tb_usuarios 
    SET nombre_usr=:nombre_usr, 
    id_perfil=:id_perfil,
    fyh_actualizacion:=:fyh_actualizacion
    WHERE id_usuario = :id_usuario");
    $sentencia->bindParam('nombre_usr', $nombre_usr);
    //$sentencia->bindParam('email_usr', $email_usr);
    $sentencia->bindParam('id_perfil', $perfil);
    $sentencia->bindParam('fyh_actualizacion', $fechahora);
    $sentencia->bindParam('id_usuario', $id_usuario);


    if ($sentencia->execute()) {
        session_start();
        $_SESSION['mensaje'] = "Datos actualizados correctamente";
        $_SESSION['icono'] = 'success';
        header('Location: ' . $URL . '/admin/usuarios/');
    } else {
        session_start();
        $_SESSION['mensaje'] = "Error en la actualización";
        $_SESSION['icono'] = 'warning';
        header('Location: ' . $URL . '/admin/usuarios/update.php?id_usuario=' . $id_usuario);
    }
}





if ($password_usr == $password_verify) {
    $password_usr = password_hash($password_usr, PASSWORD_DEFAULT);
    $sentencia = $pdo->prepare("UPDATE tb_usuarios 
    SET nombre_usr=:nombre_usr,
    password_usr=:password_usr,
    id_perfil=:id_perfil,
    fyh_actualizacion:=:fyh_actualizacion
    WHERE id_usuario = :id_usuario");
    $sentencia->bindParam('nombre_usr', $nombre_usr);
    $sentencia->bindParam('password_usr', $password_usr);
    $sentencia->bindParam('id_perfil', $perfil);
    $sentencia->bindParam('fyh_actualizacion', $fechahora);
    $sentencia->bindParam('id_usuario', $id_usuario);

    if ($sentencia->execute()) {
        session_start();
        $_SESSION['mensaje'] = "Datos actualizados correctamente";
        $_SESSION['icono'] = 'success';
        header('Location: ' . $URL . '/admin/usuarios/');
    } else {
        session_start();
        $_SESSION['mensaje'] = "Error en la actualización";
        $_SESSION['icono'] = 'warning';
        header('Location: ' . $URL . '/admin/usuarios/update.php?id_usuario=' . $id_usuario);
    }
} else {
    session_start();
    $_SESSION['mensaje'] = "Las contraseñas no son iguales";
    $_SESSION['icono'] = 'warning';
    header('Location: ' . $URL . '/admin/usuarios/update.php?id_usuario=' . $id_usuario);
}
