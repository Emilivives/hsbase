<?php
session_start();

if (!isset($_SESSION['id_usuario'])) {
    header('Location: ' . $URL . '/login.php');
    exit();
}

function es_admin() {
    return isset($_SESSION['perfil_usr']) && $_SESSION['perfil_usr'] === 'ADMINISTRADOR';
}

function es_usuario() {
    return isset($_SESSION['perfil_usr']) && $_SESSION['perfil_usr'] === 'USUARIO';
}

function verificar_acceso($pagina) {
    global $URL;
    
    $acceso_admin = [
        'dashboard',
        'accionprl',
        'accidentes',
        'actividadprl',
        'formacion',
        'usuarios',
        'maestros',
        // Añade aquí otras páginas exclusivas de administrador
    ];
    
    $acceso_usuario = [
        'dashboard',
        'accionprl',
        'accidentes',
        'actividadprl',
        'formacion',
        
        // Añade aquí otras páginas accesibles por usuarios normales
    ];
    
    if (in_array($pagina, $acceso_admin) && !es_admin()) {
        header('Location: ' . $URL . '/acceso_denegado.php');
        exit();
    }
    
    if (in_array($pagina, $acceso_usuario) && !es_usuario() && !es_admin()) {
        header('Location: ' . $URL . '/acceso_denegado.php');
        exit();
    }
}
?>
