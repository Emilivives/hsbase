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

// Incluir la cabecera de la página
include('../../admin/layout/parte1.php');

// Cargar los datos necesarios
include('../../app/controllers/formaciones/listado_formaciones.php');
include('../../app/controllers/trabajadores/listado_trabajadores_alfabet.php');
include('../../app/controllers/trabajadores/listado_tr_formacioncaducada.php');
include('../../app/controllers/trabajadores/listado_tr_noformado.php');
include('../../app/controllers/trabajadores/listado_trabajadores.php');
include('../../app/controllers/formaciones/tipoformacion/listado_tipoformaciones.php');
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
                <h5 class="m-0"><b>Formaciones Realizadas</b></h5>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="../index.php">Inicio</a></li>
                    <li class="breadcrumb-item active">Control formaciones</li>
                </ol>
            </div><!-- /.col -->

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
                <?php $fechahoraentera = strtotime($fechahora);
                $anio = date("Y", $fechahoraentera);
                $contador_de_formaciones = count(array_filter($formaciones_datos, fn ($n) => date("Y", strtotime($n['fecha_fr'])) == $anio)); ?>
                <h2><?php echo $contador_de_formaciones; ?><sup style="font-size: 20px"></h2>
                <p>Formaciones año: <?php echo $anio; ?></p>

            </div>
            <div class="icon">
                <i class="ion bi-person-arms-up"></i>
            </div>

        </div>
    </div>

    <div class="col-lg-2 col-6">
        <!-- small box -->
        <!-- contador trabajadores no formados -->
        <?php
        $contador_tr_no_formados = 0;
        $contador_tr_formados = 0;
        foreach ($trabajadores as $trabajador) {
            if ($trabajador['activo_tr'] == 1 and $trabajador['formacionpdt_tr'] == 'Si') {
                $contador_tr_formados = $contador_tr_formados + 1;
            } elseif ($trabajador['activo_tr'] == 1 and $trabajador['formacionpdt_tr'] == 'No') {
                $contador_tr_no_formados = $contador_tr_no_formados + 1;
            }
        }

        ?>
        <!-- fin contador trabajadores no formados -->
        <div class="small-box bg-<?php echo ($contador_tr_no_formados > 0) ? 'warning' : 'light'; ?> shadow-sm border">
            <div class="inner">


                <h2><?php echo $contador_tr_no_formados; ?><sup style="font-size: 20px"></h2>
                <p>Pendientes Formar</p>

            </div>
            <div class="icon">
                <i class="fas fa-book" data-toggle="modal" data-target="#modal-pendientesformar"></i>
            </div>

            <!-- inicio modal nuevo trabajador-->
            <div class="modal fade" id="modal-pendientesformar">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header" style="background-color:#138fec ;color:black">
                            <h5 class="modal-title" id="modal-pendientesformar">TRABAJADORES PENDIENTES FORMAR</h5>
                            <button type="button" class="close" style="color: white;" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <table id="" class="table table-sm">
                                <colgroup>
                                    <col width="40%">
                                    <col width="20%">
                                    <col width="30%">
                                    <col width="10%">
                                </colgroup>
                                <thead>
                                    <tr>

                                        <th style="text-align: center">Nombre</th>
                                        <th style="text-align: center">Categoria</th>
                                        <th style="text-align: center">Centro</th>
                                        <th style="text-align: center">Empresa</th>
                                        <th style="text-align: center">-</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $contador = 0;
                                    foreach ($trabajadores_noformados as $trabajador_noformados) {
                                        $contador = $contador + 1;
                                    ?>

                                        <tr>
                                            <td style="text-align: center"><?php echo $trabajador_noformados['nombre_tr']; ?></td>
                                            <td style="text-align: center"><?php echo $trabajador_noformados['nombre_cat']; ?></td>
                                            <td style="text-align: center"><?php echo $trabajador_noformados['nombre_cen']; ?></td>
                                            <td style="text-align: center"><?php echo $trabajador_noformados['nombre_emp']; ?></td>
                                            <td style="text-align: center;"> <a href="../../admin/trabajadores/trabajadorshow.php?id_trabajador=<?php echo $trabajador_noformados['id_trabajador']; ?>" class="btn btn-primary btn-sm" title="Ver detalles"></i> Ver</a>


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

     <!-- ./col -->
     <div class="col-lg-1 col-6">
        <!-- small box -->
        <div class="small-box bg-light shadow-sm border">
            <div class="inner">
                <?php
                $sql = "SELECT COUNT(DISTINCT fas.idtrabajador_fas) AS expiring_count
        FROM form_asistencia fas
        INNER JOIN formacion fr ON fas.nroformacion = fr.nroformacion
        INNER JOIN tipoformacion tf ON fr.tipo_fr = tf.id_tipoformacion
        WHERE tf.art19_tf = 1
          AND fr.fechacad_fr BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL 3 MONTH)";

                $query = $pdo->prepare($sql);
                $query->execute();
                $result = $query->fetch(PDO::FETCH_ASSOC);
                $expiring_count = $result['expiring_count'];
                ?>

                <h2><?php echo $expiring_count; ?><sup style="font-size: 20px"></h2>
                <p>Formaciones vencidas</p>
            </div>
            <div class="icon">
            <i class="fas bi-calendar-x" data-toggle="modal" data-target="#modal-formacioncaducada"></i>
            </div>
           
             <!--  modal mostrar trabajadores con formacion a caducar-->
             <div class="modal fade" id="modal-formacioncaducada">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header" style="background-color:#138fec ;color:black">
                            <h5 class="modal-title" id="modal-formacioncaducada">FORMACION CADUCADA</h5>
                            <button type="button" class="close" style="color: white;" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <table id="" class="table table-sm">
                                <colgroup>
                                    <col width="40%">
                                    <col width="20%">
                                    <col width="30%">
                                    <col width="10%">
                                </colgroup>
                                <thead>
                                    <tr>

                                        <th style="text-align: center">Nombre</th>
                                        <th style="text-align: center">Categoria</th>
                                        <th style="text-align: center">Centro</th>
                                        <th style="text-align: center">Empresa</th>
                                        <th style="text-align: center">-</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $contador = 0;
                                    foreach ($trabajadores_formacioncaducada as $trabajador_formacioncaducada) {
                                        $contador = $contador + 1;
                                    ?>

                                        <tr>
                                            <td style="text-align: center"><?php echo $trabajador_formacioncaducada['nombre_tr']; ?></td>
                                            <td style="text-align: center"><?php echo $trabajador_formacioncaducada['nombre_cat']; ?></td>
                                            <td style="text-align: center"><?php echo $trabajador_formacioncaducada['nombre_cen']; ?></td>
                                            <td style="text-align: center"><?php echo $trabajador_formacioncaducada['nombre_emp']; ?></td>
                                            <td style="text-align: center;"> <a href="../../admin/trabajadores/trabajadorshow.php?id_trabajador=<?php echo $trabajador_formacioncaducada['id_trabajador']; ?>" class="btn btn-primary btn-sm" title="Ver detalles"></i> Ver</a>


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


    <!-- ./col -->
    <div class="col-lg-2 col-6">
        <!-- small box -->
        <div class="small-box bg-light shadow-sm border">
            <div class="inner">
                <?php
                $contador_de_trabajadores = 0;
                foreach ($trabajadores as $trabajador) {
                    if ($trabajador['activo_tr'] == 1) {
                        $contador_de_trabajadores = $contador_de_trabajadores + 1;
                    }
                }
                ?>

                <h2><?php echo $contador_de_trabajadores; ?><sup style="font-size: 20px"></h2>
                <p>Trabajadores activos</p>
            </div>
            <div class="icon">
                <i class="ion bi-person-arms-up"></i>
            </div>

        </div>
    </div>


</div>
<!-- /.content-header -->


<div class="col-md-12">
    <div class="card card-outline card-primary">
        <div class="card-header col-md-12">
            <h3 class="card-title"><b>Formaciones Realizadas</b></h3>
            <style>
                .btn-text-right {
                    text-align: right;
                }
            </style>
            <div class="btn-text-right">
                <a href="../formacion/create.php" class="btn btn-primary btn-sm"><i class="bi bi-person-lines-fill"></i>Nueva Formación</a>
            </div>


        </div>
        <div class="card-body">
            <table id="example1" class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th style="text-align: center">Num.</th>
                        <th style="text-align: center">Formacion nº</th>
						 <th style="text-align: center">Empresa</th>
                        <th style="text-align: center">Tipo Form.</th>
                        <th style="text-align: center">Detalles</th>
                        <th style="text-align: center">Nombre trab.</th>
                        <th style="text-align: center">H/M</th>
                        <th style="text-align: center">Categoria</th>
                        <th style="text-align: center">Fecha Form.</th>
                        <th style="text-align: center">Fecha Caduc.</th>
                        <th style="text-align: center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $contador = 0;
                    foreach ($formaciones_datos as $formaciones_dato) {
                        $contador = $contador + 1;
                        $id_formacion = $formaciones_dato['id_formacion'];
                    ?>

                        <tr>
                            <td style="text-align: center"><?php echo $contador; ?></td>
                            <td style="text-align: center"><?php echo $formaciones_dato['nroformacion']; ?></td>
							<td style="text-align: center"><?php echo $formaciones_dato['nombre_emp']; ?></td>
                            <td>
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-link" data-toggle="modal" data-target="#modal-tipoformacion<?php echo $id_formacion; ?>">
                                    <?php echo $formaciones_dato['nombre_tf']; ?>
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="modal-tipoformacion<?php echo $id_formacion; ?>">
                                    <div class="modal-dialog modal-xl">
                                        <div class="modal-content">
                                            <div class="modal-header" style="background-color:#808000 ;color:white">
                                                <h5 class="modal-title" id="modal-tipoformacion<?php echo $formaciones_dato['nombre_tf']; ?>">Tipo de Formación</h5>
                                                <button type="button" class="close" style="color: white;" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">

                                                <div class="row">
                                                    <div class="col-md-9">
                                                        <div class="form-group">
                                                            <label for="">Nombre formación</label>
                                                            <input type="text" value="<?php echo $formaciones_dato['nombre_tf']; ?>" class="form-control" disabled>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <label for="">Duracion</label>
                                                            <input type="text" value="<?php echo $formaciones_dato['duracion_tf']; ?>" class="form-control" disabled>hrs.
                                                        </div>

                                                    </div>
                                                    <div class="col-md-1">
                                                        <div class="form-group">
                                                            <label for="">Validez</label>
                                                            <input type="text" value="<?php echo $formaciones_dato['validez_tf']; ?>" class="form-control" disabled>
                                                        </div>

                                                    </div>
                                                    <div class="col-md-12">
                                                        <label for="">Contenido formación</label>
                                                        <textarea class="form-control" id="<?php echo $formaciones_dato['detalles_tf']; ?>" name="$id_formacion" rows="20" disabled><?php echo $formaciones_dato['detalles_tf']; ?></textarea>

                                                    </div>
                                                </div>


                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>



                                <!--fin modal-->


                            </td>
                            <td style="text-align: left"><?php echo $formaciones_dato['detalle_fr']; ?></td>

                            <td style="text-align: left"> <a href="../trabajadores/trabajadorshow.php?id_trabajador=<?php echo $formaciones_dato['idtrabajador_fas'];?>"> <?php echo $formaciones_dato['nombre_tr']; ?></a></td>
                            <td style="text-align: left"> <?php echo $formaciones_dato['sexo_tr']; ?></a></td>
                            <td style="text-align: left"> <?php echo $formaciones_dato['nombre_cat']; ?></a></td>
                            <td style="text-align: center"><?php echo $newdate = date("d-m-Y", strtotime($formaciones_dato['fecha_fr'])); ?></td>
                            <td style="text-align: center"><?php echo $newdate = date("d-m-Y", strtotime($formaciones_dato['fechacad_fr'])); ?></td>

                            </td>


                            <td style="text-align: center">
                                <div class="d-grid gap-2 d-md-block" role="group" aria-label="Basic mixed styles example">
                                    <a href="show.php?id_formacion=<?php echo $id_formacion; ?>" class="btn btn-secondary btn-sm" title="Ver detalles"><i class="bi bi-person-lines-fill"></i></a>
                                    <a href="update.php?id_usuario=<?php echo $id_usuario ?>" class="btn btn-warning btn-sm" title="Editar"><i class="bi bi-pencil-square"></i></a>
                                    <a href="../../app/controllers/formaciones/delete.php?id_formacion=<?php echo $id_formacion ?>" class="btn btn-danger btn-sm" title="Eliminar"><i class="bi bi-trash3-fill"></i></a>

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