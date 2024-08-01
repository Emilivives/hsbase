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
    $departamento_trabajador_ace = $accidentes_dato['nombre_dpo'];
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
    $codtipolugar_ace = $accidentes_dato['codtipolugar_tl'];
    $zonalugar_ace = $accidentes_dato['zonalugar_ace'];
    $observaclugar_ace = $accidentes_dato['observaclugar_ace'];
    $procesotrabajo_ace = $accidentes_dato['procesotrabajo_pt'];
    $codprocesotrabajo_ace = $accidentes_dato['codigo_pt'];
    $observproceso_ace = $accidentes_dato['observproceso_ace'];
    $tipoactividad_ace = $accidentes_dato['activfisica_af'];
    $codtipoactividad_ace = $accidentes_dato['codactivfis_af'];
    $observtipoactiv_ace = $accidentes_dato['observtipoactiv_ace'];
    $agentematerial_ace = $accidentes_dato['agentematerial_am'];
    $codagentematerial_ace = $accidentes_dato['codagentemat_am'];
    $observagmaterial_ace = $accidentes_dato['observagmaterial_ace'];
    $desviacion_ace = $accidentes_dato['desviacion_des'];
    $coddesviacion_ace = $accidentes_dato['coddesviacion_des'];
    $observdesviacion_ace = $accidentes_dato['observdesviacion_ace'];
    $agmaterdesv_ace = $accidentes_dato['agentematerialdesv_amd'];
    $codagmaterdesv_ace = $accidentes_dato['codagentematdesv_amd'];
    $observagendesv_ace = $accidentes_dato['observagendesv_ace'];
    $formacontacto_ace = $accidentes_dato['formacontacto_fc'];
    $codformacontacto_ace = $accidentes_dato['codformacont_fc'];
    $observformacont_ace = $accidentes_dato['observformacont_ace'];
    $matercasusalesi_ace = $accidentes_dato['agentematerialles_aml'];
    $codmatercasusalesi_ace = $accidentes_dato['codagentematles_aml'];
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


if ($fechabaja_ace == '0001-01-01' ) {
    $fechabaja_ace = 'N/A';
} else {
    $fechabaja_ace = $fechabaja_ace;
}


if ($fechaantesrecaida_ace == '0001-01-01') {
    $fechaantesrecaida_ace = 'N/A';
} else {
    $fechaantesrecaida_ace = $fechaantesrecaida_ace;
}


///// traer datos de accionprl

$pdf = new FPDI();

# Pagina 1  (X-horizontal Y-vertical)
$pdf->AddPage();
$pdf->setSourceFile('Files_Pdf/08_05_2024_investaccidente-A.pdf');
$tplIdx1 = $pdf->importPage(1);
$pdf->useTemplate($tplIdx1); 

$pdf->SetFont('helvetica', '', '8'); 
$pdf->SetXY(33, 46);
$nroaccidente_ace = mb_convert_encoding($nroaccidente_ace, 'ISO-8859-1', 'UTF-8');
$pdf->Write(10, $nroaccidente_ace);

$pdf->SetFont('helvetica', '', '8');
$pdf->SetXY(62, 46);
$tipoaccidente_ace = mb_convert_encoding($tipoaccidente_ace, 'ISO-8859-1', 'UTF-8');
$pdf->Write(10, $tipoaccidente_ace);

$pdf->SetFont('helvetica', '', '8');
$pdf->SetXY(135, 46);
$centro_ace = mb_convert_encoding($centro_ace, 'ISO-8859-1', 'UTF-8');
$pdf->Write(10, $centro_ace);

$pdf->SetFont('helvetica', '', '8');
$pdf->SetXY(75, 64);
$trabajador_ace = mb_convert_encoding($trabajador_ace, 'ISO-8859-1', 'UTF-8');
$pdf->Write(10, $trabajador_ace);

$pdf->SetFont('helvetica', '', '8');
$pdf->SetXY(75, 69);
$dni_trabajador_ace = mb_convert_encoding($dni_trabajador_ace, 'ISO-8859-1', 'UTF-8');
$pdf->Write(10, $dni_trabajador_ace);

