<?php
include('../../../app/config.php');

use setasign\Fpdi\Fpdi;


require_once('../../../public/FPDI-2.6.0/src/autoload.php');
require_once('../../../public/fpdf181/fpdf.php');

$id_accidente = $_GET['id_accidente'];
include('../../../app/controllers/accidentes/datos_accidente.php');
include('../../../app/controllers/trabajadores/listado_trabajadores.php');

include('../../../app/controllers/maestros/categorias/listado_categorias.php');
include('../../../app/controllers/maestros/centros/listado_centros.php');
include('../../../app/controllers/maestros/accidentes/listado_actividadfisica.php');
include('../../../app/controllers/maestros/accidentes/listado_agentematerial.php');
include('../../../app/controllers/maestros/accidentes/listado_agentematerialdesv.php');
include('../../../app/controllers/maestros/accidentes/listado_agentematerialles.php');
include('../../../app/controllers/maestros/accidentes/listado_desviacion.php');
include('../../../app/controllers/maestros/accidentes/listado_formacontacto.php');
include('../../../app/controllers/maestros/accidentes/listado_gravedad.php');
include('../../../app/controllers/maestros/accidentes/listado_partecuerpo.php');
include('../../../app/controllers/maestros/accidentes/listado_tipolesion.php');
include('../../../app/controllers/maestros/accidentes/listado_procesotrabajo.php');
include('../../../app/controllers/maestros/accidentes/listado_tipolugar.php');
include('../../../app/controllers/maestros/accidentes/listado_tipoaccidente.php');
include('../../../app/controllers/maestros/accidentes/listado_gravedad.php');




