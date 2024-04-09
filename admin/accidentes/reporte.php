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
include('../../app/controllers/accidentes/datos_accidente.php');
$id_accidente = $_GET['id_accidente'];
include('../../app/controllers/trabajadores/listado_trabajadores.php');
include('../../app/controllers/maestros/centros/listado_centros.php');
include('../../app/controllers/maestros/accidentes/listado_actividadfisica.php');
include('../../app/controllers/maestros/accidentes/listado_agentematerial.php');
include('../../app/controllers/maestros/accidentes/listado_agentematerialdesv.php');
include('../../app/controllers/maestros/accidentes/listado_agentematerialles.php');
include('../../app/controllers/maestros/accidentes/listado_desviacion.php');
include('../../app/controllers/maestros/accidentes/listado_formacontacto.php');
include('../../app/controllers/maestros/accidentes/listado_gravedad.php');
include('../../app/controllers/maestros/accidentes/listado_partecuerpo.php');
include('../../app/controllers/maestros/accidentes/listado_tipolesion.php');
include('../../app/controllers/maestros/accidentes/listado_procesotrabajo.php');
include('../../app/controllers/maestros/accidentes/listado_tipolugar.php');
include('../../app/controllers/maestros/accidentes/listado_tipoaccidente.php');
include('../../app/controllers/maestros/accidentes/listado_gravedad.php');