$pdf->SetFont('helvetica', '', '8');
$pdf->SetXY(75, 74);
$sexo_trabajador_ace = mb_convert_encoding($sexo_trabajador_ace, 'ISO-8859-1', 'UTF-8');
$pdf->Write(10, $sexo_trabajador_ace);

$pdf->SetFont('helvetica', '', '8');
$pdf->SetXY(75, 79);
$inicio_trabajador_ace = mb_convert_encoding(date("d-m-Y", strtotime($inicio_trabajador_ace)), 'ISO-8859-1', 'UTF-8');
$pdf->Write(10, $inicio_trabajador_ace);

$pdf->SetFont('helvetica', '', '8');
$pdf->SetXY(75, 90);
$fechanac_trabajador_ace = mb_convert_encoding(date("d-m-Y", strtotime($fechanac_trabajador_ace)), 'ISO-8859-1', 'UTF-8');
$pdf->Write(10, $fechanac_trabajador_ace);

$pdf->SetFont('helvetica', '', '8');
$pdf->SetXY(75, 100);
$departamento_trabajador_ace = mb_convert_encoding($departamento_trabajador_ace, 'ISO-8859-1', 'UTF-8');
$pdf->Write(10, $departamento_trabajador_ace);

$pdf->SetFont('helvetica', '', '8');
$pdf->SetXY(75, 105);
$categoria_trabajador_ace = mb_convert_encoding($categoria_trabajador_ace, 'ISO-8859-1', 'UTF-8');
$pdf->Write(10, $categoria_trabajador_ace);


$pdf->SetFont('helvetica', '', '8');
$pdf->SetXY(75, 134);
$razonsocial_ace = mb_convert_encoding($razonsocial_ace, 'ISO-8859-1', 'UTF-8');
$pdf->Write(10, $razonsocial_ace);

$pdf->SetFont('helvetica', '', '8');
$pdf->SetXY(75, 139);
$centro_ace = mb_convert_encoding($diadescanso_ace, 'ISO-8859-1', 'UTF-8');
$pdf->Write(10, $centro_ace);
$pdf->SetFont('helvetica', '', '8');
$pdf->SetXY(75, 144);
$modalidadprl_ace = mb_convert_encoding($modalidadprl_ace, 'ISO-8859-1', 'UTF-8');
$pdf->Write(10, $modalidadprl_ace);

$pdf->SetFont('helvetica', 'B', '8');
$pdf->SetXY(18, 169);
$lugar_ace = mb_convert_encoding($lugar_ace, 'ISO-8859-1', 'UTF-8');
$pdf->Write(10, $lugar_ace);
$pdf->SetFont('helvetica', '', '8');
$pdf->SetXY(75, 169);
$detalleslugar_ace = mb_convert_encoding($detalleslugar_ace, 'ISO-8859-1', 'UTF-8');
$pdf->Write(10, $detalleslugar_ace);

$pdf->SetFont('helvetica', '', '8');
$pdf->SetXY(75, 198);
$tipoaccidente_ace = mb_convert_encoding($tipoaccidente_ace, 'ISO-8859-1', 'UTF-8');
$pdf->Write(10, $tipoaccidente_ace);

$pdf->SetFont('helvetica', '', '8');
$pdf->SetXY(75, 203);
$fecha_ace = mb_convert_encoding(date("d-m-Y", strtotime($fecha_ace)), 'ISO-8859-1', 'UTF-8');
$pdf->Write(10, $fecha_ace);

$pdf->SetFont('helvetica', '', '8');
$pdf->SetXY(75, 208);
$fechabaja_ace = mb_convert_encoding(date("d-m-Y", strtotime($fechabaja_ace)), 'ISO-8859-1', 'UTF-8');
$pdf->Write(10, $fechabaja_ace);

$pdf->SetFont('helvetica', '', '8');
$pdf->SetXY(75, 218);
$hora_ace = mb_convert_encoding($hora_ace, 'ISO-8859-1', 'UTF-8');
$pdf->Write(10, $hora_ace);

