<?php

// Include the main TCPDF library (search for installation path).
require_once('../../public/TCPDF/tcpdf.php');
include('../../app/config.php');

// Obtener el valor de la URL o formulario
$id_puestocentro = $_GET['id_puestocentro'];

// Consulta SQL para obtener los datos de er_filas y las medidas asociadas
$sql_filaseval = "SELECT fer.id_filaeval, fer.puestocentro_fer, fer.frasefila_fer, fer.riesgo_fer, fer.probabilidad_fer, 
           fer.gravedad_fer, fer.nivelriesgo_fer, fer.imgriesgo_fer, m.id_medida, m.codigomedida, m.frasemedida, rg.codigoriesgo, rg.fraseriesgo
    FROM er_filas as fer
    INNER JOIN er_riesgos as rg ON fer.riesgo_fer = rg.id_riesgo
    INNER JOIN er_filamedidas as fm ON fer.id_filaeval = fm.filaeval_fm
    INNER JOIN er_medidas as m ON fm.medida_fm = m.id_medida
    WHERE fer.puestocentro_fer = :puestocentro_fer
    ORDER BY rg.codigoriesgo ASC";

// Preparar la consulta SQL
$query_filaseval = $pdo->prepare($sql_filaseval);

// Bind del parámetro
$query_filaseval->bindParam(':puestocentro_fer', $id_puestocentro, PDO::PARAM_INT);

// Ejecutar la consulta
$query_filaseval->execute();

// Obtener los resultados
$resultados = $query_filaseval->fetchAll(PDO::FETCH_ASSOC);

// Procesar los resultados en un formato adecuado
$filaseval_datos = [];
foreach ($resultados as $fila) {
    $id_filaeval = $fila['id_filaeval'];

    // Si no existe esta fila en el array, inicializamos sus datos
    if (!isset($filaseval_datos[$id_filaeval])) {
        $filaseval_datos[$id_filaeval] = [
            'id_filaeval' => $fila['id_filaeval'],
            'puestocentro_fer' => $fila['puestocentro_fer'],
            'frasefila_fer' => $fila['frasefila_fer'],
            'riesgo_fer' => $fila['riesgo_fer'],
            'probabilidad_fer' => $fila['probabilidad_fer'],
            'gravedad_fer' => $fila['gravedad_fer'],
            'nivelriesgo_fer' => $fila['nivelriesgo_fer'],
            'codigoriesgo' => $fila['codigoriesgo'],
            'fraseriesgo' => $fila['fraseriesgo'],
            'imgriesgo_fer' => $fila['imgriesgo_fer'],
            'medidas' => [] // Inicializamos el array de medidas
        ];
    }

    // Agregar cada medida al array de medidas correspondiente a la fila
    $filaseval_datos[$id_filaeval]['medidas'][] = [
        'id_medida' => $fila['id_medida'],
        'codigomedida' => $fila['codigomedida'],
        'frasemedida' => $fila['frasemedida']
    ];
}

// Consulta SQL para obtener los datos del encabezado
$sql = "SELECT *, pc.evaluacion_pc as evaluacion_pc, pc.puestoarea_pc as puestoarea_pc, pc.descripcion_pc as descripcion_pc, 
cen.nombre_cen as nombre_cen, er.nombre_er as nombre_er, er.fecha_er as fecha_er, er.tipoevaluacion_er as tipoevaluacion_er, res.nombre_resp as nombre_resp, 
emp.razonsocial_emp as razonsocial_emp, emp.logo_emp as logo_emp, emp.direccion_emp as direccion_emp
FROM `er_puestocentro` as pc 
INNER JOIN er_evaluacion as er ON pc.evaluacion_pc = er.id_evaluacion
INNER JOIN centros as cen ON er.centro_er = cen.id_centro
INNER JOIN empresa as emp ON cen.empresa_cen = emp.id_empresa
INNER JOIN responsables as res ON er.responsable_er = res.id_responsable 
WHERE id_puestocentro = :id_puestocentro";

$query = $pdo->prepare($sql);
$query->bindParam(':id_puestocentro', $id_puestocentro, PDO::PARAM_INT);
$query->execute();
$puestoarea_datos = $query->fetchAll(PDO::FETCH_ASSOC);

