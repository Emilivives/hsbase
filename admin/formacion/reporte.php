<?php

// Include the main TCPDF library (search for installation path).
require_once('../../public/TCPDF/tcpdf.php');
$id_formacion_get = $_GET['id_formacion'];
include('../../app/config.php');
include('../../app/controllers/formaciones/cargar_formacion.php');
include('../../app/controllers/maestros/responsables/listado_responsables.php');
include('../../app/controllers/trabajadores/listado_trabajadores.php');
include('../../app/controllers/formaciones/tipoformacion/listado_tipoformaciones.php');


///// traer datos de la formacion

foreach ($formaciondetalle_datos as $formaciondetalle_dato) {
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

    $empresa_fr = $formaciondetalle_dato['razonsocial_emp'];
    $direccionemp_fr = $formaciondetalle_dato['direccion_emp'];
    $logo_emp = $formaciondetalle_dato['logo_emp'];
}

$nroformacion = $formaciondetalle_dato['nroformacion'];

$logo_path = '../maestros/centros/img/' . $formaciondetalle_dato['logo_emp'];
// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);


class CustomPDF extends TCPDF {
    public $logo_path;
    public $empresa_fr;
    public $direccionemp_fr;

    public function setHeaderInfo($logo_path, $empresa_fr, $direccionemp_fr) {
        $this->logo_path = $logo_path;
        $this->empresa_fr = $empresa_fr;
        $this->direccionemp_fr = $direccionemp_fr;
    }
    public function Header() {
        // Obtener dimensiones de la página
        $pageWidth = $this->getPageWidth();
        $leftMargin = $this->original_lMargin; // Margen izquierdo original
        $rightMargin = $this->original_rMargin; // Margen derecho original
        
        // Logo (posición ajustada)
        if (file_exists($this->logo_path)) {
            $this->Image($this->logo_path, 10, 10, 30);
        }
        
        // Texto de la cabecera
        $this->SetY(10);
        $this->SetFont('helvetica', 'B', 12);
        $this->Cell(0, 5, $this->empresa_fr, 0, 1, 'C');
        $this->SetFont('helvetica', '', 10);
        $this->Cell(0, 5, $this->direccionemp_fr, 0, 1, 'C');
        
        // Posición Y después del texto
        $currentY = $this->GetY();
        
        // Líneas decorativas que van de borde a borde
        $fullWidth = $pageWidth - $leftMargin - $rightMargin;
        
        // Línea principal azul (de borde a borde)
        $this->SetLineWidth(0.5);
        $this->SetDrawColor(0, 51, 153);
        $this->Line($leftMargin, $currentY + 2, $pageWidth - $rightMargin, $currentY + 2);
        
        // Línea secundaria gris (de borde a borde)
        $this->SetLineWidth(0.2);
        $this->SetDrawColor(128, 128, 128);
        $this->Line($leftMargin, $currentY + 3, $pageWidth - $rightMargin, $currentY + 3);
        
        // Restaurar configuración
        $this->SetDrawColor(0, 0, 0);
        $this->SetLineWidth(0.2);
        
        // Espacio después de las líneas
        $this->SetY($currentY + 10);
    }
}



// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('HS BASE');
$pdf->SetTitle('Report Accion Correctora');
$pdf->SetSubject('HSBASE');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
$pdf = new CustomPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf->setHeaderInfo($logo_path, $empresa_fr, $direccionemp_fr);

// set header and footer fonts
$pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

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
if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
    require_once(dirname(__FILE__) . '/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set font
$pdf->SetFont('helvetica', '', 9);

//Cell($w, $h=0, $txt='', $border=0, $ln=0, $align='', $fill=0, $link='', $stretch=0, $ignore_min_height=false, $calign='T', $valign='M')


//create some HTML content
$html = '

<h1 style="text-align: center">CERTIFICADO DE FORMACIÓN</h1>

<br>
<p></p>

<table border="0">
<tr>
<td style="height: 30px; background-color: #ffffff; text-align: left"><b>Cod. Formación:</b></td>
<td>' . $nroformacion . ' / ' . $fecha2_fr . '</td>

<td style="height: 30px; background-color: #ffffff; text-align: right"><b>Formación:</b></td>
<td>' . $tipo_fr . '</td>
</tr>
<tr>
<td style="height: 30px; background-color: #ffffff; text-align: left"><b>Fecha formación:</b></td>
<td>' . $fecha_fr . '</td>

<td style="height: 30px; background-color: #ffffff; text-align: right"><b>Vigente hasta:</b></td>
<td>' . $fechacad_fr . '</td>
</tr>
<tr>
<td style="height: 30px; background-color: #ffffff; text-align: left"><b>Formador:</b></td>
<td>' . $formador_fr . ' / ' . $cargoresp_fr . '</td>
<td style="height: 30px; background-color: #ffffff; text-align: right"><b>Duración:</b></td>
<td>' . $duracion_fr . ' hrs.</td>
</tr>
</table>
<table border="0">
<tr>
<td style="width: 630px;  background-color: #ffffff; text-align: left"><b>Temario:</b></td>
</tr>
<tr>
<td style="width: 630px;height: 100px;">' . $detalles_fr . '</td>
</tr>
</table>
<br><br>
<hr>
<h3 style="text-align: left">Asistentes:</h3>

<table border="0">
<tr>
<td style="height: 30px; width: 50px; background-color: #ffffff; text-align: center"><b>Nº.</b></td>
<td style="height: 30px; width: 300px; background-color: #ffffff; text-align: left"><b>APELLIDOS, NOMBRE</b></td>
<td style="height: 30px; width: 150px; background-color: #ffffff; text-align: center"><b>DNI/NIE</b></td>
<td style="height: 30px; width: 150px; background-color: #ffffff; text-align: center"><b>PUESTO Tº</b></td>
</tr>
';
$contador_formasistencia = 0;

$sql_formasistencia = "SELECT *, tr.codigo_tr as codigo_tr FROM form_asistencia AS fas 
INNER JOIN trabajadores AS tr ON fas.idtrabajador_fas = tr.id_trabajador 
INNER JOIN categorias as cat ON tr.categoria_tr = cat.id_categoria WHERE nroformacion = '$nroformacion' ORDER BY tr.nombre_tr ASC";
$query_formasistencia = $pdo->prepare($sql_formasistencia);
$query_formasistencia->execute();
$formasistencia_datos = $query_formasistencia->fetchAll(PDO::FETCH_ASSOC);

foreach ($formasistencia_datos as $formasistencia_dato) {
    $id_formasistencia = $formasistencia_dato['id_formasistencia'];
    $contador_formasistencia = $contador_formasistencia + 1;
    $html .= '
    <tr>
<td style="height: 30px; width: 50px; background-color: #ffffff; text-align: center">' . $contador_formasistencia . '</td>
<td style="height: 20px; width: 300px; background-color: #ffffff; text-align: left">' . $formasistencia_dato['nombre_tr'] . '</td>
<td style="height: 20px; width: 150px; background-color: #ffffff; text-align: center">' . $formasistencia_dato['dni_tr'] . '</td>
<td style="height: 20px; width: 150px; background-color: #ffffff; text-align: center">' . $formasistencia_dato['nombre_cat'] . '</td>
</tr>
    ';
}

$html .= '

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