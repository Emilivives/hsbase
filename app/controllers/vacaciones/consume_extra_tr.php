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
$fecha_inicio = $_POST['fecha_inicio'];
$fecha_fin = null;
$consumido = $_POST['consumido'];
$descuenta = $_POST['descuenta'];
$notas = $_POST['notas'];
$comunicado = 'Si';



$sentencia = $pdo->prepare("INSERT INTO vacacion_con (id_trabajador, fecha_inicio, fecha_fin, consumido, descuenta, notas, comunicado) 
VALUES(:id_trabajador, :fecha_inicio, :fecha_fin, :consumido, :descuenta, :notas, :comunicado)");

$sentencia->bindParam(':id_trabajador', $id_trabajador);    
$sentencia->bindParam(':fecha_inicio', $fecha_inicio);
$sentencia->bindParam(':fecha_fin', $fecha_fin);
$sentencia->bindParam(':consumido', $consumido);
$sentencia->bindParam(':descuenta', $descuenta);
$sentencia->bindParam(':notas', $notas);
$sentencia->bindParam(':comunicado', $comunicado);


if ($sentencia->execute()) {
session_start();
$_SESSION['mensaje'] = "Reconocimiento registrado correctamente";
$_SESSION['icono'] = 'success';
header('Location: ' . $URL . '/admin/vacaciones/detalles_trabajador.php?id_trabajador='.$id_trabajador.'');
} else {
session_start();
$_SESSION['mensaje'] = "Formacion NO creada";
$_SESSION['icono'] = 'warning';
header('Location: ' . $URL . '/admin/vacaciones/detalles_trabajador.php?id_trabajador='.$id_trabajador.'');
}


?>
