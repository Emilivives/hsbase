<?php
include('../../../app/config.php');

try {
    // Verifica que los datos existan en $_POST antes de asignarlos
    $id_puestocentro = isset($_GET['id_puestocentro']) ? $_GET['id_puestocentro'] : null;

    // Obtener el registro original de er_puestocentro
    $sentencia_puestocentro = $pdo->prepare("SELECT * FROM er_puestocentro WHERE id_puestocentro = :id_puestocentro");
    $sentencia_puestocentro->bindParam(':id_puestocentro', $id_puestocentro);
    $sentencia_puestocentro->execute();
    $registro_original_puestocentro = $sentencia_puestocentro->fetch(PDO::FETCH_ASSOC);

    if ($registro_original_puestocentro) {
        // Insertar un nuevo registro en er_puestocentro
        $sentencia_insert_puestocentro = $pdo->prepare("
            INSERT INTO er_puestocentro (evaluacion_pc, puestoarea_pc, descripcion_pc, factoresriesgo_pc, sensible_pc, siniestralidad_pc, 
            epis_pc, equipos_pc, prodquim_pc, metodos_pc, factorpsico_pc) 
            VALUES(:evaluacion_pc, :puestoarea_pc, :descripcion_pc, :factoresriesgo_pc, :sensible_pc, :siniestralidad_pc, :epis_pc, 
            :equipos_pc, :prodquim_pc, :metodos_pc, :factorpsico_pc)
        ");

        // Usar los valores del registro original para duplicar
        $sentencia_insert_puestocentro->bindParam(':evaluacion_pc', $registro_original_puestocentro['evaluacion_pc']);
        $sentencia_insert_puestocentro->bindParam(':puestoarea_pc', $registro_original_puestocentro['puestoarea_pc']);
        $sentencia_insert_puestocentro->bindParam(':descripcion_pc', $registro_original_puestocentro['descripcion_pc']);
        $sentencia_insert_puestocentro->bindParam(':factoresriesgo_pc', $registro_original_puestocentro['factoresriesgo_pc']);
        $sentencia_insert_puestocentro->bindParam(':sensible_pc', $registro_original_puestocentro['sensible_pc']);
        $sentencia_insert_puestocentro->bindParam(':siniestralidad_pc', $registro_original_puestocentro['siniestralidad_pc']);
        $sentencia_insert_puestocentro->bindParam(':epis_pc', $registro_original_puestocentro['epis_pc']);
        $sentencia_insert_puestocentro->bindParam(':equipos_pc', $registro_original_puestocentro['equipos_pc']);
        $sentencia_insert_puestocentro->bindParam(':prodquim_pc', $registro_original_puestocentro['prodquim_pc']);
        $sentencia_insert_puestocentro->bindParam(':metodos_pc', $registro_original_puestocentro['metodos_pc']);
        $sentencia_insert_puestocentro->bindParam(':factorpsico_pc', $registro_original_puestocentro['factorpsico_pc']);

        // Ejecutar la inserción en er_puestocentro
        if ($sentencia_insert_puestocentro->execute()) {
            // Obtener el ID del nuevo registro duplicado en er_puestocentro
            $nuevo_id_puestocentro = $pdo->lastInsertId();

            // Duplicar los registros relacionados en er_filas
            $sentencia_filas = $pdo->prepare("SELECT * FROM er_filas WHERE puestocentro_fer = :puestocentro_fer");
            $sentencia_filas->bindParam(':puestocentro_fer', $id_puestocentro);
            $sentencia_filas->execute();
            $registros_filas = $sentencia_filas->fetchAll(PDO::FETCH_ASSOC);

            foreach ($registros_filas as $registro_fila) {
                // Preparar la inserción de los registros duplicados en er_filas
                $sentencia_insert_fila = $pdo->prepare("
                    INSERT INTO er_filas (puestocentro_fer, frasefila_fer, riesgo_fer, probabilidad_fer, gravedad_fer, nivelriesgo_fer, 
                    planresponsable_fer, plancoste_fer, planaccion_fer, planprioridad_fer, planmetodo_fer, planformacion_fer, 
                    planinformacion_fer, imgriesgo_fer, imgplan_fer) 
                    VALUES(:puestocentro_fer, :frasefila_fer, :riesgo_fer, :probabilidad_fer, :gravedad_fer, :nivelriesgo_fer, 
                    :planresponsable_fer, :plancoste_fer, :planaccion_fer, :planprioridad_fer, :planmetodo_fer, :planformacion_fer, 
                    :planinformacion_fer, :imgriesgo_fer, :imgplan_fer)
                ");

                // Insertar los valores del registro original en la nueva fila
                $sentencia_insert_fila->bindParam(':puestocentro_fer', $nuevo_id_puestocentro); // Nueva id_puestocentro
                $sentencia_insert_fila->bindParam(':frasefila_fer', $registro_fila['frasefila_fer']);
                $sentencia_insert_fila->bindParam(':riesgo_fer', $registro_fila['riesgo_fer']);
                $sentencia_insert_fila->bindParam(':probabilidad_fer', $registro_fila['probabilidad_fer']);
                $sentencia_insert_fila->bindParam(':gravedad_fer', $registro_fila['gravedad_fer']);
                $sentencia_insert_fila->bindParam(':nivelriesgo_fer', $registro_fila['nivelriesgo_fer']);
                $sentencia_insert_fila->bindParam(':planresponsable_fer', $registro_fila['planresponsable_fer']);
                $sentencia_insert_fila->bindParam(':plancoste_fer', $registro_fila['plancoste_fer']);
                $sentencia_insert_fila->bindParam(':planaccion_fer', $registro_fila['planaccion_fer']);
                $sentencia_insert_fila->bindParam(':planprioridad_fer', $registro_fila['planprioridad_fer']);
                $sentencia_insert_fila->bindParam(':planmetodo_fer', $registro_fila['planmetodo_fer']);
                $sentencia_insert_fila->bindParam(':planformacion_fer', $registro_fila['planformacion_fer']);
                $sentencia_insert_fila->bindParam(':planinformacion_fer', $registro_fila['planinformacion_fer']);
                $sentencia_insert_fila->bindParam(':imgriesgo_fer', $registro_fila['imgriesgo_fer']);
                $sentencia_insert_fila->bindParam(':imgplan_fer', $registro_fila['imgplan_fer']);

                // Ejecutar la inserción en er_filas
                $sentencia_insert_fila->execute();

                // Obtener el ID de la nueva fila
                $nuevo_id_fila = $pdo->lastInsertId();

                // Duplicar las medidas asociadas a la fila
                $sentencia_medidas = $pdo->prepare("SELECT * FROM er_filamedidas WHERE filaeval_fm = :filaeval_fm");
                $sentencia_medidas->bindParam(':filaeval_fm', $registro_fila['id_filaeval']);
                $sentencia_medidas->execute();
                $registros_medidas = $sentencia_medidas->fetchAll(PDO::FETCH_ASSOC);

                $sentencia_insert_medida = $pdo->prepare("INSERT INTO er_filamedidas (filaeval_fm, medida_fm) VALUES (:filaeval_fm, :medida_fm)");

                foreach ($registros_medidas as $registro_medida) {
                    $sentencia_insert_medida->bindParam(':filaeval_fm', $nuevo_id_fila); // Nueva fila
                    $sentencia_insert_medida->bindParam(':medida_fm', $registro_medida['medida_fm']);
                    $sentencia_insert_medida->execute();
                }
            }

            // Redirigir con éxito
            session_start();
            $_SESSION['mensaje'] = "Puesto/centro y filas duplicados correctamente";
            $_SESSION['icono'] = 'success';
            header('Location: ' . $URL . "/admin/evaluacion/show_puestoarea.php?id_puestocentro=$nuevo_id_puestocentro&id_evaluacion=" . $registro_original_puestocentro['evaluacion_pc']);
        } else {
            throw new PDOException("Error al insertar en er_puestocentro");
        }
    } else {
        session_start();
        $_SESSION['mensaje'] = "El registro original no existe";
        $_SESSION['icono'] = 'warning';
        header('Location: ' . $URL . '/admin/evaluacion/index.php');
    }
} catch (PDOException $e) {
    $pdo->rollBack();
    session_start();
    $_SESSION['mensaje'] = "Error en la base de datos: " . $e->getMessage();
    $_SESSION['icono'] = 'warning';
    header('Location: ' . $URL . '/admin/evaluacion/index.php');
    exit();
} catch (Exception $e) {
    $pdo->rollBack();
    session_start();
    $_SESSION['mensaje'] = "Error inesperado: " . $e->getMessage();
    $_SESSION['icono'] = 'warning';
    header('Location: ' . $URL . '/admin/evaluacion/index.php');
    exit();
}
?>
