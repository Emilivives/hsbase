<?php
session_start();
include('../../app/config.php');

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['sesion_email'])) {
    header('Location: ' . $URL . '/login.php');
    exit();
}

// Verificar si el usuario tiene permiso para acceder a esta página
if ($_SESSION['perfil_usr'] !== 'ADMINISTRADOR' && $_SESSION['perfil_usr'] !== 'USUARIO_PRL') {
    // Si el usuario no es administrador, redirigirlo a su dashboard de usuario
    header('Location: ' . $URL . '/admin/acceso_nopermitido.php');
    exit();
}
include('../../admin/layout/parte1.php');
include('../../app/controllers/actividad/listado_tareas_pendientes.php');
include('../../app/controllers/actividad/listado_proyectos_activos.php');
include('../../app/controllers/actividad/listado_total_actividades.php');
?>

<html>
<!-- Font Awesome -->
<link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
<!-- Ionicons -->
<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">


<!-- select2 -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@x.x.x/dist/select2-bootstrap4.min.css">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<style>
    .dropdown-font-size {
        font-size: 12px;
    }
</style>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nueva actividad</title>
    <!-- Incluye los CSS de Select2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
</head>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h3 class="m-0">Tarea: </h3>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                    <li class="breadcrumb-item"><a href="#">Actividades</a></li>
                    <li class="breadcrumb-item">Proyectos</li>
                    <li class="breadcrumb-item active">Tarea</li>
                </ol>
            </div><!-- /.col -->
            <hr class="border-primary">
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>

</html>

