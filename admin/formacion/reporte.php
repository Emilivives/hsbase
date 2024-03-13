<?php
//============================================================+
// File name   : example_001.php
// Begin       : 2008-03-04
// Last Update : 2013-05-14
//
// Description : Example 001 for TCPDF class
//               Default Header and Footer
//
// Author: Nicola Asuni
//
// (c) Copyright:
//               Nicola Asuni
//               Tecnick.com LTD
//               www.tecnick.com
//               info@tecnick.com
//============================================================+

/**
 * Creates an example PDF TEST document using TCPDF
 * @package com.tecnick.tcpdf
 * @abstract TCPDF - Example: Default Header and Footer
 * @author Nicola Asuni
 * @since 2008-03-04
 * @group header
 * @group footer
 * @group page
 * @group pdf
 */

// Include the main TCPDF library (search for installation path).
require_once('../../public/TCPDF/tcpdf.php');
$id_formacion_get = $_GET['id_formacion'];
include('../../app/config.php');
include('../../app/controllers/formaciones/cargar_formacion.php');
include('../../app/controllers/maestros/responsables/listado_responsables.php');
include('../../app/controllers/pruebas/listado_trabajadores.php');
include('../../app/controllers/formaciones/tipoformacion/listado_tipoformaciones.php');


///// traer datos de la formacion

foreach($formaciondetalle_datos as $formaciondetalle_dato){
    $nroformacion = $formaciondetalle_dato['nroformacion'];
    $id_formacion = $formaciondetalle_dato['id_formacion'];
    $tipo_fr = $formaciondetalle_dato['nombre_tf'];
    $duracion_fr = $formaciondetalle_dato['duracion_tf'];
    $fecha_fr = date("d-m-Y", strtotime($formaciondetalle_dato['fecha_fr']));
    $fecha2_fr = date("Y", strtotime($formaciondetalle_dato['fecha_fr']));
    $fechacad_fr = date("d-m-Y", strtotime($formaciondetalle_dato['fechacad_fr']));
    $formador_fr = $formaciondetalle_dato['nombre_resp'];
    $cargoresp_fr = $formaciondetalle_dato['cargo_resp'];
    $detalles_fr = $formaciondetalle_dato['detalles_tf'];
    
    }

    $nroformacion = $formaciondetalle_dato['nroformacion'];


// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

$PDF_HEADER_TITLE = 'SERVICIOS Y CONCESIONES MARITIMAS IBICENCAS S.A.';
$PDF_HEADER_STRING ='C/ Aragón 71 - 07800 Ibiza';
$PDF_HEADER_LOGO = 'LOGO TRASMAPI.jpg';
// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('HS BASE');
$pdf->SetTitle('Report Accion Correctora');
$pdf->SetSubject('HSBASE');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

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

// ---------------------------------------------------------

// set font
$pdf->SetFont('helvetica', '', 9);

//Cell($w, $h=0, $txt='', $border=0, $ln=0, $align='', $fill=0, $link='', $stretch=0, $ignore_min_height=false, $calign='T', $valign='M')


//create some HTML content
$html ='

<h1 style="text-align: center">CERTIFICADO DE FORMACIÓN</h1>

<br>
<p></p>

<table border="0">
<tr>
<td style="height: 30px; background-color: #ffffff; text-align: left"><b>Cod. Formación:</b></td>
<td>'.$nroformacion.' / '.$fecha2_fr.'</td>

<td style="height: 30px; background-color: #ffffff; text-align: right"><b>Formación:</b></td>
<td>'.$tipo_fr.'</td>
</tr>
<tr>
<td style="height: 30px; background-color: #ffffff; text-align: left"><b>Fecha formación:</b></td>
<td>'.$fecha_fr.'</td>

<td style="height: 30px; background-color: #ffffff; text-align: right"><b>Vigente hasta:</b></td>
<td>'.$fechacad_fr.'</td>
</tr>
<tr>
<td style="height: 30px; background-color: #ffffff; text-align: left"><b>Formador:</b></td>
<td>'.$formador_fr.' / '.$cargoresp_fr.'</td>
<td style="height: 30px; background-color: #ffffff; text-align: right"><b>Formación:</b></td>
<td>'.$duracion_fr.' hrs.</td>
</tr>
</table>
<table border="0">
<tr>
<td style="width: 630px;  background-color: #ffffff; text-align: left"><b>Temario:</b></td>
</tr>
<tr>
<td style="width: 630px;height: 100px;">'.$detalles_fr.'</td>
</tr>
</table>
<br><br>
<hr>
<h3 style="text-align: left">Asistentes:</h3>

<table border="0">
<tr>
<td style="height: 30px; width: 100px; background-color: #ffffff; text-align: center"><b>Nº.</b></td>
<td style="height: 30px; width: 400px; background-color: #ffffff; text-align: center"><b>APELLIDOS, NOMBRE</b></td>
<td style="height: 30px; width: 150px; background-color: #ffffff; text-align: center"><b>DNI/NIE</b></td>
</tr>
';
$contador_formasistencia = 0;

$sql_formasistencia = "SELECT *, tr.codigo_tr as codigo_tr FROM form_asistencia AS fas 
INNER JOIN trabajadores AS tr ON fas.idtrabajador_fas = tr.id_trabajador 
INNER JOIN categorias as cat ON tr.categoria_tr = cat.id_categoria WHERE nroformacion = '$nroformacion' ORDER BY tr.nombre_tr ASC";
$query_formasistencia = $pdo->prepare($sql_formasistencia);
$query_formasistencia->execute();
$formasistencia_datos = $query_formasistencia->fetchAll(PDO::FETCH_ASSOC);

foreach ($formasistencia_datos as $formasistencia_dato) {
    $id_formasistencia = $formasistencia_dato['id_formasistencia'];
    $contador_formasistencia = $contador_formasistencia + 1;
    $html .='
    <tr>
<td style="height: 20px; width: 100px; background-color: #ffffff; text-align: center">'.$contador_formasistencia.'</td>
<td style="height: 20px; width: 400px; background-color: #ffffff; text-align: left">'.$formasistencia_dato['nombre_tr'].'</td>
<td style="height: 20px; width: 150px; background-color: #ffffff; text-align: center">'.$formasistencia_dato['dni_tr'].'</td>
</tr>
    ';
}

$html .='

</table>
';

$pdf->AddPage();

// ---------------------------------------------------------
// Output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');


//Close and output PDF document
$pdf->Output('hsbase_accion_PRL.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+