<?php
include('../../app/config.php');
include('../../admin/layout/parte1.php');
include('../../app/controllers/evaluacion/listado_evaluacion_equipos.php');
include('../../app/controllers/evaluacion/listado_maquinasevaluadas.php');

include('../../app/controllers/maestros/centros/listado_centros.php');

include('../../app/controllers/inventario/listado_maquinas.php');

$id_equiposcentro = $_GET['id'];


?>
<html>
<!-- Font Awesome -->
<link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
<!-- Ionicons -->
<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

<style>
    .dropdown-font-size {
        font-size: 12px;
    }

    .btn-font-size {
        font-size: 12px;
    }

    .modal-body {
        overflow: visible !important;
    }

    .nivel-riesgo-select {
        display: none;
        margin-top: 0.5rem;
        max-width: 200px;
        position: relative;
        z-index: 1056;
    }

    .nivel-riesgo-select.visible {
        display: block;
    }
</style>


<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h3 class="m-0">Evaluaciones de equipos de trabajo</h3>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                    <li class="breadcrumb-item"><a href="#">Evaluaciones</a></li>
                    <li class="breadcrumb-item active">Indice</li>
                </ol>
            </div><!-- /.col -->
            <hr class="border-primary">
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>


</html>

<div class="dropdown">
    <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        IMPRIMIR
    </button>
    <div class="dropdown-menu dropdown-menu-dark" aria-labelledby="dropdownMenuButton">
        <a class="dropdown-item" style="color:#ddd" href="reporte_equiposcentro.php?id=<?php echo $id_equiposcentro; ?>" target="_blank" class="btn btn-warning btn-sm" title="EVALUACION"> <i class="bi bi-printer"></i> IMPRIMIR ER</a></a>
        <a class="dropdown-item" style="color: #ddd;" href="planificacion_er.php?id_puestocentro=<?php echo $id_puestocentro; ?>" class="btn btn-danger btn-sm btn-font-size" title="Imprimir planificacion preventiva"><i class="bi bi-printer"></i> PLANIFICACIÓN</a>
        <a class="dropdown-item" style="color: #ddd;" href="ficha_infopuestoarea.php?id_puestocentro=<?php echo $id_puestocentro; ?>" target="_blank"><i class="bi bi-copy"></i> FICHA PUESTO</a>
    </div>
</div>


