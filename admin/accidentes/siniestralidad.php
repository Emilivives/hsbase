<?php
include('../../app/config.php');
include('../../admin/layout/parte1.php');
include('../../app/controllers/accidentes/listado_accidentes.php');

?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<head>
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <style>
        .dropdown-font-size {
            font-size: 12px;
        }

        .btn-font-size {
            font-size: 12px;
        }
    </style>
</head>
<html>
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-2">
                <h3 class="m-0">SINIESTRALIDAD</h3>
            </div>
            <div class="col-sm-6 d-flex align-items-center">
                <!-- Formulario para seleccionar el año -->
                <form method="GET" action="siniestralidad.php" class="d-flex w-100">
                    <!-- Label con un tamaño más grande para evitar que se divida en dos filas -->
                    <label for="year" class="mr-3 mb-0" style="white-space: nowrap; min-width: 120px;">Selecciona el Año:</label>
                    <!-- Campo de selección de año -->
                    <select name="year" id="year" class="form-control form-control-sm mr-2" style="max-width: 100px;">
                        <?php
                        // Obtener el año actual o el año seleccionado
                        $current_year = date("Y");  // Obtener el año actual
                        $year_selected = isset($_GET['year']) ? $_GET['year'] : $current_year; // Si no se selecciona, usar el año actual

                        // Generar opciones para el año en el rango de 2020 hasta el año actual
                        for ($i = 2020; $i <= $current_year; $i++) {
                            // Comparar si el año del select es el año seleccionado
                            echo "<option value='$i'" . ($year_selected == $i ? ' selected' : '') . ">$i</option>";
                        }
                        ?>
                    </select>
                    <button type="submit" class="btn btn-primary btn-sm">Filtrar</button>
                </form>
            </div><!-- /.col -->
            <div class="col-sm-3">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="../index.php">Inicio</a></li>
                    <li class="breadcrumb-item"><a href="index.php">Accidentes</a></li>
                    <li class="breadcrumb-item active">Siniestralidad</a></li>
                </ol>
            </div><!-- /.col -->
            <hr class="border-primary">
        </div><!-- /.row -->
    </div><!-- /.row -->
</div><!-- /.container-fluid -->
</div>


<?php
// Recuperar el año seleccionado, si no hay se toma el año actual
$year_selected = isset($_GET['year']) ? $_GET['year'] : date("Y");

// Aquí ya puedes usar $year_selected en todo el código.
?>
<h3 class="text-center">Año: <?php echo $year_selected; ?></h3>


<!-- Estadísticas de Accidentes -->
<div class="row">
    <!-- ./col -->
    <div class="col-lg-2 col-6">
        <!-- small box -->
        <div class="small-box bg-light shadow-sm border">
            <div class="inner">
                <?php
                $contador_de_accidentes = 0;
                foreach ($accidentes_datos as $accidentes_dato) {
                    if (date("Y", strtotime($accidentes_dato['fecha_ace'])) == $year_selected) {
                        $contador_de_accidentes++;
                    }
                }
                ?>
                <h2><?php echo $contador_de_accidentes; ?><sup style="font-size: 20px"></h2>
                <p>Accidentes en <?php echo $year_selected; ?></p>
            </div>
            <div class="icon">
                <i class="fa-solid fa-person-falling-burst"></i>
            </div>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-2 col-6">
        <!-- small box -->
        <div class="small-box bg-light shadow-sm border">
            <div class="inner">
                <?php
                $contador_de_accidentesconbaja = 0;
                foreach ($accidentes_datos as $accidentes_dato) {
                    if (($accidentes_dato['tipoaccidente_ta'] == "Accidente con baja") && (date("Y", strtotime($accidentes_dato['fecha_ace'])) == $year_selected)) {
                        $contador_de_accidentesconbaja++;
                    }
                }
                ?>
                <h2><?php echo $contador_de_accidentesconbaja; ?><sup style="font-size: 20px"></h2>
                <p>Accidentes con Baja en <?php echo $year_selected; ?></p>
            </div>
            <div class="icon">
                <i class="fa-solid fa-hospital-user"></i>
            </div>
        </div>
    </div>

    <!-- ./col -->
    <div class="col-lg-2 col-6">
        <!-- small box -->
        <div class="small-box bg-light shadow-sm border">
            <div class="inner">
                <?php
                $contador_de_accidentessinbaja = 0;
                foreach ($accidentes_datos as $accidentes_dato) {
                    if (($accidentes_dato['tipoaccidente_ta'] == "Accidente sin baja") && (date("Y", strtotime($accidentes_dato['fecha_ace'])) == $year_selected)) {
                        $contador_de_accidentessinbaja++;
                    }
                }
                ?>
                <h2><?php echo $contador_de_accidentessinbaja; ?><sup style="font-size: 20px"></h2>
                <p>Accidentes sin Baja en <?php echo $year_selected; ?></p>
            </div>
            <div class="icon">
                <i class="fa-solid fa-person-chalkboard"></i>
            </div>
        </div>
    </div>

    <!-- ./col -->
    <div class="col-lg-2 col-6">
        <!-- small box -->
        <div class="small-box bg-light shadow-sm border">
            <div class="inner">
                <?php
                $contador_jornadas_perdidas = 0;
                foreach ($accidentes_datos as $accidentes_dato) {
                    if (($accidentes_dato['tipoaccidente_ta'] == "Accidente con baja") && (date("Y", strtotime($accidentes_dato['fecha_ace'])) == $year_selected)) {
                        if (!empty($accidentes_dato['diasbaja_ace']) && is_numeric($accidentes_dato['diasbaja_ace'])) {
                            $contador_jornadas_perdidas += (int)$accidentes_dato['diasbaja_ace'];
                        }
                    }
                }
                ?>
                <h2><?php echo $contador_jornadas_perdidas; ?><sup style="font-size: 20px"></h2>
                <p>Jornadas de trabajo perdidas <?php echo $year_selected; ?></p>
            </div>
            <div class="icon">
                <i class="fa-solid fa-person-chalkboard"></i>
            </div>
        </div>
    </div>

    <!-- ./col -->
    <div class="col-lg-1 col-6">
        <!-- small box -->
        <div class="small-box bg-light shadow-sm border">
            <div class="inner">
                <?php
                include('../../app/controllers/maestros/estadisticas/datos_estadisticas_anio.php');
                $indiciceincidenciaactual = (($contador_de_accidentesconbaja * 100000) / $mediatr_est);
                ?>
                <h2><?php echo round($indiciceincidenciaactual, 2); ?><sup style="font-size: 20px"></h2>
                <p>Indice incidencia /<?php echo $year_selected; ?></p>
            </div>
            <div class="icon">
                <i class="fa-solid fa-hospital-user"></i>
            </div>
        </div>
    </div>

    <!-- ./col -->
    <div class="col-lg-1 col-6">
        <!-- small box -->
        <div class="small-box bg-light shadow-sm border">
            <div class="inner">
                <?php
                include('../../app/controllers/maestros/estadisticas/datos_estadisticas_anio.php');
                $indicefrecuenciaaactual = ($contador_de_accidentesconbaja / ($mediatr_est * 1826)) * 1000000;
                ?>
                <h2><?php echo round($indicefrecuenciaaactual, 2); ?><sup style="font-size: 20px"></h2>
                <p>Indice Frecuencia /<?php echo $year_selected; ?></p>
            </div>
            <div class="icon">
                <i class="fa-solid fa-hospital-user"></i>
            </div>
        </div>
    </div>

    <!-- ./col -->
    <div class="col-lg-1 col-6">
        <!-- small box -->
        <div class="small-box bg-light shadow-sm border">
            <div class="inner">
                <?php
                include('../../app/controllers/maestros/estadisticas/datos_estadisticas_anio.php');
                $indicegravedadactual = ($contador_jornadas_perdidas / ($mediatr_est * 1826)) * 1000;
                ?>
                <h2><?php echo round($indicegravedadactual, 2); ?><sup style="font-size: 20px"></h2>
                <p>Indice Gravedad /<?php echo $year_selected; ?></p>
            </div>
            <div class="icon">
                <i class="fa-solid fa-hospital-user"></i>
            </div>
        </div>
    </div>
