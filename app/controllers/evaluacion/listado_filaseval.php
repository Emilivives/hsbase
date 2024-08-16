<?php

// Consulta SQL para obtener los datos de er_filas y las medidas asociadas
$puestocentro_fer = $_GET['id_puestocentro']; // Obtener el valor de la URL o formulario

// Consulta SQL corregida
$sql_filaseval = "SELECT fer.id_filaeval, fer.puestocentro_fer, fer.frasefila_fer, fer.riesgo_fer, fer.probabilidad_fer, 
           fer.gravedad_fer, fer.nivelriesgo_fer, m.id_medida, m.codigomedida, m.frasemedida, rg.codigoriesgo, rg.fraseriesgo
    FROM er_filas as fer
    INNER JOIN er_riesgos as rg ON fer.riesgo_fer = rg.id_riesgo
    INNER JOIN er_filamedidas as fm ON fer.id_filaeval = fm.filaeval_fm
    INNER JOIN er_medidas as m ON fm.medida_fm = m.id_medida
    WHERE fer.puestocentro_fer = :puestocentro_fer
    ORDER BY rg.codigoriesgo ASC";

// Preparamos la consulta SQL
$query_filaseval = $pdo->prepare($sql_filaseval);

// Bind del parámetro
$query_filaseval->bindParam(':puestocentro_fer', $puestocentro_fer, PDO::PARAM_INT);

// Ejecutamos la consulta
$query_filaseval->execute();

// Obtenemos los resultados
$resultados = $query_filaseval->fetchAll(PDO::FETCH_ASSOC);

// Procesar los resultados en un formato adecuado
$filaseval_datos = [];
foreach ($resultados as $fila) {
    $id_filaeval = $fila['id_filaeval'];

    // Si no existe esta fila en el array, inicializamos sus datos
    if (!isset($filaseval_datos[$id_filaeval])) {
        $filaseval_datos[$id_filaeval] = [
            'id_filaeval' => $fila['id_filaeval'],
            'puestocentro_fer' => $fila['puestocentro_fer'],
            'frasefila_fer' => $fila['frasefila_fer'],
            'riesgo_fer' => $fila['riesgo_fer'],
            'probabilidad_fer' => $fila['probabilidad_fer'],
            'gravedad_fer' => $fila['gravedad_fer'],
            'nivelriesgo_fer' => $fila['nivelriesgo_fer'],
            'codigoriesgo' => $fila['codigoriesgo'],
            'fraseriesgo' => $fila['fraseriesgo'],
            'medidas' => [] // Inicializamos el array de medidas
        ];
    }

    // Agregamos cada medida al array de medidas correspondiente a la fila
    $filaseval_datos[$id_filaeval]['medidas'][] = [
        'id_medida' => $fila['id_medida'],
        'codigomedida' => $fila['codigomedida'],
        'frasemedida' => $fila['frasemedida']
    ];
}

// Ahora $filaseval_datos contendrá todas las filas evaluadas con sus respectivas medidas agrupadas