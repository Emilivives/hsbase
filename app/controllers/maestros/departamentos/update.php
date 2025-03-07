<?php
include('../../../config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['id_departamento']) && isset($_POST['nombre_dpo']) && isset($_POST['descripcion_dpo'])) {
        
        // Sanitizar y recibir los datos del formulario
        $id_departamento = intval($_POST['id_departamento']);
        $nombre_dpo = trim($_POST['nombre_dpo']);
        $descripcion_dpo = trim($_POST['descripcion_dpo']);

        // Verificar que los datos no estén vacíos
        if (!empty($id_departamento) && !empty($nombre_dpo) && !empty($descripcion_dpo)) {
            
            // Preparar la consulta SQL para actualizar
            $sql = "UPDATE departamentos 
                    SET nombre_dpo = :nombre_dpo, descripcion_dpo = :descripcion_dpo 
                    WHERE id_departamento = :id_departamento";
            $query = $pdo->prepare($sql);
            $query->bindParam(':id_departamento', $id_departamento, PDO::PARAM_INT);
            $query->bindParam(':nombre_dpo', $nombre_dpo, PDO::PARAM_STR);
            $query->bindParam(':descripcion_dpo', $descripcion_dpo, PDO::PARAM_STR);

            // Ejecutar la consulta y verificar si se actualizó correctamente
            if ($query->execute()) {
                session_start();
                $_SESSION['mensaje'] = "Datos actualizados correctamente";
                $_SESSION['icono'] = 'success';
            } else {
                session_start();
                $_SESSION['mensaje'] = "Error al actualizar los datos";
                $_SESSION['icono'] = 'warning';
            }
        } else {
            session_start();
            $_SESSION['mensaje'] = "Faltan datos para actualizar";
            $_SESSION['icono'] = 'warning';
        }
    } else {
        session_start();
        $_SESSION['mensaje'] = "Datos no válidos";
        $_SESSION['icono'] = 'warning';
    }

    // Redireccionar de vuelta
    header('Location: ' . $URL . '/admin/maestros/varios');
    exit();
} else {
    echo "Método de solicitud no permitido.";
}
?>
