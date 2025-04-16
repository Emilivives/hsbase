<?php
include('../../app/config.php');
include('../../admin/layout/parte1.php');
include('../../app/controllers/trabajadores/listado_trabajadores.php');
include('../../app/controllers/maestros/centros/listado_centros.php');
include('../../app/controllers/maestros/empresas/listado_empresas.php');
include('../../app/controllers/maestros/categorias/listado_categorias.php');
include('../../app/controllers/trabajadores/listado_tr_noformado.php');
include('../../app/controllers/trabajadores/listado_tr_formacioncaducada.php');
include('../../app/controllers/maestros/documentos/listado_infoprl.php');

// Verifica que $trabajadores no esté vacío
if (empty($trabajadores)) {
    die("No hay trabajadores para mostrar");
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Listado de Trabajadores</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/2.0.2/css/dataTables.bootstrap5.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">



    <!-- DataTables Buttons -->
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <!--mensajes toast -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        /* Añadimos estilos para mejorar la visualización de los detalles */
        .details-row {
            display: none;
        }

        .details-row.show {
            display: table-row;
        }

        .details-control {
            cursor: pointer;
        }

        .details-content {
            padding: 20px;
            background-color: #f8f9fa;
        }

        .rotate {
            transform: rotate(45deg);
            transition: transform 0.3s ease;
        }

        .punto {
            display: inline-block;
            width: 10px;
            height: 10px;
            border-radius: 50%;
        }

        .punto-verde {
            background-color: green;
        }

        .punto-rojo {
            background-color: red;
        }

        /* Añadimos estilos para mejorar la visualización de los detalles */
        .table-details {
            width: 100%;
        }

        .details-control {
            cursor: pointer;
        }

        .card-statistic {
            transition: transform 0.2s;
            border-radius: 10px;
        }

        .card-statistic:hover {
            transform: translateY(-10px);
        }

        .statistic-icon {
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .bg-soft-primary {
            background-color: rgba(13, 110, 253, 0.1);
        }

        .bg-soft-success {
            background-color: rgba(25, 135, 84, 0.1);
        }

        .bg-soft-info {
            background-color: rgba(13, 202, 240, 0.1);
        }

        .bg-soft-warning {
            background-color: rgba(255, 193, 7, 0.1);
        }

        .bg-soft-danger {
            background-color: rgba(220, 53, 69, 0.1);
        }

        .bg-soft-dark {
            background-color: rgba(33, 37, 41, 0.1);
        }

        table.dataTable tbody tr.table-danger {
            background-color: #f8d7da !important;
        }
    </style>
</head>

<body>
    <div class="row">
        <!-- Tarjeta de Trabajadores Registrados -->
        <div class="col-lg-2 col-md-4 col-6 mb-3">
            <div class="card card-statistic border-0 shadow-sm h-100">
                <div class="card-body p-2 text-center">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="statistic-icon bg-soft-primary rounded-circle p-2">
                            <i class="bi bi-people text-primary" style="font-size: 1.2rem;"></i>
                        </div>
                        <span class="text-muted small">Trabajadores</span>
                    </div>
                    <h4 class="mb-0 mt-2"><?= count($trabajadores) ?></h4>
                    <small class="text-muted">Registrados</small>
                </div>
            </div>
        </div>

        <!-- Tarjeta de Trabajadores Activos -->
        <div class="col-lg-2 col-md-4 col-6 mb-3">
            <div class="card card-statistic border-0 shadow-sm h-100">
                <div class="card-body p-2 text-center">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="statistic-icon bg-soft-success rounded-circle p-2">
                            <i class="bi bi-person-check text-success" style="font-size: 1.2rem;"></i>
                        </div>
                        <span class="text-muted small">Activos</span>
                    </div>
                    <h4 class="mb-0 mt-2">
                        <?= count(array_filter($trabajadores, fn($t) => $t['activo_tr'] == 1)) ?>
                    </h4>
                    <small class="text-muted">En plantilla</small>
                </div>
            </div>
        </div>

        <!-- Tarjeta de Personal Tierra -->
        <div class="col-lg-2 col-md-4 col-6 mb-3">
            <div class="card card-statistic border-0 shadow-sm h-100">
                <div class="card-body p-2 text-center">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="statistic-icon bg-soft-info rounded-circle p-2">
                            <i class="bi bi-buildings text-info" style="font-size: 1.2rem;"></i>
                        </div>
                        <span class="text-muted small">Personal</span>
                    </div>
                    <h4 class="mb-0 mt-2">
                        <?= count(array_filter($trabajadores, fn($t) => $t['nombre_tc'] == 'Edificio' && $t['activo_tr'] == 1)) ?>
                    </h4>
                    <small class="text-muted">En tierra</small>
                </div>
            </div>
        </div>

        <!-- Tarjeta de Embarcados -->
        <div class="col-lg-2 col-md-4 col-6 mb-3">
            <div class="card card-statistic border-0 shadow-sm h-100">
                <div class="card-body p-2 text-center">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="statistic-icon bg-soft-warning rounded-circle p-2">
                            <i class="fas fa-ship text-warning" style="font-size: 1.2rem;"></i>
                        </div>
                        <span class="text-muted small">Personal</span>
                    </div>
                    <h4 class="mb-0 mt-2">
                        <?= count(array_filter($trabajadores, fn($t) => $t['nombre_tc'] == 'Embarcacion' && $t['activo_tr'] == 1)) ?>
                    </h4>
                    <small class="text-muted">Embarcado</small>
                </div>
            </div>
        </div>

        <!-- Tarjeta de Pendientes Formar -->
        <div class="col-lg-2 col-md-4 col-6 mb-3">
            <div class="card card-statistic border-0 shadow-sm h-100">
                <div class="card-body p-2 text-center" data-toggle="modal" data-target="#modal-pendientesformar" style="cursor: pointer;">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="statistic-icon bg-soft-danger rounded-circle p-2">
                            <i class="fas fa-book text-danger" style="font-size: 1.2rem;"></i>
                        </div>
                        <span class="text-muted small">Formacion PRL</span>
                    </div>
                    <h4 class="mb-0 mt-2">
                        <?= count(array_filter($trabajadores, fn($t) => $t['activo_tr'] == 1 && $t['formacionpdt_tr'] == 'No')) ?>
                    </h4>
                    <small class="text-muted">Pendientes</small>
                </div>
            </div>
        </div>

        <!-- Tarjeta de Formaciones Vencidas -->
        <div class="col-lg-2 col-md-4 col-6 mb-3">
            <div class="card card-statistic border-0 shadow-sm h-100">
                <div class="card-body p-2 text-center" data-toggle="modal" data-target="#modal-formacioncaducada" style="cursor: pointer;">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="statistic-icon bg-soft-dark rounded-circle p-2">
                            <i class="bi bi-calendar-x text-dark" style="font-size: 1.2rem;"></i>
                        </div>
                        <span class="text-muted small">Formacion PRL</span>
                    </div>
                    <?php
                    $sql = "SELECT COUNT(DISTINCT fas.idtrabajador_fas) AS expiring_count
        FROM form_asistencia fas
        INNER JOIN formacion fr ON fas.nroformacion = fr.nroformacion
        INNER JOIN tipoformacion tf ON fr.tipo_fr = tf.id_tipoformacion
        WHERE tf.art19_tf = 1
          AND fr.fechacad_fr BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL 3 MONTH)";

                    $query = $pdo->prepare($sql);
                    $query->execute();
                    $result = $query->fetch(PDO::FETCH_ASSOC);
                    $expiring_count = $result['expiring_count'];
                    ?>
                    <h4 class="mb-0 mt-2"><?= $expiring_count ?></h4>
                    <small class="text-muted">Vencidas</small>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal-formacioncaducada">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header" style="background-color:#138fec; color:white">
                    <h5 class="modal-title" id="modal-formacioncaducada">FORMACION CADUCADA</h5>
                    <button type="button" class="close" style="color: white;" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>

                </div>
                <div class="modal-body">
                    <table id="modal-table-caducada" class="table table-sm">
                        <colgroup>
                            <col width="30%">
                            <col width="10%">
                            <col width="20%">
                            <col width="25%">
                            <col width="15%">
                        </colgroup>
                        <thead>
                            <tr>
                                <th style="text-align: left">Nombre</th>
                                <th style="text-align: left">Fecha cad</th>
                                <th style="text-align: left">Categoria</th>
                                <th style="text-align: left">Centro</th>
                                <th style="text-align: left">Empresa</th>
                                <th style="text-align: left"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $contador = 0;
                            foreach ($trabajadores_formacioncaducada as $trabajador_formacioncaducada) {
                                $contador++;
                                // Convertir la fecha de caducidad y la fecha actual a timestamp
                                $fechaCad = strtotime($trabajador_formacioncaducada['fechacad_fr']);
                                $hoy = strtotime(date("Y-m-d"));
                                // Asignar clase de Bootstrap si la fecha de caducidad es anterior a hoy
                                $class = ($fechaCad < $hoy) ? 'table-danger' : '';
                                // Para la fecha, si es caducada se subraya
                                $estiloFecha = ($fechaCad < $hoy) ? 'text-decoration: underline;' : '';
                            ?>
                                <tr class="<?php echo $class; ?>">
                                    <td style="text-align: left"><?php echo $trabajador_formacioncaducada['nombre_tr']; ?></td>
                                    <td style="text-align: left; <?php echo $estiloFecha; ?>">
                                        <?php echo date("d/m/Y", strtotime($trabajador_formacioncaducada['fechacad_fr'])); ?>
                                    </td>
                                    <td style="text-align: left"><?php echo $trabajador_formacioncaducada['nombre_cat']; ?></td>
                                    <td style="text-align: left"><?php echo $trabajador_formacioncaducada['nombre_cen']; ?></td>
                                    <td style="text-align: left"><?php echo $trabajador_formacioncaducada['nombre_emp']; ?></td>
                                    <td style="text-align: left">
                                        <button class="btn btn-sm btn-primary filtrar-trabajador"
                                            data-id="<?= $trabajador_formacioncaducada['id_trabajador'] ?>"
                                            data-nombre="<?= htmlspecialchars($trabajador_formacioncaducada['nombre_tr']) ?>"
                                            data-modal="modal-formacioncaducada">
                                            </i> VER
                                        </button>
                                    </td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal-pendientesformar">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header" style="background-color:#138fec ;color:white">
                    <h5 class="modal-title" id="modal-pendientesformar">TRABAJADORES PENDIENTES FORMAR</h5>
                    <button type="button" class="close" style="color: white;" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>

                </div>
                <div class="modal-body">
                    <table id="modal-table" class="table table-sm">
                        <colgroup>
                            <col width="35%">
                            <col width="20%">
                            <col width="30%">
                            <col width="15%">
                        </colgroup>
                        <thead>
                            <tr>
                                <th style="text-align: left">Nombre</th>
                                <th style="text-align: left">Categoria</th>
                                <th style="text-align: left">Centro</th>
                                <th style="text-align: left">Empresa</th>
                                <th style="text-align: left"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $contador = 0;
                            foreach ($trabajadores_noformados as $trabajador_noformados) {
                                $contador = $contador + 1;
                            ?>
                                <tr>
                                    <td style="text-align: left"><?php echo $trabajador_noformados['nombre_tr']; ?></td>
                                    <td style="text-align: left"><?php echo $trabajador_noformados['nombre_cat']; ?></td>
                                    <td style="text-align: left"><?php echo $trabajador_noformados['nombre_cen']; ?></td>
                                    <td style="text-align: left"><?php echo $trabajador_noformados['nombre_emp']; ?></td>
                                    <td style="text-align: left;">
                                        <button class="btn btn-sm btn-primary filtrar-trabajador"
                                            data-id="<?= $trabajador_noformados['id_trabajador'] ?>"
                                            data-nombre="<?= htmlspecialchars($trabajador_noformados['nombre_tr']) ?>"
                                            data-modal="modal-pendientesformar">
                                            </i> VER
                                        </button>
                                    </td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="container-fluid mt-4">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                            <h4 class="mb-0">Listado de Trabajadores</h4>
                            <!-- Aquí el botón para agregar un nuevo trabajador, alineado a la derecha -->
                            <button type="button" class="btn btn-success ms-auto" data-bs-toggle="modal" data-bs-target="#modalAgregar">
                                Agregar Nuevo Trabajador
                            </button>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped table-hover" id="trabajadoresTable">

                                <thead>
                                    <tr>
                                        <th style="width: 2%;"></th>
                                        <th style="width: 3%;">Código</th>
                                        <th style="width: 3%;">Estado</th>
                                        <th style="width: 1%; text-align: right;"> F</th>
                                        <th style="width: 1%; text-align: right;">I</th>
                                        <th style="width: 15%;">Nombre</th>
                                        <th style="width: 10%;">DNI</th>
                                        <th style="width: 10%;">Categoría</th>
                                        <th style="width: 20%;">Centro Tº</th>
                                        <th style="width: 10%;">Empresa</th>
                                        <th style="width: 5%;">% Form.</th>
                                        <th style="width: 5%;">% Info.</th>


                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($trabajadores as $trabajador): ?>
                                        <tr data-id="<?= $trabajador['id_trabajador'] ?>">
                                            <td class="details-control">
                                                <i class="bi bi-plus-circle text-primary"></i>
                                            </td>

                                            <td><?= htmlspecialchars($trabajador['codigo_tr']) ?></td>
                                            <td>
                                                <?php if ($trabajador['activo_tr'] == 1): ?>
                                                    <span class='badge bg-success'>ACTIVO</span>
                                                <?php else: ?>
                                                    <span class='badge bg-danger'>. BAJA .</span>
                                                <?php endif; ?>

                                            </td>
                                            <td style="text-align: left;"> <?php $sql = "SELECT COUNT(*) AS count_puesto
                    FROM formacion fr
                    INNER JOIN tipoformacion tf ON fr.tipo_fr = tf.id_tipoformacion
                    INNER JOIN form_asistencia fas ON fas.nroformacion = fr.nroformacion
                    WHERE fas.idtrabajador_fas = :id_trabajador AND tf.art19_tf = 1";
                                                                            $query = $pdo->prepare($sql);
                                                                            $query->bindValue(':id_trabajador', $trabajador['id_trabajador'], PDO::PARAM_INT);
                                                                            $query->execute();
                                                                            $result = $query->fetch(PDO::FETCH_ASSOC);
                                                                            $countPuesto = $result['count_puesto'];
                                                                            ?>
                                                <?php if ($countPuesto > 0) { ?>
                                                    <span class='badge badge-success'></span><?php
                                                                                            } else { ?>
                                                    <span class='badge badge-danger' title="Trabajador sin formación">N</i></span><?php
                                                                                                                                } ?>
                                            </td>
                                            <td>
                                                <?php if ($trabajador['informacion_tr'] !== 'Si') { ?>
                                                    <span class='badge badge-danger' title="No informado Art. 18 LPRL">N</i>

                                                    <?php } ?>
                                            </td>
                                            <td><?= htmlspecialchars($trabajador['nombre_tr']) ?></td>
                                            <td><?= htmlspecialchars($trabajador['dni_tr']) ?></td>
                                            <td><?= htmlspecialchars($trabajador['nombre_cat']) ?></td>
                                            <td><?= htmlspecialchars($trabajador['nombre_cen']) ?></td>
                                            <td><?= htmlspecialchars($trabajador['nombre_emp']) ?></td>
                                            <td>
                                                <?php
                                                // Consulta para obtener el porcentaje de cumplimiento
                                                $query = $pdo->prepare("
        SELECT 
            COUNT(*) AS total_formaciones,
            SUM(CASE WHEN estado = 'Completado' THEN 1 ELSE 0 END) AS completadas
        FROM formacion_trabajador
        WHERE id_trabajador = :id_trabajador
    ");
                                                $query->bindParam(':id_trabajador', $trabajador['id_trabajador'], PDO::PARAM_INT);
                                                $query->execute();
                                                $resultado = $query->fetch(PDO::FETCH_ASSOC);

                                                $total_formaciones = $resultado['total_formaciones'] ?? 0;
                                                $completadas = $resultado['completadas'] ?? 0;

                                                // Evitar división por cero
                                                $porcentaje = ($total_formaciones > 0) ? ($completadas * 100 / $total_formaciones) : 0;

                                                // Determinar color de la barra según porcentaje
                                                $color = "bg-danger"; // Rojo por defecto
                                                if ($porcentaje >= 75) {
                                                    $color = "bg-success"; // Verde si es >= 75%
                                                } elseif ($porcentaje >= 50) {
                                                    $color = "bg-warning"; // Amarillo si es >= 50%
                                                }
                                                ?>

                                                <div class="progress" style="height: 20px; width: 80px;">
                                                    <div class="progress-bar <?php echo $color; ?>" role="progressbar"
                                                        style="width: <?php echo $porcentaje; ?>%;"
                                                        aria-valuenow="<?php echo $porcentaje; ?>"
                                                        aria-valuemin="0" aria-valuemax="100">
                                                        <?php echo round($porcentaje, 1); ?>%
                                                    </div>
                                                </div>
                                            </td>


                                            <td>
                                                <?php
                                                // Consulta para obtener el porcentaje de cumplimiento
                                                $query = $pdo->prepare("
        SELECT 
            COUNT(*) AS total_informaciones,
            SUM(CASE WHEN estado = 'Completado' THEN 1 ELSE 0 END) AS completadas
        FROM informacion_trabajador
        WHERE id_trabajador = :id_trabajador
    ");
                                                $query->bindParam(':id_trabajador', $trabajador['id_trabajador'], PDO::PARAM_INT);
                                                $query->execute();
                                                $resultado = $query->fetch(PDO::FETCH_ASSOC);

                                                $total_formaciones = $resultado['total_informaciones'] ?? 0;
                                                $completadas = $resultado['completadas'] ?? 0;

                                                // Evitar división por cero
                                                $porcentaje = ($total_formaciones > 0) ? ($completadas * 100 / $total_formaciones) : 0;

                                                // Determinar color de la barra según porcentaje
                                                $color = "bg-danger"; // Rojo por defecto
                                                if ($porcentaje >= 75) {
                                                    $color = "bg-success"; // Verde si es >= 75%
                                                } elseif ($porcentaje >= 50) {
                                                    $color = "bg-warning"; // Amarillo si es >= 50%
                                                }
                                                ?>

                                                <div class="progress" style="height: 20px; width: 80px;">
                                                    <div class="progress-bar <?php echo $color; ?>" role="progressbar"
                                                        style="width: <?php echo $porcentaje; ?>%;"
                                                        aria-valuenow="<?php echo $porcentaje; ?>"
                                                        aria-valuemin="0" aria-valuemax="100">
                                                        <?php echo round($porcentaje, 1); ?>%
                                                    </div>
                                                </div>
                                            </td>


                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>




        <div class="modal fade" id="modalAgregar" tabindex="-1" aria-labelledby="modalAgregarLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header" style="background-color:#16e9aa; color:black;">
                        <h5 class="modal-title" id="modalAgregarLabel">Nuevo Trabajador</h5>
                        <button type="button" class="btn-close" style="color: black;" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="formAgregar">
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="">Código</label>
                                        <input type="text" name="codigo_tr" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="">DNI/NIE</label>
                                        <input type="text" name="dni_tr" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">APELLIDOS, NOMBRE</label>
                                        <input type="text" name="nombre_tr" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <br>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="sexo_tr" id="flexRadioDefault1" value="Hombre" checked>
                                        <label class="form-check-label" for="flexRadioDefault1"><b>Hombre</b></label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="sexo_tr" id="flexRadioDefault2" value="Mujer">
                                        <label class="form-check-label" for="flexRadioDefault2"><b>Mujer</b></label>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="">Fecha Nacimiento</label>
                                        <input type="date" name="fechanac_tr" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="">Fecha Inicio</label>
                                        <input type="date" name="inicio_tr" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <br>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="formacionpdt_tr" id="flexRadioDefault3" value="No" checked>
                                        <label class="form-check-label" for="flexRadioDefault3"><b>NO FORMADO PRL</b></label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="formacionpdt_tr" id="flexRadioDefault4" value="Si">
                                        <label class="form-check-label" for="flexRadioDefault4"><b>FORMADO PRL</b></label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <br>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="informacion_tr" id="flexRadioDefault5" value="No" checked>
                                        <label class="form-check-label" for="flexRadioDefault5"><b>NO INFORMADO PRL</b></label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="informacion_tr" id="flexRadioDefault6" value="Si">
                                        <label class="form-check-label" for="flexRadioDefault6"><b>INFORMADO PRL</b></label>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-3">
                                    <label for="empresa">Empresa:</label>
                                    <select id="empresa_cen" class="form-control" required>
                                        <option value="">Seleccione una empresa</option>
                                        <?php foreach ($empresas_datos as $empresa) { ?>
                                            <option value="<?php echo $empresa['id_empresa']; ?>"><?php echo $empresa['nombre_emp']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label for="centro">Centro de Trabajo:</label>
                                    <select name="centro_tr" id="centro_cen" class="form-control" required>
                                        <option value="">Seleccione una empresa primero</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Categoría</label>
                                        <select name="categoria_tr" class="form-control" required>
                                            <option value="0">--Seleccione categoría--</option>
                                            <?php foreach ($categorias_datos as $categoria) { ?>
                                                <option value="<?php echo $categoria['id_categoria']; ?>"><?php echo $categoria['nombre_cat']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="">Anotaciones</label>
                                        <input type="text" name="anotaciones_tr" class="form-control">
                                    </div>
                                </div>
                            </div>

                            <!-- Pestañas -->
                            <!-- Pestañas -->
                            <ul class="nav nav-tabs" id="myTabs">
                                <li class="nav-item">
                                    <a class="nav-link active" id="formaciones-tab" data-bs-toggle="tab" href="#formaciones">Formaciones</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="informacion-tab" data-bs-toggle="tab" href="#informacion">Información PRL</a>
                                </li>
                            </ul>

                            <!-- Contenido de las pestañas -->
                            <div class="tab-content mt-3">
                                <!-- Tab: Formaciones a Realizar -->
                                <div class="tab-pane fade show active" id="formaciones">
                                    <?php
                                    // Obtener todas las formaciones disponibles
                                    $sql_formaciones = "SELECT id_tipoformacion, nombre_tf FROM tipoformacion ORDER BY nombre_tf ASC";
                                    $query_formaciones = $pdo->prepare($sql_formaciones);
                                    $query_formaciones->execute();
                                    $formaciones_disponibles = $query_formaciones->fetchAll(PDO::FETCH_ASSOC);
                                    ?>

                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <h6 class="text-primary"><i class="bi bi-mortarboard"></i> Formaciones a Realizar</h6>
                                        <div>
                                            <input type="checkbox" id="selectAllFormaciones" class="form-check-input">
                                            <label for="selectAllFormaciones" class="fw-bold ms-2">Seleccionar Todas</label>
                                        </div>
                                    </div>

                                    <!-- Grid de formaciones con efecto hover -->
                                    <div class="row row-cols-2 row-cols-md-3 g-1">
                                        <?php foreach ($formaciones_disponibles as $formacion): ?>
                                            <div class="col">
                                                <div class="card hover-effect shadow-sm border-1 mb-1" style="font-size: 0.9rem; cursor: pointer;" onclick="document.getElementById('formacion_<?php echo $formacion['id_tipoformacion']; ?>').click();">
                                                    <div class="card-body p-2">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" name="formaciones[]" value="<?php echo $formacion['id_tipoformacion']; ?>" id="formacion_<?php echo $formacion['id_tipoformacion']; ?>" onclick="event.stopPropagation();">
                                                            <label class="form-check-label fw-semibold" for="formacion_<?php echo $formacion['id_tipoformacion']; ?>" style="line-height: 1.2;">
                                                                <?php echo $formacion['nombre_tf']; ?>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>

                                <!-- Tab: Información PRL -->
                                <div class="tab-pane fade" id="informacion">
                                    <?php
                                    // Obtener toda la información PRL disponible
                                    $sql_info_documentos = "SELECT id_infodoc, nombre_ifd FROM info_documentos ORDER BY nombre_ifd ASC";
                                    $query_info_documentos = $pdo->prepare($sql_info_documentos);
                                    $query_info_documentos->execute();
                                    $info_documentos_datos = $query_info_documentos->fetchAll(PDO::FETCH_ASSOC);
                                    ?>

                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <h6 class="text-primary"><i class="bi bi-file-earmark-text"></i> Información PRL a Entregar</h6>
                                        <div>
                                            <input type="checkbox" id="selectAllInfoPRL" class="form-check-input">
                                            <label for="selectAllInfoPRL" class="fw-bold ms-2">Seleccionar Todas</label>
                                        </div>
                                    </div>

                                    <!-- Grid de información PRL con efecto hover -->
                                    <div class="row row-cols-2 row-cols-md-3 g-1">
                                        <?php foreach ($info_documentos_datos as $info): ?>
                                            <div class="col">
                                                <div class="card hover-effect shadow-sm border-1 mb-1" style="font-size: 0.9rem; cursor: pointer;" onclick="document.getElementById('info_<?php echo $info['id_infodoc']; ?>').click();">
                                                    <div class="card-body p-2">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" name="info_prl[]" value="<?php echo $info['id_infodoc']; ?>" id="info_<?php echo $info['id_infodoc']; ?>" onclick="event.stopPropagation();">
                                                            <label class="form-check-label fw-semibold" for="info_<?php echo $info['id_infodoc']; ?>" style="line-height: 1.2;">
                                                                <?php echo $info['nombre_ifd']; ?>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>




                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                <button type="submit" class="btn btn-primary"><i class="bi bi-floppy"></i> Guardar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modalEditar" tabindex="-1" aria-labelledby="modalEditarLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header" style="background-color:#ffcc00; color:black;">
                        <h5 class="modal-title" id="modalEditarLabel">Editar Trabajador</h5>
                        <button type="button" class="btn-close" style="color: black;" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="formEditar">
                            <input type="hidden" name="id_trabajador" id="id_trabajador">
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="">Código</label>
                                        <input type="text" name="codigo_tr" id="codigo_tr" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="">DNI/NIE</label>
                                        <input type="text" name="dni_tr" id="dni_tr" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">APELLIDOS, NOMBRE</label>
                                        <input type="text" name="nombre_tr" id="nombre_tr" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <br>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="sexo_tr" id="sexoHombre" value="Hombre">
                                        <label class="form-check-label" for="sexoHombre"><b>Hombre</b></label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="sexo_tr" id="sexoMujer" value="Mujer">
                                        <label class="form-check-label" for="sexoMujer"><b>Mujer</b></label>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="">Fecha Nacimiento</label>
                                        <input type="date" name="fechanac_tr" id="fechanac_tr" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="">Fecha Inicio</label>
                                        <input type="date" name="inicio_tr" id="inicio_tr" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <br>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="formacionpdt_tr" id="formacionNo" value="No">
                                        <label class="form-check-label" for="formacionNo"><b>NO FORMADO PRL</b></label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="formacionpdt_tr" id="formacionSi" value="Si">
                                        <label class="form-check-label" for="formacionSi"><b>FORMADO PRL</b></label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <br>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="informacion_tr" id="informacionNo" value="No">
                                        <label class="form-check-label" for="informacionNo"><b>NO INFORMADO PRL</b></label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="informacion_tr" id="informacionSi" value="Si">
                                        <label class="form-check-label" for="informacionSi"><b>INFORMADO PRL</b></label>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-3">
                                    <label for="empresa_edit">Empresa:</label>
                                    <select id="empresa_edit" class="form-control" required>
                                        <option value="">Seleccione una empresa</option>
                                        <?php foreach ($empresas_datos as $empresa) { ?>
                                            <option value="<?php echo $empresa['id_empresa']; ?>"><?php echo $empresa['nombre_emp']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label for="centro_edit">Centro de Trabajo:</label>
                                    <select name="centro_tr" id="centro_edit" class="form-control" required>
                                        <option value="">Seleccione una empresa primero</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Categoría</label>
                                        <select name="categoria_tr" id="categoria_tr" class="form-control" required>
                                            <option value="0">--Seleccione categoría--</option>
                                            <?php foreach ($categorias_datos as $categoria) { ?>
                                                <option value="<?php echo $categoria['id_categoria']; ?>"><?php echo $categoria['nombre_cat']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="">Anotaciones</label>
                                        <input type="text" name="anotaciones_tr" id="anotaciones_tr" class="form-control">
                                    </div>
                                </div>
                            </div>

                            <!-- Pestañas -->
                            <ul class="nav nav-tabs" id="myTabsEdit">
                                <li class="nav-item">
                                    <a class="nav-link active" id="formaciones-tab-edit" data-bs-toggle="tab" href="#formaciones-edit">Formaciones</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="informacion-tab-edit" data-bs-toggle="tab" href="#informacion-edit">Información PRL</a>
                                </li>
                            </ul>

                            <!-- Contenido de las pestañas -->
                            <div class="tab-content mt-3">
                                <!-- Tab: Formaciones a Realizar -->
                                <!-- Tab: Formaciones a Realizar -->
                                <div class="tab-pane fade show active" id="formaciones-edit">
                                    <input type="hidden" name="procesar_formaciones" value="1">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <h6 class="text-primary"><i class="bi bi-mortarboard"></i> Formaciones a Realizar</h6>
                                    </div>
                                    <!-- Grid de formaciones con efecto hover -->
                                    <div class="row row-cols-2 row-cols-md-3 g-1" id="formaciones-container">
                                        <!-- Se llenará dinámicamente -->
                                    </div>
                                </div>

                                <!-- Tab: Información PRL -->
                                <div class="tab-pane fade" id="informacion-edit">
                                    <input type="hidden" name="procesar_info_prl" value="1">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <h6 class="text-primary"><i class="bi bi-file-earmark-text"></i> Información PRL a Entregar</h6>
                                    </div>
                                    <!-- Grid de información PRL con efecto hover -->
                                    <div class="row row-cols-2 row-cols-md-3 g-1" id="info-prl-container">
                                        <!-- Se llenará dinámicamente -->
                                    </div>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                <button type="submit" class="btn btn-warning"><i class="bi bi-save"></i> Actualizar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="modalAutorizacion" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <!-- ENCABEZADO -->
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title" id="modalLabel"><i class="bi bi-check-square"></i> Seleccionar Centros</h5>
                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>


                    <!-- Cuerpo del Modal -->
                    <div class="modal-body">
                        <?php
                        // Obtener centros activos de la empresa del trabajador
                        $id_empresa_trabajador = $trabajador['id_empresa'];
                        $sql_centros = "SELECT cen.id_centro, cen.nombre_cen, cen.direccion_cen, cen.estado_cen, 
                                       emp.nombre_emp, emp.razonsocial_emp, emp.modalidadprl_emp, 
                                       tc.nombre_tc
                                FROM centros AS cen
                                INNER JOIN empresa AS emp ON cen.empresa_cen = emp.id_empresa
                                INNER JOIN tipocentros AS tc ON cen.tipo_cen = tc.id_tipocentro
                                WHERE emp.id_empresa = :id_empresa AND cen.estado_cen = 1
                                ORDER BY cen.nombre_cen ASC";
                        $query_centros = $pdo->prepare($sql_centros);
                        $query_centros->execute([':id_empresa' => $id_empresa_trabajador]);
                        $centros_datos2 = $query_centros->fetchAll(PDO::FETCH_ASSOC);
                        ?>

                        <form id="formAutorizacion">
                            <input type="hidden" id="idTrabajadorInput" name="id_trabajador">
                            <!-- Botón para seleccionar todos -->
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h6 class="text-primary"><i class="bi bi-building"></i> Centros Disponibles</h6>
                                <div>
                                    <input type="checkbox" id="selectAll" class="form-check-input">
                                    <label for="selectAll" class="fw-bold ms-2">Seleccionar Todos</label>
                                </div>
                            </div>

                            <!-- Grid de centros más compacto con tarjetas clickables -->
                            <!-- Grid de centros con efecto hover -->
                            <div class="row row-cols-2 row-cols-md-3 g-1">
                                <?php foreach ($centros_datos2 as $centro): ?>
                                    <div class="col">
                                        <div class="card hover-effect shadow-sm border-1 mb-1" style="font-size: 0.9rem; cursor: pointer;" onclick="document.getElementById('centro_<?php echo $centro['id_centro']; ?>').click();">
                                            <div class="card-body p-2">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="centros[]" value="<?php echo $centro['id_centro']; ?>" id="centro_<?php echo $centro['id_centro']; ?>" onclick="event.stopPropagation();">
                                                    <label class="form-check-label fw-semibold" for="centro_<?php echo $centro['id_centro']; ?>" style="line-height: 1.2;">
                                                        <?php echo $centro['nombre_cen']; ?>
                                                    </label>
                                                </div>
                                                <small class="text-muted d-block" style="font-size: 0.8rem;"><?php echo $centro['nombre_emp']; ?></small>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </form>
                    </div>

                    <!-- Pie del Modal -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="bi bi-x-circle"></i> Cerrar</button>
                        <button type="button" class="btn btn-primary" id="btnGenerar"><i class="bi bi-file-earmark-check"></i> Generar Autorización</button>
                    </div>
                </div>
            </div>
        </div>


        <!-- Modal Entrega Info -->
        <div class="modal fade" id="modalEntregaInfo" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title">Registrar Entrega de Documento</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <form id="formEntregaInfo">
                        <div class="modal-body">
                            <input type="hidden" id="idTrabajador" name="id_trabajador">

                            <div class="mb-3">
                                <label class="form-label">Trabajador</label>
                                <input type="text" id="nombreTrabajador" class="form-control" readonly>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Documento</label>
                                <select class="form-select" name="id_infodoc" id="selectDocumentos" required>
                                    <option value="" disabled selected>Cargando documentos...</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Fecha de Entrega</label>
                                <input type="date" name="fecha_completado" class="form-control" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!--fin modal-->

    </div>
    <script>
        $(document).ready(function() {
            // Funciones auxiliares globales
            function getEstadoBadge(estado) {
                if (!estado) return '<span class="badge bg-secondary">No especificado</span>';
                estado = estado.toLowerCase();
                if (estado === 'completado') {
                    return '<span class="badge bg-success">Completado</span>';
                } else {
                    return '<span class="badge bg-warning text-dark">Pendiente</span>';
                }
            }

            function getPRLEstadoBadge(estado) {
                if (!estado) return '<span class="badge bg-secondary">No especificado</span>';
                estado = estado.toLowerCase();
                if (estado.includes('complet') || estado.includes('valido')) {
                    return '<span class="badge bg-success">Válido</span>';
                } else if (estado.includes('pendiente') || estado.includes('caduc')) {
                    return '<span class="badge bg-warning text-dark">Pendiente</span>';
                } else {
                    return `<span class="badge bg-info">${estado}</span>`;
                }
            }

            function formatDate(dateString) {
                if (!dateString || dateString === '0000-00-00') return 'N/A';
                const options = {
                    day: '2-digit',
                    month: '2-digit',
                    year: 'numeric'
                };
                return new Date(dateString).toLocaleDateString('es-ES', options);
            }

            // Inicializar DataTables
            const table = $('#trabajadoresTable').DataTable({
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/2.0.2/i18n/es-ES.json'
                },
                columnDefs: [{
                    targets: 0,
                    orderable: false,
                    searchable: false,
                    className: 'details-control'
                }],
                order: [
                    [1, 'asc']
                ],
                pageLength: 10,
                responsive: true,
                lengthChange: true,
                autoWidth: false
            });

            // Manejador del acordeón para DataTables
            $('#trabajadoresTable tbody').on('click', 'td.details-control', function() {
                const $tr = $(this).closest('tr');
                const id_trabajador = $tr.data('id');
                const $icon = $(this).find('i');
                const $row = $tr.next('.details-row');

                $icon.toggleClass('rotate');

                if ($row.length) {
                    $row.toggleClass('show');
                } else {
                    $icon.removeClass('bi-plus-circle').addClass('bi-arrow-clockwise spinner');

                    $.ajax({
                        url: 'detalles_trabajador.php',
                        method: 'POST',
                        data: {
                            id_trabajador: id_trabajador
                        },
                        dataType: 'json',
                        success: function(response) {
                            $icon.removeClass('bi-arrow-clockwise spinner').addClass('bi-plus-circle');

                            if (response.status === 'success') {
                                const t = response.trabajador;

                                // Generar HTML para formaciones
                                let formacionesHTML = '<div class="alert alert-info">No tiene formaciones asignadas</div>';
                                if (response.formaciones.trabajador.length > 0) {
                                    formacionesHTML = response.formaciones.trabajador.map(f => `
                                <div class="col mb-2">
                                    <div class="card border-${f.estado === 'Completado' ? 'success' : 'warning'} h-100">
                                        <div class="card-body p-2">
                                            <h6 class="card-title">${f.nombre_tf || 'N/A'}</h6>
                                            <p class="card-text mb-1">
                                                <small class="text-muted">
                                                    ${getEstadoBadge(f.estado)}
                                                    ${f.fecha_completado ? '' + formatDate(f.fecha_completado) : ''}
                                                </small>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            `).join('');
                                }

                                // Generar HTML para PRL
                                let infoPRLHTML = '<div class="alert alert-warning">No tiene documentación PRL asignada</div>';
                                if (response.info_prl.trabajador.length > 0) {
                                    infoPRLHTML = response.info_prl.trabajador.map(d => `
                                <div class="col mb-2">
                                    <div class="card border-${d.estado === 'Completado' ? 'success' : 'warning'} h-100">
                                        <div class="card-body p-2">
                                            <h6 class="card-title">${d.nombre_ifd || 'N/A'}</h6>
                                            <p class="card-text mb-1">
                                                <small class="text-muted">
                                                    ${getPRLEstadoBadge(d.estado)}
                                                    ${d.fecha_completado ? 'Completado: ' + formatDate(d.fecha_completado) : ''}
                                                </small>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            `).join('');
                                }

                                // Calcular cumplimiento de formaciones
                                const total_formaciones = response.formaciones.trabajador.length;
                                const completadas = response.formaciones.trabajador.filter(f => f.estado === 'Completado').length;

                                // Crear HTML con pestañas
                                const detailsHtml = `
                            <tr class="details-row show">
                                <td colspan="10" class="details-content p-0">
                                    <div class="card rounded-0 border-top-0">
                                        <div class="card-body p-0">
                                            <ul class="nav nav-tabs" role="tablist">
                                                <li class="nav-item">
                                                    <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#info-${t.id_trabajador}" type="button">
                                                        Información Personal
                                                    </button>
                                                </li>
                                                <li class="nav-item">
                                                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#formacion-${t.id_trabajador}" type="button">
                                                        Formación
                                                    </button>
                                                </li>
                                                <li class="nav-item">
                                                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#info-prl-${t.id_trabajador}" type="button">
                                                        Info PRL
                                                    </button>
                                                </li>
                                                 <li class="nav-item">
                                                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#reconocimiento-${t.id_trabajador}" type="button">
                                                       Recon. Med.
                                                    </button>
                                                </li>
                                            </ul>
                                            <div class="tab-content mt-2 p-3">
                                                <div id="info-${t.id_trabajador}" class="tab-pane fade show active">
                                                    <div class="row">
                                                        <div class="col-md-2">
                                                            <p><strong>Nombre:</strong> ${t.nombre_tr || 'N/A'}</p>
                                                            <p><strong>DNI:</strong> ${t.dni_tr || 'N/A'}</p>
                                                            <p><strong>Teléfono:</strong> ${t.telefono_tr || 'N/A'}</p>
                                                         <p><strong>Sexo:</strong> ${t.sexo_tr || 'N/A'}</p>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <p><strong>Email:</strong> ${t.email_tr || 'N/A'}</p>
                                                            <p><strong>Categoría:</strong> ${t.categoria_nombre || 'N/A'}</p>
                                                            <p><strong>Estado:</strong> ${t.activo_tr == 1 ? 'Activo' : 'Inactivo'}</p>
                                             <p><strong>Inicio empresa:</strong> ${formatDate(t.inicio_tr) || 'N/A'}</p>
                                                        </div>
                                                        <div class="col-md-7">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <h6 class="text">
                                                                        <i class="bi bi-mortarboard"></i> Formaciones Asignadas - cumplimiento: 
                                                                        ${completadas} / ${total_formaciones}
                                                                    </h6>
                                                                    <div class="row row-cols-1 row-cols-md-2 g-2">
                                                                        ${formacionesHTML}
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <h6 class="text">
                                                                        <i class="bi bi-info-circle"></i> Información PRL
                                                                    </h6>
                                                                    <div class="row row-cols-1 row-cols-md-2 g-2">
                                                                        ${infoPRLHTML}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-1">
                                                           <button class="btn btn-warning btn-sm btn-editar" data-id="${t.id_trabajador}">
                                                            <i class="bi bi-pencil-square"></i> Editar
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div id="formacion-${t.id_trabajador}" class="tab-pane fade">
                                                    <div class="text-center">
                                                        <div class="spinner-border text-primary" role="status">
                                                            <span class="visually-hidden">Cargando...</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div id="info-prl-${t.id_trabajador}" class="tab-pane fade">
                                                    <div class="text-center">
                                                        <div class="spinner-border text-primary" role="status">
                                                            <span class="visually-hidden">Cargando...</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                 <div id="reconocimiento-${t.id_trabajador}" class="tab-pane fade">
                                                    <div class="text-center">
                                                        <div class="spinner-border text-primary" role="status">
                                                            <span class="visually-hidden">Cargando...</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td colspan="2" class="details-content p-0">
    <div class="card rounded-0 border-top-0">
        <!-- Encabezado del card -->
        <div class="card-header">
            <strong><i class="bi bi-printer-fill"></i> Imprimir Documentos</strong>
        </div>

        <div class="card-body p-2">
            <!-- Botones en columna -->
            <div class="d-flex flex-column gap-2">
                <!-- Dropdown Dosier -->
                <div class="dropdown">
                    <button class="btn btn-primary dropdown-toggle w-100 text-start" type="button" id="dropdownMenuButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Dosier
                    </button>
                    <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="dropdownMenuButton1">
                        <li><a class="dropdown-item" href="../maestros/documentos/pdf_dosier.php?id_trabajador=${t.id_trabajador}">Dosier Trasmapi</a></li>
                        <li><a class="dropdown-item" href="../maestros/documentos/pdf_infoprl_mediterranea.php?id_trabajador=${t.id_trabajador}">Dosier Mediterranea</a></li>
                        <li><a class="dropdown-item" href="../maestros/documentos/pdf_infoprl_discover.php?id_trabajador=${t.id_trabajador}">Dosier Discover</a></li>
                    </ul>
                </div>

                <!-- Dropdown EPIs -->
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle w-100 text-start" type="button" id="dropdownMenuButton2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Entrega EPIs
                    </button>
                    <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="dropdownMenuButton2">
                        <li><a class="dropdown-item" href="../maestros/documentos/pdf_epi_amarrador.php?id_trabajador=${t.id_trabajador}">Epis Amarrador</a></li>
                        <li><a class="dropdown-item" href="../maestros/documentos/pdf_epi_auxiliarpasaje.php?id_trabajador=${t.id_trabajador}">Epis Aux. Pasaje</a></li>
                        <li><a class="dropdown-item" href="../maestros/documentos/pdf_epi_capitan.php?id_trabajador=${t.id_trabajador}">Epis Capitán</a></li>
                        <li><a class="dropdown-item" href="../maestros/documentos/pdf_epi_jefemaquinas.php?id_trabajador=${t.id_trabajador}">Epis Jefe maq.</a></li>
                        <li><a class="dropdown-item" href="../maestros/documentos/pdf_epi_limpieza.php?id_trabajador=${t.id_trabajador}">Epis Limpieza</a></li>
                        <li><a class="dropdown-item" href="../maestros/documentos/pdf_epi_marinero.php?id_trabajador=${t.id_trabajador}">Epis Marinero</a></li>
                        <li><a class="dropdown-item" href="../maestros/documentos/pdf_epi_marineromaquinas.php?id_trabajador=${t.id_trabajador}">Epis Marinero maq.</a></li>
                        <li><a class="dropdown-item" href="../maestros/documentos/pdf_epi_oficialcarga-amarrador.php?id_trabajador=${t.id_trabajador}">Epis Of. carga</a></li>
                        <li><a class="dropdown-item" href="../maestros/documentos/pdf_epi_primeroficial.php?id_trabajador=${t.id_trabajador}">Epis Primer of.</a></li>
                        <li><a class="dropdown-item" href="../maestros/documentos/pdf_epi_taller.php?id_trabajador=${t.id_trabajador}">Epis Taller</a></li>
                    </ul>
                </div>
                
                    <button class="btn btn-primary btn-sm" 
                        onclick="abrirModalEntregaInfo(${t.id_trabajador}, '${t.nombre_tr}')"
                        title="Registrar entrega">
                        <i class="bi bi-file-earmark-check"></i> Entrega Info
                    </button>

                <!-- Botón Modal -->
                <a href="javascript:void(0);" class="btn btn-success w-100 text-start"
                onclick="abrirModalAutorizacion(${t.id_trabajador})"
                title="Autorización equipos">
                Autorización equipos
                </a>

                 <a href="../formacion/create.php" class="btn btn-warning w-100 text-start" title="Nueva formación"
                   > Nueva Formación
                </a>

                <a href="javascript:void(0);" class="btn btn-danger w-100 text-start" title="Eliminar trabajador" onclick="eliminarTrabajador(${t.id_trabajador})">
                 Eliminar
                </a>

                            </div>
                        </div>
                    </div>
                </td>

                            </tr>`;

                                $tr.after(detailsHtml);

                                // Inicializar tooltips
                                $('[data-bs-toggle="tooltip"]').tooltip();
                            } else {
                                alert('Error: ' + (response.message || 'Respuesta inválida del servidor'));
                            }
                        },
                        error: function(xhr, status, error) {
                            $icon.removeClass('bi-arrow-clockwise spinner').addClass('bi-plus-circle');
                            alert('Error en la solicitud: ' + error);
                            console.error('Error AJAX:', status, error);
                        }
                    });
                }
            });

            // Manejadores específicos para cada pestaña
            $(document).on('click', '.nav-link[data-bs-target^="#formacion-"]', function() {
                const tabId = $(this).data('bs-target');
                const id_trabajador = tabId.split('-')[1];
                loadFormacionContent(id_trabajador);
            });

            $(document).on('shown.bs.tab', '.nav-link[data-bs-target^="#info-prl-"]', function() {
                const tabId = $(this).data('bs-target');
                const id_trabajador = tabId.split('-')[2]; // Cambiado a [2] porque el formato es #info-prl-123
                loadPrlContent(id_trabajador, tabId);
            });

            $(document).on('shown.bs.tab', '.nav-link[data-bs-target^="#reconocimiento-"]', function() {
                const tabId = $(this).data('bs-target');
                const id_trabajador = tabId.split('-')[1];
                console.log('Cargando reconocimientos para:', id_trabajador, 'Tab:', tabId); // Para depuración
                loadReconocimientosContent(id_trabajador, tabId);
            });



            function loadFormacionContent(id_trabajador) {
                const tabId = `#formacion-${id_trabajador}`;

                // Solo cargar si no hay contenido aún (evitar recargas innecesarias)
                if ($(tabId).html().trim().includes('spinner-border')) {
                    $.ajax({
                        url: 'detalles_formacion.php',
                        method: 'POST',
                        data: {
                            id_trabajador: id_trabajador
                        },
                        beforeSend: function() {
                            $(tabId).html('<div class="text-center"><div class="spinner-border text-primary" role="status"></div></div>');
                        },
                        success: function(response) {
                            $(tabId).html(response);
                        },
                        error: function(xhr) {
                            const errorMsg = xhr.responseText || 'Error desconocido';
                            $(tabId).html(`<div class="alert alert-danger">Error al cargar formaciones:<br>${errorMsg}</div>`);
                            console.error('Error carga formación:', xhr.status, errorMsg);
                        }
                    });
                }
            }

            function loadPrlContent(id_trabajador, tabId) {
                const $tab = $(tabId);

                // Verificar si ya hay contenido cargado (excepto spinner)
                if ($tab.html().trim().includes('spinner-border') || $tab.find('table').length === 0) {
                    $.ajax({
                        url: 'detalles_infoprl.php',
                        method: 'POST',
                        data: {
                            id_trabajador: id_trabajador
                        },
                        dataType: 'html',
                        beforeSend: function() {
                            $tab.html('<div class="text-center"><div class="spinner-border text-primary" role="status"></div></div>');
                        },
                        success: function(response) {
                            $tab.html(response);
                            // Inicializar tooltips después de cargar el contenido
                            $tab.find('[data-bs-toggle="tooltip"]').tooltip();
                        },
                        error: function(xhr, status, error) {
                            let errorMsg = 'Error al cargar información PRL';
                            if (xhr.responseText) {
                                try {
                                    const jsonResponse = JSON.parse(xhr.responseText);
                                    errorMsg = jsonResponse.error || errorMsg;
                                } catch (e) {
                                    errorMsg = xhr.responseText;
                                }
                            }
                            $tab.html(`<div class="alert alert-danger">${errorMsg}</div>`);
                            console.error('Error loading PRL info:', status, error);
                        }
                    });
                }
            }

            function loadReconocimientosContent(id_trabajador, tabId) {
                const $tab = $(tabId);

                console.log('Contenido actual:', $tab.html()); // Para depuración

                if ($tab.html().trim().includes('spinner-border') || $tab.find('table').length === 0) {
                    console.log('Cargando contenido de reconocimientos...'); // Para depuración
                    $.ajax({
                        url: 'detalles_reconocimiento.php',
                        method: 'POST',
                        data: {
                            id_trabajador: id_trabajador
                        },
                        beforeSend: function() {
                            $tab.html('<div class="text-center"><div class="spinner-border text-primary" role="status"></div></div>');
                        },
                        success: function(response) {
                            console.log('Respuesta recibida:', response); // Para depuración
                            $tab.html(response);
                            // Inicializar tooltips después de cargar el contenido
                            $tab.find('[data-bs-toggle="tooltip"]').tooltip();
                        },
                        error: function(xhr, status, error) {
                            console.error('Error en AJAX:', status, error, xhr.responseText); // Para depuración
                            let errorMsg = 'Error al cargar reconocimientos';
                            if (xhr.responseText) {
                                try {
                                    const jsonResponse = JSON.parse(xhr.responseText);
                                    errorMsg = jsonResponse.error || errorMsg;
                                } catch (e) {
                                    errorMsg = xhr.responseText;
                                }
                            }
                            $tab.html(`<div class="alert alert-danger">${errorMsg}</div>`);
                        }
                    });
                }
            }
        });
        /////////////////////// eventos para modal de agregar y editar trabajador///////////////////////

        // ✅ Evento delegado para seleccionar tipo de formaciones que debe tener el trabajador
        document.getElementById("selectAllFormaciones").addEventListener("click", function() {
            let checkboxes = document.querySelectorAll("input[name='formaciones[]']");
            checkboxes.forEach(checkbox => checkbox.checked = this.checked);
        });

        // ✅ Evento delegado para seleccionar la informacion en prl que debe tener el trabajador
        document.getElementById("selectAllInfoPRL").addEventListener("click", function() {
            let checkboxes = document.querySelectorAll("input[name='info_prl[]']");
            checkboxes.forEach(checkbox => checkbox.checked = this.checked);
        });

        document.getElementById("formAgregar").addEventListener("submit", function(event) {
            event.preventDefault();

            let formData = new FormData(this);

            fetch("../../app/controllers/trabajadores/guardar_trabajador.php", {
                    method: "POST",
                    body: formData
                })
                .then(response => {
                    // Check if the response is OK and is JSON
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }

                    // Try to parse as JSON
                    return response.json();
                })
                .then(data => {
                    if (data.status === "success") {
                        alert("✅ " + data.message);
                        document.getElementById("formAgregar").reset();
                        var modal = new bootstrap.Modal(document.getElementById('modalAgregar'));
                        modal.hide();
                        location.reload();
                    } else {
                        alert("❌ " + data.message);
                    }
                })
                .catch(error => {
                    console.error('Full error:', error);

                    // If it's a JSON parsing error, log the response text
                    if (error instanceof SyntaxError) {
                        fetch("../../app/controllers/trabajadores/guardar_trabajador.php", {
                                method: "POST",
                                body: formData
                            })
                            .then(response => response.text())
                            .then(text => {
                                console.error('Response text:', text);
                                alert("Error de formato: " + text);
                            });
                    } else {
                        alert("❌ Error en la solicitud: " + error.message);
                    }
                });
        });

        // Función para cargar empresas en el select
        function cargarEmpresas(empresas, empresaSeleccionada) {
            const $select = $('#modalEditar select[name="empresa_cen"]');
            $select.empty().append('<option value="">Seleccione una empresa</option>');

            empresas.forEach(empresa => {
                const selected = empresa.id_empresa == empresaSeleccionada ? 'selected' : '';
                $select.append(`<option value="${empresa.id_empresa}" ${selected}>${empresa.nombre_emp}</option>`);
            });
        }

        $(document).ready(function() {
            $('#empresa_cen').change(function() {
                var empresa_id = $(this).val(); // Obtener el ID de la empresa seleccionada

                if (empresa_id != '') {
                    $.ajax({
                        url: '../../app/controllers/maestros/centros/get_centros.php', // Archivo PHP que procesará la solicitud
                        type: 'POST',
                        data: {
                            empresa_id: empresa_id
                        },
                        success: function(response) {
                            $('#centro_cen').html(response); // Rellenar el select de centros
                        }
                    });
                } else {
                    $('#centro_cen').html('<option value="">Seleccione una empresa primero</option>');
                }
            });
        });



        // Función para cargar centros
        function cargarCentros(centros, centroSeleccionado) {
            const $select = $('#modalEditar select[name="centro_tr"]');
            $select.empty().append('<option value="">Seleccione un centro</option>');

            if (Array.isArray(centros)) {
                centros.forEach(centro => {
                    const selected = centro.id_centro == centroSeleccionado ? 'selected' : '';
                    // Usa nombre_cen que es el nombre del campo en la consulta SQL
                    $select.append(`<option value="${centro.id_centro}" ${selected}>${centro.nombre_cen}</option>`);
                });
            } else {
                console.error('Centros no es un array válido:', centros);
                $select.append('<option value="">Error al cargar centros</option>');
            }
        }



        // Función para cargar categorías
        function cargarCategorias(categorias, categoriaSeleccionada) {
            const $select = $('#modalEditar select[name="categoria_tr"]');
            $select.empty().append('<option value="">Seleccione una categoría</option>');

            categorias.forEach(categoria => {
                const selected = categoria.id_categoria == categoriaSeleccionada ? 'selected' : '';
                $select.append(`<option value="${categoria.id_categoria}" ${selected}>${categoria.nombre_cat}</option>`);
            });
        }

        ////// FUNCIONES PARA EDITAR DATOS TRABAJADOR////

        // Evento para cargar los datos del trabajador al abrir el modal de edición
        $(document).on('click', '.btn-editar', function() {
            const id_trabajador = $(this).data('id');
            cargarDatosTrabajador(id_trabajador);

            // Mostrar el modal (Bootstrap 5)
            const modal = new bootstrap.Modal(document.getElementById('modalEditar'));
            modal.show();
        });



        // Función para cargar las formaciones del trabajador
        function cargarDatosTrabajador(id_trabajador) {
            $.ajax({
                url: '../../app/controllers/trabajadores/obtener_trabajador.php',
                method: 'POST',
                data: {
                    id_trabajador: id_trabajador
                },
                dataType: 'json',
                beforeSend: function() {
                    $('#modalEditar .modal-body').prepend(
                        '<div id="loading" class="text-center">' +
                        '<div class="spinner-border text-warning" role="status"></div>' +
                        '</div>'
                    );
                },
                success: function(data) {
                    if (data.status === 'success') {
                        const trabajador = data.trabajador;

                        // Llenado de campos básicos
                        $('#id_trabajador').val(trabajador.id_trabajador);
                        $('#codigo_tr').val(trabajador.codigo_tr);
                        $('#dni_tr').val(trabajador.dni_tr);
                        $('#nombre_tr').val(trabajador.nombre_tr);

                        // Selección de sexo
                        $(`input[name="sexo_tr"][value="${trabajador.sexo_tr}"]`).prop('checked', true);

                        // Fechas
                        $('#fechanac_tr').val(trabajador.fechanac_tr);
                        $('#inicio_tr').val(trabajador.inicio_tr);

                        // Estado PRL
                        $(`input[name="formacionpdt_tr"][value="${trabajador.formacionpdt_tr}"]`).prop('checked', true);
                        $(`input[name="informacion_tr"][value="${trabajador.informacion_tr}"]`).prop('checked', true);

                        // Empresa y Centros (con manejo de errores)
                        $('#empresa_edit').val(trabajador.id_empresa || '');
                        cargarCentrosPorEmpresa(trabajador.id_empresa, trabajador.centro_tr);

                        // Categoría
                        $('#categoria_tr').val(trabajador.categoria_tr || '0');

                        // Anotaciones
                        $('#anotaciones_tr').text(trabajador.anotaciones_tr); // Usamos text() por seguridad

                        // Carga de relaciones
                        Promise.all([
                            cargarFormaciones(trabajador.id_trabajador),
                            cargarInformacionPRL(trabajador.id_trabajador)
                        ]).finally(() => $('#loading').remove());

                    } else {
                        mostrarError(data.message);
                        $('#loading').remove();
                    }
                },
                error: function(xhr, status, error) {
                    mostrarError(`Error de conexión: ${error}`);
                    $('#loading').remove();
                }
            });
        }

        // Función auxiliar para cargar centros
        function cargarCentrosPorEmpresa(empresa_id, centro_seleccionado) {
            if (!empresa_id) {
                $('#centro_edit').html('<option value="">Seleccione empresa primero</option>');
                return;
            }

            $.ajax({
                url: '../../app/controllers/maestros/centros/get_centros.php',
                method: 'POST',
                data: {
                    empresa_id: empresa_id
                },
                success: function(response) {
                    $('#centro_edit').html(response);
                    $('#centro_edit').val(centro_seleccionado);
                },
                error: function() {
                    $('#centro_edit').html('<option value="">Error cargando centros</option>');
                    mostrarError('No se pudieron cargar los centros');
                }
            });
        }

        // Función mejorada para mostrar errores
        function mostrarError(mensaje) {
            Toastify({
                text: mensaje,
                duration: 3000,
                close: true,
                gravity: "top",
                position: "right",
                style: {
                    background: "#dc3545"
                }
            }).showToast();
        }

        // Función actualizada de notificación de éxito
        function mostrarMensajeExito(mensaje) {
            Toastify({
                text: mensaje,
                duration: 3000,
                close: true,
                gravity: "top",
                position: "right",
                style: {
                    background: "#28a745"
                }
            }).showToast();
        }


        function cerrarModal() {
            const modalElement = document.getElementById('modalEntregaInfo');
            const modal = bootstrap.Modal.getInstance(modalElement);
            if (modal) {
                modal.hide();
            } else {
                // Si no hay instancia, crear una temporal
                new bootstrap.Modal(modalElement).hide();
            }
            document.getElementById('formEntregaInfo').reset();
        }

        // Función para cargar la información PRL del trabajador
        function cargarInformacionPRL(id_trabajador) {
            $.ajax({
                url: '../../app/controllers/trabajadores/obtener_infoprl.php',
                method: 'POST',
                data: {
                    id_trabajador: id_trabajador
                },
                dataType: 'json',
                success: function(data) {
                    console.log(data); // <- Ver que viene bien

                    if (data.status === 'success' && Array.isArray(data.info_todas)) {
                        $('#info-prl-container').empty();

                        data.info_todas.forEach(function(info) {
                            const isChecked = Array.isArray(data.info_trabajador) ?
                                data.info_trabajador.some(i => i.id_infodoc == info.id_infodoc) :
                                false;

                            const checkedAttr = isChecked ? 'checked' : '';

                            const infoHTML = `
                        <div class="col">
                            <div class="card hover-effect shadow-sm border-1 mb-1" style="font-size: 0.9rem; cursor: pointer;" 
                                 onclick="document.getElementById('info_edit_${info.id_infodoc}').click();">
                                <div class="card-body p-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="info_prl[]" 
                                               value="${info.id_infodoc}" id="info_edit_${info.id_infodoc}" 
                                               ${checkedAttr} onclick="event.stopPropagation();">
                                        <label class="form-check-label fw-semibold" for="info_edit_${info.id_infodoc}" 
                                               style="line-height: 1.2;">
                                            ${info.nombre_ifd}
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `;

                            $('#info-prl-container').append(infoHTML);
                        });
                    } else {
                        mostrarError('❌ Datos de PRL no válidos');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error al cargar información PRL:', error);
                    mostrarError('❌ Error en la carga de info PRL');
                }
            });
        }


        // Evento para cambio de empresa en el formulario de edición
        $('#empresa_edit').change(function() {
            var empresa_id = $(this).val();

            if (empresa_id != '') {
                $.ajax({
                    url: '../../app/controllers/maestros/centros/get_centros.php',
                    type: 'POST',
                    data: {
                        empresa_id: empresa_id
                    },
                    success: function(response) {
                        $('#centro_edit').html(response);
                    }
                });
            } else {
                $('#centro_edit').html('<option value="">Seleccione una empresa primero</option>');
            }
        });

        function cargarFormaciones(id_trabajador) {
            $.ajax({
                url: '../../app/controllers/trabajadores/obtener_formaciones.php',
                method: 'POST',
                data: {
                    id_trabajador: id_trabajador
                },
                dataType: 'json',
                success: function(data) {
                    if (data.status === 'success') {
                        // Asume que tienes un contenedor con ID formaciones-container
                        $('#formaciones-container').empty();

                        data.formaciones.forEach(function(formacion) {
                            const isChecked = formacion.completado === 'Si' ? 'checked' : '';
                            const formHTML = `
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="formaciones[]" 
                                   value="${formacion.id_formacion}" id="form_${formacion.id_formacion}" ${isChecked}>
                            <label class="form-check-label" for="form_${formacion.id_formacion}">
                                ${formacion.nombre_formacion}
                            </label>
                        </div>
                    `;
                            $('#formaciones-container').append(formHTML);
                        });
                    } else {
                        mostrarError('Error al cargar las formaciones: ' + data.message);
                    }
                },
                error: function(xhr, status, error) {
                    mostrarError('Error al conectar con el servidor de formaciones.');
                }
            });
        }

        // Evento para seleccionar/deseleccionar todas las formaciones
        $('#selectAllFormacionesEdit').click(function() {
            $('input[name="formaciones[]"]').prop('checked', this.checked);
        });

        // Evento para seleccionar/deseleccionar toda la información PRL
        $('#selectAllInfoPRLEdit').click(function() {
            $('input[name="info_prl[]"]').prop('checked', this.checked);
        });

        // Evento para enviar el formulario de edición
        $('#formEditar').submit(function(event) {
    event.preventDefault();

    // Crear un objeto FormData con los datos del formulario
    let formData = new FormData(this);
    
    // Asegurarse de que estos campos siempre estén presentes
    if (!formData.has('procesar_formaciones')) {
        formData.append('procesar_formaciones', '1');
    }
    
    if (!formData.has('procesar_info_prl')) {
        formData.append('procesar_info_prl', '1');
    }
    
    // Si no hay formaciones seleccionadas, asegurarse de que el campo existe para indicar que se procesó
    if (!formData.has('formaciones[]')) {
        // Añadimos un campo vacío para indicar que este array debe estar presente
        formData.append('formaciones_empty', '1');
    }
    
    // Si no hay información PRL seleccionada, asegurarse de que el campo existe para indicar que se procesó
    if (!formData.has('info_prl[]')) {
        // Añadimos un campo vacío para indicar que este array debe estar presente
        formData.append('info_prl_empty', '1');
    }

    // Enviar los datos al servidor
    fetch('../../app/controllers/trabajadores/actualizar_trabajador.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                alert('✅ ' + data.message);
                // Cerrar el modal
                var modal = new bootstrap.Modal(document.getElementById('modalEditar'));
                modal.hide();
                // Recargar la página para ver los cambios
                location.reload();
            } else {
                alert('❌ ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('❌ Error en la solicitud: ' + error.message);
        });
});

        ////funcion cargardocumentos entrega info prl///
        // Función para cargar documentos via AJAX
        async function cargarDocumentos() {
            try {
                const response = await fetch('../../app/controllers/maestros/documentos/listado_infoprldoc.php');
                const documentos = await response.json();

                const select = document.getElementById('selectDocumentos');
                select.innerHTML = '<option value="" disabled selected>Seleccionar documento...</option>';

                documentos.forEach(doc => {
                    const option = document.createElement('option');
                    option.value = doc.id_infodoc;
                    option.textContent = `${doc.tipoinfo_ifd} - ${doc.nombre_ifd}`;
                    select.appendChild(option);
                });

            } catch (error) {
                console.error('Error cargando documentos:', error);
                select.innerHTML = '<option value="" disabled>Error al cargar documentos</option>';
            }
        }

        // Modificar función para abrir el modal
        function abrirModalEntregaInfo(idTrabajador, nombreTrabajador) {
            document.getElementById('idTrabajador').value = idTrabajador;
            document.getElementById('nombreTrabajador').value = nombreTrabajador;

            // Resetear select y cargar documentos
            const select = document.getElementById('selectDocumentos');
            select.innerHTML = '<option value="" disabled selected>Cargando documentos...</option>';
            cargarDocumentos();

            new bootstrap.Modal(document.getElementById('modalEntregaInfo')).show();
        }


        ////// FUNCIONES PARA ELIMINAR TRABAJADOR////

        function eliminarTrabajador(id_trabajador) {
            if (!confirm("¿Estás seguro de que deseas eliminar este trabajador?")) return;

            fetch('../../app/controllers/trabajadores/eliminar_trabajador.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    body: `id_trabajador=${encodeURIComponent(id_trabajador)}`
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        alert(data.message);
                        // Puedes recargar la tabla o la página:
                        location.reload();
                    } else {
                        alert("❌ " + data.message);
                    }
                })
                .catch(error => {
                    console.error('Error en la solicitud:', error);
                    alert("❌ Error al intentar eliminar el trabajador.");
                });
        }

        //// funcion para entrega info prl///
        document.getElementById('formEntregaInfo').addEventListener('submit', function(e) {
            e.preventDefault();
            const botonGuardar = e.target.querySelector('button[type="submit"]');
            botonGuardar.disabled = true; // Deshabilitar botón durante el envío

            fetch('../../app/controllers/trabajadores/create_entregainfo.php', {
                    method: 'POST',
                    body: new FormData(this)
                })
                .then(response => {
                    botonGuardar.disabled = false;
                    if (!response.ok) throw new Error(`Error HTTP: ${response.status}`);
                    return response.json();
                })
                .then(data => {
                    if (data.success) {
                        mostrarMensajeExito(data.message);
                        cerrarModal();
                        // Actualizar tabla dinámicamente aquí si es necesario
                    } else {
                        mostrarError(data.error || "Error desconocido");
                    }
                })
                .catch(error => {
                    botonGuardar.disabled = false;
                    mostrarError(`Error: ${error.message}`);
                });
        });
    </script>


    <script>
        ////// FUNCIONES PARA DATATABLES DE MODALES////
        $(document).ready(function() {
            $('#modal-table-caducada').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'excel', 'pdf', 'print'
                ],
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json'
                }
            });

            $('#modal-table').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'excel', 'pdf', 'print'
                ],
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json'
                }
            });
        });


        ////FUNCION FILTRAR MODAL////
        $(document).ready(function() {
            // Inicializar la tabla principal como DataTable
            let tablaPrincipal = $('#trabajadoresTable').DataTable();

            // Función para abrir el acordeón
            function abrirAcordeon(idTrabajador) {
                let $tr = $(`#trabajadoresTable tbody tr[data-id="${idTrabajador}"]`);
                if ($tr.length) {
                    $tr.find('td.details-control').trigger('click');
                }
            }

            // Manejador único para los botones de filtrado
            $(document).on('click', '.filtrar-trabajador', function() {
                let idTrabajador = $(this).data('id');
                let nombreTrabajador = $(this).data('nombre');
                let modalId = $(this).data('modal'); // Nuevo: identifica de dónde viene

                // Cerrar el modal correspondiente
                $(`#${modalId}`).modal('hide');
                $(`#${modalId}`).hide();
                $('.modal-backdrop').remove();
                $('body').removeClass('modal-open').css('padding-right', '');

                // Filtrar y abrir el acordeón
                setTimeout(function() {
                    tablaPrincipal.search('').columns().search('').draw();
                    tablaPrincipal.search(nombreTrabajador).draw();

                    setTimeout(function() {
                        abrirAcordeon(idTrabajador);
                    }, 500);
                }, 500);
            });
        });


        //// IMPRIMIR AUTORIZACION EQUIPOS///

        function abrirModalAutorizacion(idTrabajador) {
            // Establecer el valor en el input hidden
            $('#idTrabajadorInput').val(idTrabajador);

            // Mostrar el modal manualmente
            $('#modalAutorizacion').modal('show');
        }


        $(document).ready(function() {
            // Seleccionar todos
            $('#selectAll').change(function() {
                $('input[name="centros[]"]').prop('checked', this.checked);
            });

            // Botón de generar autorización
            $('#btnGenerar').click(function() {
                var centrosSeleccionados = $('input[name="centros[]"]:checked').map(function() {
                    return this.value;
                }).get();

                if (centrosSeleccionados.length === 0) {
                    alert('Debe seleccionar al menos un centro.');
                    return;
                }

                var idTrabajador = $('#idTrabajadorInput').val();
                var url = '../maestros/documentos/autorizacion_equipos2.php?id_trabajador=' + idTrabajador + '&centros=' + centrosSeleccionados.join(',');

                window.open(url, '_blank');
                $('#modalAutorizacion').modal('hide');
            });
        });
    </script>
    <script>
        // Reinicializa el menú lateral
        document.addEventListener('DOMContentLoaded', function() {
            $('[data-widget="treeview"]').Treeview('init');
        });
    </script>
</body>

</html>