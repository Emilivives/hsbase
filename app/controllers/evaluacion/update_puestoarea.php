<?php
include('../../../app/config.php');
try {


    // Asumiendo que recibes el ID del registro a actualizar y los nuevos valores a través de un formulario
    $id_puestocentro = $_POST['id_puestocentro']; // ID del registro a actualizar
    $evaluacion_pc = $_POST['evaluacion_pc'];
    $puestoarea_pc = $_POST['puestoarea_pc'];
    $descripcion_pc = $_POST['descripcion_pc'];
    $factoresriesgo_pc = $_POST['factoresriesgo_pc'];
    $sensible_pc = $_POST['sensible_pc'];
    $siniestralidad_pc = $_POST['siniestralidad_pc'];
    $epis_pc = isset($_POST['epis_pc']) ? $_POST['epis_pc'] : [];  // Array de medidas
    $equipos_pc = $_POST['equipos_pc'];
    $prodquim_pc = $_POST['prodquim_pc'];
    $metodos_pc = isset($_POST['metodos_pc']) ? $_POST['metodos_pc'] : [];  // Array de medidas
    $factorpsico_pc = isset($_POST['factorpsico_pc']) ? $_POST['factorpsico_pc'] : [];  // Array de medidas

    $epis_pc_str = implode(',', $epis_pc); // Convertir el array a una cadena separada por comas
    $metodos_pc_str = implode(',', $metodos_pc); // Convertir el array a una cadena separada por comas
    $factorpsico_pc_str = implode(',', $factorpsico_pc); // Convertir el array a una cadena separada por comas

    // Preparar la sentencia SQL para actualizar el registro
    $sentencia = $pdo->prepare("UPDATE er_puestocentro 
        SET evaluacion_pc = :evaluacion_pc,
            puestoarea_pc = :puestoarea_pc,
            descripcion_pc = :descripcion_pc,
            factoresriesgo_pc = :factoresriesgo_pc,
            sensible_pc = :sensible_pc,
            siniestralidad_pc = :siniestralidad_pc,
            epis_pc = :epis_pc,
            equipos_pc = :equipos_pc,
            prodquim_pc = :prodquim_pc,
            metodos_pc = :metodos_pc,
            factorpsico_pc = :factorpsico_pc
        WHERE id_puestocentro = :id_puestocentro");

    // Vincular los parámetros
    $sentencia->bindParam('evaluacion_pc', $evaluacion_pc);
    $sentencia->bindParam('puestoarea_pc', $puestoarea_pc);
    $sentencia->bindParam('descripcion_pc', $descripcion_pc);
    $sentencia->bindParam('factoresriesgo_pc', $factoresriesgo_pc);
    $sentencia->bindParam('sensible_pc', $sensible_pc);
    $sentencia->bindParam('siniestralidad_pc', $siniestralidad_pc);
    $sentencia->bindParam('epis_pc', $epis_pc_str);
    $sentencia->bindParam('equipos_pc', $equipos_pc);
    $sentencia->bindParam('prodquim_pc', $prodquim_pc);
    $sentencia->bindParam('metodos_pc', $metodos_pc_str);
    $sentencia->bindParam('factorpsico_pc', $factorpsico_pc_str);
    $sentencia->bindParam('id_puestocentro', $id_puestocentro); // Vincular el ID

    // Ejecutar la sentencia
    if ($sentencia->execute()) {
        session_start();
        $_SESSION['mensaje'] = "Puesto/area actualizado correctamente";
        $_SESSION['icono'] = 'success';
       header('Location: ' . $URL . "/admin/pruebas/show_puestoarea.php?id_puestocentro=$id_puestocentro&id_evaluacion=$evaluacion_pc");
    } else {
        session_start();
        $_SESSION['mensaje'] = "Evaluación NO actualizada";
        $_SESSION['icono'] = 'warning';
       header('Location: ' . $URL . "/admin/pruebas/show_puestoarea.php?id_puestocentro=$id_puestocentro&id_evaluacion=$evaluacion_pc");
    }
} catch (PDOException $e) {
    // Manejo de errores
    session_start();
    $_SESSION['mensaje'] = "Error en la base de datos: " . $e->getMessage();
    $_SESSION['icono'] = 'danger';
    header('Location: ' . $URL . "/admin/pruebas/show_er.php?id_evaluacion=$evaluacion_pc");
}
?>
