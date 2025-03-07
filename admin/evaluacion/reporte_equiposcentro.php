<?php
require_once('../../public/TCPDF/tcpdf.php');
include('../../app/config.php');


// Función para manejar valores nulos de forma segura
function safe_html($value)
{
    return htmlspecialchars($value ?? '');
}

// Función para resolver rutas de imágenes de forma segura
function resolve_image_path($image_name, $type = 'inventario')
{
    if (empty($image_name)) {
        return false;
    }

    // Definir las posibles rutas donde pueden estar las imágenes
    $possible_paths = [
        // Ruta absoluta desde el documento raíz
        $_SERVER['DOCUMENT_ROOT'] . BASE_URL . '/inventario/img/' . $image_name,
        // Ruta relativa desde el script actual
        dirname(__DIR__) . '/inventario/img/' . $image_name,
        // Ruta alternativa para logos
        dirname(__DIR__) . '/admin/maestros/centros/img/' . $image_name
    ];

    // Verificar cada ruta posible
    foreach ($possible_paths as $path) {
        if (file_exists($path)) {
            return $path;
        }
    }

    // Registrar error si no se encuentra la imagen
    error_log("No se pudo encontrar la imagen: " . $image_name);
    return false;
}


// Validar que $id_revision se reciba correctamente
if (!isset($_GET['id'])) {
    echo "ID de revisión no especificado.";
    exit;
}

$id_revision = $_GET['id']; // Asegúrate de validar y sanitizar esta entrada

// Obtener información de la empresa y centro
$query_empresa = "SELECT emp.razonsocial_emp as razonsocial_emp, 
                          emp.logo_emp as logo_emp, 
                          emp.direccion_emp as direccion_emp,
                          cen.nombre_cen, 
                          erc.fecha
                  FROM er_revision_maquina AS rev
                  INNER JOIN er_equiposcentro as erc ON rev.id_revision = erc.id_equiposcentro
                  INNER JOIN centros AS cen ON erc.id_centro = cen.id_centro
                  INNER JOIN empresa as emp ON cen.empresa_cen = emp.id_empresa
                  WHERE rev.id_revision = :id_revision LIMIT 1";

$stmt_empresa = $pdo->prepare($query_empresa);
$stmt_empresa->execute([':id_revision' => $id_revision]);
$empresa = $stmt_empresa->fetch(PDO::FETCH_ASSOC);

$nombre_emp = $empresa['razonsocial_emp'];
$nombre_cen = $empresa['nombre_cen'];
$fecha = $empresa['fecha'];
$direccion_emp = $empresa['direccion_emp'];

// Consulta para obtener las máquinas asociadas a la revisión
$query_maquinas = "SELECT 
                    rev.id_revision,
                    rev.id_maquina,
                    rev.valoracion_equipo,
                    rev.evaluacion_final,
                    erc.fecha AS fecha,
                    tm.nombre_tm AS nombre_tipo_maquina,
                    tm.clase_tm AS clase_maquina,
                    maq.marca_maq AS marca,
                    maq.modelo_maq AS modelo,
                    maq.numserie_maq AS num_serie,
                    cen.nombre_cen AS centro,
                    maq.proveedor_maq AS proveedor_maq, 
                    maq.manual_maq AS manual_maq, 
                    maq.marcace_maq AS marcace_maq, 
                    maq.aniofab_maq AS aniofab_maq, 
                    maq.epis_maq AS epis_maq, 
                    maq.observaciones_maq AS observaciones_maq, 
                    maq.img1_maq, maq.img2_maq, maq.imgmto1_maq, maq.imgmto2_maq
       
                  FROM er_revision_maquina AS rev
                  INNER JOIN er_equiposcentro AS erc ON rev.id_revision = erc.id_equiposcentro
                  INNER JOIN inv_maquinaria AS maq ON rev.id_maquina = maq.id_maquina
                  INNER JOIN tipomaquinas AS tm ON maq.tipo_maq = tm.id_tipomaquina
                  INNER JOIN centros AS cen ON erc.id_centro = cen.id_centro
                       WHERE rev.id_revision = :id_revision";

$stmt_maquinas = $pdo->prepare($query_maquinas);
$stmt_maquinas->execute([':id_revision' => $id_revision]);
$maquinas_evaluar = $stmt_maquinas->fetchAll(PDO::FETCH_ASSOC);

