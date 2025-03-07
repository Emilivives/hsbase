<?php
// Incluir el autoloader de PhpSpreadsheet
require '../../public/vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// Incluir configuración y lista de trabajadores
include('../../app/config.php');
include('../../app/controllers/trabajadores/listado_trabajadores_alfabet.php');

// Crear una nueva hoja de cálculo
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// Título en la primera fila
$sheet->setCellValue('A1', 'RESUMEN GENERAL VACACIONES DE TRABAJADORES');

// Aplicar estilo al título
$sheet->getStyle('A1')->applyFromArray([
    'font' => [
        'bold' => true, 
        'size' => 14, // Tamaño más grande para destacar
    ],
    'alignment' => [
        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER, 
    ],
]);
$sheet->setCellValue('F1', 'Fecha: ' . date('d/m/Y', strtotime($fecha)) );

// Fusionar celdas para el título (de A1 a F1, o más si necesitas)
$sheet->mergeCells('A1:E1');

// Dejar la fila 2 en blanco
$row = 3; // Comenzar desde la fila 3 con los datos de los trabajadores

foreach ($trabajadores as $trabajador) {
    $id_trabajador = $trabajador['id_trabajador'];
    $nombre_tr = $trabajador['nombre_tr'];

    // Calcular totales
    $stmtGen = $pdo->prepare("SELECT SUM(generado) AS total_generado FROM vacacion_gen WHERE id_trabajador = :id_trabajador");
    $stmtGen->execute(['id_trabajador' => $id_trabajador]);
    $totalGenerado = $stmtGen->fetchColumn() ?: 0;

    $stmtConTotal = $pdo->prepare("SELECT SUM(consumido) AS total_consumido FROM vacacion_con WHERE id_trabajador = :id_trabajador AND descuenta = 1");
    $stmtConTotal->execute(['id_trabajador' => $id_trabajador]);
    $totalConsumido = $stmtConTotal->fetchColumn() ?: 0;

    $stmtConAnioDescuenta = $pdo->prepare("SELECT SUM(consumido) AS total_sin_descuento FROM vacacion_con WHERE id_trabajador = :id_trabajador AND descuenta = 0");
    $stmtConAnioDescuenta->execute(['id_trabajador' => $id_trabajador]);
    $totalSinDescuento = $stmtConAnioDescuenta->fetchColumn() ?: 0;

    $diasPendientes = $totalGenerado - $totalConsumido;

    // Agregar datos generales del trabajador
    $sheet->setCellValue('A' . $row, 'Trabajador: ' . $nombre_tr);

    // Aplicar estilo de fondo (por ejemplo, azul claro)
    $sheet->getStyle('A' . $row)->applyFromArray([
        'fill' => [
            'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
            'startColor' => ['rgb' => 'ADD8E6'] // Azul claro
        ],
        'font' => [
            'bold' => true, // Negrita para resaltar
        ],
        'alignment' => [
            'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT, // Centrar el texto
        ],
    ]);
    $row++;
    // Establecer valores
    $sheet->setCellValue('A' . $row, 'Total Generado');
    $sheet->setCellValue('B' . $row, 'Total Consumido');
    $sheet->setCellValue('C' . $row, 'Días Pendientes');
    $sheet->setCellValue('D' . $row, 'Días Permiso');

    // Aplicar estilo de fondo gris, negrita y centrado
    $sheet->getStyle('A' . $row . ':D' . $row)->applyFromArray([
        'fill' => [
            'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
            'startColor' => ['rgb' => 'D3D3D3'] // Gris claro
        ],
        'font' => [
            'bold' => true, // Negrita
        ],
        'alignment' => [
            'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER, // Centrado
        ],
    ]);

    // Alinear solo la columna A a la derecha
    $sheet->getStyle('A' . $row)->applyFromArray([
        'alignment' => [
            'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT, // Alinear a la derecha
        ],
    ]);
    $row++;
    $sheet->setCellValue('A' . $row, $totalGenerado);
    // Aplicar alineación a la derecha
    $sheet->getStyle('A' . $row)->applyFromArray([
        'alignment' => [
            'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT,
        ],
    ]);
    $sheet->setCellValue('B' . $row, $totalConsumido);
    $sheet->setCellValue('C' . $row, $diasPendientes);
    $sheet->setCellValue('D' . $row, $totalSinDescuento);
    $row += 2;

    // Obtener registros de vacaciones generadas
    $stmtGen = $pdo->prepare("SELECT vg.fecha_inicio, vg.fecha_fin, c.nombre_cen, vg.concepto, vg.regimen, vg.generado FROM vacacion_gen vg
    LEFT JOIN centros c ON vg.id_centro = c.id_centro
    WHERE vg.id_trabajador = :id_trabajador");
    $stmtGen->execute(['id_trabajador' => $id_trabajador]);
    $registrosGenerados = $stmtGen->fetchAll(PDO::FETCH_ASSOC);

    // Agregar encabezado de vacaciones generadas
    $sheet->setCellValue('A' . $row, 'Vacaciones Generadas');

    // Aplicar estilo de fondo gris y negrita
    $sheet->getStyle('A' . $row . ':F' . $row)->applyFromArray([
        'fill' => [
            'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
            'startColor' => ['rgb' => 'D3D3D3'] // Gris claro
        ],
        'font' => [
            'bold' => true, // Negrita
        ],
        'alignment' => [
            'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT, // Centrar el texto
        ],
    ]);

    $row++;
    // Aplicar estilos a los encabezados
    $headerStyle = [
        'font' => ['bold' => true], // Negrita
        'fill' => [
            'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
            'startColor' => ['rgb' => 'FFFF99'], // Amarillo claro
        ],
        'alignment' => ['horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER], // Centrado
    ];

    // Establecer valores y aplicar estilos
    $sheet->setCellValue('A' . $row, 'Fecha Inicio');
    $sheet->setCellValue('B' . $row, 'Fecha Fin');
    $sheet->setCellValue('C' . $row, 'Centro Tº');
    $sheet->setCellValue('D' . $row, 'Concepto');
    $sheet->setCellValue('E' . $row, 'Régimen');
    $sheet->setCellValue('F' . $row, 'Días Generados');

    $sheet->getStyle('A' . $row . ':F' . $row)->applyFromArray($headerStyle);

    // Alinear la columna "Fecha Inicio" a la derecha
    $sheet->getStyle('A' . $row)->applyFromArray([
        'alignment' => [
            'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT,
        ],
    ]);
    $row++;

    // Llenar datos de vacaciones generadas
    foreach ($registrosGenerados as $registro) {
        $sheet->setCellValue('A' . $row, date("d/m/Y", strtotime($registro['fecha_inicio'])));

        // Aplicar alineación a la derecha
        $sheet->getStyle('A' . $row)->applyFromArray([
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT,
            ],
        ]);
        $sheet->setCellValue('B' . $row, !empty($registro['fecha_fin']) ? date("d/m/Y", strtotime($registro['fecha_fin'])) : '-');
        $sheet->setCellValue('C' . $row, $registro['nombre_cen']);
        $sheet->setCellValue('D' . $row, $registro['concepto']);
        $sheet->setCellValue('E' . $row, $registro['regimen'] == 0 ? '-' : $registro['regimen']);
        $sheet->setCellValue('F' . $row, $registro['generado']);
        $row++;
    }

    $row++;

    // Obtener registros de vacaciones consumidas
    $stmtCon = $pdo->prepare("SELECT fecha_inicio, fecha_fin, consumido, descuenta, notas, comunicado FROM vacacion_con WHERE id_trabajador = :id_trabajador");
    $stmtCon->execute(['id_trabajador' => $id_trabajador]);
    $registrosConsumidos = $stmtCon->fetchAll(PDO::FETCH_ASSOC);

    // Agregar encabezado de vacaciones consumidas
    $sheet->setCellValue('A' . $row, 'Vacaciones Consumidas');
    // Aplicar estilo de fondo gris y negrita
    $sheet->getStyle('A' . $row . ':F' . $row)->applyFromArray([
        'fill' => [
            'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
            'startColor' => ['rgb' => 'D3D3D3'] // Gris claro
        ],
        'font' => [
            'bold' => true, // Negrita
        ],
        'alignment' => [
            'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT, // Centrar el texto
        ],
    ]);
    $row++;
    // Aplicar estilos a los encabezados
    $headerStyle = [
        'font' => ['bold' => true], // Negrita
        'fill' => [
            'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
            'startColor' => ['rgb' => 'FFFF99'], // Amarillo claro
        ],
        'alignment' => ['horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER], // Centrado
    ];

    // Establecer valores y aplicar estilos
    $sheet->setCellValue('A' . $row, 'Fecha Inicio');
    $sheet->setCellValue('B' . $row, 'Fecha Fin');
    $sheet->setCellValue('C' . $row, 'Días Consumidos');
    $sheet->setCellValue('D' . $row, 'Permiso OK');
    $sheet->setCellValue('E' . $row, 'Notas');
    $sheet->setCellValue('F' . $row, 'Comunicado');

    $sheet->getStyle('A' . $row . ':F' . $row)->applyFromArray($headerStyle);

    // Alinear la columna "Fecha Inicio" a la derecha
    $sheet->getStyle('A' . $row)->applyFromArray([
        'alignment' => [
            'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT,
        ],
    ]);

    $row++;

    // Llenar datos de vacaciones consumidas
    foreach ($registrosConsumidos as $registro) {
        $sheet->setCellValue('A' . $row, date("d/m/Y", strtotime($registro['fecha_inicio'])));
        // Aplicar alineación a la derecha
        $sheet->getStyle('A' . $row)->applyFromArray([
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT,
            ],
        ]);
        $sheet->setCellValue('B' . $row, !empty($registro['fecha_fin']) ? date("d/m/Y", strtotime($registro['fecha_fin'])) : '');
        $sheet->setCellValue('C' . $row, $registro['consumido']);
        $sheet->setCellValue('D' . $row, $registro['descuenta'] == 0 ? 'SI' : '-');
        $sheet->setCellValue('E' . $row, $registro['notas']);
        $sheet->setCellValue('F' . $row, $registro['comunicado']);
        $row++;
    }

    // Dejar espacio entre trabajadores
    $row += 3;
}

// Ajustar el tamaño de las columnas automáticamente
foreach (range('A', 'F') as $columnID) {
    $sheet->getColumnDimension($columnID)->setAutoSize(true);
}

// Guardar el archivo Excel
$writer = new Xlsx($spreadsheet);
$filename = 'resumen_vacaciones_completo.xlsx';

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="' . $filename . '"');
header('Cache-Control: max-age=0');

$writer->save('php://output');
exit;
