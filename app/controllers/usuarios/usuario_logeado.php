<?php
// usuario_logeado.php

include('../../config.php'); // Incluir configuración para acceder a la base de datos

// Verificar si la sesión ya está iniciada
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Verificamos que el usuario esté logueado
if (!isset($_SESSION['sesion_email'])) {
    // Redirigir al login si no hay sesión
    header('Location: ' . $URL . '/login');
    exit;
}

// Obtener el ID del usuario desde la sesión
$id_usuario = $_SESSION['id_usuario'];

// Consulta para obtener información del usuario y su perfil
$sql = "SELECT us.id_usuario as id_usuario, us.nombre_usr as nombre_usr, us.email_usr as email_usr, pf.nombre_pf as nombre_pf 
        FROM `tb_usuarios` as us 
        INNER JOIN `tb_perfiles` as pf ON us.id_perfil = pf.id_perfil 
        WHERE us.id_usuario = :id_usuario";

$query = $pdo->prepare($sql);
$query->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
$query->execute();
$usuarios = $query->fetchAll(PDO::FETCH_ASSOC);

// Guardar información del usuario en la sesión
if ($usuarios) {
    foreach ($usuarios as $usuario) {
        $_SESSION['nombre_usr'] = $usuario['nombre_usr'];
        $_SESSION['email_usr'] = $usuario['email_usr'];
        $_SESSION['perfil_usr'] = $usuario['nombre_pf']; // Guardamos el perfil en la sesión
    }
} else {
    // Si no se encuentra el usuario, redirigir al login
    header('Location: ' . $URL . '/login');
    exit;
}
?>
