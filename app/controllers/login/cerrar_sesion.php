<?php

include('../../config.php');

// Iniciar la sesión
session_start();

// Verificar si la sesión está activa y destruirla
if (isset($_SESSION['sesion_email'])) {
    // Destruir todas las variables de la sesión
    $_SESSION = array();

    // Destruir la sesión
    session_destroy();

    // Deshabilitar la caché del navegador
    header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1
    header("Pragma: no-cache"); // HTTP 1.0
    header("Expires: 0"); // Proxies

    // Redirigir al usuario al index.html
    header('location:' . $URL . '/index.html');
    exit();
}
?>
