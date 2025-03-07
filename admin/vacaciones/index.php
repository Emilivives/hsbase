<?php
session_start();
include('../../app/config.php');
include('../../admin/layout/parte1.php');
include('../../app/controllers/trabajadores/listado_trabajadores_alfabet.php');
include('../../app/controllers/maestros/centros/listado_centros.php');



// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['sesion_email'])) {
    header('Location: ' . $URL . '/login.php');
    exit();
}

// Verificar si el usuario tiene permiso para acceder a esta página
if ($_SESSION['perfil_usr'] !== 'ADMINISTRADOR' && $_SESSION['perfil_usr'] !== 'USUARIO_RRHH' && $_SESSION['perfil_usr'] !== 'USUARIO_RRHH_BASICO') {
    // Si el usuario no es administrador, redirigirlo a su dashboard de usuario
    header('Location: ' . $URL . '/admin/acceso_nopermitido.php');
    exit();
}
?>

<head>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <style>
        .dropdown-font-size {
            font-size: 12px;
        }

        .vencido {
            background-color: red;
            color: white;
        }

        .badge-wh-1 {
            display: inline-block;
            min-width: 1px;
            padding: 1px 1px;
            font-size: 13px;
            font-weight: bold;
            color: #fff;
            background-color: #f58da3;
            line-height: 6;
            vertical-align: bottom;
            white-space: nowrap;
            text-align: center;
            border-radius: 5px;
        }

        .highlight {
            border-top: 3px solid #ff0000;
            /* Puedes ajustar el color y el estilo del borde */
        }
    </style>

</head>
<html>
<!-- Font Awesome -->
<link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
<!-- Ionicons -->
<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

<!-- select2 -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@x.x.x/dist/select2-bootstrap4.min.css">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h5 class="m-0"><b>Contro Vacaciones</b></h5>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                    <li class="breadcrumb-item active">Control vacaciones</li>
                </ol>
            </div><!-- /.col -->
            <hr>
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>


