<?php 
include('../../../app/config.php');

// Verifica que los datos existan en $_POST antes de asignarlos
$id_filaeval = isset($_POST['id_filaeval']) ? $_POST['id_filaeval'] : null;
$id_evaluacion = isset($_POST['id_evaluacion']) ? $_POST['id_evaluacion'] : null;
$puestocentro_fer = isset($_POST['puestocentro_fer']) ? $_POST['puestocentro_fer'] : null;
$frasefila_fer = isset($_POST['frasefila_fer']) ? $_POST['frasefila_fer'] : null;
$riesgo_fer = isset($_POST['riesgo_fer']) ? $_POST['riesgo_fer'] : null;
$probabilidad_fer = isset($_POST['probabilidad_fer']) ? $_POST['probabilidad_fer'] : null;
$gravedad_fer = isset($_POST['gravedad_fer']) ? $_POST['gravedad_fer'] : null;
$nivelriesgo_fer = isset($_POST['nivelriesgo_fer']) ? $_POST['nivelriesgo_fer'] : null;
$planresponsable_fer = isset($_POST['planresponsable_fer']) ? $_POST['planresponsable_fer'] : null;
$plancoste_fer = isset($_POST['plancoste_fer']) ? $_POST['plancoste_fer'] : null;
$planaccion_fer = isset($_POST['planaccion_fer']) ? $_POST['planaccion_fer'] : null;
$planprioridad_fer = isset($_POST['planprioridad_fer']) ? $_POST['planprioridad_fer'] : null;
$planmetodo_fer = isset($_POST['planmetodo_fer']) ? $_POST['planmetodo_fer'] : null;
$planformacion_fer = isset($_POST['planformacion_fer']) ? $_POST['planformacion_fer'] : null;
$planinformacion_fer = isset($_POST['planinformacion_fer']) ? $_POST['planinformacion_fer'] : null;

// Verificar si se ha subido una nueva imagen1
if (isset($_FILES['imgriesgo_fer']) && $_FILES['imgriesgo_fer']['error'] == UPLOAD_ERR_OK) {
    $nombreDelArchivo = date("Y-m-d-h-i-s");
    $filename = $nombreDelArchivo . "__" . $_FILES['imgriesgo_fer']['name'];
    $location = "../../../admin/pruebas/image/" . $filename;
    move_uploaded_file($_FILES['imgriesgo_fer']['tmp_name'], $location);
} else {
    // Mantener la imagen1 existente si no se ha subido una nueva
    $filename = isset($_POST['imgriesgo_fer_existente']) ? $_POST['imgriesgo_fer_existente'] : null;
}

// Verificar si se ha subido una nueva imagen2
if (isset($_FILES['imgplan_fer']) && $_FILES['imgplan_fer']['error'] == UPLOAD_ERR_OK) {
    $nombreDelArchivo = date("Y-m-d-h-i-s");
    $filename2 = $nombreDelArchivo . "__" . $_FILES['imgplan_fer']['name'];
    $location2 = "../../../admin/pruebas/image/" . $filename2;
    move_uploaded_file($_FILES['imgplan_fer']['tmp_name'], $location2);
} else {
    // Mantener la imagen2 existente si no se ha subido una nueva
    $filename2 = isset($_POST['imgplan_fer_existente']) ? $_POST['imgplan_fer_existente'] : null;
}

try {
    $pdo->beginTransaction();

    $sentencia = $pdo->prepare("UPDATE er_filas SET
        puestocentro_fer = :puestocentro_fer, 
        frasefila_fer = :frasefila_fer, 
        riesgo_fer = :riesgo_fer, 
        probabilidad_fer = :probabilidad_fer, 
        gravedad_fer = :gravedad_fer, 
        nivelriesgo_fer = :nivelriesgo_fer, 
        planresponsable_fer = :planresponsable_fer, 
        plancoste_fer = :plancoste_fer, 
        planaccion_fer = :planaccion_fer, 
        planprioridad_fer = :planprioridad_fer, 
        planmetodo_fer = :planmetodo_fer, 
        planformacion_fer = :planformacion_fer, 
        planinformacion_fer = :planinformacion_fer, 
        imgriesgo_fer = :imgriesgo_fer, 
        imgplan_fer = :imgplan_fer
        WHERE id_filaeval = :id_filaeval");

    $sentencia->bindParam(':puestocentro_fer', $puestocentro_fer);
    $sentencia->bindParam(':frasefila_fer', $frasefila_fer);
    $sentencia->bindParam(':riesgo_fer', $riesgo_fer);
    $sentencia->bindParam(':probabilidad_fer', $probabilidad_fer);
    $sentencia->bindParam(':gravedad_fer', $gravedad_fer);
    $sentencia->bindParam(':nivelriesgo_fer', $nivelriesgo_fer);
    $sentencia->bindParam(':planresponsable_fer', $planresponsable_fer);
    $sentencia->bindParam(':plancoste_fer', $plancoste_fer);
    $sentencia->bindParam(':planaccion_fer', $planaccion_fer);
    $sentencia->bindParam(':planprioridad_fer', $planprioridad_fer);
    $sentencia->bindParam(':planmetodo_fer', $planmetodo_fer);
    $sentencia->bindParam(':planformacion_fer', $planformacion_fer);
    $sentencia->bindParam(':planinformacion_fer', $planinformacion_fer);
    $sentencia->bindParam(':imgriesgo_fer', $filename);
    $sentencia->bindParam(':imgplan_fer', $filename2);
    $sentencia->bindParam(':id_filaeval', $id_filaeval);

    // Ejecutar la sentencia
    $sentencia->execute();

    // Confirmar la transacción
    $pdo->commit();

    // Inicio de sesión para mensajes de éxito
    session_start();
    $_SESSION['mensaje'] = "Fila actualizada correctamente";
    $_SESSION['icono'] = 'success';
    header("Location: " . $URL . "/admin/pruebas/show_puestoarea.php?id_puestocentro=$puestocentro_fer&id_evaluacion=$id_evaluacion");
    exit();

} catch (PDOException $e) {
    $pdo->rollBack();
    session_start();
    $_SESSION['mensaje'] = "Error en la base de datos: " . $e->getMessage();
    $_SESSION['icono'] = 'warning';
    header("Location: " . $URL . "/admin/pruebas/show_puestoarea.php?id_puestocentro=$puestocentro_fer&id_evaluacion=$id_evaluacion");
    exit();

} catch (Exception $e) {
    $pdo->rollBack();
    session_start();
    $_SESSION['mensaje'] = "Error inesperado: " . $e->getMessage();
    $_SESSION['icono'] = 'warning';
    header("Location: " . $URL . "/admin/pruebas/show_puestoarea.php?id_puestocentro=$puestocentro_fer&id_evaluacion=$id_evaluacion");
    exit();
}
?>
