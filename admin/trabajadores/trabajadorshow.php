<?php
include('../../app/config.php');
include('../../admin/layout/parte1.php');


include('../../app/controllers/trabajadores/listado_trabajadores.php');
include('../../app/controllers/maestros/centros/listado_centros.php');
include('../../app/controllers/maestros/categorias/listado_categorias.php');
$id_trabajador = $_GET['id_trabajador'];
include('../../app/controllers/trabajadores/trabajador_formacion.php');
include('../../app/controllers/trabajadores/trabajador_reconocimiento.php');

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
                <h5 class="m-0"><b>Trabajadores de la empresa</b></h5>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                    <li class="breadcrumb-item active">Control trabajadores</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>


</html>


<!-- /.content-header -->


<div class="row">
    <div class="col-md-8">
        <div class="card card-outline card-primary">
            <div class="card-header col-md-12">
                <h3 class="card-title"><b>Trabajadores registrados</b></h3>
                <style>
                    .btn-text-right {
                        text-align: right;
                    }
                </style>
                <!--boton modal-->
                <div class="btn-text-right">
                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-nuevotrabajador">Añadir Trabajador</button>
                </div>

                <!--inicio modal nuevo trabajador-->
                <div class="modal fade" id="modal-nuevotrabajador">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <div class="modal-header" style="background-color:#0000a0 ;color:white">
                                <h5 class="modal-title" id="modal-nuevtrabajador">Nuevo Trabajador</h5>
                                <button type="button" class="close" style="color: white;" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">

                                <form action="../../app/controllers/trabajadores/create.php" method="post" enctype="multipart/form-data">



                                    <div class="row">
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="">Codigo</label>
                                                <input type="text" name="codigo_tr" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="">DNI/NIE</label>
                                                <input type="text" name="dni_tr" class="form-control" required>
                                            </div>
                                        </div>


                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label for="">APELLIDOS, NOMBRE</label>
                                                <input type="text" name="nombre_tr" class="form-control" required>
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
                    <table id="example1" class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th style="text-align: center">Num.</th>
                                <th style="text-align: center">Cod.</th>
                                <th style="text-align: center">DNI</th>
                                <th style="text-align: center">Nombre</th>
                                <th style="text-align: center">Fecha Nac.</th>
                                <th style="text-align: center">Inicio</th>
                                <th style="text-align: center">Centro</th>
                                <th style="text-align: center">Categoria</th>
                                <th style="text-align: center">Estado</th>
                                <th style="text-align: center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $contador = 0;
                            foreach ($trabajadores as $trabajador) {
                                $contador = $contador + 1;
                                $id_trabajador = $trabajador['id_trabajador'];
                            ?>

                                <tr>
                                    <td style="text-align: center"><?php echo $contador; ?></td>
                                    <td style="text-align: center"><?php echo $trabajador['codigo_tr']; ?></td>
                                    <td style="text-align: center"><?php echo $trabajador['dni_tr']; ?></td>
                                    <td><?php echo $trabajador['nombre_tr']; ?></td>
                                    <td style="text-align: center"><?php echo $newdate = date("d-m-Y", strtotime($trabajador['fechanac_tr'])) ?></td>
                                    <td style="text-align: center"><?php echo $newdate = date("d-m-Y", strtotime($trabajador['inicio_tr'])) ?></td>
                                    <td><?php echo $trabajador['nombre_cen']; ?></td>
                                    <td><?php echo $trabajador['nombre_cat']; ?></td>
                                    <td style="text-align: center;"><?php $trabajador['activo_tr'];
                                                                    if ($trabajador['activo_tr'] == 1) { ?>
                                            <span class='badge badge-success'>activo</span>
                                        <?php
                                                                    } else { ?>
                                            <span class='badge badge-danger'>inactivo</span>
                                        <?php
                                                                    }
                                        ?>


                                    </td>


                                    <td style="text-align: center">
                                        <div class="d-grid gap-2 d-md-block" role="group" aria-label="Basic mixed styles example">
                                            <a href="trabajadorshow.php?id_trabajador=<?php echo $id_trabajador; ?>" class="btn btn-secondary btn-sm" title="Ver detalles"><i class="bi bi-person-lines-fill"></i></a>
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
    </div>



    <!-- Detalles trabajador-->

    <div class="col-md-4">
        <div class="card card-primary">

            <div class="card-header">
                <h3 class="card-title">Detalles Trabajador :</h3>
            </div>
            <!-- /.card-header -->

            <div class="card">

                <div class="card-body">
                    <strong><i class="fas fa-book mr-1"></i> Formación recibida</strong>

                    <table id="example1" class="table table-sm">
                        <thead>
                            <tr>
                                <th style="text-align: center">Num.</th>
                                <th style="text-align: center">Tipo Form.</th>
                                <th style="text-align: center">Fecha Form.</th>
                                <th style="text-align: center">Fecha Caduc.</th>
                                <th style="text-align: center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $contador = 0;
                            foreach ($trabajador_formaciones as $trabajador_formacion) {
                                $contador = $contador + 1;
                            ?>

                                <tr>
                                    <td style="text-align: center"><?php echo $contador; ?></td>
                                    <td style="text-align: center"><?php echo $trabajador_formacion['nombre_tf']; ?></td>
                                    <td style="text-align: center"><?php echo $newdate = date("d-m-Y", strtotime($trabajador_formacion['fecha_fr'])) ?></td>
                                    <td style="text-align: center"><?php echo $newdate = date("d-m-Y", strtotime($trabajador_formacion['fechacad_fr'])) ?></td>
                                    <td style="text-align: center">
                                        <a href="../formacion/index.php" class="btn btn-primary btn-sm btn-font-size" title="Ver detalles"><i class="bi bi-folder-fill"></i> Ver</a>
                                    </td>
                                <?php
                            }
                                ?>
                        </tbody>
                    </table>
                    <br>


                    <hr>

                    <strong><i class="fas fa-map-marker-alt mr-1"></i> Reconocimientos médicos</strong>

                    <table id="example1" class="table table-sm">
                        <thead>
                            <tr>
                                <th style="text-align: center">Vigente</th>
                                <th style="text-align: center">Fecha</th>
                                <th style="text-align: center">Fecha Caduc.</th>
                                <th style="text-align: center">Citado</th>
                                <th style="text-align: center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($trabajador_reconocimientos as $trabajador_reconocimiento) {
                            ?>

                                <tr>
                                    <td style="text-align: center"><?php $trabajador_reconocimiento['vigente_rm'];
                                                                    if ($trabajador_reconocimiento['vigente_rm'] == 1 and $trabajador_reconocimiento['caducidad_rm'] > $fechahora) { ?>
                                            <span class='badge badge-success'>VIGENTE</span>
                                        <?php
                                                                    } elseif ($trabajador_reconocimiento['vigente_rm'] == 1 and $trabajador_reconocimiento['caducidad_rm'] < $fechahora) { ?>
                                            <span class='badge badge-warning'>VIGENTE - CADUCADO</span>
                                        <?php
                                                                    } else { ?>
                                            <span class='badge badge-danger'>NO VIGENTE</span>
                                        <?php
                                                                    }
                                        ?>
                                    </td>
                                    <td style="text-align: center"><?php echo $newdate = date("d-m-Y", strtotime($trabajador_reconocimiento['fecha_rm'])) ?></td>
                                    <td style="text-align: center"><?php echo $newdate = date("d-m-Y", strtotime($trabajador_reconocimiento['caducidad_rm'])) ?></td>
                                    <td style="text-align: center"><?php echo $trabajador_reconocimiento['cita_rm']; ?></td>
                                    <td style="text-align: center">
                                        <a href="../formacion/index.php" class="btn btn-primary btn-sm btn-font-size" title="Ver detalles"><i class="bi bi-folder-fill"></i> Ver</a>
                                    </td>
                                <?php
                            }
                                ?>
                        </tbody>
                    </table>

                    <hr>

                    <strong><i class="fas fa-pencil-alt mr-1"></i> Accidentes</strong>


                    </table>

                    <hr>

                    <strong><i class="far fa-file-alt mr-1"></i> Notes</strong>

                    <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum enim neque.</p>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
        <!-- /.card -->
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