<!-- /.content-header -->
<div class="row">
    <div class="col-md-12">
        <div class="card card-outline card-primary">
            <div class="card-header col-md-12">
                <h3 class="card-title"><b>Control de vaciones generadas y consumidas</b></h3>
                <style>
                    .btn-text-right {
                        text-align: right;
                    }
                </style>
                <!-- Button trigger modal -->
                <div class="btn-text-right">
                    <?php if ($_SESSION['perfil_usr'] === 'ADMINISTRADOR' || $_SESSION['perfil_usr'] === 'USUARIO_PRL' || $_SESSION['perfil_usr'] === 'USUARIO_RRHH'): ?>

                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-generavacaciones">
                            + GENERAR
                        </button>


                        <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modal-consumevacaciones">
                            + CONSUMIR
                        </button>
                    <?php endif ?>

                </div>
                <div class="col-md-2 d-flex align-items-center">
                    <label for="filtro-anio" class="form-label me-3 flex-shrink-0">Filtrar por Año:</label>
                    <select id="filtro-anio" class="form-select">
                        <!-- Aquí se agregarán los años dinámicamente -->
                    </select>
                </div>

                <!-- Modal añadir -->
                <div class="modal fade" id="modal-generavacaciones" role="dialog" aria-labelledby="modal-generavacaciones" aria-hidden="true">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <div class="modal-header" style="background-color:#0080ff; color:white;">
                                <h5 class="modal-title" id="modal-generavacaciones">+ Genera vacaciones</h5>
                                <button type="button" class="close" style="color: black;" data-dismiss="modal" aria-label="Close">
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
                                                <div class="input-group">
                                                    <select name="id_trabajador" id="id_trabajador" class="id_trabajador">
                                                        <option value="">Seleccione un trabajador</option>
                                                        <?php
                                                        foreach ($trabajadores as $trabajador) { ?>
                                                            <option value="<?php echo $trabajador['id_trabajador']; ?>"><?php echo $trabajador['nombre_tr'] ?> // <?php echo $trabajador['nombre_emp'] ?></option>
                                                        <?php
                                                        }
                                                        ?>
                                                    </select>
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
                                                <option value="0.124">General - 45 días</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-sm-3">
                                            <label for="generado">Días Generados:</label>
                                            <input type="text" name="generado" class="form-control" id="generado" readonly>
                                        </div>
                                        <div class="col-sm-2 mt-4">
                                            <!-- Botón para asignar 360 días al año laboral -->
                                            <button type="button" class="btn btn-info" id="botonAnoLaboral" title="Para trabajadores de tierra de todo el año">Año Laboral completo</button>
                                        </div>
                                        <div class="col-sm-6">
                                            <label for="concepto">Concepto:</label>
                                            <input type="text" name="concepto" class="form-control" value="">
                                        </div>
                                    </div>
                                    <br>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                        <button type="submit" class="btn btn-primary">Guardar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Fin modal -->

                <!-- inicio modal consumir vacaciones-->
                <div class="modal fade" id="modal-consumevacaciones" role="dialog" aria-labelledby="modal-consumevacaciones" aria-hidden="true">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <div class="modal-header" style="background-color:#ff8000 ;color:white">
                                <h5 class="modal-title" id="modal-consumevacaciones">+ Consumir vacaciones</h5>
                                <button type="button" class="close" style="color: black;" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">

                                <form action="../../app/controllers/vacaciones/consume_vac.php" method="post" enctype="multipart/form-data">

                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="tarea">Trabajador</label>
                                            <div class="input-group">
                                                <select name="id_trabajador" id="id_trabajador2" class="id_trabajador">
                                                    <option value="">Seleccione un trabajador</option>
                                                    <?php
                                                    foreach ($trabajadores as $trabajador) { ?>
                                                        <option value="<?php echo $trabajador['id_trabajador']; ?>"><?php echo $trabajador['nombre_tr'] ?> // <?php echo $trabajador['nombre_emp'] ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
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
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="">Días Consumidos</label>
                                                <input type="text" name="consumido" class="form-control" id="consumido" readonly>
                                            </div>
                                        </div>
                                        <!-- Campo oculto con el valor 1 (valor por defecto) -->
                                        <input type="hidden" name="descuenta" value="1">

                                        <div class="col-md-2">
                                            <div class="form-check form-switch">
                                                <!-- El checkbox se enviará con el valor 0 cuando está marcado -->
                                                <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault" name="descuenta" value="0">
                                                <label class="form-check-label" for="flexSwitchCheckDefault">DESCUENTA</label>
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

                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                        <button type="submit" class="btn btn-primary"><i class="bi bi-floppy"></i> Guardar</button>

                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
                <!--fin modal-->

            </div>

            <div class="card-body">
                <table id="tabla-vacaciones" class="table table-striped table-bordered" style="width:100%"></table>
                             <thead>
                    <tr>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th> <!-- Nueva columna -->
                    </tr>
                </thead>
                </table>
            </div>
        </div>
    </div>



</div>
<div class="row">
    <div class="btn-text-right">

        <a href='informe_excel_vac.php' target='_blank' class='btn btn-sm btn-success'><i class="fa fa-file-excel-o"></i> reporte</a>


    </div>
</div>
</div>

</html>
<?php
include('../../admin/layout/parte2.php');
include('../../admin/layout/mensaje.php');

?>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


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
        var generado = (dias * regimen).toFixed(2); // Calculamos el valor generado con 2 decimales

        // Asignamos el valor al campo generado
        document.getElementById("generado").value = generado;
    }

    // Función para establecer 360 días o valores predeterminados al pulsar "Año Laboral"
    function establecerAnoLaboral() {
        var regimen = parseFloat(document.getElementById("regimen").value); // Obtenemos el régimen seleccionado
        var dias = 360; // Por defecto, asignamos 360 días
        var generado; // Inicializamos la variable para los días generados

        // Lógica específica según el régimen
        if (!isNaN(regimen)) { // Aseguramos que régimen sea un número válido
            if (regimen === 0 || isNaN(regimen)) {
                alert("Por favor selecciona un régimen válido.");
                return;
            }
            if (regimen === 0.0822) {
                dias = 360; // Año laboral basado en 360 días
                generado = 30; // Días generados fijos
            } else if (regimen === 0.124) {
                dias = 360; // Año laboral basado en 360 días
                generado = 45; // Días generados fijos
            } else {
                generado = (dias * regimen).toFixed(2); // Cálculo normal para otros regímenes
            }

            // Asignamos valores a los campos de días y generado
            document.getElementById("dias").value = dias;
            document.getElementById("generado").value = generado;
        }
    }


    document.addEventListener("DOMContentLoaded", function() {
        // Eventos para los cambios en las fechas y el régimen
        document.getElementById("fecha_inicio").addEventListener("change", calcularDias);
        document.getElementById("fecha_fin").addEventListener("change", calcularDias);
        document.getElementById("regimen").addEventListener("change", function() {
            var dias = document.getElementById("dias").value;
            if (dias) {
                calcularGenerado(dias);
            }
        });

        // Evento para el botón de año laboral
        document.getElementById("botonAnoLaboral").addEventListener("click", establecerAnoLaboral);
    });