foreach ($puestoarea_datos as $puestoarea_dato) {
    $evaluacion_pc = $puestoarea_dato['evaluacion_pc'];
    $puestoarea_pc = $puestoarea_dato['puestoarea_pc'];
    $descripcion_pc = $puestoarea_dato['descripcion_pc'];
    $nombre_cen = $puestoarea_dato['nombre_cen'];
    $nombre_emp = $puestoarea_dato['razonsocial_emp'];
    $fecha_er = $puestoarea_dato['fecha_er'];
    $nombre_er = $puestoarea_dato['nombre_er'];
    $tipoevaluacion_er = $puestoarea_dato['tipoevaluacion_er'];
    $nombre_resp = $puestoarea_dato['nombre_resp'];
    $direccion_emp = $puestoarea_dato['direccion_emp'];
    $logo_emp = $puestoarea_dato['logo_emp']; // Asegúrate de que la ruta del logo sea correcta
    $epis_pc = $puestoarea_dato['epis_pc'];
    $equipos_pc = $puestoarea_dato['equipos_pc'];
    $prodquim_pc = $puestoarea_dato['prodquim_pc'];
    $factoresriesgo_pc = $puestoarea_dato['factoresriesgo_pc'];
    $sensible_pc = $puestoarea_dato['sensible_pc'];
    $siniestralidad_pc = $puestoarea_dato['siniestralidad_pc'];
    $metodos_pc = $puestoarea_dato['metodos_pc'];
    $factorpsico_pc = $puestoarea_dato['factorpsico_pc'];
}
$epis_pc_formateado = str_replace(',', "\n", $epis_pc);
$prodquim_pc_formateado = str_replace(',', "\n", $prodquim_pc);
$metodos_pc_formateado = str_replace(',', "\n", $metodos_pc);
$factorpsico_pc_formateado = str_replace(',', "\n", $factorpsico_pc);

// Crear una clase extendida de TCPDF para personalizar la cabecera
class MYPDF extends TCPDF
{

    protected $nombre_emp;
    protected $nombre_cen;
    protected $puestoarea_pc;
    protected $tipoevaluacion_er;
    protected $fecha_er;
    protected $direccion_emp;

    // Constructor para pasar las variables
    public function __construct($nombre_emp, $nombre_cen, $puestoarea_pc, $tipoevaluacion_er, $fecha_er, $direccion_emp)
    {
        parent::__construct();
        $this->nombre_emp = $nombre_emp;
        $this->nombre_cen = $nombre_cen;
        $this->puestoarea_pc = $puestoarea_pc;
        $this->tipoevaluacion_er = $tipoevaluacion_er;
        $this->fecha_er = $fecha_er;
        $this->direccion_emp = $direccion_emp;
    }

    // Sobrescribir el método Header para personalizar la cabecera
    public function Header()
    {
        // Ruta del logo
        $logo = '../../admin/maestros/centros/img/2024-04-23-12-14-23__LOGO TRASMAPI.jpg';

        // Comprobar si el archivo del logo existe
        if (file_exists($logo)) {
            // Insertar el logo en la cabecera (posición X: 15, Y: 10, ancho: 30)
            $this->Image($logo, 15, 10, 30, '', 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);
        }

        // Establecer la fuente para el encabezado
        $this->SetFont('helvetica', 'B', 12);

        // Mover la posición actual para dejar espacio para el logo
        $this->SetXY(65, 5); // Ajustamos la posición para colocar el texto después del logo

        // Añadir el nombre de la empresa
        $this->Cell(0, 15, 'EVALUACIÓN DE RIESGOS LABORALES', 0, 1, 'L');

        // Establecer la posición para el tipo de evaluacion
        $this->SetFont('helvetica', 'B', 10);
        $this->SetXY(50, 18); // Ajustamos la posición X para la segunda línea

        // Añadir el centro de trabajo y la fecha en una misma fila
        $this->Cell(100, 2, 'Centro Tº: ' . $this->nombre_cen, 0, 0, 'L'); // A la izquierda
        $this->Cell(0, 2, 'Puesto: ' . strtoupper($this->puestoarea_pc), 0, 1, 'R'); // A la derecha

        // Establecer la posición para el centro de trabajo y la fecha en la misma línea
        $this->SetFont('helvetica', '', 9);
        $this->SetXY(50, 23); // Ajustamos la posición X para la tercera línea

        // Añadir el centro de trabajo y la fecha en una misma fila
        $this->Cell(120, 2, 'Evaluación: ' . strtoupper($this->tipoevaluacion_er), 0, 0, 'L'); // A la izquierd
        $this->Cell(0, 2, 'Fecha: ' . date('d/m/Y', strtotime($this->fecha_er)), 0, 1, 'R'); // A la derecha

        // Dibujar una línea horizontal debajo del encabezado
        $this->SetY(28); // Ajusta la posición vertical de la línea
        $this->SetLineWidth(0.5); // Ajusta el grosor de la línea
        $this->Line($this->GetX(), $this->GetY(), $this->w - $this->rMargin, $this->GetY()); // Dibuja la línea
    }

