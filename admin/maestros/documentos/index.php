<?php
include('../../../app/config.php');
include('../../../admin/layout/parte1.php');
include('../../../app/controllers/maestros/documentos/listado_documentos.php');
include('../../../app/controllers/maestros/documentos/listado_infoprl.php');

?>
<link rel="stylesheet" href="style.css">
<br>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h5 class="m-0"><b>DOCUMENTOS / PLANTILLAS</b></h5>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                    <li class="breadcrumb-item active">Documentos</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>

<div class="container-fluid">


    <div class="row">

        <div class="col-md-7">
            <div class="card card-outline card-primary">
                <div class="card-header col-md-12">
                    <h3 class="card-title"><b>Documentos Cargados</b></h3>


                </div>
                <div class="card-body">
                    <table id="example1" class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th style="text-align: center">Num.</th>
                                <th style="text-align: center">Nombre documento</th>
                                <th style="text-align: center">URL</th>
                                <th style="text-align: center">Fecha subida</th>
                                <th style="text-align: center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $contador = 0;
                            foreach ($documentos_datos as $documentos_dato) {
                                $contador = $contador + 1;
                                $id = $documentos_dato['id'];
                            ?>
                                <tr>
                                    <td><?php echo $contador; ?></td>
                                    <td><?php echo $documentos_dato['name_file']; ?></td>
                                    <td><?php echo $documentos_dato['urlArchivo']; ?></td>
                                    <td><?php echo $documentos_dato['fecha_actual']; ?></td>
                                    <td style="text-align: center">
                                        <div class="d-grid gap-2 d-md-block" role="group" aria-label="Basic mixed styles example">
                                            <a href="<?php echo $URL . '/admin/maestros/documentos/Files_Pdf/' . $documentos_dato['urlArchivo'] ?>" target="_blank" class="btn btn-warning btn-sm"><i class="bi bi-eye-fill" title="Ver documento"></i></a>
                                            <a href="../../../app/controllers/maestros/documentos/delete.php?id=<?php echo $id; ?>" class="btn btn-danger btn-sm btn-font-size" onclick="return confirm('¿Realmente desea eliminar el documento?')" title="Eliminar documento"><i class="bi bi-trash-fill"></i></a>

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

        <div class="col-md-5">
            <div class="card card-secondary">
                <div class="card-header col-md-12">
                    <h3 class="card-title"><b>Subir documento / plantilla</b></h3>

                </div>
                <div class="card-body">
                    <form method="POST" action="recibe_pdf.php" class="form-group" enctype="multipart/form-data" style="height: 200px !important;">
                        <img class="logo" src="imgs/logo-mywebsite-urian-viera.svg" alt="">

                        <div class="form-group row">
                            <div class="col-sm-12">
                                <input type="file" name="file-input" id="file-input" class="form-control" accept=".pdf" />
                                <label class="col-form-label col-sm-3" for="file-input">
                            </div>


                            <div class="col-sm-12">

                                <input type="text" name="name_file" id="name_file" placeholder="Nombre del Archivo" class="form-control">
                            </div>
                        </div>

                        <button class="btn-login" value="Entrar">Subir Archivo</button>
                </div>

                </form>

            </div>
        </div>

    </div>

    <div class="row">

        <div class="col-md-7">
            <div class="card card-outline card-primary">
                <div class="card-header col-md-12">
                    <h3 class="card-title"><b>Informacion PRL</b></h3>
                    <style>
                        .btn-text-right {
                            text-align: right;
                        }
                    </style>
                    <!-- Button trigger modal -->
                    <div class="btn-text-right">
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-nuevainfoprl">
                            Nueva Info PRL
                        </button>
                    </div>


                    <!-- inicio modal nuevo reconocimiento-->
                    <div class="modal fade" id="modal-nuevainfoprl" role="dialog" aria-labelledby="modal-nuevainfoprl" aria-hidden="true">
                        <div class="modal-dialog modal-xl">
                            <div class="modal-content">
                                <div class="modal-header" style="background-color:#ffd900 ;color:black">
                                    <h5 class="modal-title" id="modal-nuevainfoprl">Nueva Informacion PRL</h5>
                                    <button type="button" class="close" style="color: black;" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">

                                    <form action="../../../app/controllers/maestros/documentos/create_infoprl.php" method="post" enctype="multipart/form-data">


                                        <div class="row">
                                            <div class="col-sm-8">
                                                <label for="nombre_ifd">Nombre documeno informativo PRL:</label>
                                                <input type="text" name="nombre_ifd" class="form-control" value="">
                                            </div>
                                            <div class="col-sm-4">
                                                <label for="tipoinfo_ifd">Régimen / Coeficiente:</label>
                                                <select name="tipoinfo_ifd" id="tipoinfo_ifd" class="form-select">
                                                    <option value="sin tipo">Seleccione opción</option>
                                                    <option value="Información riesgos puesto de trabajo">Información riesgos puesto de trabajo</option>
                                                    <option value="Metodo operativo">Metodo operativo</option>
                                                    <option value="Ficha informativa">Ficha informativa</option>
                                                    <option value="Otra info PRL">Otra info PRL</option>
                                                </select>
                                            </div>
                                            <div class="row">
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="">Fecha Documento</label>
                                                    <input type="date" name="fecha_ifd" class="form-control">
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <br>
                                                <div class="form-check ">
                                                    <input class="form-check-input" type="radio" value="1" name="vigente_ifd" id="flexRadioDefault1" checked>
                                                    <label class="form-check-label" for="flexRadioDefault1">
                                                        <b>Vigente</b>
                                                    </label>

                                                </div>

                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" value="0" name="vigente_ifd" id="flexRadioDefault2">
                                                    <label class="form-check-label" for="flexRadioDefault2">
                                                        <b>No Vigente</b>
                                                    </label>
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
                    </div>
                    <!--fin modal-->




                </div>
                <div class="card-body">
                    <table id="example2" class="table table-striped table-bordered table-hover">
                        <colgroup>
                            <col width="10%">
                            <col width="20%">
                            <col width="40%">
                            <col width="10%">
                            <col width="10%">
                            <col width="10%">
                        </colgroup>
                        <thead>
                            <tr>
                                <th style="text-align: center">Num.</th>
                                <th style="text-align: center">Tipo</th>
                                <th style="text-align: center">Nombre</th>
                                <th style="text-align: center">Tipo</th>
                                <th style="text-align: center">Fecha</th>
                                <th style="text-align: center">Vigente</th>
                                <th style="text-align: center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $contador = 0;
                            foreach ($info_documentos_datos as $info_documentos_dato) {
                                $contador = $contador + 1;
                                $id = $info_documentos_dato['id_infodoc'];
                            ?>
                                <tr>
                                    <td><?php echo $contador; ?></td>
                                    <td><?php echo $info_documentos_dato['tipoinfo_ifd']; ?></td>
                                    <td><?php echo $info_documentos_dato['nombre_ifd']; ?></td>
                                    <td><?php echo $info_documentos_dato['fecha_ifd']; ?></td>
                                    <td><?php if ($info_documentos_dato['vigente_ifd'] == 1) { ?>
                                            <span class='badge badge-success'>SI</span>
                                        <?php
                                        } else { ?>
                                            <span class='badge badge-danger'>NO</span>
                                        <?php
                                        }
                                        ?>
                                    </td>
                                    <td style="text-align: center">
                                        <div class="d-grid gap-2 d-md-block" role="group" aria-label="Basic mixed styles example">
                                            <a href="../../../app/controllers/maestros/documentos/delete_infoprl.php?id=<?php echo $id; ?>" class="btn btn-danger btn-sm btn-font-size" onclick="return confirm('¿Realmente desea eliminar el documento?')" title="Eliminar documento"><i class="bi bi-trash-fill"></i></a>

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

</div>


<?php
include('../../../admin/layout/parte2.php');
include('../../../admin/layout/mensaje.php');
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
        }).buttons().container().appendTo("#example1_wrapper .col-md-6:eq(0)");
    });
</script>