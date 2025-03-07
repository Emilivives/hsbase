<?php
include('../../../app/config.php');

use setasign\Fpdi\Fpdi;


require_once('../../../public/FPDI-2.6.0/src/autoload.php');
require_once('../../../public/fpdf181/fpdf.php');

$id_formacion_get = $_GET['id_formacion'];

$id_trabajador_get = $_GET['id_trabajador'];

include('../../../app/controllers/formaciones/cargar_formacion.php');
include('../../../app/controllers/maestros/responsables/listado_responsables.php');
include('../../../app/controllers/pruebas/listado_trabajadores.php');
include('../../../app/controllers/formaciones/tipoformacion/listado_tipoformaciones.php');




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
    $normativa_fr = $formaciondetalle_dato['normativa_tf'];    
    }

    $nroformacion = $formaciondetalle_dato['nroformacion'];


///// traemos datos de trabajador

$contador_formasistencia = 0;

$sql_formasistencia = "SELECT *, tr.codigo_tr as codigo_tr FROM form_asistencia AS fas 
INNER JOIN trabajadores AS tr ON fas.idtrabajador_fas = tr.id_trabajador 
INNER JOIN categorias as cat ON tr.categoria_tr = cat.id_categoria WHERE nroformacion = '$nroformacion' AND tr.id_trabajador = '$id_trabajador_get'";
$query_formasistencia = $pdo->prepare($sql_formasistencia);
$query_formasistencia->execute();
$formasistencia_datos = $query_formasistencia->fetchAll(PDO::FETCH_ASSOC);

foreach ($formasistencia_datos as $formasistencia_dato) {
    $id_formasistencia = $formasistencia_dato['id_formasistencia'];
    $contador_formasistencia = $contador_formasistencia + 1;
}

///// traer datos de accionprl

$pdf = new FPDI();

# Pagina 1  (X-horizontal Y-vertical)
$pdf->addPage('L');
$pdf->setSourceFile('Files_Pdf/14_05_2024_titulo formacion.pdf');
$tplIdx1 = $pdf->importPage(1);
$pdf->useTemplate($tplIdx1); 

$pdf->SetFont('Arial', 'B', '15');
$pdf->SetXY(58, 73);
$trabajador = mb_convert_encoding($formasistencia_dato['nombre_tr'], 'ISO-8859-1', 'UTF-8');
$pdf->Write(10, $trabajador);

$pdf->SetFont('Arial', 'B', '15');
$pdf->SetXY(220, 73);
$dni = mb_convert_encoding($formasistencia_dato['dni_tr'], 'ISO-8859-1', 'UTF-8');
$pdf->Write(10, $dni);


$pdf->SetFont('Arial', 'B', '18');
$pdf->SetXY(50, 102);
$trabajador_ace = mb_convert_encoding($tipo_fr, 'ISO-8859-1', 'UTF-8');
$pdf->Write(5, $tipo_fr);

$pdf->SetFont('Arial', '', '15');
$pdf->SetXY(65, 128);
$pdf->Write(10, $fecha_fr);


$pdf->SetFont('Arial', '', '15');
$pdf->SetXY(165, 128);
$pdf->Write(10, $duracion_fr);

$pdf->SetFont('Arial', '', '15');
$pdf->SetXY(100, 115);
$pdf->Write(10, $normativa_fr);


# Pagina 2
$pdf->addPage();
$tplIdx2 = $pdf->importPage(2);
$pdf->useTemplate($tplIdx2);  

$pdf->SetFont('Arial', '', '8');
$pdf->SetXY(10, 60);
$detalles_fr = mb_convert_encoding($detalles_fr, 'ISO-8859-1', 'UTF-8');
$pdf->Write(3, $detalles_fr);

$pdf->SetFont('Arial', '', '13');
$pdf->SetXY(45, 248);
$pdf->Write(10, $fecha_fr);




// setFont ('B' - NEGRITA 
//setFont ('I' - ITALICA 
//setFont ('S' - SUBRAYA 


$pdf->Output(''.$formasistencia_dato['nombre_tr'].'_'.$fecha_fr.'.pdf', 'D'); //SALIDA DEL PDF
//    $pdf->Output('original_update.pdf', 'F');
//    $pdf->Output('original_update.pdf', 'I'); //PARA ABRIL EL PDF EN OTRA VENTANA
//	  $pdf->Output('original_update.pdf', 'D'); //PARA FORZAR LA DESCARGA
