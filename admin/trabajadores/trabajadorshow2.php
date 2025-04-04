<?php
include('../../app/config.php');
include('../../admin/layout/parte1.php');
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

    <!-- jQuery (necesario para DataTables) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

    <style>
        .accordion-content {
            display: none;
            padding: 15px;
            border: 1px solid #dee2e6;
            border-top: none;
        }

        .accordion-content.active {
            display: block;
        }

        .accordion-header {
            cursor: pointer;
            background-color: #f8f9fa;
            padding: 10px;
            border: 1px solid #dee2e6;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Lista de Trabajadores -->
            <div class="col-md-5">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h3 class="card-title">Trabajadores</h3>
                    </div>
                    <div class="card-body">

                        <div id="workersList">
                            <!-- Lista de trabajadores se cargará dinámicamente -->
                        </div>
                    </div>
                </div>
            </div>

            <!-- Detalles del Trabajador -->
            <div class="col-md-7">
                <div id="workerDetails" class="card">
                    <div class="card-header bg-secondary text-white">
                        <h3 class="card-title">Seleccione un trabajador</h3>
                    </div>
                    <div class="card-body" id="workerDetailsContent">
                        <!-- Detalles del trabajador se cargarán dinámicamente -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Cargar lista de trabajadores
            function loadWorkersList() {
                $.ajax({
                    url: '../../app/controllers/trabajadores/ajax_listado_trabajadores.php',
                    method: 'GET',
                    dataType: 'json',
                    success: function(workers) {
                        let workersHtml = '<table id="workersTable" class="table table-hover">' +
                            '<thead><tr><th>DNI</th><th>Nombre</th><th>Estado</th><th>Categoria</th><th>Empresa</th><th></th></tr></thead>' +
                            '<tbody>';

                        workers.forEach(function(worker) {
                            let statusLabel = worker.activo_tr == 1 ?
                                '<span class="badge bg-success">Activo</span>' // Verde
                                :
                                '<span class="badge bg-danger">Baja</span>'; // Rojo

                            workersHtml += `
                    <tr>
                        <td>${worker.dni_tr}</td>
                        <td>${worker.nombre_tr}</td>
                              <td>${statusLabel}</td>
                          <td>${worker.nombre_cat}</td>
                        <td>${worker.nombre_emp}</td>
                    
                        <td>
                            <button class="btn btn-sm btn-primary worker-details" 
                                    data-id="${worker.id_trabajador}">
                                Ver
                            </button>
                        </td>
                    </tr>`;
                        });

                        workersHtml += '</tbody></table>';
                        $('#workersList').html(workersHtml);

                        // Inicializar DataTable
                        $('#workersTable').DataTable({
                            responsive: true,
                            pageLength: 10,
                            language: {
                                url: "https://cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json"
                            }
                        });

                        // Añadir evento a botones de detalles
                        $('.worker-details').on('click', function() {
                            let workerId = $(this).data('id');
                            loadWorkerDetails(workerId);
                        });
                    }
                });
            }


            // Cargar detalles de trabajador
            function loadWorkerDetails(workerId) {
                console.log("Cargando detalles del trabajador con ID:", workerId); // Verificar que la función se ejecuta

                $.ajax({
                    url: '../../app/controllers/trabajadores/ajax_detalle_trabajador.php',
                    method: 'POST',
                    data: {
                        id_trabajador: workerId
                    },
                    dataType: 'json',
                    success: function(response) {
                        console.log("Respuesta del servidor:", response); // Verificar qué datos llegan
                        const worker = response.trabajador;
                        const formaciones = response.formaciones;
                        const reconocimientos = response.reconocimientos;
                        const accidentes = response.accidentes;

                        let detailsHtml = `
              <div class="row">
    <div class="col-md-12 d-flex justify-content-between align-items-center">
        <h2>${worker.nombre_tr}</h2>
        <!-- Botón Editar pequeño -->
        <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#editWorkerModal">
            <i class="fas fa-edit"></i> Editar
        </button>
    </div>
    </div>
            <div class="row">
                <div class="col-md-3"><strong>Código:</strong> ${worker.codigo_tr}</div>
                <div class="col-md-3"><strong>DNI:</strong> ${worker.dni_tr}</div>
<div class="col-md-3"><strong>Fecha Nacimiento:</strong> ${formatDate(worker.fechanac_tr)}</div>
                <div class="col-md-3"><strong>Sexo:</strong> ${worker.sexo_tr}</div>

                <div class="col-md-3"><strong>Categoría:</strong> ${worker.nombre_cat}</div>
                <div class="col-md-3"><strong>Fecha Inicio:</strong>${formatDate(worker.inicio_tr)}</div>
                <div class="col-md-3"><strong>Estado:</strong> ${worker.activo_tr == 1 ? 'Activo' : 'Baja'}</div>
                <div class="col-md-3"><strong>Formación PDT:</strong> ${worker.formacionpdt_tr}</div>

                <div class="col-md-3"><strong>Centro:</strong> ${worker.nombre_cen}</div>
                <div class="col-md-3"><strong>Empresa:</strong> ${worker.nombre_emp}</div>
                <div class="col-md-3"><strong>Razón Social:</strong> ${worker.razonsocial_emp}</div>
                <div class="col-md-3"><strong>Dirección:</strong> ${worker.direccion_emp}</div>

                <div class="col-md-12"><strong>Anotaciones:</strong> ${worker.anotaciones_tr}</div>
            </div>
            <br><br>
        </div>
        <!-- Botón Editar -->
 
<!-- Modal -->
<div class="modal fade" id="editWorkerModal" tabindex="-1" role="dialog" aria-labelledby="editWorkerModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editWorkerModalLabel">Editar Trabajador</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editWorkerForm">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="modal_nombre_tr">Nombre:</label>
                                <input type="text" id="modal_nombre_tr" class="form-control" value="${worker.nombre_tr}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="modal_codigo_tr">Código:</label>
                                <input type="text" id="modal_codigo_tr" class="form-control" value="${worker.codigo_tr}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="modal_dni_tr">DNI:</label>
                                <input type="text" id="modal_dni_tr" class="form-control" value="${worker.dni_tr}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="modal_fechanac_tr">Fecha Nacimiento:</label>
                                <input type="date" id="modal_fechanac_tr" class="form-control" value="${worker.fechanac_tr}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="modal_sexo_tr">Sexo:</label>
                                <select id="modal_sexo_tr" class="form-control">
                                    <option value="M" ${worker.sexo_tr === 'M' ? 'selected' : ''}>Masculino</option>
                                    <option value="F" ${worker.sexo_tr === 'F' ? 'selected' : ''}>Femenino</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="modal_nombre_cat">Categoría:</label>
                                <input type="text" id="modal_nombre_cat" class="form-control" value="${worker.nombre_cat}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="modal_inicio_tr">Fecha Inicio:</label>
                                <input type="date" id="modal_inicio_tr" class="form-control" value="${worker.inicio_tr}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="modal_activo_tr">Estado:</label>
                                <select id="modal_activo_tr" class="form-control">
                                    <option value="1" ${worker.activo_tr == 1 ? 'selected' : ''}>Activo</option>
                                    <option value="0" ${worker.activo_tr == 0 ? 'selected' : ''}>Baja</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="modal_formacionpdt_tr">Formación PDT:</label>
                                <input type="text" id="modal_formacionpdt_tr" class="form-control" value="${worker.formacionpdt_tr}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="modal_nombre_cen">Centro:</label>
                                <input type="text" id="modal_nombre_cen" class="form-control" value="${worker.nombre_cen}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="modal_nombre_emp">Empresa:</label>
                                <input type="text" id="modal_nombre_emp" class="form-control" value="${worker.nombre_emp}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="modal_razonsocial_emp">Razón Social:</label>
                                <input type="text" id="modal_razonsocial_emp" class="form-control" value="${worker.razonsocial_emp}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="modal_direccion_emp">Dirección:</label>
                                <input type="text" id="modal_direccion_emp" class="form-control" value="${worker.direccion_emp}">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="modal_anotaciones_tr">Anotaciones:</label>
                                <textarea id="modal_anotaciones_tr" class="form-control">${worker.anotaciones_tr}</textarea>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" onclick="updateWorkerInModal(${worker.id_trabajador})">Guardar Cambios</button>
            </div>
        </div>
    </div>
</div>

                </div>
                <!-- Secciones Acordeón -->
<div class="mt-4">
    <!-- Formación -->
    <div class="accordion-section">
        <div class="accordion-header" data-target="formacion">
            <h4>Formación</h4>
            <i class="fas fa-chevron-down"></i>
        </div>
        <div id="formacion" class="accordion-content">
            ${generateFormacionHTML(formaciones)}
        </div>
    </div>
    

    <!-- Reconocimientos Médicos -->
    <div class="accordion-section">
        <div class="accordion-header" data-target="reconocimientos">
            <h4>Reconocimientos Médicos</h4>
            <i class="fas fa-chevron-down"></i>
        </div>
        <div id="reconocimientos" class="accordion-content">
            ${generateReconocimientosHTML(reconocimientos)}
        </div>
    </div>

    <!-- Accidentes -->
    <div class="accordion-section">
        <div class="accordion-header" data-target="accidentes">
            <h4>Accidentes</h4>
            <i class="fas fa-chevron-down"></i>
        </div>
        <div id="accidentes" class="accordion-content">
            ${generateAccidentesHTML(accidentes)}
        </div>
    </div>
</div>

                <!-- Botones de Impresión -->
                <div class="mt-4">
                    <h4>Documentos</h4>
                    <div class="btn-group">
                        <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">
                            Dosier
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="../maestros/documentos/pdf_dosier.php?id_trabajador=${worker.id_trabajador}">Dosier Trasmapi</a>
                        </div>
                    </div>
                </div>
            `;

                        // Inserta el HTML generado en el contenedor de detalles
                        $('#workerDetailsContent').html(detailsHtml);

                        // Configurar acordeones
                        setupAccordions();
                    },
                    error: function(xhr, status, error) {
                        console.error("Error al cargar los detalles del trabajador:", error);
                    }
                });
            }

            // Funciones auxiliares para generar HTML
            function formatFecha(fecha) {
                if (!fecha) return 'Sin fecha';

                const date = new Date(fecha);
                return date.toLocaleDateString('es-ES', {
                    day: '2-digit',
                    month: '2-digit',
                    year: 'numeric'
                });
            }

            function generateFormacionHTML(formaciones) {
                if (!formaciones || formaciones.length === 0) {
                    return '<p>No hay formaciones registradas</p>';
                }

                let tableHTML = `
        <table border="1" cellspacing="0" cellpadding="5">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Fecha</th>
                    <th>Caducidad</th>
                </tr>
            </thead>
            <tbody>
    `;

                tableHTML += formaciones.map(f => `
        <tr>
            <td>${f.nombre_tf}</td>
            <td>${formatFecha(f.fecha_fr)}</td>
            <td>${formatFecha(f.fechacad_fr)}</td>
        </tr>
    `).join('');

                tableHTML += `
            </tbody>
        </table>
    `;

                return tableHTML;
            }

            function generateInformacionPRLHTML(informaciones) {
                if (!informaciones || informaciones.length === 0) {
                    return '<p>No hay información PRL registrada</p>';
                }
                return informaciones.map(i => `
                <div class="mb-2">
                    <strong>${i.nombre_ifd}</strong>
                    <p>Tipo: ${i.tipoinfo_ifd} | Fecha: ${i.fechaentrega}</p>
                </div>
            `).join('');
            }

            function generateReconocimientosHTML(reconocimientos) {
                if (!reconocimientos || reconocimientos.length === 0) {
                    return '<p>No hay reconocimientos médicos registrados</p>';
                }


                return reconocimientos.map(r => `
                <div class="mb-2">
                    <strong>Reconocimiento Médico</strong>
                    <p>Fecha: ${formatFecha(r.fecha_rm)} | Caducidad: ${formatFecha(r.caducidad_rm)}</p>
                </div>
            `).join('');
            }

            function generateAccidentesHTML(accidentes) {
                if (!accidentes || accidentes.length === 0) {
                    return '<p>No hay accidentes registrados</p>';
                }
                return accidentes.map(a => `
        <div class="mb-2">
            <strong>Tipo de Accidente:</strong> ${a.tipoaccidente_ta} <br>
            <strong>Fecha:</strong> ${a.fecha_ace} <br>
            <strong>Centro:</strong> ${a.nombre_cen}
        </div>
    `).join('');
            }

            // Configurar comportamiento de acordeones
            // Configurar comportamiento de acordeones
            function setupAccordions() {
                $('.accordion-header').on('click', function() {
                    const target = $(this).data('target');
                    const content = $(`#${target}`);

                    // Alternar visibilidad
                    content.toggleClass('active');

                    // Cambiar ícono
                    const icon = $(this).find('i');
                    icon.toggleClass('fa-chevron-down fa-chevron-up');
                });
            }

            // Filtro de búsqueda de trabajadores
            $('#searchWorkers').on('keyup', function() {
                const searchTerm = $(this).val().toLowerCase();
                $('#workersList table tbody tr').each(function() {
                    const text = $(this).text().toLowerCase();
                    $(this).toggle(text.includes(searchTerm));
                });
            });

            // Inicializar
            loadWorkersList();
        });

        function formatDate(dateString) {
            if (!dateString) return "N/A"; // Maneja valores nulos o vacíos
            let date = new Date(dateString);
            let day = String(date.getDate()).padStart(2, '0');
            let month = String(date.getMonth() + 1).padStart(2, '0'); // Meses en JS van de 0 a 11
            let year = date.getFullYear();
            return `${day}/${month}/${year}`;
        }
    </script>
</body>

</html>

<?php
include('../../admin/layout/parte2.php');
include('../../admin/layout/mensaje.php');
?>