$pdf->SetFont('helvetica', '', '8');
$pdf->SetXY(165, 218);
$horatrabajo_ace = mb_convert_encoding($horatrabajo_ace, 'ISO-8859-1', 'UTF-8');
$pdf->Write(10, $horatrabajo_ace);

$pdf->SetFont('helvetica', '', '8');
$pdf->SetXY(75, 223);
$trabajohabitual_ace = mb_convert_encoding($trabajohabitual_ace, 'ISO-8859-1', 'UTF-8');
$pdf->Write(10, $trabajohabitual_ace);

$pdf->SetFont('helvetica', '', '8');
$pdf->SetXY(75, 228);
$diadescanso_ace = mb_convert_encoding($diadescanso_ace, 'ISO-8859-1', 'UTF-8');
$pdf->Write(10, $diadescanso_ace);

$pdf->SetFont('helvetica', '', '8');
$pdf->SetXY(75, 234);
$semanadescanso_ace = mb_convert_encoding($semanadescanso_ace, 'ISO-8859-1', 'UTF-8');
$pdf->Write(10, $semanadescanso_ace);

$pdf->SetFont('helvetica', '', '8');
$pdf->SetXY(75, 239);
$isevacuacion_ace = mb_convert_encoding($isevacuacion_ace, 'ISO-8859-1', 'UTF-8');
$pdf->Write(10, $isevacuacion_ace);

$pdf->SetFont('helvetica', '', '8');
$pdf->SetXY(75, 244);
$isevaluadoriesgo_ace = mb_convert_encoding($isevaluadoriesgo_ace, 'ISO-8859-1', 'UTF-8');
$pdf->Write(10, $isevaluadoriesgo_ace);

$pdf->SetFont('helvetica', '', '8');
$pdf->SetXY(75, 249);
$isrecaida_ace = mb_convert_encoding($isrecaida_ace, 'ISO-8859-1', 'UTF-8');
$pdf->Write(10, $isrecaida_ace);

$pdf->SetFont('helvetica', '', '8');
$pdf->SetXY(175, 249);
$fechaantesrecaida_ace = mb_convert_encoding($fechaantesrecaida_ace, 'ISO-8859-1', 'UTF-8');
$pdf->Write(10, $fechaantesrecaida_ace);


# Pagina 2
$pdf->AddPage();
$tplIdx2 = $pdf->importPage(2);
$pdf->useTemplate($tplIdx2);  

$pdf->SetFont('helvetica', '', '7'); 
$pdf->SetXY(24, 52);
$descripcion_ace = mb_convert_encoding($descripcion_ace, 'ISO-8859-1', 'UTF-8');
$pdf->Write(3,$descripcion_ace);

$pdf->SetFont('helvetica', '', '7');
$pdf->SetXY(88, 67);
$tipolugar_ace = mb_convert_encoding($tipolugar_ace, 'ISO-8859-1', 'UTF-8');
$pdf->Write(10, $tipolugar_ace);

$pdf->SetFont('helvetica', '', '7');
$pdf->SetXY(75, 67);
$codtipolugar_ace = mb_convert_encoding($codtipolugar_ace, 'ISO-8859-1', 'UTF-8');
$pdf->Write(8, $codtipolugar_ace);

$pdf->SetFont('helvetica', '', '7');
$pdf->SetXY(75, 77);
$observaclugar_ace = mb_convert_encoding($observaclugar_ace, 'ISO-8859-1', 'UTF-8');
$pdf->Write(10, $observaclugar_ace);

$pdf->SetFont('helvetica', '', '7');
$pdf->SetXY(88, 83);
$procesotrabajo_ace = mb_convert_encoding($procesotrabajo_ace, 'ISO-8859-1', 'UTF-8');
$pdf->Write(10, $procesotrabajo_ace);

$pdf->SetFont('helvetica', '', '7');
$pdf->SetXY(75, 83);
$codprocesotrabajo_ace = mb_convert_encoding($codprocesotrabajo_ace, 'ISO-8859-1', 'UTF-8');
$pdf->Write(10, $codprocesotrabajo_ace);

$pdf->SetFont('helvetica', '', '7');
$pdf->SetXY(75, 88);
$observproceso_ace = mb_convert_encoding($observproceso_ace, 'ISO-8859-1', 'UTF-8');
$pdf->Write(10, $observproceso_ace);

