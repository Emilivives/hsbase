<?php
include('../../app/config.php');
include('../../admin/layout/parte1.php');
include('../../app/controllers/reconocimientos/listado_reconocimientos.php');
include('../../app/controllers/trabajadores/listado_trabajadores_alfabet.php');
include('../../app/controllers/reconocimientos/listado_citasrm.php');
include('../../app/controllers/maestros/emailsinteres/listado_emailsinteres.php');
?>
<head>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

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


</html>

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
                <?php
                $contadorcitas = 0;
                foreach ($citasrm as $citasrm_dato) {
                    $contadorcitas = $contadorcitas + 1;
                    $id_citarm = $citasrm_dato['id_citarm'];
                } ?>

                <h2><?php echo $contadorcitas; ?><sup style="font-size: 20px"></h2>
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
                <div class="modal fade" id="modal-nuevoreconocimiento">
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
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="">Trabajador</label>
                                                <select name="trabajador_rm" id="" class="form-control">
                                                    <?php
                                                    foreach ($trabajadores as $trabajador) { ?>
                                                        <option value="<?php echo $trabajador['id_trabajador']; ?>"><?php echo $trabajador['nombre_tr'] ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>

                                    </div>



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
                                <td style="text-align: left"><?php echo $reconocimiento['nombre_tr']; ?>   <?php if ($reconocimiento['activo_tr'] == 0) { ?>
                                                <span class='badge badge-danger' style="font-size: 15px;">Baja</span>
                                           
                                            <?php
                                                                        }
                                            ?>
</td>
                                <td style="text-align: left"><?php echo $reconocimiento['nombre_cen']; ?></td>
                               <td style="text-align: center"><?php $newdate1 = date("d-m-Y", strtotime($reconocimiento['fecha_rm']));
                                if ($newdate1 == '01-01-0001'){?> 
                                <span class='badge badge-warning'>NUEVO</span> 
                                <?php } else { echo $newdate1;} ?></td>
                                <td style="text-align: center"><?php $newdate = date("d-m-Y", strtotime($reconocimiento['caducidad_rm']));
                                if ($newdate == '01-01-0001'){?> 
                                <span class='badge badge-warning'>NUEVO</span> 
                                <?php } else { echo $newdate;} ?></td></td>
                                           <?php 
                                $date_now = $fecha;
                                $newdate_future = date('Y-m-d', strtotime($date_now.'+ 15 days'));
                     
                                ?>

                                <td style="text-align: center;"><?php
                                                                if ($reconocimiento['vigente_rm'] == 1 and $reconocimiento['caducidad_rm'] < $fecha) { ?>
                                        <span class='badge badge-danger'>VIGENTE - CADUCADO</span>

                                    <?php
													   } elseif ($reconocimiento['vigente_rm'] == 1 and $reconocimiento['caducidad_rm'] == $fecha and $reconocimiento['caducidad_rm'] < $newdate_future ) { ?>
                                        <span class='badge badge-danger'>VIGENTE - CADUCADO</span>

                                    <?php							
                                                                } elseif ($reconocimiento['vigente_rm'] == 1 and $reconocimiento['caducidad_rm'] > $fecha and $reconocimiento['caducidad_rm'] < $newdate_future ) { ?>
                                        <span class='badge badge-warning'>VIGENTE - A CITAR</span>

                                    <?php

                                    } elseif ($reconocimiento['vigente_rm'] == 1 and $reconocimiento['caducidad_rm'] > $fecha and $reconocimiento['caducidad_rm'] == $newdate_future ) { ?>
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
								<!-- <td style="text-align: center"><?php if ($reconocimiento['fechacita_rm'] < $hoy && $reconocimiento['vigente_rm'] == '1'); ?> <span class='badge-wh-1'><h6><?php date("d-m-Y", strtotime($reconocimiento['fechacita_rm'])); ?></h6></span> <?php date("d-m-Y", strtotime($reconocimiento['fechacita_rm'])); ?> </td>-->
                                 <td style="text-align: center;"><?php echo ($reconocimiento['fechacita_rm'] < $hoy && $reconocimiento['vigente_rm'] == '1') ? "<span class='badge-wh-1'><h6>" . $reconocimiento['fechacita_rm'] . "</h6></span>" : $reconocimiento['fechacita_rm']; ?></td>

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
                                        <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" title="EDITAR RM" data-target="#modal-modificareconocimiento<?php echo $id_reconocimiento; ?>"><i class="bi bi-pencil-square"></i></button>
                                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" title="Email Cita RM" data-target="#modal-emailcita<?php echo $reconocimiento['id_reconocimiento']; ?>"><i class="fa-regular fa-envelope"></i></button>
                                        <a href="../../app/controllers/reconocimientos/delete.php?id_reconocimiento=<?php echo $id_reconocimiento; ?>" class="btn btn-danger btn-sm btn-font-size" onclick="return confirm('¿Realmente desea eliminar el registro?')" title="Eliminar investigación"><i class="bi bi-trash-fill"></i> </a>
                                    </div>
                                </td>
                                      <!--Modal modifica rm-->
                                <div class="modal fade" id="modal-modificareconocimiento<?php echo $id_reconocimiento; ?>" tabindex="-1" aria-labelledby="exampleModalLabel">
                                    <?php include('../../app/controllers/reconocimientos/datos_reconocimiento.php'); ?>
                                    <div class="modal-dialog modal-xl">
                                        <div class="modal-content">
                                            <div class="modal-header" style="background-color:gold">
                                                <h5 class="modal-title" id="modal-modificacita" style="color: black;"><i class="bi bi-person-lines-fill"></i>Recon. Médico - <?php echo $reconocimientos_dato['nombre_tr'] ?> -

                                                    <?php $reconocimientos_dato['activo_tr'];
                                                    if ($reconocimientos_dato['activo_tr'] == 0) { ?>
                                                        <span class='badge badge-danger'>
                                                            <h4>BAJA</h4>
                                                        </span>
                                                    <?php }
                                                    ?>




                                                </h5>
                                                <button type="button" class="close" style="color:black;" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">

                                                <form action="../../app/controllers/reconocimientos/update.php" method="post" enctype="multipart/form-data">

                                                    <div class="row">
                                                        <input type="text" name="id_reconocimiento" value="<?php echo $reconocimientos_dato['id_reconocimiento'] ?>" class="form-control" hidden>


                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="">Trabajador</label>
                                                                <select name="trabajador_rm" id="" class="form-control">
                                                                    <?php
                                                                    foreach ($trabajadores as $trabajador) {
                                                                        $trabajador_tabla = $trabajador['nombre_tr'];
                                                                        $id_trabajador = $trabajador['id_trabajador']; ?>
                                                                        <option value="<?php echo $id_trabajador; ?>" <?php if ($trabajador_tabla == $trabajador_rm) { ?> selected="selected" <?php } ?>>
                                                                            <?php echo $trabajador_tabla; ?>
                                                                        </option>
                                                                    <?php
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>


                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label for="">Fecha Reconocimiento</label>
                                                                    <input type="date" name="fecha_rm" value="<?php echo $reconocimientos_dato['fecha_rm'] ?>" class="form-control">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label for="">Valido hasta</label>
                                                                    <input type="date" name="caducidad_rm" value="<?php echo $reconocimientos_dato['caducidad_rm'] ?>" class="form-control">
                                                                </div>

                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="radio" name="vigente_rm" id="flexRadioDefault3" value="1" <?php if ($reconocimientos_dato['vigente_rm'] == "1") {
                                                                                                                                                                        echo 'Checked';
                                                                                                                                                                    } ?>>
                                                                    <label class="form-check-label" for="flexRadioDefault3">
                                                                        <b><?php $reconocimientos_dato['vigente_rm'];
                                                                            if ($reconocimientos_dato['vigente_rm'] == 1) { ?>
                                                                                <span class='badge badge-success'>VIGENTE</span>
                                                                            <?php } else {
                                                                                echo "Activo";
                                                                            }
                                                                            ?></b>

                                                                    </label>
                                                                </div>

                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="radio" name="vigente_rm" id="flexRadioDefault3" value="0" <?php if ($reconocimientos_dato['vigente_rm'] == "0") {
                                                                                                                                                                        echo 'Checked';
                                                                                                                                                                    } ?>>
                                                                    <label class="form-check-label" for="flexRadioDefault3">
                                                                        <b><?php $reconocimientos_dato['vigente_rm'];
                                                                            if ($reconocimientos_dato['vigente_rm'] == 0) { ?>
                                                                                <span class='badge badge-danger'>NULO</span>
                                                                            <?php } else {
                                                                                echo "Nulo";
                                                                            }
                                                                            ?></b>
                                                                    </label>
                                                                </div>
                                                            </div>



                                                            <div class="col-md-3">
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="radio" name="cita_rm" id="flexRadioDefault5" value="1" <?php if ($reconocimientos_dato['cita_rm'] == "1") {
                                                                                                                                                                        echo 'Checked';
                                                                                                                                                                    } ?>>
                                                                    <label class="form-check-label" for="flexRadioDefault3">
                                                                        <b><?php $reconocimientos_dato['cita_rm'];
                                                                            if ($reconocimientos_dato['cita_rm'] == 1) { ?>
                                                                                <span class='badge badge-success'>CITADO</span>
                                                                            <?php } else {
                                                                                echo "Activo";
                                                                            }
                                                                            ?></b>

                                                                    </label>
                                                                </div>

                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="radio" name="cita_rm" id="flexRadioDefault6" value="1" <?php if ($reconocimientos_dato['cita_rm'] == "0") {
                                                                                                                                                                        echo 'Checked';
                                                                                                                                                                    } ?>>
                                                                    <label class="form-check-label" for="flexRadioDefault3">
                                                                        <b><?php $reconocimientos_dato['cita_rm'];
                                                                            if ($reconocimientos_dato['cita_rm'] == 0) { ?>
                                                                                <span class='badge badge-danger'>NO CITADO</span>
                                                                            <?php } else {
                                                                                echo "Nulo";
                                                                            }
                                                                            ?></b>
                                                                    </label>
                                                                </div>
                                                            </div>

                                                        </div>
                                                        </br>
                                                        <hr>
                                                        <div class="row">
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label for="">Fecha CITA MEDICA</label>
                                                                    <input type="date" name="fechacita_rm" value="<?php echo $reconocimientos_dato['fechacita_rm'] ?>" class="form-control">
                                                                </div>
                                                            </div>
                                                           

                                                        </div>
                                                        </br>
                                                        <hr>

                                                        <div class="row">
                                                            <div class="form-group">
                                                                <label for="">Anotaciones / restricciones</label>
                                                                <textarea class="form-control" name="anotaciones_rm" rows="6"></textarea>
                                                            </div>
                                                        </div>




                                                        <div class="modal-footer">

                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                                            <button type="submit" class="btn btn-primary"><i class="bi bi-envelope-arrow-up"></i></i> Enviar</button>

                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>

                                    </div>


                                </div>
                                <!--fin modal-->
			<!--Modal email cita rm-->
                                <div class="modal fade" id="modal-emailcita<?php echo $reconocimiento['id_reconocimiento']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel">
                                    <div class="modal-dialog modal-xl">
                                        <div class="modal-content">
                                            <div class="modal-header" style="background-color:gold">
                                                <h5 class="modal-title" id="modal-emailcita" style="color: black;"><i class="bi bi-person-lines-fill"></i>Recon. Médico - <?php echo $reconocimiento['nombre_tr'] ?> - Detalles</h5>
                                                <button type="button" class="close" style="color:black;" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">

                                                <form action="../../app/controllers/reconocimientos/enviar_email.php" method="post" enctype="multipart/form-data">

                                                    <div class="row">
                                                        <input type="text" id="id_reconocimiento" name="id_reconocimiento" value="<?php echo $id_reconocimiento ?>" class="form-control" hidden>

                                                        <div class="col-sm-8">
                                                            <div class="form-group row">
                                                                <label for="nombre_tr" class="col-form-label col-sm-2">Nombre</label>
                                                                <div class="col-sm-8">
                                                                    <input type="text" id="nombre_tr" name="nombre_tr" value="<?php echo $reconocimiento['nombre_tr'] ?>" class="form-control" readonly>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <div class="form-group row">
                                                                <label for="dni_tr" class="col-form-label col-sm-4">DNI/NIE</label>
                                                                <div class="col-sm-8">
                                                                    <input type="text" id="dni_tr" name="dni_tr" class="form-control" value="<?php echo $reconocimiento['dni_tr'] ?>" readonly>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div class="row">
                                                        <div class="col-sm-8">
                                                            <div class="form-group row">
                                                                <label for="categoria_tr" class="col-form-label col-sm-2">Puesto</label>
                                                                <div class="col-sm-8">
                                                                    <input type="text" id="categoria_tr" name="categoria_tr" class="form-control" value="<?php echo $reconocimiento['nombre_cat'] ?>" readonly>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <div class="form-group row">
                                                                <label for="centro_tr" class="col-form-label col-sm-4">Centro</label>
                                                                <div class="col-sm-8">
                                                                    <input type="text" id="centro_tr" name="centro_tr" class="form-control" value="<?php echo $reconocimiento['nombre_cen'] ?>" readonly>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-8">
                                                            <div class="form-group row">
                                                                <label for="centro_tr" class="col-form-label col-sm-2">Empresa</label>
                                                                <div class="col-sm-9">
                                                                    <input type="text" id="razonsocial_emp" name="razonsocial_emp" class="form-control" value="<?php echo $reconocimiento['razonsocial_emp'] ?>" readonly>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        </br>
                                                        <hr>

                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="">Destinatario email</label>
                                                                <select name="destinatario" id="destinatario" class="form-control">
                                                                    <?php
                                                                    foreach ($emailsinteres_datos as $emailsinteres_dato) { ?>
                                                                        <option value="<?php echo $emailsinteres_dato['email_ei']; ?>"><?php echo $emailsinteres_dato['nombre_ei'] ?> | <?php echo $emailsinteres_dato['email_ei'] ?></option>
                                                                    <?php
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    </br>
                                                    <hr>
                                                    <div class="row">
                                                        <div class="form-group">
                                                            <label for="">Anotaciones / restricciones</label>
                                                            <textarea class="form-control" name="anotaciones_crm" value="" rows="2"><?php echo $reconocimiento['anotaciones_rm'] ?></textarea>
                                                        </div>
                                                    </div>

                                                    <div class="modal-footer">

                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                                        <button type="submit" class="btn btn-primary"><i class="bi bi-envelope-arrow-up"></i></i> Enviar</button>

                                                    </div>
                                                </form>
                                            </div>
                                        </div>

                                    </div>


                                </div>
                               <!--fin modal-->

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
            "pageLength": 10,
			 "order": [[4, 'desc'], [3, "asc"]],
	
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
