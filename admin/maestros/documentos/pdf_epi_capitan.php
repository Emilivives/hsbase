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
    $empresa_tr = $trabajador_dato['nombre_emp'];
    $razonsocial_tr = $trabajador_dato['razonsocial_emp'];
    $direccionemp_tr = $trabajador_dato['direccion_emp'];
    $categoria_tr = $trabajador_dato['nombre_cat'];
    $activo_tr = $trabajador_dato['activo_tr'];
    $anotaciones_tr = $trabajador_dato['anotaciones_tr'];
    $formacionpdt_tr = $trabajador_dato['formacionpdt_tr'];
    $informacion_tr = $trabajador_dato['informacion_tr'];
    $id_empresa = $trabajador_dato['id_empresa'];
    $logo_emp = $trabajador_dato['logo_emp'];

}

$nombre_tr = mb_convert_encoding($nombre_tr, 'ISO-8859-1', 'UTF-8');

///// traer datos de accionprl

$pdf = new FPDI();

$img2 = "../../../admin/maestros/centros/img/" . $logo_emp;

$pdf->SetAutoPageBreak(false);

# Pagina 1
$pdf->AddPage();
$pdf->setSourceFile('Files_Pdf/28_05_2024_epis-capitan.pdf');
$tplIdx1 = $pdf->importPage(1);
$pdf->useTemplate($tplIdx1); 
$pdf->SetFont('Arial', '', '9'); 
$pdf->SetXY(51, 37);
$pdf->Write(10, $nombre_tr);

$pdf->SetFont('Arial', '', '8'); 
$pdf->SetXY(10, 66);
$pdf->Write(10, $razonsocial_tr);

$pdf->Image($img2,10,10,30,0,"JPG");


$pdf->SetFont('Arial', 'B', '6'); 
$pdf->SetXY(85, 277);
$pdf->SetTextColor(255,255,255);
$pdf->Write(10, $empresa_tr);

$pdf->SetFont('Arial', 'B', '6'); 
$pdf->SetXY(75, 280);
$pdf->SetTextColor(255,255,255);
$pdf->Write(10, $razonsocial_tr);

$pdf->SetFont('Arial', 'B', '6'); 
$pdf->SetXY(80, 282);
$pdf->SetTextColor(255,255,255);
$pdf->Write(10, $direccionemp_tr);

// setFont ('B' - NEGRITA 
//setFont ('I' - ITALICA 
//setFont ('S' - SUBRAYA 

$pdf->Output(''.$trabajador_dato['nombre_tr'].'_epis.pdf', 'D'); 
//SALIDA DEL PDF

//    $pdf->Output('original_update.pdf', 'F');
//    $pdf->Output('original_update.pdf', 'I'); //PARA ABRIL EL PDF EN OTRA VENTANA
//	  $pdf->Output('original_update.pdf', 'D'); //PARA FORZAR LA DESCARGA
