<?php
session_start();
include('../../app/config.php');

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['sesion_email'])) {
    header('Location: ' . $URL . '/login.php');
    exit();
}

// Verificar si el usuario tiene permiso para acceder a esta página
if ($_SESSION['perfil_usr'] !== 'ADMINISTRADOR' && $_SESSION['perfil_usr'] !== 'USUARIO_PRL') {
    // Si el usuario no es administrador, redirigirlo a su dashboard de usuario
    header('Location: ' . $URL . '/admin/acceso_nopermitido.php');
    exit();
}
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

    .btn-font-size {
        font-size: 12px;
    }
</style>


<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h3 class="m-0">Tareas</h3>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                    <li class="breadcrumb-item"><a href="#">Actividades</a></li>
                    <li class="breadcrumb-item active">Proyectos</li>
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
            <col width="10%">
            <col width="17%">
            <col width="13%">
            <col width="5%">
            <col width="12%">
            <col width="8%">
            <col width="7%">
            <col width="7%">
            <col width="7%">
            <col width="5%">

        </colgroup>
        <thead class="table-dark">
            <tr>
                <th style="text-align: center">#</th>
                <th style="text-align: left">Proyecto</th>
                <th style="text-align: left">Tarea</th>
                <th style="text-align: left">Centro</th>
                <th style="text-align: left">Prioridad</th>
                <th style="text-align: left">Responsable</th>
                <th style="text-align: left">Categoria</th>
                <th style="text-align: left">Fecha Vencim.</th>
                <th style="text-align: left">Fecha realiz.</th>
                <th style="text-align: left">Estado</th>
                <th style="text-align: left"></th>
            </tr>
        </thead>
        <tbody>
            <?php
            $contador = 0;
            foreach ($tareas as $tarea) {
                $contador = $contador + 1;
                $id_tarea = $tarea['id_tarea'];
                $id_proyecto = $tarea['id_proyecto'];
            ?>

                <tr>
                    <td style="text-align: center"><b><?php echo $contador; ?></b></td>
                    <td style="text-align: left"><b><?php echo $tarea['nombre_py']; ?></b></td>
                    <td style="text-align: left"><b><?php echo $tarea['nombre_ta']; ?></b></td>
                    <td style="text-align: left"><?php echo $tarea['nombre_cen']; ?></td>
                    <td style="text-align: left"><?php $tarea['prioridad_ta'];
                                                    if ($tarea['prioridad_ta'] == 'Alta') { ?>
                            <span class='badge badge-warning'>ALTA</span>
                        <?php
                                                    } else if ($tarea['prioridad_ta'] == 'Media') { ?>
                            <span class='badge badge-primary'>MEDIA</span>
                        <?php
                                                    } else { ?>
                            <span class='badge badge-secondary'>BAJA</span>
                        <?php
                                                    }
                        ?>
                    </td>

                    <td style="text-align: left"><?php echo $tarea['nombre_resp']; ?></td>
                    <td style="text-align: left"><?php echo $tarea['categoria_ta']; ?></td>
                    <td style="text-align: left"><?php echo $tarea['fecha_ta']; ?></td>
                    <td style="text-align: left"><?php echo $tarea['fechareal_ta']; ?></td>
                    <td style="text-align: left"><?php $tarea['estado_ta'];
                                                    if ($tarea['estado_ta'] == 'En curso') { ?>
                            <span class='badge badge-info'>En Curso</span>
                        <?php
                                                    } else if ($tarea['estado_ta'] == 'Completado') { ?>
                            <span class='badge badge-success'>Completado</span>
                        <?php
                                                    } else if ($tarea['estado_ta'] == 'Parcialmente hecho') { ?>
                            <span class='badge badge-warning'>Parcialmente hecho</span>
                        <?php
                                                    } else if ($tarea['estado_ta'] == 'Pospuesto') { ?>
                            <span class='badge badge-secondary'>Pospuesto</span>
                        <?php
                                                    } else if ($tarea['estado_ta'] == 'Cancelado') { ?>
                            <span class='badge badge-danger'>Cancelado</span>
                        <?php
                                                    }
                        ?>
                    </td>

                    </td>


                    <td style="text-align: center">
                        <a href="showtareas.php?id_tarea=<?php echo $id_tarea; ?>& id_proyecto=<?php echo $id_proyecto; ?>" class="btn btn-success btn-sm btn-font-size" title="Accede"><i class="bi bi-box-arrow-in-right"></i> entrar</a>

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