<?php
include('../../../app/config.php');

try {
    // Verifica que los datos existan en $_POST antes de asignarlos
    $original_id_evaluacion = $_GET['id_evaluacion'];

    // Obtener el registro original de er_evaluacion
    $sentencia = $pdo->prepare("SELECT * FROM er_evaluacion WHERE id_evaluacion = :id_evaluacion");
    $sentencia->bindParam(':id_evaluacion', $original_id_evaluacion);
    $sentencia->execute();
    $registro_original = $sentencia->fetch(PDO::FETCH_ASSOC);

    if ($registro_original) {
        // Insertar un nuevo registro en er_evaluacion
        $sentencia_insert = $pdo->prepare("
            INSERT INTO er_evaluacion (codigo_er, nombre_er, tipoevaluacion_er, fecha_er, centro_er, responsable_er)
            VALUES (:codigo_er, :nombre_er, :tipoevaluacion_er, :fecha_er, :centro_er, :responsable_er)
        ");

        $sentencia_insert->bindParam(':codigo_er', $registro_original['codigo_er']);
        $sentencia_insert->bindParam(':nombre_er', $registro_original['nombre_er']);
        $sentencia_insert->bindParam(':tipoevaluacion_er', $registro_original['tipoevaluacion_er']);
        $sentencia_insert->bindParam(':fecha_er', $registro_original['fecha_er']);
        $sentencia_insert->bindParam(':centro_er', $registro_original['centro_er']);
        $sentencia_insert->bindParam(':responsable_er', $registro_original['responsable_er']);

        if ($sentencia_insert->execute()) {
            $nuevo_id_evaluacion = $pdo->lastInsertId();

            // Duplicar los registros en er_puestocentro
            $sentencia_puestocentro = $pdo->prepare("SELECT * FROM er_puestocentro WHERE evaluacion_pc = :evaluacion_pc");
            $sentencia_puestocentro->bindParam(':evaluacion_pc', $original_id_evaluacion);
            $sentencia_puestocentro->execute();
            $registros_puestocentro = $sentencia_puestocentro->fetchAll(PDO::FETCH_ASSOC);

            foreach ($registros_puestocentro as $registro_pc) {
                $sentencia_insert_pc = $pdo->prepare("
                    INSERT INTO er_puestocentro (evaluacion_pc, puestoarea_pc, descripcion_pc, factoresriesgo_pc, sensible_pc, 
                    siniestralidad_pc, epis_pc, equipos_pc, prodquim_pc, metodos_pc, factorpsico_pc) 
                    VALUES (:evaluacion_pc, :puestoarea_pc, :descripcion_pc, :factoresriesgo_pc, :sensible_pc, 
                    :siniestralidad_pc, :epis_pc, :equipos_pc, :prodquim_pc, :metodos_pc, :factorpsico_pc)
                ");

                $sentencia_insert_pc->bindParam(':evaluacion_pc', $nuevo_id_evaluacion);
                $sentencia_insert_pc->bindParam(':puestoarea_pc', $registro_pc['puestoarea_pc']);
                $sentencia_insert_pc->bindParam(':descripcion_pc', $registro_pc['descripcion_pc']);
                $sentencia_insert_pc->bindParam(':factoresriesgo_pc', $registro_pc['factoresriesgo_pc']);
                $sentencia_insert_pc->bindParam(':sensible_pc', $registro_pc['sensible_pc']);
                $sentencia_insert_pc->bindParam(':siniestralidad_pc', $registro_pc['siniestralidad_pc']);
                $sentencia_insert_pc->bindParam(':epis_pc', $registro_pc['epis_pc']);
                $sentencia_insert_pc->bindParam(':equipos_pc', $registro_pc['equipos_pc']);
                $sentencia_insert_pc->bindParam(':prodquim_pc', $registro_pc['prodquim_pc']);
                $sentencia_insert_pc->bindParam(':metodos_pc', $registro_pc['metodos_pc']);
                $sentencia_insert_pc->bindParam(':factorpsico_pc', $registro_pc['factorpsico_pc']);

                if ($sentencia_insert_pc->execute()) {
                    $nuevo_id_puestocentro = $pdo->lastInsertId();

                    // Duplicar los registros en er_filas
                    $sentencia_filas = $pdo->prepare("SELECT * FROM er_filas WHERE puestocentro_fer = :puestocentro_fer");
                    $sentencia_filas->bindParam(':puestocentro_fer', $registro_pc['id_puestocentro']);
                    $sentencia_filas->execute();
                    $registros_filas = $sentencia_filas->fetchAll(PDO::FETCH_ASSOC);

                    foreach ($registros_filas as $registro_fila) {
                        $sentencia_insert_fila = $pdo->prepare("
                            INSERT INTO er_filas (puestocentro_fer, frasefila_fer, riesgo_fer, probabilidad_fer, gravedad_fer, nivelriesgo_fer, 
                            planresponsable_fer, plancoste_fer, planaccion_fer, planprioridad_fer, planmetodo_fer, planformacion_fer, planinformacion_fer, 
                            imgriesgo_fer, imgplan_fer)
                            VALUES (:puestocentro_fer, :frasefila_fer, :riesgo_fer, :probabilidad_fer, :gravedad_fer, :nivelriesgo_fer, 
                            :planresponsable_fer, :plancoste_fer, :planaccion_fer, :planprioridad_fer, :planmetodo_fer, :planformacion_fer, :planinformacion_fer, 
                            :imgriesgo_fer, :imgplan_fer)
                        ");

                        $sentencia_insert_fila->bindParam(':puestocentro_fer', $nuevo_id_puestocentro);
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

                        if ($sentencia_insert_fila->execute()) {
                            $nuevo_id_fila = $pdo->lastInsertId();

                            // Duplicar los registros en er_filamedidas
                            $sentencia_medidas = $pdo->prepare("SELECT * FROM er_filamedidas WHERE filaeval_fm = :filaeval_fm");
                            $sentencia_medidas->bindParam(':filaeval_fm', $registro_fila['id_filaeval']);
                            $sentencia_medidas->execute();
                            $registros_medidas = $sentencia_medidas->fetchAll(PDO::FETCH_ASSOC);

                            foreach ($registros_medidas as $registro_medida) {
                                $sentencia_insert_medida = $pdo->prepare("
                                    INSERT INTO er_filamedidas (filaeval_fm, medida_fm)
                                    VALUES (:filaeval_fm, :medida_fm)
                                ");
                                $sentencia_insert_medida->bindParam(':filaeval_fm', $nuevo_id_fila);
                                $sentencia_insert_medida->bindParam(':medida_fm', $registro_medida['medida_fm']);
                                $sentencia_insert_medida->execute();
                            }
                        }
                    }
                }
            }

            // Mensaje de éxito
            session_start();
            $_SESSION['mensaje'] = "Duplicación completada exitosamente";
            $_SESSION['icono'] = 'success';
            header("Location: " . $URL . "/admin/evaluacion/show_evaluacion.php?id_evaluacion=$nuevo_id_evaluacion");
            exit();
        }
    } else {
        throw new Exception("No se encontró el registro original.");
    }
} catch (PDOException $e) {
    $pdo->rollBack();
    session_start();
    $_SESSION['mensaje'] = "Error en la base de datos: " . $e->getMessage();
    $_SESSION['icono'] = 'warning';
    header("Location: " . $URL . "/admin/evaluacion/show_evaluacion.php?id_evaluacion=$original_id_evaluacion");
    exit();
} catch (Exception $e) {
    $pdo->rollBack();
    session_start();
    $_SESSION['mensaje'] = "Error inesperado: " . $e->getMessage();
    $_SESSION['icono'] = 'warning';
    header("Location: " . $URL . "/admin/evaluacion/show_evaluacion.php?id_evaluacion=$original_id_evaluacion");
    exit();
}
?>
