<?php
include('../../app/config.php');
include('../../admin/layout/parte1.php');
include('../../app/controllers/formaciones/tipoformacion/listado_tipoformaciones.php');
?>
<br>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h5 class="m-0"><b>LISTADO DE FORMACIONES</b></h5>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                    <li class="breadcrumb-item"><a href="#">Formaciones</a></li>
                    <li class="breadcrumb-item active">Listado formaciones</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>

<div class="container-fluid">


    <div class="row">

        <div class="col-md-12">
            <div class="card card-outline card-primary">
                <div class="card-header col-md-12">
                    <h3 class="card-title"><b>Formaciones registradas</b></h3>
                    <style>
                        .btn-text-right {
                            text-align: right;
                        }
                    </style>
                    <div class="btn-text-right">
                        <a href="" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#nuevotipoformacion"><i class="bi bi-plus-circle"></i> Añadir tipo formacion</a>
                    </div>
                    <div class="modal fade" id="nuevotipoformacion" tabindex="-1" aria-labelledby="nuevotipoformacion" aria-hidden="true">
                        <div class="modal-dialog modal-xl">
                            <div class="modal-content">
                                <div class="modal-header bg-success-subtle text-center">
                                    <h3 class="modal-title w-100 text-center" id="nuevoModalLabel">NUEVA FORMACION</h3>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <!--cuerpo del modal-->
                                    <form action="../../app/controllers/formaciones/tipoformacion/create.php" method="post" enctype="multipart/form-data">

                                        <div class="row">
                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <label for="">Nombre de la formación <b>*</b></label>
                                                    <input type="text" name="nombre_tf" class="form-control" required>
                                                </div>
                                                <br>

                                            </div>

                                        </div>
                                        <div class="row">
                                              <div class="col-sm-5">
                                                <div class="form-group row">
                                                    <label for="nombre" class="col-form-label col-sm-5">Duracion (hrs): *</label>
                                                    <div class="col-sm-2">
                                                        <input type="text" class="form-control" name="duracion_tf" id="" value="" placeholder="" tabindex="1" required>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="col-sm-5">
                                                <div class="form-group row">
                                                    <label for="nombre" class="col-form-label col-sm-5">Validez (años): *</label>
                                                    <div class="col-sm-2">
                                                        <input type="text" class="form-control" name="validez_tf" id="" value="" placeholder="" tabindex="1" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
										<hr>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group row">
                                                    <label for="normativa_tf" class="col-form-label col-sm-2">Normativa aplicada:</label>
                                                    <div class="col-sm-12">
                                                        <textarea class="form-control" name="normativa_tf" value="" rows="2" required></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group row">
                                                    <label for="descripcion_acc" class="col-form-label col-sm-2">Contenido formación:</label>
                                                    <div class="col-sm-12">
                                                        <textarea class="form-control" name="detalles_tf" value="" rows="10" required></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <hr>
                                        <div class="">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                            <button type="submit" class="btn btn-primary"><i class="bi bi-floppy"></i> Guardar</button>
                                        </div>

                                    </form>
                                    <!-- Pie del Modal -->

                                </div>

                            </div>
                        </div>
                    </div>

                </div>
                <div class="card-body">
                    <table id="example1" class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th style="text-align: center">Num.</th>
                                <th style="text-align: center">Nombre Formacion</th>
                                <th style="text-align: center">Duracion Formacion</th>
                                <th style="text-align: center">Años validez</th>
                                <th style="text-align: center">Contenido</th>
                                <th style="text-align: center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $contador = 0;
                            foreach ($tipoformaciones_datos as $tipoformaciones_dato) {
                                $contador = $contador + 1;
                                $id_tipoformacion = $tipoformaciones_dato['id_tipoformacion'];
                            ?>
                                <tr>
                                    <td><?php echo $contador; ?></td>
                                    <td><?php echo $tipoformaciones_dato['nombre_tf']; ?></td>
                                    <td><?php echo $tipoformaciones_dato['duracion_tf']; ?></td>
                                    <td><?php echo $tipoformaciones_dato['validez_tf']; ?></td>
                                    <td><?php echo $tipoformaciones_dato['detalles_tf']; ?></td>
                                    <td style="text-align: center">
                                        <div class="d-grid gap-2 d-md-block" role="group" aria-label="Basic mixed styles example">
                                            <a href="update.php?id_perfil=<?php echo $id_perfil; ?>" class="btn btn-warning btn-sm"><i class="bi bi-pencil-square"></i> Editar</a>
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
                "infoEmpty": "Mostrando 0 a 0 de 0 Perfiles",
                "infoFiltered": "(Filtrado de MAX total Perfiles)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_ Perfiles",
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