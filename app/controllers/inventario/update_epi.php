<?php
session_start();
include('../../config.php'); // Usa PDO en lugar de MySQLi

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        // Iniciar transacción
        $pdo->beginTransaction();

        // Recogemos y validamos los datos
        $id_epi = filter_var($_POST['id_epi'], FILTER_VALIDATE_INT);
        if (!$id_epi) {
            throw new Exception("ID de EPI inválido.");
        }

        $clase_epi = htmlspecialchars($_POST['clase_epi']);
        $tipo_epi = htmlspecialchars($_POST['tipo_epi']);
        $marca_epi = htmlspecialchars($_POST['marca_epi']);
        $modelo_epi = htmlspecialchars($_POST['modelo_epi']);
        $numserie_epi = htmlspecialchars($_POST['numserie_epi']);
        $aniofab_epi = htmlspecialchars($_POST['aniofab_epi']);
        $vigencia_epi = htmlspecialchars($_POST['vigencia_epi']);
        $manual_epi = htmlspecialchars($_POST['manual_epi']);
        $marcace_epi = htmlspecialchars($_POST['marcace_epi']);
        $centro_epi = htmlspecialchars($_POST['centro_epi']);
        $estado_epi = htmlspecialchars($_POST['estado_epi']);
        $observaciones_epi = htmlspecialchars($_POST['observaciones_epi']);
        $fecha_actualizacion = date('Y-m-d H:i:s');

        // Obtener imágenes actuales
        $sql_img = "SELECT img1_epi, img2_epi FROM inv_epis WHERE id_epi = ?";
        $stmt_img = $pdo->prepare($sql_img);
        $stmt_img->execute([$id_epi]);
        $row_img = $stmt_img->fetch(PDO::FETCH_ASSOC);

        if (!$row_img) {
            throw new Exception("EPI no encontrado.");
        }

        $img1_epi = $row_img['img1_epi'];
        $img2_epi = $row_img['img2_epi'];

        // Función para manejar subida de imágenes
        function procesarImagen($file, $nombre_base, $id_epi, $img_actual) {
            if ($file['error'] == 0 && $file['size'] > 0) {
                $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
                $permitidos = ["jpg", "jpeg", "png", "gif"];

                if (!in_array($ext, $permitidos)) {
                    throw new Exception("Extensión de imagen no permitida.");
                }

                if ($file['size'] > 1048576) {
                    throw new Exception("La imagen es demasiado grande (máx. 1MB).");
                }

                $nuevo_nombre = "{$nombre_base}_{$id_epi}_" . time() . ".{$ext}";
                $ruta = "../../../admin/inventario/img/" . $nuevo_nombre;

                if (!move_uploaded_file($file['tmp_name'], $ruta)) {
                    throw new Exception("Error al subir la imagen.");
                }

                // Eliminar imagen anterior si existe
                if (!empty($img_actual) && file_exists("../../../admin/inventario/img/" . $img_actual)) {
                    unlink("../../../admin/inventario/img/" . $img_actual);
                }

                return $nuevo_nombre;
            }

            return $img_actual; // Mantener la imagen actual si no se subió una nueva
        }

        // Procesar imágenes
        $img1_epi = procesarImagen($_FILES['img1_epi'], "epi_img1", $id_epi, $img1_epi);
        $img2_epi = procesarImagen($_FILES['img2_epi'], "epi_img2", $id_epi, $img2_epi);

        // Actualizar datos en la base de datos
        $sql = "UPDATE inv_epis SET 
                clase_epi = ?, tipo_epi = ?, marca_epi = ?, modelo_epi = ?, numserie_epi = ?, 
                aniofab_epi = ?, vigencia_epi = ?, manual_epi = ?, marcace_epi = ?, 
                centro_epi = ?, estado_epi = ?, observaciones_epi = ?, 
                img1_epi = ?, img2_epi = ?
                WHERE id_epi = ?";
        
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            $clase_epi, $tipo_epi, $marca_epi, $modelo_epi, $numserie_epi,
            $aniofab_epi, $vigencia_epi, $manual_epi, $marcace_epi,
            $centro_epi, $estado_epi, $observaciones_epi,
            $img1_epi, $img2_epi, $id_epi
        ]);

        // Confirmar la transacción
        if ($stmt->rowCount() > 0) {
            $pdo->commit();
            $_SESSION['mensaje'] = "Registro actualizado correctamente.";
            $_SESSION['icono'] = 'success';
        } else {
            throw new Exception("No se realizó ninguna actualización. Verifica los datos.");
        }
    } catch (Exception $e) {
        $pdo->rollBack();
        $_SESSION['mensaje'] = "Error: " . $e->getMessage();
        $_SESSION['icono'] = "error";
    }

    header("Location: " . $URL . "/admin/inventario/controlepis.php");
    exit();
}
?>
