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
$id_tarea = $_GET['id_tarea'];
$id_proyecto1 = $_GET['id_proyecto'];
include('../../app/controllers/actividad/datos_tarea.php');
include('../../app/controllers/actividad/listado_tareas.php');
include('../../app/controllers/actividad/listado_actividades.php');


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
                <h3 class="m-0">Tarea: <?php echo $nombre_ta ?></h3>
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
                <div class="row">
                    <div class="col-md-3">
                        <dl>
                            <dt><b class="border-bottom border-primary">Tarea </b></dt>
                            <dd><?php echo $nombre_ta ?></dd>
                            <dt><b class="border-bottom border-primary">Centro </b></dt>
                            <dd><?php echo $centro_ta ?></dd>
                        </dl>
                    </div>
                    <div class="col-md-2">
                        <dl>
                            <dt><b class="border-bottom border-primary">Responsable</b></dt>
                            <dd><?php echo $responsable_ta ?></dd>
                            <dt><b class="border-bottom border-primary">Categoria </b></dt>
                            <dd><?php echo $categoria_ta ?></dd>
                            </dd>
                        </dl>
                    </div>
                    <div class="col-md-2">
                        <dl>
                            <dt><b class="border-bottom border-primary">Fecha Vencimiento</b></dt>
                            <dd><?php echo $newdate = date("d-m-Y", strtotime($fecha_ta)) ?></dd>
                            <dt><b class="border-bottom border-primary">Fecha Realizada </b></dt>
                            <dd><?php echo $newdate = date("d-m-Y", strtotime($fechareal_ta)) ?></dd>

                        </dl>

                    </div>
                    <div class="col-md-1">
                        <dl>
                            <dt><b class="border-bottom border-primary">Estado </b></dt>
                            <dd><?php $estado_ta;
                                if ($estado_ta == 'En curso') { ?>
                                    <span class='badge badge-info'>En Curso</span>
                                <?php
                                } else if ($estado_ta == 'Completado') { ?>
                                    <span class='badge badge-success'>Completado</span>
                                <?php
                                } else if ($estado_ta == 'Parcialmente hecho') { ?>
                                    <span class='badge badge-warning'>Parcialmente hecho</span>
                                <?php
                                } else if ($estado_ta == 'Pospuesto') { ?>
                                    <span class='badge badge-secondary'>Pospuesto</span>
                                <?php
                                } else if ($estado_ta == 'Cancelado') { ?>
                                    <span class='badge badge-danger'>Cancelado</span>
                                <?php
                                }
                                ?>

                            </dd>
                            <dt><b class="border-bottom border-primary">Prioridad</b></dt>
                            <dd><?php $prioridad_ta;
                                if ($prioridad_ta == 'Alta') { ?>
                                    <span class='badge badge-warning'>ALTA</span>
                                <?php
                                } else if ($prioridad_ta == 'Media') { ?>
                                    <span class='badge badge-primary'>MEDIA</span>
                                <?php
                                } else { ?>
                                    <span class='badge badge-secondary'>BAJA</span>
                                <?php
                                }
                                ?>
                            </dd>
                        </dl>
                    </div>
                    <div class="col-md-3">
                        <dl>
                            <dt><b class="border-bottom border-primary">Programada</b></dt>
                            <dd><?php $programada_ta;
                                if ($programada_ta == '1') { ?>
                                    <span class='badge badge-success'>Si</span>
                                <?php
                                } else { ?>
                                    <span class='badge badge-warning'>No</span>
                                <?php
                                }
                                ?>
                            </dd>
                            <dt><b class="border-bottom border-primary">Acción preventiva </b></dt>
                            <dd><?php echo $accionprl_ta ?></dd>

                        </dl>
                    </div>
                    <div class="col-md-1">

                       <div class="row">
                            <button type="button" class="btn btn-outline-warning btn-sm"><a href="updatetareas.php?id_tarea=<?php echo $id_tarea ?>&id_proyecto=<?php echo $id_proyecto1 ?>">Editar</a></button>
                        </div>
						<br>
                        <div class="row">
                            <button type="button" class="btn btn-outline-primary btn-sm"><a href="show.php?id_proyecto=<?php echo $id_proyecto1 ?>"><i class="bi bi-box-arrow-right"></i> Volver</a></button>
							   
                        </div>

                    </div>

                </div>
                <div class="col-md-12">
                    <dl>

                        <dt><b class="border-bottom border-primary">Detalles</b></dt>
                        <dd><?php echo $detalles_ta ?></dd>


                    </dl>
                </div>
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
                            <form action="../../app/controllers/actividad/create_actividad.php" method="post" enctype="multipart/form-data">
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Tarea: <?php echo $id_tarea ?></label>
                                                <input type="text" value="<?php echo $id_tarea ?>" name="id_tarea" class="form-control" hidden>
												 
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Proyecto: <?php echo $id_proyecto ?></label>
                                                <input type="text" value="<?php echo $id_proyecto1 ?>" name="id_proyecto" class="form-control" hidden>
                                            </div>
                                        </div>
                                    </div>





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
                            </form>
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
                        $id_proyecto = $id_proyecto1;
                        foreach ($actividades as $actividad) {
                            $contador = $contador + 1;
                            $id_actividad = $actividad['id_actividad'];
                         
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
                                    <div class="d-grid gap-2 d-md-block" role="group" aria-label="Basic mixed styles example">
                                                                              <a href="../../app/controllers/actividad/delete_actividad.php?id_actividad=<?php echo $id_actividad;?>& id_tarea=<?php echo $id_tarea; ?>& id_proyecto=<?php echo $id_proyecto; ?>" class="btn btn-danger btn-sm btn-font-size" onclick="return confirm('¿Realmente desea eliminar el registro?')" title="Eliminar actividad"><i class="bi bi-trash-fill"></i> </a>
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