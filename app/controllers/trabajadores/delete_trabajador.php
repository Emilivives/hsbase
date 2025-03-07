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
if (isset($_GET['id_trabajador'])) {
    $id_trabajador = $_GET['id_trabajador'];

    // Usar un prepared statement para evitar SQL Injection
    $sentencia = $pdo->prepare("DELETE FROM trabajadores WHERE id_trabajador = :id_trabajador");
    $sentencia->bindParam(':id_trabajador', $id_trabajador, PDO::PARAM_INT);

    // Ejecutar la sentencia y verificar si se eliminó correctamente
    if ($sentencia->execute()) {
        // Si se elimina correctamente, establecer un mensaje de éxito
        $_SESSION['mensaje'] = "Se eliminó el trabajador de la manera correcta";
        $_SESSION['icono'] = "success";
    } else {
        // Si ocurre un error, establecer un mensaje de error
        $_SESSION['mensaje'] = "Hubo un error al eliminar el trabajador";
        $_SESSION['icono'] = "error";
    }
} else {
    // Si no se proporciona un ID válido, redirigir con un mensaje de error
    $_SESSION['mensaje'] = "No se proporcionó un ID válido para eliminar";
    $_SESSION['icono'] = "error";
}

// Redirigir al listado o a la vista del trabajador
header('Location: ' . $URL . '/admin/trabajadores/trabajadorshow.php?id_trabajador=1');
exit();
