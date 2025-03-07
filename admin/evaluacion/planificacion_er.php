<?php

require '../../public/vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

include('../../app/config.php');

// Obtener el valor de la URL o formulario
$id_puestocentro = $_GET['id_puestocentro'];

// Consulta SQL para obtener los datos de er_filas y las medidas asociadas
$sql_filaseval = "SELECT fer.id_filaeval, fer.puestocentro_fer, fer.frasefila_fer, fer.riesgo_fer, fer.probabilidad_fer, 
           fer.gravedad_fer, fer.nivelriesgo_fer, fer.imgriesgo_fer, fer.planresponsable_fer, fer.plancoste_fer, 
           fer.planaccion_fer, fer.planmetodo_fer, fer.planformacion_fer, fer.planinformacion_fer, 
           fer.imgplan_fer, m.id_medida, m.codigomedida, m.frasemedida, rg.codigoriesgo, rg.fraseriesgo
    FROM er_filas as fer
    INNER JOIN er_riesgos as rg ON fer.riesgo_fer = rg.id_riesgo
    INNER JOIN er_filamedidas as fm ON fer.id_filaeval = fm.filaeval_fm
    INNER JOIN er_medidas as m ON fm.medida_fm = m.id_medida
    WHERE fer.puestocentro_fer = :puestocentro_fer
    ORDER BY rg.codigoriesgo ASC";

// Preparar la consulta SQL
$query_filaseval = $pdo->prepare($sql_filaseval);
$query_filaseval->bindParam(':puestocentro_fer', $id_puestocentro, PDO::PARAM_INT);
$query_filaseval->execute();
$resultados = $query_filaseval->fetchAll(PDO::FETCH_ASSOC);

// Procesar los resultados en un formato adecuado
$filaseval_datos = [];
foreach ($resultados as $fila) {
    $id_filaeval = $fila['id_filaeval'];

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
            'imgriesgo_fer' => $fila['imgriesgo_fer'],
            'planresponsable_fer' => $fila['planresponsable_fer'],
            'plancoste_fer' => $fila['plancoste_fer'],
            'planaccion_fer' => $fila['planaccion_fer'],
            'planmetodo_fer' => $fila['planmetodo_fer'],
            'planformacion_fer' => $fila['planformacion_fer'],
            'planinformacion_fer' => $fila['planinformacion_fer'],
            'imgplan_fer' => $fila['imgplan_fer'],
            'medidas' => []
        ];
    }

    $filaseval_datos[$id_filaeval]['medidas'][] = [
        'id_medida' => $fila['id_medida'],
        'codigomedida' => $fila['codigomedida'],
        'frasemedida' => $fila['frasemedida']
    ];
}

// Consulta SQL para obtener los datos del encabezado
$sql = "SELECT *, er.fecha_er as fecha_er, er.tipoevaluacion_er as tipoevaluacion_er
FROM `er_puestocentro` as pc 
INNER JOIN er_evaluacion as er ON pc.evaluacion_pc = er.id_evaluacion
INNER JOIN centros as cen ON er.centro_er = cen.id_centro
INNER JOIN empresa as emp ON cen.empresa_cen = emp.id_empresa
INNER JOIN responsables as res ON er.responsable_er = res.id_responsable 
WHERE id_puestocentro = :id_puestocentro";

$query = $pdo->prepare($sql);
$query->bindParam(':id_puestocentro', $id_puestocentro, PDO::PARAM_INT);
$query->execute();
$puestoarea_datos = $query->fetchAll(PDO::FETCH_ASSOC);

// Obtener la fecha y tipo de evaluación
foreach ($puestoarea_datos as $puestoarea_dato) {
    $evaluacion_pc = $puestoarea_dato['evaluacion_pc'];
    $puestoarea_pc = $puestoarea_dato['puestoarea_pc'];
    $tipoevaluacion_er = $puestoarea_dato['tipoevaluacion_er'];
    $fecha_er = $puestoarea_dato['fecha_er'];
    $nombre_emp = $puestoarea_dato['razonsocial_emp'];
}

$fecha_formateada = date("d/m/Y", strtotime($fecha_er));

// Crear un nuevo archivo Excel
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
$sheet->setTitle('Evaluación de Riesgos');

