<?php
include('../../../app/config.php');
include('../../../admin/layout/parte1.php');
include('../../../app/controllers/maestros/evaluacion/listado_tipoevaluacion.php');
include('../../../app/controllers/maestros/emailsinteres/listado_emailsinteres.php');
include('../../../app/controllers/maestros/empresas/listado_empresas.php');
include('../../../app/controllers/maestros/evaluacion/listado_riesgos.php');
include('../../../app/controllers/maestros/evaluacion/listado_medidas.php');
include('../../../app/controllers/maestros/departamentos/listado_departamentos.php');
include('../../../app/controllers/maestros/estadisticas/listado_estadisticas.php');


?>
<html>

<!-- select2 -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@x.x.x/dist/select2-bootstrap4.min.css">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h5 class="m-0"><b>TABLAS EVALUACIONES</b></h5>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                    <li class="breadcrumb-item"><a href="#">Maestros</a></li>
                    <li class="breadcrumb-item active">Tablas Evaluaciones</li>
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
                    <h3 class="card-title"><b>Medidas Preventivas</b></h3>
                    <style>
                        .btn-text-right {
                            text-align: right;
                        }
                    </style>
                    <!-- Button trigger modal -->
                    <div class="btn-text-right">
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-nuevamedida">Añadir Medida</button>
                    </div>
                </div>
                <!-- Modal -->
                <div class="modal fade" id="modal-nuevamedida">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <div class="modal-header" style="background-color:#808000 ;color:white">
                                <h5 class="modal-title" id="modal-nuevodirecciones">Nuevo Medida</h5>
                                <button type="button" class="close" style="color: white;" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">

                                <form action="../../../app/controllers/maestros/evaluacion/create_medida.php" method="post" enctype="multipart/form-data">



                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="codigomedida" class="col-form-label col-sm-3">Código*</label>
                                                <div class="col-sm-8">
                                                    <select name="codigomedida" id="id_riesgo" class="id_riesgo">
                                                        <option value="">Seleccione un riesgo</option>
                                                        <?php
                                                        foreach ($riesgos_datos as $riesgos_dato) { ?>
                                                            <option value="<?php echo $riesgos_dato['codigoriesgo']; ?>">
                                                                <?php echo $riesgos_dato['codigoriesgo']; ?> - <?php echo  $riesgos_dato['fraseriesgo'];  ?>


                                                            </option>
                                                        <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                    </div>


                                    <br>



                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="">Frase Medida</label>
                                                <textarea class="form-control" name="frasemedida" rows="4" required></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                        <button type="submit" class="btn btn-primary"><i class="bi bi-floppy"></i> Guardar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>


                <!--fin modal-->

                <div class="card-body">
                    <table id="example3" class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th style="text-align: center">#</th>
                                <th style="text-align: center">Codigo</th>
                                <th style="text-align: center">Descripcion</th>
                                <th style="text-align: center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $contadomedidas = 0;
                            foreach ($medidas_datos as $medidas_dato) {
                                $contadomedidas = $contadomedidas + 1;
                                $id_departamento = $medidas_dato['id_medida'];
                            ?>
                                <tr>
                                    <td><?php echo $contadomedidas; ?></td>
                                    <td><?php echo $medidas_dato['codigomedida']; ?></td>
                                    <td><?php echo $medidas_dato['frasemedida']; ?></td>

                                    <td style="text-align: center">
                                        <div class="d-grid gap-2 d-md-block" role="group" aria-label="Basic mixed styles example">
                                            <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" title="EDITAR MEDIDA" data-target="#modal-modificarmedida<?php echo $id_medida; ?>"><i class="bi bi-pencil-square"></i></button>

                                            <a href="../../../app/controllers/maestros/evaluacion/delete_medida.php?id_medida=<?php echo $medidas_dato['id_medida'] ?>" class="btn btn-danger btn-sm"><i class="bi bi-trash3-fill"></i></a>


                                            


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

    <div class="row">

        <div class="col-md-6">
            <div class="card card-outline card-primary">
                <div class="card-header col-md-12">
                    <h3 class="card-title"><b>Tipo Evaluacion</b></h3>
                    <style>
                        .btn-text-right {
                            text-align: right;
                        }
                    </style>
                    <!-- Button trigger modal -->
                    <div class="btn-text-right">
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-nuevotipoevaluacion">Añadir Tipo evaluación</button>
                    </div>
                </div>
                <!-- Modal -->
                <div class="modal fade" id="modal-nuevotipoevaluacion">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <div class="modal-header" style="background-color:#0080ff ;color:white">
                                <h5 class="modal-title" id="modal-nuevotipoevaluacion">Nuevo tipo evaluacion</h5>
                                <button type="button" class="close" style="color: white;" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">

                                <form action="../../../app/controllers/maestros/evaluacion/create_tipoevaluacion.php" method="post" enctype="multipart/form-data">

                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label for="">Nombre tipo Evaluacion <b>*</b></label>
                                                <input type="text" name="tipoevaluacion_tev" class="form-control" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="lugar" class="col-form-label col-sm-3">Especialidad*</label>
                                                <div class="col-sm-8">
                                                    <select class="form-select" name="especialidad_tev" aria-label="Default select example" required>
                                                        <option selected>Selecciona Especialidad</option>
                                                        <option value="Seguridad">Seguridad</option>
                                                        <option value="Higiene">Higiene</option>
                                                        <option value="Ergonomia">Ergonomia</option>
                                                        <option value="Psicosociologia">Psicosociologia</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group row">
                                                <label for="descripcion_ace" class="col-form-label col-sm-3">Descripción:</label>
                                                <div class="col-sm-12">
                                                    <textarea class="form-control" name="descripcion_tev" rows="3"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>




                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                        <button type="submit" class="btn btn-primary"><i class="bi bi-floppy"></i> Guardar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>


                <!--fin modal-->

                <div class="card-body">
                    <table id="example1" class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th style="text-align: center">Num.</th>
                                <th style="text-align: center">Tipo Evaluacion</th>
                                <th style="text-align: center">Especialidad</th>
                                <th style="text-align: center">Descripcion</th>
                                <th style="text-align: center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $contador = 0;
                            foreach ($tipoevaluacion_datos as $tipoevaluacion_dato) {
                                $contador = $contador + 1;
                                $id_tipoevaluacion = $tipoevaluacion_dato['id_tipoevaluacion'];
                            ?>
                                <tr>
                                    <td><?php echo $contador; ?></td>
                                    <td><?php echo $tipoevaluacion_dato['tipoevaluacion_tev']; ?></td>
                                    <td><?php echo $tipoevaluacion_dato['especialidad_tev']; ?></td>
                                    <td><?php echo $tipoevaluacion_dato['descripcion_tev']; ?></td>

                                    <td style="text-align: center">
                                        <div class="d-grid gap-2 d-md-block" role="group" aria-label="Basic mixed styles example">
                                            <a href="../../../app/controllers/maestros/evaluacion/delete.php?id_tipoevaluacion=<?php echo $id_tipoevaluacion ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Realmente desea eliminar responsable?')" title="Eliminar responsable"><i class="bi bi-trash3-fill"></i></a>


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


        <div class="col-md-6">
            <div class="card card-outline card-primary">
                <div class="card-header col-md-12">
                    <h3 class="card-title"><b>Riesgos</b></h3>
                    <style>
                        .btn-text-right {
                            text-align: right;
                        }
                    </style>
                    <!-- Button trigger modal -->
                    <div class="btn-text-right">
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-nuevoriesgo">Añadir Riesgo</button>
                    </div>
                </div>
                <!-- Modal -->
                <div class="modal fade" id="modal-nuevoriesgo">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <div class="modal-header" style="background-color:#808000 ;color:white">
                                <h5 class="modal-title" id="modal-nuevodirecciones">Nuevo Riesgo</h5>
                                <button type="button" class="close" style="color: white;" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">

                                <form action="../../../app/controllers/maestros/evaluacion/create_riesgo.php" method="post" enctype="multipart/form-data">

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Codigo Riesgo <b>*</b></label>
                                                <input type="text" name="codigoriesgo" class="form-control" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="">Frase Riesgo</label>
                                                <input type="text" name="fraseriesgo" class="form-control" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                        <button type="submit" class="btn btn-primary"><i class="bi bi-floppy"></i> Guardar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>


                <!--fin modal-->

                <div class="card-body">
                    <table id="example2" class="table table-striped table-bordered table-hover">
                        <colgroup>
                            <col width="10%">
                            <col width="10%">
                            <col width="70%">
                            <col width="10%">

                        </colgroup>
                        <thead>
                            <tr>
                                <th style="text-align: center">#</th>
                                <th style="text-align: center">Codigo</th>
                                <th style="text-align: center">Frase Riesgo</th>
                                <th style="text-align: center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>


                            <?php
                            $contador_riesgos = 0;
                            foreach ($riesgos_datos as $riesgos_dato) {
                                $contador_riesgos = $contador_riesgos + 1;
                                $id_riesgo = $riesgos_dato['id_riesgo'];
                            ?>
                                <tr>
                                    <td style="text-align: center"><?php echo $contador_riesgos; ?></td>
                                    <td style="text-align: center"><?php echo $riesgos_dato['codigoriesgo']; ?></td>
                                    <td style="text-align: left"><?php echo $riesgos_dato['fraseriesgo']; ?></td>

                                    <td style="text-align: center">
                                        <div class="d-grid gap-2 d-md-block" role="group" aria-label="Basic mixed styles example">
                                            <a href="update.php?id_responsable=<?php echo $id_responsable ?>" class="btn btn-warning btn-sm"><i class="bi bi-pencil-square"></i></a>
                                            <a href="delete.php?id_responsable=<?php echo $id_responsable ?>" class="btn btn-danger btn-sm"><i class="bi bi-trash3-fill"></i></a>

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


</div>


<?php
include('../../../admin/layout/parte2.php');
include('../../../admin/layout/mensaje.php');
?>

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('#id_riesgo').select2({
            dropdownParent: $('#modal-nuevamedida .modal-body'),
            theme: 'bootstrap4',
            width: 600,
        });
    });
</script>
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

<script>
    $(function() {
        $("#example2").DataTable({
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
        }).buttons().container().appendTo("#example2_wrapper .col-md-6:eq(0)");
    });
</script>

<script>
    $(function() {
        $("#example3").DataTable({
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
        }).buttons().container().appendTo("#example3_wrapper .col-md-6:eq(0)");
    });
</script>

</html>