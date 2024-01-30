<?php
include('../../app/config.php');
include('../../admin/layout/parte1.php');
include('../../app/controllers/accidentes/listado_accidentes.php');

?>
<html>

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
                <h3 class="m-0">Accidentes laborales en empresa</h3>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                    <li class="breadcrumb-item active">Accidentes</a></li>
                </ol>
            </div><!-- /.col -->
            <hr class="border-primary">
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>


</html>
<div class="row">
    <!-- ./col -->
    <div class="col-lg-2 col-6">
        <!-- small box -->
        <div class="small-box bg-light shadow-sm border">
            <div class="inner">
                <?php
                $fechahoraentera = strtotime($fechahora);
                $anio = date("Y", $fechahoraentera);
                $contador_de_accidentes = 0;
                foreach ($accidentes_datos as $accidentes_dato) {
                    if ((date("Y", strtotime($accidentes_dato['fecha_ace'])) == $anio)) {
                        $contador_de_accidentes = $contador_de_accidentes + 1;
                    }
                }
                ?>

                <h2><?php echo $contador_de_accidentes; ?><sup style="font-size: 20px"></h2>
                <p>Accidentes en <?php echo  $anio ?></p>
            </div>
            <div class="icon">
                <i class="fa-solid fa-person-falling-burst"></i>
            </div>

        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-2 col-6">
        <!-- small box -->
        <div class="small-box bg-light shadow-sm border">
            <div class="inner">
                <?php
                $fechahoraentera = strtotime($fechahora);
                $anio = date("Y", $fechahoraentera);
                $contador_de_accidentesconbaja = 0;
                foreach ($accidentes_datos as $accidentes_dato) {
                    if (($accidentes_dato['tipoaccidente_ta'] == "Accidente con baja") && (date("Y", strtotime($accidentes_dato['fecha_ace'])) == $anio)) {
                        $contador_de_accidentesconbaja = $contador_de_accidentesconbaja + 1;
                    }
                }
                ?>

                <h2><?php echo $contador_de_accidentesconbaja; ?><sup style="font-size: 20px"></h2>
                <p>Accidentes con Baja en <?php echo  $anio ?></p>
            </div>
            <div class="icon">
                <i class="fa-solid fa-hospital-user"></i>
            </div>

        </div>
    </div>
    <div class="col-lg-2 col-6">
        <!-- small box -->
        <div class="small-box bg-light shadow-sm border">
            <div class="inner">
                <?php
                $fechahoraentera = strtotime($fechahora);
                $anio = date("Y", $fechahoraentera);
                $contador_de_accidentessinbaja = 0;
                foreach ($accidentes_datos as $accidentes_dato) {
                    if (($accidentes_dato['tipoaccidente_ta'] == "Accidente sin baja") && (date("Y", strtotime($accidentes_dato['fecha_ace'])) == $anio)) {
                        $contador_de_accidentessinbaja = $contador_de_accidentessinbaja + 1;
                    }
                }
                ?>

                <h2><?php echo $contador_de_accidentessinbaja; ?><sup style="font-size: 20px"></h2>
                <p>Accidentes sin Baja en <?php echo  $anio ?></p>
            </div>
            <div class="icon">
                <i class="fa-solid fa-person-chalkboard"></i>
            </div>

        </div>
    </div>
    <div class="col-lg-2 col-6">
        <!-- small box -->
        <div class="small-box bg-light shadow-sm border">
            <div class="inner">
                <?php
                $fechahoraentera = strtotime($fechahora);
                $anio = date("Y", $fechahoraentera);
                $contador_de_accidentessinbaja = 0;
                foreach ($accidentes_datos as $accidentes_dato) {
                    if (($accidentes_dato['tipoaccidente_ta'] == "Accidente sin baja") && (date("Y", strtotime($accidentes_dato['fecha_ace'])) == $anio)) {
                        $contador_de_accidentessinbaja = $contador_de_accidentessinbaja + 1;
                    }
                }
                ?>

                <h2><?php echo $contador_de_accidentessinbaja; ?><sup style="font-size: 20px"></h2>
                <p>Jornadas de trabajo perdidas <?php echo  $anio ?></p>
            </div>
            <div class="icon">
                <i class="fa-solid fa-person-chalkboard"></i>
            </div>

        </div>
    </div>
