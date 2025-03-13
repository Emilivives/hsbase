<?php
session_start();
include('../../../app/config.php');

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
$id_vac_generada = $_POST['id_vac_generada'];
$id_centro = $_POST['id_centro'];
$fecha_inicio = $_POST['fecha_inicio'];
$fecha_fin = !empty($_POST['fecha_fin']) ? $_POST['fecha_fin'] : null;
$concepto = $_POST['concepto'];
$regimen = $_POST['regimen'];
$generado = !empty($_POST['generado']) ? $_POST['generado'] : null;
$comunicado = 'Si';
$extra = $_POST['extra'];
$usuario = $_SESSION['nombre_usr'];

// Preparamos la consulta UPDATE
$sentencia = $pdo->prepare("UPDATE vacacion_gen 
    SET id_centro = :id_centro,
        fecha_inicio = :fecha_inicio,
        fecha_fin = :fecha_fin,
        concepto = :concepto,
        regimen = :regimen,
        generado = :generado,
        comunicado = :comunicado,
        extra = :extra,
        usuario = :usuario,
        fyh_actualizacion = :fyh_actualizacion
    WHERE id_vac_generada = :id_vac_generada");

// Vinculamos los parámetros
$sentencia->bindParam(':id_vac_generada', $id_vac_generada);
$sentencia->bindParam(':id_centro', $id_centro);
$sentencia->bindParam(':fecha_inicio', $fecha_inicio);
$sentencia->bindValue(':fecha_fin', $fecha_fin, $fecha_fin !== null ? PDO::PARAM_STR : PDO::PARAM_NULL);
$sentencia->bindParam(':concepto', $concepto);
$sentencia->bindParam(':regimen', $regimen);
$sentencia->bindParam(':generado', $generado, is_null($generado) ? PDO::PARAM_NULL : PDO::PARAM_STR);
$sentencia->bindParam(':comunicado', $comunicado);
$sentencia->bindParam(':extra', $extra);
$sentencia->bindParam(':usuario', $usuario);
$sentencia->bindParam(':fyh_actualizacion', $fechahora);

// Ejecutamos la consulta y manejamos el resultado
if ($sentencia->execute()) {
    // Necesitamos obtener el id_trabajador para la redirección
    $sentencia2 = $pdo->prepare("SELECT id_trabajador FROM vacacion_gen WHERE id_vac_generada = :id_vac_generada");
    $sentencia2->bindParam(':id_vac_generada', $id_vac_generada);
    $sentencia2->execute();
    $resultado = $sentencia2->fetch(PDO::FETCH_ASSOC);
    $id_trabajador = $resultado['id_trabajador'];

    session_start();
    $_SESSION['mensaje'] = "Registro actualizado correctamente";
    $_SESSION['icono'] = 'success';
    header('Location: ' . $URL . '/admin/vacaciones/detalles_trabajador.php?id_trabajador=' . $id_trabajador);
} else {
    // En caso de error, también necesitamos el id_trabajador para la redirección
    $sentencia2 = $pdo->prepare("SELECT id_trabajador FROM vacacion_gen WHERE id_vac_generada = :id_vac_generada");
    $sentencia2->bindParam(':id_vac_generada', $id_vac_generada);
    $sentencia2->execute();
    $resultado = $sentencia2->fetch(PDO::FETCH_ASSOC);
    $id_trabajador = $resultado['id_trabajador'];

    session_start();
    $_SESSION['mensaje'] = "Error al actualizar el registro";
    $_SESSION['icono'] = 'error';
    header('Location: ' . $URL . '/admin/vacaciones/detalles_trabajador.php?id_trabajador=' . $id_trabajador);
}
?>