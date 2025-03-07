<?php 
include('../../../app/config.php');

// Verificar si se ha pasado el ID de la fila
$id_filaeval = isset($_POST['id_filaeval']) ? $_POST['id_filaeval'] : null;
$id_evaluacion = isset($_POST['id_evaluacion']) ? $_POST['id_evaluacion'] : null;
$puestocentro_fer = isset($_POST['puestocentro_fer']) ? $_POST['puestocentro_fer'] : null;

// Verificar si se ha subido una nueva imagen de riesgo
if (isset($_FILES['imgriesgo_fer']) && $_FILES['imgriesgo_fer']['error'] == UPLOAD_ERR_OK) {
    $nombreDelArchivo = date("Y-m-d-h-i-s");
    $filename = $nombreDelArchivo . "__" . $_FILES['imgriesgo_fer']['name'];
    $location = "../../../admin/evaluacion/image/" . $filename;
    move_uploaded_file($_FILES['imgriesgo_fer']['tmp_name'], $location);
} else {
    // Mantener la imagen de riesgo existente si no se ha subido una nueva
    $filename = isset($_POST['imgriesgo_fer_existente']) ? $_POST['imgriesgo_fer_existente'] : null;
}

// Verificar si se ha subido una nueva imagen preventiva
if (isset($_FILES['imgplan_fer']) && $_FILES['imgplan_fer']['error'] == UPLOAD_ERR_OK) {
    $nombreDelArchivo = date("Y-m-d-h-i-s");
    $filename2 = $nombreDelArchivo . "__" . $_FILES['imgplan_fer']['name'];
    $location2 = "../../../admin/evaluacion/image/" . $filename2;
    move_uploaded_file($_FILES['imgplan_fer']['tmp_name'], $location2);
} else {
    // Mantener la imagen preventiva existente si no se ha subido una nueva
    $filename2 = isset($_POST['imgplan_fer_existente']) ? $_POST['imgplan_fer_existente'] : null;
}

try {
    $pdo->beginTransaction();

    // Solo actualizar las columnas de imágenes si han sido modificadas
    $sentencia = $pdo->prepare("UPDATE er_filas SET 
        imgriesgo_fer = :imgriesgo_fer, 
        imgplan_fer = :imgplan_fer
        WHERE id_filaeval = :id_filaeval");

    $sentencia->bindParam(':imgriesgo_fer', $filename);
    $sentencia->bindParam(':imgplan_fer', $filename2);
    $sentencia->bindParam(':id_filaeval', $id_filaeval);

    // Ejecutar la sentencia
    $sentencia->execute();

    // Confirmar la transacción
    $pdo->commit();

    // Mensaje de éxito
    session_start();
    $_SESSION['mensaje'] = "Imágenes actualizadas correctamente";
    $_SESSION['icono'] = 'success';
    header("Location: " . $URL . "/admin/evaluacion/show_puestoarea.php?id_puestocentro=$puestocentro_fer&id_evaluacion=$id_evaluacion");
    exit();

} catch (PDOException $e) {
    $pdo->rollBack();
    session_start();
    $_SESSION['mensaje'] = "Error en la base de datos: " . $e->getMessage();
    $_SESSION['icono'] = 'warning';
    header("Location: " . $URL . "/admin/evaluacion/show_puestoarea.php?id_puestocentro=$puestocentro_fer&id_evaluacion=$id_evaluacion");
    exit();

} catch (Exception $e) {
    $pdo->rollBack();
    session_start();
    $_SESSION['mensaje'] = "Error inesperado: " . $e->getMessage();
    $_SESSION['icono'] = 'warning';
    header("Location: " . $URL . "/admin/evaluacion/show_puestoarea.php?id_puestocentro=$puestocentro_fer&id_evaluacion=$id_evaluacion");
    exit();
}
?>