$pdf->SetFont('helvetica', '', '7');
$pdf->SetXY(75, 93);
$codtipoactividad_ace = mb_convert_encoding($codtipoactividad_ace, 'ISO-8859-1', 'UTF-8');
$pdf->Write(10, $codtipoactividad_ace);

$pdf->SetFont('helvetica', '', '7');
$pdf->SetXY(88, 93);
$tipoactividad_ace = mb_convert_encoding($tipoactividad_ace, 'ISO-8859-1', 'UTF-8');
$pdf->Write(10, $tipoactividad_ace);


$pdf->SetFont('helvetica', '', '7');
$pdf->SetXY(75, 98);
$observtipoactiv_ace = mb_convert_encoding($observtipoactiv_ace, 'ISO-8859-1', 'UTF-8');
$pdf->Write(10, $observtipoactiv_ace);

$pdf->SetFont('helvetica', '', '7');
$pdf->SetXY(75, 103);
$codagentematerial_ace = mb_convert_encoding($codagentematerial_ace, 'ISO-8859-1', 'UTF-8');
$pdf->Write(10, $codagentematerial_ace);

$pdf->SetFont('helvetica', '', '7');
$pdf->SetXY(88, 103);
$agentematerial_ace = mb_convert_encoding($agentematerial_ace, 'ISO-8859-1', 'UTF-8');
$pdf->Write(10, $agentematerial_ace);

$pdf->SetFont('helvetica', '', '7');
$pdf->SetXY(75, 109);
$observagmaterial_ace = mb_convert_encoding($observagmaterial_ace, 'ISO-8859-1', 'UTF-8');
$pdf->Write(10, $observagmaterial_ace);

$pdf->SetFont('helvetica', '', '7');
$pdf->SetXY(75, 114);
$coddesviacion_ace = mb_convert_encoding($coddesviacion_ace, 'ISO-8859-1', 'UTF-8');
$pdf->Write(10, $coddesviacion_ace);

$pdf->SetFont('helvetica', '', '7');
$pdf->SetXY(88, 114);
$desviacion_ace = mb_convert_encoding($desviacion_ace, 'ISO-8859-1', 'UTF-8');
$pdf->Write(10, $desviacion_ace);

$pdf->SetFont('helvetica', '', '7');
$pdf->SetXY(75, 119);
$observdesviacion_ace = mb_convert_encoding($observdesviacion_ace, 'ISO-8859-1', 'UTF-8');
$pdf->Write(10, $observdesviacion_ace);

$pdf->SetFont('helvetica', '', '7');
$pdf->SetXY(75, 125);
$codagmaterdesv_ace = mb_convert_encoding($codagmaterdesv_ace, 'ISO-8859-1', 'UTF-8');
$pdf->Write(10, $codagmaterdesv_ace);

$pdf->SetFont('helvetica', '', '7');
$pdf->SetXY(88, 125);
$agmaterdesv_ace = mb_convert_encoding($agmaterdesv_ace, 'ISO-8859-1', 'UTF-8');
$pdf->Write(10, $agmaterdesv_ace);

$pdf->SetFont('helvetica', '', '7');
$pdf->SetXY(75, 130);
$observagendesv_ace = mb_convert_encoding($observagendesv_ace, 'ISO-8859-1', 'UTF-8');
$pdf->Write(10, $observagendesv_ace);

$pdf->SetFont('helvetica', '', '7');
$pdf->SetXY(75, 135);
$codformacontacto_ace = mb_convert_encoding($codformacontacto_ace, 'ISO-8859-1', 'UTF-8');
$pdf->Write(10, $codformacontacto_ace);

$pdf->SetFont('helvetica', '', '7');
$pdf->SetXY(88, 135);
$formacontacto_ace = mb_convert_encoding($formacontacto_ace, 'ISO-8859-1', 'UTF-8');
$pdf->Write(10, $formacontacto_ace);