// Configurar la orientación de la página a horizontal
$sheet->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);

// Ajustar márgenes laterales
$sheet->getPageMargins()->setLeft(0.5);
$sheet->getPageMargins()->setRight(0.5);

// Definir el color azul marino
$colorAzulMarino = '000080';

// Agregar encabezado de página con estilo
$sheet->getHeaderFooter()->setOddHeader('&8&L&B&K' . $colorAzulMarino . $tipoevaluacion_er . 
    '&8&C&B&K' . $colorAzulMarino . "PLANIFICACION DE LA ACTIVIDAD PREVENTIVA" . 
    '&8&R&B&K' . $colorAzulMarino . "Fecha:" . $fecha_formateada);

// Agregar pie de página con estilo
$sheet->getHeaderFooter()->setOddFooter('&8&C&B&K' . $colorAzulMarino . $nombre_emp);

// Configuración de las columnas para la evaluación de riesgos
$sheet->setCellValue('A1', 'No.')
      ->setCellValue('B1', 'Puesto')
      ->setCellValue('C1', 'Medidas')
      ->setCellValue('D1', 'Nivel Riesgo')
      ->setCellValue('E1', 'Prioridad')
      ->setCellValue('F1', 'Responsable')
      ->setCellValue('G1', 'Fecha inicio')
      ->setCellValue('H1', 'Fecha Fin')
      ->setCellValue('I1', 'Coste')
      ->setCellValue('J1', 'Estado')
      ->setCellValue('K1', 'Observaciones');

// Estilo para el encabezado de evaluación
$sheet->getStyle('A1:K1')->getFont()->setBold(true);
$sheet->getStyle('A1:K1')->getFont()->setSize(8);

// Ampliar el ancho de las columnas
$sheet->getColumnDimension('A')->setWidth(4);
$sheet->getColumnDimension('B')->setWidth(10);
$sheet->getColumnDimension('C')->setWidth(45);
$sheet->getColumnDimension('D')->setWidth(10);
$sheet->getColumnDimension('E')->setWidth(8);
$sheet->getColumnDimension('F')->setWidth(9);
$sheet->getColumnDimension('G')->setWidth(7);
$sheet->getColumnDimension('H')->setWidth(7);
$sheet->getColumnDimension('I')->setWidth(4);
$sheet->getColumnDimension('J')->setWidth(8);
$sheet->getColumnDimension('K')->setWidth(15);

// Agregar los datos a la hoja de cálculo
$row = 2;
$contador = 1;
foreach ($filaseval_datos as $index => $filaseval_dato) {
    $sheet->setCellValue('A' . $row, $contador);
    $sheet->setCellValue('B' . $row, $puestoarea_pc);
    $sheet->setCellValue('D' . $row, $filaseval_dato['nivelriesgo_fer']);
    $sheet->setCellValue('E' . $row, $filaseval_dato['planaccion_fer']);
    $sheet->setCellValue('F' . $row, $filaseval_dato['planresponsable_fer']);
    // Agregar las medidas en la columna C
    $medidas_texto = '';
    foreach ($filaseval_dato['medidas'] as $medida) {
        $medidas_texto .= $medida['frasemedida'] . "\n";
    }
    $sheet->setCellValue('C' . $row, $medidas_texto);

    $row++;
    $contador++; // Incrementar el contador
}

// Aplicar ajuste de texto a todas las celdas
for ($i = 2; $i < $row; $i++) {
    for ($col = 'A'; $col <= 'K'; $col++) {
        $sheet->getStyle($col . $i)->getAlignment()->setWrapText(true);
    }
}

// Aplicar el tamaño de fuente 7 a todas las celdas de datos
$sheet->getStyle('A2:K' . ($row - 1))->getFont()->setSize(7);

// Alinear el contenido de las celdas
$sheet->getStyle('A1:K' . ($row - 1))->getAlignment()
    ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_TOP)
    ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);

// Salida del archivo Excel
$writer = new Xlsx($spreadsheet);
$filename = 'evaluacion_riesgos.xlsx';

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="' . $filename . '"');
header('Cache-Control: max-age=0');

$writer->save('php://output');
exit;