</script>


<script>
    $(document).ready(function() {
        const tabla = $('#tabla-vacaciones').DataTable({
            ajax: {
                url: '../../app/controllers/vacaciones/calculatabla_vac.php', // Ruta al archivo PHP
                data: function(d) {
                    d.anio = $('#filtro-anio').val(); // Enviamos el año seleccionado
                },
                dataSrc: 'data'
            },
            columns: [{
                    data: 'codigo_tr',
                    title: 'Codigo',
                    className: 'text-center'
                },
                {
                    data: 'dni_tr',
                    title: 'DNI/NIE',
                    className: 'text-center'
                },
                {
                    data: 'trabajador',
                    title: 'Trabajador'
                },
                {
                    data: 'anio',
                    title: 'Año',
                    className: 'text-center'
                },
                {
                    data: 'total_generado',
                    title: 'Generado',
                    render: function(data, type, row) {
                        return parseFloat(data).toFixed(2); // Formatea a dos decimales
                    },
                    className: 'text-center'
                },
                {
                    data: 'total_consumido',
                    title: 'Consumido',
                    className: 'text-center'
                },
                {
                    data: null,
                    title: 'Balance', // Nueva columna para el balance
                    render: function(data, type, row) {
                        // Aquí calculamos el balance restando "Generado" de "Consumido"
                        var saldo = parseFloat(row.total_generado) - parseFloat(row.total_consumido);
                        var color = saldo < 0 ? 'red' : 'black'; // Si es negativo, color rojo; si no, negro
                        return `<span style="color: ${color}; font-weight: bold;">${saldo.toFixed(2)}</span>`;
                    },
                    className: 'text-center'
                },
                {
                    data: 'id_trabajador', // ID del trabajador
                    render: function(data, type, row) {
                        return `
                        <a href="detalles_trabajador.php?id_trabajador=${data}" class="btn btn-primary btn-sm">
                            Ver Detalles
                        </a>
                    `;
                    }
                }
            ],
            responsive: true,
            language: {
                url: '//cdn.datatables.net/plug-ins/1.13.5/i18n/es-ES.json' // Traducción al español
            }
        });

        // Cargar años en el dropdown
        $.ajax({
            url: '../../app/controllers/vacaciones/calculatabla_vac.php?getAnios=1', // Ruta para obtener los años
            method: 'GET',
            success: function(response) {
                const anios = JSON.parse(response);
                $('#filtro-anio').append(new Option('Todos los años', '')); // Opción para ver todos los años
                anios.forEach(anio => {
                    $('#filtro-anio').append(new Option(anio, anio));
                });
            }
        });

        // Refiltrar la tabla al cambiar el año
        $('#filtro-anio').on('change', function() {
            tabla.ajax.reload();
        });
    });
</script>
<script>
    $(document).ready(function() {
        $('#id_trabajador').select2({
            dropdownParent: $('#modal-generavacaciones .modal-body'),
            theme: 'bootstrap4',
        });
    });

    $('#id_trabajador2').select2({
        dropdownParent: $('#modal-consumevacaciones .modal-body'),
        theme: 'bootstrap4',
    });
</script>