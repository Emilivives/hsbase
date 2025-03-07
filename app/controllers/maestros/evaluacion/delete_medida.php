<?php
include('../../../../app/config.php');

// Verifica si el id_medida existe en la URL y es un número
if (isset($_GET['id_medida']) && is_numeric($_GET['id_medida'])) {
    $id_medida = $_GET['id_medida'];

    // Prepara la consulta SQL usando parámetros para evitar SQL injection
    $sentencia = $pdo->prepare("DELETE FROM er_medidas WHERE id_medida = :id_medida");
    $sentencia->bindParam(':id_medida', $id_medida, PDO::PARAM_INT);

    if ($sentencia->execute()) {
        session_start();
        $_SESSION['mensaje'] = "Medida eliminada correctamente";
        $_SESSION['icono'] = 'success';
        header('Location: ' . $URL . '/admin/maestros/evaluacion');
    } else {
        session_start();
        $_SESSION['mensaje'] = "Medida no eliminada correctamente";
        $_SESSION['icono'] = 'error';
        header('Location: ' . $URL . '/admin/maestros/evaluacion');
    }
} else {
    // Si no se envía un id_medida válido, maneja el error
    die("ID de medida inválido.");
}
?>