///// traer datos deL ACCIDENTE
foreach ($accidentes_datos as $accidentes_dato) {
    $nroaccidente_ace = $accidentes_dato['nroaccidente_ace'];
    $comunicado_ace = $accidentes_dato['comunicado_ace'];
    $trabajador_ace = $accidentes_dato['nombre_tr'];
    $dni_trabajador_ace = $accidentes_dato['dni_tr'];
    $sexo_trabajador_ace = $accidentes_dato['sexo_tr'];
    $fechanac_trabajador_ace = $accidentes_dato['fechanac_tr'];
    $inicio_trabajador_ace = $accidentes_dato['inicio_tr'];
    $categoria_trabajador_ace = $accidentes_dato['nombre_cat'];
    $categoria_descripcion_ace = $accidentes_dato['descripcion_cat'];
    $departamento_trabajador_ace = $accidentes_dato['departamento_cat'];
    $centro_ace = $accidentes_dato['nombre_cen'];
    $empresa_ace = $accidentes_dato['nombre_emp'];
    $razonsocial_ace = $accidentes_dato['razonsocial_emp'];
    $modalidadprl_ace = $accidentes_dato['modalidadprl_emp'];
    $lugar_ace = $accidentes_dato['lugar_ace'];
    $detalleslugar_ace = $accidentes_dato['detalleslugar_ace'];
    $tipoaccidente_ace = $accidentes_dato['tipoaccidente_ta'];
    $fecha_ace = $accidentes_dato['fecha_ace'];
    $fechabaja_ace = $accidentes_dato['fechabaja_ace'];
    $hora_ace = $accidentes_dato['hora_ace'];
    $horatrabajo_ace = $accidentes_dato['horatrabajo_ace'];
    $trabajohabitual_ace = $accidentes_dato['trabajohabitual_ace'];
    $diadescanso_ace = $accidentes_dato['diadescanso_ace'];
    $semanadescanso_ace = $accidentes_dato['semanadescanso_ace'];
    $diasbaja_ace = $accidentes_dato['diasbaja_ace'];
    $isevaluadoriesgo_ace = $accidentes_dato['isevaluadoriesgo_ace'];
    $evalconriesgo_ace = $accidentes_dato['evalconriesgo_ace'];
    $isrecaida_ace = $accidentes_dato['isrecaida_ace'];
    $fechaantesrecaida_ace = $accidentes_dato['fechaantesrecaida_ace'];
    $descripcion_ace = $accidentes_dato['descripcion_ace'];
    $tipolugar_ace = $accidentes_dato['tipolugar_tl'];
    $tipolugar_ace2 = $accidentes_dato['codtipolugar_tl'];
    $zonalugar_ace = $accidentes_dato['zonalugar_ace'];
    $observaclugar_ace = $accidentes_dato['observaclugar_ace'];
    $procesotrabajo_ace = $accidentes_dato['procesotrabajo_pt'];
    $procesotrabajo_ace2 = $accidentes_dato['codigo_pt'];
    $observproceso_ace = $accidentes_dato['observproceso_ace'];
    $tipoactividad_ace = $accidentes_dato['activfisica_af'];
    $tipoactividad_ace2 = $accidentes_dato['codactivfis_af'];
    $observtipoactiv_ace = $accidentes_dato['observtipoactiv_ace'];
    $agentematerial_ace = $accidentes_dato['agentematerial_am'];
    $agentematerial_ace2 = $accidentes_dato['codagentemat_am'];
    $observagmaterial_ace = $accidentes_dato['observagmaterial_ace'];
    $desviacion_ace = $accidentes_dato['desviacion_des'];
    $observdesviacion_ace = $accidentes_dato['observdesviacion_ace'];
    $agmaterdesv_ace = $accidentes_dato['agentematerialdesv_amd'];
    $observagendesv_ace = $accidentes_dato['observagendesv_ace'];
    $formacontacto_ace = $accidentes_dato['formacontacto_fc'];
    $observformacont_ace = $accidentes_dato['observformacont_ace'];
    $matercasusalesi_ace = $accidentes_dato['agentematerialles_aml'];
    $observmatlesi_ace = $accidentes_dato['observmatlesi_ace'];
    $numtrafectados_ace = $accidentes_dato['numtrafectados_ace'];
    $declaraciontrab_ace = $accidentes_dato['declaraciontrab_ace'];
    $istestigos_ace = $accidentes_dato['istestigos_ace'];
    $detallestestigo_ace = $accidentes_dato['detallestestigo_ace'];
    $declaraciontestigo_ace = $accidentes_dato['declaraciontestigo_ace'];
    $tipolesion_ace = $accidentes_dato['tipolesion_tl'];
    $gradolesion_ace = $accidentes_dato['gravedad_gr'];
    $partecuerpo_ace = $accidentes_dato['partecuerpo_pc'];
    $isevacuacion_ace = $accidentes_dato['isevacuacion_ace'];
    $lugarevacuacion_ace = $accidentes_dato['lugarevacuacion_ace'];
    $centromedico_ace = $accidentes_dato['centromedico_ace'];
    $detallescentromed_ace = $accidentes_dato['detallescentromed_ace'];
    $recomedincorp_ace = $accidentes_dato['recomedincorp_ace'];
    $recinedtrab_ace = $accidentes_dato['recinedtrab_ace'];
    $istrformado_ace = $accidentes_dato['istrformado_ace'];
    $istrinformado_ace = $accidentes_dato['istrinformado_ace'];
    $protcolectivadisp_ace = $accidentes_dato['protcolectivadisp_ace'];
    $protcolecnecesa_ace = $accidentes_dato['protcolecnecesa_ace'];
    $observprotcol_ace = $accidentes_dato['observprotcol_ace'];
    $episdispon_ace = $accidentes_dato['episdispon_ace'];
    $episneces_ace = $accidentes_dato['episneces_ace'];
    $observepis_ace = $accidentes_dato['observepis_ace'];
    $causaaccidente_ace = $accidentes_dato['causaaccidente_ace'];
    $porquecausa_ace = $accidentes_dato['porquecausa_ace'];
    $quiencontrolcausa_ace = $accidentes_dato['quiencontrolcausa_ace'];
    $conclusionacci_ace = $accidentes_dato['conclusionacci_ace'];
    $medidasprev_ace = $accidentes_dato['medidasprev_ace'];
    $valoracionmedida_ace = $accidentes_dato['valoracionmedida_ace'];
    $histaccult12mes_ace = $accidentes_dato['histaccult12mes_ace'];
    $histpuestoacc_ace = $accidentes_dato['histpuestoacc_ace'];
    $histtrabajosreal_ace = $accidentes_dato['histtrabajosreal_ace'];
    $histcausaacc_ace = $accidentes_dato['histcausaacc_ace'];
    $histmedidaacc_ace = $accidentes_dato['histmedidaacc_ace'];
    $investigador_ace = $accidentes_dato['investigador_ace'];
    $cargoinvesiga_ace = $accidentes_dato['cargoinvesiga_ace'];
    $fechainvestiga_ace = $accidentes_dato['fechainvestiga_ace'];
    $fechacumplimen_ace = $accidentes_dato['fechacumplimen_ace'];
    $revisadopor_ace = $accidentes_dato['revisadopor_ace'];
    $cargorevisado_ace = $accidentes_dato['cargorevisado_ace'];
    $fecharevision_ace = $accidentes_dato['fecharevision_ace'];
}

