<?php

include('../../../app/config.php');

// Verifica que los datos existan en $_POST antes de asignarlos
$id_evaluacion = isset($_POST['id_evaluacion']) ? $_POST['id_evaluacion'] : null;
$puestocentro_fer = isset($_POST['puestocentro_fer']) ? $_POST['puestocentro_fer'] : null;
$frasefila_fer = isset($_POST['frasefila_fer']) ? $_POST['frasefila_fer'] : null;
$riesgo_fer = isset($_POST['riesgo_fer']) ? $_POST['riesgo_fer'] : null;
$probabilidad_fer = isset($_POST['probabilidad_fer']) ? $_POST['probabilidad_fer'] : null;
$gravedad_fer = isset($_POST['gravedad_fer']) ? $_POST['gravedad_fer'] : null;
$nivelriesgo_fer = isset($_POST['nivelriesgo_fer']) ? $_POST['nivelriesgo_fer'] : null;
$medida_fm = isset($_POST['medida_fm']) ? $_POST['medida_fm'] : [];  // Array de medidas

// Comenzamos una transacción para asegurarnos de que ambas inserciones se realicen correctamente
$pdo->beginTransaction();

try {
    // Realiza el INSERT a la base de datos en la tabla er_filas
    $sentencia = $pdo->prepare("INSERT INTO er_filas (puestocentro_fer, frasefila_fer, riesgo_fer, probabilidad_fer, gravedad_fer, nivelriesgo_fer) 
    VALUES(:puestocentro_fer, :frasefila_fer, :riesgo_fer, :probabilidad_fer, :gravedad_fer, :nivelriesgo_fer)");

    $sentencia->bindParam('puestocentro_fer', $puestocentro_fer);
    $sentencia->bindParam('frasefila_fer', $frasefila_fer);
    $sentencia->bindParam('riesgo_fer', $riesgo_fer);
    $sentencia->bindParam('probabilidad_fer', $probabilidad_fer);
    $sentencia->bindParam('gravedad_fer', $gravedad_fer);
    $sentencia->bindParam('nivelriesgo_fer', $nivelriesgo_fer);

    if ($sentencia->execute()) {
        // Obtener el último id insertado en er_filas
        $ultimotr = $pdo->lastInsertId();

        // Ahora insertar los datos en la tabla er_filamedidas
        $sentencia_medida = $pdo->prepare("INSERT INTO er_filamedidas (filaeval_fm, medida_fm) VALUES(:filaeval_fm, :medida_fm)");
        
        // Recorrer el array de medidas y hacer un insert por cada medida seleccionada
        foreach ($medida_fm as $medida) {
            $sentencia_medida->bindParam('filaeval_fm', $ultimotr);
            $sentencia_medida->bindParam('medida_fm', $medida);
            $sentencia_medida->execute();
        }

        // Si todo va bien, confirmamos la transacción
        $pdo->commit();

        // Mensaje de éxito
        session_start();
        $_SESSION['mensaje'] = "Puesto/area registrado correctamente";
        $_SESSION['icono'] = 'success';
        header('Location: ' . $URL . "/admin/pruebas/show_puestoarea.php?id_puestocentro=$puestocentro_fer& id_evaluacion=$id_evaluacion");
    } else {
        throw new Exception("Error al insertar en er_filas");
    }
} catch (Exception $e) {
    // En caso de error, revertimos la transacción
    $pdo->rollBack();
    session_start();
    $_SESSION['mensaje'] = "Evaluación NO registrada: " . $e->getMessage();
    $_SESSION['icono'] = 'warning';
    header('Location: ' . $URL . "/admin/pruebas/show_er.php?id_evaluacion=$puestocentro_fer");
}
?>