<?php
ob_start();  // Iniciar el búfer de salida

// Incluye TCPDF y configuraciones de la base de datos
require_once('../../public/TCPDF/tcpdf.php');
include('../../app/config.php');  // Aquí mantienes la configuración de la conexión a la base de datos

// Obtener ID del proyecto
$id_proyecto = $_GET['id_proyecto'] ?? null;

// Comprobar que $id_proyecto está definido y es válido antes de continuar
if (!$id_proyecto) {
    die("Error: id_proyecto no especificado.");
}

// 1. Consultar datos del proyecto
$sqlProyecto = "SELECT py.nombre_py, emp.razonsocial_emp, emp.direccion_emp, emp.logo_emp, resp.nombre_resp, py.descripcion_py, py.estado_py, py.fechainicio_py, py.fechafin_py
                FROM ag_proyecto AS py
                INNER JOIN responsables AS resp ON py.responsable_py = resp.id_responsable
                INNER JOIN empresa AS emp ON py.empresa_py = emp.id_empresa
                 WHERE py.id_proyecto = :id_proyecto";
$stmtProyecto = $pdo->prepare($sqlProyecto);
$stmtProyecto->bindParam(':id_proyecto', $id_proyecto, PDO::PARAM_INT);
$stmtProyecto->execute();
$proyecto = $stmtProyecto->fetch(PDO::FETCH_ASSOC);

if (!$proyecto) {
    die("Error: Proyecto no encontrado.");
}

// 2. Consultar datos de las tareas del proyecto
$sqlTareas = "SELECT ta.id_tarea, ta.nombre_ta, ta.fecha_ta, ta.fechareal_ta, cen.nombre_cen, resp.nombre_resp,
                ta.prioridad_ta, ta.estado_ta, ta.programada_ta, ta.detalles_ta, ta.categoria_ta, acc.codigo_acc
              FROM ag_tareas AS ta
              INNER JOIN centros AS cen ON ta.centro_ta = cen.id_centro
              INNER JOIN responsables AS resp ON ta.responsable_ta = resp.id_responsable
              INNER JOIN ag_acciones AS acc ON ta.accionprl_ta = acc.id_accion
              WHERE ta.id_proyecto = :id_proyecto
              ORDER BY ta.fecha_ta ASC"; // Ordenar por fecha
$stmtTareas = $pdo->prepare($sqlTareas);
$stmtTareas->bindParam(':id_proyecto', $id_proyecto, PDO::PARAM_INT);
$stmtTareas->execute();
$tareas = $stmtTareas->fetchAll(PDO::FETCH_ASSOC);

// 3. Consultar datos de actividades para cada tarea
$actividadesPorTarea = [];
foreach ($tareas as $tarea) {
    $id_tarea = $tarea['id_tarea'];

    // Consulta mejorada para obtener las actividades de cada tarea
    $sqlActividades = "SELECT * FROM ag_actividad WHERE id_tarea = :id_tarea";
    $stmtActividades = $pdo->prepare($sqlActividades);
    $stmtActividades->bindParam(':id_tarea', $id_tarea, PDO::PARAM_INT);
    $stmtActividades->execute();

    // Almacenar las actividades por tarea
    $actividadesPorTarea[$id_tarea] = $stmtActividades->fetchAll(PDO::FETCH_ASSOC);
}

class MYPDF extends TCPDF
{
    // Variables del proyecto
    protected $nombre_py;
    protected $razonsocial_emp;
    protected $direccion_emp;
    protected $logo_emp;
    protected $nombre_resp;
    protected $descripcion_py;
    protected $estado_py;
    protected $fechainicio_py;
    protected $fechafin_py;

    // Constructor para pasar las variables del proyecto
    public function __construct($nombre_py, $razonsocial_emp, $direccion_emp, $logo_emp, $nombre_resp, $descripcion_py, $estado_py, $fechainicio_py, $fechafin_py)
    {
        parent::__construct();
        $this->nombre_py = $nombre_py;
        $this->razonsocial_emp = $razonsocial_emp;
        $this->direccion_emp = $direccion_emp;
        $this->logo_emp = $logo_emp;
        $this->nombre_resp = $nombre_resp;
        $this->descripcion_py = $descripcion_py;
        $this->estado_py = $estado_py;
        $this->fechainicio_py = $fechainicio_py;
        $this->fechafin_py = $fechafin_py;
    }

    // Sobrescribir el método Header para personalizar la cabecera
    public function Header()
    {
        // Ruta del logo
        $logo = '../../admin/maestros/centros/img/'. $this->logo_emp;

        // Comprobar si el archivo del logo existe
        if (file_exists($logo)) {
            // Insertar el logo en la cabecera (posición X: 15, Y: 10, ancho: 30)
            $this->Image($logo, 15, 10, 30, '', 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);
        }

        // Establecer la fuente para el encabezado
        $this->SetFont('helvetica', 'B', 12);

        // Mover la posición actual para dejar espacio para el logo
        $this->SetXY(65, 5); // Ajustamos la posición para colocar el texto después del logo

        // Añadir el nombre del proyecto
        $this->Cell(0, 15, 'PROGRAMACIÓN: ' . $this->nombre_py, 0, 1, 'L');

        // Establecer la posición para el responsable y la fecha de inicio
        $this->SetFont('helvetica', 'B', 10);
        $this->SetXY(50, 18); // Ajustamos la posición X para la segunda línea

        // Añadir responsable y fecha de inicio en la misma fila
        $this->Cell(100, 2, 'Responsable: ' . $this->nombre_resp, 0, 0, 'L'); // A la izquierda
        $this->Cell(0, 2, 'Fecha de Inicio: ' . date('d/m/Y', strtotime($this->fechainicio_py)), 0, 1, 'R'); // A la derecha

        // Añadir estado y fecha de fin en la misma línea
        $this->SetXY(50, 23);
        $this->Cell(100, 2, 'Estado: ' . $this->estado_py, 0, 0, 'L'); // A la izquierda
        $this->Cell(0, 2, 'Fecha de Fin: ' . date('d/m/Y', strtotime($this->fechafin_py)), 0, 1, 'R'); // A la derecha

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

        // Añadir el nombre de la empresa o proyecto en el pie de página
        $this->Cell(0, 4, $this->razonsocial_emp, 0, 1, 'C');

        // Añadir la dirección de la empresa o proyecto en el pie de página
        $this->Cell(0, 4, $this->direccion_emp, 0, 1, 'C');
    }
}

