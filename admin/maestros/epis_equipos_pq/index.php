<?php
include('../../../app/config.php');
include('../../../admin/layout/parte1.php');
include('../../../app/controllers/maestros/epis_equipos_pq/listado_epi.php');
include('../../../app/controllers/maestros/epis_equipos_pq/listado_tipomaquina.php');
include('../../../app/controllers/maestros/epis_equipos_pq/listado_elementosrevision.php');
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
                <h5 class="m-0"><b>TABLAS EPIs / EQUIPOS DE TRABAJO / PRODUCTOS QUIMICOS</b></h5>
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

        <div class="col-md-4">
            <div class="card card-outline card-primary">
                <div class="card-header col-md-12">
                    <h3 class="card-title"><b>Equipos de protección individual (EPIs)</b></h3>
                    <style>
                        .btn-text-right {
                            text-align: right;
                        }
                    </style>
                    <!-- Button trigger modal -->
                    <div class="btn-text-right">
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-nuevoepi">Añadir EPI</button>
                    </div>
                </div>
                <!-- Modal -->
                <div class="modal fade" id="modal-nuevoepi">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <div class="modal-header" style="background-color:#0080ff ;color:white">
                                <h5 class="modal-title" id="modal-nuevoepi">Nuevo EPI</h5>
                                <button type="button" class="close" style="color: white;" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">

                                <form action="../../../app/controllers/maestros/epis_equipos_pq/create_epi.php" method="post" enctype="multipart/form-data">

                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label for="">Nombre EPI <b>*</b></label>
                                                <input type="text" name="nombre_epi" class="form-control" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="">Normativa aplicada <b>*</b></label>
                                                <input type="text" name="normativa_epi" class="form-control" required>
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
                                <th style="text-align: center">Tipo EPI</th>
                                <th style="text-align: center">Normativa</th>
                                <th style="text-align: center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $contador = 0;
                            foreach ($epis_datos as $epis_dato) {
                                $contador = $contador + 1;
                                $id_epi = $epis_dato['id_epi'];
                            ?>
                                <tr>
                                    <td><?php echo $contador; ?></td>
                                    <td><?php echo $epis_dato['nombre_epi']; ?></td>
                                    <td><?php echo $epis_dato['normativa_epi']; ?></td>

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

        <div class="col-md-3">
            <div class="card card-outline card-primary">
                <div class="card-header col-md-12">
                    <h3 class="card-title"><b>Tipo Maquinas (equipos de trabajo)</b></h3>
                    <style>
                        .btn-text-right {
                            text-align: right;
                        }
                    </style>
                    <!-- Button trigger modal -->
                    <div class="btn-text-right">
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-nuevotipomaquina">Añadir tipo</button>
                    </div>
                </div>
                <!-- Modal -->
                <div class="modal fade" id="modal-nuevotipomaquina">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header" style="background-color:#0080c0 ;color:white">
                                <h5 class="modal-title" id="modal-nuevodirecciones">Nuevo tipo</h5>
                                <button type="button" class="close" style="color: white;" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">

                                <form action="../../../app/controllers/maestros/epis_equipos_pq/create_tipomaquina.php" method="post" enctype="multipart/form-data">

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="">Tipo Maquina <b>*</b></label>
                                                <input type="text" name="nombre_tm" class="form-control" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="">Clasificacion</label>
                                                <input type="text" name="clase_tm" class="form-control" required>
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
                            <col width="5%">
                            <col width="50%">
                            <col width="40%">
                            <col width="5%">

                        </colgroup>
                        <thead>
                            <tr>
                                <th style="text-align: center"></th>
                                <th style="text-align: center">Tipo Maq.</th>
                                <th style="text-align: center">Clase</th>
                                <th style="text-align: center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            $contador_tipomaquina = 0;
                            foreach ($tipomaquina_datos as $tipomaquina_dato) {
                                $contador_tipomaquina = $contador_tipomaquina + 1;
                                $id_tipomaquina = $tipomaquina_dato['id_tipomaquina'];
                            ?>
                                <tr>
                                    <td style="text-align: center"><?php echo $contador_tipomaquina; ?></td>
                                    <td style="text-align: left"><?php echo $tipomaquina_dato['nombre_tm']; ?></td>
                                    <td style="text-align: left"><?php echo $tipomaquina_dato['clase_tm']; ?></td>

                                    <td style="text-align: center">
                                        <div class="d-grid gap-2 d-md-block" role="group" aria-label="Basic mixed styles example">
                                            <a href="../../../app/controllers/maestros/epis_equipos_pq/delete_tipomaquina.php?id_tipomaquina=<?php echo $id_tipomaquina ?>" class="btn btn-danger btn-sm"><i class="bi bi-trash3-fill"></i></a>

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

        <div class="col-md-4">
            <div class="card card-outline card-primary">
                <div class="card-header col-md-12">
                    <h3 class="card-title"><b>Elementos de Revisión</b></h3>
                    <style>
                        .btn-text-right {
                            text-align: right;
                        }
                    </style>
                    <!-- Button trigger modal -->
                    <div class="btn-text-right">
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-nuevoelemento">Añadir Elemento</button>
                    </div>
                </div>

                <!-- Modal -->
                <div class="modal fade" id="modal-nuevoelemento">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header" style="background-color:#0080c0; color:white">
                                <h5 class="modal-title" id="modal-nuevoelemento">Nuevo Elemento de Revisión</h5>
                                <button type="button" class="close" style="color: white;" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="../../../app/controllers/maestros/epis_equipos_pq/create_elementosrevision.php" method="post" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="descripcion">Descripción <b>*</b></label>
                                                <input type="text" name="descripcion" id="descripcion" class="form-control" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="tipo">Tipo <b>*</b></label>
                                                <select name="tipo" id="tipo" class="form-control" required>
                                                    <option value="RESPUESTA">Respuesta</option>
                                                    <option value="OBSERVACION">Observación</option>
                                                </select>
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
                    <table id="example24" class="table table-striped table-bordered table-hover">
                        <colgroup>
                            <col width="5%">
                            <col width="50%">
                            <col width="40%">
                            <col width="5%">
                        </colgroup>
                        <thead>
                            <tr>
                                <th style="text-align: center"></th>
                                <th style="text-align: center">Descripción</th>
                                <th style="text-align: center">Tipo</th>
                                <th style="text-align: center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $contador_elemento = 0;
                            foreach ($elementos_revision_datos as $elemento_dato) {
                                $contador_elemento = $contador_elemento + 1;
                                $id_elemento = $elemento_dato['id_elemento'];
                            ?>
                                <tr>
                                    <td style="text-align: center"><?= $contador_elemento ?></td>
                                    <td style="text-align: left"><?= htmlspecialchars($elemento_dato['descripcion']) ?></td>
                                    <td style="text-align: left"><?= htmlspecialchars($elemento_dato['tipo']) ?></td>
                                    <td style="text-align: center">
                                        <div class="d-grid gap-2 d-md-block" role="group" aria-label="Basic mixed styles example">
                                            <a href="../../../app/controllers/maestros/elementos_revision/delete_elementorevision.php?id_elemento=<?= $id_elemento ?>" class="btn btn-danger btn-sm">
                                                <i class="bi bi-trash3-fill"></i>
                                            </a>
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
        <div class="col-md-4">
        <div class="card card-outline card-primary">
                <div class="card-header col-md-12">
                    <h3 class="card-title"><b>Elementos de ARNES</b></h3>
                    <style>
                        .btn-text-right {
                            text-align: right;
                        }
                    </style>
                    <!-- Button trigger modal -->
                    <div class="btn-text-right">
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-nuevoelemento">Añadir Elemento</button>
                    </div>
                </div>

                <!-- Modal -->
                <div class="modal fade" id="modal-nuevoelemento">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header" style="background-color:#0080c0; color:white">
                                <h5 class="modal-title" id="modal-nuevoelemento">Nuevo Elemento de Revisión</h5>
                                <button type="button" class="close" style="color: white;" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="../../../app/controllers/maestros/epis_equipos_pq/create_elementosrevision.php" method="post" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="descripcion">Descripción <b>*</b></label>
                                                <input type="text" name="descripcion" id="descripcion" class="form-control" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="tipo">Tipo <b>*</b></label>
                                                <select name="tipo" id="tipo" class="form-control" required>
                                                    <option value="RESPUESTA">Respuesta</option>
                                                    <option value="OBSERVACION">Observación</option>
                                                </select>
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
                    <table id="example24" class="table table-striped table-bordered table-hover">
                        <colgroup>
                            <col width="5%">
                            <col width="50%">
                            <col width="40%">
                            <col width="5%">
                        </colgroup>
                        <thead>
                            <tr>
                                <th style="text-align: center"></th>
                                <th style="text-align: center">Descripción</th>
                                <th style="text-align: center">Tipo</th>
                                <th style="text-align: center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $contador_elemento = 0;
                            foreach ($elementos_revision_datos as $elemento_dato) {
                                $contador_elemento = $contador_elemento + 1;
                                $id_elemento = $elemento_dato['id_elemento'];
                            ?>
                                <tr>
                                    <td style="text-align: center"><?= $contador_elemento ?></td>
                                    <td style="text-align: left"><?= htmlspecialchars($elemento_dato['descripcion']) ?></td>
                                    <td style="text-align: left"><?= htmlspecialchars($elemento_dato['tipo']) ?></td>
                                    <td style="text-align: center">
                                        <div class="d-grid gap-2 d-md-block" role="group" aria-label="Basic mixed styles example">
                                            <a href="../../../app/controllers/maestros/elementos_revision/delete_elementorevision.php?id_elemento=<?= $id_elemento ?>" class="btn btn-danger btn-sm">
                                                <i class="bi bi-trash3-fill"></i>
                                            </a>
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
        <div class="col-md-3">
            <div class="card card-outline card-primary">
                <div class="card-header col-md-12">
                    <h3 class="card-title"><b>Estadistica</b></h3>
                    <style>
                        .btn-text-right {
                            text-align: right;
                        }
                    </style>
                    <!-- Button trigger modal -->
                    <div class="btn-text-right">
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-nuevaestadistica">Añadir estadistica</button>
                    </div>
                </div>
                <!-- Modal -->
                <div class="modal fade" id="modal-nuevaestadistica">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <div class="modal-header" style="background-color:#808000 ;color:white">
                                <h5 class="modal-title" id="modal-nuevaestadistica">Estadisticas año</h5>
                                <button type="button" class="close" style="color: white;" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">

                                <form action="../../../app/controllers/maestros/estadisticas/create.php" method="post" enctype="multipart/form-data">

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Año <b>*</b></label>
                                                <input type="text" name="anio_est" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="">Num Media Tr</label>
                                                <input type="text" name="mediatr_est" class="form-control" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Indice incidencia sector <b>*</b></label>
                                                <input type="text" name="indinciden_est" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="">Media horas anual x Tr</label>
                                                <input type="text" name="horastranual_est" class="form-control" required>
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
                                <th style="text-align: center">Año</th>
                                <th style="text-align: center">Media TR</th>
                                <th style="text-align: center">I.Inc. Sector</th>
                                <th style="text-align: center">Hrs x tr</th>
                                <th style="text-align: center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $contadorestadisticas_dato = 0;
                            foreach ($estadisticas_datos as $estadisticas_dato) {
                                $contadormedidas = $contadormedidas + 1;
                                $id_estadistica = $estadisticas_dato['id_estadistica'];
                            ?>
                                <tr>

                                    <td style="text-align: center"><?php echo $estadisticas_dato['anio_est']; ?></td>
                                    <td style="text-align: center"><?php echo $estadisticas_dato['mediatr_est']; ?></td>
                                    <td style="text-align: center"><?php echo $estadisticas_dato['indinciden_est']; ?></td>
                                    <td style="text-align: center"><?php echo $estadisticas_dato['horastranual_est']; ?></td>

                                    <td style="text-align: center">
                                        <div class="d-grid gap-2 d-md-block" role="group" aria-label="Basic mixed styles example">
                                            <a href="update.php?id_estadistica=<?php echo $id_estadistica ?>" class="btn btn-warning btn-sm"><i class="bi bi-pencil-square"></i></a>
                                            <a href="../../../app/controllers/maestros/estadisticas/delete.php?id_estadistica=<?php echo $id_estadistica ?>" class="btn btn-danger btn-sm"><i class="bi bi-trash3-fill"></i></a>

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
        $("#example24").DataTable({
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