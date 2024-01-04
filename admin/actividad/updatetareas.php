<?php
include('../../app/config.php');
include('../../admin/layout/parte1.php');
$id_tarea = $_GET['id_tarea'];
$id_proyecto = $_GET['id_proyecto'];
$id_proyecto1 = $_GET['id_proyecto'];
include('../../app/controllers/actividad/datos_tarea.php');
include('../../app/controllers/actividad/listado_tareas.php');
include('../../app/controllers/actividad/listado_actividades.php');
include('../../app/controllers/actividad/listado_accionprl.php');
include('../../app/controllers/actividad/listado_proyectos.php');
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
                <h3 class="m-0">Tarea</h3>
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


<!-- /.content-header -->
<div class="col-lg-12">
    <div class="row">
        <div class="callout callout-info">

            <div class="col-md-12">
                <form action="../../app/controllers/actividad/update_tarea.php" method="post">

                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Tarea <b>*</b></label>
                                <input type="text" name="nombre_ta" value="<?php echo $nombre_ta; ?>" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="">Centro <b>*</b></label>
                                <select name="centro_ta" id="" class="form-control">
                                    <?php
                                    foreach ($centros_datos as $centro_dato) {
                                        $centro_tabla = $centro_dato['nombre_cen'];
                                        $id_centro = $centro_dato['id_centro']; ?>
                                        <option value="<?php echo $id_centro; ?>" <?php if ($centro_tabla == $centro_ta) { ?> selected="selected" <?php } ?>>
                                            <?php echo  $centro_tabla; ?>
                                        </option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="">Responsable <b>*</b></label>
                                <select name="responsable_ta" id="" class="form-control">
                                    <?php
                                    foreach ($responsables_datos as $responsable_dato) {
                                        $responsable_tabla = $responsable_dato['nombre_resp'];
                                        $id_responsable = $responsable_dato['id_responsable']; ?>
                                        <option value="<?php echo $id_responsable; ?>" <?php if ($responsable_tabla == $responsable_ta) { ?> selected="selected" <?php } ?>>
                                            <?php echo  $responsable_tabla; ?>
                                        </option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-1">
                            <div class="form-group">
                                <label for="">Fecha Vencimiento </label>
                                <input type="date" name="fecha_ta" value="<?php echo $fecha_ta ?>" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-1">
                            <div class="form-group">
                                <label for="">Realizada </label>
                                <input type="date" name="fechareal_ta" value="<?php echo $fechareal_ta ?>" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="">Proyecto <b>*</b></label>
                                <select name="id_proyecto" id="" class="form-control">
                                    <?php
                                    foreach ($proyectos as $proyecto) {
                                        $proyecto_tabla = $proyecto['nombre_py'];
                                        $id_proyecto = $proyecto['id_proyecto']; ?>
                                        <option value="<?php echo $id_proyecto; ?>" <?php if ($proyecto_tabla == $id_proyecto) { ?> selected="selected" <?php } ?>>
                                            <?php echo  $proyecto_tabla; ?>
                                        </option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-1">
                            <div class="form-group">
                                <label for="">Progrmada <b>*</b></label>
                                <input type="text" name="programada_ta" value="<?php echo $programada_ta; ?>" class="form-control" required>
                            </div>
                            <!--<select class="form-select form-select-sm" name="prioridad_ta" aria-label=".form-select-sm example">
                                    <option value="<?php $programada_ta ?>" selected="selected"><?php $programada_ta;
                                                                                                if ($programada_ta == '1') { ?>
                                        <span class='badge badge-success'>Si</span>
                                    <?php
                                                                                                } else { ?>
                                        <span class='badge badge-warning'>No</span>
                                    <?php
                                                                                                }
                                    ?></option>
                                    <option>Seleccione</option>
                                    <option value="1">Si</option>
                                    <option value="0">No</option>
                                </select>-->
                        </div>
                        <div class="row">

                            <div class="col-md-1">
                                <label for="">Prioridad</label>
                                <select class="form-select form-select-sm" name="prioridad_ta" aria-label=".form-select-sm example">
                                    <option value="<?php echo $prioridad_ta ?>" selected="selected"><?php echo $prioridad_ta ?></option>
                                    <option>Seleccione</option>
                                    <option value="Baja">BAJA</option>
                                    <option value="Media">MEDIA</option>
                                    <option value="Alta">ALTA</option>
                                </select>
                            </div>

                            <div class="col-md-1">
                                <label for="">Categoria</label>
                                <select class="form-select form-select-sm" name="categoria_ta" aria-label=".form-select-sm example">
                                    <option value="<?php echo $categoria_ta ?>" selected="selected"><?php echo $categoria_ta ?></option>
                                    <option>Seleccione</option>
                                    <option value="Documentos">Documentos</option>
                                    <option value="Formación">Formación</option>
                                    <option value="Seguridad">Seguridad</option>
                                    <option value="Higiene">Higiene</option>
                                    <option value="Ergonomia">Ergonomia</option>
                                    <option value="Psicosociologia">Psicosociologia</option>
                                    <option value="Higiene">Higiene</option>
                                </select>
                            </div>

                            <div class="col-md-1">
                                <label for="">Estado</label>
                                <select class="form-select form-select-sm" name="estado_ta" aria-label=".form-select-sm example">
                                    <option value="<?php echo $estado_ta ?>" selected="selected"><?php echo $estado_ta ?></option>
                                    <option value>Seleccione</option>
                                    <option value="En curso">En curso</option>
                                    <option value="Completado">Completado</option>
                                    <option value="Parcialmente hecho">Parcialmente hecho</option>
                                    <option value="Pospuesto">Pospuesto</option>
                                    <option value="Cancelado">Cancelado</option>

                                </select>
                            </div>
                        

                            <div class="col-md-2">
                                <label for="">Accion Preventiva </label>
                                <select class="form-select form-select-sm" name="accionprl_ta" id="" class="form-control">
                                    <?php
                                    foreach ($accionprl_datos as $accionprl_dato) {
                                        $accionprl_tabla = $accionprl_dato['codigo_acc'];
                                        $id_accion = $accionprl_dato['id_accion']; ?>
                                        <option value="<?php echo $id_accion; ?>" <?php if ($accionprl_tabla == $accionprl_ta) { ?> selected="selected" <?php } ?>>
                                            <?php echo  $accionprl_tabla; ?>
                                        </option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="col-md-7">

                                <div class="form-group">
                                    <label for="">Detalles de tarea</label>
                                    <input type="textarea" name="detalles_ta" value="<?php echo $detalles_ta; ?>" class="form-control">

                                </div>


                            </div>
                        </div>

                        <input type="text" name="id_tarea" value="<?php echo $id_tarea; ?>" hidden>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <a href="show.php?id_proyecto=<?php echo $id_proyecto1 ?>" class="btn btn-secondary" role="button">Cancelar</a>
                                <input type="submit" class="btn btn-warning" value="Actualizar datos">
                                <button type="button" class="btn btn-primary btn-sm" href="show.php?id_proyecto=<?php echo $id_proyecto1 ?>">Añadir progreso</button>

                            </div>
                        </div>

                    </div>
                </form>

            </div>


        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card card-outline card-primary">
            <div class="card-header col-md-12">
                <h3 class="card-title"><b>Progreso Tarea</b></h3>
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
                <div class="modal fade" id="modal-nuevaactividad">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <div class="modal-header" style="background-color:#eeeeee ;color:black">
                                <h5 class="modal-title" id="modal-nuevaactividad">Nueva actividad de la tarea - <?php echo $nombre_ta ?></h5>
                                <button type="button" class="close" style="color: white;" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">

                                <form action="../../app/controllers/actividad/create_actividad.php" method="post" enctype="multipart/form-data">



                                    <div class="row">
                                        <div class="col-md-6">
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

                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                <button type="submit" class="btn btn-primary"><i class="bi bi-floppy"></i> Guardar</button>

                            </div>
                        </div>
                    </div>

                </div>

                <!--fin modal-->

                <!--inicio modal nueva actividad de tarea-->
                <div class="modal fade" id="modal-nuevaactividad">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <div class="modal-header" style="background-color:#eeeeee ;color:black">
                                <h5 class="modal-title" id="modal-nuevaactividad">Nueva actividad de la tarea - <?php echo $nombre_ta ?></h5>
                                <button type="button" class="close" style="color: white;" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">

                                <form action="../../app/controllers/actividad/create_actividad.php" method="post" enctype="multipart/form-data">



                                    <div class="row">
                                        <div class="col-md-6">
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
                        <col width="15%">
                        <col width="10%">
                        <col width="10%">
                        <col width="20%">
                        <col width="40%">
                        <col width="20%">


                    </colgroup>
                    <thead class="table-secondary">
                        <tr>
                            <th style="text-align: center">#</th>
                            <th style="text-align: left">Fecha</th>
                            <th style="text-align: left">Inicio</th>
                            <th style="text-align: left">Fin</th>
                            <th style="text-align: left">Responsable</th>
                            <th style="text-align: left">Detalles</th>
                            <th style="text-align: center"></th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        $contador = 0;

                        foreach ($actividades as $actividad) {
                            $contador = $contador + 1;

                        ?>

                            <tr>
                                <td style="text-align: center"><b><?php echo $contador; ?></b></td>
                                <td style="text-align: left"><b><?php echo $newdate = date("d-m-Y", strtotime($actividad['fecha_acc'])) ?></b></td>
                                <td style="text-align: left"><?php echo $actividad['horain_acc']; ?></td>
                                <td style="text-align: left"><?php echo $actividad['horafin_acc']; ?></td>
                                <td style="text-align: left"><?php echo $actividad['responsable_acc']; ?></td>
                                <td style="text-align: left"><?php echo $actividad['detalles_acc']; ?></td>
                                </td>


                                <td style="text-align: center">
                                    <div class="dropdown">
                                        <button class="btn btn-secondary btn-sm dropdown-toggle dropdown-font-size" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
                                            Opciones
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-dark dropdown-font-size" aria-labelledby="dropdownMenuButton2">
                                            <li><a class="dropdown-item" href="#">Ver</a></li>
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
</script>