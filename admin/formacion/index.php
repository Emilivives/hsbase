<?php
include('../../app/config.php');
include('../../admin/layout/parte1.php');
include('../../app/controllers/formaciones/listado_formaciones.php');
include('../../app/controllers/pruebas/listado_trabajadores.php');
include('../../app/controllers/formaciones/tipoformacion/listado_tipoformaciones.php');
?>
<html>
<!-- Font Awesome -->
<link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
<!-- Ionicons -->
<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h5 class="m-0"><b>Formaciones Realizadas</b></h5>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                    <li class="breadcrumb-item active">Control formaciones</li>
                </ol>
            </div><!-- /.col -->
            <hr>
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>


</html>

<div class="row">
    <div class="col-lg-2 col-6">
        <!-- small box -->
        <div class="small-box bg-info">
            <div class="inner">
                <h3>150</h3>

                <p>New Orders</p>
            </div>
            <div class="icon">
                <i class="ion ion-bag"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-2 col-6">
        <!-- small box -->
        <div class="small-box bg-success">
            <div class="inner">
                <h3>53<sup style="font-size: 20px">%</sup></h3>

                <p>Bounce Rate</p>
            </div>
            <div class="icon">
                <i class="ion ion-stats-bars"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-2 col-6">
        <!-- small box -->
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>44</h3>

                <p>User Registrations</p>
            </div>
            <div class="icon">
                <i class="ion ion-person-add"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-2 col-6">
        <!-- small box -->
        <div class="small-box bg-danger">
            <div class="inner">
                <h3>65</h3>

                <p>Unique Visitors</p>
            </div>
            <div class="icon">
                <i class="ion ion-pie-graph"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
</div>
<!-- /.content-header -->


<div class="col-md-8">
    <div class="card card-outline card-primary">
        <div class="card-header col-md-12">
            <h3 class="card-title"><b>Trabajadores registrados</b></h3>
            <style>
                .btn-text-right {
                    text-align: right;
                }
            </style>
            <!-- Button trigger modal -->
            <div class="btn-text-right">
                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-nuevaformacion">
                    Nueva formación
                </button>
            </div>

            <!-- Modal -->
            <form action="../../../app/controllers/formaciones/create.php" method="post" enctype="multipart/form-data">

                <div class="modal fade" id="modal-nuevaformacion">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <div class="modal-header" style="background-color:#808000 ;color:white">
                                <h5 class="modal-title" id="modal-nuevaformacion">Formación realizada</h5>
                                <button type="button" class="close" style="color: white;" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">Formación</label>
                                        <select name="tipo_fr" id="" class="form-control">
                                            <?php
                                            foreach ($tipoformaciones_datos as $tipoformaciones_dato) { ?>
                                                <option value="<?php echo $tipoformaciones_dato['id_tipoformacion']; ?>"><?php echo $tipoformaciones_dato['nombre_tf']; ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">Trabajadores</label>
                                        <select name="trabajador_fr" id="" class="form-control">
                                            <?php
                                            foreach ($trabajadores as $trabajador) { ?>
                                                <option value="<?php echo $trabajador['id_trabajador']; ?>"><?php echo $trabajador['nombre_tr']; ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="">Fecha Formacion</label>
                                            <input type="date" value="<?php echo $formacion['fecha_fr']; ?>" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="">Valido hasta</label>
                                            <input type="date" value="<?php echo $formacion['fechacad_fr']; ?>" class="form-control">
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
            <table id="example1" class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th style="text-align: center">Num.</th>
                        <th style="text-align: center">Tipo Form.</th>
                        <th style="text-align: center">Nombre trab.</th>
                        <th style="text-align: center">Fecha Form.</th>
                        <th style="text-align: center">Fecha Caduc.</th>
                        <th style="text-align: center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $contador = 0;
                    foreach ($formaciones as $formacion) {
                        $contador = $contador + 1;
                        $id_formacion = $formacion['id_formacion'];
                    ?>

                        <tr>
                            <td style="text-align: center"><?php echo $contador; ?></td>
                            <td>
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-link" data-toggle="modal" data-target="#modal-tipoformacion<?php echo $id_formacion; ?>">
                                    <?php echo $formacion['nombre_tf']; ?>
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="modal-tipoformacion<?php echo $id_formacion; ?>">
                                    <div class="modal-dialog modal-xl">
                                        <div class="modal-content">
                                            <div class="modal-header" style="background-color:#808000 ;color:white">
                                                <h5 class="modal-title" id="modal-tipoformacion<?php echo $formacion['nombre_tf']; ?>">Tipo de Formación</h5>
                                                <button type="button" class="close" style="color: white;" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">

                                                <div class="row">
                                                    <div class="col-md-9">
                                                        <div class="form-group">
                                                            <label for="">Nombre formación</label>
                                                            <input type="text" value="<?php echo $formacion['nombre_tf']; ?>" class="form-control" disabled>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <label for="">Duracion</label>
                                                            <input type="text" value="<?php echo $formacion['duracion_tf']; ?>" class="form-control" disabled>hrs.
                                                        </div>

                                                    </div>
                                                    <div class="col-md-1">
                                                        <div class="form-group">
                                                            <label for="">Validez</label>
                                                            <input type="text" value="<?php echo $formacion['validez_tf']; ?>" class="form-control" disabled>
                                                        </div>

                                                    </div>
                                                    <div class="col-md-12">
                                                        <label for="">Contenido formación</label>
                                                        <textarea class="form-control" id="<?php echo $formacion['detalles_tf']; ?>" name="$id_formacion" rows="20" disabled><?php echo $formacion['detalles_tf']; ?></textarea>

                                                    </div>
                                                </div>


                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>



                                <!--fin modal-->


                            </td>
                            <td style="text-align: center"><?php echo $formacion['nombre_tr']; ?></td>
                            <td style="text-align: center"><?php echo $formacion['fecha_fr']; ?></td>
                            <td style="text-align: center"><?php echo $formacion['fechacad_fr']; ?></td>

                            </td>


                            <td style="text-align: center">
                                <div class="d-grid gap-2 d-md-block" role="group" aria-label="Basic mixed styles example">
                                    <a href="show.php?id_usuario=<?php echo $id_usuario; ?>" class="btn btn-secondary btn-sm" title="Ver detalles"><i class="bi bi-person-lines-fill"></i></a>
                                    <a href="update.php?id_usuario=<?php echo $id_usuario ?>" class="btn btn-warning btn-sm" title="Editar"><i class="bi bi-pencil-square"></i></a>
                                    <a href="delete.php?id_usuario=<?php echo $id_usuario ?>" class="btn btn-danger btn-sm" title="Eliminar"><i class="bi bi-trash3-fill"></i></a>

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