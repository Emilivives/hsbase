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
include('../../app/controllers/reconocimientos/listado_reconocimientos.php');
include('../../app/controllers/trabajadores/listado_trabajadores_alfabet.php');
include('../../app/controllers/maestros/emailsinteres/listado_emailsinteres.php');
?>

<head>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- select2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@x.x.x/dist/select2-bootstrap4.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <style>
        .dropdown-font-size {
            font-size: 12px;
        }

        .vencido {
            background-color: red;
            color: white;
        }

        .badge-wh-1 {
            display: inline-block;
            min-width: 1px;
            padding: 1px 1px;
            font-size: 13px;
            font-weight: bold;
            color: #fff;
            background-color: #f58da3;
            line-height: 6;
            vertical-align: bottom;
            white-space: nowrap;
            text-align: center;
            border-radius: 5px;
        }

        .highlight {
            border-top: 3px solid #ff0000;
            /* Puedes ajustar el color y el estilo del borde */
        }
    </style>

</head>
<html>
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


<html>

<div class="row">
    <div class="col-lg-2 col-6">
        <!-- small box -->
        <div class="small-box bg-light shadow-sm border">
            <div class="inner">
                <?php
                $fechahoraentera = strtotime($fechahora);
                $anio = date("Y", $fechahoraentera);
                $contador_de_reconocimientos = 0;
                foreach ($reconocimientos as $reconocimiento) {
                    if (($reconocimiento['vigente_rm']) == 1) {
                        $contador_de_reconocimientos = $contador_de_reconocimientos + 1;
                    }
                }
                ?>

                <h2><?php echo $contador_de_reconocimientos; ?><sup style="font-size: 20px"></h2>
                <p>Reconocimientos médicos en <?php echo  $anio ?></p>
            </div>
            <div class="icon">
                <i class="fa-solid fa-heart-circle-check"></i>
            </div>

        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-2 col-6">
        <!-- small box -->
        <div class="small-box bg-light shadow-sm border">
            <div class="inner">
                <?php
                $newdate_future = strtotime('+15 day', strtotime($fechahora));
                $newdate_future = date('d-m-Y', $newdate_future);
                $newdate_future;
                $fechahoraentera = strtotime($fechahora);
                $anio = date("Y", $fechahoraentera);
                $contador_de_rmcaducados = 0;
                foreach ($reconocimientos as $reconocimiento) {
                    if ($reconocimiento['vigente_rm'] == 1 and $reconocimiento['caducidad_rm'] < $fechahora) {
                        $contador_de_rmcaducados = $contador_de_rmcaducados + 1;
                    }
                }
                ?>


                </td>

                <h2><?php echo $contador_de_rmcaducados; ?><sup style="font-size: 20px"></h2>
                <p>Reconocimientos caducados en <?php echo  $anio ?></p>
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
                $newdate_future = strtotime('+15 day', strtotime($fechahora));
                $newdate_future = date('d-m-Y', $newdate_future);
                $newdate_future;
                $fechahoraentera = strtotime($fechahora);
                $anio = date("Y", $fechahoraentera);
                $contador_de_rmacitar = 0;
                foreach ($reconocimientos as $reconocimiento) {
                    if ($reconocimiento['vigente_rm'] == 1 and date("d-m-Y", strtotime($reconocimiento['caducidad_rm'])) < $newdate_future and $reconocimiento['cita_rm'] == 0) {
                        $contador_de_rmacitar = $contador_de_rmacitar + 1;
                    }
                }
                ?>


                </td>

                <h2><?php echo $contador_de_rmacitar; ?><sup style="font-size: 20px"></h2>
                <p>A citar <?php echo  $anio ?></p>
            </div>
            <div class="icon">
                <i class="fa-solid fa-hospital-user"></i>
            </div>

        </div>
    </div>
    <div class="col-lg-2 col-6">
        <div class="small-box bg-light shadow-sm border">
            <div class="inner">
                <?php
                $contador_de_trabajadores = 0;
                foreach ($trabajadores as $trabajador) {
                    if ($trabajador['nombre_tc'] == 'Edificio' and $trabajador['activo_tr'] == 1) {
                        $contador_de_trabajadores = $contador_de_trabajadores + 1;
                    }
                }
                ?>

                <h2><?php echo $contador_de_trabajadores; ?><sup style="font-size: 20px"></h2>
                <p>Pers. tierra</p>
            </div>
            <div class="icon">
                <i class="ion bi-buildings"></i>
            </div>
        </div>
    </div>
    <div class="col-lg-2 col-6">
        <div class="small-box bg-light shadow-sm border">
            <div class="inner">

                <p>Citas programadas</p>
            </div>
            <div class="icon">
                <i class="ion bi-buildings"></i>
            </div>
        </div>
    </div>
