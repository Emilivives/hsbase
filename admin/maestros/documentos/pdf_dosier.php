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

///// traer datos de accionprl

$pdf = new FPDI();

# Pagina 1
$pdf->AddPage();
$pdf->setSourceFile('Files_Pdf/08_05_2024_DOSIER_COMPLETO_2023.pdf');
$tplIdx = $pdf->importPage(1);
$pdf->useTemplate($tplIdx);


# Pagina 2
$pdf->AddPage();
$tplIdx2 = $pdf->importPage(2);
$pdf->useTemplate($tplIdx2);  

# Pagina 3
$pdf->AddPage();
$tplIdx3 = $pdf->importPage(3);
$pdf->useTemplate($tplIdx3);  

# Pagina 4
$pdf->AddPage();
$tplIdx4 = $pdf->importPage(4);
$pdf->useTemplate($tplIdx4);  

# Pagina 5
$pdf->AddPage();
$tplIdx5 = $pdf->importPage(5);
$pdf->useTemplate($tplIdx5);  

# Pagina 6
$pdf->AddPage();
$tplIdx6 = $pdf->importPage(6);
$pdf->useTemplate($tplIdx6);  
$pdf->SetFont('Arial', 'B', '10');
$pdf->SetXY(57, 46);
$pdf->Write(10, mb_convert_encoding($nombre_tr, 'ISO-8859-1', 'UTF-8'));


$pdf->SetFont('Arial', 'B', '10');
$pdf->SetXY(155, 46);
$pdf->Write(10, $dni_tr);

# Pagina 7
$pdf->AddPage();
$tplIdx7 = $pdf->importPage(7);
$pdf->useTemplate($tplIdx7);  
$pdf->SetFont('Arial', 'B', '10');
$pdf->SetXY(68, 60);
$pdf->Write(10, mb_convert_encoding($nombre_tr, 'ISO-8859-1', 'UTF-8'));


$pdf->SetFont('Arial', 'B', '10');
$pdf->SetXY(147, 60);
$pdf->Write(10, $dni_tr);

$pdf->SetFont('Arial', 'B', '10');
$pdf->SetXY(68, 67);
$pdf->Write(10, mb_convert_encoding($categoria_tr, 'ISO-8859-1', 'UTF-8'));


# Pagina 8
$pdf->AddPage();
$tplIdx8 = $pdf->importPage(8);
$pdf->useTemplate($tplIdx8);  
$pdf->SetFont('Arial', 'B', '10');
$pdf->SetXY(55, 37);
$pdf->Write(10, mb_convert_encoding($nombre_tr, 'ISO-8859-1', 'UTF-8'));


$pdf->SetFont('Arial', 'B', '10');
$pdf->SetXY(158, 37);
$pdf->Write(10, $dni_tr);

# Pagina 9
$pdf->AddPage();
$tplIdx9 = $pdf->importPage(9);
$pdf->useTemplate($tplIdx9); 
$pdf->SetFont('Arial', 'B', '10');
$pdf->SetXY(55, 37);
$pdf->Write(10, mb_convert_encoding($nombre_tr, 'ISO-8859-1', 'UTF-8'));


$pdf->SetFont('Arial', 'B', '10');
$pdf->SetXY(158, 37);
$pdf->Write(10, $dni_tr); 
 
# Pagina 10
$pdf->AddPage();
$tplIdx9 = $pdf->importPage(10);
$pdf->useTemplate($tplIdx9); 
$pdf->SetFont('Arial', 'B', '10');
$pdf->SetXY(42, 142);
$pdf->Write(10, mb_convert_encoding($nombre_tr, 'ISO-8859-1', 'UTF-8'));


$pdf->SetFont('Arial', 'B', '10');
$pdf->SetXY(112, 142);
$pdf->Write(10, $dni_tr); 

# Pagina 11
$pdf->AddPage();
$tplIdx9 = $pdf->importPage(11);
$pdf->useTemplate($tplIdx9); 
$pdf->SetFont('Arial', 'B', '10');
$pdf->SetXY(42, 112);
$pdf->Write(10, mb_convert_encoding($nombre_tr, 'ISO-8859-1', 'UTF-8'));


$pdf->SetFont('Arial', 'B', '10');
$pdf->SetXY(112, 112);
$pdf->Write(10, $dni_tr); 

$pdf->Output('Files_Pdf/Dosier_PRL_' . $nombre_tr . '.pdf', 'D'); //SALIDA DEL PDF
//    $pdf->Output('original_update.pdf', 'F');
//    $pdf->Output('original_update.pdf', 'I'); //PARA ABRIL EL PDF EN OTRA VENTANA
//	  $pdf->Output('original_update.pdf', 'D'); //PARA FORZAR LA DESCARGA