</div>


<div class="row">
    <div class="container mt-5">

        <h3 class="text-center mb-4">Índices de Siniestralidad</h3>

        <?php
        // Recuperar el año seleccionado, si no hay se toma el año actual
        $year_selected = isset($_GET['year']) ? $_GET['year'] : date("Y");
        // Consulta para obtener los datos anuales necesarios
        $sql = "SELECT 
        YEAR(ace.fecha_ace) AS anio,
        COUNT(CASE WHEN ta.tipoaccidente_ta = 'Accidente con baja' THEN 1 END) AS accidentes_con_baja,
        COUNT(CASE WHEN ta.tipoaccidente_ta = 'Accidente sin baja' THEN 1 END) AS accidentes_sin_baja, /* Contar solo accidentes sin baja */
        SUM(CASE WHEN ta.tipoaccidente_ta = 'Accidente con baja' THEN ace.diasbaja_ace ELSE 0 END) AS dias_baja_totales,  /* Sumar solo los días de baja de accidentes con baja */
        COUNT(*) AS total_accidentes,  /* Total de accidentes sin filtrar */
        est.mediatr_est AS total_trabajadores,  /* Selección directa de trabajadores promedio por año */
        SUM(est.horastranual_est * est.mediatr_est) AS horas_trabajo_totales,
        MAX(est.indinciden_est) AS indice_sector
    FROM accidentes AS ace
    LEFT JOIN ace_tipoaccidente AS ta ON ace.tipoaccidente_ace = ta.id_tipoaccidente
    INNER JOIN estadisticas AS est ON YEAR(ace.fecha_ace) = est.anio_est
    WHERE ta.tipoaccidente_ta IN ('Accidente con baja', 'Accidente sin baja')  /* Filtrar solo accidentes con o sin baja */
    GROUP BY YEAR(ace.fecha_ace)
    ORDER BY anio;
    ";

        try {
            // Preparar y ejecutar la consulta
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Verificar si hay resultados
            if (count($result) > 0) {
                echo "<table class='table table-bordered table-striped table-hover'>
                <thead class='table-primary'>
                    <tr>
                        <th>Año</th>
                        <th>Índice de Frecuencia (IF)</th>
                        <th>Índ. Frec. Sin baja(IFsb)</th> <!-- Nueva columna -->
                        <th>Índice de Gravedad (IG)</th>
                        <th>Índice de Incidencia (II)</th>
                        <th>Duración Media (DM)</th>
                        <th>Índice del Sector</th>
                    </tr>
                </thead>
                <tbody>";

                foreach ($result as $row) {
                    // Variables calculadas
                    $anio = $row['anio'];
                    $accidentes_con_baja = $row['accidentes_con_baja'];
                    $accidentes_sin_baja = $row['accidentes_sin_baja'];
                    $dias_baja_totales = $row['dias_baja_totales'];
                    $total_accidentes = $row['total_accidentes'];
                    $total_trabajadores = $row['total_trabajadores'];
                    $horas_trabajo_totales = $row['horas_trabajo_totales'];
                    $indice_sector = $row['indice_sector'];

                    // Cálculos
                    $indice_frecuencia = ($accidentes_con_baja / $horas_trabajo_totales) * 1000000;
                    $indice_frecuencia_sin_baja = ($accidentes_sin_baja / $horas_trabajo_totales) * 1000000; // Cálculo para accidentes sin baja
                    $indice_gravedad = ($dias_baja_totales / $horas_trabajo_totales) * 1000;
                    $indice_incidencia = ($accidentes_con_baja * 100000) / $total_trabajadores;
                    // Cálculo de la duración media de baja
                    if ($accidentes_con_baja > 0) {
                        $duracion_media = $dias_baja_totales / $accidentes_con_baja;
                    } else {
                        $duracion_media = 0; // Si no hay accidentes con baja, duración media es 0
                    }

                    // Guardar los datos para el gráfico
                    $years[] = $anio;
                    $duracion_media_baja[] = round($duracion_media, 2);  // Redondear a 2 decimales

                    // Mostrar fila de la tabla
                    echo "<tr>
                    <td>{$anio}</td>
                    <td>" . number_format($indice_frecuencia, 2) . "</td>
                    <td>" . number_format($indice_frecuencia_sin_baja, 2) . "</td> 
                    <td>" . number_format($indice_gravedad, 2) . "</td>
                    <td>" . number_format($indice_incidencia, 2) . "</td>
                    <td>" . number_format($duracion_media, 2) . "</td>
                    <td>" . number_format($indice_sector, 2) . "</td>
                </tr>";
                }

                echo "</tbody></table>";
            } else {
                echo "<div class='alert alert-warning text-center'>No se encontraron resultados.</div>";
            }
        } catch (PDOException $e) {
            echo "<div class='alert alert-danger text-center'>Error en la consulta: " . $e->getMessage() . "</div>";
        }
        ?>

    </div>

    <h3 class="text-center mt-5 mb-4">Siniestralidad por Categoría y Centros (Año)</h3>

    <div class="container mt-4">
        <div class="row">
            <!-- Columna para la tabla de accidentes por categoría -->
            <div class="col-md-6">
                <?php
                // Recuperar el año seleccionado, si no hay se toma el año actual
                $year_selected = isset($_GET['year']) ? $_GET['year'] : date("Y");

                // Consulta para obtener los datos de siniestralidad por categoría y año
                $sql_categoria = "SELECT 
                cat.nombre_cat AS categoria,
                COUNT(CASE WHEN ta.tipoaccidente_ta = 'Accidente con baja' THEN 1 END) AS con_baja,
                COUNT(CASE WHEN ta.tipoaccidente_ta = 'Accidente sin baja' THEN 1 END) AS sin_baja,
                COUNT(CASE WHEN ta.tipoaccidente_ta = 'In itinere con baja' THEN 1 END) AS in_itinere_baja,
                COUNT(CASE WHEN ta.tipoaccidente_ta = 'In itinere sin baja' THEN 1 END) AS in_itinere_sin_baja,
                COUNT(*) AS total_accidentes  -- Total de todos los accidentes
            FROM accidentes AS ace
            INNER JOIN trabajadores AS tr ON ace.trabajador_ace = tr.id_trabajador
            INNER JOIN  categorias AS cat ON tr.categoria_tr = cat.id_categoria
            INNER JOIN ace_tipoaccidente AS ta ON ace.tipoaccidente_ace = ta.id_tipoaccidente
            WHERE YEAR(ace.fecha_ace) = :year
            GROUP BY cat.nombre_cat
            ORDER BY cat.nombre_cat;
            ";

                try {
                    // Preparar y ejecutar la consulta, con el filtro de año
                    $stmt = $pdo->prepare($sql_categoria);
                    $stmt->bindParam(':year', $year_selected, PDO::PARAM_INT);
                    $stmt->execute();
                    $result_categoria = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    // Verificar si hay resultados
                    if (count($result_categoria) > 0) {
                        echo "<table class='table table-bordered table-striped table-hover'>
                    <thead class='table-success'>
                        <tr>
                            <th>Categoría</th>
							   <th>Total accidentes</th>
                            <th>Accidentes con Baja</th>
                            <th>Accidentes sin Baja</th>
                            <th>In Itinere con Baja</th>
                            <th>In Itinere sin Baja</th>
                        </tr>
                    </thead>
                    <tbody>";

                        foreach ($result_categoria as $row) {
                            echo "<tr>
                        <td>{$row['categoria']}</td>
						   <td>{$row['total_accidentes']}</td>
                        <td>{$row['con_baja']}</td>
                        <td>{$row['sin_baja']}</td>
                        <td>{$row['in_itinere_baja']}</td>
                        <td>{$row['in_itinere_sin_baja']}</td>
                    </tr>";
                        }

                        echo "</tbody></table>";
                    } else {
                        echo "<div class='alert alert-warning text-center'>No se encontraron resultados para el año $year_selected.</div>";
                    }
                } catch (PDOException $e) {
                    echo "<div class='alert alert-danger text-center'>Error en la consulta: " . $e->getMessage() . "</div>";
                }
                ?>
            </div>

            <!-- Columna para la tabla de accidentes por centro de trabajo -->
            <div class="col-md-6">
                <?php
                // Consulta para obtener los datos de siniestralidad por centro de trabajo y año
                $sql_centro = "SELECT 
                cen.nombre_cen AS centro_trabajo,
                COUNT(ace.id_accidente) AS total_accidentes,
                COUNT(CASE WHEN ta.tipoaccidente_ta = 'Accidente con baja' THEN 1 END) AS accidentes_con_baja,
                COUNT(CASE WHEN ta.tipoaccidente_ta = 'Accidente sin baja' THEN 1 END) AS accidentes_sin_baja
            FROM accidentes AS ace
            INNER JOIN centros AS cen ON ace.centro_ace = cen.id_centro
            LEFT JOIN ace_tipoaccidente AS ta ON ace.tipoaccidente_ace = ta.id_tipoaccidente
            WHERE YEAR(ace.fecha_ace) = :year
            GROUP BY cen.nombre_cen
            ORDER BY total_accidentes DESC;
            ";
                try {
                    // Preparar y ejecutar la consulta, con el filtro de año
                    $stmt = $pdo->prepare($sql_centro);
                    $stmt->bindParam(':year', $year_selected, PDO::PARAM_INT);
                    $stmt->execute();
                    $result_centro = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    // Verificar si hay resultados
                    if (count($result_centro) > 0) {
                        echo "<table class='table table-bordered table-striped table-hover'>
                        <thead class='table-success'>
                            <tr>
                                <th>Centro de Trabajo</th>
                                <th>Total de Accidentes</th>
                                <th>Accidentes con Baja</th>
                                <th>Accidentes sin Baja</th>
                            </tr>
                        </thead>
                        <tbody>";

                        foreach ($result_centro as $row) {
                            echo "<tr>
                            <td>{$row['centro_trabajo']}</td>
                            <td>{$row['total_accidentes']}</td>
                            <td>{$row['accidentes_con_baja']}</td> <!-- Columna para accidentes con baja -->
                            <td>{$row['accidentes_sin_baja']}</td> <!-- Columna para accidentes sin baja -->
                        </tr>";
                        }

                        echo "</tbody></table>";
                    } else {
                        echo "<div class='alert alert-warning text-center'>No se encontraron resultados para el año $year_selected.</div>";
                    }
                } catch (PDOException $e) {
                    echo "<div class='alert alert-danger text-center'>Error en la consulta: " . $e->getMessage() . "</div>";
                }
                ?>
            </div>
        </div>
    </div>



    <?php
    // Obtener el año seleccionado, si no se ha seleccionado, se toma el año actual
    $year_selected = isset($_GET['year']) ? $_GET['year'] : date("Y");

    // Realizar la consulta SQL filtrando por el año
    $sql = "SELECT ace.id_accidente as id_accidente,
           ace.nroaccidente_ace as nroaccidente_ace,
           ace.fecha_ace as fecha_ace,
           ace.hora_ace as hora_ace,
           ace.diasbaja_ace as diasbaja_ace,
           ace.tipoaccidente_ace as tipoaccidente_ace
    FROM `accidentes` ace
    WHERE YEAR(ace.fecha_ace) = :year
