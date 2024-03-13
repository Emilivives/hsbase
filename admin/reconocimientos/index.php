<?php
include('../../app/config.php');
include('../../admin/layout/parte1.php');
include('../../app/controllers/reconocimientos/listado_reconocimientos.php');
include('../../app/controllers/trabajadores/listado_trabajadores.php');
include('../../app/controllers/reconocimientos/listado_citasrm.php');
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
    <div class="col-md-8">
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

                <!-- Modal -->


                <div class="modal fade" id="modal-nuevoreconocimiento">
                    <form action="../../app/controllers/reconocimientos/create.php" method="post" enctype="multipart/form-data">
                        <div class="modal-dialog modal-xl">
                            <div class="modal-content">
                                <div class="modal-header" style="background-color:#808000 ;color:white">
                                    <h5 class="modal-title" id="modal-nuevreconocimiento">Reconocimiento Medico realizado</h5>
                                    <button type="button" class="close" style="color: white;" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">Trabajador</label>
                                            <select name="id_trabajador" id="" class="form-control">
                                                <?php
                                                foreach ($trabajadores as $trabajador) { ?>
                                                    <option value="<?php echo $trabajador['id_trabajador']; ?>"><?php echo $trabajador['nombre_tr'] ?></option>
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
                                        </br>
                                        <hr>
                                        <div class="col-md-3">
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
                                        <div class="row">
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
                                </div>
                            </div>
                    </form>
                </div>
            </div>


            <!--fin modal-->



        </div>
        <div class="card-body">
            <table id="example1" class="table table-striped table-bordered table-hover">
                <colgroup>
                    <col width="5%">
                    <col width="20%">
                    <col width="10%">
                    <col width="10%">
                    <col width="10%">
                    <col width="10%">
                    <col width="5%">
                    <col width="20%">
                    <col width="10%">
                </colgroup>
                <thead>
                    <tr>
                        <th style="text-align: center">Num.</th>
                        <th style="text-align: left">Nombre trab.</th>
                        <th style="text-align: left">Puesto</th>
                        <th style="text-align: center">Fecha RM.</th>
                        <th style="text-align: center">Fecha caduc.</th>
                        <th style="text-align: center">Vigente</th>
                        <th style="text-align: center">Citado</th>
                        <th style="text-align: center">Anotaciones</th>
                        <th style="text-align: center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $contador = 0;
                    foreach ($reconocimientos as $reconocimiento) {
                        $contador = $contador + 1;
                        $id_reconocimiento = $reconocimiento['id_reconocimiento'];
                    ?>

                        <tr>
                            <td style="text-align: center"><?php echo $contador; ?></td>
                            <td style="text-align: left"><?php echo $reconocimiento['nombre_tr']; ?></td>
                            <td style="text-align: left"><?php echo $reconocimiento['nombre_cat']; ?></td>
                            <td style="text-align: center"><?php echo $newdate1 = date("d-m-Y", strtotime($reconocimiento['fecha_rm'])); ?></td>
                            <td style="text-align: center"><?php echo $newdate = date("d-m-Y", strtotime($reconocimiento['caducidad_rm'])) ?></td>
                            <?php $newdate_future = strtotime('+15 day', strtotime($fechahora));
                            $newdate_future = date('d-m-Y', $newdate_future);
                            $newdate_future


                            ?>

                            <td style="text-align: left;"><?php
                                                            if ($reconocimiento['vigente_rm'] == 1 and $reconocimiento['caducidad_rm'] < $fechahora) { ?>
                                    <span class='badge badge-danger'>VIGENTE - CADUCADO</span>

                                <?php
                                                            } elseif ($reconocimiento['vigente_rm'] == 1 and date("d-m-Y", strtotime($reconocimiento['caducidad_rm'])) < $newdate_future) { ?>
                                    <span class='badge badge-warning'>VIGENTE - A CITAR</span>

                                <?php

                                                            } elseif ($reconocimiento['vigente_rm'] == 1 and date("d-m-Y", strtotime($reconocimiento['caducidad_rm'])) > $newdate_future) { ?>
                                    <span class='badge badge-success'>VIGENTE <?php date("d-m-Y", strtotime($reconocimiento['caducidad_rm'])) ?></span>
                                <?php
                                                            } else { ?>
                                    <span class='badge badge-secondary'>NO VIGENTE</span>
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
                            <td style="text-align: left"><?php echo $reconocimiento['anotaciones_rm']; ?></td>
                            <td style="text-align: center">
                                <div class="d-grid gap-2 d-md-block" role="group" aria-label="Basic mixed styles example">
                                    <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" title="Modificar RM" data-target="#modal-modificareconocimiento<?php echo $id_reconocimiento; ?>"><i class="bi bi-pencil-square"></i></button>
                                    <a href="../../app/controllers/reconocimientos/delete.php?id_reconocimiento=<?php echo $id_reconocimiento; ?>" class="btn btn-danger btn-sm btn-font-size" onclick="return confirm('¿Realmente desea eliminar el registro?')" title="Eliminar investigación"><i class="bi bi-trash-fill"></i> </a>

                                </div>
                            </td>

                        </tr>
                    <?php
                    }
                    ?>
                    <div class="modal fade" id="modal-modificareconocimiento<?php echo $id_reconocimiento; ?>" tabindex="-1" aria-labelledby="exampleModalLabel">
                        <div class="modal-dialog modal-xl">
                            <div class="modal-content">
                                <div class="modal-header" style="background-color:gold">
                                    <h5 class="modal-title" id="modal-modificareconocimiento" style="color: black;"><i class="bi bi-person-lines-fill"></i>Recon. Médico - <?php echo $reconocimiento['nombre_tr'] ?> - Detalles</h5>
                                    <button type="button" class="close" style="color:black;" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">

                                    <form action="../../app/controllers/reconocimientos/update.php" method="post" enctype="multipart/form-data">

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="">Trabajador</label>
                                                <select name="id_trabajador" id="" class="form-control">
                                                    <?php
                                                    foreach ($trabajadores as $trabajador) { ?>
                                                        <option value="<?php echo $trabajador['id_trabajador']; ?>"><?php echo $trabajador['nombre_tr'] ?></option>
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
                                                <label for="">Estado RM</label>
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
                                                <label for="">Cita RM</label>
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

                                            </br>
                                            <hr>

                                        </div>
                                        <div class="row">
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
                            </div>
                        </div>
                        </form>
                    </div>



                    <!--fin modal-->

                </tbody>

            </table>

        </div>

    </div>


</div>
<div class="col-md-4">
    <div class="card card-outline card-danger">
        <div class="card-header col-md-12">
            <h3 class="card-title"><b>Citas reconocimientos</b></h3>
            <style>
                .btn-text-right {
                    text-align: right;
                }
            </style>
            <!-- Button trigger modal -->
            <div class="btn-text-right">
                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-nuevacita">
                    Nuevo Cita
                </button>
            </div>

            <!-- Modal -->


            <div class="modal fade" id="modal-nuevacita">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header" style="background-color:#808000 ;color:white">
                            <h5 class="modal-title" id="modal-nuevacita">Cita para Reconocimiento Medico</h5>
                            <button type="button" class="close" style="color: white;" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="../../app/controllers/reconocimientos/create_citarm.php" method="post" enctype="multipart/form-data">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">Trabajador</label>
                                        <select name="trabajador_crm" id="" class="form-control">
                                            <?php
                                            foreach ($trabajadores as $trabajador) { ?>
                                                <option value="<?php echo $trabajador['id_trabajador']; ?>"><?php echo $trabajador['nombre_tr'] ?> | <?php echo $trabajador['nombre_cat']  ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Fecha cita</label>
                                            <input type="date" name="fecha_crm" class="form-control">
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="form-group">
                                            <label for="">Anotaciones / restricciones</label>
                                            <textarea class="form-control" name="anotaciones_crm" rows="3"></textarea>
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
            <table id="example2" class="table table-striped table-bordered table-hover">
                <colgroup>
                    <col width="50%">
                    <col width="25%">
                    <col width="25%">
                </colgroup>
                <thead>
                    <tr>
                        <th style="text-align: left">Nombre trab.</th>
                        <th style="text-align: center">Fecha cita</th>
                        <th style="text-align: center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $contadorcitas = 0;
                    foreach ($citasrm as $citasrm_dato) {
                        $contadorcitas = $contadorcitas + 1;
                        $id_citarm = $citasrm_dato['id_citarm'];
                    ?>

                        <tr>
                            <td style="text-align: left"><?php echo $citasrm_dato['nombre_tr']; ?></td>
                            <td style="text-align: center"><?php echo $newdate = date("d-m-Y", strtotime($citasrm_dato['fecha_crm'])) ?></td>
                            <td style="text-align: center">
                                <div class="d-grid gap-2 d-md-block" role="group" aria-label="Basic mixed styles example">
                                    <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" title="Email Cita RM" data-target="#modal-emailcita<?php echo $id_citarm; ?>"><i class="fa-regular fa-envelope"></i></i></button>
                                    <a href="update.php?id_usuario=<?php echo $id_usuario ?>" class="btn btn-warning btn-sm" title="Editar"><i class="bi bi-pencil-square"></i></a>
                                    <a href="../../app/controllers/reconocimientos/delete_cita.php?id_citarm=<?php echo $id_citarm; ?>" class="btn btn-danger btn-sm btn-font-size" onclick="return confirm('¿Realmente desea eliminar el registro?')" title="Eliminar cita RM"><i class="bi bi-trash-fill"></i> </a>

                                </div>
                            </td>


                            <div class="modal fade" id="modal-emailcita<?php echo $id_citarm; ?>" tabindex="-1" aria-labelledby="exampleModalLabel">
                                <div class="modal-dialog modal-xl">
                                    <div class="modal-content">
                                        <div class="modal-header" style="background-color:gold">
                                            <h5 class="modal-title" id="modal-emailcita" style="color: black;"><i class="bi bi-person-lines-fill"></i>Recon. Médico - <?php echo $citasrm_dato['nombre_tr'] ?> - Detalles</h5>
                                            <button type="button" class="close" style="color:black;" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">

                                            <form action="../../app/controllers/reconocimientos/enviar_email.php" method="post" enctype="multipart/form-data">

                                                <div class="row">

                                                    <div class="col-sm-8">
                                                        <div class="form-group row">
                                                            <label for="nombre_tr" class="col-form-label col-sm-2">Nombre</label>
                                                            <div class="col-sm-8">
                                                                <input type="text" id="nombre_tr" name="nombre_tr" value="<?php echo $citasrm_dato['nombre_tr'] ?>" class="form-control" readonly>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <div class="form-group row">
                                                            <label for="dni_tr" class="col-form-label col-sm-4">DNI/NIE</label>
                                                            <div class="col-sm-8">
                                                                <input type="text" id="dni_tr" name="dni_tr" class="form-control" value="<?php echo $citasrm_dato['dni_tr'] ?>" readonly>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-8">
                                                        <div class="form-group row">
                                                            <label for="categoria_tr" class="col-form-label col-sm-2">Puesto</label>
                                                            <div class="col-sm-8">
                                                                <input type="text" id="categoria_tr" name="categoria_tr" class="form-control" value="<?php echo $citasrm_dato['nombre_cat'] ?>" readonly>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <div class="form-group row">
                                                            <label for="centro_tr" class="col-form-label col-sm-4">Centro</label>
                                                            <div class="col-sm-8">
                                                                <input type="text" id="centro_tr" name="centro_tr" class="form-control" value="<?php echo $citasrm_dato['nombre_cen'] ?>" readonly>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <div class="form-group row">
                                                            <label for="centro_tr" class="col-form-label col-sm-2">Empresa</label>
                                                            <div class="col-sm-9">
                                                                <input type="text" id="razonsocial_emp" name="razonsocial_emp" class="form-control" value="<?php echo $citasrm_dato['razonsocial_emp'] ?>" readonly>
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
                                                        <textarea class="form-control" id="anotaciones_crm" name="anotaciones_crm" rows="6"></textarea>
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
<script>
    $(function() {
        $("#example2").DataTable({
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
        }).buttons().container().appendTo("#example2_wrapper .col-md-6:eq(0)");
    });
</script>
<script>
    $(document).ready(function() {
        $('#contactoForm').submit(function(e) {
            e.preventDefault();

            var nombre_tr = $('#nombre_tr').val();
            var dni_tr = $('#dni_tr').val();
            var categoria_tr = $('#categoria_tr').val();
            var centro_tr = $('#centro_tr').val();
            var razonsocial_emp = $('#razonsocial_emp').val();
            var destinatario = $('#destinatario').val();
            var anotaciones_crm = $('#anotaciones_crm').val();





            // Datos del formulario
            var datos = {
                nombre_tr: nombre_tr,
                dni_tr: dni_tr,
                categoria_tr: categoria_tr,
                centro_tr: centro_tr,
                razonsocial_emp: razonsocial_emp,
                destinatario: destinatario,
                anotaciones_crm: anotaciones_crm
            };

            // Enviar datos a través de AJAX
            $.ajax({
                type: 'POST',
                url: '../../app/controllers/reconocimientos/enviar_email.php',
                data: datos,
                success: function(response) {
                    alert(response);
                    $('#contactoForm')[0].reset();
                },
                error: function() {
                    alert('Hubo un error al enviar el correo');
                }
            });
        });
    });
</script>