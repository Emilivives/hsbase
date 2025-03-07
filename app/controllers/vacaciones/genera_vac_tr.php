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

$id_trabajador = $_POST['id_trabajador'];
$id_centro = $_POST['id_centro'];
$fecha_inicio = $_POST['fecha_inicio'];
$fecha_fin = !empty($_POST['fecha_fin']) ? $_POST['fecha_fin'] : null;
$concepto = $_POST['concepto'];
$regimen = $_POST['regimen'];
$generado = !empty($_POST['generado']) ? $_POST['generado'] : null;
$comunicado = !empty($_POST['comunicado']) ? $_POST['comunicado'] : "Si"; // Valor predeterminado
$extra = !empty($_POST['extra']) ? $_POST['extra'] : "No"; // Valor predeterminado

// Crear variables intermedias para los valores que pueden ser null
$fecha_fin_param = $fecha_fin ?: null; // Asigna null si está vacío
$generado_param = $generado ?: null; // Asigna null si está vacío

$sentencia = $pdo->prepare("INSERT INTO vacacion_gen (id_trabajador, id_centro, fecha_inicio, fecha_fin, concepto, regimen, generado, comunicado, extra) 
VALUES(:id_trabajador, :id_centro, :fecha_inicio, :fecha_fin, :concepto, :regimen, :generado, :comunicado, :extra)");

$sentencia->bindParam(':id_trabajador', $id_trabajador);    
$sentencia->bindParam(':id_centro', $id_centro);
$sentencia->bindParam(':fecha_inicio', $fecha_inicio);
$sentencia->bindParam(':fecha_fin', $fecha_fin_param, PDO::PARAM_STR); // Usamos la variable intermedia
$sentencia->bindParam(':concepto', $concepto);
$sentencia->bindParam(':regimen', $regimen);
$sentencia->bindParam(':generado', $generado_param, PDO::PARAM_STR); // Usamos la variable intermedia
$sentencia->bindParam(':comunicado', $comunicado, PDO::PARAM_STR); // Siempre tendrá un valor
$sentencia->bindParam(':extra', $extra, PDO::PARAM_STR); // Siempre tendrá un valor

if ($sentencia->execute()) {
    session_start();
    $_SESSION['mensaje'] = "Reconocimiento registrado correctamente";
    $_SESSION['icono'] = 'success';
    header('Location: ' . $URL . '/admin/vacaciones/detalles_trabajador.php?id_trabajador='.$id_trabajador.'');
} else {
    session_start();
    $_SESSION['mensaje'] = "Formación NO creada";
    $_SESSION['icono'] = 'warning';
    header('Location: ' . $URL . '/admin/vacaciones/detalles_trabajador.php?id_trabajador='.$id_trabajador.'');
}
?>
