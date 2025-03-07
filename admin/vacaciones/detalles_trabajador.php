<?php
// Verificar si se recibe el id_trabajador en la URL
if (!isset($_GET['id_trabajador'])) {
    die('Error: No se ha especificado el trabajador.');
}

// Capturar el id_trabajador de la URL
$id_trabajador = intval($_GET['id_trabajador']);



include('../../app/config.php');
include('../../admin/layout/parte1.php');
include('../../app/controllers/trabajadores/datos_trabajador.php');
include('../../app/controllers/maestros/centros/listado_centros.php');

// Calcular el año actual
$anioActual = date("Y");

try {
    // Total generado en el año actual
    $stmtGen = $pdo->prepare("SELECT SUM(generado) AS total_generado FROM vacacion_gen WHERE id_trabajador = :id_trabajador");
    $stmtGen->execute(['id_trabajador' => $id_trabajador]);
    $totalGenerado = $stmtGen->fetchColumn() ?: 0;

    // Total generado en el año actual
    $stmtGenAnio = $pdo->prepare("SELECT SUM(generado) AS total_generado FROM vacacion_gen WHERE id_trabajador = :id_trabajador AND YEAR(fecha_inicio) = :anio");
    $stmtGenAnio->execute(['id_trabajador' => $id_trabajador, 'anio' => $anioActual]);
    $totalGeneradoAnio = $stmtGenAnio->fetchColumn() ?: 0;

    // Total consumido en el año actual con descuenta = 0
    $stmtConAnioDescuenta = $pdo->prepare("SELECT SUM(consumido) AS total_sin_descuento FROM vacacion_con WHERE id_trabajador = :id_trabajador AND YEAR(fecha_inicio) = :anio AND descuenta = 0");
    $stmtConAnioDescuenta->execute(['id_trabajador' => $id_trabajador, 'anio' => $anioActual]);
    $totalSinDescuento = $stmtConAnioDescuenta->fetchColumn() ?: 0;

    // Total consumido en el año actual
    $stmtConAnio = $pdo->prepare("SELECT SUM(consumido) AS total_consumido_anio FROM vacacion_con WHERE id_trabajador = :id_trabajador AND YEAR(fecha_inicio) = :anio");
    $stmtConAnio->execute(['id_trabajador' => $id_trabajador, 'anio' => $anioActual]);
    $totalConAnio = $stmtConAnio->fetchColumn() ?: 0;
    $totalConsumidoAnio = $totalConAnio - $totalSinDescuento;
    // Total consumido
    $stmtConTotal = $pdo->prepare("SELECT SUM(consumido) AS total_consumido FROM vacacion_con WHERE id_trabajador = :id_trabajador AND descuenta = 1");
    $stmtConTotal->execute(['id_trabajador' => $id_trabajador]);
    $totalConsumido = $stmtConTotal->fetchColumn() ?: 0;

    // Días pendientes
    $diasPendientes = $totalGenerado - $totalConsumido;



    // Consulta para los registros generados
    $stmtGen = $pdo->prepare("SELECT vg.id_vac_generada, vg.fecha_inicio, vg.fecha_fin, vg.id_centro, c.nombre_cen, vg.concepto, vg.regimen, vg.generado, vg.comunicado, vg.extra FROM vacacion_gen vg 
LEFT JOIN centros c ON vg.id_centro = c.id_centro
    WHERE vg.id_trabajador = :id_trabajador");
    $stmtGen->execute(['id_trabajador' => $id_trabajador]);
    $registrosGenerados = $stmtGen->fetchAll(PDO::FETCH_ASSOC);

    // Consulta para los registros consumidos
    $stmtCon = $pdo->prepare("SELECT id_vac_consumida, id_trabajador, fecha_inicio, fecha_fin, consumido, descuenta, notas, comunicado FROM vacacion_con WHERE id_trabajador = :id_trabajador");
    $stmtCon->execute(['id_trabajador' => $id_trabajador]);
    $registrosConsumidos = $stmtCon->fetchAll(PDO::FETCH_ASSOC);

    // Obtener años únicos de ambas tablas
    $stmtAnios = $pdo->prepare("
        SELECT DISTINCT YEAR(fecha_inicio) AS anio FROM vacacion_gen WHERE id_trabajador = :id_trabajador
        UNION
        SELECT DISTINCT YEAR(fecha_inicio) AS anio FROM vacacion_con WHERE id_trabajador = :id_trabajador
        ORDER BY anio DESC
    ");
    $stmtAnios->execute(['id_trabajador' => $id_trabajador]);
    $anios = $stmtAnios->fetchAll(PDO::FETCH_COLUMN);
} catch (PDOException $e) {
    die('Error al realizar la consulta: ' . $e->getMessage());
}
?>

<head>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script> <!-- jQuery 3.7 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@x.x.x/dist/select2-bootstrap4.min.css">
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script> <!-- Bootstrap 5 JS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">


    <!-- CSS de DataTables y extensiones -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>


    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>

    <!-- JS de DataTables y extensiones -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.colVis.min.js"></script>

    <style>
        .dropdown-font-size {
            font-size: 12px;
        }

        .btn-text-right {
            text-align: right;
        }

        /* Color verde cuando está activado */
        .form-check-input:checked {
            background-color: #28a745 !important;
            /* Verde Bootstrap */
            border-color: #28a745 !important;
        }

        /* Color rojo claro cuando está desactivado */
        .form-check-input {
            background-color: #f8d7da !important;
            /* Rojo claro */
            border-color: #f8d7da !important;
        }
    </style>
</head>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h5 class="m-0"><b>Detalles Vacaciones: </b> <?php echo $nombre_tr ?></h5>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                    <li class="breadcrumb-item"><a href="index.php">Control vacaciones</a></li>
                    <li class="breadcrumb-item active">Detalle</li>
                </ol>
            </div><!-- /.col -->
            <hr>
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>

<div class="row">
    <!-- Total Días Generados -->
    <div class="col-lg-2 col-md-6">
        <div class="small-box bg-light shadow-sm border">
            <div class="inner">
                <h4><?php echo $categoria_tr; ?></h4>
                <p>Desde <?php echo date("d/m/Y", strtotime($inicio_tr)); ?></p>
            </div>
            <div class="icon">
                <i class="fa-solid bi-person-arms-up"></i>
            </div>
        </div>
    </div>
    <div class="col-lg-2 col-md-6">
        <div class="small-box bg-light shadow-sm border">
            <div class="inner">
                <h2><?php echo number_format($totalGeneradoAnio, 2); ?></h2>
                <p>Días Generados en <?php echo $anioActual; ?></p>
            </div>
            <div class="icon">
                <i class="fa-solid fa-calendar-plus"></i>
            </div>
        </div>
    </div>

    <!-- Días Pendientes -->
    <div class="col-lg-2 col-md-6">
        <div class="small-box <?php echo ($diasPendientes < 0) ? 'bg-danger' : 'bg-light'; ?> shadow-sm border">
            <div class="inner">
                <h2><?php echo number_format($diasPendientes, 2); ?></h2>
                <p>Días Pendientes</p>
            </div>
            <div class="icon">
                <i class="fa-solid fa-balance-scale"></i>
            </div>
        </div>
    </div>
    <!-- Días Pendientes -->
    <div class="col-lg-2 col-md-6">
        <div class="small-box bg-light shadow-sm border">
            <div class="inner">
                <h2><?php echo number_format($totalConsumidoAnio, 2); ?></h2>
                <p>Disfrutados</p>
            </div>
            <div class="icon">
                <i class="fa-solid fa-person-walking-luggage"></i>
            </div>
        </div>
    </div>

    <!-- Días sin Descuento -->
    <div class="col-lg-2 col-md-6">
        <div class="small-box bg-light shadow-sm border">
            <div class="inner">
                <h2><?php echo $totalSinDescuento; ?></h2>
                <p>Días permiso <?php echo $anioActual; ?></p>
            </div>
            <div class="icon">
                <i class="fa-solid fa-universal-access"></i>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card card-outline card-primary">
            <div class="card-header col-md-12">
                <h3 class="card-title"><b>Control de vacaciones generadas y consumidas</b></h3>



                <!-- Modal añadir -->
                <div class="modal fade" id="modal-generavacaciones" role="dialog" aria-labelledby="modal-generavacaciones" aria-hidden="true">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <div class="modal-header" style="background-color:#0080ff; color:white;">
                                <h5 class="modal-title" id="modal-generavacaciones">+ Genera vacaciones</h5>
                                <button type="button" class="close" style="color: black;" data-bs-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="../../app/controllers/vacaciones/genera_vac_tr.php" method="post" enctype="multipart/form-data">
                                    <!-- Formulario de vacaciones -->
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label for="tarea">Trabajador</label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="id_trabajador" class="form-control" value="<?php echo $id_trabajador ?>" hidden>
                                                    <input type="text" class="form-control" value="<?php echo $nombre_tr ?>" readonly>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-5">
                                            <label for="">Centro Trabajo</label>
                                            <select name="id_centro" class="form-control" required>
                                                <option value="">Seleccione un centro</option>
                                                <?php foreach ($centros_datos as $centros_dato): ?>
                                                    <option value="<?php echo $centros_dato['id_centro']; ?>"><?php echo $centros_dato['nombre_cen']; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row mt-4">
                                        <div class="col-md-3">
                                            <label for="">Fecha Inicio</label>
                                            <input type="date" name="fecha_inicio" class="form-control" id="fecha_inicio">
                                        </div>
                                        <div class="col-md-3">
                                            <label for="">Fecha Fin</label>
                                            <input type="date" name="fecha_fin" class="form-control" id="fecha_fin">
                                        </div>
                                        <div class="col-sm-2">
                                            <label for="dias">Días:</label>
                                            <input type="text" name="dias" class="form-control" id="dias" readonly>
                                        </div>
                                        <div class="col-sm-4">
                                            <label for="regimen">Régimen / Coeficiente:</label>
                                            <select name="regimen" id="regimen" class="form-select">
                                                <option value="0">-</option>
                                                <option value="0.5">Embarcado - 0,5</option>
                                                <option value="1">Embarcado - 1</option>
                                                <option value="0.0822">General - 30 días</option>
                                                <option value="0.1234">General - 45 días</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-sm-2">
                                            <label for="generado">Días Generados:</label>
                                            <input type="text" name="generado" class="form-control" id="generado" readonly>
                                        </div>
                                        <div class="col-sm-2 mt-4">
                                            <!-- Botón para asignar 360 días al año laboral -->
                                            <button type="button" class="btn btn-info" id="botonAnoLaboral" title="Para trabajadores de tierra de todo el año">Año Laboral completo</button>
                                        </div>
                                        <div class="col-sm-5">
                                            <label for="concepto">Concepto:</label>
                                            <input type="text" name="concepto" class="form-control" value="">
                                        </div>




                                    </div>
                                    <br>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                        <button type="submit" class="btn btn-primary">Guardar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Fin modal -->
                <!-- Modal -->
                <div class="modal fade" id="modal-generaextras" role="dialog" aria-labelledby="modal-generaextras" aria-hidden="true">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <div class="modal-header" style="background-color:#808080 ;color:white">
                                <h5 class="modal-title" id="modal-generaextras">+ Extras</h5>
                                <button type="button" class="close" style="color: white;" data-bs-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="../../app/controllers/vacaciones/genera_extra_tr.php" method="post" enctype="multipart/form-data">
                                    <!-- Formulario de vacaciones -->
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label for="tarea">Trabajador</label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="id_trabajador" class="form-control" value="<?php echo $id_trabajador ?>" hidden>
                                                    <input type="text" class="form-control" value="<?php echo $nombre_tr ?>" readonly>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-5">
                                            <label for="">Centro Trabajo</label>
                                            <select name="id_centro" class="form-control" required>
                                                <option value="">Seleccione un centro</option>
                                                <?php foreach ($centros_datos as $centros_dato): ?>
                                                    <option value="<?php echo $centros_dato['id_centro']; ?>"><?php echo $centros_dato['nombre_cen']; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row mt-4 align-items-center">
                                        <div class="col-md-3">
                                            <label for="fecha_inicio">Fecha Inicio</label>
                                            <input type="date" name="fecha_inicio" class="form-control" id="fecha_inicio">
                                        </div>
                                        <div class="col-md-3">
                                            <label for="fecha_fin">Fecha Fin</label>
                                            <input type="date" name="fecha_fin" class="form-control" id="fecha_fin">
                                        </div>
                                        <div class="col-md-3">
                                            <label for="extra">Extra:</label>
                                            <div class="form-check form-switch mt-2 ms-4">
                                                <!-- Input oculto para enviar 0 cuando el switch esté apagado -->
                                                <input type="hidden" name="extra" value="No">
                                                <!-- Switch que envía 1 cuando está activado -->
                                                <input class="form-check-input" type="checkbox" id="extra" name="extra" value="Si" checked style="transform: scale(1.5);">
                                            </div>
                                        </div>

                                    </div>


                                    <div class="row mt-2">
                                        <div class="col-sm-3">
                                            <label for="generado">Días Generados:</label>
                                            <input type="text" name="generado" class="form-control" id="generado">
                                        </div>
                                        <div class="col-sm-7">
                                            <label for="concepto">Concepto:</label>
                                            <input type="text" name="concepto" class="form-control" value="">
                                        </div>
                                    </div>
                                    <br>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                        <button type="submit" class="btn btn-primary">Guardar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Fin modal -->
                <!-- Modal editarvacaciones -->

                <div class="modal fade" id="modal-editarvacaciones" role="dialog" aria-labelledby="modal-editarvacaciones" aria-hidden="true">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <div class="modal-header" style="background-color:#5fafaf; color:white;">
                                <h5 class="modal-title">Editar Vacaciones Generadas</h5>
                                <button type="button" class="close" style="color: black;" data-bs-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="../../app/controllers/vacaciones/editar_vac_tr.php" method="post" enctype="multipart/form-data">
                                    <input type="hidden" name="id_vac_generada" id="editar-id-vac-generada">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="editar-fecha-inicio">Fecha Inicio</label>
                                            <input type="date" name="fecha_inicio" class="form-control" id="editar-fecha-inicio">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="editar-fecha-fin">Fecha Fin</label>
                                            <input type="date" name="fecha_fin" class="form-control" id="editar-fecha-fin">
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-md-6">
                                            <label for="editar-id-centro">Centro Trabajo</label>
                                            <select name="id_centro" class="form-control" id="editar-id-centro">
                                                <?php foreach ($centros_datos as $centros_dato): ?>
                                                    <option value="<?php echo $centros_dato['id_centro']; ?>"><?php echo $centros_dato['nombre_cen']; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="editar-concepto">Concepto</label>
                                            <input type="text" name="concepto" class="form-control" id="editar-concepto">
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-md-4">
                                            <label for="editar-regimen">Régimen</label>
                                            <select name="regimen" class="form-select" id="editar-regimen">
                                                <option value="0">-</option>
                                                <option value="0.5">Embarcado - 0,5</option>
                                                <option value="1">Embarcado - 1</option>
                                                <option value="0.0822">General - 30 días</option>
                                                <option value="0.1234">General - 45 días</option>
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="editar-generado">Días Generados</label>
                                            <input type="text" name="generado" class="form-control" id="editar-generado" readonly>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="editar-extra">Extra:</label>
                                            <div class="form-check form-switch mt-2 ms-4">
                                                <!-- Input oculto para enviar "No" cuando el switch esté apagado -->
                                                <input type="hidden" name="extra" value="No">
                                                <!-- Switch que se activa si el valor es "Si" -->
                                                <input class="form-check-input" type="checkbox" id="editar-extra" name="extra" value="Si"
                                                    style="transform: scale(1.5);">
                                            </div>
                                        </div>





                                    </div>
                                    <div class="modal-footer mt-4">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!--fin modal-->
                <!-- inicio modal consumir vacaciones-->
                <div class="modal fade" id="modal-consumevacaciones" tabindex="-1" role="dialog" aria-labelledby="modal-consumevacacionesLabel" aria-hidden="true">
                    <div class="modal-dialog modal-xl" role="document">
                        <div class="modal-content">
                            <div class="modal-header" style="background-color:#fed801; color:black;">
                                <h5 class="modal-title" id="modal-consumevacacionesLabel">+ Consumir Vacaciones</h5>
                                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">

                                <form action="../../app/controllers/vacaciones/consume_vac_tr.php" method="post" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label for="tarea">Trabajador</label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="id_trabajador" class="form-control" value="<?php echo $id_trabajador ?>" hidden>
                                                    <input type="text" class="form-control" value="<?php echo $nombre_tr ?>" readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-5">

                                            <label>Estado de comunicación:</label> <br>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="comunicado" id="editar-comunicado-no" value="No">
                                                <label class="form-check-label" for="editar-comunicado-no">
                                                    <b>NO COMUNICADO</b>
                                                </label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="comunicado" id="editar-comunicado-si" value="Si" checked>
                                                <label class="form-check-label" for="editar-comunicado-si">
                                                    <b>COMUNICADO</b>
                                                </label>
                                            </div>
                                        </div>

                                    </div>


                                    <br>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="">Fecha Inicio</label>
                                                <input type="date" name="fecha_inicio" class="form-control" id="fecha_in_cons">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="">Fecha Fin</label>
                                                <input type="date" name="fecha_fin" class="form-control" id="fecha_fin_cons">
                                            </div>
                                        </div>
                                        <div class="col-md-1"></div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="">Días Consumidos</label>
                                                <input type="text" name="consumido" class="form-control" id="consumido" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-1"></div>
                                        <!-- Campo oculto con el valor 1 (valor por defecto) -->
                                        <input type="hidden" name="descuenta" value="1">

                                        <div class="col-md-2">
                                            <div class="form-check form-switch">
                                                <!-- El checkbox se enviará con el valor 0 cuando está marcado -->
                                                <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault" name="descuenta" value="0">
                                                <label class="form-check-label" for="flexSwitchCheckDefault">PERMISO JUSTIFICADO</label>
                                            </div>
                                        </div>
                                    </div>

                                    <script>
                                        // Función para calcular los días consumidos
                                        function calcularConsumido() {
                                            const fechaIniciocons = document.getElementById('fecha_in_cons').value;
                                            const fechaFincons = document.getElementById('fecha_fin_cons').value;

                                            // Verificar que ambas fechas estén presentes
                                            if (fechaIniciocons && fechaFincons) {
                                                const fechaInicioDatecons = new Date(fechaIniciocons);
                                                const fechaFinDatecons = new Date(fechaFincons);

                                                // Calcular la diferencia de días
                                                const diferenciaDias = (fechaFinDatecons - fechaInicioDatecons) / (1000 * 3600 * 24) + 1;

                                                // Verificar si la fecha de fin es anterior a la de inicio
                                                if (diferenciaDias < 0) {
                                                    document.getElementById('consumido').value = "Error: Fecha fin es anterior a la Fecha inicio";
                                                    return;
                                                }

                                                // Mostrar el resultado en el campo de días consumidos
                                                document.getElementById('consumido').value = diferenciaDias;
                                            } else {
                                                // Si no se completan las fechas, dejar el campo vacío
                                                document.getElementById('consumido').value = '';
                                            }
                                        }

                                        // Agregar eventos de cambio para recalcular cuando se modifiquen los campos
                                        document.getElementById('fecha_in_cons').addEventListener('change', calcularConsumido);
                                        document.getElementById('fecha_fin_cons').addEventListener('change', calcularConsumido);
                                    </script>

                                    <br>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group row">
                                                <label for="notas" class="col-form-label col-sm-1">NOTAS:</label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="notas" class="form-control" value="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <hr>


                                    <script>
                                        // Función para calcular los días generados
                                        function calcularGenerado() {
                                            const fechaInicio = document.getElementById('fecha_inicio').value;
                                            const fechaFin = document.getElementById('fecha_fin').value;
                                            const regimen = parseFloat(document.getElementById('regimen').value);

                                            // Verificar que al menos el régimen esté seleccionado
                                            if (regimen > 0) {
                                                // Si ambas fechas están presentes
                                                if (fechaInicio && fechaFin) {
                                                    const fechaInicioDate = new Date(fechaInicio);
                                                    const fechaFinDate = new Date(fechaFin);

                                                    // Calcular la diferencia de días
                                                    const diferenciaDias = (fechaFinDate - fechaInicioDate) / (1000 * 3600 * 24);

                                                    // Verificar si la fecha de fin es anterior a la de inicio
                                                    if (diferenciaDias < 0) {
                                                        document.getElementById('generado').value = "Error: Fecha fin es anterior a la Fecha inicio";
                                                        return;
                                                    }

                                                    // Calcular los días generados
                                                    const diasGenerados = diferenciaDias * regimen;

                                                    // Mostrar el resultado
                                                    document.getElementById('generado').value = diasGenerados.toFixed(2);
                                                } else {
                                                    // Si solo el régimen está seleccionado pero no las fechas, no hacer el cálculo
                                                    document.getElementById('generado').value = '';
                                                }
                                            } else {
                                                // Si no se ha seleccionado un régimen válido, limpiar el campo generado
                                                document.getElementById('generado').value = '';
                                            }
                                        }

                                        // Agregar eventos de cambio para recalcular cuando se modifiquen los campos
                                        document.getElementById('fecha_inicio').addEventListener('change', calcularGenerado);
                                        document.getElementById('fecha_fin').addEventListener('change', calcularGenerado);
                                        document.getElementById('regimen').addEventListener('change', calcularGenerado);
                                    </script>


                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                        <button type="submit" class="btn btn-primary"><i class="bi bi-floppy"></i> Guardar</button>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
                <!--fin modal-->
                <!-- inicio modal consumir extras-->
                <div class="modal fade" id="modal-consumeextras" role="dialog" aria-labelledby="modal-consumeextras" aria-hidden="true">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <div class="modal-header" style="background-color:#808000 ;color:white">
                                <h5 class="modal-title" id="modal-consumeextras">+ Liquidar vacaciones</h5>
                                <button type="button" class="close" style="color: black;" data-bs-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">

                                <form action="../../app/controllers/vacaciones/consume_extra_tr.php" method="post" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label for="tarea">Trabajador</label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="id_trabajador" class="form-control" value="<?php echo $id_trabajador ?>" hidden>
                                                    <input type="text" class="form-control" value="<?php echo $nombre_tr ?>" readonly>
                                                </div>
                                            </div>
                                        </div>

                                    </div>


                                    <br>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="">Fecha</label>
                                                <input type="date" name="fecha_inicio" class="form-control" id="fecha_in_cons">
                                            </div>
                                        </div>


                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="">Dias Liquidación</label>
                                                <input type="text" name="consumido" class="form-control" id="consumido">
                                            </div>
                                        </div>
                                        <!-- Campo oculto con el valor 1 (valor por defecto) -->
                                        <input type="hidden" name="descuenta" value="1">


                                    </div>


                                    <br>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group row">
                                                <label for="notas" class="col-form-label col-sm-1">NOTAS:</label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="notas" class="form-control" value="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <hr>


                                    <div class="modal-footer">

                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                        <button type="submit" class="btn btn-primary"><i class="bi bi-floppy"></i> Guardar</button>

                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
                <!--fin modal-->

                <!-- Modal para editar vacaciones consumidas -->
                <div class="modal fade" id="modal-editar-vacaciones" tabindex="-1" aria-labelledby="modal-editar-vacacionesLabel" aria-hidden="true">
                    <div class="modal-dialog modal-xl" role="document">
                        <div class="modal-content">
                            <div class="modal-header" style="background-color:#5fafaf; color:white;">
                                <h5 class="modal-title" id="modal-editar-vacacionesLabel">Editar Registro de Vacaciones</h5>
                                <button
                                    type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="width: 1rem; height: 1rem; color: white; opacity: 1;">
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="../../app/controllers/vacaciones/update_consumida.php" method="post">
                                    <!-- ID del registro oculto -->
                                    <input type="hidden" name="id_vac_consumida" id="id_vac_consumida_editar">
                                    <input type="hidden" name="id_trabajador" id="id_trabajador_editar">

                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="fecha_inicio_editar">Fecha Inicio</label>
                                                <input type="date" name="fecha_inicio" id="fecha_inicio_editar" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="fecha_fin_editar">Fecha Fin</label>
                                                <input type="date" name="fecha_fin" id="fecha_fin_editar" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="consumido_editar">Días Consumidos</label>
                                                <input type="text" name="consumido" id="consumido_editar" class="form-control" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-3 d-flex align-items-center text-end">
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" id="descuenta_editar" name="descuenta" value="0" style="transform: scale(1.3);">
                                                <label class="form-check-label" for="descuenta_editar" style="font-size: 1.2rem;">Permiso Justificado</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 d-flex justify-content-end align-items-center">
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" name="comunicado" id="editar-comunicado-switch" value="Si" style="transform: scale(1.3);">
                                                <label class="form-check-label" for="editar-comunicado-switch" style="font-size: 1.2rem; display: inline-block;">
                                                    COMUNICADO
                                                </label>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="row mt-3">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="notas_editar">Notas</label>
                                                <input type="text" name="notas" id="notas_editar" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer mt-3">

                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" data-bs-target="#modal-editar-vacaciones">Cerrar</button>


                                        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Fin modal -->



                <!-- fin modal -->

            </div>





            <div class="card-body">
                <!-- Filtro por Año -->
                <div class="row mb-6">
                    <div class="col-md-12 d-flex align-items-center">
                        <label for="filtro-anio" class="form-label" style="font-size: 1.2rem; margin-right: 20px;">Filtrar por Año:</label>
                        <select id="filtro-anio" class="form-select" style="font-size: 1.5rem; width: 250px;">
                            <option value="todos">Todos los años</option>
                            <?php foreach ($anios as $anio): ?>
                                <option value="<?php echo $anio; ?>"><?php echo $anio; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <br>

                <!-- Tablas -->
                <div class="row">
                    <!-- Primera tabla -->
                    <div class="col-md-6">
                        <div class="card card-outline card-primary">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h4 class="mb-0">Registros de Vacaciones Generadas</h4>
                                <div class="ml-auto">
                                    <?php if ($_SESSION['perfil_usr'] === 'ADMINISTRADOR' || $_SESSION['perfil_usr'] === 'USUARIO_PRL' || $_SESSION['perfil_usr'] === 'USUARIO_RRHH'): ?>

                                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modal-generavacaciones">
                                            + GENERAR
                                        </button>
                                        <button type="button" class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#modal-generaextras">
                                            + EXTRAS
                                        </button>
                                    <?php endif ?>
                                </div>
                            </div>

                            <div class="card-body">
                                <table id="tabla-generados" class="table table-striped table-bordered">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>Fecha Inicio</th>
                                            <th>Fecha Fin</th>
                                            <th>Centro Tº</th>
                                            <th>Concepto</th>
                                            <th>Régimen</th>
                                            <th>Extra</th>
                                            <th>Días Generados</th>

                                            </th>
                                            <?php if ($_SESSION['perfil_usr'] === 'ADMINISTRADOR' || $_SESSION['perfil_usr'] === 'USUARIO_PRL' || $_SESSION['perfil_usr'] === 'USUARIO_RRHH'): ?>

                                                <th>-</th>
                                            <?php endif ?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($registrosGenerados as $registro): ?>
                                            <tr data-anio="<?php echo date("Y", strtotime($registro['fecha_inicio'])); ?>">
                                                <td><?php echo date("d/m/Y", strtotime($registro['fecha_inicio'])); ?></td>
                                                <td> <?php
                                                        echo (!empty($registro['fecha_fin']) && $registro['fecha_fin'] !== '0000-00-00')
                                                            ? date("d/m/Y", strtotime($registro['fecha_fin']))
                                                            : '-';
                                                        ?></td>
                                                <td><?php echo htmlspecialchars($registro['nombre_cen']); ?></td>
                                                <td><?php echo htmlspecialchars($registro['concepto']); ?></td>
                                                <td style="text-align: center;">
                                                    <?php if ($registro['regimen'] == 1): ?>
                                                        <span class="badge bg-primary">Emb. 1/1</span>
                                                    <?php elseif ($registro['regimen'] == 0.5): ?>
                                                        <span class="badge bg-secondary">Emb. 2/1</span>
                                                    <?php elseif ($registro['regimen'] == 0.1234): ?>
                                                        <span class="badge bg-warning">45 días</span>
                                                    <?php elseif ($registro['regimen'] == 0.0822): ?>
                                                        <span class="badge bg-info">30 días</span>
                                                    <?php elseif ($registro['regimen'] == 0): ?>
                                                        -
                                                    <?php else: ?>
                                                        <?php echo htmlspecialchars($registro['regimen']); ?>
                                                    <?php endif; ?>
                                                </td>
                                                <td>
                                                    <?php if ($registro['extra'] === 'Si'): ?>
                                                        <span class="badge bg-success">Extra</span> <!-- Etiqueta verde -->
                                                    <?php else: ?>
                                                        <?php echo htmlspecialchars($registro['extra'] ?? ''); ?>
                                                    <?php endif; ?>
                                                </td>

                                                <td><?php echo htmlspecialchars($registro['generado'] ?? '-', ENT_QUOTES, 'UTF-8'); ?></td>

                                                <?php if ($_SESSION['perfil_usr'] === 'ADMINISTRADOR' || $_SESSION['perfil_usr'] === 'USUARIO_PRL' || $_SESSION['perfil_usr'] === 'USUARIO_RRHH'): ?>

                                                    <td>
                                                        <button class="btn btn-info btn-sm btn-editar-generada"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#modal-editarvacaciones"
                                                            data-id="<?php echo $registro['id_vac_generada']; ?>"
                                                            data-fecha-inicio="<?php echo $registro['fecha_inicio']; ?>"
                                                            data-fecha-fin="<?php echo $registro['fecha_fin']; ?>"
                                                            data-id-centro="<?php echo $registro['id_centro']; ?>"
                                                            data-concepto="<?php echo htmlspecialchars($registro['concepto']); ?>"
                                                            data-regimen="<?php echo $registro['regimen']; ?>"
                                                            data-generado="<?php echo $registro['generado']; ?>"
                                                            data-extra="<?php echo htmlspecialchars($registro['extra']); ?>">
                                                            Editar
                                                        </button>
                                                        <a href="../../app/controllers/vacaciones/delete_generada.php?id_vac_generada=<?php echo $registro['id_vac_generada'] ?>&id_trabajador=<?php echo $id_trabajador ?>" class="btn btn-danger btn-sm btn-font-size" onclick="return confirm('¿Realmente desea eliminar el registro de fecha <?php echo date("d/m/Y", strtotime($registro['fecha_inicio'])); ?>?')" title="Eliminar registro"><i class="bi bi-trash-fill"></i></a>

                                                    </td>
                                                <?php endif ?>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>



                    <!-- Segunda tabla -->
                    <div class="col-md-6">
                        <div class="card card-outline card-primary">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h4 class="mb-0">Registros de Vacaciones Consumidas</h4>
                                <div class="ml-auto">
                                    <?php if ($_SESSION['perfil_usr'] === 'ADMINISTRADOR' || $_SESSION['perfil_usr'] === 'USUARIO_PRL' || $_SESSION['perfil_usr'] === 'USUARIO_RRHH'): ?>

                                        <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#modal-consumevacaciones">
                                            + Consume
                                        </button>
                                        <button type="button" class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#modal-consumeextras">
                                            + Liquidar
                                        </button>
                                    <?php endif ?>
                                </div>
                            </div>
                            <div class="card-body">
                                <table id="tabla-consumidos" class="table table-striped table-bordered">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>Fecha Inicio</th>
                                            <th>Fecha Fin</th>
                                            <th>Días Consumidos</th>
                                            <th>Permiso OK</th>
                                            <th>Notas</th>
                                            <th><i class="bi bi-envelope-fill"></i>
                                                <?php if ($_SESSION['perfil_usr'] === 'ADMINISTRADOR' || $_SESSION['perfil_usr'] === 'USUARIO_PRL' || $_SESSION['perfil_usr'] === 'USUARIO_RRHH'): ?>

                                            <th>-</th><?php endif ?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($registrosConsumidos as $registro): ?>
                                            <tr data-anio="<?php echo date("Y", strtotime($registro['fecha_inicio'])); ?>"
                                                data-id="<?php echo $registro['id_vac_consumida']; ?>">
                                                <td><?php echo date("d/m/Y", strtotime($registro['fecha_inicio'])); ?></td>
                                                <td>
                                                    <?php
                                                    // Comprobamos si la fecha es null o no está definida
                                                    if ($registro['fecha_fin'] != null) {
                                                        // Si no es null, formateamos la fecha
                                                        echo date("d/m/Y", strtotime($registro['fecha_fin']));
                                                    } else {
                                                        // Si es null, mostramos un campo vacío
                                                        echo '';
                                                    }
                                                    ?>
                                                </td>
                                                <td><?php echo htmlspecialchars($registro['consumido'] ?? ''); ?></td>
                                                <td><?php echo $registro['descuenta'] == 0 ? 'SI' : ($registro['descuenta'] == 1 ? '-' : ''); ?></td>
                                                <td><?php echo htmlspecialchars($registro['notas']); ?></td>
                                                <td><?php echo htmlspecialchars($registro['comunicado']); ?></td>

                                                <?php if ($_SESSION['perfil_usr'] === 'ADMINISTRADOR' || $_SESSION['perfil_usr'] === 'USUARIO_PRL' || $_SESSION['perfil_usr'] === 'USUARIO_RRHH'): ?>

                                                    <td>
                                                        <button class="btn btn-info btn-sm btn-editar-consumida"
                                                            data-id="<?php echo $registro['id_vac_consumida']; ?>"
                                                            data-id-trabajador="<?php echo $registro['id_trabajador']; ?>"
                                                            data-fecha-inicio="<?php echo $registro['fecha_inicio']; ?>"
                                                            data-fecha-fin="<?php echo $registro['fecha_fin']; ?>"
                                                            data-consumido="<?php echo $registro['consumido']; ?>"
                                                            data-descuenta="<?php echo $registro['descuenta']; ?>"
                                                            data-notas="<?php echo htmlspecialchars($registro['notas']); ?>"
                                                            data-comunicado="<?php echo htmlspecialchars($registro['comunicado']); ?>">

                                                            Editar
                                                        </button>

                                                        <a href="../../app/controllers/vacaciones/delete_consumida.php?id_vac_consumida=<?php echo $registro['id_vac_consumida'] ?>&id_trabajador=<?php echo $id_trabajador ?>"
                                                            class="btn btn-danger btn-sm btn-font-size"
                                                            onclick="return confirm('¿Realmente desea eliminar el registro de fecha <?php echo date("d/m/Y", strtotime($registro['fecha_inicio'])); ?>?')" title="Eliminar investigación">
                                                            <i class="bi bi-trash-fill"></i>
                                                        </a>
                                                    </td>

                                                <?php endif ?>

                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <?php
                    // Inicializar las variables para el resumen
                    $totalGenerado = 0;
                    $totalConsumidoDescuenta1 = 0;
                    $totalConsumidoDescuenta0 = 0;

                    // Sumar los días generados
                    foreach ($registrosGenerados as $registro) {
                        $totalGenerado += $registro['generado'];
                    }

                    // Sumar los días consumidos dependiendo del valor de 'descuenta'
                    foreach ($registrosConsumidos as $registro) {
                        if ($registro['descuenta'] == 1) {
                            $totalConsumidoDescuenta1 += $registro['consumido'];
                        } elseif ($registro['descuenta'] == 0) {
                            $totalConsumidoDescuenta0 += $registro['consumido'];
                        }
                    }

                    // Calcular los días pendientes
                    $diasPendientes = $totalGenerado - $totalConsumidoDescuenta1; ?>

                    <!-- Tabla resumen -->
                    <div class="row mt-5">
                        <div class="col-12">
                            <h4>Resumen de Vacaciones</h4>
                            <table class="table table-striped table-bordered">
                                <thead class="table-dark">
                                    <tr>
                                        <th>Trabajador</th>
                                        <th>Total Generado</th>
                                        <th>Total Consumido</th>
                                        <th>Días Pendientes</th>
                                        <th>Dias permiso</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><?php echo htmlspecialchars($nombre_tr); ?></td>
                                        <td id="resumen-total-generado">0</td>
                                        <td id="resumen-total-consumido-d1">0</td>
                                        <td id="resumen-dias-pendientes">0</td>
                                        <td id="resumen-total-consumido-d0">0</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>

    <script>
        // Función para calcular los días entre dos fechas
        function calcularDias() {
            var fechaInicio = document.getElementById("fecha_inicio").value;
            var fechaFin = document.getElementById("fecha_fin").value;

            if (fechaInicio && fechaFin) {
                var inicio = new Date(fechaInicio);
                var fin = new Date(fechaFin);
                var diferencia = fin - inicio;
                var dias = diferencia / (1000 * 3600 * 24) + 1; // Se suma 1 porque el día de inicio se cuenta
                document.getElementById("dias").value = dias;
                calcularGenerado(dias);
            }
        }


        // Función para calcular el valor generado
        function calcularGenerado(dias) {
            var regimen = parseFloat(document.getElementById("regimen").value);
            var generado;

            // Siempre calculamos normalmente multiplicando días por régimen
            generado = (dias * regimen).toFixed(2);
            document.getElementById("generado").value = generado;
        }

        function manejarAnoLaboral() {
            var regimen = parseFloat(document.getElementById("regimen").value);

            // Crear las fechas inicio y fin con el tiempo a mediodía para evitar problemas de zona horaria
            var anoActual = new Date().getFullYear();
            var inicioAno = new Date(anoActual, 0, 1, 12, 0, 0); // 1 de enero del año actual a las 12:00
            var finAno = new Date(anoActual, 11, 31, 12, 0, 0); // 31 de diciembre del año actual a las 12:00

            // Formatear fechas manualmente para evitar problemas con toISOString
            function formatearFecha(fecha) {
                var year = fecha.getFullYear();
                var month = (fecha.getMonth() + 1).toString().padStart(2, '0');
                var day = fecha.getDate().toString().padStart(2, '0');
                return `${year}-${month}-${day}`;
            }

            // Establecer las fechas en los campos
            document.getElementById("fecha_inicio").value = formatearFecha(inicioAno);
            document.getElementById("fecha_fin").value = formatearFecha(finAno);

            // Establecer 360 días en el campo días
            document.getElementById("dias").value = "360";

            // Solo para el botón de año laboral completo asignamos directamente 30 o 45
            if (regimen === 0.0822) {
                document.getElementById("generado").value = "30";
            } else if (regimen === 0.1234) {
                document.getElementById("generado").value = "45";
            } else {
                // Para otros regímenes, calcular normalmente
                document.getElementById("generado").value = (360 * regimen).toFixed(2);
            }
        }

        // Event listeners cuando el DOM está cargado
        document.addEventListener('DOMContentLoaded', function() {
            // Event listeners para las fechas
            document.getElementById("fecha_inicio").addEventListener("change", calcularDias);
            document.getElementById("fecha_fin").addEventListener("change", calcularDias);

            // Event listener para el cambio de régimen
            document.getElementById("regimen").addEventListener("change", function() {
                if (document.getElementById("fecha_inicio").value &&
                    document.getElementById("fecha_fin").value) {
                    calcularDias();
                }
            });

            // Event listener para el botón de Año Laboral
            document.getElementById("botonAnoLaboral").addEventListener("click", manejarAnoLaboral);
        });
    </script>
    <script>
        // Función para calcular los días entre dos fechas en el modal de edición
        function calcularDiasEdicion() {
            var fechaInicio = document.getElementById("editar-fecha-inicio").value;
            var fechaFin = document.getElementById("editar-fecha-fin").value;

            if (fechaInicio && fechaFin) {
                var inicio = new Date(fechaInicio);
                var fin = new Date(fechaFin);

                // Calculamos la diferencia en milisegundos
                var diferencia = fin - inicio;

                // Convertimos la diferencia a días (1 día = 86400000 ms)
                var dias = diferencia / (1000 * 3600 * 24) + 1; // Se suma 1 porque el día de inicio se cuenta

                // Llamamos a la función para calcular "generado" después de calcular los días
                calcularGeneradoEdicion(dias);
            }
        }

        // Función para calcular el valor generado en el modal de edición
        function calcularGeneradoEdicion(dias) {
            var regimen = parseFloat(document.getElementById("editar-regimen").value);

            var generado = (dias * regimen).toFixed(2);
            document.getElementById("editar-generado").value = generado;
        }


        // Agregamos los event listeners para el modal de edición
        document.addEventListener('DOMContentLoaded', function() {
            // Event listeners para las fechas
            document.getElementById("editar-fecha-inicio").addEventListener("change", calcularDiasEdicion);
            document.getElementById("editar-fecha-fin").addEventListener("change", calcularDiasEdicion);

            // Event listener para el cambio de régimen
            document.getElementById("editar-regimen").addEventListener("change", function() {
                if (document.getElementById("editar-fecha-inicio").value &&
                    document.getElementById("editar-fecha-fin").value) {
                    calcularDiasEdicion();
                }
            });

            // Modificamos el evento del botón editar para que calcule el generado al abrir el modal
            document.querySelectorAll('.btn-editar-generada').forEach(button => {
                button.addEventListener('click', function() {
                    const id = this.getAttribute('data-id');
                    const fechaInicio = this.getAttribute('data-fecha-inicio');
                    const fechaFin = this.getAttribute('data-fecha-fin');
                    const idCentro = this.getAttribute('data-id-centro');
                    const concepto = this.getAttribute('data-concepto');
                    const regimen = this.getAttribute('data-regimen');
                    const extra = this.getAttribute('data-extra');

                    document.getElementById('editar-id-vac-generada').value = id;
                    document.getElementById('editar-fecha-inicio').value = fechaInicio;
                    document.getElementById('editar-fecha-fin').value = fechaFin;
                    document.getElementById('editar-id-centro').value = idCentro;
                    document.getElementById('editar-concepto').value = concepto;
                    document.getElementById('editar-regimen').value = regimen;
                    const switchExtra = document.getElementById('editar-extra');
                    if (extra === "Si") {
                        switchExtra.checked = true;
                    } else {
                        switchExtra.checked = false;
                    }

                    // Calculamos el generado inmediatamente después de cargar los datos
                    if (fechaInicio && fechaFin) {
                        calcularDiasEdicion();
                    }
                });
            });
        });
    </script>
    <script>
        document.querySelectorAll('.btn-editar').forEach(button => {
            button.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                const fechaInicio = this.getAttribute('data-fecha-inicio');
                const fechaFin = this.getAttribute('data-fecha-fin');
                const idCentro = this.getAttribute('data-id-centro');
                const concepto = this.getAttribute('data-concepto');
                const regimen = this.getAttribute('data-regimen');
                const generado = this.getAttribute('data-generado');
                const extra = this.getAttribute('data-extra');

                document.getElementById('editar-id-vac-generada').value = id;
                document.getElementById('editar-fecha-inicio').value = fechaInicio;
                document.getElementById('editar-fecha-fin').value = fechaFin;
                document.getElementById('editar-id-centro').value = idCentro;
                document.getElementById('editar-concepto').value = concepto;
                document.getElementById('editar-regimen').value = regimen;
                document.getElementById('editar-generado').value = generado;
                // Actualizar el estado del switch basado en "extra"
                const switchExtra = document.getElementById('editar-extra');
                if (extra === "Si") {
                    switchExtra.checked = true;
                } else {
                    switchExtra.checked = false;
                }
            });
        });
    </script>




    <script>
        // Inicializa el select2 para el campo de trabajador
        $(document).ready(function() {
            $('.id_trabajador').select2({
                theme: 'bootstrap4'
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            // Configuración común para ambas tablas
            const commonSettings = {
                responsive: true,
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json',
                },
                dom: 'Bfrtip', // Importante para mostrar botones
                buttons: [{
                    extend: "collection",
                    text: "Reportes",
                    buttons: [{
                            extend: "copy",
                            text: "Copiar"
                        },
                        {
                            extend: "pdf",
                            text: "PDF"
                        },
                        {
                            extend: "csv",
                            text: "CSV"
                        },
                        {
                            extend: "excel",
                            text: "Excel"
                        },
                        {
                            extend: "print",
                            text: "Imprimir"
                        }
                    ]
                }]
            };

            // Inicialización de tabla-generados
            const tablaGenerados = $('#tabla-generados').DataTable({
                ...commonSettings,
                columnDefs: [{
                    targets: [0, 1], // Aplica el cambio a las columnas Fecha Inicio y Fecha Fin
                    render: function(data, type, row) {
                        if (type === 'sort' || type === 'type') {
                            // Convierte la fecha de dd/mm/yyyy a yyyy-mm-dd para ordenar
                            const parts = data.split('/');
                            return `${parts[2]}-${parts[1]}-${parts[0]}`; // yyyy-mm-dd
                        }
                        return data; // Devuelve la fecha original para mostrarla
                    },
                }],
            });

            // Inicialización de tabla-consumidos
            const tablaConsumidos = $('#tabla-consumidos').DataTable({
                ...commonSettings,
                columnDefs: [{
                    targets: [0, 1], // Aplica el cambio a las columnas Fecha Inicio y Fecha Fin
                    render: function(data, type, row) {
                        if (type === 'sort' || type === 'type') {
                            // Convierte la fecha de dd/mm/yyyy a yyyy-mm-dd para ordenar
                            const parts = data.split('/');
                            return `${parts[2]}-${parts[1]}-${parts[0]}`; // yyyy-mm-dd
                        }
                        return data; // Devuelve la fecha original para mostrarla
                    },
                }],
            });

            // Función para recalcular el resumen
            function recalcularResumen() {
                let totalGenerado = 0;
                let totalConsumidoDescuenta1 = 0;
                let totalConsumidoDescuenta0 = 0;

                // Recalcular los totales basados en las filas visibles en la tabla de Generados
                $('#tabla-generados tbody tr').each(function() {
                    // Verificar si la fila está visible cuando hay un filtro de año
                    if ($(this).is(':visible')) {
                        const diasGenerados = parseFloat($(this).find('td:nth-child(7)').text()) || 0;
                        totalGenerado += diasGenerados;
                    }
                });
                // Recalcular los totales basados en las filas visibles en la tabla de Consumidos
                $('#tabla-consumidos tbody tr').each(function() {
                    // Verificar si la fila está visible cuando hay un filtro de año
                    if ($(this).is(':visible')) {
                        const diasConsumidos = parseFloat($(this).find('td:nth-child(3)').text()) || 0;
                        const descuenta = $(this).find('td:nth-child(4)').text().trim();

                        if (descuenta === '-') {
                            totalConsumidoDescuenta1 += diasConsumidos;
                        } else if (descuenta === 'SI') {
                            totalConsumidoDescuenta0 += diasConsumidos;
                        }
                    }
                });
                // Calcular los días pendientes
                const diasPendientes = totalGenerado - totalConsumidoDescuenta1;

                // Actualizar el resumen en la tabla
                $('#resumen-total-generado').text(totalGenerado.toFixed(2));
                $('#resumen-total-consumido-d1').text(totalConsumidoDescuenta1.toFixed(2));
                $('#resumen-dias-pendientes').text(diasPendientes.toFixed(2));
                $('#resumen-total-consumido-d0').text(totalConsumidoDescuenta0.toFixed(2));
            }

            // Filtrado por año y actualización del resumen
            $('#filtro-anio').change(function() {
                const selectedAnio = $(this).val();
                if (selectedAnio === 'todos') {
                    // Mostrar todas las filas
                    $('#tabla-generados tbody tr, #tabla-consumidos tbody tr').show();
                } else {
                    // Filtrar las filas según el año seleccionado
                    $('#tabla-generados tbody tr, #tabla-consumidos tbody tr').each(function() {
                        const rowAnio = $(this).data('anio');
                        if (rowAnio == selectedAnio) {
                            $(this).show();
                        } else {
                            $(this).hide();
                        }
                    });
                }

                // Recalcular el resumen después del filtrado
                recalcularResumen();
            });

            // Inicializar el resumen al cargar la página
            recalcularResumen();
        });
    </script>

    <script>
        document.querySelectorAll('.btn-editar-consumida').forEach(button => {
            button.addEventListener('click', function() {
                // Obtener datos del registro desde los atributos data-*
                const id = this.dataset.id;
                const idTrabajador = this.dataset.idTrabajador;
                const fechaInicio = this.dataset.fechaInicio;
                const fechaFin = this.dataset.fechaFin;
                const consumido = this.dataset.consumido;
                const descuenta = this.dataset.descuenta;
                const notas = this.dataset.notas;
                const comunicado = this.dataset.comunicado;

                // Cargar datos en el modal
                document.getElementById('id_vac_consumida_editar').value = id;
                document.getElementById('fecha_inicio_editar').value = fechaInicio || ''; // Evitar null
                document.getElementById('fecha_fin_editar').value = fechaFin || ''; // Evitar null
                document.getElementById('consumido_editar').value = consumido || ''; // Evitar null

                // Configurar el checkbox de descuenta
                document.getElementById('descuenta_editar').checked = parseInt(descuenta) === 0;

                document.getElementById('notas_editar').value = notas || ''; // Evitar null

                // Configurar el form-switch del comunicado
                const comunicadoSwitch = document.getElementById('editar-comunicado-switch');
                comunicadoSwitch.checked = comunicado && comunicado.trim().toLowerCase() === "si";

                // Agregar id_trabajador al modal
                document.getElementById('id_trabajador_editar').value = idTrabajador;

                // Abrir el modal
                const modalEditar = new bootstrap.Modal(document.getElementById('modal-editar-vacaciones'));
                modalEditar.show();
            });
        });
    </script>

    <script>
        // Función para calcular los días consumidos
        function calcularConsumidoEditar() {
            const fechaInicio = document.getElementById('fecha_inicio_editar').value;
            const fechaFin = document.getElementById('fecha_fin_editar').value;

            if (fechaInicio && fechaFin) {
                const fechaInicioDate = new Date(fechaInicio);
                const fechaFinDate = new Date(fechaFin);

                // Calcular la diferencia de días
                const diferenciaDias = (fechaFinDate - fechaInicioDate) / (1000 * 3600 * 24) + 1;

                if (diferenciaDias < 0) {
                    document.getElementById('consumido_editar').value = "Error: Fecha fin es anterior a la Fecha inicio";
                } else {
                    document.getElementById('consumido_editar').value = diferenciaDias;
                }
            } else {
                // Si no se completan las fechas, dejar el campo vacío
                document.getElementById('consumido_editar').value = '';
            }
        }

        // Agregar eventos para recalcular al cambiar las fechas
        document.getElementById('fecha_inicio_editar').addEventListener('change', calcularConsumidoEditar);
        document.getElementById('fecha_fin_editar').addEventListener('change', calcularConsumidoEditar);
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.x.x/dist/js/bootstrap.bundle.min.js"></script>


    </body>

    </html>