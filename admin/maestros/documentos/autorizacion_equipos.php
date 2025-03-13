<?php
require_once('../../../public/TCPDF/tcpdf.php');
include('../../../app/config.php');

// Función para manejar valores nulos de forma segura
function safe_html($value)
{
    return htmlspecialchars($value ?? '');
}

// Validar que se reciba el ID del trabajador correctamente
if (!isset($_GET['id_trabajador'])) {
    echo "ID de trabajador no especificado.";
    exit;
}

// Obtener y sanitizar el ID del trabajador
$id_trabajador = filter_input(INPUT_GET, 'id_trabajador', FILTER_SANITIZE_NUMBER_INT);
if (!$id_trabajador) {
    echo "ID de trabajador no válido.";
    exit;
}

// Obtener información del trabajador
$sql = "SELECT tr.id_trabajador as id_trabajador, 
               tr.codigo_tr as codigo_tr, 
               tr.dni_tr as dni_tr, 
               tr.nombre_tr as nombre_tr, 
               tr.fechanac_tr as fechanac_tr, 
               tr.sexo_tr as sexo_tr,  
               cat.nombre_cat as nombre_cat, 
               tr.inicio_tr as inicio_tr, 
               tr.activo_tr as activo_tr, 
               tr.formacionpdt_tr as formacionpdt_tr, 
               tr.informacion_tr as informacion_tr,  
               cen.nombre_cen as nombre_cen,
               cen.id_centro as id_centro, 
               emp.id_empresa as id_empresa, 
               emp.nombre_emp as nombre_emp, 
               emp.logo_emp as logo_emp,  
               emp.razonsocial_emp as razonsocial_emp, 
               emp.direccion_emp as direccion_emp, 
               tr.anotaciones_tr as anotaciones_tr 
        FROM `trabajadores` as tr 
        INNER JOIN `categorias` as cat ON tr.categoria_tr = cat.id_categoria 
        INNER JOIN `centros` as cen ON tr.centro_tr = cen.id_centro  
        INNER JOIN `empresa` as emp ON cen.empresa_cen = emp.id_empresa  
        WHERE `id_trabajador` = :id_trabajador";

$query = $pdo->prepare($sql);
$query->execute([':id_trabajador' => $id_trabajador]);
$trabajador_datos = $query->fetch(PDO::FETCH_ASSOC);

$logo_path = '../../maestros/centros/img/' . $trabajador_datos['logo_emp'];

// Si no hay datos del trabajador, mostrar error
if (!$trabajador_datos) {
    echo "No se encontraron datos para el trabajador especificado.";
    exit;
}

// Obtener el ID del centro del trabajador
$id_centro = $trabajador_datos['id_centro'];

// Consulta para obtener las máquinas asociadas al centro
$query_maquinas = "
    SELECT 
        tm.nombre_tm AS nombre_tipo_maquina,
        maq.marca_maq AS marca,
        maq.modelo_maq AS modelo,
        maq.id_maquina AS id_maquina
    FROM inv_maquinaria AS maq
    INNER JOIN tipomaquinas AS tm ON maq.tipo_maq = tm.id_tipomaquina
    WHERE maq.centro_maq = :id_centro
    ORDER BY tm.nombre_tm
";

$stmt_maquinas = $pdo->prepare($query_maquinas);
$stmt_maquinas->execute([':id_centro' => $id_centro]);

$maquinas_centro = $stmt_maquinas->fetchAll(PDO::FETCH_ASSOC);


// 🚨 Depuración: Verificar si la consulta devuelve datos
if ($maquinas_centro === false) {
    die("Error en la consulta SQL: " . print_r($stmt_maquinas->errorInfo(), true));
} elseif (empty($maquinas_centro)) {
    die("No hay máquinas asociadas al centro con ID: " . $id_centro);
}


class MYPDF extends TCPDF
{
    protected $nombre_emp;
    protected $nombre_cen;
    protected $direccion_emp;
    protected $fecha_actual;

    public function __construct($nombre_emp, $nombre_cen, $direccion_emp)
    {
        parent::__construct();
        $this->nombre_emp = $nombre_emp;
        $this->nombre_cen = $nombre_cen;
        $this->direccion_emp = $direccion_emp;
        $this->fecha_actual = date('d/m/Y');
    }

    public function Header()
    {
        // Configuración inicial de márgenes y dimensiones
        $leftMargin = 15;
        $topMargin = 0;
        $pageWidth = $this->getPageWidth();

        global $logo_path;
        // Ruta del logo
         // Verificar si el archivo de imagen del logo existe
         if (file_exists($logo_path) && !empty($logo_path)) {
            $this->Image($logo_path, 15, 10, 30); // (X, Y, Ancho)
        }

        $this->SetFont('helvetica', 'B', 15);
        $this->SetY(7);
        $this->SetX(14); // Ajuste en X 
        $this->Cell(0, 10, 'AUTORIZACIÓN DE USO DE MAQUINARIA', 0, 1, 'C');
        // Nombre de la empresa centrado
        $this->SetFont('helvetica', '', 11);
        $this->SetY(15);
        $this->SetX(15); // Ajuste en X (ajústalo según el logo)
        $this->Cell(0, 6, safe_html($this->nombre_emp), 0, 1, 'C');

        // Información de documento alineada a la derecha

        // Línea principal azul
        $this->SetLineWidth(0.5);
        $this->SetDrawColor(0, 51, 153);
        $this->Line($leftMargin, $topMargin + 22, $pageWidth - $leftMargin, $topMargin + 22);

        // Línea secundaria gris
        $this->SetLineWidth(0.2);
        $this->SetDrawColor(128, 128, 128);
        $this->Line($leftMargin, $topMargin + 23, $pageWidth - $leftMargin, $topMargin + 23);

        // Restaurar configuración por defecto
        $this->SetDrawColor(0, 0, 0);
        $this->Ln(7);
    }

