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
    $fecha_fr = $formaciondetalle_dato['fecha_fr'];
    $fechacad_fr = $formaciondetalle_dato['fechacad_fr'];
    $formador_fr = $formaciondetalle_dato['nombre_resp'];
    $detalles_fr = $formaciondetalle_dato['detalles_tf'];
    
    }

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
<td style="height: 20px; background-color: #ffffff; text-align: left"><b>Num. accion PRL:</b></td>
<td>'.$nroformacion.'</td>
<td><b>Fecha apertura:</b></td>
<td></td>
<td style="height: 20px; background-color: #ffffff; text-align: right"><b>% Avance:</b></td>
<td>'.$tipo_fr.'</td>
</tr>
<tr>
<td style="height: 20px; background-color: #ffffff; text-align: left"><b>Num. accion PRL:</b></td>
<td>'.$fecha_fr.'</td>
<td><b>Fecha apertura:</b></td>
<td></td>
<td style="height: 20px; background-color: #ffffff; text-align: right"><b>% Avance:</b></td>
<td>'.$fechacad_fr.'</td>
</tr>
<tr>
<td style="height: 20px; background-color: #ffffff; text-align: left"><b>Num. accion PRL:</b></td>
<td>'.$formador_fr.'</td>
</tr>
</table>
<table border="0">
<tr>
<td style="width: 630px;  background-color: #ffffff; text-align: left"><b>Comentarios:</b></td>
</tr>
<tr>
<td style="width: 630px;height: 100px;">'.$detalles_fr.'</td>
</tr>
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