    // Sobrescribir el método Footer para personalizar el pie de página
    public function Footer()
    {
        // Ajustar la posición hacia arriba desde el borde inferior
        $this->SetY(-15);
        // Establecer la fuente para el pie de página
        $this->SetFont('helvetica', 'I', 8);
        // Añadir la primera línea con el nombre de la empresa
        $this->Cell(0, 4, $this->nombre_emp, 0, 1, 'C');
        // Añadir una segunda línea justo debajo
        $this->Cell(0, 4, $this->direccion_emp, 0, 1, 'C');
    }
    // Método personalizado para obtener el color de fondo basado en el nivel de riesgo
    public function getRiskColor($nivelriesgo_fer)
    {
        switch ($nivelriesgo_fer) {
            case 'Riesgo Trivial':
                return [144, 238, 144]; // Verde claro
            case 'Riesgo Tolerable':
                return [255, 255, 224]; // Amarillo claro
            case 'Riesgo Moderado':
                return [255, 165, 0]; // Naranja
            case 'Riesgo Importante':
                return [255, 99, 71]; // Rojo claro
            case 'Riesgo Intolerable':
                return [255, 0, 0]; // Rojo fuerte
            default:
                return [255, 255, 255]; // Blanco por defecto
        }
    }
}



// Crear una nueva instancia de MYPDF pasando las variables
$pdf = new MYPDF($nombre_emp, $nombre_cen, $puestoarea_pc, $tipoevaluacion_er, $fecha_er, $direccion_emp);

// Establecer información del documento
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Tu Nombre o Empresa');
$pdf->SetTitle('Reporte de Evaluación de Riesgos');
$pdf->SetSubject('Reporte de Evaluación de Riesgos');

// Establecer las márgenes
$pdf->SetMargins(15, 30, 10);

// Añadir una página
$pdf->AddPage();

// Establecer la fuente para el contenido
$pdf->SetFont('helvetica', '', 10);

// Encabezado con datos adicionales
$html_header = '
<table border="0" cellpadding="5">
    <tr>
        <td colspan="2"><b>Evaluación:</b> ' . htmlspecialchars($nombre_er) . '</td>
        <td style="text-align:right"colspan="2"><b>Centro:</b> ' . htmlspecialchars($nombre_cen) . '</td>
    </tr>
    <tr>
         <td colspan="3"><b>Puesto/Área:</b> ' . htmlspecialchars($puestoarea_pc) . '</td>
            <td colspan="1"><b>Evaluador:</b> ' . htmlspecialchars($nombre_resp) . '</td>
 </tr>
   
<tr>
      <td colspan="4" style="background-color: #a4d1ff; padding-bottom: 0.1; line-height: 0.2;"><b>Descripción</b><br></td>
    </tr>
      <tr>
        <td colspan="4">' . nl2br(htmlspecialchars($descripcion_pc, ENT_QUOTES, 'UTF-8')) . '</td>
    </tr>

   <tr>
   <br>
      <td colspan="4" style="background-color: #a4d1ff; padding-bottom: 0.1; line-height: 0.2;"><b>Factores de Riesgo:</b><br></td>
    </tr>       

     <tr>
        <td colspan="4"><br>' . nl2br(htmlspecialchars($factoresriesgo_pc, ENT_QUOTES, 'UTF-8')) . '</td>
    </tr>
     <tr>
     <br>
      <td colspan="4" style="background-color: #a4d1ff; padding-bottom: 0.1; line-height: 0.2;"><b>Colectivo sensible:</b><br></td>
    </tr>       

       <tr>
        <td colspan="4">' . nl2br(htmlspecialchars($sensible_pc, ENT_QUOTES, 'UTF-8')) . '</td>
    </tr>
      <tr>
     <br>
      <td colspan="4" style="background-color: #a4d1ff; padding-bottom: 0.1; line-height: 0.2;"><b>Siniestralidad:</b><br></td>
    </tr>  
     <tr>
        <td colspan="4"><br>' . nl2br(htmlspecialchars($siniestralidad_pc, ENT_QUOTES, 'UTF-8')) . '</td>
    </tr>

    

</table>';

$pdf->writeHTML($html_header, true, false, true, false, '');

// Añadir una nueva página para las últimas tres filas
$pdf->AddPage();

// Configurar la fuente para la tabla en la nueva página
$pdf->SetFont('helvetica', '', 8);

