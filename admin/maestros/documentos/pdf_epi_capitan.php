<?php
include('../../../app/config.php');

use setasign\Fpdi\Fpdi;

require_once('../../../public/FPDI-2.6.0/src/autoload.php');
require_once('../../../public/fpdf181/fpdf.php');

$id_trabajador = $_GET['id_trabajador'];
$id_empresa = $_GET['id_emp'];

include('../../../app/controllers/trabajadores/listado_trabajadores.php');
include('../../../app/controllers/maestros/centros/listado_centros.php');
include('../../../app/controllers/trabajadores/datos_trabajador.php');
include('../../../app/controllers/maestros/empresas/listado_empresas.php');
include('../../../app/controllers/maestros/empresas/datos_empresa.php');



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

///// traer datos de empresa prl
foreach ($empresa_datos as $empresa_dato) {
    $nombre_emp = $empresa_dato['nombre_emp'];
    $razonsocial_emp = $empresa_dato['razonsocial_emp'];
    $cif_emp = $empresa_dato['cif_emp'];
    $direccion_emp = $empresa_dato['direccion_emp'];
    $modalidadprl_emp = $empresa_dato['modalidadprl_emp'];
    $logo_emp = $empresa_dato['logo_emp'];
     

}




///// traer datos de accionprl

$pdf = new FPDI();

# Pagina 1
$pdf->AddPage();
$pdf->setSourceFile('Files_Pdf/18_04_2024_epis-capitan.pdf');
$tplIdx1 = $pdf->importPage(1);
$pdf->useTemplate($tplIdx1); 
$pdf->SetFont('Arial', '', '9'); 
$pdf->SetXY(51, 37);
$pdf->Write(10, $nombre_tr);


$pdf->SetFont('Arial', 'B', '10'); 
$pdf->SetXY(61, 27);
$pdf->Write(10, $razonsocial_emp);
$pdf->image('../centros/img/'.$logo_emp, 11, 11, 25, 15, 'jpg');

// setFont ('B' - NEGRITA 
//setFont ('I' - ITALICA 
//setFont ('S' - SUBRAYA 


$pdf->Output('Files_Pdf/epis_PRL.pdf', 'D'); //SALIDA DEL PDF
//    $pdf->Output('original_update.pdf', 'F');
//    $pdf->Output('original_update.pdf', 'I'); //PARA ABRIL EL PDF EN OTRA VENTANA
//	  $pdf->Output('original_update.pdf', 'D'); //PARA FORZAR LA DESCARGA