class MYPDF extends TCPDF
{
    protected $nombre_emp;
    protected $nombre_cen;
    protected $fecha;
    protected $direccion_emp;

    public function __construct($nombre_emp, $nombre_cen, $fecha, $direccion_emp)
    {
        parent::__construct();
        $this->nombre_emp = $nombre_emp;
        $this->nombre_cen = $nombre_cen;
        $this->fecha = $fecha;
        $this->direccion_emp = $direccion_emp;
    }

    public function Header()
    {
        // Configuración inicial de márgenes y dimensiones
        $leftMargin = 15;
        $topMargin = 0;
        $pageWidth = $this->getPageWidth();

        // Inserción del logo
        $logo = '../../admin/maestros/centros/img/2024-04-23-12-14-23__LOGO TRASMAPI.jpg';
        if (file_exists($logo)) {
            $this->Image($logo, 15, 10, 20, '', 'JPG', '', 'T', false, 200, '', false, false, 0, false, false, false);
        }

        // Nombre de la empresa centrado
        $this->SetFont('helvetica', 'B', 10);
        $this->SetY(9);
        $this->SetX(37); // Ajuste en X (ajústalo según el logo)
        $this->Cell(0, 6, safe_html($this->nombre_emp), 0, 1, 'C');

        // Información de evaluación alineada a la derecha
        $this->SetFont('helvetica', 'B', 9);
        $this->SetY(15);
        $this->SetX(50); // Ajuste en X (ajústalo según el logo)
        $this->Cell(0, 6, 'EVALUACIÓN DE EQUIPOS DE TRABAJO | Centro Tº: ' . safe_html($this->nombre_cen) . '   |   Fecha: ' . date('d/m/Y', strtotime($this->fecha)), 0, 1, 'L');

        // Líneas decorativas
        // Línea principal azul
        $this->SetLineWidth(0.5);
        $this->SetDrawColor(0, 51, 153);
        $this->Line($leftMargin, $topMargin + 23, $pageWidth - $leftMargin, $topMargin + 23);

        // Línea secundaria gris
        $this->SetLineWidth(0.2);
        $this->SetDrawColor(128, 128, 128);
        $this->Line($leftMargin, $topMargin + 24, $pageWidth - $leftMargin, $topMargin + 24);

        // Restaurar configuración por defecto
        $this->SetDrawColor(0, 0, 0);
        $this->Ln(7);
    }

    public function Footer()
    {
        $this->SetY(-10);
        $this->SetFont('helvetica', 'I', 7);
        $this->Cell(0, 4, safe_html($this->nombre_emp), 0, 1, 'C');
        $this->Cell(0, 4, safe_html($this->direccion_emp), 0, 1, 'C');
    }
}

$pdf = new MYPDF($nombre_emp, $nombre_cen, $fecha, $direccion_emp);

// Establecer información del documento
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Tu Nombre o Empresa');
$pdf->SetTitle('Reporte de Evaluación de Riesgos');
$pdf->SetSubject('Reporte de Evaluación de Riesgos');

// Establecer las márgenes
$pdf->SetMargins(15, 25, 10);

$pdf->AddPage();

// Configuración de fuente
$pdf->Ln(6);
$pdf->SetFont('helvetica', 'B', 10);
$pdf->SetFillColor(3, 0, 89);
$pdf->SetTextColor(255, 255, 255);  // Texto blanco
$pdf->Cell(0, 7, '4. ANÁLISIS DE LOS EQUIPOS DE TRABAJO', 0, 1, 'L', 1);
$pdf->SetTextColor(0, 0, 0);
// Salto de línea
$pdf->Ln(9);
$pdf->SetFont('helvetica', 'B', 9);
$pdf->SetFillColor(200, 220, 255);
$pdf->Cell(0, 5, '4.1 Relación de los equipos de trabajo incluidos en la E.R.:', 0, 1, 'L', 1);
$pdf->SetTextColor(0, 0, 0);
$pdf->Ln(6);
// Mostrar la primera fila de los datos de la máquina
$pdf->SetFont('helvetica', 'B', 8);
$pdf->SetFillColor(205, 205, 205);


