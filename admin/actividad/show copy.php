<?php
include('../../app/config.php');
include('../../admin/layout/parte1.php');
$id_proyecto = $_GET['id_proyecto'];
include('../../app/controllers/actividad/datos_proyecto.php');
include('../../app/controllers/actividad/datos_tarea.php');
include('../../app/controllers/actividad/listado_tareas.php');
include('../../app/controllers/actividad/tareas_proyecto.php');
include('../../app/controllers/maestros/centros/listado_centros.php');
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


<!-- /.content-header -->
<div class="col-lg-12">
    <div class="row">
        <div class="callout callout-info">

            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-6">
                        <dl>
                            <dt><b class="border-bottom border-primary">Nombre Proyecto </b></dt>
                            <dd><?php echo $nombre_py ?></dd>
                            <dt><b class="border-bottom border-primary">Descripción </b></dt>
                            <dd><?php echo $descripcion_py ?></dd>
                        </dl>
                    </div>

                    <div class="col-md-2">
                        <dl>
                            <dt><b class="border-bottom border-primary">Fecha Inicio</b></dt>
                            <dd><?php echo $fechainicio_py ?></dd>
                            <dt><b class="border-bottom border-primary">Fecha Fin </b></dt>
                            <dd><?php echo $fechafin_py ?></dd>

                        </dl>

                    </div>
                    <div class="col-md-4">
                        <dl>
                            <dt><b class="border-bottom border-primary">Responsable</b></dt>
                            <dd><?php echo $responsable_py ?></dd>
                            <dt><b class="border-bottom border-primary">Estado </b></dt>

                            <dd><?php $estado_py;
                                if ($estado_py == 1) { ?>
                                    <span class='badge badge-success'>ACTIVO</span>
                                <?php
                                } else { ?>
                                    <span class='badge badge-danger'>FINALIZADO</span>
                                <?php
                                }
                                ?>
                            </dd>
                        </dl>
                    </div>

                </div>

            </div>

        </div>


    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card card-outline card-primary">
            <div class="card-header col-md-12">
                <h3 class="card-title"><b>Tareas</b></h3>
                <style>
                    .btn-text-right {
                        text-align: right;
                    }
                </style>
                <!--boton modal-->
                <div class="btn-text-right">
                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-nuevatarea">Añadir Tarea</button>
                </div>

                <!--inicio modal nuevo trabajador-->
                <div class="modal fade" id="modal-nuevatarea">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <div class="modal-header" style="background-color:#0000a0 ;color:white">
                                <h5 class="modal-title" id="modal-nuevtrabajador">Nueva tarea</h5>
                                <button type="button" class="close" style="color: white;" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">

                                <form action="../../app/controllers/actividad/create_tarea.php" method="post" enctype="multipart/form-data">


                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="">Nombre Proyecto </label>
                                                    <input type="text" value="<?php echo $nombre_py ?>" name="nombre_usr" class="form-control" disabled>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label for="">Tarea</label>
                                                <input type="text" name="codigo_tr" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label for="">Centro Trabajo</label>
                                                <select name="centro_ta" id="" class="form-control">
                                                    <?php
                                                    foreach ($centros_datos as $centros_dato) { ?>
                                                        <option value="<?php echo $centros_dato['id_centro']; ?>"><?php echo $centros_dato['nombre_cen']; ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-md-2">
                                        <select class="form-select" multiple aria-label="multiple select example">
                                            <option selected>Seleccione</option>
                                            <option value="1">BAJA</option>
                                            <option value="2">MEDIA</option>
                                            <option value="3">ALTA</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="">Responsable</label>
                                                <select name="responsable_ta" id="" class="form-control">
                                                    <?php
                                                    foreach ($responsable_datos as $responsable_dato) { ?>
                                                        <option value="<?php echo $responsable_dato['id_responsable']; ?>"><?php echo $responsable_dato['nombre_resp']; ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
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

                        </div>

                        <div class="row">
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="">Centro Trabajo</label>
                                    <select name="centro_tr" id="" class="form-control">
                                        <?php
                                        foreach ($centros_datos as $centros_dato) { ?>
                                            <option value="<?php echo $centros_dato['id_centro']; ?>"><?php echo $centros_dato['nombre_cen']; ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="">Categoria</label>
                                    <select name="categoria_tr" id="" class="form-control">
                                        <?php
                                        foreach ($categorias_datos as $categorias_dato) { ?>
                                            <option value="<?php echo $categorias_dato['id_categoria']; ?>"><?php echo $categorias_dato['nombre_cat']; ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
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
            <table id="example1" class="table tabe-hover table-condensed">
                <colgroup>
                    <col width="5%">
                    <col width="25%">
                    <col width="10%">
                    <col width="5%">
                    <col width="12%">
                    <col width="10%">
                    <col width="7%">
                    <col width="7%">
                    <col width="7%">
                    <col width="7%">

                </colgroup>
                <thead class="table-secondary">
                    <tr>
                        <th style="text-align: center">#</th>
                        <th style="text-align: left">Tarea</th>
                        <th style="text-align: left">Centro</th>
                        <th style="text-align: left">Prioridad</th>
                        <th style="text-align: left">Responsable</th>
                        <th style="text-align: left">Categoria</th>
                        <th style="text-align: left">Fecha Vencim.</th>
                        <th style="text-align: left">Fecha realiz.</th>
                        <th style="text-align: left">Estado</th>
                        <th style="text-align: center"></th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    $contador = 0;

                    foreach ($tareas_proyectos as $tarea_proyecto) {
                        $contador = $contador + 1;
                        $id_tarea = $tarea_proyecto['id_tarea']
                    ?>

                        <tr>
                            <td style="text-align: center"><b><?php echo $contador; ?></b></td>
                            <td style="text-align: left"><b><?php echo $tarea_proyecto['nombre_ta']; ?></b></td>
                            <td style="text-align: left"><?php echo $tarea_proyecto['nombre_cen']; ?></td>
                            <td style="text-align: left"><?php echo $tarea_proyecto['prioridad_ta']; ?></td>
                            <td style="text-align: left"><?php echo $tarea_proyecto['nombre_resp']; ?></td>
                            <td style="text-align: left"><?php echo $tarea_proyecto['categoria_ta']; ?></td>
                            <td style="text-align: left"><?php echo $tarea_proyecto['fecha_ta']; ?></td>
                            <td style="text-align: left"><?php echo $tarea_proyecto['fechareal_ta']; ?></td>
                            <td style="text-align: left"><?php $tarea_proyecto['estado_ta'];
                                                            if ($tarea_proyecto['estado_ta'] = 'En curso') { ?>
                                    <span class='badge badge-warning'>En Curso</span>
                                <?php
                                                            } else { ?>
                                    <span class='badge badge-success'>Finalizado</span>
                                <?php
                                                            }

                                ?>
                            </td>



                            <td style="text-align: center">

                                <div class="dropdown">

                                    <button class="btn btn-secondary btn-sm dropdown-toggle dropdown-font-size" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
                                        Opciones
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-dark dropdown-font-size" aria-labelledby="dropdownMenuButton2">
                                        <li></i><a class="dropdown-item" href="showtareas.php?id_tarea=<?php echo $id_tarea; ?>">Ver</a></li>
                                        <li><a class="dropdown-item" href="#">Editar</a></li>
                                        <li>
                                            <hr class="dropdown-divider">
                                        </li>
                                        <li><a class="dropdown-item" href="#">Eliminar</a></li>
                                    </ul>
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
        $("#example1").DataTable({
            "pageLength": 5,
            "language": {
                "emptyTable": "No hay información",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ Usuarios",
                "infoEmpty": "Mostrando 0 a 0 de 0 Usuarios",
                "infoFiltered": "(Filtrado de MAX total Usuarios)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_ Usuarios",
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
</script>