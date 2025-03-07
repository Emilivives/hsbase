<?php
// permisos_usuario.php

// Definir los permisos por perfil
$permisos_por_perfil = [
    'ADMINISTRADOR' => [
        'menu' => ['dashboard', 'usuarios', 'trabajadores', 'formaciones', 'accidentes', 'accionprl'],
        'paginas' => ['*'] // El administrador tiene acceso a todas las páginas
    ],
    'USUARIO_PRL' => [
        'menu' => ['dashboard', 'trabajadores', 'formaciones', 'accidentes'],
        'paginas' => ['dashboard.php', 'trabajadores.php', 'formaciones.php', 'accidentes.php']
    ],
    'USUARIO' => [
        'menu' => ['dashboard', 'trabajadores'],
        'paginas' => ['dashboard.php', 'trabajadores.php']
    ]
];

function tienePermiso($perfil_usuario, $pagina) {
    global $permisos_por_perfil;
    
    if (!isset($permisos_por_perfil[$perfil_usuario])) {
        return false;
    }
    
    $permisos = $permisos_por_perfil[$perfil_usuario];
    
    // Si el usuario tiene acceso a todas las páginas
    if (in_array('*', $permisos['paginas'])) {
        return true;
    }
    
    // Verificar si la página específica está en la lista de páginas permitidas
    return in_array($pagina, $permisos['paginas']);
}

function mostrarMenuPorPerfil($perfil_usuario) {
    global $permisos_por_perfil;
    
    if (!isset($permisos_por_perfil[$perfil_usuario])) {
        return [];
    }
    
    return $permisos_por_perfil[$perfil_usuario]['menu'];
}