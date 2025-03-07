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
$fecha_fin = $_POST['fecha_fin'];
$concepto = $_POST['concepto'];
$regimen = $_POST['regimen'];
$generado = $_POST['generado'];




$sentencia = $pdo->prepare("INSERT INTO vacacion_gen (id_trabajador, id_centro, fecha_inicio, fecha_fin, concepto, regimen, generado) 
VALUES(:id_trabajador, :id_centro, :fecha_inicio, :fecha_fin, :concepto, :regimen, :generado)");

$sentencia->bindParam(':id_trabajador', $id_trabajador);    
$sentencia->bindParam(':id_centro', $id_centro);
$sentencia->bindParam(':fecha_inicio', $fecha_inicio);
$sentencia->bindParam(':fecha_fin', $fecha_fin);
$sentencia->bindParam(':concepto', $concepto);
$sentencia->bindParam(':regimen', $regimen);
$sentencia->bindParam(':generado', $generado);

if ($sentencia->execute()) {
session_start();
$_SESSION['mensaje'] = "Reconocimiento registrado correctamente";
$_SESSION['icono'] = 'success';
header('Location: ' . $URL . '/admin/vacaciones');
} else {
session_start();
$_SESSION['mensaje'] = "Formacion NO creada";
$_SESSION['icono'] = 'warning';
header('Location: ' . $URL . '/admin/vacaciones');
}


?>