";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['year' => $year_selected]);
    $accidentes = $stmt->fetchAll(PDO::FETCH_ASSOC);
    ?>





    <?php
    // Datos para el gráfico de media duracion baja
    // Consulta SQL para obtener la duración media de los días de baja por año
    $sql_duracion_media = "SELECT 
    YEAR(ace.fecha_ace) AS anio,
    COUNT(CASE WHEN ta.tipoaccidente_ta = 'Accidente con baja' AND (ace.fechabaja_ace IS NOT NULL) THEN 1 END) AS accidentes_con_baja,
    SUM(CASE WHEN ta.tipoaccidente_ta = 'Accidente con baja' AND (ace.fechabaja_ace IS NOT NULL) THEN ace.diasbaja_ace ELSE 0 END) AS dias_baja_totales
FROM accidentes AS ace
    LEFT JOIN ace_tipoaccidente AS ta ON ace.tipoaccidente_ace = ta.id_tipoaccidente
WHERE ace.diasbaja_ace IS NOT NULL  -- Aseguramos que haya días de baja
GROUP BY YEAR(ace.fecha_ace)
ORDER BY anio;
";

    // Ejecutar la consulta y preparar los datos
    try {
        $stmt = $pdo->prepare($sql_duracion_media);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Preparar los datos para el gráfico
        $years = [];
        $duracion_media_baja = [];

        foreach ($result as $row) {
            $anio = $row['anio'];
            $accidentes_con_baja = $row['accidentes_con_baja'];
            $dias_baja_totales = $row['dias_baja_totales'];

            // Cálculo de la duración media de baja
            if ($accidentes_con_baja > 0) {
                $duracion_media = $dias_baja_totales / $accidentes_con_baja;
            } else {
                $duracion_media = 0;
            }

            // Guardar los datos para el gráfico
            $years[] = $anio;
            $duracion_media_baja[] = round($duracion_media, 2);  // Redondear a 2 decimales
        }
    } catch (PDOException $e) {
        echo "<div class='alert alert-danger text-center'>Error en la consulta: " . $e->getMessage() . "</div>";
    }
    ?>

    <?php
    // Consulta SQL para obtener los datos del índice de incidencia por año
    $sql = "SELECT 
    YEAR(ace.fecha_ace) AS anio,
    COUNT(CASE WHEN ta.tipoaccidente_ta = 'Accidente con baja' THEN 1 END) AS accidentes_con_baja,
    COUNT(CASE WHEN ta.tipoaccidente_ta = 'Accidente sin baja' AND ace.diasbaja_ace > 0 THEN 1 END) AS accidentes_con_baja_in_itinere,  /* Incluir accidentes in itinere con baja */
    SUM(ace.diasbaja_ace) AS dias_baja_totales,
    COUNT(*) AS total_accidentes,
    est.mediatr_est AS total_trabajadores,  /* Ahora seleccionamos directamente mediatr_est del año correspondiente */
    SUM(est.horastranual_est * est.mediatr_est) AS horas_trabajo_totales,
    MAX(est.indinciden_est) AS indice_sector
