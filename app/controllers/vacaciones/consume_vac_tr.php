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
$fecha_fin = !empty($_POST['fecha_fin']) ? $_POST['fecha_fin'] : null;
$consumido = !empty($_POST['consumido']) ? $_POST['consumido'] : null;
$descuenta = $_POST['descuenta'];
$notas = $_POST['notas'];
$comunicado = !empty($_POST['comunicado']) ? $_POST['comunicado'] : "Sin información"; // Valor predeterminado
// Crear variables intermedias para los valores que pueden ser null
$fecha_fin_param = $fecha_fin ?: null; // Asigna null si está vacío
$consumido_param = $consumido ?: null; // Asigna null si está vacío


try {
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sentencia = $pdo->prepare("INSERT INTO vacacion_con (id_trabajador, fecha_inicio, fecha_fin, consumido, descuenta, notas, comunicado) 
    VALUES(:id_trabajador, :fecha_inicio, :fecha_fin, :consumido, :descuenta, :notas, :comunicado)");

    $sentencia->bindParam(':id_trabajador', $id_trabajador);
    $sentencia->bindParam(':fecha_inicio', $fecha_inicio);
    $sentencia->bindParam(':fecha_fin', $fecha_fin_param, PDO::PARAM_STR);
    $sentencia->bindParam(':consumido', $consumido_param, PDO::PARAM_STR);
    $sentencia->bindParam(':descuenta', $descuenta);
    $sentencia->bindParam(':notas', $notas);
    $sentencia->bindParam(':comunicado', $comunicado);


    if ($sentencia->execute()) {
        session_start();
        $_SESSION['mensaje'] = "Consumo de días registrado correctamente";
        $_SESSION['icono'] = 'success';
    } else {
        session_start();
        $_SESSION['mensaje'] = "Error al registrar el consumo de días";
        $_SESSION['icono'] = 'warning';
    }
} catch (PDOException $e) {
    session_start();
    $_SESSION['mensaje'] = "Error: " . $e->getMessage();
    $_SESSION['icono'] = 'danger';
}

header('Location: ' . $URL . '/admin/vacaciones/detalles_trabajador.php?id_trabajador='.$id_trabajador);

?>