<div class="row">
    <div class="col-md-12">
        <div class="card card-outline card-info">
            <div class="card-header col-md-12">
                <h3 class="card-title"><b>Equipos evaluados</b></h3>
                <style>
                    .btn-text-right {
                        text-align: right;
                    }
                </style>
                <!--boton modal-->

                <div class="btn-text-right">
                    <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal-anadir-maquina">
                        Añadir Máquina a Evaluar
                    </button>
                </div>


                <div class="modal fade" id="modal-anadir-maquina" tabindex="-1" role="dialog" aria-labelledby="modalAnadirMaquinaLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header" style="background-color: #28a745; color: white;">
                                <h5 class="modal-title" id="modalAnadirMaquinaLabel">Añadir Máquina a Evaluar</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form id="form-anadir-maquina" action="../../app/controllers/evaluacion/add_maquina_evaluar.php" method="POST">
                                <div class="modal-body">
                                    <!-- Campo oculto para ID de la evaluación -->
                                    <input type="hidden" name="id_revision" value="<?php echo $id_equiposcentro ?>">

                                    <div class="col-md-12">
                                        <label for="maquina-select">Seleccione una Máquina</label>
                                        <div class="input-group">
                                            <select name="maquina_id" id="maquina-select" class="maquina-select" required>
                                                <option value="">Seleccione...</option>
                                                <?php foreach ($maquinas_datos as $maquina): ?>
                                                    <option value="<?= $maquina['id_maquina'] ?>">
                                                        <?= htmlspecialchars($maquina['nombre_tm']) ?> / <?= htmlspecialchars($maquina['modelo_maq']) ?> / <?= htmlspecialchars($maquina['numserie_maq']) ?> / <?= htmlspecialchars($maquina['nombre_cen']) ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>


                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                    <button type="submit" class="btn btn-success">Añadir</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>






                <div class="card-body">
                    <table id="tabla-maquinas-evaluar" class="table table-hover table-condensed">
                        <thead class="table-dark">
                            <tr>
                                <th>Tipo de Máquina</th>
                                <th>Clase</th>
                                <th>Marca</th>
                                <th>Modelo</th>
                                <th>Número de Serie</th>
                                <th>Centro</th>
                                <th>PA</th>
                                <th>Valoracion</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($maquinas_evaluar as $maquina): ?>
                                <?php
                                // Consulta para contar las planificaciones activadas
                                $query_planificaciones = "SELECT COUNT(*) FROM er_revisionmaq_respuestas 
                                      WHERE id_revision_maquina = :id_revision_maquina AND planificacion = 1";
                                $stmt_planificaciones = $pdo->prepare($query_planificaciones);
                                $stmt_planificaciones->execute([':id_revision_maquina' => $maquina['id_revision_maquina']]);
                                $planificaciones_activadas = $stmt_planificaciones->fetchColumn();
                                ?>
                                <tr>
                                    <td><?= htmlspecialchars($maquina['nombre_tipo_maquina']) ?></td>
                                    <td><?= htmlspecialchars($maquina['clase_maquina']) ?></td>
                                    <td><?= htmlspecialchars($maquina['marca']) ?></td>
                                    <td><?= htmlspecialchars($maquina['modelo']) ?></td>
                                    <td><?= htmlspecialchars($maquina['num_serie']) ?></td>
                                    <td><?= htmlspecialchars($maquina['centro']) ?></td>
                                    <td><?= htmlspecialchars($planificaciones_activadas) ?></td>
                                    <td><?= htmlspecialchars($maquina['valoracion_equipo'] === null ? 'Sin valoración' : $maquina['valoracion_equipo']) ?></td>

                                    <td>
                                        <button
                                            class="btn btn-primary btn-evaluar-maquina"
                                            data-id-revision="<?= $maquina['id_revision'] ?>"
                                            data-id-maquina="<?= $maquina['id_maquina'] ?>"
                                            data-bs-toggle="modal"
                                            data-bs-target="#modalPreguntas">
                                            Evaluar
                                        </button>
                                        <button
                                            class="btn btn-info btn-ver-respuestas"
                                            data-id-revision="<?= $maquina['id_revision'] ?>"
                                            data-id-maquina="<?= $maquina['id_maquina'] ?>"
                                            data-bs-toggle="modal"
                                            data-bs-target="#modalRespuestas">
                                            Ver Respuestas
                                        </button>
                                        <!-- Botón para eliminar el registro -->
                                        <a href="#" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal"
                                            data-id-revision="<?= $maquina['id_revision']  ?>"
                                            data-id-maquina="<?= htmlspecialchars($maquina['id_maquina']) ?>">Eliminar</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <div class="modal fade" id="modalPreguntas" tabindex="-1" aria-labelledby="modalPreguntasLabel" aria-hidden="true">
                        <div class="modal-dialog modal-xl">
                            <div class="modal-content">
                                <div class="modal-header" style="background-color:#808080 ;color:white">
                                    <h5 class="modal-title" id="modalPreguntasLabel">Check list RD1215/1997 - Equipos de trabajo</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                                </div>
                                <div class="modal-body">
                                    <!-- Aquí cargaremos el formulario dinámicamente -->
                                    <div id="formularioPreguntas"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Agregar este modal al final del archivo, antes de incluir parte2.php -->
                    <div class="modal fade" id="modalRespuestas" tabindex="-1" aria-labelledby="modalRespuestasLabel" aria-hidden="true">
                        <div class="modal-dialog modal-xl">
                            <div class="modal-content">
                                <div class="modal-header" style="background-color:#004080 ;color:white">
                                    <h5 class="modal-title" id="modalRespuestasLabel">Resultado check-list: <?php echo $maquina['nombre_tipo_maquina'] ?></h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                                </div>
                                <div class="modal-body">
                                    <div id="contenidoRespuestas"></div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                </div>
                            </div>
                        </div>
                    </div>


                    <!-- Modal de confirmación de eliminación -->
                    <div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="confirmDeleteModalLabel">Confirmar Eliminación</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    ¿Estás seguro de que deseas eliminar esta máquina evaluada? Esta acción no se puede deshacer.
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                    <a href="#" id="deleteConfirmButton" class="btn btn-danger">Eliminar</a>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>

            </div>
        </div>
    </div>
