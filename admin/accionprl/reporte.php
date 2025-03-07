<?php
// Incluir la librería TCPDF
require_once('../../public/TCPDF/tcpdf.php');

// Incluir archivos de configuración y datos
include('../../app/config.php');
include('../../app/controllers/actividad/listado_accionprl.php');
include('../../app/controllers/maestros/centros/listado_centros.php');
$id_accion = $_GET['id_accion'];
include('../../app/controllers/actividad/datos_accionprl.php');
include('../../app/controllers/trabajadores/listado_trabajadores.php');
include('../../app/controllers/maestros/responsables/listado_responsables.php');
include('../../app/controllers/maestros/centros/listado_centros.php');

// Obtener datos de la acción PRL
foreach ($accionprl_datos as $accionprl_dato) {
    $codigo_acc = $accionprl_dato['codigo_acc'];
    $fecha_acc = $accionprl_dato['fecha_acc'];
    $centro_acc = $accionprl_dato['nombre_cen'];
    $nombre_emp = $accionprl_dato['nombre_emp'];
    $razonsocial_emp = $accionprl_dato['razonsocial_emp'];
    $direccion_emp = $accionprl_dato['direccion_emp'];
    $logo_emp = $accionprl_dato['logo_emp'];
    $imagen1_acc = $accionprl_dato['imagen1_acc'];
    $imagen2_acc = $accionprl_dato['imagen2_acc'];
}

// Definir la ruta del logo de la empresa
$logo_path = '../../admin/maestros/centros/img/' . $logo_emp;
$image1 = '../../admin/accionprl/image/' . $imagen1_acc;
$image2 = '../../admin/accionprl/image/' . $imagen2_acc;

// Clase personalizada para modificar la cabecera y el pie de página
class MYPDF extends TCPDF {
    public function Header() {
        global $logo_path, $razonsocial_emp;  // Acceder a las variables globales
    
        // Verificar si el archivo de imagen del logo existe
        if (file_exists($logo_path) && !empty($logo_path)) {
            $this->Image($logo_path, 10, 10, 30); // (X, Y, Ancho)
        }
    
     // Configurar color del texto (Ejemplo: Azul oscuro)
    $this->SetTextColor(109, 109, 109);

    // Configurar fuente y mostrar título centrado
    $this->SetFont('helvetica', 'B', 12);
    $this->Cell(0, 24, $razonsocial_emp, 0, 1, 'C'); // Centrado
    
    // Subir la posición Y antes de la línea
    $yPosition = $this->GetY() - 2; // Mueve la línea 5 unidades hacia arriba

    // Dibujar una línea horizontal debajo del encabezado
    $this->SetLineWidth(0.5); // Grosor de la línea
    $this->Line(10, $yPosition, 200, $yPosition); // Línea más arriba

    $this->Ln(2); // Espacio después de la línea
    }

    // Sobrescribir el Footer() para mostrar la razón social en lugar del número de página
    public function Footer() {
        global $razonsocial_emp, $direccion_emp;

        // Dibujar una línea horizontal debajo del encabezado
        $this->SetLineWidth(0.5); // Grosor de la línea
        $this->Line(10, $this->GetY(), 200, $this->GetY()); // Línea de borde a borde

        // Establecer la fuente
        $this->SetFont('helvetica', '', 8);

        // Posición a 1.5 cm desde el fondo
        $this->SetY(-15);

        // Mostrar la razón social centrada en el pie de página
        $this->Cell(0, 15, $razonsocial_emp.' - '.$direccion_emp, 0, 0, 'C'); // Centrado
    }
}

// Crear nueva instancia del PDF con nuestra clase personalizada
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// Configurar el documento
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('HS BASE');
$pdf->SetTitle('Reporte de Acción Correctora');
$pdf->SetSubject('HSBASE');
$pdf->SetKeywords('TCPDF, PDF, reporte, acción correctora');

// Configurar márgenes
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// Configurar salto automático de página
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// Configurar escala de imágenes
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);


// Definir contenido HTML para el PDF
$pdf->SetFont('helvetica', '', 9);

// HTML para mostrar imágenes y texto
$html = '

<h1 style="text-align: center">ACCIÓN PREVENTIVA / CORRECTORA</h1>

<br>
<p></p>

