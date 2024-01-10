<?php
include('../../app/config.php');
include('../../admin/layout/parte1.php');
$id_proyecto = $_GET['id_proyecto'];
include('../../app/controllers/actividad/datos_proyecto.php');
include('../../app/controllers/actividad/listado_tareas.php');
include('../../app/controllers/actividad/tareas_proyecto.php');
include('../../app/controllers/maestros/centros/listado_centros.php');
include('../../app/controllers/maestros/responsables/listado_responsables.php');
include('../../app/controllers/actividad/listado_accionprl.php');

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
                <h3 class="m-0">Proyecto Preventivo: <?php echo $nombre_py ?></h3>
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
                    <div class="col-md-5">
                        <dl>
                            <dt><b class="border-bottom border-primary">Descripción </b></dt>
                            <dd><?php echo $descripcion_py ?></dd>
                        </dl>
                    </div>
                    <div class="col-md-2">
                        <dl>
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
                    </div>

                    </dl>
                    <div class="col-md-1">
                        <dl>
                            <dt><b class="border-bottom border-primary">Fecha Inicio</b></dt>
                            <dd><?php echo $newdate = date("d-m-Y", strtotime($fechainicio_py)) ?></dd>


                        </dl>
                    </div>
                    <div class="col-md-1">
                        <dl>
                            <dt><b class="border-bottom border-primary">Fecha Fin </b></dt>
                            <dd><?php echo $newdate = date("d-m-Y", strtotime($fechafin_py)) ?></dd>

                        </dl>

                    </div>
                    <div class="col-md-2">
                        <dl>
                            <dt><b class="border-bottom border-primary">Responsable</b></dt>
                            <dd><?php echo $responsable_py ?></dd>



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
                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-nuevotrabajador">Añadir Tarea</button>
                </div>

                <!--inicio modal nuevo trabajador-->
                <div class="modal fade" id="modal-nuevotrabajador">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <div class="modal-header" style="background-color:whitesmoke">
                                <h5 class="modal-title" id="modal-nuevtrabajador"><i class="bi bi-plus-lg"></i> Nueva Tarea</h5>
                                <button type="button" class="close" style="color: white;" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">

                                <form action="../../app/controllers/actividad/create_tarea.php" method="post" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Proyecto: <?php echo $nombre_py ?></label>
                                                <input type="text" value="<?php echo $id_proyecto ?>" name="id_proyecto" class="form-control" hidden>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="row">
                                        <div class="col-md-7">
                                            <div class="form-group">
                                                <label for="">Tarea</label>
                                                <input type="text" name="nombre_ta" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
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
                                        <div class="col-md-2">
                                            <label for="">Responsable</label>
                                            <select name="responsable_ta" id="" class="form-control">
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
                                        <div class="col-md-1">
                                            <label for="">Programada</label>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="programada_ta" id="flexRadioDefault1" value="1">
                                                <label class="form-check-label" for="flexRadioDefault1">
                                                    SI
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="programada_ta" id="flexRadioDefault2" value="0" checked>
                                                <label class="form-check-label" for="flexRadioDefault2">
                                                    NO
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <label for="">Prioridad</label>
                                            <select class="form-select form-select" name="prioridad_ta" aria-label=".form-select-sm example">
                                                <option selected>Seleccione</option>
                                                <option value="Baja">BAJA</option>
                                                <option value="Media">MEDIA</option>
                                                <option value="Alta">ALTA</option>
                                            </select>
                                        </div>
                                        <div class="col-md-2">
                                            <label for="">Categoria</label>
                                            <select class="form-select form-select-sm" name="categoria_ta" aria-label=".form-select-sm example">
                                                <option selected>Seleccione</option>
                                                <option value="Documentos">Documentos</option>
                                                <option value="Formación">Formación</option>
                                                <option value="Seguridad">Seguridad</option>
                                                <option value="Higiene">Higiene</option>
                                                <option value="Ergonomia">Ergonomia</option>
                                                <option value="Psicosociologia">Psicosociologia</option>
                                                <option value="Higiene">Higiene</option>
                                            </select>
                                        </div>

                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="">Vencimiento</label>
                                                <input type="date" name="fecha_ta" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="">Estado</label>
                                            <select class="form-select form-select" name="estado_ta" aria-label=".form-select-sm example">
                                                <option selected>Seleccione</option>
                                                <option value="En curso">En curso</option>
                                                <option value="Completado">Completado</option>
                                                <option value="Parcialmente hecho">Parcialmente hecho</option>
                                                <option value="Pospuesto">Pospuesto</option>
                                                <option value="Cancelado">Cancelado</option>

                                            </select>

                                        </div>

                                        <div class="col-md-3">
                                            <label for="">Accion Preventiva </label>
                                            <select name="accionprl_ta" id="" class="form-control">
                                                <?php
                                                foreach ($accionprl_datos as $accionprl_dato) { ?>
                                                    <option value="<?php echo $accionprl_dato['id_accion']; ?>"><?php echo $accionprl_dato['codigo_acc']; ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>


                                        <div class="row">
                                            <div class="form-group">
                                                <label for="">Detalles de tarea</label>
                                                <textarea class="form-control" name="detalles_ta" rows="10"></textarea>
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
                            <col width="7%">
                            <col width="25%">
                            <col width="10%">
                            <col width="5%">
                            <col width="12%">
                            <col width="10%">
                            <col width="7%">
                            <col width="7%">
                            <col width="7%">

                        </colgroup>
                        <thead class="table-secondary">
                            <tr>
                                <th style="text-align: center">#</th>
                                <th style="text-align: left">Estado</th>
                                <th style="text-align: left">Tarea</th>
                                <th style="text-align: left">Centro</th>
                                <th style="text-align: left">Prioridad</th>
                                <th style="text-align: left">Responsable</th>
                                <th style="text-align: left">Categoria</th>
                                <th style="text-align: left">Fecha Venci.</th>
                                <th style="text-align: left">Fecha realiz.</th>

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
                                    <td style="text-align: left"><?php $tarea_proyecto['estado_ta'];
                                                                    if ($tarea_proyecto['estado_ta'] == 'En curso') { ?>
                                            <span class='badge badge-info'>En Curso</span>
                                        <?php
                                                                    } else if ($tarea_proyecto['estado_ta'] == 'Completado') { ?>
                                            <span class='badge badge-success'>Completado</span>
                                        <?php
                                                                    } else if ($tarea_proyecto['estado_ta'] == 'Parcialmente hecho') { ?>
                                            <span class='badge badge-warning'>Parcialmente hecho</span>
                                        <?php
                                                                    } else if ($tarea_proyecto['estado_ta'] == 'Pospuesto') { ?>
                                            <span class='badge badge-secondary'>Pospuesto</span>
                                        <?php
                                                                    } else if ($tarea_proyecto['estado_ta'] == 'Cancelado') { ?>
                                            <span class='badge badge-danger'>Cancelado</span>
                                        <?php
                                                                    }
                                        ?>
                                    </td>
                                    <td style="text-align: left"><b><?php echo $tarea_proyecto['nombre_ta']; ?></b></td>
                                    <td style="text-align: left"><?php echo $tarea_proyecto['nombre_cen']; ?></td>
                                    <td style="text-align: left"><?php echo $tarea_proyecto['prioridad_ta']; ?></td>
                                    <td style="text-align: left"><?php echo $tarea_proyecto['nombre_resp']; ?></td>
                                    <td style="text-align: left"><?php echo $tarea_proyecto['categoria_ta']; ?></td>
                                    <td style="text-align: left"><?php echo $newdate = date("d-m-Y", strtotime($tarea_proyecto['fecha_ta'])) ?></td>
                                    <td style="text-align: left"><?php echo $newdate = date("d-m-Y", strtotime($tarea_proyecto['fechareal_ta'])) ?></td>
                                    



                                    <td style="text-align: center">
                                        <div class="btn-text-right">
                                            <a href="showtareas.php?id_tarea=<?php echo $id_tarea; ?>& id_proyecto=<?php echo $id_proyecto; ?>" class="btn btn-secondary btn-sm btn-font-size" title="Ver detalles"><i class="bi bi-eye"></i> </a>

                                            <!--boton modal-->
                                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" title="Copiar/Duplicar" data-target="#modal-duplicartarea<?php echo $id_tarea; ?>"><i class="bi bi-copy"></i></button>
                                            <?php include('../../app/controllers/actividad/datos_tarea.php'); ?>
                                        </div>
                                        <!--inicio modal nuevo trabajador-->
                                        <div class="modal fade" id="modal-duplicartarea<?php echo $id_tarea; ?>" tabindex="-1" aria-labelledby="exampleModalLabel">
                                            <div class="modal-dialog modal-xl">
                                                <div class="modal-content">
                                                    <div class="modal-header" style="background-color:gold">
                                                        <h5 class="modal-title" id="modal-nuevtrabajador"><i class="bi bi-copy"></i> Copiar / Duplicar Tarea</h5>
                                                        <button type="button" class="close" style="color: white;" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">

                                                        <form action="../../app/controllers/actividad/duplicar_tarea.php" method="post" enctype="multipart/form-data">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="">Proyecto: <?php echo $nombre_py ?></label>
                                                                        <input type="text" value="<?php echo $id_proyecto ?>" name="id_proyecto" class="form-control" hidden>
                                                                    </div>
                                                                </div>
                                                            </div>


                                                            <div class="row">
                                                                <div class="col-md-7">
                                                                    <div class="form-group">
                                                                        <label for="">Tarea</label>
                                                                        <input type="text" value="<?php echo $nombre_ta ?>" name="nombre_ta" class="form-control" required>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <label for="">Centro Trabajo</label>
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
                                                                <div class="col-md-2">
                                                                    <label for="">Responsable</label>
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
                                                            <div class="row">
                                                                <div class="col-md-1">
                                                                    <label for="">Programada</label>
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="radio" name="programada_ta" id="flexRadioDefault1" value="1">
                                                                        <label class="form-check-label" for="flexRadioDefault1">
                                                                            SI
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="radio" name="programada_ta" id="flexRadioDefault2" value="0" checked>
                                                                        <label class="form-check-label" for="flexRadioDefault2">
                                                                            NO
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <label for="">Prioridad</label>
                                                                    <select class="form-select form-select-sm" name="prioridad_ta" aria-label=".form-select-sm example">
                                                                        <option value="<?php echo $prioridad_ta ?>" selected="selected"><?php echo $prioridad_ta ?></option>
                                                                        <option>Seleccione</option>
                                                                        <option value="Baja">BAJA</option>
                                                                        <option value="Media">MEDIA</option>
                                                                        <option value="Alta">ALTA</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-2">
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

                                                                <div class="col-md-2">
                                                                    <div class="form-group">
                                                                        <label for="">Vencimiento</label>
                                                                        <input type="date" name="fecha_ta" class="form-control" required>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
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

                                                                <div class="col-md-3">
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


                                                                <div class="row">
                                                                    <div class="form-group">
                                                                        <label for="">Detalles de tarea</label>
                                                                        <textarea class="form-control" name="detalles_ta" rows="10"></textarea>
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






                                    </td>
                                    </ul>
                </div>
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

</div>






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