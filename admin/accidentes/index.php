<?php
include('../../app/config.php');
include('../../admin/layout/parte1.php');
include('../../app/controllers/pruebas/listado_trabajadores.php');
include('../../app/controllers/maestros/centros/listado_centros.php');
include('../../app/controllers/actividad/listado_proyectos.php');
include('../../app/controllers/actividad/listado_tareas.php');
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
    .btn-font-size{
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
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-light shadow-sm border">
            <div class="inner">
            <?php
                            $contador_de_proyectos = 0;
                            foreach ($proyectos as $proyecto){
                                $contador_de_proyectos = $contador_de_proyectos + 1;
                            }
                            ?>
                            <h2><?php echo $contador_de_proyectos;?><sup style="font-size: 20px"></h2>
                    <p>Proyectos disponibles</p>
            </div>
            <div class="icon">
                <i class="ion bi-layers-fill"></i>
            </div>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-light shadow-sm border">
            <div class="inner">
            <?php
                            $contador_de_tareas = 0;
                            foreach ($tareas as $tarea){
                                $contador_de_tareas = $contador_de_tareas + 1;
                            }
                            ?>
                            <h2><?php echo $contador_de_tareas;?><sup style="font-size: 20px"></h2>
                    <p>Tareas programadas</p>
            </div>
            <div class="icon">
                <i class="ion bi-list-task"></i>
            </div>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-light shadow-sm border">
            <div class="inner">
            <?php
                            $contador_de_tareas = 0;
                            foreach ($tareas as $tarea){
                                if($tarea['estado_ta']=='En curso'){
                                    $contador_de_tareas = $contador_de_tareas + 1;
                            }
                        }

                            ?>
                            <h2><?php echo $contador_de_tareas;?><sup style="font-size: 20px"></h2>
                    <p>Tareas en curso</p>
            </div>
            <div class="icon">
                <i class="ion bi-check2-square"></i>
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
        <div class="card card-outline card-success">
            <div class="card-header col-md-12">
                <h3 class="card-title"><b>Proyectos</b></h3>
                <style>
                    .btn-text-right {
                        text-align: right;
                    }
                </style>
                <!--boton modal-->
                <div class="btn-text-right">
                    <button type="button" class="btn btn-primary btn-sm btn-font-size" data-toggle="modal" data-target="#modal-nuevotrabajador">Añadir Proyecto</button>
                </div>

                <!--inicio modal nuevo trabajador-->
                <div class="modal fade" id="modal-nuevotrabajador">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <div class="modal-header" style="background-color:#0000a0 ;color:white">
                                <h5 class="modal-title" id="modal-nuevtrabajador">Nuevo Proyecto</h5>
                                <button type="button" class="close" style="color: white;" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">

                                <form action="../../app/controllers/pruebas/create.php" method="post" enctype="multipart/form-data">



                                    <div class="row">
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="">Codigo</label>
                                                <input type="text" name="codigo_tr" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="">DNI/NIE</label>
                                                <input type="text" name="dni_tr" class="form-control" required>
                                            </div>
                                        </div>


                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label for="">APELLIDOS, NOMBRE</label>
                                                <input type="text" name="nombre_tr" class="form-control" required>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="">Fecha Nacimiento</label>
                                                <input type="date" name="fechanac_tr" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="">Fecha Inicio</label>
                                                <input type="date" name="inicio_tr" class="form-control" required>
                                            </div>

                                        </div>

                                    </div>

                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label for="">Centro Trabajo</label>
                                                <select name="centro_tr" id="" class="form-control">
                                                    <?php
                                                    foreach ($centros_datos as $centros_dato) { ?>
                                                        <option value="<?php echo $centros_dato['id_centro']; ?>"><?php echo $centros_dato['nombre_cen']; ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                        </div>
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label for="">Categoria</label>
                                                <select name="categoria_tr" id="" class="form-control">
                                                    <?php
                                                    foreach ($categorias_datos as $categorias_dato) { ?>
                                                        <option value="<?php echo $categorias_dato['id_categoria']; ?>"><?php echo $categorias_dato['nombre_cat']; ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>


                                    </div>
                                    <div class="modal-footer">

                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                        <button type="submit" class="btn btn-primary"><i class="bi bi-floppy"></i> Guardar</button>

                                    </div>
                            </div>
                        </div>

                    </div>

                    <!--fin modal-->


                </div>
                <div class="card-body">
                    <table id="example1" class="table tabe-hover table-condensed table-striped">
                        <colgroup>
                            <col width="5%">
                            <col width="35%">
                            <col width="10%">
                            <col width="10%">
                            <col width="20%">
                            <col width="10%">
                            <col width="10%">

                        </colgroup>
                        <thead class="table-dark">
                            <tr>
                                <th style="text-align: center">#</th>
                                <th style="text-align: left">Proyecto</th>
                                <th style="text-align: left">Fecha In.</th>
                                <th style="text-align: left">Fecha Fin</th>
                                <th style="text-align: left">Avance</th>
                                <th style="text-align: left">Estado</th>
                                <th style="text-align: center">Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $contador = 0;
                            foreach ($proyectos as $proyecto) {
                                $contador = $contador + 1;
                                $id_proyecto = $proyecto['id_proyecto'];
                            ?>

                                <tr>
                                    <td style="text-align: center"><b><?php echo $contador; ?></b></td>
                                    <td style="text-align: left"><b><?php echo $proyecto['nombre_py']; ?></b>

                                    </td>
                                    <td style="text-align: left"><?php echo $newdate = date("d-m-Y", strtotime($proyecto['fechainicio_py'])) ?></td>
                                    <td style="text-align: left"><?php echo $newdate = date("d-m-Y", strtotime($proyecto['fechafin_py'])) ?></td>
                                    <td style="text-align: left"><?php echo $proyecto['responsable_py']; ?></td>

                                    <td style="text-align: left;"><?php $proyecto['estado_py'];
                                                                    if ($proyecto['estado_py'] == 1) { ?>
                                            <span class='badge badge-success'>activo</span>
                                        <?php
                                                                    } else { ?>
                                            <span class='badge badge-danger'>inactivo</span>
                                        <?php
                                                                    }
                                        ?>


                                    </td>


                                    <td style="text-align: center">
                                        <div class="d-grid gap-2 d-md-block" role="group" aria-label="Basic mixed styles example">
                                            <a href="show.php?id_proyecto=<?php echo $id_proyecto; ?>" class="btn btn-primary btn-sm btn-font-size" title="Ver detalles"><i class="bi bi-folder-fill"></i> Ver</a>
                       
                                            <button class="btn btn-secondary btn-sm dropdown-toggle dropdown-font-size" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
                                                Opciones
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-dark dropdown-font-size" aria-labelledby="dropdownMenuButton2">
                                                <li><a class="dropdown-item active" href="#">Action</a></li>
                                                <li><a class="dropdown-item" href="#">Another action</a></li>
                                                <li><a class="dropdown-item" href="#">Something else here</a></li>
                                                <li>
                                                    <hr class="dropdown-divider">
                                                </li>
                                                <li><a class="dropdown-item" href="#">Separated link</a></li>
                                            </ul>
                        

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
                "info": "Mostrando _START_ a _END_ de _TOTAL_ Tareas",
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