<table border="0">
<tr>
<td style="height: 20px; background-color: #ffffff; text-align: left"><b>Num. accion PRL:</b></td>
<td>'.$codigo_acc.'</td>
<td><b>Fecha apertura:</b></td>
<td>'.$fecha_acc.'</td>
<td style="height: 20px; background-color: #ffffff; text-align: right"><b>% Avance:</b></td>
<td>'.$avance_acc.'</td>
</tr>

<tr>
<td><b>Centro trabajo:</b></td>
<td>'.$centro_acc.'</td>
<td></td>
<td></td>
<td style="text-align: right"><b>Prioridad:</b></td>
<td>'.$prioridad_acc.'</td>
</tr>
</table>
<br>
<br>
<table border="0">
<tr>
<td style="width: 630px;  background-color: #ffffff; text-align: left"><b>Descripcion:</b></td>
</tr>
<tr>
<td style="width: 630px;height: 60px;">'.$descripcion_acc.'</td>
</tr>
</table>

<br>
<hr>

<table border="0">

<tr>
<td style="width: 150px;height: 20px; background-color: #ffffff; text-align: left"><b>Origen:</b></td>
<td style="width: 480px;height: 20px;">'.$origen_acc.'</td>
</tr>
<tr>
<td style="width: 150px;height: 20px; background-color: #ffffff; text-align: left"><b>Informe procedencia:</b></td>
<td>'.$detalleorigen_acc.'</td>
</tr>
<tr>
<td style="width: 150px;height: 100px;background-color: #ffffff; text-align: left"><b>Accion propuesta:</b></td>
<td>'.$accpropuesta_acc.'</td>
</tr>
<tr>
<td style="width: 150px;height: 20px;background-color: #ffffff; text-align: left"><b>Responsable:</b></td>
<td>'.$responsable_acc.'</td>
</tr>
<tr>
<td style="width: 150px;height: 20px;background-color: #ffffff; text-align: left"><b>Prioridad:</b></td>
<td>'.$prioridad_acc.'</td>
</tr>
</table>

<br>
<hr>
<table border="0">
<tr>

<td style="width: 150px;height: 10px;background-color: #ffffff; text-align: left"><b></b></td>
<td></td>
</tr>
<tr>
<td style="width: 150px;height: 20px; background-color: #ffffff; text-align: left"><b>Fecha cierre prevista:</b></td>
<td style="width: 200px;height: 20px;">'.$fechaprevista_acc.'</td>
</tr>
<tr>
<td style="width: 150px;height: 20px; background-color: #ffffff; text-align: left"><b>Fecha cierre real:</b></td>
<td>'.$fecharea_acc.'</td>

<td style="width: 150px;height: 20px;background-color: #ffffff; text-align: left"><b>Recursos económicos:</b></td>
<td>'.$recursos_acc.'  eur.</td>
</tr>
<tr>

<td style="width: 150px;height: 20px;background-color: #ffffff; text-align: left"><b>Fecha verificación:</b></td>
<td>'.$fechaveri_acc.'</td>
</tr>
</table>
<br>
<hr>
<table border="0">
<tr>
<td style="width: 630px;  background-color: #ffffff; text-align: left"><b>Comentarios:</b></td>
</tr>
<tr>
<td style="width: 630px;height: 60px;">'.$seguimiento_acc.'</td>
</tr>
</table>

<br>
<hr>
<br><br>
<table border="0">

<tr style="text-align:center">
    <td colspan="3" style="height: 20px; background-color: #ffffff; text-align: left"><b>Imágenes:</b></td>
</tr>
<tr>
    <td colspan="2" style="height: 10px;"></td>
</tr>
<tr>
    <td style="width: 80px;"></td>';

// Agregar la primera imagen solo si existe
if (file_exists($image1)) {
    $html .= '<td style="width: 140px; text-align: center;">
                <img src="'.$image1.'" style="max-height: 150px; width: auto;">
              </td>';
} else {
    $html .= '<td style="width: 140px; text-align: center;">(Sin imagen)</td>';
}

$html .= '<td style="width: 100px;"></td>';

// Agregar la segunda imagen solo si existe
if (file_exists($image2)) {
    $html .= '<td style="width: 140px; text-align: center;">
                <img src="'.$image2.'" style="max-height: 150px; width: auto;">
              </td>';
} else {
    $html .= '<td style="width: 140px; text-align: center;">(Sin imagen)</td>';
}

$html .= '</tr></table>';

$pdf->AddPage();

// ---------------------------------------------------------
// Output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');

// Cerrar y generar el PDF
$pdf->Output('hsbase_accion_PRL.pdf', 'I');
?>
