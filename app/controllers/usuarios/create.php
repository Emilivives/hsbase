<?php

include('../../../app/config.php');

$nombre_usr = $_POST['nombre_usr'];
$email_usr = $_POST['email_usr'];
$password_usr = $_POST['password_usr'];
$password_verify = $_POST['password_verify'];
$perfil_usr = $_POST['perfil'];

$contador = 0;
$sql = "SELECT * FROM `tb_usuarios` WHERE email_usr = '$email_usr'";
$query = $pdo->prepare($sql);
$query->execute();
$usuarios = $query->fetchAll(PDO::FETCH_ASSOC);
foreach ($usuarios as $usuario) {
    $contador = $contador + 1;
}
if ($contador>0) {
    //echo "Usuario ya registrado en la base de datos";
   session_start();
    $_SESSION['mensaje'] = "".$email_usr." ya esta registrado en la base de datos";
    $_SESSION['icono'] = 'error';
    header('Location: ' . $URL . '/admin/usuarios/create.php');
} else {
   //echo "Usuario nuevo";
   if ($password_usr == $password_verify) {
    // echo "si son iguales";

    $password_usr = password_hash($password_usr, PASSWORD_DEFAULT);


    $sentencia = $pdo->prepare("INSERT INTO tb_usuarios (id_usuario, nombre_usr, email_usr, password_usr, token_usr, id_perfil, fyh_creacion, fyh_actualizacion) 
                         VALUES(NULL,:nombre_usr, :email_usr, :password_usr, NULL, :id_perfil, :fyh_creacion, NULL)");

    $sentencia->bindParam('nombre_usr', $nombre_usr);
    $sentencia->bindParam('email_usr', $email_usr);
    $sentencia->bindParam('password_usr', $password_usr);
    $sentencia->bindParam('id_perfil', $perfil_usr);
    $sentencia->bindParam('fyh_creacion', $fechahora);


    if ($sentencia->execute()) {
        session_start();
        $_SESSION['mensaje'] = "Registro completado correctamente";
        $_SESSION['icono'] = 'success';
        header('Location: ' . $URL . '/admin/usuarios');
    } else {
        echo "No se pudo registrar usuario";
    }
} else {
    //echo "las contraseñas no son iguales";
    session_start();
    $_SESSION['mensaje'] = "Las contraseñas no son iguales";
    $_SESSION['icono'] = 'warning';
    header('Location: ' . $URL . '/admin/usuarios/create.php');
}
}


    