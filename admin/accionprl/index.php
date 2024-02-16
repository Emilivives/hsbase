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
    <div class="col-lg-2 col-6">
        <!-- small box -->
        <div class="small-box bg-light shadow-sm border">
            <div class="inner">
                <?php
                $fechahoraentera = strtotime($fechahora);
                $anio = date("Y", $fechahoraentera);
                $contador_de_acciones = 0;
                foreach ($accionprl_datos as $accionprl_dato) {
                    if ((date("Y", strtotime($accionprl_dato['fecha_acc'])) == $anio)) {
                        $contador_de_acciones = $contador_de_acciones + 1;
                    }
                }
                ?>

                <h2><?php echo $contador_de_acciones; ?><sup style="font-size: 20px"></h2>
                <p>Acciones Preventivas en <?php echo  $anio ?></p>
            </div>
            <div class="icon">
                <i class="fa-solid fa-list"></i>
            </div>

        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-1 col-6">
        <!-- small box -->
        <div class="small-box bg-light shadow-sm border">
            <div class="inner">
                <?php
                $fechahoraentera = strtotime($fechahora);
                $anio = date("Y", $fechahoraentera);
                $contador_de_acciones_abiertas = 0;
                foreach ($accionprl_datos as $accionprl_dato) {
                    if ($accionprl_dato['estado_acc'] != 'Cerrada') {
                        $contador_de_acciones_abiertas = $contador_de_acciones_abiertas + 1;
                    }
                }
                ?>

                <h2><?php echo $contador_de_acciones_abiertas; ?><sup style="font-size: 20px"></h2>
                <p>Acciones abiertas</p>
            </div>
            <div class="icon">
                <i class="fa-solid fa-clock"></i>
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
                    <td style="text-align: left"><?php echo $accionprl_dato['nombre_resp']; ?></td>
                    <td style="text-align: left"><?php echo $accionprl_dato['accpropuesta_acc']; ?></td>
                    <td style="text-align: left"><?php echo $accionprl_dato['fechaprevista_acc']; ?></td>
                    <td style="text-align: left"><?php echo $accionprl_dato['fecharea_acc']; ?></td>
                    <td style="text-align: left"><?php echo $accionprl_dato['avance_acc']; ?></td>
                    <td style="text-align: left"><?php $accionprl_dato['estado_acc']; ?>
                        <?php if ($accionprl_dato['estado_acc'] == "Cerrada") { ?>
                            <span class='badge badge-success'>Cerrada</span>
                        <?php
                        } else if ($accionprl_dato['estado_acc'] == "En curso") { ?>
                            <span class='badge badge-info'>En curso</span>
                        <?php                       } else if ($accionprl_dato['estado_acc'] == "Comunicada") { ?>
                            <span class='badge badge-secondary'>Comunicada</span>
                        <?php                       } else if ($accionprl_dato['estado_acc'] == "Abierta") { ?>
                            <span class='badge badge-warning'>Abierta</span>
                        <?php                       } else if ($accionprl_dato['estado_acc'] == "Finalizada") { ?>
                            <span class='badge badge-primary'>Finalizada</span>
                        <?php                       }
                        ?>


                    </td>


                    <td style="text-align: center">
                        <div class="dropdown">
                            <a href="show.php?id_accion=<?php echo $id_accion; ?>" class="btn btn-warning btn-sm" title="Accede" > <i class="bi bi-pencil-square"></i> Detalles</a></a>

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