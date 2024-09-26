<?php
include('../../app/config.php');
include('../../admin/layout/parte1.php');
include('../../app/controllers/evaluacion/listado_evaluacion.php');
include('../../app/controllers/pruebas/listado_trabajadores.php');
include('../../app/controllers/maestros/centros/listado_centros.php');
include('../../app/controllers/actividad/listado_proyectos.php');
include('../../app/controllers/actividad/listado_accionprl.php');
include('../../app/controllers/maestros/responsables/listado_responsables.php');
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
                <h3 class="m-0">Evaluaciones de riesgos laborales</h3>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                    <li class="breadcrumb-item"><a href="#">Evaluaciones</a></li>
                    <li class="breadcrumb-item active">Indice</li>
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

<div class="row">
    <div class="col-md-12">
        <div class="card card-outline card-info">
            <div class="card-header col-md-12">
                <h3 class="card-title"><b>Evaluacion de riesgos</b></h3>
                <style>
                    .btn-text-right {
                        text-align: right;
                    }
                </style>
                <!--boton modal-->
                <div class="btn-text-right">
                    <button type="button" class="btn btn-primary btn-sm btn-font-size" data-toggle="modal" data-target="#modal-nuevaevaluacion">NUEVA EVALUACION</button>
                </div>

                <!--inicio modal nuev accion prl-->
                <div class="modal fade" id="modal-nuevaevaluacion">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <div class="modal-header" style="background-color:#0000a0;color:white">
                                <h5 class="modal-title" id="modal-nuevaevaluacion">Nueva Evaluacion de riesgos laborales</h5>
                                <button type="button" class="close" style="color: white;" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">

                                <form action="../../app/controllers/evaluacion/create_evaluacion.php" method="post" enctype="multipart/form-data">


                                    <div class="well">
                                        <div class="row">

                                            <div class="col-sm-4">
                                                <div class="form-group row">
                                                    <label for="nombre" class="col-form-label col-sm-6">Evaluacion Nº:</label>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control" name="codigo_er" id="" value="" placeholder="" tabindex="1">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="form-group row">
                                                    <label for="nombre" class="col-form-label col-sm-3">Nombre:</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" name="nombre_er" id="" value="" placeholder="" tabindex="1">
                                                    </div>
                                                </div>
                                            </div>



                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group row">
                                                    <label for="nombre" class="col-form-label col-sm-3">Fecha:</label>
                                                    <div class="col-sm-5">
                                                        <input type="date" name="fecha_er" id="fecha_er" value="" class="form-control" tabindex="1">
                                                    </div>
                                                </div>


                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group row">
                                                    <label for="prioridad" class="col-form-label col-sm-3">Tipo Evaluacion:</label>
                                                    <div class="col-sm-8">
                                                        <select class="form-select" name="tipoevaluacion_er" aria-label="Default select example">
                                                            <option value="-">Selecciona Tipo Evaluacion</option>

                                                            <option value="Puestos">Puestos de trabajo</option>
                                                            <option value="Centros">Centros de trabajo</option>
                                                            <option value="Puestos y centros">Puestos y centros de trabajo</option>
                                                            <option value="Otros">Otros</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">


                                            <div class="col-sm-6">
                                                <div class="form-group row">
                                                    <label for="centro" class="col-form-label col-sm-3">Centro: *</label>
                                                    <div class="col-sm-7">
                                                        <select name="centro_er" id="centro_er" class="form-control" required>
                                                            <option value="0">--Seleccione centro--</option>
                                                            <?php
                                                            foreach ($centros_datos as $centros_dato) { ?>
                                                                <option value="<?php echo $centros_dato['id_centro']; ?>" nombre_cen="<?php echo $centros_dato['nombre_cen']; ?>">
                                                                    <?php echo $centros_dato['nombre_cen']; ?> </option>
                                                            <?php
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>

                                                </div>

                                            </div>


                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group row">

                                                    <label for="" class="col-form-label col-sm-3">Responsable *</label>
                                                    <div class="col-sm-9">
                                                        <select name="responsable_er" id="" class="form-control" required>
                                                            <option value="">--Seleccione Responsable--</option>
                                                            <?php
                                                            foreach ($responsables_datos as $responsables_dato) { ?>
                                                                <option value="<?php echo $responsables_dato['id_responsable']; ?>"><?php echo $responsables_dato['nombre_resp']; ?> | <?php echo $responsables_dato['cargo_resp']; ?> </option>
                                                            <?php
                                                            }
                                                            ?>
                                                        </select>


                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <a href="" class="btn btn-secondary">Cancelar</a>
                                            <input type="submit" class="btn btn-primary" value="Guardar">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>

                    <!--fin modal-->


                </div>

                <div class="card-body">
                    <table id="example1" class="table tabe-hover table-condensed">
                        <colgroup>
                            <col width="3%">
                            <col width="10%">
                            <col width="2%">
                            <col width="15%">
                            <col width="25%">
                            <col width="15%">
                            <col width="15%">
                            <col width="10%">
                            <col width="5%">
              


                        </colgroup>
                        <thead class="table-dark">
                            <tr>
                                <th style="text-align: center">#</th>
                                <th style="text-align: left">Fecha</th>
                                <th style="text-align: center"></th>
                                <th style="text-align: left">Codigo</th>
                                <th style="text-align: center">Nombre</th>
                                <th style="text-align: center">Tipo</th>
                                <th style="text-align: left">Centro</th>
                                <th style="text-align: left">Responsable</th>
                                <th style="text-align: left">ACCIONES

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $contador = 0;
                            foreach ($evaluaciones_datos as $evaluacion_dato) {
                                $contador = $contador + 1;
                                $id_evaluacion = $evaluacion_dato['id_evaluacion'];
                            ?>

                                <tr>
                                    <td style="text-align: center"><b><?php echo $contador; ?></b></td>
                                    <td style="text-align: left"><?php echo $evaluacion_dato['fecha_er']; ?></td>
                                    <td style="text-align: left"> <a href="show_er.php?id_evaluacion=<?php echo $id_evaluacion; ?>" style="text-align: right;" class="btn btn-outline-link btn-sm" title="Ver"><i class="fa-solid fa-up-right-from-square"></i></a></td>

                                    <td style="text-align: left"><b><?php echo $evaluacion_dato['codigo_er']; ?></b></td>
                                    <td style="text-align: left"><b><?php echo $evaluacion_dato['nombre_er']; ?></b></td>
                                    <td style="text-align: left"><?php echo $evaluacion_dato['tipoevaluacion_er']; ?></td>
                                               <td style="text-align: left"><?php echo $evaluacion_dato['nombre_cen']; ?></td>
                                    <td style="text-align: left"><?php echo $evaluacion_dato['nombre_resp']; ?></td>
                                    <td style="text-align: left">
                                        <div class="dropdown">
                                            <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Acciones
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-dark" aria-labelledby="dropdownMenuButton">
                                                <a class="dropdown-item" href="show_er.php?id_evaluacion=<?php echo $id_evaluacion; ?>" class="btn btn-warning btn-sm" title="Accede"> <i class="bi bi-folder"></i> Ver</a></a>
                                                <a class="dropdown-item" href="../../app/controllers/evaluacion/delete_evaluacion.php?id_evaluacion=<?php echo $id_evaluacion; ?>" class="btn btn-danger btn-sm btn-font-size" onclick="return confirm('¿Realmente desea eliminar la evalucion PRL?')" title="Eliminar Evaluacion PRL"><i class="bi bi-trash-fill"></i> Eliminar</a>
                                                <a class="dropdown-item" href="../../app/controllers/evaluacion/duplicar_evaluacion.php?id_evaluacion=<?php echo $id_evaluacion; ?>"><i class="bi bi-copy"></i> Duplicar</a>
                                            </div>
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