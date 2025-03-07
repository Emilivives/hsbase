<?php
include('../../app/config.php');
include('../../admin/layout/parte1.php');
include('../../app/controllers/accidentes/listado_accidentes.php');
include('../../app/controllers/maestros/estadisticas/datos_estadisticas_anio.php');
include('../../app/controllers/maestros/emailsinteres/listado_emailsinteres.php');

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
        <div class="small-box bg-warning shadow-sm border">
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

                <h2><?php echo $contador_de_accidentes; ?> accidentes<sup style="font-size: 20px"></h2>
                <p>AÑO <?php echo  $anio ?></p>
            </div>
            <div class="icon">
                <i class="fa-solid fa-person-falling-burst"></i>
            </div>

        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-1 col-6">
        <!-- small box -->
        <div class="small-box bg-danger shadow-sm border">
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
                <p>Acc. con Baja <?php echo  $anio ?></p>
            </div>
            <div class="icon">
                <i class="fa-solid fa-hospital-user"></i>
            </div>

        </div>
    </div>
    <div class="col-lg-1 col-6">
        <!-- small box -->
        <div class="small-box bg-secondary shadow-sm border">
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
                <p>Acc: sin Baja - <?php echo  $anio ?></p>
            </div>
            <div class="icon">
            <i class="fa-solid fa-person-circle-check"></i>
                    </div>

        </div>
    </div>
    <div class="col-lg-1 col-6">
        <!-- small box -->
        <div class="small-box bg-light shadow-sm border">
            <div class="inner">
                <?php
                $fechahoraentera = strtotime($fechahora);
                $anio = date("Y", $fechahoraentera);
                $contador_de_accidentessinbaja = 0;
                foreach ($accidentes_datos as $accidentes_dato) {
                    if (($accidentes_dato['tipoaccidente_ta'] == "Accidente in itinere con baja") && (date("Y", strtotime($accidentes_dato['fecha_ace'])) == $anio)) {
                        $contador_de_accidentessinbaja = $contador_de_accidentessinbaja + 1;
                    }
                }
                ?>

                <h2><?php echo $contador_de_accidentessinbaja; ?><sup style="font-size: 20px"></h2>
                <p>Acc Itinere con Baja</p>
            </div>
            <div class="icon">
                <i class="fa-solid fa-car-burst"></i>
            </div>

        </div>
    </div>
    <div class="col-lg-1 col-6">
        <!-- small box -->
        <div class="small-box bg-light shadow-sm border">
            <div class="inner">
                <?php
                $fechahoraentera = strtotime($fechahora);
                $anio = date("Y", $fechahoraentera);
                $contador_de_accidentessinbaja = 0;
                foreach ($accidentes_datos as $accidentes_dato) {
                    if (($accidentes_dato['tipoaccidente_ta'] == "Accidente in itinere sin baja") && (date("Y", strtotime($accidentes_dato['fecha_ace'])) == $anio)) {
                        $contador_de_accidentessinbaja = $contador_de_accidentessinbaja + 1;
                    }
                }
                ?>

                <h2><?php echo $contador_de_accidentessinbaja; ?><sup style="font-size: 20px"></h2>
                <p>Acc Itinere sin Baja</p>
            </div>
            <div class="icon">
            <i class="fa-solid fa-person-walking"></i>
                    </div>

        </div>
    </div>
    <div class="col-lg-1 col-6">
        <!-- small box -->
        <div class="small-box bg-light shadow-sm border">
            <div class="inner">
                <?php
                $fechahoraentera = strtotime($fechahora);
                $anio = date("Y", $fechahoraentera);
                $contador_de_accidentessinbaja = 0;
                $contador_jornadas_perdidas = 0;
                foreach ($accidentes_datos as $accidentes_dato) {
                    // Verificar si es un accidente con baja y si pertenece al año actual
                    if (($accidentes_dato['tipoaccidente_ta'] == "Accidente con baja") &&
                        (date("Y", strtotime($accidentes_dato['fecha_ace'])) == $anio)
                    ) {

                        // Verificar si 'diasbaja_ace' está definido y no está vacío
                        if (!empty($accidentes_dato['diasbaja_ace']) && is_numeric($accidentes_dato['diasbaja_ace'])) {
                            // Sumar los días de baja
                            $contador_jornadas_perdidas += (int)$accidentes_dato['diasbaja_ace'];
                        }
                    }
                }
                ?>

                <h2><?php echo $contador_jornadas_perdidas; ?><sup style="font-size: 20px"></h2>
                <p>Jornadas perdidas</p>
            </div>
            <div class="icon">
                <i class="fa-solid fa-person-chalkboard"></i>
            </div>

        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-1 col-6">
        <!-- small box -->
        <div class="small-box bg-light shadow-sm border">
            <div class="inner">
                <?php
                include('../../app/controllers/maestros/estadisticas/datos_estadisticas_anio.php');

                $indiciceincidenciaactual = (($contador_de_accidentesconbaja * 100000) / $mediatr_est);

                ?>

                <h2><?php echo round($indiciceincidenciaactual, 2); ?><sup style="font-size: 20px"></h2>
                <p>Ind. incidencia <?php echo  $anio ?></p>
            </div>
            <div class="icon">
                <i class="fa-solid fa-chart-column"></i>
            </div>

        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-1 col-6">
        <!-- small box -->
        <div class="small-box bg-light shadow-sm border">
            <div class="inner">
                <?php
                include('../../app/controllers/maestros/estadisticas/datos_estadisticas_anio.php');

                $indicefrecuenciaaactual = ($contador_de_accidentesconbaja / ($mediatr_est * 1826)) * 1000000;

                ?>

                <h2><?php echo round($indicefrecuenciaaactual, 2); ?><sup style="font-size: 20px"></h2>
                <p>Ind. Frecuencia <?php echo  $anio ?></p>
            </div>
            <div class="icon">
                <i class="fa-solid fa-square-poll-vertical"></i>
            </div>

        </div>
    </div>

    <!-- small box -->
    <!-- ./col -->
   
    <div class="col-lg-1 col-6">

        <div class="small-box bg-light shadow-sm border">
            <div class="inner">
                <?php
                $fechahoraentera = strtotime($fechahora);
                $anio = date("Y", $fechahoraentera);

                $suma_dias_transcurridos = 0;
                $contador_registros = 0;

                foreach ($accidentes_datos as $accidentes_dato) {
                    // Validar que las fechas existen y no son nulas.
                    if (!empty($accidentes_dato['fecha_ace']) && !empty($accidentes_dato['fechainvestiga_ace'])) {
                        $fecha_accidente = strtotime($accidentes_dato['fecha_ace']);
                        $fecha_investiga = strtotime($accidentes_dato['fechainvestiga_ace']);

                        // Validar que las fechas son válidas y que pertenece al año actual.
                        if ($fecha_accidente && $fecha_investiga && date("Y", $fecha_accidente) == $anio) {
                            // Asegurar que la fecha de investigación es posterior o igual a la del accidente.
                            if ($fecha_investiga >= $fecha_accidente) {
                                $diferencia_dias = ($fecha_investiga - $fecha_accidente) / (60 * 60 * 24);
                                $suma_dias_transcurridos += $diferencia_dias;
                                $contador_registros++;
                            }
                        }
                    }
                }

                // Calculamos la media si hay registros válidos.
                $media_dias = $contador_registros > 0 ? round($suma_dias_transcurridos / $contador_registros, 2) : 0;
                ?>

                <h2><?php echo $media_dias; ?><sup style="font-size: 20px"></sup></h2>
                <p>Media de días investigación en <?php echo $anio; ?></p>
            </div>
            <div class="icon">
                <i class="fa-solid fa-calendar-days"></i>
            </div>
        </div>


    </div>
    <div class="col-lg-1 col-6"> </div>
    <!-- ./col -->
    <div class="col-lg-1 col-6">

        <div class="small-box bg-secondary shadow-sm border">
            <div class="inner">
                <h2><sup style="font-size: 20px"></h2>
                <p>INSTRUCCIONES & DIRECCIONES</p>

            </div>
            <div class="icon">
                <i class="fas fa-book" data-toggle="modal" data-target="#modal-pendientesformar"></i>
            </div>

            <!-- inicio modal nuevo trabajador-->
            <div class="modal fade" id="modal-pendientesformar">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header" style="background-color:#138fec ;color:black">
                            <h5 class="modal-title" id="modal-pendientesformar">INSTRUCCIONES & DIRECCIONES</h5>
                            <button type="button" class="close" style="color: white;" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <!-- Instrucciones -->
                            <div style="background-color: #f8f9fa; border: 1px solid #ced4da; padding: 15px; border-radius: 5px; margin-bottom: 20px;">
                                <h6 style="font-weight: bold; color: #495057;">Instrucciones:</h6>
                                <p style="margin: 0;">
                                    Para tramitar un accidente solo debes hacer clic en el botón <a href="" class="btn btn-sm btn-warning"><i class="bi bi-list-ul"></i> Nueva Asistencia Mutua</a> y rellenar <strong>TODOS</strong> los campos.
                                    Una vez hecho, se descargará un PDF en tu navegador. Puedes consultar en la tabla de abajo a quién deseas enviarlo.
                                    Siempre será un contacto de mutua del centro al que vamos a mandar al trabajador.
                                </p>
                            </div>


                            <table id="" class="table table-sm">
                                <colgroup>
                                    <col width="30%">
                                    <col width="30%">
                                    <col width="30%">

                                </colgroup>
                                <thead>
                                    <tr>

                                        <th style="text-align: left">Nombre</th>
                                        <th style="text-align: left">Email</th>
                                        <th style="text-align: left">Telf</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $contadoremailsinteres_dato = 0;
                                    foreach ($emailsinteres_datos as $emailsinteres_dato) {
                                        $contadoremailsinteres_dato = $contadoremailsinteres_dato + 1;
                                        $id_emailinteres = $emailsinteres_dato['id_emailinteres'];
                                    ?>
                                        <tr>
                                            <td><?php echo $emailsinteres_dato['nombre_ei']; ?></td>
                                            <td><?php echo $emailsinteres_dato['email_ei']; ?></td>
                                            <td><?php echo $emailsinteres_dato['telefono_ei']; ?></td>
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
            <!--fin modal-->

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
                    <a href="../accidentes/siniestralidad.php" class="btn btn-info"><i class="bi bi-list-ul"></i> Siniestralidad</a>
                    <a href="../accidentes/create_asistencia.php" class="btn btn-warning"><i class="bi bi-list-ul"></i> Nueva Asistencia Mutua</a>
                    <a href="../accidentes/create.php" class="btn btn-primary"><i class="bi bi-list-ul"></i> Nueva Investigacion accidente</a>
                </div>

                <div class="card-body">
                    <table id="example1" class="table tabe-hover table-condensed table-striped">
                        <colgroup>
                            <col width="5%">
                            <col width="5%">
                            <col width="8%">
                            <col width="7%">
                            <col width="10%">
                            <col width="15%">
                            <col width="5%">
                            <col width="10%">
                            <col width="20%">
                            <col width="7%">
                            <col width="13%">

                        </colgroup>
                        <thead class="table-dark">
                            <tr>
                                <th style="text-align: center">#</th>
                                <th style="text-align: left">Nro.</th>
                                <th style="text-align: center">Comunicado</th>
                                <th style="text-align: left">Fecha</th>
                                <th style="text-align: left">Tipo accidente</th>
                                <th style="text-align: left">Trabajador</th>
                                <th style="text-align: left">Dias baja</th>
                                <th style="text-align: left">Centro</th>
                                <th style="text-align: left">Tipo lesion</th>
                                <th style="text-align: left">Gravedad</th>
                                <th style="text-align: center">-</th>
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
                                    <td style="text-align: center;"><?php $accidentes_dato['comunicado_ace'];
                                                                    if ($accidentes_dato['comunicado_ace'] == "SI") { ?>
                                            <span class='badge badge-success'>SI</span>
                                        <?php
                                                                    } else if ($accidentes_dato['comunicado_ace'] == "NO") { ?>
                                            <span class='badge badge-warning'>NO</span>
                                        <?php                       }
                                        ?>


                                    </td>
                                    <td style="text-align: left"><b><?php echo $accidentes_dato['fecha_ace']; ?></b></td>
                                    <td style="text-align: left;"><?php $accidentes_dato['tipoaccidente_ta'];
                                                                    if ($accidentes_dato['tipoaccidente_ta'] == "Accidente sin baja") { ?>
                                            <span class='badge badge-primary'>ACC. SIN BAJA</span>
                                        <?php
                                                                    } else if ($accidentes_dato['tipoaccidente_ta'] == "Accidente con baja") { ?>
                                            <span class='badge badge-danger'>ACC. CON BAJA</span>
                                        <?php
                                                                    } else if ($accidentes_dato['tipoaccidente_ta'] == "Accidente in itinere con baja") { ?>
                                            <span class='badge badge-warning'>IN ITINERE CON BAJA L.</span>
                                        <?php
                                                                    } else if ($accidentes_dato['tipoaccidente_ta'] == "Accidente in itinere sin baja") { ?>
                                            <span class='badge badge-secondary'>IN ITINERE SIN BAJA L.</span>
                                        <?php                       }
                                        ?>


                                    </td>
                                    <td style="text-align: left"><?php echo $accidentes_dato['nombre_tr']; ?></td>
                                    <td style="text-align: center"><?php echo $accidentes_dato['diasbaja_ace']; ?></td>
                                    <td style="text-align: left"><?php echo $accidentes_dato['nombre_cen']; ?></td>
                                    <td style="text-align: left"><?php echo $accidentes_dato['tipolesion_tl']; ?></td>
                                    <td style="text-align: left"><?php echo $accidentes_dato['gravedad_gr']; ?></td>



                                    <td style="text-align: center">
                                        <div class="dropdown">
                                            <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton2" data-toggle="dropdown" aria-expanded="false">
                                                Opciones
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="dropdownMenuButton2">
                                                <div class="d-grid gap-2 d-md-block" role="group" aria-label="Basic mixed styles example">

                                                    <li><a class="dropdown-item active" href="show.php?id_accidente=<?php echo $id_accidente; ?>">Ver</i></a></li>

                                                    <li><a class="dropdown-item" href="../maestros/documentos/pdf_solicitudmutua.php?id_accidente=<?php echo $id_accidente; ?>">Solic. Mutua <i class="bi bi-earmark-text"></i></a></li>

                                                    <li><a class="dropdown-item" href="../maestros/documentos/pdf_investigacionacc.php?id_accidente=<?php echo $id_accidente; ?>">Informe acc. <i class="bi bi-file-earmark-text"></i></a></li>
                                                    <li><a class="dropdown-item" href="../../app/controllers/accidentes/delete.php?id_accidente=<?php echo $id_accidente; ?>">Eliminar </a></li>

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
            "pageLength": 10,
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