$pdf->SetFont('helvetica', '', '7');
$pdf->SetXY(75, 140);
$observformacont_ace = mb_convert_encoding($observformacont_ace, 'ISO-8859-1', 'UTF-8');
$pdf->Write(10, $observformacont_ace);

$pdf->SetFont('helvetica', '', '7');
$pdf->SetXY(75, 145);
$codmatercasusalesi_ace = mb_convert_encoding($codmatercasusalesi_ace, 'ISO-8859-1', 'UTF-8');
$pdf->Write(10, $codmatercasusalesi_ace);

$pdf->SetFont('helvetica', '', '7');
$pdf->SetXY(88, 145);
$matercasusalesi_ace = mb_convert_encoding($matercasusalesi_ace, 'ISO-8859-1', 'UTF-8');
$pdf->Write(10, $matercasusalesi_ace);

$pdf->SetFont('helvetica', '', '7');
$pdf->SetXY(75, 151);
$observmatlesi_ace = mb_convert_encoding($observmatlesi_ace, 'ISO-8859-1', 'UTF-8');
$pdf->Write(10, $observmatlesi_ace);

$pdf->SetFont('helvetica', '', '7');
$pdf->SetXY(75, 157);
$numtrafectados_ace = mb_convert_encoding($numtrafectados_ace, 'ISO-8859-1', 'UTF-8');
$pdf->Write(10, $numtrafectados_ace);

$pdf->SetFont('helvetica', '', '7'); 
$pdf->SetXY(24, 170);
$declaraciontrab_ace = mb_convert_encoding($declaraciontrab_ace, 'ISO-8859-1', 'UTF-8');
$pdf->Write(3,$declaraciontrab_ace);

$pdf->SetFont('helvetica', '', '7');
$pdf->SetXY(75, 178);
$istestigos_ace = mb_convert_encoding($istestigos_ace, 'ISO-8859-1', 'UTF-8');
$pdf->Write(10, $istestigos_ace);

$pdf->SetFont('helvetica', '', '7');
$pdf->SetXY(75, 183);
$detallestestigo_ace = mb_convert_encoding($detallestestigo_ace, 'ISO-8859-1', 'UTF-8');
$pdf->Write(10, $detallestestigo_ace);

$pdf->SetFont('helvetica', '', '7'); 
$pdf->SetXY(24, 201);
$declaraciontestigo_ace = mb_convert_encoding($declaraciontestigo_ace, 'ISO-8859-1', 'UTF-8');
$pdf->Write(3,$declaraciontestigo_ace);

$pdf->SetFont('helvetica', '', '7');
$pdf->SetXY(75, 228);
$tipolesion_ace = mb_convert_encoding($tipolesion_ace, 'ISO-8859-1', 'UTF-8');
$pdf->Write(10, $tipolesion_ace);

$pdf->SetFont('helvetica', '', '7');
$pdf->SetXY(75, 233);
$gradolesion_ace = mb_convert_encoding($gradolesion_ace, 'ISO-8859-1', 'UTF-8');
$pdf->Write(10, $gradolesion_ace);

$pdf->SetFont('helvetica', '', '7');
$pdf->SetXY(75, 238);
$partecuerpo_ace = mb_convert_encoding($partecuerpo_ace, 'ISO-8859-1', 'UTF-8');
$pdf->Write(10, $partecuerpo_ace);

$pdf->SetFont('helvetica', '', '7');
$pdf->SetXY(75, 243);
$isevacuacion_ace = mb_convert_encoding($isevacuacion_ace, 'ISO-8859-1', 'UTF-8');
$pdf->Write(10, $isevacuacion_ace);

$pdf->SetFont('helvetica', '', '7');
$pdf->SetXY(75, 248);
$lugarevacuacion_ace = mb_convert_encoding($lugarevacuacion_ace, 'ISO-8859-1', 'UTF-8');
$pdf->Write(10, $lugarevacuacion_ace);

$pdf->SetFont('helvetica', '', '7');
$pdf->SetXY(75, 254);
$centromedico_ace = mb_convert_encoding($centromedico_ace, 'ISO-8859-1', 'UTF-8');
$pdf->Write(10, $centromedico_ace);

