<?php
include('../../app/config.php');
include('../../admin/layout/parte1.php');
include('../../app/controllers/pruebas/listado_trabajadores.php');
include('../../app/controllers/maestros/centros/listado_centros.php');
include('../../app/controllers/actividad/listado_proyectos.php');
include('../../app/controllers/actividad/listado_accionprl.php');
?>
<html>
<!-- Font Awesome -->
<link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
<!-- Ionicons -->
<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

<style>
    .dropdown-font-size {
        font-size: 12px;
    }

    .btn-font-size {
        font-size: 12px;
    }
</style>


<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h3 class="m-0">Acciones PRL (correctoras o preventivas)</h3>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                    <li class="breadcrumb-item"><a href="#">Actividades</a></li>
                    <li class="breadcrumb-item active">Acciones PRL</li>
                </ol>
            </div><!-- /.col -->
            <hr class="border-primary">
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>


</html>


<div class="row">
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-light shadow-sm border">
            <div class="inner">
                <h2>150</h2>

                <p>New Orders</p>
            </div>
            <div class="icon">
                <i class="ion ion-bag"></i>
            </div>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-light shadow-sm border">
            <div class="inner">
                <h2>53<sup style="font-size: 20px">%</sup></h2>
                <p>Bounce Rate</p>
            </div>
            <div class="icon">
                <i class="ion ion-stats-bars"></i>
            </div>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box">
            <div class="inner">
                <h2>44</h2>

                <p>User Registrations</p>
            </div>
            <div class="icon">
                <i class="ion ion-person-add"></i>
            </div>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box">
            <div class="inner">
                <h2>65</h2>

                <p>Unique Visitors</p>
            </div>
            <div class="icon">
                <i class="ion ion-pie-graph"></i>
            </div>

        </div>
    </div>
    <!-- ./col -->
</div>
<!-- /.content-header -->


<div class="card-body">
    <table id="example1" class="table tabe-hover table-condensed">
        <colgroup>
            <col width="3%">
            <col width="4%">
            <col width="5%">
            <col width="7%">
            <col width="12%">
            <col width="5%">
            <col width="12%">
            <col width="5%">
            <col width="5%">
            <col width="3%">
            <col width="5%">
            <col width="3%">


        </colgroup>
        <thead class="table-dark">
            <tr>
                <th style="text-align: center">#</th>
                <th style="text-align: left">Codigo</th>
                <th style="text-align: left">Fecha</th>
                <th style="text-align: left">Centro</th>
                <th style="text-align: left">Descripción</th>
                <th style="text-align: left">Responsable</th>
                <th style="text-align: left">Medida</th>
                <th style="text-align: left">Fecha prevista</th>
                <th style="text-align: left">Fecha realizada</th>
                <th style="text-align: left">Avance</th>
                <th style="text-align: left">Estado</th>
                <th style="text-align: left">ACCIONES

            </tr>
        </thead>
        <tbody>
            <?php
            $contador = 0;
            foreach ($accionprl_datos as $accionprl_dato) {
                $contador = $contador + 1;
                $id_accion = $accionprl_dato['id_accion'];
            ?>

                <tr>
                    <td style="text-align: center"><b><?php echo $contador; ?></b></td>
                    <td style="text-align: left"><b><?php echo $accionprl_dato['codigo_acc']; ?></b></td>
                    <td style="text-align: left"><b><?php echo $accionprl_dato['fecha_acc']; ?></b></td>
                    <td style="text-align: left"><?php echo $accionprl_dato['nombre_cen']; ?></td>
                    <td style="text-align: left"><?php echo $accionprl_dato['descripcion_acc']; ?></td>
                    <td style="text-align: left"><?php echo $accionprl_dato['responsable_acc']; ?></td>
                    <td style="text-align: left"><?php echo $accionprl_dato['medida_acc']; ?></td>
                    <td style="text-align: left"><?php echo $accionprl_dato['fechaprevista_acc']; ?></td>
                    <td style="text-align: left"><?php echo $accionprl_dato['fecharea_acc']; ?></td>
                    <td style="text-align: left"><?php echo $accionprl_dato['avance_acc']; ?></td>
                    <td style="text-align: left"><?php echo $accionprl_dato['estado_acc']; ?></td>
                    <td style="text-align: center">
                        <div class="dropdown">
                            <button class="btn btn-secondary btn-sm dropdown-toggle dropdown-font-size" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
                                Opciones
                            </button>
                            <ul class="dropdown-menu dropdown-menu-dark dropdown-font-size" aria-labelledby="dropdownMenuButton2">
                                <li><a class="dropdown-item" href="#">Ver</a></li>
                                <li><a class="dropdown-item" href="#">Editar</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="#">Eliminar</a></li>
                            </ul>
                        </div>

                    </td>

                </tr>
            <?php
            }
            ?>

        </tbody>

    </table>

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
                "info": "Mostrando _START_ a _END_ de _TOTAL_ Acciones PRL",
                "infoEmpty": "Mostrando 0 a 0 de 0 acciones PRL",
                "infoFiltered": "(Filtrado de MAX total Usuarios)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_ Acciones",
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