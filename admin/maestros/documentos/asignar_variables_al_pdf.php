<?php
include('../../../app/config.php');

use setasign\Fpdi\Fpdi;

require_once('../../../public/FPDI-2.6.0/src/autoload.php');
require_once('../../../public/fpdf181/fpdf.php');
include('../../../app/controllers/actividad/listado_accionprl.php');
include('../../../app/controllers/maestros/centros/listado_centros.php');
$id_accion = 1;
include('../../../app/controllers/actividad/datos_accionprl.php');
include('../../../app/controllers/trabajadores/listado_trabajadores.php');
include('../../../app/controllers/maestros/responsables/listado_responsables.php');
include('../../../app/controllers/maestros/centros/listado_centros.php');

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

$pdf = new FPDI();

# Pagina 1
$pdf->AddPage();
$pdf->setSourceFile('Files_Pdf/12_04_2024_registro formacion - EMBARCACIONES22 - SERCOMISA.pdf');
$tplIdx = $pdf->importPage(1);
$pdf->useTemplate($tplIdx);
$pdf->SetFont('Arial', 'B', '9');
$pdf->SetXY(90, 50);
$pdf->Write(10, $centro_acc);


$pdf->SetFont('Arial', 'B', '11');
$pdf->SetXY(10, 220);
$pdf->Write(10, $avance_acc);

$pdf->SetFont('Arial', 'B', '11');
$pdf->SetXY(100, 220);
$pdf->Write(10, $fecha_acc);

$pdf->SetFont('Arial', 'B', '11');
$pdf->SetXY(180, 220);
$pdf->Write(10, $codigo_acc);


$pdf->Output('Files_Pdf/VYWQ_15_12_2020.pdf', 'D'); //SALIDA DEL PDF
//    $pdf->Output('original_update.pdf', 'F');
//    $pdf->Output('original_update.pdf', 'I'); //PARA ABRIL EL PDF EN OTRA VENTANA
//	  $pdf->Output('original_update.pdf', 'D'); //PARA FORZAR LA DESCARGA