    public function Footer()
    {
        $this->SetY(-10);
        $this->SetFont('helvetica', 'I', 6);
        $this->Cell(0, 4, safe_html($this->nombre_emp), 0, 1, 'C');
        $this->Cell(0, 4, safe_html($this->direccion_emp), 0, 1, 'C');
    }
}

// Crear nuevo documento PDF
$pdf = new MYPDF($trabajador_datos['razonsocial_emp'], $trabajador_datos['nombre_cen'], $trabajador_datos['direccion_emp']);

// Establecer información del documento
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor($trabajador_datos['razonsocial_emp']);
$pdf->SetTitle('Autorización de Uso de Maquinaria - ' . $trabajador_datos['nombre_tr']);
$pdf->SetSubject('Autorización de Uso de Maquinaria');

// Establecer las márgenes
$pdf->SetMargins(15, 25, 10);
$pdf->SetHeaderMargin(5);
$pdf->SetFooterMargin(10);

// Desactivar saltos de página automáticos
$pdf->SetAutoPageBreak(TRUE, 15);

// Añadir página
$pdf->AddPage();

// Título del documento
$pdf->Ln(6);
// Datos del trabajador
$pdf->SetFont('helvetica', 'B', 10);
$pdf->SetFillColor(3, 0, 89);
$pdf->SetTextColor(255, 255, 255);  // Texto blanco
$pdf->Cell(0, 7, 'DATOS DEL TRABAJADOR', 0, 1, 'L', 1);
$pdf->SetTextColor(0, 0, 0);
$pdf->Ln(3);

// Información del trabajador - Formato de tabla
// Información del trabajador - Formato de tabla en una sola línea
$pdf->SetFont('helvetica', 'B', 9);
$pdf->SetFillColor(220, 220, 220);
$pdf->Cell(30, 7, 'Nombre:', 1, 0, 'L', 1);
$pdf->SetFont('helvetica', '', 9);
$pdf->Cell(90, 7, safe_html($trabajador_datos['nombre_tr']), 1, 0, 'L');

$pdf->SetFont('helvetica', 'B', 9);
$pdf->Cell(20, 7, 'DNI:', 1, 0, 'L', 1);
$pdf->SetFont('helvetica', '', 9);
$pdf->Cell(40, 7, safe_html($trabajador_datos['dni_tr']), 1, 1, 'L');

// Texto de autorización
$pdf->Ln(5);
$pdf->SetFont('helvetica', 'B', 10);
$pdf->SetFillColor(3, 0, 89);
$pdf->SetTextColor(255, 255, 255);
$pdf->Cell(0, 7, 'AUTORIZACIÓN', 0, 1, 'L', 1);
$pdf->SetTextColor(0, 0, 0);
$pdf->Ln(3);

$pdf->SetFont('helvetica', '', 9);
$texto_autorizacion = "Por la presente, se AUTORIZA al trabajador arriba indicado para el manejo y uso de los equipos y maquinaria que se relacionan a continuación, tras haber recibido la formación e información necesarias sobre su correcta utilización, riesgos asociados y medidas preventivas, todo ello conforme a lo establecido en la Ley 31/1995 de Prevención de Riesgos Laborales y el RD 1215/1997 sobre disposiciones mínimas de seguridad y salud para la utilización por los trabajadores de los equipos de trabajo.";
$pdf->MultiCell(0, 5, $texto_autorizacion, 0, '');
$pdf->Ln(2);
$pdf->SetFont('helvetica', '', 9);
$texto_autorizacion = "La persona autorizada manifiesta haber recibido las oportunas explicaciones sobre el correcto manejo del equipo, ser conocedora de los riesgos, medidas preventivas y tener a disposición para su consulta el manual de instrucciones de cada uno de los equipos para los que ha sido autorizada o en su defecto manual de uso y/o disponer de instrucciones específicas de uso.
Así mismo, se compromete a conservar y realizar el mantenimiento de la máquina respetando siempre las indicaciones del fabricante y la normativa vigente, así como a conocer y respetar el manual de instrucciones o libro de usuario y especialmente las normas de seguridad.";
$pdf->MultiCell(0, 5, $texto_autorizacion, 0, '');
$pdf->Ln(3);
// Listado de maquinaria autorizada
$pdf->SetFont('helvetica', 'B', 10);
$pdf->SetFillColor(3, 0, 89);
$pdf->SetTextColor(255, 255, 255);
$pdf->Cell(0, 7, 'RELACIÓN DE MAQUINARIA AUTORIZADA', 0, 1, 'L', 1);
$pdf->SetTextColor(0, 0, 0);
$pdf->Ln(3);

