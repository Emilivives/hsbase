<?php

// Include the main TCPDF library (search for installation path).
require_once('../../public/TCPDF/tcpdf.php');
include('../../app/config.php');

// Obtener el valor de la URL o formulario
$id_puestocentro = $_GET['id_puestocentro'];

// Consulta SQL para obtener los datos de er_filas y las medidas asociadas
$sql_filaseval = "SELECT fer.id_filaeval, fer.puestocentro_fer, fer.frasefila_fer, fer.riesgo_fer, fer.probabilidad_fer, 
           fer.gravedad_fer, fer.nivelriesgo_fer, fer.imgriesgo_fer, fer.planresponsable_fer, fer.plancoste_fer, 
           fer.planaccion_fer, fer.planmetodo_fer, fer.planformacion_fer, fer.planinformacion_fer, 
           fer.imgplan_fer, m.id_medida, m.codigomedida, m.frasemedida, rg.codigoriesgo, rg.fraseriesgo
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
            'planresponsable_fer' => $fila['planresponsable_fer'],
            'plancoste_fer' => $fila['plancoste_fer'],
            'planaccion_fer' => $fila['planaccion_fer'],
            'planprioridad' => $fila['planprioridad_fer'],
            'planmetodo_fer' => $fila['planmetodo_fer'],
            'planformacion_fer' => $fila['planformacion_fer'],
            'planinformacion_fer' => $fila['planinformacion_fer'],
            'imgplan_fer' => $fila['imgplan_fer'],
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
        $this->SetFont('helvetica', 'B', 11);

        // Mover la posición actual para dejar espacio para el logo
        $this->SetXY(50, 11); // Ajustamos la posición para colocar el texto después del logo

        // Añadir el nombre de la empresa
        $this->Cell(100, 5, 'INFORMACIÓN DE RIESGOS PARA LA SEGURIDAD Y SALUD EN EL TRABAJO', 0, 1, 'L');
        // Mover la posición actual para dejar espacio para el logo
        $this->SetXY(50, 15); // Ajustamos la posición para colocar el texto después del logo

        // Añadir el nombre de la empresa
        $this->Cell(100, 5, 'MEDIDAS Y ACTIVIDADES DE PROTECCION Y PREVENCIÓN', 0, 1, 'L');
        // Establecer la posición para el tipo de evaluacion
        $this->SetFont('helvetica', 'B', 10);
        $this->SetXY(50, 23); // Ajustamos la posición X para la segunda línea

        // Establecer color de fondo para la celda
        $this->SetFillColor(25, 55, 141); // Color gris (#d0d0d0)
        $this->SetXY(50, 21); // Ajustamos la posición X para la segunda línea

        // Establecer fuente, si es necesario
        $this->SetFont('helvetica', 'B', 10); // Puedes ajustar la fuente y tamaño según lo desees
        $this->SetTextColor(255, 255, 255); // Texto en blanco (RGB)
        // Añadir la celda con el texto alineado a la izquierda y un relleno más estrecho
        $this->Cell(150, 6, 'PUESTO DE TRABAJO: ' . strtoupper($this->puestoarea_pc), 0, 1, 'C', 1);



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
$pdf->SetMargins(15, 35, 10);

// Añadir una página
$pdf->AddPage();

// Establecer la fuente para el contenido
$pdf->SetFont('helvetica', '', 10);

// Encabezado con datos adicionales
$html_header = '
<table border="0" cellpadding="5">
   
   
<tr>
      <td colspan="4" style="background-color: #a4d1ff; padding-bottom: 0.1; line-height: 0.2;"><b>Descripción general de las tareas:</b><br></td>
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
         

</table>';

$pdf->writeHTML($html_header, true, false, true, false, '');

// Añadir una nueva página para las últimas tres filas
$pdf->AddPage();

// Configurar la fuente para la tabla en la nueva página
$pdf->SetFont('helvetica', '', 8);

// Crear el contenido HTML para las últimas tres filas
$html_header_part2 = '<table border="0" cellpadding="5">
    
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
        <td style="text-align: center; font-size: 10pt; background-color: #a4d1ff;" colspan="7">
           <b> RIESGOS DETECTADOS Y MEDIDAS PREVENTIVAS</b>
        </td>

</tr>
  
    
</table>';

// Crear el HTML para la tabla de riesgos
$html_table .= '
<table border="0" cellpadding="2">
    <tbody>';