<div class="row">
    <div class="col-md-12">
        <div class="card card-outline card-primary">
            <div class="card-header col-md-12">
                <h3 class="card-title"><b>Listado actividades</b></h3>
                <style>
                    .btn-text-right {
                        text-align: right;
                    }
                </style>
                <!--boton modal-->
                <div class="btn-text-right">
                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-nuevaactividad">Añadir progreso</button>
                </div>

                <!--inicio modal nueva tarea-->
                <div class="modal fade" id="modal-nuevaactividad" role="dialog" aria-labelledby="modal-nuevaactividad" aria-hidden="true">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <div class="modal-header" style="background-color:#eeeeee ;color:black">
                                <h5 class="modal-title" id="modal-nuevaactividad">+ NUEVA ACTIVIDAD</h5>
                                <button type="button" class="close" style="color: white;" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="../../app/controllers/actividad/create_actividad.php" method="post" enctype="multipart/form-data">
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="proyecto">Proyecto</label>
                                                                                     <select id="proyecto" name="id_proyecto" class="form-control" style="width: 100%;" onchange="filtrarTareas()">

                                                <option value="">Seleccione un proyecto</option>
                                                <?php
                                                foreach ($proyectos as $proyecto) { ?>
                                                    <option value="<?php echo $proyecto['id_proyecto']; ?>"><?php echo $proyecto['nombre_py']; ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-11">
                                            <label for="tarea">Tarea</label>
                                            <div class="input-group">
                                                <select name="id_tarea" id="id_tarea" class="id_tarea">
                                                    <option value="">Seleccione una tarea</option>
                                                    <?php
                                                    foreach ($tareaspendientes as $tareaspendiente) { ?>
                                                        <option value="<?php echo $tareaspendiente['id_tarea']; ?>" data-proyecto="<?php echo $tareaspendiente['id_proyecto']; ?>">
                                                                                                                                                                        <?php echo $tareaspendiente['nombre_ta']; ?> // <?php echo (new DateTime($tareaspendiente['fecha_ta']))->format('d-m-Y'); ?> // <?php echo $tareaspendiente['nombre_cen']; ?>


                                                        </option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                                <div class="input-group-append">
                                                    <a href="#" id="add-task-button" class="btn btn-primary" style="margin-left: 20px;">+ Añadir tarea</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    </br>

                                    <!-- Resto del formulario -->

                                    <div class="row">
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="">Fecha <b>*</b></label>
                                                <input type="date" name="fecha_acc" class="form-control" required>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Responsable</label>
                                                <input type="text" name="responsable_acc" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Hora Inicio <b>*</b></label>
                                                <input type="time" name="horain_acc" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Hora Fin <b>*</b></label>
                                                <input type="time" name="horafin_acc" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="">Detalles <b>*</b></label>
                                                <textarea class="form-control" name="detalles_acc" rows="5"></textarea>
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
                <!--fin modal-->
            </div>
            <div class="card-body">
                <table id="example1" class="table stripe compact hover">
                    <colgroup>
                        <col width="2%">
                        <col width="5%">
                        <col width="10%">
                        <col width="15%">
                        <col width="15%">
                        <col width="5%">
                        <col width="5%">

                        <col width="5%">
                        <col width="40%">
                        <col width="5%">
                    </colgroup>
                    <thead class="table-secondary">
                        <tr>
                            <th style="text-align: center">#</th>
                            <th style="text-align: left">Fecha</th>
                            <th style="text-align: left">Centro</th>
                            <th style="text-align: left">Proyecto</th>
                            <th style="text-align: left">Tarea</th>
                            <th style="text-align: left">Inicio</th>
                            <th style="text-align: left">Tiempo</th>
                            <th style="text-align: left">Responsable</th>
                            <th style="text-align: left">Detalles</th>
                            <th style="text-align: center"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $contador = 0;
                        foreach ($total_actividades as $total_actividad) {
                            $contador = $contador + 1;
                            $id_actividad = $total_actividad['id_actividad'];
                        ?>
                            <tr>
                                <td style="text-align: center;"><?php echo $contador; ?></td>
                                <td><?php echo (new DateTime($total_actividad['fecha_acc']))->format('d-m-Y'); ?></td>
                                <td><?php echo $total_actividad['nombre_cen']; ?></td>
                                <td><?php echo $total_actividad['nombre_py']; ?></td>
                                <td><?php echo $total_actividad['nombre_ta']; ?></td>
                                <td><?php echo $total_actividad['horain_acc']; ?></td>

                                <?php
                                // Asumiendo que las horas están en formato H:i:s (por ejemplo, "14:35:50")
                                $horain = $total_actividad['horain_acc'];
                                $horafin = $total_actividad['horafin_acc'];
                                // Crear objetos DateTime a partir de las horas
                                $inicio = new DateTime($horain);
                                $fin = new DateTime($horafin);
                                // Calcular la diferencia entre las dos horas
                                $diferencia = $inicio->diff($fin);
                                // Formatear la diferencia
                                $diferencia_formateada = $diferencia->format('%H:%I');
                                ?>
                                <!-- Mostrar la diferencia en una celda de tabla -->
                                <td><?php echo $diferencia_formateada; ?></td>
                                <td><?php echo $total_actividad['responsable_acc']; ?></td>
                                <td><?php echo $total_actividad['detalles_acc']; ?></td>
                                <td>
                                    <div class="d-grid gap-2 d-flex content-sm-end">
                                        <a href="../../app/controllers/actividad/delete_actividad2.php?id_actividad=<?php echo $id_actividad; ?>" class="btn btn-danger btn-sm btn-font-size" onclick="return confirm('¿Realmente desea eliminar la actividad realizada?')" title="Eliminar Accion PRL"><i class="bi bi-trash-fill"></i></a>
                                    </div>
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

<!-- Detalles trabajador-->

<?php
include('../../admin/layout/parte2.php');
include('../../admin/layout/mensaje.php');
?>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
  $(document).ready(function() {
    // Inicializar Select2 para el proyecto
    $('#proyecto').select2({
        dropdownParent: $('#modal-nuevaactividad .modal-body'),
        theme: 'bootstrap4',
        width: '100%',
        closeOnSelect: true // <- Esto evita que se cierre automáticamente
    });
    
    // Inicializar Select2 para las tareas con filtrado
    $('#id_tarea').select2({
        dropdownParent: $('#modal-nuevaactividad .modal-body'),
        theme: 'bootstrap4',
        templateResult: function(data) {
            if (!data.id) {
                return data.text;
            }
            
            var $option = $(data.element);
            var proyectoId = $('#proyecto').val();
            
            // Si hay un proyecto seleccionado y esta tarea no pertenece a ese proyecto, ocultar
            if (proyectoId && $option.data('proyecto') != proyectoId) {
                return null;
            }
            
            return data.text;
        }
    });
    
    // Vincular el evento change al select de proyectos
    $('#proyecto').on('change', function() {
        // Cerrar el dropdown después de seleccionar
        $('#proyecto').select2('close');
        
        filtrarTareas();
        
        // Actualizar el href del botón para añadir tarea
        var proyectoId = $(this).val();
        $('#add-task-button').attr('href', '../actividad/show.php?id_proyecto=' + proyectoId);
    });
});
</script>

<script>
    $(function() {
        $("#example1").DataTable({
            "pageLength": 25,
            "language": {
                "emptyTable": "No hay información",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ actividades",
                "infoEmpty": "Mostrando 0 a 0 de 0 Usuarios",
                "infoFiltered": "(Filtrado de MAX total Usuarios)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_  actividades",
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

    // Script para abrir el modal automáticamente al cargar la página
    $(document).ready(function() {
        $('#modal-nuevaactividad').modal('show');
    });
</script>