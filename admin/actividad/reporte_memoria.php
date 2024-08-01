<?php
// Include the main TCPDF library (search for installation path).
require_once('../../public/TCPDF/tcpdf.php');
include('../../app/config.php');

$id_proyecto = $_GET['id_proyecto'];

// Incluir controladores necesarios
include('../../app/controllers/actividad/datos_proyecto.php');
include('../../app/controllers/actividad/listado_tareas.php');
include('../../app/controllers/actividad/tareas_proyecto.php');
include('../../app/controllers/maestros/centros/listado_centros.php');
include('../../app/controllers/maestros/responsables/listado_responsables.php');
include('../../app/controllers/actividad/listado_accionprl.php');
include('../../app/controllers/actividad/listado_actividades.php');

// Crear un nuevo documento PDF
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// Configuración del documento
$PDF_HEADER_TITLE = 'SERVICIOS Y CONCESIONES MARITIMAS IBICENCAS S.A.';
$PDF_HEADER_STRING ='C/ Aragón 71 - 07800 Ibiza';
$PDF_HEADER_LOGO = 'LOGO TRASMAPI.jpg';

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('HS BASE');
$pdf->SetTitle('Memoria del Proyecto');
$pdf->SetSubject('HSBASE');
$pdf->SetKeywords('TCPDF, PDF, reporte, proyecto');

// set default header data
$pdf->SetHeaderData($PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, $PDF_HEADER_TITLE, $PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// set font
$pdf->SetFont('helvetica', '', 9);

// Crear contenido HTML
$html = '<h1 style="text-align: center">Memoria del Proyecto</h1>';

// Datos del proyecto
foreach ($proyectos as $proyecto) {
    $html .= '<h2>Datos del Proyecto</h2>';
    $html .= '<table border="1" cellpadding="4">
                <tr>
                    <td><b>Nombre del Proyecto:</b></td><td>'.$proyecto['nombre_py'].'</td>
                </tr>
                <tr>
                    <td><b>Responsable:</b></td><td>'.$proyecto['nombre_resp'].'</td>
                </tr>
                <tr>
                    <td><b>Descripción:</b></td><td>'.$proyecto['descripcion_py'].'</td>
                </tr>
                <tr>
                    <td><b>Estado:</b></td><td>'.$proyecto['estado_py'].'</td>
                </tr>
                <tr>
                    <td><b>Fecha de Inicio:</b></td><td>'.$proyecto['fechainicio_py'].'</td>
                </tr>
                <tr>
                    <td><b>Fecha de Fin:</b></td><td>'.$proyecto['fechafin_py'].'</td>
                </tr>
              </table><br>';
}

// Datos de las tareas del proyecto
$html .= '<h2>Tareas del Proyecto</h2>';

foreach ($tareas as $tarea) {
    // Define el id_tarea para usarlo en el archivo datos_tarea.php
    $id_tarea = $tarea['id_tarea'];
    
    // Incluir datos de la tarea
    include('../../app/controllers/actividad/datos_tarea.php');

    $html .= '<table border="1" cellpadding="4">
                <tr>
                    <td><b>Nombre de la Tarea:</b></td><td>'.$tarea['nombre_ta'].'</td>
                </tr>
                <tr>
                    <td><b>Fecha:</b></td><td>'.$tarea['fecha_ta'].'</td>
                </tr>
                <tr>
                    <td><b>Fecha Real:</b></td><td>'.$tarea['fechareal_ta'].'</td>
                </tr>
                <tr>
                    <td><b>Centro:</b></td><td>'.$tarea['nombre_cen'].'</td>
                </tr>
                <tr>
                    <td><b>Responsable:</b></td><td>'.$tarea['nombre_resp'].'</td>
                </tr>
                <tr>
                    <td><b>Prioridad:</b></td><td>'.$tarea['prioridad_ta'].'</td>
                </tr>
                <tr>
                    <td><b>Estado:</b></td><td>'.$tarea['estado_ta'].'</td>
                </tr>
                <tr>
                    <td><b>Programada:</b></td><td>'.$tarea['programada_ta'].'</td>
                </tr>
                <tr>
                    <td><b>Detalles:</b></td><td>'.$tarea['detalles_ta'].'</td>
                </tr>
                <tr>
                    <td><b>Categoría:</b></td><td>'.$tarea['categoria_ta'].'</td>
                </tr>
                <tr>
                    <td><b>Acción PRL:</b></td><td>'.$tarea['codigo_acc'].'</td>
                </tr>
              </table><br>';

    // Define el id_tarea para usarlo en el archivo listado_actividades.php
    include('../../app/controllers/actividad/listado_actividades.php');

    // Datos de las actividades de cada tarea
    $html .= '<h3>Actividades de la Tarea</h3>';
    $html .= '<table border="1" cellpadding="4">
                <thead>
                    <tr>
                        <th>Nombre de la Actividad</th>
                        <th>Descripción</th>
                        <th>Fecha</th>
                    </tr>
                </thead>
                <tbody>';

    foreach ($actividades as $actividad) {
        if ($actividad['id_tarea'] == $tarea['id_tarea']) {
            $html .= '<tr>
                        <td>'.$actividad['nombre_ac'].'</td>
                        <td>'.$actividad['descripcion_ac'].'</td>
                        <td>'.$actividad['fecha_ac'].'</td>
                      </tr>';
        }
    }

    $html .= '</tbody></table><br>';
}

$pdf->AddPage();

// Output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');

//Close and output PDF document
$pdf->Output('reporte_memoria.pdf', 'I');
?>
