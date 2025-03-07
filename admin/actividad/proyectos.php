<?php
include('../../app/config.php');
include('../../admin/layout/parte1.php');
include('../../app/controllers/pruebas/listado_trabajadores.php');
include('../../app/controllers/maestros/centros/listado_centros.php');
include('../../app/controllers/maestros/empresas/listado_empresas.php');
include('../../app/controllers/actividad/listado_proyectos.php');
include('../../app/controllers/actividad/listado_tareas.php');
include('../../app/controllers/maestros/responsables/listado_responsables.php');
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
</style>


<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h3 class="m-0">Proyectos Preventivos</h3>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                    <li class="breadcrumb-item"><a href="#">Actividades</a></li>
                    <li class="breadcrumb-item active">Proyectos</li>
                </ol>
            </div><!-- /.col -->
            <hr class="border-primary">
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>


</html>


<div class="row">
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-light shadow-sm border">
            <div class="inner">
                <?php
                $contador_de_proyectos = 0;
                foreach ($proyectos as $proyecto) {
                    $contador_de_proyectos = $contador_de_proyectos + 1;
                }
                ?>
                <h2><?php echo $contador_de_proyectos; ?><sup style="font-size: 20px"></h2>
                <p>Proyectos disponibles</p>
            </div>
            <div class="icon">
                <i class="ion bi-layers-fill"></i>
            </div>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-light shadow-sm border">
            <div class="inner">
                <?php
                $contador_de_tareas = 0;
                foreach ($tareas as $tarea) {
                    $contador_de_tareas = $contador_de_tareas + 1;
                }
                ?>
                <h2><?php echo $contador_de_tareas; ?><sup style="font-size: 20px"></h2>
                <p>Tareas programadas</p>
            </div>
            <div class="icon">
                <i class="ion bi-list-task"></i>
            </div>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-light shadow-sm border">
            <div class="inner">
                <?php
                $contador_de_tareas = 0;
                foreach ($tareas as $tarea) {
                    if ($tarea['estado_ta'] == 'En curso') {
                        $contador_de_tareas = $contador_de_tareas + 1;
                    }
                }

                ?>
                <h2><?php echo $contador_de_tareas; ?><sup style="font-size: 20px"></h2>
                <p>Tareas en curso</p>
            </div>
            <div class="icon">
                <i class="ion bi-check2-square"></i>
            </div>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box">
            <div class="inner">
                <h2>65</h2>

                <p>Unique Visitors</p>
            </div>
            <div class="icon">
                <i class="ion ion-pie-graph"></i>
            </div>

        </div>
    </div>
    <!-- ./col -->
</div>
<!-- /.content-header -->


