<?php
// Incluir el archivo de conexión a la base de datos
include '../../config/database.php';

// Obtener el ID de la fila de riesgo desde la solicitud POST
$id_filariesgo = isset($_POST['id_filariesgo']) ? $_POST['id_filariesgo'] : null;

// Inicializar respuesta
$response = array();

if ($id_filariesgo) {


    // Obtener datos de la tabla er_filas
    $sql_filas = "SELECT * FROM er_filas WHERE id_filariesgo = ?";
    $stmt_filas = $conn->prepare($sql_filas);
    $stmt_filas->bind_param('i', $id_filariesgo);
    $stmt_filas->execute();
    $result_filas = $stmt_filas->get_result();
    $fila = $result_filas->fetch_assoc();

    if ($fila) {
        $response['frasefila_fer'] = $fila['frasefila_fer'];
        $response['probabilidad_fer'] = $fila['probabilidad_fer'];
        $response['gravedad_fer'] = $fila['gravedad_fer'];
        $response['nivelriesgo_fer'] = $fila['nivelriesgo_fer'];
        $response['planresponsable_fer'] = $fila['planresponsable_fer'];
        $response['plancoste_fer'] = $fila['plancoste_fer'];
        $response['planaccion_fer'] = $fila['planaccion_fer'];
        $response['planprioridad_fer'] = $fila['planprioridad_fer'];
        $response['planmetodo_fer'] = $fila['planmetodo_fer'];
        $response['planformacion_fer'] = $fila['planformacion_fer'];
        $response['planinformacion_fer'] = $fila['planinformacion_fer'];
        
        // Obtener datos de la tabla er_eval (para puestocentro_fer)
        $id_evaluacion = $fila['id_evaluacion'];
        $sql_eval = "SELECT id_puestocentro FROM er_eval WHERE id_evaluacion = ?";
        $stmt_eval = $conn->prepare($sql_eval);
        $stmt_eval->bind_param('i', $id_evaluacion);
        $stmt_eval->execute();
        $result_eval = $stmt_eval->get_result();
        $eval = $result_eval->fetch_assoc();
        $response['puestocentro_fer'] = $eval ? $eval['id_puestocentro'] : null;

        // Obtener datos de la tabla er_riesgo (para riesgo_fer)
        $id_riesgo = $fila['riesgo_fer'];
        $sql_riesgo = "SELECT codigoriesgo FROM er_riesgo WHERE id_riesgo = ?";
        $stmt_riesgo = $conn->prepare($sql_riesgo);
        $stmt_riesgo->bind_param('i', $id_riesgo);
        $stmt_riesgo->execute();
        $result_riesgo = $stmt_riesgo->get_result();
        $riesgo = $result_riesgo->fetch_assoc();
        $response['riesgo_fer'] = $riesgo ? $riesgo['codigoriesgo'] : null;

        // Obtener datos de la tabla er_filamedidas (para medidas)
        $sql_medidas = "
            SELECT m.id_medida, m.codigomedida, m.frasemedida
            FROM er_filamedidas fm
            JOIN er_medidas m ON fm.id_medida = m.id_medida
            WHERE fm.fila_eval_id = ?";
        $stmt_medidas = $conn->prepare($sql_medidas);
        $stmt_medidas->bind_param('i', $id_filariesgo);
        $stmt_medidas->execute();
        $result_medidas = $stmt_medidas->get_result();
        $medidas = array();
        while ($row = $result_medidas->fetch_assoc()) {
            $medidas[] = array(
                'id_medida' => $row['id_medida'],
                'codigomedida' => $row['codigomedida'],
                'frasemedida' => $row['frasemedida']
            );
        }
        $response['medida_fm'] = $medidas;
    } else {
        $response['error'] = 'Fila de riesgo no encontrada';
    }

    // Cerrar conexión
    $conn->close();
} else {
    $response['error'] = 'ID de fila de riesgo no proporcionado';
}

// Enviar respuesta en formato JSON
header('Content-Type: application/json');
echo json_encode($response);
?>
