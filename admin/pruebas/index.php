<?php
include('../../app/config.php');
include('../../admin/layout/parte1.php');
include('../../app/controllers/trabajadores/listado_trabajadores.php');
include('../../app/controllers/maestros/centros/listado_centros.php');
include('../../app/controllers/maestros/empresas/listado_empresas.php');
include('../../app/controllers/maestros/categorias/listado_categorias.php');
include('../../app/controllers/trabajadores/listado_tr_noformado.php');
include('../../app/controllers/trabajadores/listado_tr_formacioncaducada.php');

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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/2.0.2/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <style>
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
    .bg-soft-primary { background-color: rgba(13, 110, 253, 0.1); }
    .bg-soft-success { background-color: rgba(25, 135, 84, 0.1); }
    .bg-soft-info { background-color: rgba(13, 202, 240, 0.1); }
    .bg-soft-warning { background-color: rgba(255, 193, 7, 0.1); }
    .bg-soft-danger { background-color: rgba(220, 53, 69, 0.1); }
    .bg-soft-dark { background-color: rgba(33, 37, 41, 0.1); }
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
                        <span class="text-muted small">Embarcados</span>
                    </div>
                    <h4 class="mb-0 mt-2">
                        <?= count(array_filter($trabajadores, fn($t) => $t['nombre_tc'] == 'Embarcacion' && $t['activo_tr'] == 1)) ?>
                    </h4>
                    <small class="text-muted">En nave</small>
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
                        <span class="text-muted small">Pendientes</span>
                    </div>
                    <h4 class="mb-0 mt-2">
                        <?= count(array_filter($trabajadores, fn($t) => $t['activo_tr'] == 1 && $t['formacionpdt_tr'] == 'No')) ?>
                    </h4>
                    <small class="text-muted">Formar</small>
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
                        <span class="text-muted small">Formaciones</span>
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
                        <div class="modal-header" style="background-color:#138fec; color:black">
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
                                        <th style="text-align: left">-</th>
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
                                                <a href="../../admin/trabajadores/trabajadorshow.php?id_trabajador=<?php echo $trabajador_formacioncaducada['id_trabajador']; ?>" class="btn btn-primary btn-sm" title="Ver detalles">Ver</a>
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
                        <div class="modal-header" style="background-color:#138fec ;color:black">
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
                                        <th style="text-align: left">-</th>
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
                                                <a href="../../admin/trabajadores/trabajadorshow.php?id_trabajador=<?php echo $trabajador_noformados['id_trabajador']; ?>" class="btn btn-primary btn-sm" title="Ver detalles">Ver</a>
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
                                        <th style="width: 5%;">Estado</th>
                                        <th style="width: 15%;">Nombre</th>
                                        <th style="width: 10%;">DNI</th>
                                        <th style="width: 30%;">Categoría</th>
                                        <th style="width: 30%;">Centro Tº</th>
                                        <th style="width: 5%;">% fORM.</th>
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
                                                <?php $sql = "SELECT COUNT(*) AS count_puesto
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
                                                    <span class='badge badge-danger' title="Trabajador sin formación">NF</span><?php
                                                                                                                            } ?>

                                            </td>
                                            <td><?= htmlspecialchars($trabajador['nombre_tr']) ?></td>
                                            <td><?= htmlspecialchars($trabajador['dni_tr']) ?></td>
                                            <td><?= htmlspecialchars($trabajador['nombre_cat']) ?></td>
                                            <td><?= htmlspecialchars($trabajador['nombre_cen']) ?></td>
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
        <!-- Modal de edición -->
        <div class="modal fade" id="modalEditar" tabindex="-1" aria-labelledby="modalEditarLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header" style="background-color:#ffd900; color:black;">
                        <h5 class="modal-title" id="modalEditarLabel">Editar Trabajador</h5>
                        <button type="button" class="btn-close" style="color: black;" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="formEditar">
                            <!-- Campo oculto para el ID del trabajador - AÑADIDO AQUÍ -->
                            <input type="hidden" name="id_trabajador" id="id_trabajador">

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

                            <!-- Elimina todo el código de pestañas y reemplázalo con esto: -->

                            <div class="container mt-4">
                                <!-- Nav Tabs -->
                                <ul class="nav nav-tabs" id="myTabs" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link active" id="formaciones-tab" data-bs-toggle="tab" data-bs-target="#formaciones" type="button" role="tab" aria-controls="formaciones" aria-selected="true">
                                            <i class="bi bi-mortarboard"></i> Formaciones
                                        </button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="infoPRL-tab" data-bs-toggle="tab" data-bs-target="#infoPRL" type="button" role="tab" aria-controls="infoPRL" aria-selected="false">
                                            <i class="bi bi-file-earmark-text"></i> Información PRL
                                        </button>
                                    </li>
                                </ul>

                                <!-- Tab Content -->
                                <div class="tab-content mt-3">
                                    <!-- Formaciones Tab -->
                                    <div class="tab-pane fade show active" id="formaciones" role="tabpanel" aria-labelledby="formaciones-tab">
                                        <div class="mb-4">
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <h5 class="text-primary"><i class="bi bi-mortarboard"></i> Formaciones a Realizar</h5>
                                            </div>
                                            <div class="row row-cols-2 row-cols-md-3 g-2" id="formacionesList">
                                                <div class="col">
                                                    <div class="card p-3">
                                                        <p>Ejemplo de Formación 1</p>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="card p-3">
                                                        <p>Ejemplo de Formación 2</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Información PRL Tab -->
                                    <div class="tab-pane fade" id="infoPRL" role="tabpanel" aria-labelledby="infoPRL-tab">
                                        <div class="mb-4">
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <h5 class="text-primary"><i class="bi bi-file-earmark-text"></i> Información PRL a Entregar</h5>
                                            </div>
                                            <div class="row row-cols-2 row-cols-md-3 g-2" id="infoPRLList">
                                                <div class="col">
                                                    <div class="card p-3">
                                                        <p>Ejemplo de Información PRL 1</p>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="card p-3">
                                                        <p>Ejemplo de Información PRL 2</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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
    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/2.0.2/js/dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/2.0.2/js/dataTables.bootstrap5.min.js"></script>
    <script>
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

        $(document).ready(function() {
            // Debug: Mostrar datos de trabajadores en consola
            console.log("Trabajadores:", <?= json_encode($trabajadores) ?>);

            // Función para formatear los detalles del trabajador
            function formatDetalles(trabajador) {
                console.log("Datos REALES del trabajador:", trabajador);

                // Generar HTML para las formaciones
                let formacionesHTML = '';

                // Accedemos directamente a trabajador.formaciones (no a trabajador.formaciones.trabajador)
                if (trabajador.formaciones && trabajador.formaciones.length > 0) {
                    formacionesHTML += `
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Formación</th>
                        <th>Estado</th>
                    </tr>
                </thead>
                <tbody>`;

                    trabajador.formaciones.forEach(formacion => {
                        formacionesHTML += `
                <tr>
                    <td>${formacion.nombre_tf}</td>
                    <td>${formatEstado(formacion.estado)}</td>
                </tr>`;
                    });

                    formacionesHTML += `</tbody></table>`;
                } else {
                    formacionesHTML = '<p>No hay formaciones asignadas</p>';
                }

                // Generar HTML para la información PRL
                let infoPRLHTML = '';
                if (trabajador.info_prl_detalles && trabajador.info_prl_detalles.length > 0) {
                    trabajador.info_prl_detalles.forEach(info => {
                        infoPRLHTML += `
                <div class="col">
                    <div class="card bg-light mb-2">
                        <div class="card-body p-2">
                            <small>${info.nombre_ifd}</small>
                        </div>
                    </div>
                </div>`;
                    });
                } else {
                    infoPRLHTML = '<div class="col-12"><p class="text-muted">No hay información PRL asignada</p></div>';
                }

                // Función para formatear el estado
                function formatEstado(estado) {
                    console.log("Valor de estado recibido:", estado); // Para depuración

                    if (estado === undefined || estado === null) {
                        return '<span class="badge bg-secondary">N/A</span>';
                    }

                    // Convertir a string y limpiar
                    const estadoStr = String(estado).trim().toLowerCase();

                    if (estadoStr === 'completado') {
                        return '<span class="badge bg-success">Completado</span>';
                    } else if (estadoStr === 'pendiente') {
                        return '<span class="badge bg-warning">Pendiente</span>';
                    }

                    // Si no coincide, mostrar el valor original para depuración
                    return `<span class="badge bg-info">${estado} (?)</span>`;
                }
                // El resto de tu código para generar la tarjeta del trabajador...
                return `
        <div class="card">
            <div class="card-body">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#info-${trabajador.id_trabajador}" type="button">
                            Información Personal
                        </button>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link formacion-tab" data-id="${trabajador.id_trabajador}" data-bs-toggle="tab" data-bs-target="#formacion-${trabajador.id_trabajador}" type="button">
                            Formación
                        </button>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link info-prl-tab" data-id="${trabajador.id_trabajador}" data-bs-toggle="tab" data-bs-target="#info-prl-${trabajador.id_trabajador}" type="button">
                            Info PRL
                        </button>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link reconocimiento-tab" data-id="${trabajador.id_trabajador}" data-bs-toggle="tab" data-bs-target="#reconocimiento-${trabajador.id_trabajador}" type="button">
                            Reconocimientos
                        </button>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link accidente-tab" data-id="${trabajador.id_trabajador}" data-bs-toggle="tab" data-bs-target="#accidente-${trabajador.id_trabajador}" type="button">
                            Accidentes
                        </button>
                    </li> 
                </ul>
                <div class="tab-content mt-2">
                    <div id="info-${trabajador.id_trabajador}" class="tab-pane fade show active">
                        <div class="row">
                      
                            <div class="col-md-2">
                                <p><strong>Sexo:</strong> ${trabajador.sexo_tr}</p>
                                <p><strong>Fecha Nacimiento:</strong> ${trabajador.fechanac_tr}</p>
                                <p><strong>Fecha Inicio:</strong> ${trabajador.inicio_tr}</p>
                            </div>
                            <div class="col-md-2">
                                <p><strong>Departamento:</strong> ${trabajador.nombre_dpo}</p>
                                <p><strong>Centro:</strong> ${trabajador.nombre_cen}</p>
                                <p><strong>Empresa:</strong> ${trabajador.nombre_emp}</p>
                                
                            </div>
                            
                            <div class="col-md-7">
                                <div class="row">
                                    <!-- Formaciones asignadas -->
                                    <div class="col-md-6">
                                        <h6 class="text-primary"><i class="bi bi-mortarboard"></i> Formaciones Asignadas - cumplimiento: 
                                        <?php
                                        // Consulta para obtener el número de formaciones completadas y el total
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
                                        ?>


                                        <?php echo "$completadas / $total_formaciones"; ?>
                                        </h6>
                                        <div class="row row-cols-1 row-cols-md-1 g-1" id="formacionesDetallesList-${trabajador.id_trabajador}">
                                            ${formacionesHTML}
                                        </div>
                                    </div>
                                    <!-- Información PRL -->
                                    <div class="col-md-6">
                                        <h6 class="text-primary"><i class="bi bi-info-circle"></i> Información PRL</h6>
                                        <div class="row row-cols-1 row-cols-md-1 g-1" id="infoPRLDetallesList-${trabajador.id_trabajador}">
                                            ${infoPRLHTML}
                                        </div>
                                    </div>
                                </div>
                            </div>
                              <div class="col-md-1">
                                <button class="btn btn-warning btn-sm" onclick="cargarDatosTrabajador(${trabajador.id_trabajador})">
                                    <i class="bi bi-pencil-square"></i> Editar
                                </button> 
                            </div>
                        </div>
                        
                    </div>
                    <div id="formacion-${trabajador.id_trabajador}" class="tab-pane fade">
                        <div class="text-center">
                            <div class="spinner-border text-primary" role="status">
                                <span class="visually-hidden">Cargando...</span>
                            </div>
                        </div>
                    </div>
                    <div id="info-prl-${trabajador.id_trabajador}" class="tab-pane fade">
                        <div class="text-center">
                            <div class="spinner-border text-primary" role="status">
                                <span class="visually-hidden">Cargando...</span>
                            </div>
                        </div>
                    </div>
                    <div id="reconocimiento-${trabajador.id_trabajador}" class="tab-pane fade">
                        <div class="text-center">
                            <div class="spinner-border text-primary" role="status">
                                <span class="visually-hidden">Cargando...</span>
                            </div>
                        </div>
                    </div>
                    <div id="accidente-${trabajador.id_trabajador}" class="tab-pane fade">
                        <div class="text-center">
                            <div class="spinner-border text-primary" role="status">
                                <span class="visually-hidden">Cargando...</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    `;
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

            // Evento para mostrar/ocultar detalles
            $('#trabajadoresTable tbody').on('click', 'td.details-control', function() {
                const tr = $(this).closest('tr');
                const row = table.row(tr);
                const trabajadorId = tr.data('id');

                if (row.child.isShown()) {
                    row.child.hide();
                    tr.find('.bi').removeClass('bi-dash-circle').addClass('bi-plus-circle');
                } else {
                    const trabajador = <?= json_encode($trabajadores) ?>.find(t => t.id_trabajador == trabajadorId);
                    if (trabajador) {
                        row.child(formatDetalles(trabajador)).show();
                        tr.find('.bi').removeClass('bi-plus-circle').addClass('bi-dash-circle');
                    }
                }
            });
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

                fetch("../../app/controllers/pruebas/guardar_trabajador.php", {
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
                            fetch("../../app/controllers/pruebas/guardar_trabajador.php", {
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


            // ✅ Evento delegado para cargar formación dinámicamente
            $(document).on('click', '.formacion-tab', function() {
                const trabajadorId = $(this).data('id');
                const formacionContainer = $(`#formacion-${trabajadorId}`);

                console.log(`📌 Clic en pestaña "Formación" para trabajador ID: ${trabajadorId}`);

                if (formacionContainer.attr('data-loaded') !== 'true') {
                    console.log(`🔄 Cargando formaciones para trabajador ID: ${trabajadorId}`);
                    console.log(`🌍 URL: ../pruebas/trabajador_formacion.php?id_trabajador=${trabajadorId}`);

                    fetch(`../pruebas/trabajador_formacion.php?id_trabajador=${trabajadorId}`)
                        .then(response => {
                            console.log(`✅ Respuesta recibida: ${response.status}`);
                            return response.text();
                        })
                        .then(html => {
                            console.log(`📄 HTML recibido para trabajador ID ${trabajadorId}:`, html);
                            formacionContainer.html(html);
                            formacionContainer.attr('data-loaded', 'true');
                        })
                        .catch(error => {
                            console.error(`❌ Error al cargar formaciones para trabajador ID ${trabajadorId}:`, error);
                            formacionContainer.html(`
                            <div class="alert alert-danger">
                                Error al cargar la formación: ${error.message}
                            </div>
                        `);
                        });
                } else {
                    console.log(`⚠️ Formación ya cargada para trabajador ID: ${trabajadorId}`);
                }
            });
            // Cargar Info PRL al hacer clic
            // ✅ Evento delegado para cargar Info PRL dinámicamente
            $(document).on('click', '.info-prl-tab', function() {
                const trabajadorId = $(this).data('id');
                const prlContainer = $(`#info-prl-${trabajadorId}`);

                console.log(`📌 Clic en pestaña "Info PRL" para trabajador ID: ${trabajadorId}`);

                if (prlContainer.attr('data-loaded') !== 'true') {
                    console.log(`🔄 Cargando Info PRL para trabajador ID: ${trabajadorId}`);
                    console.log(`🌍 URL: ../pruebas/trabajador_informacion.php?id_trabajador=${trabajadorId}`);

                    fetch(`../pruebas/trabajador_informacion.php?id_trabajador=${trabajadorId}`)
                        .then(response => {
                            console.log(`✅ Respuesta recibida: ${response.status}`);
                            return response.text();
                        })
                        .then(html => {
                            console.log(`📄 HTML recibido para trabajador ID ${trabajadorId}:`, html);
                            prlContainer.html(html);
                            prlContainer.attr('data-loaded', 'true');
                        })
                        .catch(error => {
                            console.error(`❌ Error al cargar Info PRL para trabajador ID ${trabajadorId}:`, error);
                            prlContainer.html(`
                            <div class="alert alert-danger">
                                Error al cargar la información PRL: ${error.message}
                            </div>
                        `);
                        });
                } else {
                    console.log(`⚠️ Info PRL ya cargada para trabajador ID: ${trabajadorId}`);
                }
            });
            // ✅ Cargar datos de Reconocimientos
            $(document).on('click', '.reconocimiento-tab', function() {
                const trabajadorId = $(this).data('id');
                const container = $(`#reconocimiento-${trabajadorId}`);

                if (!container.attr('data-loaded')) {
                    fetch(`../pruebas/trabajador_reconocimiento.php?id_trabajador=${trabajadorId}`)
                        .then(response => response.text())
                        .then(html => {
                            container.html(html);
                            container.attr('data-loaded', 'true');
                        });
                }
            });
            // Cargar Accidentes al hacer clic
            $(document).on('click', '.accidente-tab', function() {
                const trabajadorId = $(this).data('id');
                const accidenteContainer = $(`#accidente-${trabajadorId}`);

                if (accidenteContainer.attr('data-loaded') !== 'true') {
                    console.log(`Cargando Accidentes para trabajador ${trabajadorId}`);
                    fetch(`../pruebas/trabajador_accidentes.php?id_trabajador=${trabajadorId}`)
                        .then(response => response.text())
                        .then(html => {
                            accidenteContainer.html(html);
                            accidenteContainer.attr('data-loaded', 'true');
                        })
                        .catch(error => {
                            console.error('Error al cargar Accidentes:', error);
                        });
                }
            });
        });

        document.getElementById("formEditar").addEventListener("submit", function(event) {
            event.preventDefault();

            let formData = new FormData(this);

            fetch("../../app/controllers/pruebas/actualizar_trabajador.php", {
                    method: "POST",
                    body: formData
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error("Error en la respuesta del servidor");
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.status === "success") {
                        alert("✅ " + data.message);
                        document.getElementById("formEditar").reset();
                        var modal = new bootstrap.Modal(document.getElementById('modalEditar'));
                        modal.hide();
                        location.reload();
                    } else {
                        alert("❌ " + data.message);
                    }
                })
                .catch(error => {
                    console.error("Error:", error);
                    alert("❌ Error en la solicitud: " + error.message);
                });
        });




        // cargar datos trabajador en modal para modificar
        function cargarDatosTrabajador(idTrabajador) {
            $.ajax({
                url: '../../app/controllers/pruebas/obtener_trabajador.php',
                type: 'POST',
                dataType: 'json',
                data: {
                    id_trabajador: idTrabajador
                },
                success: function(response) {
                    console.log('Datos recibidos:', {
                        formaciones: response.formaciones,
                        info_prl: response.info_prl
                    });

                    if (response.status === 'success') {
                        const trabajador = response.trabajador;
                        const formaciones = response.formaciones;
                        const infoPrl = response.info_prl;
                        const centros = response.centros;
                        const empresas = response.empresas;
                        const categorias = response.categorias;

                        // Cargar datos básicos del trabajador
                        $('#modalEditar #id_trabajador').val(trabajador.id_trabajador);
                        $('#modalEditar input[name="codigo_tr"]').val(trabajador.codigo_tr);
                        $('#modalEditar input[name="dni_tr"]').val(trabajador.dni_tr);
                        $('#modalEditar input[name="nombre_tr"]').val(trabajador.nombre_tr);
                        $('#modalEditar input[name="fechanac_tr"]').val(trabajador.fechanac_tr);
                        $('#modalEditar input[name="inicio_tr"]').val(trabajador.inicio_tr);
                        $('#modalEditar input[name="anotaciones_tr"]').val(trabajador.anotaciones_tr);
                        // Configuración de la empresa (ahora viene de la consulta)
                        $('#modalEditar #empresa_cen').val(trabajador.id_empresa);

                        // Configurar radios de sexo
                        $(`#modalEditar input[name="sexo_tr"][value="${trabajador.sexo_tr}"]`).prop('checked', true);

                        // Configurar radios de formación PRL
                        $(`#modalEditar input[name="formacionpdt_tr"][value="${trabajador.formacionpdt_tr}"]`).prop('checked', true);

                        // Configurar radios de información PRL
                        $(`#modalEditar input[name="informacion_tr"][value="${trabajador.informacion_tr}"]`).prop('checked', true);

                        // Cargar y seleccionar empresa
                        cargarEmpresas(empresas, trabajador.id_empresa);
                        $('#modalEditar select[name="empresa_cen"]').on('change', function() {
                            const idEmpresa = $(this).val();

                            if (idEmpresa) {
                                cargarCentrosPorEmpresa(idEmpresa);
                            } else {
                                // Limpiar centros si no hay empresa seleccionada
                                $('#modalEditar select[name="centro_tr"]').empty().append('<option value="">Seleccione un centro</option>');
                            }
                        });
                        // Cargar centros según la empresa
                        cargarCentros(centros, trabajador.centro_tr);

                        // Cargar categorías
                        cargarCategorias(categorias, trabajador.categoria_tr);

                        // Cargar formaciones (asegurando que va al contenedor correcto)
                        if (response.formaciones && response.formaciones.todas) {
                            cargarFormaciones(response.formaciones.todas, response.formaciones.trabajador);
                        } else {
                            console.error('Datos de formaciones faltantes:', response.formaciones);
                            $('#formacionesList').html('<div class="col-12"><div class="alert alert-warning">No se pudieron cargar las formaciones</div></div>');
                        }

                        // Cargar información PRL (asegurando que va al contenedor correcto)
                        if (response.info_prl && response.info_prl.todas) {
                            cargarInformacionPRL(response.info_prl.todas, response.info_prl.trabajador);
                        } else {
                            console.error('Datos de información PRL faltantes:', response.info_prl);
                            $('#infoPRLList').html('<div class="col-12"><div class="alert alert-warning">No se pudo cargar la información PRL</div></div>');
                        }
                        // Abrir modal
                        $('#modalEditar').modal('show');
                    } else {
                        alert('Error al obtener los datos del trabajador');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error en la solicitud:', error);
                    alert('Error al conectar con el servidor');
                }
            });
        }

        // Función para cargar empresas en el select
        function cargarEmpresas(empresas, empresaSeleccionada) {
            const $select = $('#modalEditar select[name="empresa_cen"]');
            $select.empty().append('<option value="">Seleccione una empresa</option>');

            empresas.forEach(empresa => {
                const selected = empresa.id_empresa == empresaSeleccionada ? 'selected' : '';
                $select.append(`<option value="${empresa.id_empresa}" ${selected}>${empresa.nombre_emp}</option>`);
            });
        }

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

        function cargarCentrosPorEmpresa(idEmpresa) {
            $.ajax({
                url: '../../app/controllers/pruebas/obtener_centros_por_empresa.php', // Nuevo endpoint
                type: 'POST',
                dataType: 'json',
                data: {
                    id_empresa: idEmpresa
                },
                success: function(response) {
                    if (response.status === 'success') {
                        // Limpiar y cargar centros (sin selección predeterminada)
                        const $selectCentros = $('#modalEditar select[name="centro_tr"]');
                        $selectCentros.empty().append('<option value="">Seleccione un centro</option>');

                        response.centros.forEach(centro => {
                            $selectCentros.append(`<option value="${centro.id_centro}">${centro.nombre_cen}</option>`);
                        });
                    } else {
                        console.error('Error al cargar centros:', response.message);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error AJAX:', error);
                }
            });
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

        // Función para cargar formaciones
        function cargarFormaciones(todasFormaciones, formacionesTrabajador) {
            const $container = $('#formacionesList');
            $container.empty();

            todasFormaciones.forEach(formacion => {
                const estaSeleccionada = formacionesTrabajador.some(f => f.id_tipoformacion == formacion.id_tipoformacion);
                const checked = estaSeleccionada ? 'checked' : '';

                $container.append(`
            <div class="col">
                <div class="card hover-effect shadow-sm border-1 mb-1" style="font-size: 0.9rem; cursor: pointer;">
                    <div class="card-body p-2">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" 
                                   name="formaciones[]" 
                                   value="${formacion.id_tipoformacion}" 
                                   id="formacion_${formacion.id_tipoformacion}" 
                                   ${checked}>
                            <label class="form-check-label fw-semibold" 
                                   for="formacion_${formacion.id_tipoformacion}" 
                                   style="line-height: 1.2;">
                                ${formacion.nombre_tf}
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        `);
            });
        }

        // Función para cargar información PRL
        function cargarInformacionPRL(todasInfoPRL, infoPRLTrabajador) {
            const $container = $('#infoPRLList');
            $container.empty();

            // Verificar y normalizar los datos de entrada
            if (!Array.isArray(todasInfoPRL)) {
                console.error('todasInfoPRL no es un array:', todasInfoPRL);
                return;
            }

            // Asegurarse que infoPRLTrabajador es un array de IDs
            const idsSeleccionados = Array.isArray(infoPRLTrabajador) ?
                infoPRLTrabajador.map(item => item.id_infodoc || item) : [];

            // Generar el HTML para cada documento PRL
            todasInfoPRL.forEach(info => {
                if (!info || !info.id_infodoc) {
                    console.warn('Documento PRL inválido:', info);
                    return;
                }

                const estaSeleccionada = idsSeleccionados.includes(info.id_infodoc);
                const checked = estaSeleccionada ? 'checked' : '';

                $container.append(`
            <div class="col">
                <div class="card hover-effect shadow-sm border-1 mb-1" style="font-size: 0.9rem; cursor: pointer;">
                    <div class="card-body p-2">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" 
                                   name="info_prl[]" 
                                   value="${info.id_infodoc}" 
                                   id="info_${info.id_infodoc}" 
                                   ${checked}>
                            <label class="form-check-label fw-semibold" 
                                   for="info_${info.id_infodoc}" 
                                   style="line-height: 1.2;">
                                ${info.nombre_ifd || 'Documento sin nombre'}
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        `);
            });

            // Si no hay documentos, mostrar mensaje
            if (todasInfoPRL.length === 0) {
                $container.append(`
            <div class="col-12">
                <div class="alert alert-info">No hay documentos PRL disponibles</div>
            </div>
        `);
            }
        }

        
    </script>

</body>

</html>