// Cabecera de la tabla (dividida en varias filas si es necesario)
$pdf->Cell(50, 5, 'Equipo', 0, 0, 'L', 1);
$pdf->Cell(43, 5, 'Marca', 0, 0, 'C', 1);
$pdf->Cell(43, 5, 'Modelo', 0, 0, 'C', 1);
$pdf->Cell(49, 5, 'Serie', 0, 1, 'C', 1);
// Salto de línea
$pdf->SetTextColor(0, 0, 0);

foreach ($maquinas_evaluar as $maquina) {
    $pdf->SetFont('helvetica', '', 8);

    $pdf->Cell(50, 5, safe_html($maquina['nombre_tipo_maquina']), 0, 0, 'L');
    $pdf->Cell(43, 5, safe_html($maquina['marca']), 0, 0, 'C');
    $pdf->Cell(43, 5, safe_html($maquina['modelo']), 0, 0, 'C');
    $pdf->Cell(49, 5, safe_html($maquina['num_serie']), 0, 0, 'C');
    $pdf->Ln();
}
// Salto de línea

$pdf->AddPage(); // Salto de página entre máquinas
$pdf->Ln(1);
$pdf->SetFont('helvetica', 'B', 9);
$pdf->SetFillColor(200, 220, 255);
$pdf->Cell(0, 5, '4.2 Comprobacion y identificacion de riesgos:', 0, 1, 'L', 1);
$pdf->SetTextColor(0, 0, 0);
$pdf->Ln(3);
// Iterar sobre todas las máquinas para mostrar respuestas
foreach ($maquinas_evaluar as $maquina) {

    $pdf->SetFont('helvetica', 'B', 8);
    $pdf->SetFillColor(200, 220, 255);
    $pdf->Cell(45, 5, 'Equipo', 1, 0, 'C', 1);
    $pdf->Cell(45, 5, 'Marca', 1, 0, 'C', 1);
    $pdf->Cell(45, 5, 'Modelo', 1, 0, 'C', 1);
    $pdf->Cell(45, 5, 'Serie', 1, 0, 'C', 1);

    $pdf->Ln();  // Salto de línea

    $pdf->SetFont('helvetica', '', 8);
    $pdf->Cell(45, 5, safe_html($maquina['nombre_tipo_maquina']), 1, 0, 'C');
    $pdf->Cell(45, 5, safe_html($maquina['marca']), 1, 0, 'C');
    $pdf->Cell(45, 5, safe_html($maquina['modelo']), 1, 0, 'C');
    $pdf->Cell(45, 5, safe_html($maquina['num_serie']), 1, 0, 'C');

    $pdf->Ln();

    $pdf->SetFont('helvetica', 'B', 9);
    $pdf->SetFillColor(200, 220, 255);
    $pdf->Cell(45, 5, 'Proveedor', 1, 0, 'C', 1);
    $pdf->Cell(45, 5, 'Manual', 1, 0, 'C', 1);
    $pdf->Cell(45, 5, 'Marcado CE', 1, 0, 'C', 1);
    $pdf->Cell(45, 5, 'Año Fabricación', 1, 0, 'C', 1);
    $pdf->SetFillColor(255, 255, 255);
    $pdf->Ln();  // Salto de línea

    $pdf->SetFont('helvetica', '', 9);
    $pdf->Cell(45, 5, safe_html($maquina['proveedor_maq']), 1, 0, 'C');
    $pdf->Cell(45, 5, safe_html($maquina['manual_maq']), 1, 0, 'C');
    $pdf->Cell(45, 5, safe_html($maquina['marcace_maq']), 1, 0, 'C');
    $pdf->Cell(45, 5, safe_html($maquina['aniofab_maq']), 1, 0, 'C');
    $pdf->Ln();  // Salto de línea
    $pdf->Ln(2);
    // Tercera fila de la tabla
    $pdf->MultiCell(180, 5, 'Equipos de protección obligatorios: ' . safe_html($maquina['epis_maq']), 1, 'J' . 'L');
    $pdf->MultiCell(180, 5, 'Observaciones: ' . safe_html($maquina['observaciones_maq']), 1, 'J' . 'L');
    $pdf->Ln(2);
    $pdf->MultiCell(180, 5, 'Imágenes del equipo: ', 0, 1, 'J' . 'L');

    // Salto de línea después de la tabla de la máquina
    // Salto de línea después de la tabla de la máquina
    $pdf->Ln(1);

    // Definir tamaño y posición de las imágenes
    $imgWidth = 40;  // Ancho en mm
    $imgHeight = 40; // Alto en mm
    $xPos = $pdf->GetX(); // Posición actual en X
    $yPos = $pdf->GetY(); // Posición actual en Y

    // Imagen 1
    if (!empty($maquina['img1_maq'])) {
        $img1_path = resolve_image_path($maquina['img1_maq']);
        if ($img1_path) {
            try {
                $pdf->Image($img1_path, $xPos, $yPos, $imgWidth, $imgHeight);
            } catch (Exception $e) {
                error_log("Error al cargar imagen 1: " . $e->getMessage());
            }
        }
    }


    // Mover posición X para la segunda imagen
    $xPos += $imgWidth + 10; // Espacio entre imágenes

    // Imagen 2
    if (!empty($maquina['img2_maq'])) {
        $img2_path = resolve_image_path($maquina['img2_maq']);
        if ($img2_path) {
            try {
                $pdf->Image($img2_path, $xPos, $yPos, $imgWidth, $imgHeight);
            } catch (Exception $e) {
                error_log("Error al cargar imagen 2: " . $e->getMessage());
            }
        }
    }

    // Salto de línea después de insertar imágenes
    $pdf->Ln($imgHeight + 5);



    // Ahora seguimos con las respuestas y observaciones...

    // Consulta para obtener las respuestas y observaciones de la máquina
    $query_respuestas = "SELECT er.*, e.descripcion, e.grupo, e.tipo, er.id_respuesta
                         FROM er_revision_maquina rm
                         JOIN er_revisionmaq_respuestas er ON rm.id_revision_maquina = er.id_revision_maquina
                         JOIN er_elementos_revisionmaq e ON er.id_elemento = e.id_elemento
                         WHERE rm.id_revision = :id_revision 
                         AND rm.id_maquina = :id_maquina
                         ORDER BY e.grupo, e.id_elemento";

    $stmt_respuestas = $pdo->prepare($query_respuestas);
    $stmt_respuestas->execute([
        ':id_revision' => $id_revision,
        ':id_maquina' => $maquina['id_maquina']
    ]);
    $respuestas = $stmt_respuestas->fetchAll(PDO::FETCH_ASSOC);

    // Agrupar respuestas por grupo
    $grupos = [];
    foreach ($respuestas as $respuesta) {
        $grupos[$respuesta['grupo']][] = $respuesta;
    }

    // Mostrar respuestas y observaciones por grupo
    foreach ($grupos as $grupo => $respuestasGrupo) {
        $pdf->SetFont('helvetica', 'B', 8); // Establecer fuente en negrita
        $pdf->Cell(0, 8, 'Grupo: ' . safe_html($grupo), 0, 1);
        $pdf->SetFont('helvetica', '', 8); // Restaurar fuente normal

        // Crear una tabla para cada grupo
        $pdf->SetFont('helvetica', '', 8);
        $pdf->SetFillColor(205, 205, 205);

        // Encabezado de la tabla (se repite para los dos bloques por fila)
        $pdf->Cell(22, 6, 'Comprobacion', 1, 0, 'C', 1);
        $pdf->Cell(22, 6, 'Respuesta', 1, 0, 'C', 1);
        $pdf->Cell(46, 6, 'Observación', 1, 0, 'C', 1);
        $pdf->Cell(22, 6, 'Comprobacion', 1, 0, 'C', 1);
        $pdf->Cell(22, 6, 'Respuesta', 1, 0, 'C', 1);
        $pdf->Cell(46, 6, 'Observación', 1, 1, 'C', 1); // Mueve el cursor a la siguiente línea

        // Imprimir las respuestas en las celdas
        $contador = 0;
        foreach ($respuestasGrupo as $respuesta) {
            // Excluir respuestas "MEDIDAS" de la tabla principal
            if ($respuesta['respuesta'] === NULL) {
                continue; // Pasar al siguiente elemento
            }

            // Imprimir las celdas del primer bloque (cuando no es "MEDIDAS")
            $descripcion_corta = implode(' ', array_slice(explode(' ', safe_html($respuesta['descripcion'])), 0, 1)) . '';
            $pdf->Cell(22, 6, $descripcion_corta, 1, 0, 'C');
            $pdf->Cell(22, 6, safe_html($respuesta['respuesta']), 1, 0, 'C');
            $pdf->Cell(46, 6, safe_html($respuesta['observacion'] ?? 'Ninguna'), 1, 0, 'L');

            $contador++;

            // Si es par, imprimimos el segundo bloque en la misma fila
            if ($contador % 2 == 0) {
                $pdf->Ln(); // Salto de línea para la siguiente fila
            }
        }

        // Si el número de respuestas es impar, saltar manualmente a la siguiente línea
        if ($contador % 2 != 0) {
            $pdf->Ln();
        }

        // Crear tabla adicional para respuestas con planificacion = 1
        $planificacionFiltrada = array_filter($respuestasGrupo, function ($respuesta) {
            return $respuesta['planificacion'] == 1;
        });

        $pdf->Ln(5); // Salto de línea antes de la nueva tabla

        if (!empty($planificacionFiltrada)) {
            $pdf->SetFillColor(255, 255, 200); // Color de fondo para esta tabla

            // Encabezados de la tabla de planificación
            $pdf->Cell(150, 6, 'Riesgo detectado', 1, 0, 'C', 1);
            $pdf->Cell(30, 6, 'Grado de Riesgo', 1, 1, 'C', 1);

            // Rellenar la tabla con los riesgos detectados
            foreach ($planificacionFiltrada as $respuesta) {
                // Pregunta en la primera celda
                $pdf->MultiCell(150, 6, safe_html($respuesta['descripcion']), 1, 'L', false);

                // Mantener la celda del grado de riesgo en la misma fila que la pregunta
                $xPos = $pdf->GetX(); // Obtener posición X actual
                $yPos = $pdf->GetY(); // Obtener posición Y actual después del MultiCell
                $pdf->SetXY($xPos + 150, $yPos - 6); // Ajustar posición para la celda de "Grado de Riesgo"
                $pdf->Cell(30, 6, safe_html($respuesta['gradoriesgo']), 1, 1, 'C');
            }
        } else {
            // Si no hay riesgos detectados, mostrar solo una celda con el mensaje
            $pdf->SetFillColor(210, 254, 215); // Color azul claro
            $pdf->Cell(180, 6, 'No se detectan riesgos en las revisiones del grupo: ' . safe_html($grupo), 1, 1, 'C', 1);
        }

        // Crear tabla adicional para "MEDIDAS"
        $medidasFiltradas = array_filter($respuestasGrupo, function ($respuesta) {
            return $respuesta['respuesta'] === NULL;
        });

        if (!empty($medidasFiltradas)) {
            $pdf->Ln(5); // Salto de línea antes de la nueva tabla
            $pdf->SetFillColor(205, 205, 205); // Color de fondo para esta tabla

            // Encabezado de la tabla "Medidas"
            $pdf->Cell(180, 6, 'Medidas', 1, 1, 'C', 1);

            // Rellenar la tabla de "Medidas"
            foreach ($medidasFiltradas as $respuesta) {
                $pdf->Cell(180, 6, 'Observación: ' . safe_html($respuesta['observacion'] ?? 'Ninguna'), 1, 1, 'L');
            }
        }

        // Salto de línea antes de la siguiente máquina
        $pdf->Ln(10); // Salto de línea

    }

    // Obtención de los riesgos de la máquina
    $query_riesgos = "SELECT 
    rgo.id_riesgo AS id_riesgo,
    rg.fraseriesgo AS fraseriesgo,
    rgo.probabilidad AS probabilidad,
    rgo.gravedad AS gravedad,
    rgo.nivelriesgo AS nivelriesgo
  FROM inv_maquinaria_riesgos AS rgo
  INNER JOIN er_riesgos AS rg ON rgo.id_riesgo = rg.id_riesgo
  WHERE rgo.id_maquina = :id_maquina";

    // Ejecución de la consulta
    $stmt_riesgos = $pdo->prepare($query_riesgos);
    $stmt_riesgos->execute([':id_maquina' => $maquina['id_maquina']]);
    $riesgos = $stmt_riesgos->fetchAll(PDO::FETCH_ASSOC);

    // Título de la sección de Evaluación de Riesgos
    $pdf->SetFont('helvetica', 'B', 10);
    $pdf->Cell(180, 6, 'Evaluación de Riesgos', 0, 1, 'C'); // Título centrado
    $pdf->Ln(2); // Salto de línea después del título
    // Si se han detectado riesgos
    if (!empty($riesgos)) {


        $pdf->SetFont('helvetica', '', 8); // Fuente normal para la tabla
        $pdf->SetFillColor(255, 255, 200); // Color de fondo para la tabla

        // Encabezados de la tabla de riesgos
        $pdf->Cell(60, 6, 'Riesgo Detectado', 1, 0, 'C', 1);
        $pdf->Cell(40, 6, 'Probabilidad', 1, 0, 'C', 1);
        $pdf->Cell(40, 6, 'Gravedad', 1, 0, 'C', 1);
        $pdf->Cell(40, 6, 'Nivel de Riesgo', 1, 1, 'C', 1);

        // Rellenar la tabla con los riesgos
        foreach ($riesgos as $riesgo) {
            // Solo imprimir filas donde al menos uno de los campos tenga valor
            if (!empty($riesgo['fraseriesgo']) || !empty($riesgo['probabilidad']) || !empty($riesgo['gravedad']) || !empty($riesgo['nivelriesgo'])) {
                // Riesgo detectado
                $pdf->MultiCell(60, 6, safe_html($riesgo['fraseriesgo']), 1, 'L', false);

                // Mantener las celdas en la misma fila para Probabilidad, Gravedad y Nivel de Riesgo
                $xPos = $pdf->GetX();
                $yPos = $pdf->GetY();
                $pdf->SetXY($xPos + 60, $yPos - 6);
                $pdf->Cell(40, 6, safe_html($riesgo['probabilidad']), 1, 0, 'C');
                $pdf->Cell(40, 6, safe_html($riesgo['gravedad']), 1, 0, 'C');
                $pdf->Cell(40, 6, safe_html($riesgo['nivelriesgo']), 1, 1, 'C');

                // Volver a la posición original para la siguiente fila
                $pdf->SetXY($xPos, $yPos);
            }
        }
    } else {
        // Si no hay riesgos, mostrar un mensaje
        $pdf->SetFillColor(210, 254, 215); // Color de fondo para el mensaje
        $pdf->Cell(180, 6, 'No se detectan riesgos para este equipo.', 1, 1, 'C', 1);
    }
    $pdf->Ln(5); // Salto de línea antes de la nueva sección

// Sección: Valoración del equipo en una sola fila
$pdf->SetFont('helvetica', 'B', 10);
$pdf->SetFillColor(200, 220, 255); // Color de fondo para el título
$pdf->Cell(90, 6, 'Valoración del equipo', 1, 0, 'C', 1); // Título con fondo

$pdf->SetFont('helvetica', 'B', 10);
$pdf->Cell(90, 6, safe_html($maquina['valoracion_equipo']), 1, 1, 'C'); // Dato en la misma fila

$pdf->Ln(5); // Salto de línea antes de la siguiente sección

// Sección: Conclusiones
$pdf->SetFont('helvetica', 'B', 10);
$pdf->Cell(180, 6, 'Conclusiones', 0, 1, 'C'); // Título centrado
$pdf->SetFont('helvetica', '', 10);
$pdf->MultiCell(180, 6, safe_html($maquina['evaluacion_final']), 1, 'J'.'L'); // Texto justificado

$pdf->Ln(5); // Salto de línea antes del texto final

// Sección: Notas adicionales

$pdf->SetFont('helvetica', '', 8);
$pdf->MultiCell(
    180,
    6,
    "El análisis de riesgos se ha efectuado a partir de las condiciones técnicas del equipo, considerando que cumple " .
    "las condiciones generales de utilización de los equipos de trabajo indicadas en el Anexo II del RD 1215/97, así como " .
    "las indicadas en el manual de instrucciones y normas internas de la empresa.",
    0,
    'J'.'L'
);



    $pdf->AddPage(); // Salto de página entre máquinas
}

// Salida del PDF
$pdf->Output('informe_revision_maquina_' . safe_html($id_revision) . '.pdf', 'I');
exit();
