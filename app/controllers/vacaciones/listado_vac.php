<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Vacaciones</title>
    
    <!-- Librerías CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@x.x.x/dist/select2-bootstrap4.min.css">

    <!-- Librerías JS -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    
    <!-- DataTables y extensiones -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>
</head>
<body>
<div class="container-fluid mt-4">
    <div class="card">
        <div class="card-body">
            <!-- Filtro por Año -->
            <div class="row mb-4">
                <div class="col-md-4">
                    <label for="filtro-anio" class="form-label">Filtrar por Año:</label>
                    <select id="filtro-anio" class="form-select">
                        <option value="todos">Todos los años</option>
                        <option value="2023">2023</option>
                        <option value="2024">2024</option>
                    </select>
                </div>
            </div>

            <div class="row">
                <!-- Primera tabla: Vacaciones Generadas -->
                <div class="col-md-5">
                    <h4>Registros de Vacaciones Generadas</h4>
                    <div class="d-flex justify-content-between mb-2">
                        <div>
                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modal-generavacaciones">
                                + GENERAR
                            </button>
                            <button type="button" class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#modal-generaextras">
                                + EXTRAS
                            </button>
                        </div>
                    </div>
                    <table id="tabla-generados" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Fecha Inicio</th>
                                <th>Fecha Fin</th>
                                <th>Centro Tº</th>
                                <th>Concepto</th>
                                <th>Régimen</th>
                                <th>Días Generados</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Ejemplo de datos -->
                            <tr data-anio="2023">
                                <td>01/01/2023</td>
                                <td>15/01/2023</td>
                                <td>Centro Principal</td>
                                <td>Vacaciones Anuales</td>
                                <td>Régimen General</td>
                                <td>15</td>
                            </tr>
                            <tr data-anio="2024">
                                <td>01/01/2024</td>
                                <td>15/01/2024</td>
                                <td>Centro Secundario</td>
                                <td>Vacaciones Complementarias</td>
                                <td>Régimen Especial</td>
                                <td>10</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Espacio en el centro -->
                <div class="col-md-2"></div>

                <!-- Segunda tabla: Vacaciones Consumidas -->
                <div class="col-md-5">
                    <h4>Registros de Vacaciones Consumidas</h4>
                    <div class="d-flex justify-content-between mb-2">
                        <div>
                            <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#modal-consumevacaciones">
                                + Consume
                            </button>
                            <button type="button" class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#modal-consumeextras">
                                + Liquidar
                            </button>
                        </div>
                    </div>
                    <table id="tabla-consumidos" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Fecha Inicio</th>
                                <th>Fecha Fin</th>
                                <th>Días Consumidos</th>
                                <th>Descuenta</th>
                                <th>Notas</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Ejemplo de datos -->
                            <tr data-anio="2023">
                                <td>16/01/2023</td>
                                <td>30/01/2023</td>
                                <td>15</td>
                                <td>-</td>
                                <td>Vacaciones de invierno</td>
                            </tr>
                            <tr data-anio="2024">
                                <td>16/01/2024</td>
                                <td>25/01/2024</td>
                                <td>10</td>
                                <td>NO</td>
                                <td>Vacaciones de verano</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Tabla Resumen -->
            <div class="row mt-5">
                <div class="col-12">
                    <h4>Resumen de Vacaciones</h4>
                    <table class="table table-striped table-bordered">
                        <thead>
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
                                <td>Nombre del Trabajador</td>
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
<script>
        // Función para calcular los días entre dos fechas
        function calcularDias() {
            var fechaInicio = document.getElementById("fecha_inicio").value;
            var fechaFin = document.getElementById("fecha_fin").value;

            if (fechaInicio && fechaFin) {
                var inicio = new Date(fechaInicio);
                var fin = new Date(fechaFin);

                // Calculamos la diferencia en milisegundos
                var diferencia = fin - inicio;

                // Convertimos la diferencia a días (1 día = 86400000 ms)
                var dias = diferencia / (1000 * 3600 * 24) + 1; // Se suma 1 porque el día de inicio se cuenta

                // Asignamos el valor al campo de días
                document.getElementById("dias").value = dias;

                // Llamamos a la función para calcular "generado" después de calcular los días
                calcularGenerado(dias);
            }
        }

        // Función para calcular el valor generado
        function calcularGenerado(dias) {
            var regimen = parseFloat(document.getElementById("regimen").value);
            var generado = (dias * regimen).toFixed(2); // Calculamos el valor generado con 4 decimales

            // Asignamos el valor al campo generado
            document.getElementById("generado").value = generado;
        }

        // Agregar eventos para los cambios en las fechas y el régimen
        document.getElementById("fecha_inicio").addEventListener("change", calcularDias);
        document.getElementById("fecha_fin").addEventListener("change", calcularDias);
        document.getElementById("regimen").addEventListener("change", function() {
            var dias = document.getElementById("dias").value;
            if (dias) {
                calcularGenerado(dias);
            }
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
        buttons: [
            {
                extend: "collection",
                text: "Reportes",
                buttons: [
                    { extend: "copy", text: "Copiar" },
                    { extend: "pdf", text: "PDF" },
                    { extend: "csv", text: "CSV" },
                    { extend: "excel", text: "Excel" },
                    { extend: "print", text: "Imprimir" }
                ]
            }
        ]
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
        $('#tabla-generados tbody tr:visible').each(function() {
            const diasGenerados = parseFloat($(this).find('td:nth-child(6)').text()) || 0;
            totalGenerado += diasGenerados;
        });

        // Recalcular los totales basados en las filas visibles en la tabla de Consumidos
        $('#tabla-consumidos tbody tr:visible').each(function() {
            const diasConsumidos = parseFloat($(this).find('td:nth-child(3)').text()) || 0;
            const descuenta = $(this).find('td:nth-child(4)').text().trim();

            if (descuenta === '-') {
                totalConsumidoDescuenta1 += diasConsumidos;
            } else if (descuenta === 'NO') {
                totalConsumidoDescuenta0 += diasConsumidos;
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
</body>
</html>