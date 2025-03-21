<?php
include('../../../config.php'); // Conexión a la BD
session_start(); // Iniciar sesión para usar $_SESSION

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_centro = $_POST["id_centro"];
    $nombre_cen = $_POST["nombre_cen"];
    $empresa_cen = $_POST["empresa_cen"];
    $estado_cen = $_POST["estado_cen"];
    $tipo_cen = $_POST["tipo_cen"];
    $direccion_cen = $_POST["direccion_cen"];

    // Preparar la consulta
    $sql = "UPDATE centros SET nombre_cen = ?, empresa_cen = ?, estado_cen = ?, tipo_cen = ?, direccion_cen = ? WHERE id_centro = ?";
    $stmt = $pdo->prepare($sql);
    
    // Ejecutar la consulta y verificar si se actualizó correctamente
    if ($stmt->execute([$nombre_cen, $empresa_cen, $estado_cen, $tipo_cen, $direccion_cen, $id_centro])) {
        $_SESSION['mensaje'] = "Centro actualizado correctamente";
        $_SESSION['icono'] = 'success';
    } else {
        $_SESSION['mensaje'] = "Error al actualizar el centro";
        $_SESSION['icono'] = 'error';
    }

    // Redirigir a la vista de centros
    header('Location: ' . $URL . '/admin/maestros/centros');
    exit;
}
?>