$pdf->SetFont('helvetica', '', '7');
$pdf->SetXY(75, 259);
$detallescentromed_ace = mb_convert_encoding($detallescentromed_ace, 'ISO-8859-1', 'UTF-8');
$pdf->Write(10, $detallescentromed_ace);

$pdf->SetFont('helvetica', '', '7');
$pdf->SetXY(75, 264);
$recomedincorp_ace = mb_convert_encoding($recomedincorp_ace, 'ISO-8859-1', 'UTF-8');
$pdf->Write(10, $recomedincorp_ace);


# Pagina 3
$pdf->AddPage();
$tplIdx2 = $pdf->importPage(3);
$pdf->useTemplate($tplIdx2);  

$pdf->SetFont('helvetica', '', '8'); 
$pdf->SetXY(155, 47);
$istrinformado_ace = mb_convert_encoding($istrinformado_ace, 'ISO-8859-1', 'UTF-8');
$pdf->Write(3,$istrinformado_ace);

$pdf->SetFont('helvetica', '', '8');
$pdf->SetXY(155, 48);
$istrformado_ace = mb_convert_encoding($istrformado_ace, 'ISO-8859-1', 'UTF-8');
$pdf->Write(10, $istrformado_ace);

$pdf->SetFont('helvetica', '', '8');
$pdf->SetXY(75, 54);
$protcolectivadisp_ace = mb_convert_encoding($protcolectivadisp_ace, 'ISO-8859-1', 'UTF-8');
$pdf->Write(10, $protcolectivadisp_ace);

$pdf->SetFont('helvetica', '', '8');
$pdf->SetXY(75, 59);
$protcolecnecesa_ace = mb_convert_encoding($protcolecnecesa_ace, 'ISO-8859-1', 'UTF-8');
$pdf->Write(10, $protcolecnecesa_ace);

$pdf->SetFont('helvetica', '', '8');
$pdf->SetXY(75, 64);
$observprotcol_ace = mb_convert_encoding($observprotcol_ace, 'ISO-8859-1', 'UTF-8');
$pdf->Write(10, $observprotcol_ace);

$pdf->SetFont('helvetica', '', '8');
$pdf->SetXY(75, 69);
$episdispon_ace = mb_convert_encoding($episdispon_ace, 'ISO-8859-1', 'UTF-8');
$pdf->Write(10, $episdispon_ace);

$pdf->SetFont('helvetica', '', '8');
$pdf->SetXY(75, 75);
$episneces_ace = mb_convert_encoding($episneces_ace, 'ISO-8859-1', 'UTF-8');
$pdf->Write(10, $episneces_ace);

$pdf->SetFont('helvetica', '', '8');
$pdf->SetXY(75, 80);
$observepis_ace = mb_convert_encoding($observepis_ace, 'ISO-8859-1', 'UTF-8');
$pdf->Write(10, $observepis_ace);

$pdf->SetFont('helvetica', '', '7');
$pdf->SetXY(20, 92);
$causaaccidente_ace = mb_convert_encoding($causaaccidente_ace, 'ISO-8859-1', 'UTF-8');
$pdf->Write(3, $causaaccidente_ace);

$pdf->SetFont('helvetica', '', '8');
$pdf->SetXY(20, 110);
$porquecausa_ace = mb_convert_encoding($porquecausa_ace, 'ISO-8859-1', 'UTF-8');
$pdf->Write(3, $porquecausa_ace);

$pdf->SetFont('helvetica', '', '8');
$pdf->SetXY(20, 119);
$quiencontrolcausa_ace = mb_convert_encoding($quiencontrolcausa_ace, 'ISO-8859-1', 'UTF-8');
$pdf->Write(10, $quiencontrolcausa_ace);

$pdf->SetFont('helvetica', '', '8');
$pdf->SetXY(20, 135);
$conclusionacci_ace = mb_convert_encoding($conclusionacci_ace, 'ISO-8859-1', 'UTF-8');
$pdf->Write(3, $conclusionacci_ace);

$pdf->SetFont('helvetica', '', '8');
$pdf->SetXY(20, 152);
$medidasprev_ace = mb_convert_encoding($medidasprev_ace, 'ISO-8859-1', 'UTF-8');
$pdf->Write(3, $medidasprev_ace);

