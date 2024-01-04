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
                        <a href="" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#nuevoModalperfil"><i class="bi bi-plus-circle"></i> Añadir Nuevo Perfil</a>
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