</div>


<div class="row">
    <div class="col-md-12">
        <div class="card card-outline card-success">
            <div class="card-header col-md-12">
                <h3 class="card-title"><b>Accidentes laborales</b></h3>
                <style>
                    .btn-text-right {
                        text-align: right;
                    }
                </style>

                <div class="btn-text-right">
                    <a href="../accidentes/create.php" class="btn btn-primary"><i class="bi bi-list-ul"></i> Nueva Investigacion accidente</a>
                </div>

                <div class="card-body">
                    <table id="example1" class="table tabe-hover table-condensed table-striped">
                        <colgroup>
                            <col width="5%">
                            <col width="5%">
                            <col width="10%">
                            <col width="10%">
                            <col width="20%">
                            <col width="10%">
                            <col width="20%">
                            <col width="10%">
                            <col width="10%">

                        </colgroup>
                        <thead class="table-dark">
                            <tr>
                                <th style="text-align: center">#</th>
                                <th style="text-align: left">Nro.</th>
                                <th style="text-align: left">Fecha</th>
                                <th style="text-align: left">Tipo accidente</th>
                                <th style="text-align: left">Trabajador</th>
                                <th style="text-align: left">Centro</th>
                                <th style="text-align: left">Tipo lesion</th>
                                <th style="text-align: left">Gravedad</th>
                                <th style="text-align: center">Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $contador = 0;
                            foreach ($accidentes_datos as $accidentes_dato) {
                                $contador = $contador + 1;
                                $id_accidente = $accidentes_dato['id_accidente'];
                            ?>

                                <tr>
                                    <td style="text-align: center"><b><?php echo $contador; ?></b></td>
                                    <td style="text-align: left"><b><?php echo $accidentes_dato['nroaccidente_ace']; ?></b></td>
                                    <td style="text-align: left"><b><?php echo $accidentes_dato['fecha_ace']; ?></b></td>
                                    <td style="text-align: left;"><?php $accidentes_dato['tipoaccidente_ta'];
                                                                    if ($accidentes_dato['tipoaccidente_ta'] == "Accidente sin baja") { ?>
                                            <span class='badge badge-warning'>ACC. SIN BAJA</span>
                                        <?php
                                                                    } else if ($accidentes_dato['tipoaccidente_ta'] == "Accidente con baja") { ?>
                                            <span class='badge badge-danger'>ACC. CON BAJA</span>
                                        <?php
                                                                    } else if ($accidentes_dato['tipoaccidente_ta'] == "Accidente in itinere") { ?>
                                            <span class='badge badge-secondary'>ACC. IN ITINERE</span>
                                        <?php                       }
                                        ?>


                                    </td>
                                    <td style="text-align: left"><?php echo $accidentes_dato['nombre_tr']; ?></td>
                                    <td style="text-align: left"><?php echo $accidentes_dato['nombre_cen']; ?></td>
                                    <td style="text-align: left"><?php echo $accidentes_dato['tipolesion_tl']; ?></td>
                                    <td style="text-align: left"><?php echo $accidentes_dato['gravedad_gr']; ?></td>



                                    <td style="text-align: center">
                                        <div class="d-grid gap-2 d-md-block" role="group" aria-label="Basic mixed styles example">
                                            <a href="show.php?id_accidente=<?php echo $id_accidente; ?>" class="btn btn-primary btn-sm btn-font-size" title="Ver detalles"><i class="bi bi-folder-fill"></i> Ver</a>
                                            <a href="../../app/controllers/accidentes/delete.php?id_accidente=<?php echo $id_accidente; ?>" class="btn btn-danger btn-sm btn-font-size" onclick="return confirm('¿Realmente desea eliminar el registro?')" title="Eliminar investigación"><i class="bi bi-trash-fill"></i> Eliminar</a>
                                           

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
                "info": "Mostrando _START_ a _END_ de _TOTAL_ expedientes investigación",
                "infoEmpty": "Mostrando 0 a 0 de 0 Accidentes",
                "infoFiltered": "(Filtrado de MAX total Accidentes)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_ Accidentes",
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