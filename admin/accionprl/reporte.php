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
foreach ($centros_datos as $centros_dato) {
    $nombre_cen = $centros_dato['nombre_cen'];
    $empresa_cen = $centros_dato['nombre_cen'];
    $tipo_cen = $centros_dato['nombre_tc'];
    $direccion_cen = $centros_dato['direccion_cen'];
}
///// traer datos de centro trabajo


// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->setCreator(PDF_CREATOR);
$pdf->setAuthor(APP_NAME);
$pdf->setTitle(APP_NAME);
$pdf->setSubject(APP_NAME);
$pdf->setKeywords(APP_NAME);

// set default header data
$pdf->setHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE . ' 001', PDF_HEADER_STRING, array(0, 64, 255), array(0, 64, 128));
$pdf->setFooterData(array(0, 64, 0), array(0, 64, 128));

// set header and footer fonts
$pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->setDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->setMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->setHeaderMargin(PDF_MARGIN_HEADER);
$pdf->setFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->setAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
    require_once(dirname(__FILE__) . '/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set default font subsetting mode
$pdf->setFontSubsetting(true);

// Set font
// dejavusans is a UTF-8 Unicode font, if you only need to
// print standard ASCII chars, you can use core fonts like
// helvetica or times to reduce file size.
$pdf->setFont('helvetica', '', 12, '', true);

// Add a page
// This method has several options, check the source code documentation for more information.
$pdf->AddPage();

// set text shadow effect
$pdf->setTextShadow(array('enabled' => true, 'depth_w' => 0.2, 'depth_h' => 0.2, 'color' => array(196, 196, 196), 'opacity' => 1, 'blend_mode' => 'Normal'));

// Set some content to print
$html = "


<table border='1'>
<tr>
<td> $nombre_cen</td>
</tr>

</table>

<h1> Hola Mundo</h1>

";

// Print text using writeHTMLCell()
$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

// ---------------------------------------------------------

// Close and output PDF document
// This method has several options, check the source code documentation for more information.
$pdf->Output('example_001.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
