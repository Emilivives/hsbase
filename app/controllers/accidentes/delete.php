<?php
session_start();
include('../../../app/config.php');

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['sesion_email'])) {
    header('Location: ' . $URL . '/login.php');
    exit();
}

// Verificar si el usuario tiene permiso para eliminar (ADMINISTRADOR o USUARIO_PRL)
if ($_SESSION['perfil_usr'] !== 'ADMINISTRADOR' && $_SESSION['perfil_usr'] !== 'USUARIO_PRL') {
    // Si no tiene permisos, redirigir a una página de acceso denegado
    header('Location: ' . $URL . '/admin/acceso_nopermitido.php');
    exit();
}

// Validar que se haya pasado un ID por la URL
if (isset($_GET['id_accidente'])) {
    $id_accidente = $_GET['id_accidente'];

    // Usar un prepared statement para evitar SQL Injection
    $sentencia = $pdo->prepare("DELETE FROM accidentes WHERE id_accidente = :id_accidente");
    $sentencia->bindParam(':id_accidente', $id_accidente, PDO::PARAM_INT);

    // Ejecutar la sentencia y verificar si se eliminó correctamente
    if ($sentencia->execute()) {
        // Si se elimina correctamente, establecer un mensaje de éxito
        $_SESSION['mensaje'] = "Se eliminó el registro de accidente correctamente";
        $_SESSION['icono'] = "success";
    } else {
        // Si ocurre un error, establecer un mensaje de error
        $_SESSION['mensaje'] = "Hubo un error al eliminar el registro del accidente";
        $_SESSION['icono'] = "error";
    }
} else {
    // Si no se proporciona un ID válido, redirigir con un mensaje de error
    $_SESSION['mensaje'] = "No se proporcionó un ID válido para eliminar";
    $_SESSION['icono'] = "error";
}

// Redirigir a la página de accidentes
header('Location: ' . $URL .'/admin/accidentes/index.php');
exit();
