<?php
include('../../app/config.php');
include('../../admin/layout/parte1.php');
include('../../app/controllers/usuarios/listado_usuarios.php');
?>
<br>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h5 class="m-0"><b>USUARIOS</b></h5>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                    <li class="breadcrumb-item active">Listado Usuarios</li>
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
                <h3 class="card-title"><b>Usuarios registrados</b></h3>
                    <style>
                        .btn-text-right {
                            text-align: right;
                        }
                    </style>
                    <div class="btn-text-right">
                        <a href="" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#nuevoModalusuario"><i class="bi bi-plus-circle"></i> Añadir Nuevo Usuario</a>
                    </div>

                </div>
                <div class="card-body">
                    <table id="example1" class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th style="text-align: center">Num.</th>
                                <th style="text-align: center">Nombre</th>
                                <th style="text-align: center">email</th>
                                <th style="text-align: center">Perfil</th>
                                <th style="text-align: center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $contador = 0;
                            foreach ($usuarios as $usuario) {
                                $contador = $contador + 1;
                                $id_usuario = $usuario['id_usuario'];
                            ?>
                                <tr>
                                    <td><?php echo $contador; ?></td>
                                    <td><?php echo $usuario['nombre_usr']; ?></td>
                                    <td><?php echo $usuario['email_usr']; ?></td>
                                    <td><?php echo $usuario['nombre_pf']; ?></td>

                                    <td style="text-align: center">
                                        <div class="d-grid gap-2 d-md-block" role="group" aria-label="Basic mixed styles example">
                                            <a href="show.php?id_usuario=<?php echo $id_usuario; ?>" class="btn btn-secondary btn-sm"> <i class="bi bi-person-lines-fill"></i> Detalles</a>
                                            <a href="update.php?id_usuario=<?php echo $id_usuario ?>" class="btn btn-warning btn-sm"><i class="bi bi-pencil-square"></i> Editar</a>
                                            <a href="delete.php?id_usuario=<?php echo $id_usuario ?>" class="btn btn-danger btn-sm"><i class="bi bi-trash3-fill"></i> Eliminar</a>
                                          

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

<?php include 'nuevoModalusuario.php'; ?>

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