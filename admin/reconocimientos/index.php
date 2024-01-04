<?php
include('../../app/config.php');
include('../../admin/layout/parte1.php');
include('../../app/controllers/reconocimientos/listado_reconocimientos.php');
include('../../app/controllers/pruebas/listado_trabajadores.php');
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
                <h5 class="m-0"><b>Reconocimientos médicos realizados</b></h5>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                    <li class="breadcrumb-item active">Control reconocimientos médicos</li>
                </ol>
            </div><!-- /.col -->
            <hr>
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>


</html>

<div class="row">
    <div class="col-lg-3 col-6">
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
    <div class="col-lg-3 col-6">
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
    <div class="col-lg-3 col-6">
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
    <div class="col-lg-3 col-6">
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
            <h3 class="card-title"><b>Reconocimientos medicos registrados</b></h3>
            <style>
                .btn-text-right {
                    text-align: right;
                }
            </style>
            <!-- Button trigger modal -->
            <div class="btn-text-right">
                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-nuevoreconocimiento">
                    Nuevo RM
                </button>
            </div>

            <!-- Modal -->
            <form action="../../app/controllers/reconocimientos/create.php" method="post" enctype="multipart/form-data">

                <div class="modal fade" id="modal-nuevoreconocimiento">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <div class="modal-header" style="background-color:#808000 ;color:white">
                                <h5 class="modal-title" id="modal-nuevreconocimiento">Reconocimiento Medico realizado</h5>
                                <button type="button" class="close" style="color: white;" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">Trabajador</label>
                                        <select name="id_trabajador" id="" class="form-control">
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
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Fecha Reconocimiento</label>
                                            <input type="date" name="fecha_rm" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Valido hasta</label>
                                            <input type="date" name="caducidad_rm" class="form-control">
                                        </div>

                                    </div>
                                    <div class="col-md-3">
                                        <br>
                                        <div class="form-check ">
                                            <input class="form-check-input" type="radio" value="1" name="vigente_rm" id="flexRadioDefault1" checked>
                                            <label class="form-check-label" for="flexRadioDefault1">
                                                <b>Vigente</b>
                                            </label>

                                        </div>

                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" value="0" name="vigente_rm" id="flexRadioDefault2">
                                            <label class="form-check-label" for="flexRadioDefault2">
                                                <b>No Vigente</b>
                                            </label>
                                        </div>
                                    </div>
                                    </br>
                                    <hr>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Citado</label>
                                            <input type="date" name="cita_rm" class="form-control">
                                        </div>

                                    </div>

                                </div>
                                <div class="row">
                                    <div class="form-group">
                                        <label for="">Anotaciones / restricciones</label>
                                        <textarea class="form-control" name="anotaciones_rm" rows="6"></textarea>
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
                <colgroup>
                    <col width="5%">
                    <col width="30%">
                    <col width="10%">
                    <col width="10%">
                    <col width="10%">
                    <col width="10%">
                </colgroup>
                <thead>
                    <tr>
                        <th style="text-align: center">Num.</th>
                        <th style="text-align: left">Nombre trab.</th>
                        <th style="text-align: center">Fecha RM.</th>
                        <th style="text-align: center">Fecha caduc.</th>
                        <th style="text-align: center">Vigente</th>
                        <th style="text-align: center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $contador = 0;
                    foreach ($reconocimientos as $reconocimiento) {
                        $contador = $contador + 1;
                        $id_reconocimiento = $reconocimiento['id_reconocimiento'];
                    ?>

                        <tr>
                            <td style="text-align: center"><?php echo $contador; ?></td>
                            <td style="text-align: left"><?php echo $reconocimiento['nombre_tr']; ?></td>
                            <td style="text-align: center"><?php echo $newdate = date("d-m-Y", strtotime($reconocimiento['fecha_rm'])); ?></td>
                            <td style="text-align: center"><?php echo $newdate = date("d-m-Y", strtotime($reconocimiento['caducidad_rm'])) ?></td>
                            <td style="text-align: left;"><?php $reconocimiento['vigente_rm'];
                                                            if ($reconocimiento['vigente_rm'] == 1 and $reconocimiento['caducidad_rm'] > $fechahora) { ?>
                                    <span class='badge badge-success'>VIGENTE</span>
                                <?php
                                                            } elseif ($reconocimiento['vigente_rm'] == 1 and $reconocimiento['caducidad_rm'] < $fechahora) { ?>
                                    <span class='badge badge-warning'>VIGENTE - CADUCADO</span>
                                <?php
                                                            } else { ?>
                                    <span class='badge badge-danger'>NO VIGENTE</span>
                                <?php
                                                            }
                                ?>


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
            "pageLength": 10,
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