///// traer datos de accion prl
foreach ($accidentes_datos as $accidentes_dato) {
    $nroaccidente_ace = $accidentes_dato['nroaccidente_ace'];
    $comunicado_ace = $accidentes_dato['comunicado_ace'];
    $trabajador_ace = $accidentes_dato['nombre_tr'];
    $dni_trabajador_ace = $accidentes_dato['dni_tr'];
    $sexo_trabajador_ace = $accidentes_dato['sexo_tr'];
    $fechanac_trabajador_ace = $accidentes_dato['fechanac_tr'];
    $inicio_trabajador_ace = $accidentes_dato['inicio_tr'];
    $categoria_trabajador_ace = $accidentes_dato['nombre_cat'];
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
    $observagmaterial_ace = $accidentes_dato['observagmaterial_ace'];
    $desviacion_ace = $accidentes_dato['desviacion_des'];
    $observdesviacion_ace = $accidentes_dato['observdesviacion_ace'];
    $agmaterdesv_ace = $accidentes_dato['agentematerialdesv_amd'];
    $agentematerial_ace2 = $accidentes_dato['codagentemat_am'];
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
///// traer datos de accionprl





///// traer datos de centro trabajo

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

$PDF_HEADER_TITLE = 'INFORME DE INVESTIGACION Y ANÁLISIS DE SUCESOS';
$PDF_HEADER_STRING ='Modelo según Orden T.A.S./2926/2002';
$PDF_HEADER_LOGO = 'LOGO TRASMAPI.jpg';
// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('HS BASE');
$pdf->SetTitle('Report Accion Correctora');
$pdf->SetSubject('HSBASE');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
$pdf->SetHeaderData($PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, $PDF_HEADER_TITLE, $PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set font
$pdf->SetFont('helvetica', '', 9);

//Cell($w, $h=0, $txt='', $border=0, $ln=0, $align='', $fill=0, $link='', $stretch=0, $ignore_min_height=false, $calign='T', $valign='M')


//create some HTML content
$html ='
<style>
    table.first {
        color: #ffffff;
        font-family: helvetica;
        font-size:9pt;
        border-left: 2px solid #0069d2;
        border-right: 2px solid #0069d2;
        border-top: 2px solid #0069d2;
        border-bottom: 2px solid #0069d2;
        background-color: #0069d2;
    }
    td.fila {
        color: #000000;
        font-family: helvetica;
        font-size: 8pt;
        background-color: #aed7ff;
          }
    td.fila1 {
        height: 18px;
        widht: 150px;
        color: #000000;
        font-family: helvetica;
        font-size: 8pt;
        vertical-align: middle;
        border-top: 1px solid #0069d2;
        border-bottom: 1px solid #0069d2;
        background-color: #ffffff;
        text-align:left;


           
    </style>

<br>
<table class="first">
<tr>
<td style="height: 18px; width: 80px; background-color: #aed7ff; text-align: center"><b>Informe nº: </b></td>
<td style= "height: 18px;  width: 80px; background-color: #ffffff; text-align: center">'.$nroaccidente_ace.'</td>
<td style= "height: 18px;  width: 200px; background-color: #ffffff; text-align: left">'.$tipoaccidente_ace.'</td>
<td style="height: 18px;  width: 80px; background-color: #aed7ff; text-align: center"><b>Centro: </b></td>
<td style="height: 18px;  width: 200px; background-color: #ffffff; text-align: center">'.$centro_ace.'</td>

</tr>
</table>
<p></p>

<table class="first">
<tr>
<td class="linia" width="640px"><b>  1. DATOS DEL TRABAJADOR:</b></td>
</tr>
</table>

<table class="first">
<tr class="fila">
<td class="fila" width="200px"><b> Trabajador:</b></td>
<td class="fila1" width="440px">' .$trabajador_ace.'</td>
</tr>
<tr>
<td class="fila"><b> DNI/NIE:</b></td>
<td class="fila1">' .$dni_trabajador_ace.'</td>
</tr>
<tr>
<td class="fila"><b> Sexo:</b></td>
<td class="fila1">' .$sexo_trabajador_ace.'</td>
</tr>
<tr>
<td class="fila"><b> Fecha primer ingreso:</b></td>
<td class="fila1">' .$inicio_trabajador_ace.'</td>
</tr>
<tr>
<td class="fila"><b> Nacionalidad:</b></td>
<td class="fila1">' .$trabajador_ace.'</td>
</tr>
<tr>
<td style="width: 200px; height: 18px; color: #000000;background-color: #aed7ff; text-align: left"><b> Fecha nacimiento:</b></td>
<td style="width: 160px; height: 18px;border-bottom: 1px solid #0069d2; color: #000000; background-color: #ffffff; text-align: left">' .$fechanac_trabajador_ace.'</td>
<td style="width: 80px; height: 18px;color: #000000; background-color: #aed7ff; text-align: left"><b>  Años:</b></td>
<td style="width: 200px; height: 18px; color: #000000;border-bottom: 1px solid #0069d2; background-color: #ffffff; text-align: left">' .'</td>
</tr>
<tr>
<td class="fila"><b> Departamento:</b></td>
<td class="fila1" width="440px">' .$departamento_trabajador_ace.'</td>
</tr>
<tr>
<td class="fila"><b> Puesto de trabajo:</b></td>
<td class="fila1">' .$categoria_trabajador_ace.'</td>
</tr>
<tr>
<td class="fila"><b> Telefono particular:</b></td>
<td class="fila1">'.'</td>
</tr>
</table>

<br><br>

<table class="first">
<tr>
<td style="width: 640px;height: 18px; color:#ffffff; background-color: #0069d2; text-align: left; text-color:#ffffff"><b>  2. DATOS DE LA EMPRESA:</b></td>
</tr>
</table>

<table class="first">
<tr>
<td class="fila" width="200px"><b> Nombre empresa:</b></td>
<td class="fila1" width="440px">'.$razonsocial_ace.'</td>
</tr>
<tr>
<td class="fila"><b> Centro de trabajo:</b></td>
<td class="fila1">'.$centro_ace.'</td>
</tr>
<tr>
<td class="fila"><b> Modalidad preventiva:</b></td>
<td class="fila1">'.$modalidadprl_ace.'</td>
</tr>
</table>
<br>
<br>
<table class="first">
<tr>
<td style="width: 640px;height: 18px; color:#ffffff; background-color: #0069d2;border-bottom: 1px solid #0069d2; text-align: left; text-color:#ffffff"><b>  3. LUGAR Y/O CENTRO DE TRABAJO DONDE SE HA PRODUCIDO EL ACCIDENTE:</b></td>
</tr>
</table>
<table class="first">
<tr>
<td class="fila" width="200px"><b> Lugar:</b></td>
<td class="fila1" width="440px">'.$lugar_ace.'</td>
</tr>
<tr>
<td class="fila"><b> Detalles:</b></td>
<td class="fila1">'.$detalleslugar_ace.'</td>
</tr>
</table>
<br><br>
<table class="first">
<tr>
<td style="width: 640px;height: 18px; color:#ffffff; background-color: #0069d2; text-align: left; text-color:#ffffff"><b>  4. DATOS DEL SUCESO (1)</b></td>
</tr>
</table>
<table class="first">
<tr>
<td class="fila" width="200px"><b> Tipo de suceso:</b></td>
<td class="fila1" width="440px">'.$tipoaccidente_ace.'</td>
</tr>
<tr>
<td class="fila" width="200px"><b> Fecha del suceso</b></td>
<td class="fila1" width="440px">'.$fecha_ace.'</td>
</tr>
<tr>
<td class="fila" width="200px"><b> Fecha de la baja médica</b></td>
<td class="fila1" width="440px">'.$fecha_ace.'</td>
</tr>
<tr>
<td style="width: 200px; height: 18px; color: #000000;background-color: #aed7ff; text-align: left"><b> Hora del suceso</b></td>
<td style="width: 160px; height: 18px;border-bottom: 1px solid #0069d2; color: #000000; background-color: #ffffff; text-align: left">' .$hora_ace.'</td>
<td style="width: 80px; height: 18px;color: #000000; background-color: #aed7ff; text-align: left"><b>  Hora trab.</b></td>
<td style="width: 200px; height: 18px; color: #000000;border-bottom: 1px solid #0069d2; background-color: #ffffff; text-align: left">' .$horatrabajo_ace.'</td>
</tr>
<tr>
<td class="fila" width="200px"><b> Día del último descanso</b></td>
<td class="fila1" width="440px">'.$diadescanso_ace.'</td>
</tr>
<tr>
<td class="fila" width="200px"><b> De hace cuantas semanas</b></td>
<td class="fila1" width="440px">'.$semanadescanso_ace.'</td>
</tr>
<tr>
<td class="fila" width="200px"><b> Dispone de eval. de riesgos del puesto</b></td>
<td class="fila1" width="440px">'.$isevaluadoriesgo_ace.'</td>
</tr>
<tr>
<td class="fila" width="200px"><b> La evaluacion contempla este riesgo</b></td>
<td class="fila1" width="440px">'.$evalconriesgo_ace.'</td>
</tr>
<tr>
<td class="fila" width="200px"><b> Es un recaida</b></td>
<td style="width: 160px; height: 18px; color: #000000;background-color: #ffffff; text-align: left">' .$isrecaida_ace.'</td>
<td style="width: 150px; height: 18px; color: #000000;background-color: #aed7ff; text-align: left"><b>  Fecha accidente inicial</b></td>
<td style="width: 130; height: 18px; color: #000000; border-right: 1px solid #0069d2;background-color: #ffffff; text-align: left">' .$fechaantesrecaida_ace.'</td>
</tr>
</table>
<br>
<br>
<table class="first">
<tr>
<td style="width: 640px;height: 18px; color:#ffffff; background-color: #0069d2; text-align: left; text-color:#ffffff"><b>  4. DATOS DEL SUCESO (2)</b></td>
</tr>
</table>

<table class="first">
<tr>
<td style="width: 640px; height: 18px; color:#000000; background-color: #aed7ff; text-align: left"><b> Descripción del suceso (Breve descripción de los hechos y forma en la que se produjo el suceso</b></td>
</tr>
<tr>
<td style="width: 640px; height: 54px; color:#000000; background-color: #ffffff; text-align: left"> '.$descripcion_ace.'</td>
</tr>
<tr>
<td class="fila" width="200px"><b> Tipo de lugar</b></td>
<td class="fila1" width="440px">'.$tipolugar_ace2.' - '.$tipolugar_ace.'</td>
</tr>
<tr>
<td class="fila" width="200px"><b> Zona donde se produce el suceso</b></td>
<td class="fila1" width="440px">'.$zonalugar_ace.'</td>
</tr>
<tr>
<td class="fila" width="200px"> Observ. del lugar</td>
<td class="fila1" width="440px">'.$observaclugar_ace.'</td>
</tr>
<tr>
<td class="fila" width="200px"><b> Procesos de trabajo</b></td>
<td class="fila1" width="440px">'.$procesotrabajo_ace2.' - '.$procesotrabajo_ace.'</td>
</tr>
<tr>
<td class="fila" width="200px"> Observ. al proceso de trabajo</td>
<td class="fila1" width="440px">'.$observproceso_ace.'</td>
</tr>
<tr>
<td class="fila" width="200px"><b> Tipo de actividad</b></td>
<td class="fila1" width="440px">'.$tipoactividad_ace2.' - '.$tipoactividad_ace.'</td>
</tr>
<tr>
<td class="fila" width="200px"> Observ. al tipo actividad</td>
<td class="fila1" width="440px">'.$observtipoactiv_ace.'</td>
</tr>
<tr>
<td class="fila" width="200px"><b> Agente material asoc. a la actividad</b></td>
<td class="fila1" width="440px">'.$agentematerial_ace2.' - '.$agentematerial_ace.'</td>
</tr>
<tr>
<td class="fila" width="200px"> Obser. al agente asoc. a la actividad</td>
<td class="fila1" width="440px">'.$observagmaterial_ace.'</td>
</tr>
</table>
<br>
<br>
<br>
<br>
<br>
<table class="first">
<tr>
<td style="width: 640px;height: 18px; color:#ffffff; background-color: #0069d2; text-align: left; text-color:#ffffff"><b>  4. DATOS DEL SUCESO (3)</b></td>
</tr>
</table>
<table class="first">
<tr>
<td class="fila" width="200px"><b> Tipo de desviación producida</b></td>
<td class="fila1" width="440px">'.$desviacion_ace.'</td>
</tr>
<tr>
<td class="fila" width="200px"> Obser. la observación producida</td>
<td class="fila1" width="440px">'.$observdesviacion_ace.'</td>
</tr>
<tr>
<td class="fila" width="200px"><b> Agente material asoc. a la desviacion</b></td>
<td class="fila1" width="440px">'.$agmaterdesv_ace.'</td>
</tr>
<tr>
<td class="fila" width="200px"> Observ. agente asociado a la desviac.</td>
<td class="fila1" width="440px">'.$observagendesv_ace.'</td>
</tr>
<tr>
<td class="fila" width="200px"><b> Forma de contacto</b></td>
<td class="fila1" width="440px">'.$formacontacto_ace.'</td>
</tr>
<tr>
<td class="fila" width="200px"> Observaciones a la forma de contacto</td>
<td class="fila1" width="440px">'.$observformacont_ace.'</td>
</tr>
<tr>
<td class="fila" width="200px"><b> Agente material causante de la lesión</b></td>
<td class="fila1" width="440px">'.$matercasusalesi_ace.'</td>
</tr>
<tr>
<td class="fila" width="200px"> Observ. al agente causante de la lesión</td>
<td class="fila1" width="440px">'.$observmatlesi_ace.'</td>
</tr>
<tr>
<td class="fila" width="200px"><b> Núm. de trabajadores afectados</b></td>
<td class="fila1" width="440px">'.$numtrafectados_ace.'</td>
</tr>
<tr>
<td style="width: 640px; height: 18px; color:#000000; font-size: 8pt; background-color: #aed7ff; text-align: left"><b> Declaración del protagonista (exposición de lo que cuenta el trabajador accidentado</b></td>
</tr>
<tr>
<td style="width: 640px; height: 50px; background-color: #ffffff; border-right: 1px solid #0069d2; border-bottom: 1px solid #0069d2; border-left: 1px solid #0069d2; text-align: left">'.$declaraciontrab_ace.'</td>
</tr>
<tr>
<td class="fila" width="200px"><b> Hubo testigos</b></td>
<td class="fila1" width="440px">'.$istestigos_ace.'</td>
</tr>
<tr>
<td class="fila" width="200px"><b> Nombre, puestos de trabajo y telefonos de los testigos</b></td>
<td class="fila1" width="440px">'.$detallestestigo_ace.'</td>
</tr>
<tr>
<td style="width: 640px; height: 18px; color:#000000; font-size: 8pt; background-color: #aed7ff; text-align: left"><b> Declaración de los testigos</b></td>
</tr>
<tr>
<td style="width: 640px; height: 50px; background-color: #ffffff; border-right: 1px solid #0069d2; border-bottom: 1px solid #0069d2; border-left: 1px solid #0069d2; text-align: left">'.$declaraciontestigo_ace.'</td>
</tr>
</table>


<br>
<br>
<table class="first">
<tr>
<td style="width: 640px;height: 18px; color:#ffffff; background-color: #0069d2; text-align: left; text-color:#ffffff"><b>  5. DATOS ASISTENCIALES</b></td>
</tr>
</table>
<table class="first">
<tr>
<td class="fila" width="200px"><b> Descripción de la lesión</b></td>
<td class="fila1" width="440px">'.$tipolesion_ace.'</td>
</tr>
<tr>
<td class="fila" width="200px"><b> Grado de la lesión</b></td>
<td class="fila1" width="440px">'.$gradolesion_ace.'</td>
</tr>
<tr>
<td class="fila" width="200px"><b> Parte del cuerpo lesionada</b></td>
<td class="fila1" width="440px">'.$partecuerpo_ace.'</td>
</tr>
<tr>
<td class="fila" width="200px"><b> Ha sido necesaria su evacuación</b></td>
<td class="fila1" width="50px">' .$isevacuacion_ace.'</td>
<td class="fila" width="180px"><b>  Lugar al que ha sido evacuado</b></td>
<td class="fila1" width="230px">'.$lugarevacuacion_ace.'</td>
</tr>
<tr>
<td class="fila" width="200px"><b> Ha sido asistido en un centro médico</b></td>
<td class="fila1" width="50px">'.$centromedico_ace.'</td>
<td class="fila" width="180px"><b>  Detalles del centro médico</b></td>
<td style="width: 230px; height: 18px;border-bottom: 1px solid #0069d2; color: #000000; background-color: #ffffff; text-align: left">'.$detallescentromed_ace.'</td>
</tr>
<tr>
<td class="fila" width="200px"><b> Recon. medico de reincorporación</b></td>
<td class="fila1" width="50px">'.$recomedincorp_ace.'</td>
<td class="fila" width="180px"><b>  Recon. medico previo (fecha)</b></td>
<td class="fila1" width="230px">'.$recinedtrab_ace.'</td>
</tr>
</table>
<br>
<br>
<br>
<br>
<table class="first">
<tr>
<td style="width: 640px;height: 18px; color:#ffffff; background-color: #0069d2; text-align: left; text-color:#ffffff"><b>  6. DATOS DEL ANÁLISIS DE LAS CAUSAS (1)</b></td>
</tr>
</table>
<table class="first">
<tr>
<td style="width: 230px; height: 18px; background-color: #aed7ff; text-align: left"><b> Tiene informacion PRL (art. 18 LPRL)</b></td>
<td style="width: 100px; height: 18px; background-color: #ffffff; text-align: left">'.$istrformado_ace.'</td>
<td style="width: 230px; height: 18px; background-color: #aed7ff; text-align: left"><b> Tiene formación PRL (art. 19 LPRL)</b></td>
<td style="width: 100px; height: 18px; background-color: #ffffff; text-align: left">'.$istrinformado_ace.'</td>
</tr>

<tr>
<td class="fila" width="200px"><b> Protección colectiva disponible</b></td>
<td style="width: 440px; height: 18px; background-color: #ffffff; text-align: left">'.$protcolectivadisp_ace.'</td>
</tr>
<tr>
<td class="fila" width="200px"><b> Protección colectiva necesaria</b></td>
<td style="width: 440px; height: 18px; background-color: #ffffff; text-align: left">'.$protcolecnecesa_ace.'</td>
</tr>
<tr>
<td class="fila" width="200px"> Observ. de prot. colectiva</td>
<td style="width: 440px; height: 18px; background-color: #ffffff; text-align: left">'.$observprotcol_ace.'</td>
</tr>
<tr>
<td class="fila" width="200px"><b> Protección individual disponible</b></td>
<td style="width: 440px; height: 18px; background-color: #ffffff; text-align: left">'.$episdispon_ace.'</td>
</tr>
<tr>
<td class="fila" width="200px"><b> Protección individual necesaria</b></td>
<td style="width: 440px; height: 18px; background-color: #ffffff; text-align: left">'.$episneces_ace.'</td>
</tr>
<tr>
<td class="fila" width="200px"> Observ. de prot. individual</td>
<td style="width: 440px; height: 18px; background-color: #ffffff; text-align: left">'.$observepis_ace.'</td>
</tr>
<tr>
<td style="width: 640px; height: 18px; background-color: #aed7ff; text-align: left"><b> CAUSAS DIRECTAS DEL ACCIDENTE/INCIDENTE</b></td>
</tr>
<tr>
<td style="width: 640px; height: 30px; background-color: #ffffff; text-align: left">'.$causaaccidente_ace.'</td>
</tr>
<tr>
<td class="fila" width="200px"><b> ¿Por qué causas anteriores?</b></td>
<td style="width: 440px; height: 18px; background-color: #ffffff; text-align: left">'.$porquecausa_ace.'</td>
</tr>
<tr>
<td class="fila" width="200px"><b> ¿Quien tenia control sobre las causas?</b></td>
<td style="width: 440px; height: 18px; background-color: #ffffff; text-align: left">'.$quiencontrolcausa_ace.'</td>
</tr>
</table>
<br><br>
<br>
<br>
<table class="first">
<tr>
<td style="width: 640px;height: 18px; color:#ffffff; background-color: #0069d2; text-align: left; text-color:#ffffff"><b>  6. DATOS DEL ANÁLISIS DE LAS CAUSAS - CONCLUSIONES Y MEDIDAS PREVENTIVAS (2)</b></td>
</tr>
</table>
<table class="first">
<tr>
<tr>
<td style="width: 640px; height: 18px; background-color: #aed7ff; text-align: left"><b> ¿Qué conclusiones se obtienen del análsis del accidente-incidente?</b></td>
</tr>
<tr>
<td style="width: 640px; height: 30px; background-color: #ffffff; text-align: left">'.$conclusionacci_ace.'</td>
</tr>
<tr>
<td style="width: 640px; height: 18px; background-color: #aed7ff; text-align: left"><b> ¿Qué medidas preventivas y de protección deberán adoptarse?</b></td>
</tr>
<tr>
<td style="width: 640px; height: 30px; background-color: #ffffff; text-align: left">'.$medidasprev_ace.'</td>
</tr>
<tr>
<td style="width: 640px; height: 18px; background-color: #aed7ff; text-align: left"><b> Valoración de la eficacia de las medidas</b></td>
</tr>
<tr>
<td style="width: 640px; height: 30px; background-color: #ffffff; text-align: left">'.$valoracionmedida_ace.'</td>
</tr>
</table>
<br>
<br>

<br>
<table class="first">
<tr>
<td style="width: 640px;height: 18px; color:#ffffff; background-color: #0069d2; text-align: left; text-color:#ffffff"><b>  7. HISTÓRICO ACCIDENTES E INCIDENTES</b></td>
</tr>
</table>
<table class="first">
<tr>
<td class="fila" width="200px"><b> Accidentes en los últimos 12 meses</b></td>
<td style="width: 440px; height: 18px; background-color: #ffffff; text-align: left">'.$histaccult12mes_ace.'</td>
</tr>
<tr>
<td class="fila" width="200px"><b> Puesto que se produjeron</b></td>
<td style="width: 440px; height: 18px; background-color: #ffffff; text-align: left">'.$histpuestoacc_ace.'</td>
</tr>
<tr>
<td class="fila" width="200px"><b> Operaciones que se realizaban</b></td>
<td style="width: 440px; height: 18px; background-color: #ffffff; text-align: left">'.$histtrabajosreal_ace.'</td>
</tr>
<tr>
<td class="fila" width="200px"><b> Causas</b></td>
<td style="width: 50px; height: 18px; background-color: #ffffff; text-align: left">'.$histcausaacc_ace.'</td>
<td style="width: 180px; height: 18px; background-color: #aed7ff; text-align: left"><b>  Medidas que se adoptaron</b></td>
<td style="width: 230px; height: 18px; background-color: #ffffff; text-align: left">'.$histmedidaacc_ace.'</td>
</tr>
</table>
<br>
<br>
<br>
<table class="first">
<tr>
<td style="width: 640px;height: 18px; color:#ffffff; background-color: #0069d2; text-align: left; text-color:#ffffff"><b>  8. DATOS ASISTENCIALES</b></td>
</tr>
</table>
<table class="first">
<tr>
<td style="width: 640px; height: 18px; background-color: #aed7ff; text-align: left"><b> Persona que realiza el análisis del suceso:</b></td>
</tr>
<tr>
<td style="width: 200px; height: 18px; background-color: #c0c0c0; text-align: left"><b> Nombre y apellidos</b></td>
<td style="width: 440px; height: 18px; background-color: #ffffff; text-align: left">'.$investigador_ace.'</td>
</tr>
<tr>
<td style="width: 200px; height: 18px; background-color: #c0c0c0; text-align: left"><b> Cargo</b></td>
<td style="width: 440px; height: 18px; background-color: #ffffff; text-align: left">'.$cargoinvesiga_ace.'</td>
</tr>
<tr>
<td style="width: 200px; height: 18px; background-color: #c0c0c0; text-align: left"><b> Fecha investigación</b></td>
<td style="width: 440px; height: 18px; background-color: #ffffff; text-align: left">'.$fechainvestiga_ace.'</td>
</tr>
<tr>
<td style="width: 200px; height: 18px; background-color: #c0c0c0; text-align: left"><b> Fecha cumplimentación</b></td>
<td style="width: 440px; height: 18px; background-color: #ffffff; text-align: left">'.$fechacumplimen_ace.'</td>
</tr>
<tr>
<td style="width: 640px; height: 18px; background-color: #aed7ff; text-align: left"><b> Revisado por:</b></td>
</tr>
<tr>
<td style="width: 200px; height: 18px; background-color: #c0c0c0; text-align: left"><b> Nombre y apellidos / Cargo</b></td>
<td style="width: 440px; height: 18px; background-color: #ffffff; text-align: left">'.$revisadopor_ace.' / '.$cargorevisado_ace.'</td>
</tr>
<tr>
<td style="width: 200px; height: 18px; background-color: #c0c0c0; text-align: left"><b> Fecha revisión</b></td>
<td style="width: 440px; height: 18px; background-color: #ffffff; text-align: left">'.$fecharevision_ace.'</td>
</tr>
</table>

';

$pdf->AddPage();

// ---------------------------------------------------------
// Output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');


//Close and output PDF document
$pdf->Output('hsbase_accion_PRL.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+