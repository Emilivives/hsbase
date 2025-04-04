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
    </style>
</head>

<body>

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
                                <td colspan="8" class="details-content p-0">
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
                                                        </div>
                                                        <div class="col-md-2">
                                                            <p><strong>Email:</strong> ${t.email_tr || 'N/A'}</p>
                                                            <p><strong>Categoría:</strong> ${t.categoria_nombre || 'N/A'}</p>
                                                            <p><strong>Estado:</strong> ${t.activo_tr == 1 ? 'Activo' : 'Inactivo'}</p>
                                                        </div>
                                                        <div class="col-md-7">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <h6 class="text-primary">
                                                                        <i class="bi bi-mortarboard"></i> Formaciones Asignadas - cumplimiento: 
                                                                        ${completadas} / ${total_formaciones}
                                                                    </h6>
                                                                    <div class="row row-cols-1 row-cols-md-2 g-2">
                                                                        ${formacionesHTML}
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <h6 class="text-primary">
                                                                        <i class="bi bi-info-circle"></i> Información PRL
                                                                    </h6>
                                                                    <div class="row row-cols-1 row-cols-md-2 g-2">
                                                                        ${infoPRLHTML}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-1">
                                                            <button class="btn btn-warning btn-sm" onclick="cargarDatosTrabajador(${t.id_trabajador})">
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

                $(document).on('shown.bs.tab', '.nav-link[data-bs-target^="#reconocimientos-"]', function() {
                    const tabId = $(this).data('bs-target');
                    const id_trabajador = tabId.split('-')[2];
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

                    if ($tab.html().trim().includes('spinner-border') || $tab.find('table').length === 0) {
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
                                $tab.html(response);
                                $tab.find('[data-bs-toggle="tooltip"]').tooltip();
                            },
                            error: function(xhr) {
                                $tab.html(`<div class="alert alert-danger">Error al cargar reconocimientos: ${xhr.statusText}</div>`);
                            }
                        });
                    }
                }
            });
            /////////////////////// eventos para modal de editar trabajador///////////////////////
        </script>