FROM accidentes AS ace
LEFT JOIN ace_tipoaccidente AS ta ON ace.tipoaccidente_ace = ta.id_tipoaccidente
INNER JOIN estadisticas AS est ON YEAR(ace.fecha_ace) = est.anio_est
GROUP BY YEAR(ace.fecha_ace)
ORDER BY anio;
";

    // Ejecutar la consulta y preparar los datos
    try {
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Preparar los datos para el gráfico
        $years = [];
        $indices_incidencia = [];

        foreach ($result as $row) {
            $anio = $row['anio'];
            $accidentes_con_baja = $row['accidentes_con_baja'];
            $dias_baja_totales = $row['dias_baja_totales'];
            $total_accidentes = $row['total_accidentes'];
            $total_trabajadores = $row['total_trabajadores'];  // Sumamos los trabajadores por año

            // Cálculo del índice de incidencia (II)
            if ($total_trabajadores > 0) {
                $indice_incidencia = ($accidentes_con_baja / $total_trabajadores) * 100_000;
            } else {
                $indice_incidencia = 0;
            }

            // Guardar los datos para el gráfico
            $years[] = $anio;
            $indices_incidencia[] = round($indice_incidencia, 2);  // Redondear a 2 decimales
        }
    } catch (PDOException $e) {
        echo "<div class='alert alert-danger text-center'>Error en la consulta: " . $e->getMessage() . "</div>";
    }
    ?>




    <?php
    // Datos para el gráfico de accidentes por mes del año
    // Obtener los datos de accidentes por mes
    $sqlMeses = "SELECT MONTH(fecha_ace) AS mes, COUNT(*) AS total 
             FROM accidentes 
             WHERE YEAR(fecha_ace) = :year
             GROUP BY mes
             ORDER BY mes";
    $stmtMeses = $pdo->prepare($sqlMeses);
    $stmtMeses->execute([':year' => $year_selected]);
    $datosMeses = $stmtMeses->fetchAll(PDO::FETCH_ASSOC);

    // Crear las etiquetas y valores para el gráfico
    $etiquetasMeses = [];
    $valoresMeses = [];
    foreach ($datosMeses as $dato) {
        $etiquetasMeses[] = DateTime::createFromFormat('!m', $dato['mes'])->format('F'); // Nombre del mes
        $valoresMeses[] = $dato['total'];
    }


    // Obtener accidentes por días de la semana del año seleccionado
    $sqlDias = "SELECT DAYOFWEEK(fecha_ace) AS dia_semana, COUNT(*) AS total_accidentes
    FROM accidentes
    WHERE YEAR(fecha_ace) = :year
    GROUP BY dia_semana
    ORDER BY dia_semana ASC
";
    $stmtDias = $pdo->prepare($sqlDias);
    $stmtDias->execute(['year' => $year_selected]);
    $accidentesDias = $stmtDias->fetchAll(PDO::FETCH_ASSOC);
    // Inicializar los datos del gráfico con ceros
    $diasSemana = ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'];
    $accidentesPorDia = array_fill(0, 7, 0);
    // Rellenar los datos con la consulta
    foreach ($accidentesDias as $accidenteDia) {
        $index = $accidenteDia['dia_semana'] - 1; // Convertir el índice de 1-7 a 0-6
        $accidentesPorDia[$index] = $accidenteDia['total_accidentes'];
    }


    // Obtener accidentes por hora del trabajo del dia del año seleccionado
    $sqlHoras = "
    SELECT horatrabajo_ace AS hora, COUNT(*) AS total_accidentes
    FROM accidentes
    WHERE YEAR(fecha_ace) = :year
    GROUP BY horatrabajo_ace
    ORDER BY horatrabajo_ace ASC
";
    $stmtHoras = $pdo->prepare($sqlHoras);
    $stmtHoras->execute(['year' => $year_selected]);
    $accidentesHoras = $stmtHoras->fetchAll(PDO::FETCH_ASSOC);

    // Inicializar datos para todas las horas de trabajo (1 a 24)
    $accidentesPorHora = array_fill(1, 24, 0);

    // Rellenar los datos con la consulta
    foreach ($accidentesHoras as $accidenteHora) {
        $hora = (int)$accidenteHora['hora'];
        $accidentesPorHora[$hora] = $accidenteHora['total_accidentes'];
    }

    // Obtener datos para grafico combinado (centro x categoria)
    $sql_categoria = "SELECT 
    cat.nombre_cat AS categoria,
    COUNT(CASE WHEN ta.tipoaccidente_ta = 'Accidente con baja' THEN 1 END) AS accidentes_con_baja,
    COUNT(CASE WHEN ta.tipoaccidente_ta = 'Accidente sin baja' THEN 1 END) AS accidentes_sin_baja,
    COUNT(CASE WHEN ta.tipoaccidente_ta = 'In itinere con baja' THEN 1 END) AS in_itinere_con_baja,
    COUNT(CASE WHEN ta.tipoaccidente_ta = 'In itinere sin baja' THEN 1 END) AS in_itinere_sin_baja