$pdf->SetFont('helvetica', '', '8');
$pdf->SetXY(20, 175);
$valoracionmedida_ace = mb_convert_encoding($valoracionmedida_ace, 'ISO-8859-1', 'UTF-8');
$pdf->Write(3, $valoracionmedida_ace);


$pdf->SetFont('helvetica', '', '8');
$pdf->SetXY(75, 195);
$histaccult12mes_ace = mb_convert_encoding($histaccult12mes_ace, 'ISO-8859-1', 'UTF-8');
$pdf->Write(10, $histaccult12mes_ace);

$pdf->SetFont('helvetica', '', '8');
$pdf->SetXY(75, 200);
$histpuestoacc_ace = mb_convert_encoding($histpuestoacc_ace, 'ISO-8859-1', 'UTF-8');
$pdf->Write(10, $histpuestoacc_ace);

$pdf->SetFont('helvetica', '', '8');
$pdf->SetXY(75, 205);
$histpuestoacc_ace = mb_convert_encoding($histpuestoacc_ace, 'ISO-8859-1', 'UTF-8');
$pdf->Write(10, $histpuestoacc_ace);

$pdf->SetFont('helvetica', '', '8');
$pdf->SetXY(75, 210);
$histcausaacc_ace = mb_convert_encoding($histcausaacc_ace, 'ISO-8859-1', 'UTF-8');
$pdf->Write(10, $histcausaacc_ace);

$pdf->SetFont('helvetica', '', '8');
$pdf->SetXY(75, 216);
$histmedidaacc_ace = mb_convert_encoding($histmedidaacc_ace, 'ISO-8859-1', 'UTF-8');
$pdf->Write(10, $histmedidaacc_ace);

$pdf->SetFont('helvetica', '', '8');
$pdf->SetXY(75, 240);
$investigador_ace = mb_convert_encoding($investigador_ace, 'ISO-8859-1', 'UTF-8');
$pdf->Write(10, $investigador_ace);

$pdf->SetFont('helvetica', '', '8');
$pdf->SetXY(75, 245);
$cargoinvesiga_ace = mb_convert_encoding($cargoinvesiga_ace, 'ISO-8859-1', 'UTF-8');
$pdf->Write(10, $cargoinvesiga_ace);

$pdf->SetFont('helvetica', '', '8');
$pdf->SetXY(75, 250);
$fechainvestiga_ace = mb_convert_encoding(date("d-m-Y", strtotime($fechainvestiga_ace)), 'ISO-8859-1', 'UTF-8');
$pdf->Write(10, $fechainvestiga_ace);

$pdf->SetFont('helvetica', '', '8');
$pdf->SetXY(75, 255);
$fechacumplimen_ace = mb_convert_encoding(date("d-m-Y", strtotime($fechacumplimen_ace)), 'ISO-8859-1', 'UTF-8');
$pdf->Write(10, $fechacumplimen_ace);

$pdf->SetFont('helvetica', '', '8');
$pdf->SetXY(75, 266);
$revisadopor_ace = mb_convert_encoding($revisadopor_ace, 'ISO-8859-1', 'UTF-8');
$pdf->Write(10, $revisadopor_ace);

$pdf->SetFont('helvetica', '', '8');
$pdf->SetXY(75, 271);
$fecharevision_ace = mb_convert_encoding(date("d-m-Y", strtotime($fecharevision_ace)), 'ISO-8859-1', 'UTF-8');
$pdf->Write(10, $fecharevision_ace);







// setFont ('B' - NEGRITA 
//setFont ('I' - ITALICA 
//setFont ('S' - SUBRAYA 


$pdf->Output('Files_Pdf/SOLICITUD_ASISTENCIA_MUTUA_TRASMAPI.pdf', 'D'); //SALIDA DEL PDF
//    $pdf->Output('original_update.pdf', 'F');
//    $pdf->Output('original_update.pdf', 'I'); //PARA ABRIL EL PDF EN OTRA VENTANA
//	  $pdf->Output('original_update.pdf', 'D'); //PARA FORZAR LA DESCARGA