$contador_riesgos = 0;
foreach ($filaseval_datos as $filaseval_dato) {
    // Obtener el color de fondo basado en el nivel de riesgo
    list($r, $g, $b) = $pdf->getRiskColor($filaseval_dato['nivelriesgo_fer']);
    $pdf->SetFillColor($r, $g, $b);

    $contador_riesgos++;

    // Encabezado de la tabla
    $html_table .= '
<tr>
    <td colspan="2" style="background-color: #000080; color:white; font-size: 8pt; text-align: left;">
        Código - Riesgo
    </td>
    <td colspan="2" style="background-color: #000080; color:white; text-align: left;">
        Acción
    </td>
    <td colspan="3" style="background-color: #000080; color:white; text-align: left;">
        Motivo o causa
    </td>
</tr>';

    // Primera fila: codigoriesgo + fraseriesgo y planaccion en otra columna
    $html_table .= '
<tr>
    <td colspan="2" style="background-color: #c0c0c0; font-size: 9pt;">
        ' . htmlspecialchars($filaseval_dato['codigoriesgo']) . ' - ' . htmlspecialchars($filaseval_dato['fraseriesgo']) . '
    </td>
    <td colspan="2" style="background-color: #c0c0c0; text-align: left; font-size: 9pt;">
        ' . htmlspecialchars($filaseval_dato['planaccion_fer']) . '
    </td>
    <td colspan="3" style="background-color: #c0c0c0; text-align: left; font-size: 9pt;">
        ' . htmlspecialchars($filaseval_dato['frasefila_fer']) . '
    </td>
</tr>';


    // Tercera fila: frasemedida (repite por cada medida)
   // Encabezado para las medidas preventivas
   $html_table .= '
   <tr>
       <th style="text-align: left; background-color: #ffffff;" colspan="7">
           <strong style="color: #007bff;">Medidas preventivas:</strong>
       </th>
   </tr>';
   
   // Crear una celda que contendrá todas las frases
   $html_table .= '
   <tr>
       <td colspan="5" style="background-color: #ffffff;">';
   
   // Recorrer las medidas y añadir cada frase en la celda
   $frases = [];
   foreach ($filaseval_dato['medidas'] as $medida) {
       $frases[] = nl2br(htmlspecialchars($medida['frasemedida']));
   }
   
   // Unir todas las frases en una sola cadena con saltos de línea
   $html_table .= implode('<br>', $frases);
   
   // Cerrar la celda de las frases
   $html_table .= '
       </td>';
   
   // Añadir una celda para la imagen
   $html_table .= '
       <td colspan="2" style="background-color: #ffffff; text-align: right;">';
   
   // Comprobar si la imagen existe
   if (!empty($filaseval_dato['imgplan_fer'])) {
       // Obtener la ruta de la imagen
       $img_plan_fer = __DIR__ . '/image/' . htmlspecialchars($filaseval_dato['imgplan_fer']); // Asegúrate que esta ruta sea correcta
   
       // Comprobar si la imagen existe antes de añadirla al HTML
       if (file_exists($img_plan_fer)) {
           // Añadir imagen a la tabla
           $html_table .= '
           <img src="' . $img_plan_fer . '" width="100" alt="Imagen Plan Acción"/>';
       } else {
           // Log de depuración
           error_log("Imagen imgplan_fer no disponible en: " . $img_plan_fer);
           // Si la imagen no existe, añadir un mensaje
           $html_table .= '
           <span style="color: red;">Imagen no disponible</span>';
       }
   } else {
       // Si no hay imagen, dejar la celda vacía
       $html_table .= '
       <span style="color: red;">Sin imagen disponible</span>';
   }
   
   // Cerrar la celda de la imagen
   $html_table .= '
       </td>
   </tr>';
   
   // Añadir una fila con barra verde después de las medidas
   $html_table .= '
   <tr>
       <td colspan="7" style="background-color: #ffffff; height: 10px;"></td>
   </tr>';
   

   
   
   

}

$html_table .= '
<tr>
    <th style="text-align: center; background-color: #ffffff;" colspan="7">
        <strong style="color: #ff5151;">SI OBSERVA ALGUN RIESGO NO INCLUIDO EN EL LISTADO ANTERIOR CONCTACTE EN EL DEPARTAMENTO DE SEGURIDAD Y SALUD PARA SU EVALUACIÓN</strong>
    </th>
</tr>';


$html_table .= '
    </tbody>
</table>';



// Imprimir el contenido HTML en el PDF
$pdf->writeHTML($html_table, true, false, true, false, '');
// Después de las tablas, añadir las imágenes
// Salida del PDF
ob_end_clean(); // Limpiar el buffer de salida para evitar el error "Some data has already been output"

$pdf->Output('evaluacion_riesgos.pdf', 'I'); // 'I' para enviar al navegador, 'D' para descargar automáticamente.