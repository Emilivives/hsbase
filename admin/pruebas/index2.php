<?php
include('../../app/config.php');
include('../../admin/layout/parte1.php');
include('../../app/controllers/reconocimientos/listado_reconocimientos.php');
include('../../app/controllers/maestros/emailsinteres/listado_emailsinteres.php');
?>

<html>
<!-- Font Awesome -->
<link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
<!-- Ionicons -->
<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h5 class="m-0"><b>Reconocimientos médicos realizados</b></h5>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                    <li class="breadcrumb-item active">Control reconocimientos médicos</li>
                </ol>
            </div><!-- /.col -->
            <hr>
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>



<div class="row">


    <div class="col-lg-12">





        <div class="card">
            <div class="card-header bg-secondary border-3">
                <div class="d-flex justify-content-between">
                    <h3 class="card-title text-center"> <b> RECONOCIMIENTOS MÉDICOS </b></h3>
                    <style>
                        .btn-text-right {
                            text-align: right;
                        }
                    </style>

                    <div class="btn-text-right">
                        <a href="../reconocimientos/index.php" class="btn btn-sm btn-secondary"><i class="bi bi-list-ul"></i> acceder</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table id="example1" class="table tabe-hover table-condensed">
                <colgroup>
                        <col width="15%">
                        <col width="15%">
                        <col width="5%">
                        <col width="5%">
                        <col width="10%">
                        <col width="5%">
                        <col width="5%">
                        <col width="5%">
                        <col width="25%">
                        <col width="10%">
                    </colgroup>
                    <thead>
                        <tr>
                            <th style="text-align: left">Nombre trab.</th>
                            <th style="text-align: left">Puesto</th>
                            <th style="text-align: center">Fecha RM.</th>
                            <th style="text-align: center">Fecha caduc.</th>
                            <th style="text-align: center">Vigente</th>
                            <th style="text-align: center">Citado</th>
                            <th style="text-align: center">Fecha cita</th>
                            <th style="text-align: center">Enviada</th>
                            <th style="text-align: center">Anotaciones</th>
                            <th style="text-align: center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $contadorrm = 0;
                        foreach ($reconocimientos as $reconocimiento) {
                            $contadorrm = $contadorrm + 1;
                            $id_reconocimiento = $reconocimiento['id_reconocimiento'];
                        ?>

<tr>
                                <td style="text-align: left"><?php echo $reconocimiento['nombre_tr']; ?> <?php if ($reconocimiento['activo_tr'] == 0) { ?>
                                        <span class='badge badge-danger' style="font-size: 15px;">Baja</span>

                                    <?php
                                                                                                            }
                                    ?>
                                </td>
                                <td style="text-align: left"><?php echo $reconocimiento['nombre_cen']; ?></td>
                                <td style="text-align: center"><?php $newdate1 = date("d-m-Y", strtotime($reconocimiento['fecha_rm']));
                                                                if ($newdate1 == '01-01-0001') { ?>
                                        <span class='badge badge-warning'>NUEVO</span>
                                    <?php } else {
                                                                    echo $newdate1;
                                                                } ?>
                                </td>
                                <td style="text-align: center"><?php $newdate = date("d-m-Y", strtotime($reconocimiento['caducidad_rm']));
                                                                if ($newdate == '01-01-0001') { ?>
                                        <span class='badge badge-warning'>NUEVO</span>
                                    <?php } else {
                                                                    echo $newdate;
                                                                } ?>
                                </td>
                                </td>
                                <?php
                                $date_now = $fecha;
                                $newdate_future = date('Y-m-d', strtotime($date_now . '+ 15 days'));

                                ?>

                                <td style="text-align: center;"><?php
                                                                if ($reconocimiento['vigente_rm'] == 1 and $reconocimiento['caducidad_rm'] < $fecha) { ?>
                                        <span class='badge badge-danger'>VIGENTE - CADUCADO</span>

                                    <?php
                                                                } elseif ($reconocimiento['vigente_rm'] == 1 and $reconocimiento['caducidad_rm'] == $fecha and $reconocimiento['caducidad_rm'] < $newdate_future) { ?>
                                        <span class='badge badge-danger'>VIGENTE - CADUCADO</span>

                                    <?php
                                                                } elseif ($reconocimiento['vigente_rm'] == 1 and $reconocimiento['caducidad_rm'] > $fecha and $reconocimiento['caducidad_rm'] < $newdate_future) { ?>
                                        <span class='badge badge-warning'>VIGENTE - A CITAR</span>

                                    <?php

                                                                } elseif ($reconocimiento['vigente_rm'] == 1 and $reconocimiento['caducidad_rm'] > $fecha and $reconocimiento['caducidad_rm'] == $newdate_future) { ?>
                                        <span class='badge badge-warning'>VIGENTE - A CITAR</span>

                                    <?php

                                                                } elseif ($reconocimiento['vigente_rm'] == 1 and $reconocimiento['caducidad_rm'] > $newdate_future) { ?>
                                        <span class='badge badge-success'>VIGENTE</span>
                                    <?php
                                                                } elseif ($reconocimiento['vigente_rm'] == 0) { ?>
                                        <span class='badge badge-secondary'>HISTÓRICO</span>
                                    <?php
                                                                }
                                    ?>


                                </td>
                                <td style="text-align: left;"><?php
                                                                if ($reconocimiento['cita_rm'] == 1) { ?>
                                        <span class='badge badge-success'>OK</span>

                                    <?php
                                                                } elseif ($reconocimiento['cita_rm'] == 0) { ?>
                                        <span class='badge badge-warning'>NO</span>

                                    <?php
                                                                }
                                    ?>


                                </td>
                                <td style="text-align: center"><?php echo $reconocimiento['fechacita_rm']; ?></td>

                                <td style="text-align: center;"><?php if ($reconocimiento['solicitudcita_rm'] <> NULL) { ?>
                                        <span class='badge badge-success' title="Enviado en: <?php echo $reconocimiento['solicitudcita_rm'] ?>">OK</span>

                                    <?php
                                                                } else { ?>
                                        <span class='badge badge-warning'>NO</span>

                                    <?php
                                                                }
                                    ?>


                                </td>
                                <td style="text-align: left"><?php echo $reconocimiento['anotaciones_rm']; ?></td>
                                <td style="text-align: center">
                                    <div class="d-grid gap-2 d-md-block" role="group" aria-label="Basic mixed styles example">
                                        <a href="#modal-modificareconocimiento<?php echo $id_reconocimiento; ?>" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modal-modificareconocimiento<?php echo $id_reconocimiento; ?>"><i class="bi bi-plus-circle"></i> Modifica</a>
                                    <a href="#modal-emailcita<?php echo $id_reconocimiento; ?>" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#modal-emailcita<?php echo $id_reconocimiento; ?>"></i> Email</a>

                                    <a href="../../app/controllers/reconocimientos/delete.php?id_reconocimiento=<?php echo $id_reconocimiento; ?>" class="btn btn-danger btn-sm btn-font-size" onclick="return confirm('¿Realmente desea eliminar el registro?')" title="Eliminar investigación"><i class="bi bi-trash-fill"></i> </a>
                                    </div>
                                </td>
                                    <?php include('modal-modificareconocimiento.php')?>
                                <?php include('modal-emailcita.php')?>

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

<?php
include('../../admin/layout/parte2.php');
include('../../admin/layout/mensaje.php');
?>

<script>
  $(function() {
    $("#example1").DataTable({
      "pageLength": 10,
      "language": {
        "emptyTable": "No hay información",
        "info": "Mostrando _START_ a _END_ de _TOTAL_ Usuarios",
        "infoEmpty": "Mostrando 0 a 0 de 0 Usuarios",
        "infoFiltered": "(Filtrado de MAX total Usuarios)",
        "infoPostFix": "",
        "thousands": ",",
        "lengthMenu": "Mostrar _MENU_",
        "loadingRecords": "Cargando...",
        "processing": "Procesando...",
        "search": "",
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
          text: "Rep.",
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
          text: "Visor",
          /*collectionLayout: "fixed three-column" */

        }
      ],
    }).buttons().container().appendTo("#example2_wrapper .col-md-6:eq(0)");
  });
</script>