<?php
include('../../../app/config.php');
include('../../../admin/layout/parte1.php');
include('../../../app/controllers/maestros/categorias/listado_categorias.php');
?>
<br>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h5 class="m-0"><b>CATEGORIAS</b></h5>

            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                    <li class="breadcrumb-item active">Tablas maestras</li>
                    <li class="breadcrumb-item active">Categorias</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>

<div class="col-md-12">
    <div class="card card-outline card-primary">
        <div class="card-header col-md-12">
            <h3 class="card-title"><b>Usuarios registrados</b></h3>
            <style>
                .btn-text-right {
                    text-align: right;
                }
            </style>
            <div class="btn-text-right">
                <a href="" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#nuevoModal"><i class="bi bi-bookmark-plus"></i> Añadir Nueva Categoria</a>
            </div>

        </div>

        <div class="card-body">
            <table id="example1" class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th style="text-align: center">Num.</th>
                        <th style="text-align: center">Nombre categoria</th>
                        <th style="text-align: center">Departamento</th>
                        <th style="text-align: center">Descripcion categoria</th>
                        <th style="text-align: center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $contador = 0;
                    foreach ($categorias_datos as $categorias_dato) {
                        $contador = $contador + 1;
                        $id_categoria = $categorias_dato['id_categoria'];
                    ?>
                        <tr>
                            <td><?php echo $contador; ?></td>
                            <td><?php echo $categorias_dato['nombre_cat']; ?></td>
                            <td><?php echo $categorias_dato['departamento_cat']; ?></td>
                            <td><?php echo $categorias_dato['descripcion_cat']; ?></td>
                            <td>
                                <div class="d-grid gap-2 d-flex content-sm-end">
                                    <a href="update.php?id_categoria=<?php echo $id_categoria; ?>" class="btn btn-warning btn-sm"><i class="bi bi-pencil-square"></i> </a>
                                    <a href="delete.php?id_categoria=<?php echo $id_categoria; ?>" class="btn btn-danger btn-sm"><i class="bi bi-trash3-fill"></i> </a>
                                </div>
                            </td>

                        </tr>
                    <?php
                    }
                    ?>

                </tbody>

            </table>
            <!--incluimos el formulario modal-->
            <?php include 'nuevoModal.php'; ?>

           
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