<?php
require_once('../../app/config.php');
require_once('../../public/TCPDF/tcpdf.php');

$id_epi = $_GET['id_epi'] ?? null;
$id_revision = $_GET['id_revision'] ?? null;

if (!$id_epi || !$id_revision) {
    die("Error: ID de EPI o revisión no proporcionado.");
}

// Incluir los controladores necesarios
include('../../app/controllers/inventario/datos_epis.php');

// 🔹 Obtener datos del EPI
$sql_epi = "SELECT epi.id_epi, ep.nombre_epi, epi.clase_epi, epi.marca_epi, epi.modelo_epi, epi.numserie_epi, epi.aniofab_epi, 
                   epi.estado_epi, epi.marcace_epi, epi.manual_epi, epi.vigencia_epi, 
                   cen.nombre_cen as nombre_cen, emp.razonsocial_emp as razonsocial_emp, emp.direccion_emp as direccion_emp,
                   emp.logo_emp as logo_emp, epi.observaciones_epi, epi.img1_epi, epi.img2_epi 
                   FROM inv_epis AS epi 
                   INNER JOIN epis AS ep ON epi.tipo_epi = ep.id_epi 
                   INNER JOIN centros as cen ON epi.centro_epi = cen.id_centro 
                   INNER JOIN empresa as emp ON cen.empresa_cen = emp.id_empresa 
                   WHERE epi.id_epi = :id_epi";

$stmt_epi = $pdo->prepare($sql_epi);
$stmt_epi->execute([':id_epi' => $id_epi]);
$epi = $stmt_epi->fetch(PDO::FETCH_ASSOC);

if (!$epi) {
    die("Error: No se encontraron datos del EPI.");
}

// 🔹 Obtener datos de la revisión
$sql_revision = "SELECT rev.*, resp.nombre_resp AS nombre_responsable 
                 FROM inv_revision_arnes AS rev
                 INNER JOIN responsables AS resp ON rev.id_responsable = resp.id_responsable
                 WHERE rev.inv_revision_arnes = :id_revision";

$stmt_revision = $pdo->prepare($sql_revision);
$stmt_revision->execute([':id_revision' => $id_revision]);
$revision = $stmt_revision->fetch(PDO::FETCH_ASSOC);

if (!$revision) {
    die("Error: No se encontraron datos de la revisión.");
}

// 🔹 Extraer detalles de la revisión
$correctos = 0;
$incorrectos = 0;

$secciones = [
    'Cintas' => [
        'cintas_hoyos' => 'Cintas con Hoyos',
        'cintas_desalichadas' => 'Cintas Desalichadas',
        'cintas_desgastadas' => 'Cintas Desgastadas',
        'cintas_talladuras' => 'Cintas con Talladuras',
        'cintas_torsion' => 'Cintas con Torsión',
        'cintas_suciedad' => 'Cintas con Suciedad',
        'cintas_quemada' => 'Cintas Quemadas',
        'cintas_pintura' => 'Cintas con Pintura',
        'cintas_degradacion' => 'Cintas con Degradación',
        'cintas_quimicos' => 'Cintas con Químicos',
        'cintas_cortes' => 'Cintas con Cortes',
        'cintas_otros' => 'Otras Anomalías en Cintas'
    ],
    'Costuras' => [
        'costuras_abiertas' => 'Costuras Abiertas',
        'costuras_hebras' => 'Costuras con Hebras Sueltas',
        'costuras_reventadas' => 'Costuras Reventadas',
        'costuras_otros' => 'Otras Anomalías en Costuras'
    ],
    'Metales' => [
        'metales_desgaste' => 'Metales con Desgaste',
        'metales_corrosion' => 'Metales con Corrosión',
        'metales_deformacion' => 'Metales con Deformación',
        'metales_fisuras' => 'Metales con Fisuras',
        'metales_aristas' => 'Metales con Aristas Vivas',
        'metales_otros' => 'Otras Anomalías en Metales'
    ]
];

// Construcción de la tabla con secciones
// Construcción de la tabla con secciones en cuatro columnas con estilos
$tabla_detalles = '';
foreach ($secciones as $titulo => $campos) {
    // Crear la tabla con 4 columnas
    $tabla_detalles .= '<table border="1" cellpadding="3" cellspacing="0" style="border-collapse: collapse; width: 100%;">';

    // Agregar título con fondo gris en toda la línea dentro de la tabla
    $tabla_detalles .= '<tr>
                            <td colspan="4" style="background-color:rgb(0, 81, 148); color: #ffffff; font-weight: bold; font-size: 13px, text-align: left; padding: 5px;">' . $titulo . '</td>
                        </tr>';

    // Encabezados de la tabla
    $tabla_detalles .= '<tr style="background-color: #d9d9d9; font-weight: bold; text-align: center;">
                            <th style="padding: 3px;">Elemento</th>
                            <th style="padding: 3px;">Estado</th>
                            <th style="padding: 3px;">Elemento</th>
                            <th style="padding: 3px;">Estado</th>
                        </tr>';

    $campos_array = array_values($campos);
    $keys = array_keys($campos);
    $total_campos = count($keys);

    // Agregar elementos a la tabla en pares
    for ($i = 0; $i < $total_campos; $i += 2) {
        $nombre1 = $campos_array[$i];
        $estado1 = $revision[$keys[$i]] ?? 'INCORRECTO';
        $color1 = ($estado1 === 'CORRECTO') ? '#b3ffb3' : '#ffb3b3'; // Verde para correcto, rojo para incorrecto

        $nombre2 = ($i + 1 < $total_campos) ? $campos_array[$i + 1] : '';
        $estado2 = ($i + 1 < $total_campos) ? ($revision[$keys[$i + 1]] ?? 'INCORRECTO') : '';
        $color2 = ($estado2 === 'CORRECTO') ? '#b3ffb3' : '#ffb3b3';

        $tabla_detalles .= '<tr>
                                <td style="background-color: #cce5ff; color: #003366; font-weight: bold; padding: 3px;">' . $nombre1 . '</td>
                                <td style="background-color: ' . $color1 . '; text-align: center;">' . $estado1 . '</td>
                                <td style="background-color: #cce5ff; color: #003366; font-weight: bold; padding: 3px;">' . $nombre2 . '</td>
                                <td style="background-color: ' . $color2 . '; text-align: center;">' . $estado2 . '</td>
                            </tr>';
    }

    $tabla_detalles .= '</table><br>';
}