</div>

</div>
<!-- /.content-header -->
<div class="row">
    <div class="col-md-12">
        <div class="card card-outline card-primary">
            <div class="card-header col-md-12">
                <h3 class="card-title"><b>Reconocimientos medicos registrados</b></h3>
                <style>
                    .btn-text-right {
                        text-align: right;
                    }
                </style>
                <!-- Button trigger modal -->
                <div class="btn-text-right">
                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-nuevoreconocimiento">
                        Nuevo RM
                    </button>
                </div>


                <!-- inicio modal nuevo reconocimiento-->
                <div class="modal fade" id="modal-nuevoreconocimiento" role="dialog" aria-labelledby="modal-nuevoreconocimiento" aria-hidden="true">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <div class="modal-header" style="background-color:#ffd900 ;color:black">
                                <h5 class="modal-title" id="modal-nuevoreconocimiento">Nuevo Reconocimiento</h5>
                                <button type="button" class="close" style="color: black;" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">

                                <form action="../../app/controllers/reconocimientos/create.php" method="post" enctype="multipart/form-data">


                                    <div class="row">
                                        <div class="col-md-8">
                                            <label for="tarea">Trabajador</label>
                                            <div class="input-group">
                                                <select name="trabajador_rm" id="trabajador_rm" class="trabajador_rm">
                                                    <option value="">Seleccione un trabajador</option>
                                                    <?php
                                                    foreach ($trabajadores as $trabajador) { ?>
                                                        <option value="<?php echo $trabajador['id_trabajador']; ?>"><?php echo $trabajador['nombre_tr'] ?> // <?php echo $trabajador['nombre_emp'] ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <br>


                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="">Fecha Reconocimiento</label>
                                                <input type="date" name="fecha_rm" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="">Valido hasta</label>
                                                <input type="date" name="caducidad_rm" class="form-control">
                                            </div>

                                        </div>
                                        <div class="col-md-3">
                                            <br>
                                            <div class="form-check ">
                                                <input class="form-check-input" type="radio" value="1" name="vigente_rm" id="flexRadioDefault1" checked>
                                                <label class="form-check-label" for="flexRadioDefault1">
                                                    <b>Vigente</b>
                                                </label>

                                            </div>

                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" value="0" name="vigente_rm" id="flexRadioDefault2">
                                                <label class="form-check-label" for="flexRadioDefault2">
                                                    <b>No Vigente</b>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <br>
                                            <div class="form-check ">
                                                <input class="form-check-input" type="radio" value="1" name="cita_rm" id="citaRadioDefault1">
                                                <label class="form-check-label" for="flexRadioDefault1">
                                                    <b>Citado</b>
                                                </label>

                                            </div>

                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" value="0" name="cita_rm" id="flexRadioDefault2" checked>
                                                <label class="form-check-label" for="flexRadioDefault2">
                                                    <b>No Citado</b>
                                                </label>
                                            </div>

                                        </div>


                                    </div>
                                    <hr>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="">Anotaciones / restricciones</label>
                                                <textarea class="form-control" name="anotaciones_rm" rows="6"></textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal-footer">

                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                        <button type="submit" class="btn btn-primary"><i class="bi bi-floppy"></i> Guardar</button>

                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
                <!--fin modal-->


            </div>

            <div class="card-body">
                <table id="example1" class="table table-striped table-bordered table-hover">
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
                        $contador = 0;
                        $hoy = date('Y-m-d'); // Obtener la fecha actual
                        foreach ($reconocimientos as $reconocimiento) {
                            $contador = $contador + 1;
                            $id_reconocimiento = $reconocimiento['id_reconocimiento'];
                        ?>

                            <tr>
                                <td style="text-align: left"><a href="../trabajadores/trabajadorshow.php?id_trabajador=<?php echo $reconocimiento['trabajador_rm']; ?>"><?php echo $reconocimiento['nombre_tr']; ?> <?php if ($reconocimiento['activo_tr'] == 0) { ?>
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


                                <td style="text-align: center;">
                                    <?php
                                    // Verificar si la fecha no es nula antes de formatearla
                                    if (!empty($reconocimiento['fechacita_rm']) && $reconocimiento['fechacita_rm'] !== null) {
                                        $fechaFormateada = date('d/m/Y', strtotime($reconocimiento['fechacita_rm']));

                                        echo ($reconocimiento['fechacita_rm'] < $hoy && $reconocimiento['vigente_rm'] == '1')
                                            ? "<span class='badge-wh-1'><h6>" . $fechaFormateada . "</h6></span>"
                                            : $fechaFormateada;
                                    } else {
                                        // Mostrar un guión o valor por defecto si la fecha está vacía
                                        echo '-';
                                    }
                                    ?>
                                </td>


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
                                        <a href="#modal-modificareconocimiento<?php echo $id_reconocimiento; ?>" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#modal-modificareconocimiento<?php echo $id_reconocimiento; ?>"><i class="bi bi-pencil-square"></i> </a>

                                        <a href="#modal-emailcita<?php echo $id_reconocimiento; ?>" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modal-emailcita<?php echo $id_reconocimiento; ?>"><i class="fa-regular fa-envelope"></i></a>

                                        <a href="../../app/controllers/reconocimientos/delete.php?id_reconocimiento=<?php echo $id_reconocimiento; ?>" class="btn btn-danger btn-sm btn-font-size" onclick="return confirm('¿Realmente desea eliminar el registro?')" title="Eliminar investigación"><i class="bi bi-trash-fill"></i> </a>
                                    </div>
                                </td>
                                <?php include('modal-modificareconocimiento.php') ?>
                                <?php include('modal-emailcita.php') ?>


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

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


    <script>
        $(document).ready(function() {
            $('#trabajador_rm').select2({
                dropdownParent: $('#modal-nuevoreconocimiento .modal-body'),
                theme: 'bootstrap4',
            });
        });
    </script>

    <script>
        $(function() {
            // Agregar tipo de columna personalizada para ordenar fechas en formato DD-MM-YYYY
            $.fn.dataTable.ext.type.order['date-dd-mmm-yyyy-pre'] = function(d) {
                // Convertir la fecha a un formato que DataTables pueda ordenar correctamente (YYYYMMDD)
                if (d === 'NUEVO') { // Maneja el caso cuando la fecha es 'NUEVO'
                    return Infinity; // Para que 'NUEVO' siempre aparezca al final o al principio
                }

                var dateParts = d.split('-');
                return dateParts[2] + dateParts[1] + dateParts[0];
            };

            $("#example1").DataTable({
                "pageLength": 15,
                "order": [
                    [4, 'desc'],
                    [3, 'asc']
                ], // Ordenar por la columna de caducidad
                "columnDefs": [{
                    "targets": 3, // Índice de la columna de caducidad
                    "type": 'date-dd-mmm-yyyy'
                }],
                "language": {
                    "emptyTable": "No hay información",
                    "info": "Mostrando _START_ a _END_ de _TOTAL_ Usuarios",
                    "infoEmpty": "Mostrando 0 a 0 de 0 Usuarios",
                    "infoFiltered": "(Filtrado de MAX total Usuarios)",
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
                        text: "Visor de columnas"
                    }
                ],
            }).buttons().container().appendTo("#example1_wrapper .col-md-6:eq(0)");
        });
    </script>

</html>