FROM accidentes AS ace
INNER JOIN trabajadores AS tr ON ace.trabajador_ace = tr.id_trabajador
INNER JOIN categorias AS cat ON tr.categoria_tr = cat.id_categoria
INNER JOIN ace_tipoaccidente AS ta ON ace.tipoaccidente_ace = ta.id_tipoaccidente
WHERE YEAR(ace.fecha_ace) = :year
GROUP BY cat.nombre_cat
ORDER BY cat.nombre_cat";
    $sql_centro = "SELECT  
cen.nombre_cen AS centro_trabajo,
COUNT(CASE WHEN ta.tipoaccidente_ta = 'Accidente con baja' THEN 1 END) AS accidentes_con_baja,
COUNT(CASE WHEN ta.tipoaccidente_ta = 'Accidente sin baja' THEN 1 END) AS accidentes_sin_baja,
COUNT(CASE WHEN ta.tipoaccidente_ta = 'Accidente in itinere con baja' THEN 1 END) AS in_itinere_con_baja,
COUNT(CASE WHEN ta.tipoaccidente_ta = 'Accidente in itinere sin baja' THEN 1 END) AS in_itinere_sin_baja
FROM accidentes AS ace
INNER JOIN centros AS cen ON ace.centro_ace = cen.id_centro
LEFT JOIN ace_tipoaccidente AS ta ON ace.tipoaccidente_ace = ta.id_tipoaccidente
WHERE YEAR(ace.fecha_ace) = :year
GROUP BY cen.nombre_cen
ORDER BY cen.nombre_cen";

    ?>
    <?php
    // Preparar los datos de las consultas para pasarlos a JS
    $centros = [];
    $accidentes_con_baja_centro = [];
    $accidentes_sin_baja_centro = [];
    $in_itinere_con_baja_centro = [];
    $in_itinere_sin_baja_centro = [];
    $categorias = [];
    $accidentes_con_baja_categoria = [];
    $accidentes_sin_baja_categoria = [];
    $in_itinere_con_baja_categoria = [];
    $in_itinere_sin_baja_categoria = [];

    try {
        // Ejecutar consulta de centros de trabajo
        $stmt = $pdo->prepare($sql_centro);
        $stmt->bindParam(':year', $year_selected, PDO::PARAM_INT);
        $stmt->execute();
        $result_centro = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($result_centro as $row) {
            $centros[] = $row['centro_trabajo'];
            $accidentes_con_baja_centro[] = $row['accidentes_con_baja'];
            $accidentes_sin_baja_centro[] = $row['accidentes_sin_baja'];
            $in_itinere_con_baja_centro[] = $row['in_itinere_con_baja'];
            $in_itinere_sin_baja_centro[] = $row['in_itinere_sin_baja'];
        }

        // Ejecutar consulta de categorías
        $stmt = $pdo->prepare($sql_categoria);
        $stmt->bindParam(':year', $year_selected, PDO::PARAM_INT);
        $stmt->execute();
        $result_categoria = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($result_categoria as $row) {
            $categorias[] = $row['categoria'];
            $accidentes_con_baja_categoria[] = $row['accidentes_con_baja'];
            $accidentes_sin_baja_categoria[] = $row['accidentes_sin_baja'];
            $in_itinere_con_baja_categoria[] = $row['in_itinere_con_baja'];
            $in_itinere_sin_baja_categoria[] = $row['in_itinere_sin_baja'];
        }
    } catch (PDOException $e) {
        echo "<div class='alert alert-danger text-center'>Error en la consulta: " . $e->getMessage() . "</div>";
    }
    ?>


    <div class="container mt-4">
        <h3 class="text-center mt-5 mb-4">Graficos comparativos</h3>
        <div class="row">
            <div class="col-md-4"> <!-- Cada gráfico ocupa 4 columnas de 12 -->
                <h5 class="text-center">Promedio duracion bajas año</h5>
                <!-- El gráfico se colocará en un solo div de 12 columnas -->
                <canvas id="graficoDuracionMediaBaja" style="width:100%; max-height:400px;"></canvas>
            </div>


            <div class="col-md-4"> <!-- Cada gráfico ocupa 4 columnas de 12 -->
                <h5 class="text-center">Evolucion indice incidencia</h5>
                <!-- El gráfico se colocará en un solo div de 12 columnas -->
                <canvas id="graficoIndiceIncidencia" style="width:100%; max-height:400px;"></canvas>
            </div>

            <div class="col-md-4"> <!-- Cada gráfico ocupa 4 columnas de 12 -->
                <h5 class="text-center">Evolucion indice incidencia</h5>
                <!-- El gráfico se colocará en un solo div de 12 columnas -->
                <canvas id="grafico_combinado" style="width:100%; max-height:400px;"></canvas>
            </div>

        </div>
    </div>


    <div class="container mt-4">
        <h3 class="text-center mt-5 mb-4">Accidentes: Día, Hora y Mes</h3>
        <div class="row">
            <!-- Gráfico de meses -->
            <div class="col-md-4"> <!-- Cada gráfico ocupa 4 columnas de 12 -->
                <h5 class="text-center">Accidentes por Mes del Año</h5>
                <canvas id="graficoMeses" style="width:100%; max-height:300px;"></canvas>
            </div>

            <!-- Gráfico de días -->
            <div class="col-md-4"> <!-- Cada gráfico ocupa 4 columnas de 12 -->
                <h5 class="text-center">Accidentes por Día de la Semana</h5>
                <canvas id="graficoDias" style="width:100%; max-height:300px;"></canvas>
            </div>

            <!-- Gráfico de horas -->
            <div class="col-md-4"> <!-- Cada gráfico ocupa 4 columnas de 12 -->
                <h5 class="text-center">Accidentes por Hora del Día</h5>
                <canvas id="graficoHoras" style="width:100%; max-height:300px;"></canvas>
            </div>


        </div>
    </div>


    <?php
    $sql = "SELECT 
    pc.partecuerpo_pc, 
    COUNT(ace.id_accidente) as total_accidentes
