<?php
include('../../app/config.php');

$id_maquina = isset($_GET['id']) ? $_GET['id'] : null;

if ($id_maquina) {
    try {
        // Consulta para detalles de la máquina
        $sql_detallesmaq_datos = "SELECT maq.id_maquina as id_maquina, 
                                     tm.nombre_tm as nombre_tm, 
                                     tm.clase_tm as clase_tm, 
                                     maq.marca_maq as marca_maq, 
                                     maq.modelo_maq as modelo_maq, 
                                     maq.numserie_maq as numserie_maq, 
                                     maq.proveedor_maq as proveedor_maq, 
                                     cen.nombre_cen as nombre_cen, 
                                     maq.manual_maq as manual_maq, 
                                     maq.marcace_maq as marcace_maq, 
                                     maq.aniofab_maq as aniofab_maq, 
                                     maq.estado_maq as estado_maq, 
                                     maq.epis_maq as epis_maq, 
                                     maq.observaciones_maq as observaciones_maq, 
                                     maq.img1_maq, 
                                     maq.img2_maq,
                                     maq.imgmto1_maq, 
                                     maq.imgmto2_maq
                                FROM inv_maquinaria as maq
                                INNER JOIN tipomaquinas as tm ON maq.tipo_maq = tm.id_tipomaquina
                                INNER JOIN centros as cen ON maq.centro_maq = cen.id_centro
                                WHERE maq.id_maquina = :id_maquina";

        // Consulta para mantenimientos
        $sql_mantenimientos = "SELECT 
            mto.id_mtomaquina as id_mtomaquina,
            mto.fecha_mto as fecha_mto,
            mto.operario_mto as operario_mto,
            mto.detalles_mto as detalles_mto
        FROM 
            mto_maquinaria as mto 
        WHERE 
            mto.id_maquina = :id_maquina
        ORDER BY 
            mto.fecha_mto DESC";

        // Consulta para mantenimientos
        $sql_riesgos = "SELECT 
rgo.id_maquina as id_maquina,
rgo.id_riesgo as id_riesgo,
rg.fraseriesgo as fraseriesgo,
rgo.probabilidad as probabilidad,
rgo.gravedad as gravedad,
rgo.nivelriesgo as nivelriesgo
FROM 
inv_maquinaria_riesgos as rgo
INNER JOIN er_riesgos as rg ON rgo.id_riesgo = rg.id_riesgo
WHERE 
rgo.id_maquina = :id_maquina";

        // Ejecutar consulta de detalles
        $stmt = $pdo->prepare($sql_detallesmaq_datos);
        $stmt->bindParam(':id_maquina', $id_maquina, PDO::PARAM_INT);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

          // Ejecutar consulta de riesgos
          $stmt_rgo = $pdo->prepare($sql_riesgos);
          $stmt_rgo->bindParam(':id_maquina', $id_maquina, PDO::PARAM_INT);
          $stmt_rgo->execute();
          $riesgos = $stmt_rgo->fetchAll(PDO::FETCH_ASSOC);


        // Ejecutar consulta de mantenimientos
        $stmt_mto = $pdo->prepare($sql_mantenimientos);
        $stmt_mto->bindParam(':id_maquina', $id_maquina, PDO::PARAM_INT);
        $stmt_mto->execute();
        $mantenimientos = $stmt_mto->fetchAll(PDO::FETCH_ASSOC);

        if ($row) {
            // Contenedor principal con display flex y wrap
            echo "<div class='d-flex flex-wrap'>";

            // Columna de detalles (40% del ancho)
            echo "<div class='card mb-3 me-3' style='width: 20%;'>";

            // Cabecera de la tarjeta con fondo azul y texto blanco en negrita
            echo "<div class='card-header' style='background-color: #0080c0;'>";
            echo "<h5 class='card-title' style='color: white; font-weight: bold; margin: 0;'>Detalles del equipo</h5>";
            echo "</div>";

            // Cuerpo de la tarjeta
            echo "<div class='card-body'>";
            echo "<p><strong>Tipo:</strong> " . htmlspecialchars($row['nombre_tm']) . "</p>";
            echo "<p><strong>Clase:</strong> " . htmlspecialchars($row['clase_tm']) . "</p>";
            echo "<p><strong>Marca:</strong> " . htmlspecialchars($row['marca_maq']) . "</p>";
            echo "<p><strong>Modelo:</strong> " . htmlspecialchars($row['modelo_maq']) . "</p>";
            echo "<p><strong>Centro de Trabajo:</strong> " . htmlspecialchars($row['nombre_cen']) . "</p>";
            echo "<p><strong>Año de Fabricación:</strong> " . htmlspecialchars($row['aniofab_maq']) . "</p>";
            echo "<p><strong>Proveedor</strong> " . htmlspecialchars($row['proveedor_maq']) . "</p>";
            echo "<p><strong>Estado:</strong> " . htmlspecialchars($row['estado_maq']) . "</p>";
            echo "<p><strong>Epis:</strong> " . htmlspecialchars($row['epis_maq']) . "</p>";
            echo "<p><strong>Observaciones:</strong> " . htmlspecialchars($row['observaciones_maq']) . "</p>";
            echo "</div>";
            echo "</div>";

            // Columna de mantenimiento (35% del ancho)
            echo "<div class='card mb-3 me-3' style='width: 30%;'>";
            // Cabecera de la tarjeta con fondo azul y texto blanco en negrita
            echo "<div class='card-header' style='background-color: #0080c0;'>";
            echo "<h5 class='card-title' style='color: white; font-weight: bold; margin: 0;'>Riesgos del equipo</h5>";
            echo "</div>";
            echo "<div class='card-body'>";

            echo "<div class='table-responsive'>";
            echo "<style>
                    .maintenance-table th.Riesgo { width: 200px; min-width: 150px; }
                    .maintenance-table th.operario { width: 100px; min-width: 90px; }
                    .maintenance-table th.detalles { width: 100px; }
                    .maintenance-table td { vertical-align: middle; }
                    .maintenance-table td.detalles { word-break: break-word; }
                  </style>";
            echo "<table class='table table-striped table-sm maintenance-table'>";
            echo "<thead>";
            echo "<tr>";
            echo "<th class='Riesgo'>Riesgo</th>";
            echo "<th class='operario'>P</th>";
            echo "<th class='detalles'>G</th>";
            echo "<th class='detalles'>Nivel</th>";
            echo "</tr>";
            echo "</thead>";
            echo "<tbody>";
            foreach ($riesgos as $rgo) {
                echo "<tr>";
                echo "<td class='Riesgo'>" . htmlspecialchars($rgo['fraseriesgo']) . "</td>";
                echo "<td class='operario'>" . htmlspecialchars($rgo['probabilidad']) . "</td>";
                echo "<td class='detalles'>" . htmlspecialchars($rgo['gravedad']) . "</td>";
                echo "<td class='detalles'>" . htmlspecialchars($rgo['nivelriesgo']) . "</td>";
                echo "</tr>";
            }
            echo "</tbody>";
            echo "</table>";
            echo "</div>";
            echo "</div>";
            echo "</div>";


            // Columna de mantenimiento (35% del ancho)
            echo "<div class='card mb-3 me-3' style='width: 20%;'>";
            // Cabecera de la tarjeta con fondo azul y texto blanco en negrita
            echo "<div class='card-header' style='background-color: #0080c0;'>";
            echo "<h5 class='card-title' style='color: white; font-weight: bold; margin: 0;'>Historial de Mantenimientos</h5>";
            echo "</div>";
            echo "<div class='card-body'>";

            echo "<div class='table-responsive'>";
            echo "<style>
                       .maintenance-table th.fecha { width: 100px; min-width: 90px; }
                       .maintenance-table th.operario { width: 150px; min-width: 100px; }
                       .maintenance-table th.detalles { width: auto; }
                       .maintenance-table td { vertical-align: middle; }
                       .maintenance-table td.detalles { word-break: break-word; }
                     </style>";
            echo "<table class='table table-striped table-sm maintenance-table'>";
            echo "<thead>";
            echo "<tr>";
            echo "<th class='fecha'>Fecha</th>";
            echo "<th class='operario'>Operario</th>";
            echo "<th class='detalles'>Detalles</th>";
            echo "</tr>";
            echo "</thead>";
            echo "<tbody>";
            foreach ($mantenimientos as $mto) {
                echo "<tr>";
                echo "<td class='fecha'>" . htmlspecialchars(date('d/m/Y', strtotime($mto['fecha_mto']))) . "</td>";
                echo "<td class='operario'>" . htmlspecialchars($mto['operario_mto']) . "</td>";
                echo "<td class='detalles'>" . htmlspecialchars($mto['detalles_mto']) . "</td>";
                echo "</tr>";
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
            if (!empty($row['img1_maq'])) {
                $img1_path = BASE_URL . '/admin/inventario/img/' . htmlspecialchars($row['img1_maq']);
                echo "<div class='card mb-3'>";
                echo "<img src='" . $img1_path . "' alt='Imagen 1 del equipo' class='card-img-top cursor-pointer' 
                      style='object-fit: cover; height: 150px; cursor: pointer;' 
                      onclick='openImageModal(\"" . $img1_path . "\", \"Imagen 1 del equipo\")'>";
                echo "</div>";
            } else {
                echo "<div class='alert alert-warning mb-3'>No hay imagen 1 disponible.</div>";
            }

            if (!empty($row['img2_maq'])) {
                $img2_path = BASE_URL . '/admin/inventario/img/' . htmlspecialchars($row['img2_maq']);
                echo "<div class='card mb-3'>";
                echo "<img src='" . $img2_path . "' alt='Imagen 2 del equipo' class='card-img-top cursor-pointer' 
                      style='object-fit: cover; height: 150px; cursor: pointer;' 
                      onclick='openImageModal(\"" . $img2_path . "\", \"Imagen 2 del equipo\")'>";
                echo "</div>";
            } else {
                echo "<div class='alert alert-warning mb-3'>No hay imagen 2 disponible.</div>";
            }
            echo "</div>";
            // Cierre del contenedor principal
            echo "</div>";


            // Columna de imágenes (20% del ancho)
            echo "<div class='card mb-3 me-3' style='width: 10%;'>"; // Añadir 'me-3' para margen derecho

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