<div class="row">
    <div class="col-md-12">
        <div class="card card-outline card-success">
            <div class="card-header col-md-12">
                <h3 class="card-title"><b>Proyectos</b></h3>
                <style>
                    .btn-text-right {
                        text-align: right;
                    }
                </style>
                <!--boton modal-->
                <div class="btn-text-right">
                    <button type="button" class="btn btn-primary btn-sm btn-font-size" data-toggle="modal" data-target="#modal-nuevotrabajador">Añadir Proyecto</button>
                </div>

                <!--inicio modal nuevo trabajador-->
                <div class="modal fade" id="modal-nuevotrabajador">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <div class="modal-header" style="background-color:#016296 ;color:white">
                                <h5 class="modal-title" id="modal-nuevtrabajador">Nuevo Proyecto</h5>
                                <button type="button" class="close" style="color: white;" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">

                                <form action="../../app/controllers/actividad/create_proyecto.php" method="post" enctype="multipart/form-data">



                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Nombre Proyecto</label>
                                                <input type="text" name="nombre_py" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="" class="col-form-label col-sm-6">Empresa:</label>
                                            <div class="col-sm-12">
                                                <select name="empresa_py" id="" class="form-control" required>
                                                    <?php
                                                    foreach ($empresas_datos as $empresas_dato) {
                                                    ?>
                                                        <option value="<?php echo $empresas_dato['id_empresa']; ?>"> <?php echo $empresas_dato['nombre_emp']; ?> </option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>

                                            </div>
                                        </div>





                                        <div class="col-md-3">
                                            <label for="">Responsable</label>
                                            <select name="responsable_py" id="" class="form-control">
                                                <?php
                                                foreach ($responsables_datos as $responsables_dato) { ?>
                                                    <option value="<?php echo $responsables_dato['id_responsable']; ?>"><?php echo $responsables_dato['nombre_resp']; ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="">Fecha Inicio</label>
                                                <input type="date" name="fechainicio_py" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="">Fecha fin</label>
                                                <input type="date" name="fechafin_py" class="form-control" required>
                                            </div>

                                        </div>
                                        <div class="col-md-2">


                                        </div>

                                        <div class="col-md-3">
                                            <label for="">Estado</label>
                                            <select class="form-select form-select" name="estado_py" aria-label=".form-select-sm example">
                                                <option selected>Seleccione</option>
                                                <option value="Activo">Activo</option>
                                                <option value="Finalizado">Finalizado</option>
                                                <option value="Cancelado">Cancelado</option>

                                            </select>

                                        </div>

                                    </div>
                                    <hr>

                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group row">
                                                <label for="descripcion_acc" class="col-form-label col-sm-2">Descripción proyecto:</label>
                                                <div class="col-sm-12">
                                                    <textarea class="form-control" name="descripcion_py" value="" rows="3" required></textarea>
                                                </div>
                                            </div>
                                        </div>


                                    </div>
                                    <div class="modal-footer">

                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                        <button type="submit" class="btn btn-primary"><i class="bi bi-floppy"></i> Guardar</button>

                                    </div>
                            </div>
                        </div>

                    </div>

                    <!--fin modal-->


                </div>
                <div class="card-body">
                    <table id="example1" class="table tabe-hover table-condensed table-striped">
                        <colgroup>
                            <col width="5%">
                            <col width="35%">
                            <col width="15%">
                            <col width="7%">
                            <col width="7%">
                            <col width="10%">
                            <col width="7%">
                            <col width="8%">

                        </colgroup>
                        <thead class="table-dark">
                            <tr>
                                <th style="text-align: center">#</th>
                                <th style="text-align: left">Proyecto</th>
                                <th style="text-align: left">Empresa</th>
                                <th style="text-align: left">Fecha In.</th>
                                <th style="text-align: left">Fecha Fin</th>
                                <th style="text-align: center">Avance</th>
                                <th style="text-align: center">Estado</th>
                                <th style="text-align: center">Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $contador = 0;
                            foreach ($proyectos as $proyecto) {
                                $id_proyecto = $proyecto['id_proyecto'];
                                $contador_total = 0;
                                $contador_completado = 0;

                                // Consultamos las tareas de este proyecto específico
                                $sql_tareas = "SELECT * FROM ag_tareas WHERE id_proyecto = :id_proyecto";
                                $query_tareas = $pdo->prepare($sql_tareas);
                                $query_tareas->bindParam(':id_proyecto', $id_proyecto, PDO::PARAM_INT);
                                $query_tareas->execute();
                                $tareas_proyecto = $query_tareas->fetchAll(PDO::FETCH_ASSOC);

                                // Filtramos las tareas del proyecto actual
                                foreach ($tareas_proyecto as $tarea) {
                                    $contador_total++; // Incrementamos el total de tareas

                                    if ($tarea['estado_ta'] == 'Completado') {
                                        $contador_completado++; // Incrementamos el contador de tareas completadas
                                    }
                                }


                                // Calculamos el porcentaje de avance
                                $avance = $contador_total > 0 ? ($contador_completado / $contador_total) * 100 : 0;
                            ?>


                                <tr>
                                    <td style="text-align: center"></td>
                                    <td style="text-align: left"><b><?php echo $proyecto['nombre_py']; ?></b></td>
                                    <td style="text-align: left"><b><?php echo $proyecto['nombre_emp']; ?></b></td>
                                    <td style="text-align: left"><?php echo $newdate = date("d-m-Y", strtotime($proyecto['fechainicio_py'])) ?></td>
                                    <td style="text-align: left"><?php echo $newdate = date("d-m-Y", strtotime($proyecto['fechafin_py'])) ?></td>
                                    <!-- Aquí agregamos la barra de progreso -->
                                    <td style="text-align: left">
                                        <div class="progress" style="height: 25px; background-color:rgb(138, 138, 138);">
                                            <div class="progress-bar" role="progressbar" style="width: <?php echo number_format($avance, 1); ?>%;" aria-valuenow="<?php echo number_format($avance, 1); ?>" aria-valuemin="0" aria-valuemax="100">
                                                <?php echo number_format($avance, 1); ?>%
                                            </div>
                                        </div>
                                    </td>
                                    <td style="text-align: center;"><?php $proyecto['estado_py'];
                                                                    if ($proyecto['estado_py'] == 'Activo') { ?>
                                            <span class='badge badge-success'>ACTIVO</span>
                                        <?php
                                                                    } else if ($proyecto['estado_py'] == 'Finalizado') { ?>
                                            <span class='badge badge-danger'>FINALIZADO</span>
                                        <?php
                                                                    } else if ($proyecto['estado_py'] == 'Cancelado') { ?>
                                            <span class='badge badge-secondary'>CANCELADO</span>
                                        <?php
                                                                    }
                                        ?>

                                    </td>


                                    <td style="text-align: center">
                                        <div class="d-grid gap-2 d-md-block" role="group" aria-label="Basic mixed styles example">
                                            <a href="show.php?id_proyecto=<?php echo $id_proyecto; ?>" class="btn btn-primary btn-sm btn-font-size" title="Ver detalles"><i class="bi bi-folder-fill"></i> Ver</a>

                                            <a href="../../app/controllers/actividad/duplicar_proyecto.php?id_proyecto=<?php echo $id_proyecto; ?>" class="btn btn-warning btn-sm btn-font-size" onclick="return confirm('¿Realmente desea duplicar el proyecto PRL?')" title="Duplicar Proyecto PRL"><i class="bi bi-copy"></i></a>

                                            <a href="../../app/controllers/actividad/delete_proyecto.php?id_proyecto=<?php echo $id_proyecto; ?>" class="btn btn-danger btn-sm btn-font-size" onclick="return confirm('¿Realmente desea eliminar la el proyecto PRL?')" title="Eliminar Proyecto PRL"><i class="bi bi-trash-fill"></i></a>


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


</div>

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
        // Ordenación personalizada para fechas en formato dd-mm-yyyy
        $.fn.dataTable.ext.type.order['date-dd-mm-yyyy-pre'] = function(data) {
            if (!data) return 0;
            const cleanData = data.replace(/<[^>]+>/g, ''); // Limpiar etiquetas HTML
            const [day, month, year] = cleanData.split('-').map(Number);
            return new Date(year, month - 1, day).getTime();
        };

        // Configurar DataTables
        $("#example1").DataTable({
            "pageLength": 20,
            "order": [
                [3, 'desc'] // Ordenar por la columna de fecha (columna 3)
            ],
            "columnDefs": [{
                    targets: 0, // Columna del contador
                    orderable: false, // No ordenable
                    searchable: false, // No buscable
                    render: function(data, type, row, meta) {
                        return meta.row + 1; // Contador dinámico
                    }
                },
                {
                    targets: 3, // Columna de fechas
                    type: 'date-dd-mm-yyyy' // Usar el tipo de ordenación personalizado
                }
            ],
            "language": {
                "emptyTable": "No hay información",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ proyectos",
                "infoEmpty": "Mostrando 0 a 0 de 0 proyectos",
                "infoFiltered": "(Filtrado de _MAX_ total proyectos)",
                "lengthMenu": "Mostrar _MENU_ proyectos",
                "loadingRecords": "Cargando...",
                "processing": "Procesando...",
                "search": "Buscador:",
                "zeroRecords": "Sin resultados encontrados",
                "paginate": {
                    "first": "Primero",
                    "last": "Último",
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
                }
            ],
        }).buttons().container().appendTo("#example1_wrapper .col-md-6:eq(0)");
    });
</script>