// Definir rutas de imágenes
$image1 = 'img/' . $epi['img1_epi'];
$image2 = 'img/' . $epi['img2_epi'];

$logo_path = '../../admin/maestros/centros/img/' . $epi['logo_emp'];
$razonsocial_emp = $epi['razonsocial_emp'];
$direccion_emp = $epi['direccion_emp'];

// Clase personalizada para modificar la cabecera y el pie de página
class MYPDF extends TCPDF {
    public function Header() {
        global $logo_path, $razonsocial_emp;  // Acceder a las variables globales
    
        // Verificar si el archivo de imagen del logo existe
        if (file_exists($logo_path) && !empty($logo_path)) {
            $this->Image($logo_path, 10, 5, 30); // (X, Y, Ancho)
        }
    
     // Configurar color del texto (Ejemplo: Azul oscuro)
    $this->SetTextColor(109, 109, 109);

    // Configurar fuente y mostrar título centrado
    $this->SetFont('helvetica', 'B', 14);
    $this->Cell(0, 24, $razonsocial_emp, 0, 1, 'R'); // Centrado
    
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

// 🔹 Crear PDF
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf->SetMargins(10, 20, 10);
$pdf->AddPage();
$pdf->SetFont('helvetica', '', 9);

// 🔹 Contenido del PDF con dos columnas para detalles
$html = '<br><h2 style="text-align: center;">REVISIÓN ARNÉS DE SEGURIDAD</h2>
<table border="0" cellpadding="3" cellspacing="0" width="100%">
<tr>
    <td width="33%"><b>EPI:</b> ' . htmlspecialchars($epi['nombre_epi']) . '</td>
    <td width="33%"><b>Marca:</b> ' . htmlspecialchars($epi['marca_epi']) . '</td>
    <td width="33%"><b>Num. Serie:</b> ' . htmlspecialchars($epi['numserie_epi']) . '</td>
</tr>
<tr>
    <td width="33%"><b>Modelo:</b> ' . htmlspecialchars($epi['modelo_epi']) . '</td>
    <td width="33%"><b>Año Fabricación:</b> ' . htmlspecialchars($epi['aniofab_epi']) . '</td>
    <td width="33%"><b>Estado:</b> ' . htmlspecialchars($epi['estado_epi']) . '</td>
</tr>
<tr>
    <td><b>Centro:</b> ' . htmlspecialchars($epi['nombre_cen']) . '</td>
    <td><b>Marca CE:</b> ' . htmlspecialchars($epi['marcace_epi']) .' - <b>Manual Inst.:</b>' . htmlspecialchars($epi['manual_epi']) .'</td>
    <td><b>Caducidad:</b> ' . date('d/m/Y', strtotime($epi['vigencia_epi'])) . '</td>
</tr>
<tr>
    <td colspan="3"><b>Observaciones:</b> ' . htmlspecialchars($epi['observaciones_epi']) . '</td>
</tr>
</table><br><hr>


<table border="0" cellpadding="3" cellspacing="0" width="100%">
<tr>
<td width="33%"><h3><b>Detalles de la Revisión:</b></h3></td>
    <td width="33%"><b>Fecha:</b> ' . date('d/m/Y', strtotime($revision['fecha'])) . '</td>
    <td width="33%"><b>Responsable:</b> ' . htmlspecialchars($revision['nombre_responsable']) . '</td>
</tr>
</table><hr>';

// 🔹 Agregar imágenes debajo de los datos de la revisión
if (file_exists($image1) || file_exists($image2)) {
    $html .= '<h3><b>Imágenes:</b></h3>';
    $html .= '<table border="0" width="100%"><tr>';
    
    if (file_exists($image1)) {
        $html .= '<td style="text-align: center;"><img src="' . $image1 . '" width="100"></td>';
    }
    if (file_exists($image2)) {
        $html .= '<td style="text-align: center;"><img src="' . $image2 . '" width="100"></td>';
    }
    
    $html .= '</tr></table><br><hr>';
}

// 🔹 Agregar elementos de revisión en formato de 4 columnas
$html .= '<h3>Elementos Revisados:</h3>' . $tabla_detalles . '
<br>
<table border="1" cellpadding="5" cellspacing="0" width="100%" style="border-collapse: collapse; margin-top: 10px;">
    <tr>
        <td style="background-color: #cce5ff; color: #000; font-weight: bold; text-align: center; padding: 8px; width: 50%;">VALORACIÓN</td>
        <td style="text-align: center; padding: 8px; font-weight: bold; width: 50%;">' . htmlspecialchars($revision['valoracion_epi']) . '</td>
    </tr>
</table>
<p><b>Observaciones:</b> ' . $revision['observaciones'] . ' </p>';

// Agregar contenido al PDF
$pdf->writeHTML($html, true, false, true, false, '');

// Generar PDF
$pdf->Output('reporte_revision_arnes.pdf', 'I');
