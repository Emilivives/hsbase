<?php
include('../../app/config.php');

$id_trabajador = $_GET['id_trabajador'];

include('../../admin/layout/parte1.php');
include('../../app/controllers/maestros/centros/listado_centros.php');
include('../../app/controllers/maestros/categorias/listado_categorias.php');

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

<div class="row">
    <div class="col-md-4">
        <?php include('../../app/controllers/trabajadores/datos_trabajador.php'); ?>
        <div class="card card-outline card-danger">
            <div class="card-header col-md-12">
                <h3 class="card-title"><b>Detalles trabajador: <?php echo $trabajador['nombre_tr'] ?></b></h3>
                <style>
                    .btn-text-right {
                        text-align: right;
                    }
                </style>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">DNI/NIE</label>
                            <input type="text" value="<?php echo $trabajador['dni_tr'] ?>" name="dni_tr" class="form-control" disabled>
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">Fecha Nacimiento</label>
                            <input type="date" value="<?php echo $trabajador['fechanac_tr'] ?>" name="fechanac_tr" class="form-control" disabled>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">Fecha Inicio</label>
                            <input type="date" value="<?php echo $trabajador['inicio_tr'] ?>" name="inicio_tr" class="form-control" disabled>
                        </div>

                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="">Centro Trabajo</label>
                            <input type="text" value="<?php echo $trabajador['nombre_cen'] ?>" name="centro_tr" class="form-control" disabled>

                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="">Categoria</label>
                            <input type="text" value="<?php echo $trabajador['nombre_cat'] ?>" name="categoria_tr" class="form-control" disabled>

                        </div>
                    </div>

                </div>

            </div>

            <hr>


            <div class="row">


                <div class="col-md-12">
                    <h5 strong style="text-align: left"><i class="fas fa-book mr-1"></i> Formación recibida</h5 strong>

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
                                        <a href="../formacion/show.php?id_formacion=<?php echo  $trabajador_formacion['id_formacion']; ?>" class="btn btn-primary btn-sm btn-font-size" title="Ver detalles"><i class="bi bi-folder-fill"></i> Ver</a>

                                    </td>
                                <?php
                            }
                                ?>
                        </tbody>
                    </table>
                    <hr>

                </div>
                <div class="col-md-12">

                    <h5 strong style="text-align: left"><i class="fas bi bi-heart-pulse-fill mr-1"></i> Reconocimientos médicos</h5 strong>

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
                                        <a href="../reconocimientos/index.php" class="btn btn-primary btn-sm btn-font-size" title="Ver detalles"><i class="bi bi-folder-fill"></i> Ver</a>
                                    </td>
                                <?php
                            }
                                ?>
                        </tbody>
                    </table>
                    <hr>
                </div>

                <div>
                    <h5 strong style="text-align: left"><i class="bi bi-bandaid-fill"></i> Accidentes</h5 strong>


                    <table id="example1" class="table table-sm">
                        <thead>
                            <tr>
                                <th style="text-align: center">Fecha</th>
                                <th style="text-align: center">Tipo Acc.</th>
                                <th style="text-align: center">Centro</th>
                                <th style="text-align: center">Fecha Baja</th>
                                <th style="text-align: center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $contadoracc = 0;
                            foreach ($trabajador_accidentes as $trabajador_accidente) {
                                $contadoracc = $contadoracc + 1;
                            ?>

                                <tr>
                                    <td style="text-align: center"><?php echo $newdate = date("d-m-Y", strtotime($trabajador_accidente['fecha_ace'])) ?></td>
                                    <td style="text-align: center"><?php echo $trabajador_accidente['tipoaccidente_ta']; ?></td>
                                    <td style="text-align: center"><?php echo $trabajador_accidente['nombre_cen']; ?></td>
                                    <td style="text-align: center"><?php echo $newdate = date("d-m-Y", strtotime($trabajador_accidente['fechabaja_ace'])) ?></td>
                                    <td style="text-align: center">
                                        <a href="../accidentes/show.php?id_accidente=<?php echo $trabajador_accidente['id_accidente'] ?>" class="btn btn-primary btn-sm btn-font-size" title="Ver detalles"><i class="bi bi-folder-fill"></i> Ver</a>
                                    </td>
                                <?php
                            }
                                ?>
                        </tbody>
                    </table>
                    <hr>
                </div>


                <strong style="text-align: left"><i class="far fa-file-alt mr-1"></i> Notas / Detalles</strong>

                <div class="col-md-12">
                    <div class="form-group">
                        <textarea class="form-control" rows="6" disabled><?php echo $trabajador['anotaciones_tr']; ?></textarea>
                    </div>

                </div>
            </div>

        </div>


    </div>




    <div class="col-md-8">
        <div class="card card-outline card-primary">
            <div class="card-header col-md-12">
                <h3 class="card-title"><b>Trabajadores registrados</b></h3>
                <?php include('../../app/controllers/trabajadores/listado_trabajadores.php'); ?>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <table id="example1" class="table table-striped table-bordered table-hover">
                            <colgroup>
                                <col width="5%">
                                <col width="10%">
                                <col width="30%">
                                <col width="10%">
                                <col width="10%">
                                <col width="15%">
                                <col width="10%">
                                <col width="10%">
                            </colgroup>
                            <thead>
                                <tr>
                                    <th style="text-align: center">N. Cod.</th>
                                    <th style="text-align: center">DNI</th>
                                    <th style="text-align: center">Nombre</th>
                                    <th style="text-align: center">Empresa</th>
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
                                        <td style="text-align: center"><?php echo $trabajador['codigo_tr']; ?></td>
                                        <td style="text-align: center"><?php echo $trabajador['dni_tr']; ?></td>
                                        <td><?php echo $trabajador['nombre_tr']; ?></td>
                                        <td><?php echo $trabajador['nombre_emp']; ?></td>
                                        <td><?php echo $trabajador['nombre_cen']; ?></td>
                                        <td><?php echo $trabajador['nombre_cat']; ?></td>
                                        <td style="text-align: center;"><?php $trabajador['activo_tr'];
                                                                        if ($trabajador['activo_tr'] == 1) { ?>
                                                <span class='badge badge-success'>Activo</span>
                                            <?php
                                                                        } else { ?>
                                                <span class='badge badge-danger'>Baja</span>
                                            <?php
                                                                        }
                                            ?>


                                        </td>
                                        <td></td>

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