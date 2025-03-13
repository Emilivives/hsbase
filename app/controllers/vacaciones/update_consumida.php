<?php
session_start();
include('../../../app/config.php');
ob_start();  // Esto asegura que los encabezados se envíen antes de cualquier salida


// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['sesion_email'])) {
    header('Location: ' . $URL . '/login.php');
    exit();
}

// Verificar si el usuario tiene permiso para eliminar (ADMINISTRADOR o USUARIO_RRHH)
if ($_SESSION['perfil_usr'] !== 'ADMINISTRADOR' && $_SESSION['perfil_usr'] !== 'USUARIO_RRHH') {
    // Si no tiene permisos, redirigir a una página de acceso denegado
    header('Location: ' . $URL . '/admin/acceso_nopermitido.php');
    exit();
}

// Recibimos los datos del formulario
$id_vac_consumida = $_POST['id_vac_consumida'];
$id_trabajador = $_POST['id_trabajador'];
$fecha_inicio = $_POST['fecha_inicio'];
$fecha_fin = !empty($_POST['fecha_fin']) ? $_POST['fecha_fin'] : null;
$consumido = !empty($_POST['consumido']) ? $_POST['consumido'] : null;
$descuenta = isset($_POST['descuenta']) && $_POST['descuenta'] === "0" ? 0 : 1; // 0 si es "PERMISO JUSTIFICADO", 1 si es otro
$notas = $_POST['notas'];
$comunicado = $_POST['comunicado'];
$usuario = $_SESSION['nombre_usr'];

// Crear variables intermedias para valores opcionales
$fecha_fin_param = $fecha_fin ?: null; // Null si vacío
$consumido_param = $consumido ?: null; // Null si vacío

try {
    // Preparamos la consulta UPDATE
    $sentencia = $pdo->prepare("UPDATE vacacion_con 
        SET id_trabajador = :id_trabajador,
            fecha_inicio = :fecha_inicio,
            fecha_fin = :fecha_fin,
            consumido = :consumido,
            descuenta = :descuenta,
            notas = :notas, 
            comunicado = :comunicado, 
            usuario = :usuario, 
            fyh_actualizacion = :fyh_actualizacion
        WHERE id_vac_consumida = :id_vac_consumida");

    // Vinculamos los parámetros
    $sentencia->bindParam(':id_vac_consumida', $id_vac_consumida, PDO::PARAM_INT);
    $sentencia->bindParam(':id_trabajador', $id_trabajador);
    $sentencia->bindParam(':fecha_inicio', $fecha_inicio);
    $sentencia->bindParam(':fecha_fin', $fecha_fin_param, PDO::PARAM_STR);
    $sentencia->bindParam(':consumido', $consumido_param, PDO::PARAM_STR);
    $sentencia->bindParam(':descuenta', $descuenta, PDO::PARAM_INT);
    $sentencia->bindParam(':notas', $notas);
    $sentencia->bindParam(':comunicado', $comunicado);
    $sentencia->bindParam(':usuario', $usuario);
    $sentencia->bindParam(':fyh_actualizacion', $fechahora);

    // Ejecutamos la consulta
    if ($sentencia->execute()) {
        // Obtenemos el id_trabajador para la redirección
        $sentencia2 = $pdo->prepare("SELECT id_trabajador FROM vacacion_con WHERE id_vac_consumida = :id_vac_consumida");
        $sentencia2->bindParam(':id_vac_consumida', $id_vac_consumida);
        $sentencia2->execute();
        $resultado = $sentencia2->fetch(PDO::FETCH_ASSOC);
        $id_trabajador = $resultado['id_trabajador'];

        session_start();
        $_SESSION['mensaje'] = "Registro actualizado correctamente";
        $_SESSION['icono'] = 'success';
        ob_end_clean(); // Limpia el búfer de salida si es necesario

        header('Location: ' . $URL . '/admin/vacaciones/detalles_trabajador.php?id_trabajador=' . $id_trabajador);
    } else {
        // En caso de error, también necesitamos el id_trabajador para la redirección
        $sentencia2 = $pdo->prepare("SELECT id_trabajador FROM vacacion_con WHERE id_vac_consumida = :id_vac_consumida");
        $sentencia2->bindParam(':id_vac_consumida', $id_vac_consumida);
        $sentencia2->execute();
        $resultado = $sentencia2->fetch(PDO::FETCH_ASSOC);
        $id_trabajador = $resultado['id_trabajador'];

        session_start();
        $_SESSION['mensaje'] = "Error al actualizar el registro";
        $_SESSION['icono'] = 'error';
        ob_end_clean(); // Limpia el búfer de salida si es necesario

        header('Location: ' . $URL . '/admin/vacaciones/detalles_trabajador.php?id_trabajador=' . $id_trabajador);
    }
} catch (PDOException $e) {
    // En caso de excepción, manejamos el error
    session_start();
    $_SESSION['mensaje'] = "Error: " . $e->getMessage();
    $_SESSION['icono'] = 'danger';
    ob_end_clean(); // Limpia el búfer de salida si es necesario

    header('Location: ' . $URL . '/admin/vacaciones/detalles_trabajador.php?id_trabajador=' . $id_trabajador);
}