FROM accidentes AS ace
INNER JOIN ace_partecuerpo AS pc ON ace.partecuerpo_ace = pc.id_partecuerpo
WHERE YEAR(ace.fecha_ace) = :year
GROUP BY pc.partecuerpo_pc
ORDER BY total_accidentes DESC";

    // Obtener el año desde el filtro
    $year = isset($_GET['year']) ? $_GET['year'] : date('Y');

    // Ejecutar la consulta SQL
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['year' => $year]);
    $data_partecuerpo = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Preparar los datos para el gráfico
    $partes_cuerpo = [];
    $accidentes_por_parte = [];

    $max_length = 15;  // Establecer la longitud máxima deseada
    foreach ($data_partecuerpo as $row) {
        // Usar substr() para cortar las etiquetas
        $partes_cuerpo[] = substr($row['partecuerpo_pc'], 0, $max_length) . (strlen($row['partecuerpo_pc']) > $max_length ? '...' : '');  // Añadir '...' si la etiqueta es muy larga
        $accidentes_por_parte[] = $row['total_accidentes'];
    }

    // Consulta SQL para obtener el tipo de lesión y contar los accidentes
    $sql = "SELECT 
    tl.tipolesion_tl, 
    COUNT(ace.id_accidente) as total_accidentes
FROM accidentes AS ace
INNER JOIN ace_tipolesion AS tl ON ace.tipolesion_ace = tl.id_tipolesion
WHERE YEAR(ace.fecha_ace) = :year
GROUP BY tl.tipolesion_tl
ORDER BY total_accidentes DESC";

    // Obtener el año desde el filtro
    $year = isset($_GET['year']) ? $_GET['year'] : date('Y');

    // Ejecutar la consulta SQL
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['year' => $year]);
    $data_tipolesion = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Preparar los datos para el gráfico
    $tipos_lesion = [];
    $accidentes_por_lesion = [];

    $max_length = 15;  // Establecer la longitud máxima deseada
    foreach ($data_tipolesion as $row) {
        // Recortar las etiquetas si son largas
        $tipos_lesion[] = substr($row['tipolesion_tl'], 0, $max_length) . (strlen($row['tipolesion_tl']) > $max_length ? '...' : '');
        $accidentes_por_lesion[] = $row['total_accidentes'];
    }

    ?>

    <?php
    $sql_categoria_chart = "SELECT 
cat.nombre_cat AS categoria,
COUNT(*) AS total_accidentes  -- Total de todos los accidentes
FROM accidentes AS ace
INNER JOIN trabajadores AS tr ON ace.trabajador_ace = tr.id_trabajador
INNER JOIN categorias AS cat ON tr.categoria_tr = cat.id_categoria
WHERE YEAR(ace.fecha_ace) = :year
GROUP BY cat.nombre_cat
ORDER BY total_accidentes DESC;
";

    try {
        // Preparar y ejecutar la consulta
        $stmt = $pdo->prepare($sql_categoria_chart);
        $stmt->bindParam(':year', $year_selected, PDO::PARAM_INT); // Filtramos por el año seleccionado
        $stmt->execute();
        $result_categoria = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Variables para el gráfico
        $categorias = [];
        $accidentes_totales = [];

        foreach ($result_categoria as $row) {
            $categorias[] = $row['categoria']; // Nombres de las categorías
            $accidentes_totales[] = $row['total_accidentes']; // Total de accidentes
        }
    } catch (PDOException $e) {
        echo "<div class='alert alert-danger text-center'>Error en la consulta: " . $e->getMessage() . "</div>";
    }
    ?>
    <?php
    // Consulta SQL para calcular la media de días entre accidente e investigación, agrupada por mes
    $sql = "SELECT 
    MONTH(ace.fecha_ace) AS mes,
    AVG(DATEDIFF(ace.fechainvestiga_ace, ace.fecha_ace)) AS media_dias,
    COUNT(*) AS accidentes
FROM accidentes AS ace
WHERE 
    YEAR(ace.fecha_ace) = :year
    AND ace.fechainvestiga_ace IS NOT NULL
    AND ace.fecha_ace IS NOT NULL
GROUP BY MONTH(ace.fecha_ace)
ORDER BY mes;

";

    // Obtener el año desde el filtro o el año actual por defecto
    $year = isset($_GET['year']) ? $_GET['year'] : date('Y');

    // Ejecutar la consulta SQL
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['year' => $year]);
    $data_tiempo_medio = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Preparar los datos para la gráfica
    $meses = [
        1 => 'Enero',
        2 => 'Febrero',
        3 => 'Marzo',
        4 => 'Abril',
        5 => 'Mayo',
        6 => 'Junio',
        7 => 'Julio',
        8 => 'Agosto',
        9 => 'Septiembre',
        10 => 'Octubre',
        11 => 'Noviembre',
        12 => 'Diciembre'
    ];


   // Inicializar los datos acumulativos
$media_por_mes = array_fill(1, 12, 0); // Inicializar todos los meses con 0
$accidentes_acumulados = 0;
$tiempo_acumulado = 0;

// Procesar los datos obtenidos de la consulta
foreach ($data_tiempo_medio as $row) {
    $mes = intval($row['mes']);
    $media_mes = $row['media_dias']; // Media para ese mes
    
    // Convertir la media a tiempo total acumulado y accidentes
    $accidentes_en_mes = $row['accidentes']; // Supongamos que incluyes este dato en la consulta SQL
    $tiempo_acumulado_mes = $media_mes * $accidentes_en_mes;

    // Actualizar acumulativos
    $tiempo_acumulado += $tiempo_acumulado_mes;
    $accidentes_acumulados += $accidentes_en_mes;

    // Calcular la media acumulativa hasta este mes
    $media_por_mes[$mes] = $tiempo_acumulado / $accidentes_acumulados;
}

// Rellenar meses sin datos usando el último valor conocido
$ultimo_valor = null;
foreach ($media_por_mes as $mes => $media) {
    if ($media == 0 && $ultimo_valor !== null) {
        $media_por_mes[$mes] = $ultimo_valor; // Heredar el último valor conocido
    } elseif ($media > 0) {
        $ultimo_valor = $media; // Actualizar el último valor conocido
    }
}