// Crear el contenido HTML para las últimas tres filas
$html_header_part2 = '<table border="0" cellpadding="5">
    <tr>
        <td style="text-align: left; background-color: #d0d0d0;" colspan="4">PUESTO / AREA DE TRABAJO:  <b>' . htmlspecialchars($puestoarea_pc) . '</b></td>
    </tr>
    <br>
    <tr>
        <td colspan="2" style="background-color: #a4d1ff; padding-bottom: 0.1; line-height: 0.2;"><b>EPIs:</b><br></td>
  
        <td colspan="2" style="background-color: #a4d1ff; padding-bottom: 0.1; line-height: 0.2;"><b>Equipos de trabajo:</b><br></td>
    </tr>
<tr>
        <td colspan="2">' . nl2br(htmlspecialchars($epis_pc_formateado, ENT_QUOTES, 'UTF-8')) . '</td>
  
        <td colspan="2">' . nl2br(htmlspecialchars($equipos_pc, ENT_QUOTES, 'UTF-8')) . '</td>
    </tr>

      <tr>
        <td colspan="2" style="background-color: #a4d1ff; padding-bottom: 0.1; line-height: 0.2;"><b>Productos Qúimicos:</b><br></td>
  
        <td colspan="2" style="background-color: #a4d1ff; padding-bottom: 0.1; line-height: 0.2;"><b>Factores psicológicos:</b><br></td>
    </tr>

    <tr>
        <td colspan="2">' . nl2br(htmlspecialchars($prodquim_pc_formateado, ENT_QUOTES, 'UTF-8')) . '</td>
                <td colspan="2">' . nl2br(htmlspecialchars($factorpsico_pc_formateado, ENT_QUOTES, 'UTF-8')) . '</td>
    </tr>
       <tr>
        <td colspan="2" style="background-color: #a4d1ff; padding-bottom: 0.1; line-height: 0.2;"><b>Riesgos detectados:</b><br></td>
  
        <td colspan="2" style="background-color: #a4d1ff; padding-bottom: 0.1; line-height: 0.2;"><b>Metodos operativos:</b><br></td>
    </tr>

 <tr>
        <td colspan="2">
            <table border="0" cellpadding="5">
                ';

// Aquí es donde se añaden las filas de riesgos agrupados por codigoriesgo
$riesgos_mostrados = [];

foreach ($filaseval_datos as $filaseval_dato) {
    $codigo = htmlspecialchars($filaseval_dato['codigoriesgo']);
    $frase = htmlspecialchars($filaseval_dato['fraseriesgo']);

    // Crear una clave única combinando el código y la frase
    $clave_unica = $codigo . ' - ' . $frase;

    // Si esta clave no ha sido mostrada antes, la mostramos
    if (!isset($riesgos_mostrados[$clave_unica])) {
        $riesgos_mostrados[$clave_unica] = true;  // Marcar como mostrada

        $html_header_part2 .= '
        <tr style="line-height: 0.2; padding: 1px;">
            <td colspan="2">
                ' . $clave_unica . '
            </td>
        </tr>';
    }
}

$html_header_part2 .= '
            </table>
        </td>
        <td colspan="2">' . nl2br(htmlspecialchars($metodos_pc_formateado, ENT_QUOTES, 'UTF-8')) . '</td>
    </tr>
   
</table>';


// Imprimir las últimas tres filas y la tabla de riesgos
$pdf->writeHTML($html_header_part2, true, false, true, false, '');

// Añadir una nueva página para las últimas tres filas
$pdf->AddPage();

$pdf->SetFont('helvetica', '', 8);

// Crear el HTML para la cabecera en la nueva página
$html_table = '
<table border="0" cellpadding="5">
    <tr>
        <td style="text-align: center; background-color: #a4d1ff;" colspan="7">
           <b> ANALISIS DE RIESGOS DETECTADOS Y MEDIDAS PREVENTIVAS</b>
        </td>
    </tr>
  
    
</table>';

// Crear el HTML para la tabla de riesgos
$html_table .= '
<table border="1" cellpadding="5">
    <tbody>';