$fechaentera = strtotime($fecha_ace);
$anio = date("Y", $fechaentera);
$mes = date("m", $fechaentera);
$dia = date("d", $fechaentera);

$horaentera = strtotime($hora_ace);
$hora = date("H", $fechaentera);
$minutos = date("i", $fechaentera);

$fechaahora = strtotime($fechahora);
$anioahora = date("Y", $fechaentera);
$mesahora = date("m", $fechaentera);
$diaahora = date("d", $fechaentera);


///// traer datos de accionprl

$pdf = new FPDI();

# Pagina 1  (X-horizontal Y-vertical)
$pdf->AddPage();
$pdf->setSourceFile('Files_Pdf/18_04_2024_SOLICITUD_ASISTENCIA_MUTUA.pdf');
$tplIdx1 = $pdf->importPage(1);
$pdf->useTemplate($tplIdx1); 
$pdf->SetFont('Arial', '', '11'); 
$pdf->SetXY(20, 48);
$pdf->Write(10, $razonsocial_ace);


$pdf->SetFont('Arial', '', '10');
$pdf->SetXY(20, 83);
$pdf->Write(10, $trabajador_ace);


$pdf->SetFont('Arial', '', '10');
$pdf->SetXY(135, 83);
$pdf->Write(10, $dni_trabajador_ace);

$pdf->SetFont('Arial', '', '10');
$pdf->SetXY(20, 106);
$pdf->Write(10, $categoria_trabajador_ace);


$pdf->SetFont('Arial', '', '6');
$pdf->SetXY(20, 120);
$pdf->Write(2, $categoria_descripcion_ace);


$pdf->SetFont('Arial', '', '13');
$pdf->SetXY(20, 153);
$pdf->Write(10, $dia);
$pdf->SetFont('Arial', '', '13');
$pdf->SetXY(35, 153);
$pdf->Write(10, $mes);
$pdf->SetFont('Arial', '', '13');
$pdf->SetXY(50, 153);
$pdf->Write(10, $anio);

$pdf->SetFont('Arial', '', '13');
$pdf->SetXY(130, 153);
$pdf->Write(10, $hora);
$pdf->SetFont('Arial', '', '13');
$pdf->SetXY(160, 153);
$pdf->Write(10, $hora);

$pdf->SetFont('Arial', '', '10');
$pdf->SetXY(20, 170);
$pdf->Write(10, $detalleslugar_ace);

$pdf->SetFont('Arial', '', '10');
$pdf->SetXY(20, 182);
$pdf->Write(10, $observproceso_ace);

$pdf->SetFont('Arial', '', '10');
$pdf->SetXY(20, 202);
$pdf->Write(10, $descripcion_ace);

$pdf->SetFont('Arial', '', '10');
$pdf->SetXY(20, 222);
$pdf->Write(10, $causaaccidente_ace);

$pdf->SetFont('Arial', '', '10');
$pdf->SetXY(20, 241);
$pdf->Write(10, $tipolesion_ace);

$pdf->SetFont('Arial', '', '10');
$pdf->SetXY(20, 261);
$pdf->Write(10, $partecuerpo_ace);

# Pagina 2
$pdf->AddPage();
$tplIdx2 = $pdf->importPage(2);
$pdf->useTemplate($tplIdx2);  

$pdf->SetFont('Arial', '', '9');
$pdf->SetXY(65, 200);
$pdf->Write(10, $dia);
$pdf->SetFont('Arial', '', '9');
$pdf->SetXY(85, 200);
$pdf->Write(10, $mes);
$pdf->SetFont('Arial', '', '9');
$pdf->SetXY(113, 200);
$pdf->Write(10, $anio);

// setFont ('B' - NEGRITA 
//setFont ('I' - ITALICA 
//setFont ('S' - SUBRAYA 


$pdf->Output('Files_Pdf/SOLICITUD_ASISTENCIA_MUTUA_TRASMAPI.pdf', 'D'); //SALIDA DEL PDF
//    $pdf->Output('original_update.pdf', 'F');
//    $pdf->Output('original_update.pdf', 'I'); //PARA ABRIL EL PDF EN OTRA VENTANA
//	  $pdf->Output('original_update.pdf', 'D'); //PARA FORZAR LA DESCARGA
