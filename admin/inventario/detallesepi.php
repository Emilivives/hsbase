<?php
include('../../app/config.php');

$id_epi = isset($_GET['id']) ? $_GET['id'] : null;

if ($id_epi) {
    try {
        // Consulta para obtener detalles del EPI
        $sql_detallesepi_datos = "SELECT epi.id_epi as id_epi, 
        ep.nombre_epi as nombre_epi, 
        epi.clase_epi as clase_epi, 
        epi.marca_epi as marca_epi, 
        epi.modelo_epi as modelo_epi, 
        epi.numserie_epi as numserie_epi, 
        cen.nombre_cen as nombre_cen, 
        epi.manual_epi as manual_epi, 
        epi.marcace_epi as marcace_epi, 
        epi.aniofab_epi as aniofab_epi, 
        epi.vigencia_epi as vigencia_epi, 
        epi.estado_epi as estado_epi, 
        epi.observaciones_epi as observaciones_epi, 
        epi.img1_epi, 
        epi.img2_epi 
        FROM inv_epis as epi
        INNER JOIN epis as ep ON epi.tipo_epi = ep.id_epi 
        INNER JOIN centros as cen ON epi.centro_epi = cen.id_centro 
        WHERE epi.id_epi = :id_epi";

        // Consulta para obtener historial de revisiones, incluyendo la ID principal de la revisión
        $sql_revisiones = "SELECT rev.inv_revision_arnes AS id_revision, 
         rev.id_epi_arnes AS id_epi,
        rev.fecha as fecha_revision, 
        resp.nombre_resp as nombre_responsable, 
        rev.observaciones, 
        rev.cintas_hoyos, rev.cintas_desalichadas, rev.cintas_desgastadas, rev.cintas_talladuras, 
        rev.cintas_torsion, rev.cintas_suciedad, rev.cintas_quemada, rev.cintas_pintura, 
        rev.cintas_degradacion, rev.cintas_quimicos, rev.cintas_cortes, rev.costuras_abiertas, 
        rev.costuras_hebras, rev.costuras_reventadas, rev.metales_desgaste, rev.metales_corrosion, 
        rev.metales_deformacion, rev.metales_fisuras, rev.metales_aristas 
        FROM inv_revision_arnes as rev 
        INNER JOIN responsables as resp ON rev.id_responsable = resp.id_responsable 
        WHERE rev.id_epi_arnes = :id_epi 
        ORDER BY rev.fecha DESC";

        // Ejecutar consulta de detalles del equipo
        $stmt = $pdo->prepare($sql_detallesepi_datos);
        $stmt->bindParam(':id_epi', $id_epi, PDO::PARAM_INT);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // Ejecutar consulta de revisiones
        $stmt_rev = $pdo->prepare($sql_revisiones);
        $stmt_rev->bindParam(':id_epi', $id_epi, PDO::PARAM_INT);
        $stmt_rev->execute();
        $revisiones = $stmt_rev->fetchAll(PDO::FETCH_ASSOC);
        
        if ($row) {
            $estado = htmlspecialchars($row['estado_epi']);
            $color_fondo = match ($estado) {
                'Disponible' => 'green',
                'Retirado' => 'red',
                default => 'yellow'
            };

            echo "<div class='d-flex flex-wrap'>";

            // Tarjeta de detalles del equipo
            echo "<div class='card mb-3 me-3' style='width: 20%;'>";
            echo "<div class='card-header' style='background-color: #0080c0;'>";
            echo "<h5 class='card-title' style='color: white; font-weight: bold; margin: 0;'>Detalles del equipo</h5>";
            echo "</div>";
            echo "<div class='card-body'>";
            echo "<p><strong>Tipo:</strong> " . htmlspecialchars($row['nombre_epi']) . "</p>";
            echo "<p><strong>Clase:</strong> " . htmlspecialchars($row['clase_epi']) . "</p>";
            echo "<p><strong>Marca:</strong> " . htmlspecialchars($row['marca_epi']) . "</p>";
            echo "<p><strong>Modelo:</strong> " . htmlspecialchars($row['modelo_epi']) . "</p>";
            echo "<p><strong>Centro de Trabajo:</strong> " . htmlspecialchars($row['nombre_cen']) . "</p>";
            echo "<p><strong>Año de Fabricación:</strong> " . htmlspecialchars($row['aniofab_epi']) . "</p>";
            echo "<p><strong>Estado:</strong> <span style='background-color: $color_fondo; color: white; padding: 5px; border-radius: 5px; display: inline-block;'>" . $estado . "</span></p>";
            echo "<p><strong>Observaciones:</strong> " . htmlspecialchars($row['observaciones_epi']) . "</p>";
            echo "</div>";
            echo "</div>";

               // Tarjeta de historial de revisiones
               echo "<div class='card mb-3 me-3' style='width: 40%;'>";
               echo "<div class='card-header' style='background-color: #0080c0;'>";
               echo "<h5 class='card-title' style='color: white; font-weight: bold; margin: 0;'>Historial de Revisiones</h5>";
               echo "</div>";
               echo "<div class='card-body'>";
               echo "<div class='table-responsive'>";
               echo "<table class='table table-striped table-sm'>";
               echo "<thead>";
               echo "<tr>";
               echo "<th>Fecha</th>";
               echo "<th>Responsable</th>";
               echo "<th>Observaciones</th>";
               echo "<th>✅ Correctos</th>";
               echo "<th>❌ Incorrectos</th>";
               echo "<th>Reporte</th>"; // Nueva columna para el botón PDF
               echo "</tr>";
               echo "</thead>";
               echo "<tbody>";
   
               if (!empty($revisiones)) {
                   foreach ($revisiones as $rev) {
                       $correctos = 0;
                       $incorrectos = 0;
                       
                       foreach ($rev as $key => $value) {
                           if (strpos($key, 'cintas_') !== false || strpos($key, 'costuras_') !== false || strpos($key, 'metales_') !== false) {
                               if ($value === 'CORRECTO') {
                                   $correctos++;
                               } elseif ($value === 'INCORRECTO') {
                                   $incorrectos++;
                               }
                           }
                       }
   
                       echo "<tr>";
                       echo "<td>" . htmlspecialchars(date('d/m/Y', strtotime($rev['fecha_revision']))) . "</td>";
                       echo "<td>" . htmlspecialchars($rev['nombre_responsable']) . "</td>";
                       echo "<td>" . htmlspecialchars($rev['observaciones']) . "</td>";
                       echo "<td style='color: green; font-weight: bold;'>" . $correctos . " ✅</td>";
                       echo "<td style='color: red; font-weight: bold;'>" . $incorrectos . " ❌</td>";
   
                       // Botón para generar el reporte en PDF
                       echo "<td>";
                       if (isset($rev['id_revision'])) {
                        echo "<a href='reporte_revision_arnes.php?id_epi=" . urlencode($rev['id_epi']) . "&id_revision=" . urlencode($rev['id_revision']) . "' target='_blank' class='btn btn-sm btn-danger'>";
                        echo "<i class='fas fa-file-pdf'></i> PDF";
                           echo "</a>";
                       } else {
                           echo "N/A";
                       }
                       echo "</td>";
   
                       echo "</tr>";
                   }
               } else {
                   echo "<tr><td colspan='6' class='text-center'>No hay revisiones registradas.</td></tr>";
               }
   
               echo "</tbody>";
               echo "</table>";
               echo "</div>";
               echo "</div>";
               echo "</div>";

            // Columna de imágenes (20% del ancho)
            echo "<div class='card mb-3 me-3' style='width: 10%;'>"; // Añadir 'me-3' para margen derecho

            // Cabecera de la tarjeta con fondo azul y texto blanco en negrita
            echo "<div class='card-header' style='background-color: #0080c0;'>";
            echo "<h5 class='card-title' style='color: white; font-weight: bold; margin: 0;'>Imágenes equipo</h5>";
            echo "</div>";
            echo "<div class='card-body'>";
            if (!empty($row['img1_epi'])) {
                $img1_path = BASE_URL . '/admin/inventario/img/' . htmlspecialchars($row['img1_epi']);
                echo "<div class='card mb-3'>";
                echo "<img src='" . $img1_path . "' alt='Imagen 1 del epi' class='card-img-top cursor-pointer' 
                      style='object-fit: cover; height: 150px; cursor: pointer;' 
                      onclick='openImageModal(\"" . $img1_path . "\", \"Imagen 1 del equipo\")'>";
                echo "</div>";
            } else {
                echo "<div class='alert alert-warning mb-3'>No hay imagen 1 disponible.</div>";
            }

            if (!empty($row['img2_epi'])) {
                $img2_path = BASE_URL . '/admin/inventario/img/' . htmlspecialchars($row['img2_epi']);
                echo "<div class='card mb-3'>";
                echo "<img src='" . $img2_path . "' alt='Imagen 2 del equipo' class='card-img-top cursor-pointer' 
                      style='object-fit: cover; height: 150px; cursor: pointer;' 
                      onclick='openImageModal(\"" . $img2_path . "\", \"Imagen 2 del epi\")'>";
                echo "</div>";
            } else {
                echo "<div class='alert alert-warning mb-3'>No hay imagen 2 disponible.</div>";
            }
            echo "</div>";
            // Cierre del contenedor principal
            echo "</div>";

            // Columna de imágenes (20% del ancho)
            echo "<div class='card mb-3 me-3' style='width: 10%;'>"; // Añadir 'me-3' para margen derecho
            /*
            // Cabecera de la tarjeta con fondo azul y texto blanco en negrita
            echo "<div class='card-header' style='background-color: #0080c0;'>";
            echo "<h5 class='card-title' style='color: white; font-weight: bold; margin: 0;'>Mantenimiento</h5>";
            echo "</div>";
            echo "<div class='card-body'>";
            if (!empty($row['imgmto1_maq'])) {
                $imgmto1_path = BASE_URL . '/admin/inventario/img/' . htmlspecialchars($row['imgmto1_maq']);
                echo "<div class='card mb-3'>";
                echo "<img src='" . $imgmto1_path . "' alt='Imagen 1 del equipo' class='card-img-top cursor-pointer' 
                         style='object-fit: cover; height: 150px; cursor: pointer;' 
                         onclick='openImageModal(\"" . $imgmto1_path . "\", \"Imagen 1 del equipo\")'>";
                echo "</div>";
            } else {
                echo "<div class='alert alert-warning mb-3'>No hay imagen 1 disponible.</div>";
            }

            if (!empty($row['imgmto2_maq'])) {
                $imgmto2_path = BASE_URL . '/admin/inventario/img/' . htmlspecialchars($row['imgmto2_maq']);
                echo "<div class='card mb-3'>";
                echo "<img src='" . $imgmto2_path . "' alt='Imagen 2 del equipo' class='card-img-top cursor-pointer' 
                         style='object-fit: cover; height: 150px; cursor: pointer;' 
                         onclick='openImageModal(\"" . $imgmto2_path . "\", \"Imagen 2 del equipo\")'>";
                echo "</div>";
            } else {
                echo "<div class='alert alert-warning mb-3'>No hay imagen 2 disponible.</div>";
            }
            echo "</div>";
            // Cierre del contenedor principal
            echo "</div>";

*/

            // Modal para mostrar la imagen en tamaño completo
            // Modal para mostrar la imagen en tamaño completo
            echo "
<div class='modal fade' id='imageModal' tabindex='-1' aria-labelledby='imageModalLabel' aria-hidden='true'>
    <div class='modal-dialog modal-lg modal-dialog-centered'>
        <div class='modal-content'>
            <div class='modal-header'>
                <h5 class='modal-title' id='imageModalLabel'></h5>
                <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
            </div>
            <div class='modal-body text-center'>
                <img id='modalImage' src='' alt='Imagen en tamaño completo' style='max-width: 100%; height: auto;'>
            </div>
            <div class='modal-footer'>
                <button type='button' class='btn btn-primary' onclick='printImage()'>Imprimir</button>
            </div>
        </div>
    </div>
</div>

<script>
function openImageModal(imageSrc, title) {
    const modal = new bootstrap.Modal(document.getElementById('imageModal'));
    document.getElementById('modalImage').src = imageSrc;
    document.getElementById('imageModalLabel').textContent = title;
    modal.show();
}

function printImage() {
    const imageSrc = document.getElementById('modalImage').src; // Obtener la ruta de la imagen
    const newWindow = window.open(''); // Abrir una nueva ventana
    newWindow.document.write('<html><head><title>HS Base</title></head><body>');
    newWindow.document.write('<img src=\"' + imageSrc + '\" style=\"max-width: 100%; height: auto;\"/>'); // Concatenar correctamente
    newWindow.document.write('</body></html>');
    newWindow.document.close();
    newWindow.print(); // Imprimir la imagen
    newWindow.close(); // Cerrar la ventana después de imprimir
}
</script>
";
        } else {
            echo "<div class='alert alert-danger'>No se encontraron detalles para este equipo.</div>";
        }
    } catch (PDOException $e) {
        echo "<div class='alert alert-danger'>Error en la consulta: " . $e->getMessage() . "</div>";
    }
} else {
    echo "<div class='alert alert-danger'>ID de máquina no especificado.</div>";
}
