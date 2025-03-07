<?php
include('../../../app/config.php');

use setasign\Fpdi\Fpdi;

require_once('../../../public/FPDI-2.6.0/src/autoload.php');
require_once('../../../public/fpdf181/fpdf.php');

$id_trabajador = $_GET['id_trabajador'];
include('../../../app/controllers/maestros/documentos/listado_infoprl_tr.php');
include('../../../app/controllers/trabajadores/listado_trabajadores.php');
include('../../../app/controllers/maestros/centros/listado_centros.php');
include('../../../app/controllers/trabajadores/datos_trabajador.php');


foreach ($info_documentos_datos_tr as $info_documentos_dato){
$nombre_tr = $info_documentos_dato['nombre_tr'];
$dni_tr = $info_documentos_dato['dni_tr'];
$nombre_ifd = $info_documentos_dato['nombre_ifd'];
$fecha_ifd = $info_documentos_dato['fecha_ifd'];
}


///// traer datos de accionprl

$pdf = new FPDI();

# Pagina 1

$pdf->AddPage();
$pdf->setSourceFile('Files_Pdf/25_02_2025_Informacion PRL pdf-a.pdf');
$tplIdx = $pdf->importPage(1);
$pdf->useTemplate($tplIdx);
$pdf->SetFont('Arial', 'B', '10');
$pdf->SetXY(67, 45);
$trabajador = mb_convert_encoding($nombre_tr, 'ISO-8859-1', 'UTF-8');
$pdf->Write(10, $trabajador);


$pdf->SetFont('Arial', 'B', '10');
$pdf->SetXY(157, 45);
$pdf->Write(10, $dni_tr);

$pdf->SetFont('Arial', 'B', '10');
$pdf->SetXY(67, 53);
$pdf->Write(10, mb_convert_encoding($nombre_ifd, 'ISO-8859-1', 'UTF-8'));

$fecha_ifd = date("d-m-Y", strtotime($fecha_ifd));

$pdf->SetFont('Arial', '', '10');
$pdf->SetXY(128, 93);
$pdf->Write(10, mb_convert_encoding($fecha_ifd, 'ISO-8859-1', 'UTF-8'));

$pdf->Output('info_PRL_' .$categoria_tr.$nombre_tr . '.pdf', 'D'); //SALIDA DEL PDF
//    $pdf->Output('original_update.pdf', 'F');
//    $pdf->Output('original_update.pdf', 'I'); //PARA ABRIL EL PDF EN OTRA VENTANA
//	  $pdf->Output('original_update.pdf', 'D'); //PARA FORZAR LA DESCARGA