// Cabecera de la tabla
$pdf->SetFont('helvetica', 'B', 8);
$pdf->SetFillColor(220, 220, 220);
$pdf->Cell(35, 5, 'EQUIPO', 1, 0, 'C', 1);
$pdf->Cell(25, 5, 'MARCA', 1, 0, 'C', 1);
$pdf->Cell(30, 5, 'MODELO', 1, 0, 'C', 1);

// Espacio en blanco entre las dos listas
$pdf->Cell(5, 5, '', 0, 0); 

$pdf->Cell(35, 5, 'EQUIPO', 1, 0, 'C', 1);
$pdf->Cell(25, 5, 'MARCA', 1, 0, 'C', 1);
$pdf->Cell(30, 5, 'MODELO', 1, 1, 'C', 1);

// Datos de maquinaria (dos por fila)
$pdf->SetFont('helvetica', '', 7);
$total_maquinas = count($maquinas_centro);

for ($i = 0; $i < $total_maquinas; $i += 2) {
    // Primera columna de la fila
    $pdf->Cell(35, 4, safe_html($maquinas_centro[$i]['nombre_tipo_maquina']), 1, 0, 'L');
    $pdf->Cell(25, 4, safe_html($maquinas_centro[$i]['marca']), 1, 0, 'C');
    $pdf->Cell(30, 4, safe_html($maquinas_centro[$i]['modelo']), 1, 0, 'C');

    // Espacio en blanco entre las dos listas
    $pdf->Cell(5, 4, '', 0, 0); 

    // Segunda columna de la fila (si existe)
    if ($i + 1 < $total_maquinas) {
        $pdf->Cell(35, 4, safe_html($maquinas_centro[$i+1]['nombre_tipo_maquina']), 1, 0, 'L');
        $pdf->Cell(25, 4, safe_html($maquinas_centro[$i+1]['marca']), 1, 0, 'C');
        $pdf->Cell(30, 4, safe_html($maquinas_centro[$i+1]['modelo']), 1, 1, 'C');
    } else {
        // Si no hay segunda máquina, celdas vacías
        $pdf->Cell(35, 4, '', 1, 0, 'L');
        $pdf->Cell(25, 4, '', 1, 0, 'C');
        $pdf->Cell(30, 4, '', 1, 1, 'C');
    }
}

$pdf->Ln(3);
$pdf->SetFont('helvetica', '', 8);
$texto_autorizacion = "Dichos equipos están homologados y disponen de marcado “CE” o en su caso declaración de conformidad, cumpliendo las especificaciones del Real Decreto 1215/1997, de 18 de julio, por el que se establecen las disposiciones mínimas de seguridad y salud para la utilización por los trabajadores de los equipos de trabajo. ";
$pdf->MultiCell(0, 5, $texto_autorizacion, 0, '');
$pdf->Ln(3);

$pdf->SetFont('helvetica', '', 8);
$texto_autorizacion = "El trabajador está autorizado para utilizar equipos de trabajo ubicados en otros centros de la empresa, así como equipos de terceros, siempre y cuando estos cumplan con las disposiciones de seguridad establecidas en la normativa vigente, hayan sido verificados en cuanto a su correcto estado y condiciones de uso, y el trabajador disponga de la formación adecuada para su manejo. ";
$pdf->MultiCell(0, 5, $texto_autorizacion, 0, '');
$pdf->Ln(3);


// Espacio para firmas
$pdf->Ln(15);
$pdf->SetFont('helvetica', 'B', 9);
$pdf->Cell(90, 7, 'Por la empresa:', 0, 0, 'C');
$pdf->Cell(90, 7, 'El trabajador:', 0, 1, 'C');

$pdf->Ln(15); // Espacio para las firmas

$pdf->SetFont('helvetica', '', 9);
$pdf->Cell(90, 7, 'Fdo.: _______________________________', 0, 0, 'C');
$pdf->Cell(90, 7, 'Fdo.: _______________________________', 0, 1, 'C');

$pdf->Ln(5);
$pdf->SetFont('helvetica', 'I', 7);
$fecha_actual = date('d/m/Y');
$pdf->Cell(0, 5, "En ______________, a ______ de _______________ de ________", 0, 1, 'C');

// Aviso legal en la parte inferior
$pdf->Ln(10);
$pdf->SetFont('helvetica', 'I', 7);
$aviso_legal = "Esta autorización podrá ser revocada en cualquier momento a criterio de la dirección de la empresa, especialmente en caso de uso indebido de los equipos, incumplimiento de las normas de seguridad o cuando el trabajador manifieste ineptitud para el manejo seguro de los mismos.";
$pdf->MultiCell(0, 4, $aviso_legal, 0, 'J');

// Salida del PDF
$pdf->Output('autorizacion_uso_maquinaria_' . safe_html($trabajador_datos['codigo_tr']) . '.pdf', 'I');
exit();