// Crear una instancia del PDF con los datos del proyecto
$pdf = new MYPDF($proyecto['nombre_py'], $proyecto['razonsocial_emp'], $proyecto['direccion_emp'], $proyecto['logo_emp'], $proyecto['nombre_resp'], $proyecto['descripcion_py'], $proyecto['estado_py'], $proyecto['fechainicio_py'], $proyecto['fechafin_py']);

// Configuración inicial del PDF
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Proyecto');
$pdf->SetTitle('Programacion Anual');
$pdf->SetSubject('Reporte de Proyecto');
$pdf->SetKeywords('TCPDF, PDF, informe, proyecto');

// Configurar el encabezado y pie de página
$pdf->SetHeaderData('', '', '', '');
$pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// Configuración de márgenes
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// Establecer la fuente para el contenido
$pdf->SetFont('helvetica', '', 9);

// Iniciar página (Primera página, en formato vertical)
$pdf->AddPage();

// Definir contenido HTML del proyecto
$html = '<br><h3>Programa:</h3>';
$html .= '<table border="1" cellpadding="4" width="100%">
          
<tr>
                <td style="width: 25%;"><b>Empresa:</b></td>
                <td style="width: 75%;">' . htmlspecialchars($proyecto['razonsocial_emp']) . '</td>
            </tr>
<tr>
                <td style="width: 25%;"><b>Programación:</b></td>
                <td style="width: 75%;">' . htmlspecialchars($proyecto['nombre_py']) . '</td>
            </tr>
          
            <tr>
                <td style="width: 25%;"><b>Descripción:</b></td>
                <td style="width: 75%;">' . htmlspecialchars($proyecto['descripcion_py']) . '</td>
            </tr>
            <tr>
                <td style="width: 25%;"><b>Estado:</b></td>
                <td style="width: 75%;">' . htmlspecialchars($proyecto['estado_py']) . '</td>
            </tr>
            <tr>
                <td style="width: 25%;"><b>Fecha de Inicio:</b></td>
                <td style="width: 75%;">' . date('d/m/Y', strtotime($proyecto['fechainicio_py'])) . '</td>
            </tr>
            <tr>
                <td style="width: 25%;"><b>Fecha de Fin:</b></td>
                <td style="width: 75%;">' . date('d/m/Y', strtotime($proyecto['fechafin_py'])) . '</td>
            </tr>
          </table><br>';

// Mostrar el contenido inicial del proyecto
$pdf->writeHTML($html, true, false, true, false, '');

// Añadir la página de tareas en formato horizontal (apaisado)
$pdf->AddPage('L'); // 'L' para Landscape (horizontal)

$html = '<br><h3>Tareas programadas</h3>';
$html .= '<table border="1" cellpadding="4" cellspacing="0" style="border-collapse: collapse; width: 100%;">';
$html .= '<thead>
            <tr style="background-color: #003366; color: #FFFFFF; font-size: 10px;"> <!-- Fondo azul marino y texto blanco -->
                <th style="font-weight: bold; text-align: center; width: 40%;">Nombre Tarea</th>
                <th style="font-weight: bold; text-align: center; width: 25%;">Centro</th>
                <th style="font-weight: bold; text-align: center; width: 10%;">Responsable</th>
                <th style="font-weight: bold; text-align: center; width: 25%;">Observaciones</th>
            </tr>
          </thead>';
$html .= '<tbody>';

$meses_es = [
    'January' => 'Enero', 'February' => 'Febrero', 'March' => 'Marzo', 'April' => 'Abril',
    'May' => 'Mayo', 'June' => 'Junio', 'July' => 'Julio', 'August' => 'Agosto',
    'September' => 'Septiembre', 'October' => 'Octubre', 'November' => 'Noviembre', 'December' => 'Diciembre'
];

foreach ($tareas as $tarea) {
    $fecha_obj = new DateTime($tarea['fecha_ta']);
    $mes_ingles = $fecha_obj->format('F'); // Obtiene el mes en inglés
    $mes_espanol = $meses_es[$mes_ingles]; // Traduce el mes al español
    $anio = $fecha_obj->format('Y'); // Obtiene el año

    // Filas de datos de las tareas
    $html .= '<tr>
                <td style="text-align: left; width: 40%;">' . htmlspecialchars($tarea['nombre_ta']) . '</td>
                <td style="text-align: center; width: 25%;">' . htmlspecialchars($tarea['nombre_cen']) . '</td>
                <td style="text-align: center; width: 10%;">' . $mes_espanol . ' ' . $anio . '</td>
                <td style="text-align: left; width: 25%;">' . htmlspecialchars($tarea['detalles_ta']) . '</td>
                 </tr>';
}

$html .= '</tbody></table><br>';

// Añadir el contenido al PDF
$pdf->writeHTML($html, true, false, true, false, '');

// Limpiar el búfer de salida antes de generar el PDF
ob_end_clean();

// Cerrar y enviar el PDF
$pdf->Output('informe_proyecto.pdf', 'I');  // For download