// Separar los datos para usarlos en la gráfica
$labels = array_values($meses);
$valores = array_values($media_por_mes);
?>

    <div class="container mt-4">
        <h3 class="text-center mt-5 mb-4">Tipo Lesiones y zonas del cuerpo afectadas</h3>
        <div class="row">

            <!-- Gráfico de partes del cuerpo afectadas -->
            <div class="col-md-4"> <!-- Cada gráfico ocupa 4 columnas de 12 -->
                <h5 class="text-center">Accidentes por Parte del Cuerpo Afectada</h5>
                <canvas id="graficoPartesCuerpo" style="width:100%; max-height:300px;"></canvas>
            </div>
            <!-- Gráfico de tipo lesions -->
            <div class="col-md-4"> <!-- Cada gráfico ocupa 4 columnas de 12 -->
                <h5 class="text-center">Accidentes por Tipo de Lesión</h5>
                <canvas id="graficoLesiones" style="width:100%; max-height:300px;"></canvas>
            </div>
            <!-- Gráfico por categorias -->
            <div class="col-md-4"> <!-- Cada gráfico ocupa 4 columnas de 12 -->
                <h5 class="text-center">Accidentes por categorias</h5>
                <canvas id="graficoPastelAccidentes" style="width:100%; max-height:300px;"></canvas>
            </div>
        </div>
    </div>
    <div class="container mt-4">
        <h3 class="text-center mt-5 mb-4">Estadisticas</h3>
        <div class="row">

            <!-- Gráfico de partes del cuerpo afectadas -->
            <div class="col-md-4"> <!-- Cada gráfico ocupa 4 columnas de 12 -->
                <h5 class="text-center">Tiempo medio de investigación</h5>
                <canvas id="grafica-evolutiva"></canvas>
            </div>

        </div>
    </div>
    <script>
        // Datos para el gráfico
        var years = <?php echo json_encode($years); ?>;
        var indices_incidencia = <?php echo json_encode($indices_incidencia); ?>;

        // Crear el gráfico
        var ctx = document.getElementById('graficoIndiceIncidencia').getContext('2d');
        var graficoIndiceIncidencia = new Chart(ctx, {
            type: 'line',
            data: {
                labels: years, // Años en el eje X
                datasets: [{
                    label: 'Índice de Incidencia (II)',
                    data: indices_incidencia, // Índices de incidencia en el eje Y
                    borderColor: 'rgba(54, 162, 235, 1)',
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderWidth: 2,
                    fill: true // Rellenar debajo de la línea
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true, // Empezar desde 0
                        min: 0, // Establecer valor mínimo en 0
                        max: 5000, // Establecer valor máximo en 5000
                        stepSize: 500, // Establecer el paso entre los valores
                        ticks: {
                            callback: function(value) {
                                return value; // Etiquetas del eje Y
                            }
                        }
                    }
                },
                plugins: {
                    legend: {
                        position: 'top'
                    },
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                return tooltipItem.raw; // Etiqueta del tooltip
                            }
                        }
                    }
                }
            }
        });
    </script>



    <script>
        // Datos para el gráfico
        var years = <?php echo json_encode($years); ?>;
        var duracion_media_baja = <?php echo json_encode($duracion_media_baja); ?>;

        // Crear el gráfico
        var ctx = document.getElementById('graficoDuracionMediaBaja').getContext('2d');
        var graficoDuracionMediaBaja = new Chart(ctx, {
            type: 'line',
            data: {
                labels: years, // Años en el eje X
                datasets: [{
                    label: 'Duración Media de Baja (Días)',
                    data: duracion_media_baja, // Duración media de baja en el eje Y
                    borderColor: 'rgba(255, 99, 132, 1)',
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    borderWidth: 2,
                    fill: true // Rellenar debajo de la línea
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: false,
                        ticks: {
                            stepSize: 1,
                            callback: function(value) {
                                return value + ' días';
                            } // Etiquetas en el eje Y
                        }
                    }
                },
                plugins: {
                    legend: {
                        position: 'top'
                    },
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                return tooltipItem.raw + ' días'; // Etiqueta del tooltip
                            }
                        }
                    }
                }
            }
        });
    </script>

    <script>
        // Datos de PHP a JavaScript
        var centros = <?php echo json_encode($centros); ?>;
        var accidentes_con_baja_centro = <?php echo json_encode($accidentes_con_baja_centro); ?>;
        var accidentes_sin_baja_centro = <?php echo json_encode($accidentes_sin_baja_centro); ?>;
        var in_itinere_con_baja_centro = <?php echo json_encode($in_itinere_con_baja_centro); ?>;
        var in_itinere_sin_baja_centro = <?php echo json_encode($in_itinere_sin_baja_centro); ?>;
        var categorias = <?php echo json_encode($categorias); ?>;
        var accidentes_con_baja_categoria = <?php echo json_encode($accidentes_con_baja_categoria); ?>;
        var accidentes_sin_baja_categoria = <?php echo json_encode($accidentes_sin_baja_categoria); ?>;
        var in_itinere_con_baja_categoria = <?php echo json_encode($in_itinere_con_baja_categoria); ?>;
        var in_itinere_sin_baja_categoria = <?php echo json_encode($in_itinere_sin_baja_categoria); ?>;

        // Crear gráfico combinado de barras apiladas
        var ctx = document.getElementById('grafico_combinado').getContext('2d');
        var grafico = new Chart(ctx, {
            type: 'bar', // Gráfico de barras apiladas
            data: {
                labels: centros, // Etiquetas en el eje X (centros de trabajo)
                datasets: [{
                        label: 'Accidentes con Baja',
                        data: accidentes_con_baja_centro,
                        backgroundColor: 'rgba(255, 99, 132, 0.7)',
                    },
                    {
                        label: 'Accidentes sin Baja',
                        data: accidentes_sin_baja_centro,
                        backgroundColor: 'rgba(54, 162, 235, 0.7)',
                    },
                    {
                        label: 'In Itinere con Baja',
                        data: in_itinere_con_baja_centro,
                        backgroundColor: 'rgba(75, 192, 192, 0.7)',
                    },
                    {
                        label: 'In Itinere sin Baja',
                        data: in_itinere_sin_baja_centro,
                        backgroundColor: 'rgba(153, 102, 255, 0.7)',
                    }
                ]
            },
            options: {
                responsive: true,
                scales: {
                    x: {
                        beginAtZero: true
                    },
                    y: {
                        beginAtZero: true,
                        stacked: true, // Apilar las barras
                    }
                },
                plugins: {
                    legend: {
                        position: 'top'
                    }
                }
            }
        });
    </script>


    <script>
        console.log("Meses: <?php echo json_encode($etiquetasMeses); ?>");
        console.log("Valores: <?php echo json_encode($valoresMeses); ?>");
    </script>

    <script>
        const ctxMeses = document.getElementById('graficoMeses').getContext('2d');
        const graficoMeses = new Chart(ctxMeses, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode($etiquetasMeses); ?>,
                datasets: [{
                    label: 'Accidentes por Mes',
                    data: <?php echo json_encode($valoresMeses); ?>,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top'
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>

    <script>
        // Datos del gráfico, filtrados por el año seleccionado
        var accidentesPorDia = <?php echo json_encode($accidentesPorDia); ?>;

        var ctxDia = document.getElementById('graficoDias').getContext('2d');
        var chartDia = new Chart(ctxDia, {
            type: 'bar',
            data: {
                labels: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
                datasets: [{
                    label: 'Accidentes por día de la semana (<?php echo $year_selected; ?>)',
                    data: accidentesPorDia,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)',
                        'rgba(99, 255, 132, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)',
                        'rgba(99, 255, 132, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
    <script>
        // Datos del gráfico, filtrados por el año seleccionado
        var accidentesPorHora = <?php echo json_encode(array_values($accidentesPorHora)); ?>;

        var ctxHora = document.getElementById('graficoHoras').getContext('2d');
        var chartHora = new Chart(ctxHora, {
            type: 'bar',
            data: {
                labels: Array.from({
                    length: 12
                }, (_, i) => `${i + 1}h`), // Etiquetas: 1h, 2h, ..., 12h
                datasets: [{
                    label: 'Accidentes por hora de trabajo (<?php echo $year_selected; ?>)',
                    data: accidentesPorHora,
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>


    <script>
        var ctx = document.getElementById('graficoPartesCuerpo').getContext('2d');
        var graficoPartesCuerpo = new Chart(ctx, {
            type: 'bar', // Tipo de gráfico
            data: {
                labels: <?php echo json_encode($partes_cuerpo); ?>, // Etiquetas de las partes del cuerpo
                datasets: [{
                    label: 'Número de Accidentes',
                    data: <?php echo json_encode($accidentes_por_parte); ?>, // Datos (número de accidentes)
                    backgroundColor: 'rgba(54, 162, 235, 0.2)', // Color de las barras
                    borderColor: 'rgba(54, 162, 235, 1)', // Color del borde de las barras
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top'
                    },
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                return tooltipItem.raw + ' accidentes';
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
    <script>
        // Datos del gráfico de tipo lesión
        var ctxLesiones = document.getElementById('graficoLesiones').getContext('2d');
        var graficoLesiones = new Chart(ctxLesiones, {
            type: 'pie', // Cambiado de 'bar' a 'pie'
            data: {
                labels: <?php echo json_encode($tipos_lesion); ?>, // Etiquetas (tipos de lesiones)
                datasets: [{
                    label: 'Número de Accidentes',
                    data: <?php echo json_encode($accidentes_por_lesion); ?>, // Datos (número de accidentes)
                    backgroundColor: [
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(255, 159, 64, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ], // Colores de cada segmento
                    borderColor: [
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 99, 132, 1)',
                        'rgba(255, 159, 64, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ], // Colores del borde de cada segmento
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top' // Posición de la leyenda
                    },
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                return tooltipItem.raw + ' accidentes'; // Etiquetas del tooltip
                            }
                        }
                    }
                }
            }
        });
    </script>

    <script>
        // Datos para el gráfico
        var categorias = <?php echo json_encode($categorias); ?>;
        var accidentes_totales = <?php echo json_encode($accidentes_totales); ?>;

        // Crear el gráfico
        var ctx = document.getElementById('graficoPastelAccidentes').getContext('2d');
        var graficoPastel = new Chart(ctx, {
            type: 'pie', // Tipo de gráfico
            data: {
                labels: categorias, // Categorías en el gráfico
                datasets: [{
                    data: accidentes_totales, // Totales de accidentes
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.6)',
                        'rgba(54, 162, 235, 0.6)',
                        'rgba(255, 206, 86, 0.6)',
                        'rgba(75, 192, 192, 0.6)',
                        'rgba(153, 102, 255, 0.6)',
                        'rgba(255, 159, 64, 0.6)',
                        'rgba(199, 199, 199, 0.6)',
                        'rgba(83, 102, 255, 0.6)',
                        'rgba(204, 16, 72, 0.6)',
                        'rgba(0, 204, 102, 0.6)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)',
                        'rgba(199, 199, 199, 1)',
                        'rgba(83, 102, 255, 1)',
                        'rgba(204, 16, 72, 1)',
                        'rgba(0, 204, 102, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top'
                    },
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                return categorias[tooltipItem.dataIndex] + ': ' + accidentes_totales[tooltipItem.dataIndex];
                            }
                        }
                    }
                }
            }
        });
    </script>


    <script>
        // Pasar los datos al JavaScript
        var etiquetasEvolutivas = <?php echo json_encode($labels); ?>;
        var datosEvolutivos = <?php echo json_encode($valores); ?>;

        // Validar datos en la consola
        console.log(etiquetasEvolutivas);
        console.log(datosEvolutivos);

        // Renderizar el gráfico
        if (etiquetasEvolutivas.length > 0 && datosEvolutivos.length > 0) {
            var ctxEvolutiva = document.getElementById('grafica-evolutiva').getContext('2d');
            var graficaEvolutiva = new Chart(ctxEvolutiva, {
                type: 'line',
                data: {
                    labels: etiquetasEvolutivas, // Meses
                    datasets: [{
                        label: 'Media de días entre accidente e investigación',
                        data: datosEvolutivos, // Media de días
                        borderColor: 'rgba(75, 192, 192, 1)',
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderWidth: 2,
                        fill: true
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top'
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true // Asegurarse de que el eje Y comience en 0
                        }
                    }
                }
            });
        } else {
            console.error("No hay datos para mostrar en el gráfico.");
        }
    </script>







    <?php
    include('../../admin/layout/parte2.php');
    include('../../admin/layout/mensaje.php');
    ?>

    <!--<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>-->

    <script>
        $(function() {
            $("#example1").DataTable({
                "pageLength": 5,
                "language": {
                    "emptyTable": "No hay información",
                    "info": "Mostrando _START_ a _END_ de _TOTAL_ expedientes investigación",
                    "infoEmpty": "Mostrando 0 a 0 de 0 Accidentes",
                    "infoFiltered": "(Filtrado de MAX total Accidentes)",
                    "infoPostFix": "",
                    "thousands": ",",
                    "lengthMenu": "Mostrar _MENU_ Accidentes",
                    "loadingRecords": "Cargando...",
                    "processing": "Procesando...",
                    "search": "Buscador:",
                    "zeroRecords": "Sin resultados encontrados",
                    "paginate": {
                        "first": "Primero",
                        "last": "Ultimo",
                        "next": "Siguiente",
                        "previous": "Anterior"
                    }
                },
                "responsive": true,
                "lengthChange": true,
                "autoWidth": false,
                buttons: [{
                        extend: "collection",
                        text: "Reportes",
                        orientation: "landscape",
                        buttons: [{
                                text: "Copiar",
                                extend: "copy"
                            },
                            {
                                extend: "pdf"
                            },
                            {
                                extend: "csv"
                            },
                            {
                                extend: "excel"
                            },
                            {
                                text: "Imprimir",
                                extend: "print"
                            }
                        ]
                    },
                    {
                        extend: "colvis",
                        text: "Visor de columnas",
                        /*collectionLayout: "fixed three-column" */

                    }
                ],
            }).buttons().container().appendTo("#example1_wrapper .col-md-6:eq(0)");
        });
    </script>

</html>