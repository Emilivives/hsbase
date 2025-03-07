<?php
include('../../../app/config.php');

use setasign\Fpdi\Fpdi;

require_once('../../../public/FPDI-2.6.0/src/autoload.php');
require_once('../../../public/fpdf181/fpdf.php');

$id_trabajador = $_GET['id_trabajador'];

include('../../../app/controllers/trabajadores/listado_trabajadores.php');
include('../../../app/controllers/maestros/centros/listado_centros.php');
include('../../../app/controllers/trabajadores/datos_trabajador.php');




///// traer datos de accion prl
foreach ($trabajador_datos as $trabajador_dato) {
    $codigo_tr = $trabajador_dato['codigo_tr'];
    $dni_tr = $trabajador_dato['dni_tr'];
    $nombre_tr = $trabajador_dato['nombre_tr'];
    $sexo_tr = $trabajador_dato['sexo_tr'];
    $fechanac_tr = $trabajador_dato['fechanac_tr'];
    $inicio_tr = $trabajador_dato['inicio_tr'];
    $centro_tr = $trabajador_dato['nombre_cen'];
    $categoria_tr = $trabajador_dato['nombre_cat'];
    $activo_tr = $trabajador_dato['activo_tr'];
    $anotaciones_tr = $trabajador_dato['anotaciones_tr'];
    $formacionpdt_tr = $trabajador_dato['formacionpdt_tr'];


}
$nombre_tr = mb_convert_encoding($nombre_tr, 'ISO-8859-1', 'UTF-8');
///// traer datos de accionprl

$pdf = new FPDI();

# Pagina 1
$pdf->AddPage();
$pdf->setSourceFile('Files_Pdf/08_05_2024_plantilla_info_prl_DISCOVIER.pdf');
$tplIdx = $pdf->importPage(1);
$pdf->useTemplate($tplIdx);
$pdf->SetFont('Arial', 'B', '10');
$pdf->SetXY(48, 92);
$trabajador = mb_convert_encoding($nombre_tr, 'ISO-8859-1', 'UTF-8');
$pdf->Write(10, $trabajador);


$pdf->SetFont('Arial', 'B', '10');
$pdf->SetXY(52, 98);
$pdf->Write(10, $dni_tr);



$pdf->Output(''.$nombre_tr.'_INFOPRL.pdf', 'D'); //SALIDA DEL PDF
//    $pdf->Output('original_update.pdf', 'F');
//    $pdf->Output('original_update.pdf', 'I'); //PARA ABRIL EL PDF EN OTRA VENTANA
//	  $pdf->Output('original_update.pdf', 'D'); //PARA FORZAR LA DESCARGA