$contador_riesgos = 0;
foreach ($filaseval_datos as $filaseval_dato) {
    
    // Obtener el color de fondo basado en el nivel de riesgo
    list($r, $g, $b) = $pdf->getRiskColor($filaseval_dato['nivelriesgo_fer']);
    $pdf->SetFillColor($r, $g, $b);

    $contador_riesgos++;
    $html_table .= '
    <tr>
    
        <th style="text-align: left; background-color: #d0d0d0;" colspan="4">Riesgo nº: ' . $contador_riesgos . ' </th>
        <th style="text-align: center; background-color: #d0d0d0;">Probabilidad</th>
        <th style="text-align: center; background-color: #d0d0d0;">Consecuencias</th>
        <th style="text-align: center; background-color: #d0d0d0;">Nivel Riesgo</th>
    </tr>
    <tr>
        <td colspan="4" style="background-color: #ffffff;"><b>' . htmlspecialchars($filaseval_dato['codigoriesgo']) . ' - ' . htmlspecialchars($filaseval_dato['fraseriesgo']) . '</b></td>
        <td style="text-align: center;">' . htmlspecialchars($filaseval_dato['probabilidad_fer']) . '</td>
        <td style="text-align: center;">' . htmlspecialchars($filaseval_dato['gravedad_fer']) . '</td>
        <td style="text-align: center; background-color: rgb(' . $r . ',' . $g . ',' . $b . ');">' . htmlspecialchars($filaseval_dato['nivelriesgo_fer']) . '</td>
    </tr>
    <tr>
        <th style="text-align: center; background-color: #d0d0d0;" colspan="7">Descripción</th>
    </tr>
    <tr>
        <td colspan="7" style="background-color: #ffffff;">
            ' . nl2br(htmlspecialchars($filaseval_dato['frasefila_fer'])) . '
        </td>
    </tr>
    <tr>
        <td colspan="7" style="text-align: left; background-color: #ffffff; border: 1px solid #000000;">
            <strong style="color: #007bff;">Medidas preventivas:</strong><br>';

    foreach ($filaseval_dato['medidas'] as $medida) {
        $html_table .= '<div style="border-bottom: 1px solid #ffffff; padding: 5px 0;">
                          <span>' . nl2br(htmlspecialchars($medida['frasemedida'])) . '</span>
                      </div>';
    }

    $html_table .= '</td>
    </tr>';

   
}



$html_table .= '
    </tbody>
</table>';


// Imprimir el contenido HTML en el PDF
$pdf->writeHTML($html_table, true, false, true, false, '');

// Después de las tablas, añadir las imágenes
$pdf->AddPage();  // Crear una nueva página para las imágenes

$pdf->SetFont('helvetica', '', 8);

// Crear el HTML para la cabecera en la nueva página
$html_table = '
<table border="0" cellpadding="5">
    <tr>
        <td style="text-align: center; background-color: #a4d1ff;" colspan="7">
           <b> IMAGENES DE RIESGOS DETECTADOS</b>
        </td>
    </tr>
  
    
</table>';

// Iniciar la tabla para las imágenes
$html_table .= '
<table border="1" cellpadding="5">
    <tbody>';

// Contador de imágenes
$contador_riesgos = 0;
$columnas = 0; // Contador de columnas (dos por fila)

// Iniciar una nueva fila en la tabla
$html_table .= '<tr>';

foreach ($filaseval_datos as $filaseval_dato) {
    if (!empty($filaseval_dato['imgriesgo_fer'])) {
        // Obtener la ruta absoluta de la imagen
        $img_riesgo = __DIR__ . '/image/' . $filaseval_dato['imgriesgo_fer'];
        
        // Comprobar si la imagen existe antes de insertarla
        if (file_exists($img_riesgo)) {
            $contador_riesgos++;
            $columnas++;

            // Añadir la celda para el título de la imagen
            $html_table .= '<td style="text-align: center;">';
            $html_table .= '<b>Riesgo: ' . $filaseval_dato['frasefila_fer'] . '</b><br>';

            // Añadir la imagen a la celda
            $html_table .= '<img src="' . $img_riesgo . '" width="100px" /><br>';

            // Cerrar la celda
            $html_table .= '</td>';

            // Si ya hay dos imágenes en la fila, cerrar la fila e iniciar una nueva
            if ($columnas == 2) {
                $html_table .= '</tr><tr>'; // Cerrar la fila actual e iniciar una nueva
                $columnas = 0; // Reiniciar el contador de columnas
            }
        }
    }
}

// Si quedó alguna imagen solitaria, cerrar la fila de todas formas
if ($columnas == 1) {
    $html_table .= '<td></td>'; // Añadir celda vacía para completar la fila
    $html_table .= '</tr>'; // Cerrar la fila
} else {
    $html_table .= '</tr>'; // Cerrar la fila sin añadir celda vacía
}

// Cerrar la tabla correctamente
$html_table .= '</tbody></table>';

// Imprimir la tabla de riesgos y medidas en el PDF
$pdf->writeHTML($html_table, true, false, true, false, '');

// Salida del PDF
ob_end_clean(); // Limpiar el buffer de salida para evitar el error "Some data has already been output"

$pdf->Output('evaluacion_riesgos.pdf', 'I'); // 'I' para enviar al navegador, 'D' para descargar automáticamente.