</div>

<?php
include('../../admin/layout/parte2.php');
include('../../admin/layout/mensaje.php');
?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />


<script>
    $(document).ready(function() {
        $('#maquina-select').select2({
            dropdownParent: $('#modal-anadir-maquina .modal-body'),
            theme: 'bootstrap4',
        });
    });
</script>

<script>
document.getElementById('form-anadir-maquina').addEventListener('submit', function(e) {
    e.preventDefault();
    
    var idRevision = document.querySelector('input[name="id_revision"]').value;
    var maquinaId = document.querySelector('select[name="maquina_id"]').value;
    
    console.log('ID Revisión:', idRevision);
    console.log('ID Máquina:', maquinaId);
    
    if (!idRevision || !maquinaId) {
        alert('Por favor, complete todos los campos');
        return;
    }
    
    this.submit();
});
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        $('#modal-crear-revision').on('show.bs.modal', function(event) {
            const button = $(event.relatedTarget); // Botón que activó el modal
            const maquinaId = button.data('maquina-id'); // ID de la máquina
            const maquinaNombre = button.data('maquina-nombre'); // Nombre de la máquina

            // Rellenar los campos del modal
            $('#maquina-id').val(maquinaId);
            $('#maquina-nombre').val(maquinaNombre);

            // Limpiar la lista de elementos antes de cargar
            $('#lista-elementos-revision').html('<p>Cargando elementos de revisión...</p>');

            // Llamada AJAX para cargar los elementos de revisión
            $.ajax({
                url: 'list_elementos_revision.php',
                method: 'GET',
                dataType: 'json',
                success: function(data) {
                    if (data.length > 0) {
                        let elementosHtml = '';
                        data.forEach(function(elemento) {
                            elementosHtml += `
                            <div class="form-group">
                                <label for="respuesta-${elemento.id_elemento}">${elemento.descripcion}</label>
                                <select name="respuesta[${elemento.id_elemento}]" id="respuesta-${elemento.id_elemento}" class="form-control" required>
                                    <option value="">Seleccionar respuesta</option>
                                    <option value="SI">SI</option>
                                    <option value="NO">NO</option>
                                </select>
                                <input type="text" name="observacion[${elemento.id_elemento}]" class="form-control mt-2" placeholder="Observación (opcional)">
                            </div>
                        `;
                        });
                        $('#lista-elementos-revision').html(elementosHtml);
                    } else {
                        $('#lista-elementos-revision').html('<p>No se encontraron elementos de revisión.</p>');
                    }
                },
                error: function() {
                    $('#lista-elementos-revision').html('<p>Error al cargar los elementos de revisión.</p>');
                }
            });
        });
    });

    const itemsPorPagina = 10;
    let paginaActual = 1;

    function mostrarPagina(contenedor, pagina) {
        const items = contenedor.querySelectorAll('.pregunta-item');
        const inicio = (pagina - 1) * itemsPorPagina;
        const fin = inicio + itemsPorPagina;

        items.forEach((item, index) => {
            item.style.display = (index >= inicio && index < fin) ? '' : 'none';
        });
    }

    $(document).ready(function() {
        $(document).ready(function() {
            // Código existente para btn-evaluar-maquina
            $('.btn-evaluar-maquina').click(function() {
                const idRevision = $(this).data('id-revision');
                const idMaquina = $(this).data('id-maquina');

                $.ajax({
                    url: '../../app/controllers/evaluacion/cargar_preguntas_maq.php',
                    method: 'GET',
                    data: {
                        id_revision: idRevision,
                        id_maquina: idMaquina
                    },
                    success: function(response) {
                        $('#formularioPreguntas').html(response);
                        // Inicializar los handlers después de cargar el contenido
                        initializeFormHandlers();
                    },
                    error: function() {
                        $('#formularioPreguntas').html('<p>Error al cargar las preguntas.</p>');
                    }
                });
            });

            // Función para inicializar los handlers del formulario
            function initializeFormHandlers() {
                // Usar event delegation para los checkboxes
                $('#formularioPreguntas').off('change', '.planificacion-check').on('change', '.planificacion-check', function() {
                    const nivelRiesgoSelect = $(this).closest('.d-flex').find('.nivel-riesgo-select');
                    if (this.checked) {
                        nivelRiesgoSelect.addClass('visible');
                        nivelRiesgoSelect.prop('required', true);
                    } else {
                        nivelRiesgoSelect.removeClass('visible');
                        nivelRiesgoSelect.prop('required', false);
                        nivelRiesgoSelect.val(''); // Limpiar selección
                    }
                });

                // Validación del formulario
                const form = document.getElementById('formRevision');
                if (form) {
                    form.addEventListener('submit', function(event) {
                        if (!form.checkValidity()) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    });
                }
            }

            // También manejar el evento de apertura del modal
            $('#modalPreguntas').on('shown.bs.modal', function() {
                initializeFormHandlers();
            });
        });
    });



    $(document).ready(function() {
        $('.btn-ver-respuestas').click(function() {
            const idRevision = $(this).data('id-revision');
            const idMaquina = $(this).data('id-maquina');

            $.ajax({
                url: '../../app/controllers/evaluacion/cargar_respuestas_maq.php',
                method: 'GET',
                data: {
                    id_revision: idRevision,
                    id_maquina: idMaquina
                },
                success: function(response) {
                    $('#contenidoRespuestas').html(response);

                    $('#formEditarRespuestas').off('submit').on('submit', function(e) {
                        e.preventDefault();

                        const formData = $(this).serialize();
                        console.log('Datos del formulario:', formData);

                        // Mostrar loader
                        Swal.fire({
                            title: 'Guardando...',
                            text: 'Por favor espere',
                            allowOutsideClick: false,
                            didOpen: () => {
                                Swal.showLoading();
                            }
                        });

                        $.ajax({
                                url: $(this).attr('action'),
                                method: 'POST',
                                data: formData,
                                dataType: 'json'
                            })
                            .done(function(response) {
                                console.log('Respuesta del servidor:', response);
                                Swal.close();

                                if (response.status === 'success') {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Éxito',
                                        text: response.message
                                    }).then(() => {
                                        location.reload();
                                    });
                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Error',
                                        text: response.message,
                                        footer: '<button onclick="mostrarDetallesError()">Ver detalles técnicos</button>'
                                    });
                                }
                            })
                            .fail(function(xhr, status, error) {
                                console.error('Error completo:', {
                                    xhr: xhr,
                                    status: status,
                                    error: error,
                                    response: xhr.responseText
                                });

                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error en la petición',
                                    html: `
                                <p>Status: ${status}</p>
                                <p>Error: ${error}</p>
                                <pre style="text-align: left; max-height: 200px; overflow: auto;">
                                    ${xhr.responseText}
                                </pre>
                            `
                                });
                            });
                    });
                },
                error: function(xhr, status, error) {
                    console.error('Error al cargar respuestas:', error);
                    $('#contenidoRespuestas').html(`
                    <div class="alert alert-danger">
                        Error al cargar las respuestas.<br>
                        Status: ${status}<br>
                        Error: ${error}
                    </div>
                `);
                }
            });
        });

        // Función para mostrar detalles técnicos del error
        window.mostrarDetallesError = function() {
            console.log('Últimos detalles del error:', window.lastErrorDetails);
            Swal.fire({
                title: 'Detalles técnicos del error',
                html: `<pre style="text-align: left">${window.lastErrorDetails || 'No hay detalles disponibles'}</pre>`,
                width: '800px'
            });
        };
    });



    $(document).ready(function() {
        // Al abrir el modal de confirmación
        $('#confirmDeleteModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget); // Botón que abrió el modal
            var id_revision = button.data('id-revision');
            var id_maquina = button.data('id-maquina');

            // Actualizar el enlace para eliminar con los parámetros correctos
            var deleteUrl = '../../app/controllers/evaluacion/delete_maquina_evaluada.php?id_revision=' + id_revision + '&id_maquina=' + id_maquina;
            $('#deleteConfirmButton').attr('href', deleteUrl);
        });
    });
</script>