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
include('../../app/config.php');
include('../../app/controllers/actividad/listado_accionprl.php');
include('../../app/controllers/maestros/centros/listado_centros.php');
$id_accion = $_GET['id_accion'];
include('../../app/controllers/actividad/datos_accionprl.php');
include('../../app/controllers/trabajadores/listado_trabajadores.php');
include('../../app/controllers/maestros/responsables/listado_responsables.php');
include('../../app/controllers/maestros/centros/listado_centros.php');

///// traer datos de accion prl
foreach ($accionprl_datos as $accionprl_dato) {
    $codigo_acc = $accionprl_dato['codigo_acc'];
    $fecha_acc = $accionprl_dato['fecha_acc'];
    $centro_acc = $accionprl_dato['nombre_cen'];
    $origen_acc = $accionprl_dato['origen_acc'];
    $detalleorigen_acc = $accionprl_dato['detalleorigen_acc'];
    $prioridad_acc = $accionprl_dato['prioridad_acc'];
    $descripcion_acc = $accionprl_dato['descripcion_acc'];
    $responsable_acc = $accionprl_dato['nombre_resp'];
    $fechaprevista_acc = $accionprl_dato['fechaprevista_acc'];
    $fechaprevista_acc = $accionprl_dato['fechaprevista_acc'];
    $fecharea_acc = $accionprl_dato['fecharea_acc'];
    $fechaveri_acc = $accionprl_dato['fechaveri_acc'];
    $avance_acc = $accionprl_dato['avance_acc'];
    $estado_acc = $accionprl_dato['estado_acc'];
    $accpropuesta_acc = $accionprl_dato['accpropuesta_acc'];
    $accrealizada_acc = $accionprl_dato['accrealizada_acc'];
    $seguimiento_acc = $accionprl_dato['seguimiento_acc'];
    $recursos_acc = $accionprl_dato['recursos_acc'];
}
///// traer datos de accionprl



///// traer datos de centro trabajo

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

<h1 style="text-align: center">ACCIÓN CORRECTORA</h1>

<br>
<p></p>

<table border="0">
<tr>
<td style="height: 20px; background-color: #ffffff; text-align: left"><b>Num. accion PRL:</b></td>
<td>'.$id_accion.'</td>
<td><b>Fecha apertura:</b></td>
<td>'.$fecha_acc.'</td>
<td style="height: 20px; background-color: #ffffff; text-align: right"><b>% Avance:</b></td>
<td>'.$avance_acc.'</td>
</tr>

<tr>
<td><b>Centro trabajo:</b></td>
<td>'.$centro_acc.'</td>
<td></td>
<td></td>
<td style="text-align: right"><b>Prioridad:</b></td>
<td>'.$prioridad_acc.'</td>
</tr>
</table>
<br>
<br>
<table border="0">
<tr>
<td style="width: 630px;  background-color: #ffffff; text-align: left"><b>Descripcion:</b></td>
</tr>
<tr>
<td style="width: 630px;height: 100px;">'.$descripcion_acc.'</td>
</tr>
</table>

<br>
<hr>

<table border="0">

<tr>
<td style="width: 150px;height: 20px; background-color: #ffffff; text-align: left"><b>Origen:</b></td>
<td style="width: 480px;height: 20px;">'.$origen_acc.'</td>
</tr>
<tr>
<td style="width: 150px;height: 20px; background-color: #ffffff; text-align: left"><b>Informe procedencia:</b></td>
<td>'.$detalleorigen_acc.'</td>
</tr>
<tr>
<td style="width: 150px;height: 100px;background-color: #ffffff; text-align: left"><b>Accion propuesta:</b></td>
<td>'.$accpropuesta_acc.'</td>
</tr>
<tr>
<td style="width: 150px;height: 20px;background-color: #ffffff; text-align: left"><b>Responsable:</b></td>
<td>'.$responsable_acc.'</td>
</tr>
<tr>
<td style="width: 150px;height: 20px;background-color: #ffffff; text-align: left"><b>Prioridad:</b></td>
<td>'.$prioridad_acc.'</td>
</tr>
</table>

<br>
<hr>
<table border="0">
<tr>

<td style="width: 150px;height: 10px;background-color: #ffffff; text-align: left"><b></b></td>
<td></td>
</tr>
<tr>
<td style="width: 150px;height: 20px; background-color: #ffffff; text-align: left"><b>Fecha cierre prevista:</b></td>
<td style="width: 200px;height: 20px;">'.$fechaprevista_acc.'</td>
</tr>
<tr>
<td style="width: 150px;height: 20px; background-color: #ffffff; text-align: left"><b>Fecha cierre real:</b></td>
<td>'.$fecharea_acc.'</td>

<td style="width: 150px;height: 20px;background-color: #ffffff; text-align: left"><b>Recursos económicos:</b></td>
<td>'.$recursos_acc.'</td>
</tr>
<tr>

<td style="width: 150px;height: 20px;background-color: #ffffff; text-align: left"><b>Fecha verificación:</b></td>
<td>'.$fechaveri_acc.'</td>
</tr>
</table>
<br>
<hr>
<table border="0">
<tr>
<td style="width: 630px;  background-color: #ffffff; text-align: left"><b>Comentarios:</b></td>
</tr>
<tr>
<td style="width: 630px;height: 100px;">'.$seguimiento_acc.'</td>
</tr>
</table>

<br>
<hr>
<br><br>
<table border="0">

<tr style="text-align:center">
<td style="width: 300px;height: 20px; background-color: #ffffff; text-align: left"><b>Imagenes:</b></td>
<td style="width: 300px;height: 20px;"></td>
</tr>
<tr>
<td style="width: 300px;height: 150px; text-align: center"></td>
<td style="width: 300px;height: 150px; text-align: center"></td>
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