<?php
include('../../app/config.php');
include('../../admin/layout/parte1.php');
include('../../app/controllers/usuarios/listado_usuarios.php');
include('../../app/controllers/actividad/listado_tareas.php');
include('../../app/controllers/actividad/listado_tareas_pendientes.php');
include('../../app/controllers/actividad/listado_proyectos.php');
include('../../app/controllers/trabajadores/listado_trabajadores.php');
include('../../app/controllers/formaciones/listado_formaciones.php');
include('../../app/controllers/accidentes/listado_accidentes.php');
include('../../app/controllers/reconocimientos/listado_reconocimientos.php');
include('../../app/controllers/reconocimientos/listado_citasrm.php');
include('../../app/controllers/actividad/listado_accionprl.php');
include('../../app/controllers/maestros/responsables/listado_responsables.php');
include('../../app/controllers/maestros/centros/listado_centros.php');
include('../../app/controllers/maestros/empresas/listado_empresas.php');
include('../../app/controllers/maestros/categorias/listado_categorias.php');
?>
<html>
<!-- Google Font: Source Sans Pro -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
<!-- Font Awesome -->
<link rel="stylesheet" href="/public/templates/AdminLTE/plugins/fontawesome-free/css/all.min.css">

<!-- Theme style -->
<link rel="stylesheet" href="../../dist/css/adminlte.min.css">
<!-- Font Awesome -->
<link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
<!-- Ionicons -->
<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
<!-- Main content -->
<div class="content">
  <hr>
  <div class="container-fluid">
    <div class="row">
      <!-- ./col -->
      <div class="col-lg-2 col-6">
        <div class="btn-text-center">
          <button type="button" class="btn btn-warning btn-block btn-sm" data-toggle="modal" data-target="#modal-nuevotrabajador" title="Añadir nuevo trabajador"><i class="bi bi-person-plus-fill"></i>AÑADIR NUEVO TRABAJADOR</button>

        </div>
        <div class="row">

          <div class="btn-text-center">

          </div>

        </div>




        <!-- inicio modal nuevo trabajador-->
        <div class="modal fade" id="modal-nuevotrabajador">
          <div class="modal-dialog modal-xl">
            <div class="modal-content">
              <div class="modal-header" style="background-color:#ffd900 ;color:black">
                <h5 class="modal-title" id="modal-nuevotrabajador">Nuevo Trabajador</h5>
                <button type="button" class="close" style="color: black;" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">

                <form action="../../app/controllers/trabajadores/create.php" method="post" enctype="multipart/form-data">


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
                    <div class="col-md-2">
                      <label for="">Sexo</label>
                      <select class="form-select form-select-sm" name="sexo_tr" aria-label=".form-select-sm example">
                        <option>Seleccione</option>
                        <option value="Hombre">Hombre</option>
                        <option value="Mujer">Mujer</option>
                      </select>

                    </div>
                    <div class="col-md-2">
                      <label for="">Formacion PRL</label>
                      <select class="form-select form-select-sm" name="formacionpdt_tr" aria-label=".form-select-sm example">
                        <option>Seleccione</option>
                        <option value="Si">Si</option>
                        <option value="No">No</option>
                      </select>

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
                          <option value="0">--Seleccione categoria--</option>
                          <?php
                          foreach ($categorias_datos as $categorias_dato) { ?>
                            <option value="<?php echo $categorias_dato['id_categoria']; ?>"><?php echo $categorias_dato['nombre_cat']; ?> </option>
                            </option>
                          <?php
                          }
                          ?>
                        </select>

                      </div>
                    </div>


                  </div>
                  <div class="row">
                    <div class="col-md-8">
                      <div class="form-group">
                        <label for="">ANOTACIONES</label>
                        <input type="text" name="anotaciones_tr" class="form-control">
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

      <div class="row">
        <div class="col-lg-6">
          <div class="card">
            <div class="card-header bg-secondary border-3">
              <div class="d-flex justify-content-between">
                <h3 class="card-title text-center"> <b> TRABAJADORES </b></h3>
                <style>
                  .btn-text-right {
                    text-align: right;
                  }
                </style>

                <div class="btn-text-right">
                  <a href="../trabajadores/index.php" class="btn btn-sm btn-secondary"><i class="bi bi-list-ul"></i> acceder</a>
                </div>
              </div>
            </div>
            <div class="card-body">
              <table id="example3" class="table tabe-hover table-condensed">
                <colgroup>
                  <col width="30%">
                  <col width="10%">
                  <col width="25%">
                  <col width="10%">
                  <col width="7%">

                </colgroup>
                <thead class="table-dark">
                  <tr>
                    <th style="text-align: left">Trabajador</th>
                    <th style="text-align: left">Inicio</th>
                    <th style="text-align: left">Categoria</th>
                    <th style="text-align: center">Formado</th>
                    <th style="text-align: center"></th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $contadortr = 0;
                  foreach ($trabajadores as $trabajador) {
                    if ($trabajador['activo_tr'] == 1) {
                      $contadortr = $contadortr + 1;
                      $id_trabajador = $trabajador['id_trabajador'];
                  ?>

                      <tr>


                        <td><?php echo $trabajador['nombre_tr']; ?></td>

                        <td style="text-align: left"><?php echo $newdate1 = date("d-m-Y", strtotime($trabajador['inicio_tr'])); ?></td>

                        <td><?php echo $trabajador['nombre_cat']; ?></td>

                        <td style="text-align: center;"><?php $trabajador['formacionpdt_tr'];
                                                        if ($trabajador['formacionpdt_tr'] == 'Si') { ?>
                            <span class='badge badge-success'>SI</span>
                          <?php
                                                        } else { ?>
                            <span class='badge badge-danger'>NO</span>
                          <?php
                                                        }
                          ?>


                        </td>
                     
                        <td style="text-align: center;">
                        <a href="../../admin/trabajadores/trabajadorshow.php?id_trabajador=<?php echo $id_trabajador; ?>" class="btn btn-primary btn-sm btn-font-size" title="Ver detalles"><i class="bi bi-folder-fill"></i> Ver</a>
                        </td>

                      </tr>

                  <?php
                    }
                  }
                  ?>

                </tbody>

              </table>



            </div>
          

          </div>
        </div>
        <!-- /.col-md-6 -->
        <div class="col-lg-4">
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
                  <col width="60%">
                  <col width="20%">
                  <col width="10%">
                  <col width="10%">

                </colgroup>
                <thead class="table-dark">
                  <tr>
                    <th style="text-align: left">Trabajador</th>
                    <th style="text-align: left">Vencimiento</th>
                    <th style="text-align: left">Estado</th>
                    <th style="text-align: left">Citado</th>
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

                      <td style="text-align: left"><b><?php echo $reconocimiento['nombre_tr']; ?></b></td>
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

                    </tr>
                  <?php
                  }
                  ?>

                </tbody>

              </table>



            </div>
          </div>
        </div>
        <div class="col-lg-2">
          <div class="card">
            <div class="card-header bg-secondary border-3">
              <div class="d-flex justify-content-between">
                <h3 class="card-title text-center"> <b> CITAS RM </b></h3>
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
              <table id="example2" class="table tabe-hover table-condensed">
                <colgroup>
                  <col width="60%">
                  <col width="40%">


                </colgroup>
                <thead class="table-dark">
                  <tr>
                    <th style="text-align: left">Trabajador</th>
                    <th style="text-align: left">Vencimiento</th>
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
      <div class="row">
      </div>
      <br>
      <!-- /.card -->
      <!-- /.card -->
      <div class="row">
        <div class="col-lg-6">
          <div class="card">
            <div class="card-header bg-secondary border-3">
              <div class="d-flex justify-content-between">
                <h3 class="card-title text-center"> <b> TAREAS PRL </b></h3>
                <style>
                  .btn-text-right {
                    text-align: right;
                  }
                </style>

                <div class="btn-text-right">
                  <a href="../actividad/tareas.php" class="btn btn-sm btn-secondary"><i class="bi bi-list-ul"></i> acceder</a>
                </div>
              </div>
            </div>
            <div class="card-body">
              <table id="example4" class="table tabe-hover table-condensed">
                <colgroup>
                  <col width="5%">
                  <col width="20%">
                  <col width="20%">
                  <col width="15%">
                  <col width="15%">
                  <col width="10%">
                  <col width="5%">
                  <col width="5%">

                </colgroup>
                <thead class="table-dark">
                  <tr>
                    <th style="text-align: center">#</th>
                    <th style="text-align: left">Tarea</th>
                    <th style="text-align: left">Proyecto</th>
                    <th style="text-align: left">Centro</th>
                    <th style="text-align: left">Responsable</th>
                    <th style="text-align: left">Fecha Vencim.</th>
                    <th style="text-align: left">Estado</th>
                    <th style="text-align: left">Acc.</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $contador = 0;
                  foreach ($tareaspendientes as $tareapendiente) {
                    if ($tareapendiente['estado_ta'] != 'Completado') {
                      $contador = $contador + 1;
                      $id_tarea = $tareapendiente['id_tarea'];
                      $id_proyecto = $tareapendiente['id_proyecto'];
                  ?>

                      <tr>
                        <td style="text-align: center"><b><?php echo $contador; ?></b></td>
                        <td style="text-align: left"><b><?php echo $tareapendiente['nombre_ta']; ?></b></td>
                        <td style="text-align: left"><?php echo $tareapendiente['nombre_py']; ?></td>
                        <td style="text-align: left"><?php echo $tareapendiente['nombre_cen']; ?></td>
                        <td style="text-align: left"><?php echo $tareapendiente['nombre_resp']; ?></td>
                        <td style="text-align: left"><?php echo $tareapendiente['fecha_ta']; ?></td>
                        <td style="text-align: left"><?php echo $tareapendiente['estado_ta']; ?></td>

                        </td>


                        <td style="text-align: center">
                          <div class="dropdown">
                            <a href="../actividad/showtareas.php?id_tarea=<?php echo $id_tarea; ?>&id_proyecto=<?php echo $id_proyecto; ?>" class="btn btn-success btn-sm btn-font-size" title="Accede"><i class="bi bi-box-arrow-in-right"></i>Ver</a>

                          </div>

                        </td>

                      </tr>

                  <?php
                    }
                  }
                  ?>

                </tbody>

              </table>
            </div>
          </div>
        </div>




        <!-- /.col-md-3 -->
        <div class="col-lg-3">
          <div class="card">
            <div class="card-header bg-secondary border-3">
              <div class="d-flex justify-content-between">
                <h3 class="card-title text-center"> <b> ACCIONES PRL </b></h3>
                <style>
                  .btn-text-right {
                    text-align: right;
                  }
                </style>

                <div class="btn-text-right">
                  <a href="../accionprl/index.php" class="btn btn-sm btn-secondary"><i class="bi bi-list-ul"></i> acceder</a>
                </div>
              </div>
            </div>
            <div class="card-body">
              <table id="example5" class="table tabe-hover table-condensed">
                <colgroup>

                  <col width="20%">
                  <col width="15%">
                  <col width="40%">
                  <col width="15%">


                </colgroup>
                <thead class="table-dark">
                  <tr>

                    <th style="text-align: left">Fecha</th>
                    <th style="text-align: center">Prioridad</th>

                    <th style="text-align: left">Descripción</th>

                    <th style="text-align: left">Estado</th>


                  </tr>
                </thead>
                <tbody>
                  <?php
                  $contador = 0;
                  foreach ($accionprl_datos as $accionprl_dato) {
                    $contador = $contador + 1;
                    $id_accion = $accionprl_dato['id_accion'];
                  ?>

                    <tr>


                      <td style="text-align: left"><b><?php echo $accionprl_dato['fecha_acc']; ?></b></td>
                      <td style="text-align: center"><?php $accionprl_dato['prioridad_acc']; ?>
                        <?php if ($accionprl_dato['prioridad_acc'] == "Baja") { ?>
                          <span class='badge badge-secondary'>Baja</span>
                        <?php
                        } else if ($accionprl_dato['prioridad_acc'] == "Media") { ?>
                          <span class='badge badge-info'>Media</span>
                        <?php                       } else if ($accionprl_dato['prioridad_acc'] == "Alta") { ?>
                          <span class='badge badge-warning'>Alta</span>
                        <?php                       } else if ($accionprl_dato['prioridad_acc'] == "Urgente") { ?>
                          <span class='badge badge-danger'>Urgente</span>
                        <?php                       }
                        ?>


                      </td>

                      <td style="text-align: left"><?php echo $accionprl_dato['descripcion_acc']; ?></td>


                      <td style="text-align: left"><?php $accionprl_dato['estado_acc']; ?>
                        <?php if ($accionprl_dato['estado_acc'] == "Cerrada") { ?>
                          <span class='badge badge-success'>Cerrada</span>
                        <?php
                        } else if ($accionprl_dato['estado_acc'] == "En curso") { ?>
                          <span class='badge badge-info'>En curso</span>
                        <?php                       } else if ($accionprl_dato['estado_acc'] == "Comunicada") { ?>
                          <span class='badge badge-secondary'>Comunicada</span>
                        <?php                       } else if ($accionprl_dato['estado_acc'] == "Abierta") { ?>
                          <span class='badge badge-warning'>Abierta</span>
                        <?php                       } else if ($accionprl_dato['estado_acc'] == "Finalizada") { ?>
                          <span class='badge badge-primary'>Finalizada</span>
                        <?php                       }
                        ?>


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
        <!-- /.card -->
        <!-- /.col-md-3 -->
        <div class="col-lg-3">
          <div class="card">
            <div class="card-header bg-secondary border-3">
              <div class="d-flex justify-content-between">
                <h3 class="card-title text-center"> <b> ACCIDENTES LABORALES </b></h3>
                <style>
                  .btn-text-right {
                    text-align: right;
                  }
                </style>

                <div class="btn-text-right">
                  <a href="../accidentes/index.php" class="btn btn-sm btn-secondary"><i class="bi bi-list-ul"></i> acceder</a>
                </div>
              </div>
            </div>
            <div class="card-body">
              <table id="example6" class="table tabe-hover table-condensed">
                <colgroup>

                  <col width="20%">
                  <col width="40%">
                  <col width="15%">
                  <col width="20%">
                  <col width="5%">


                </colgroup>
                <thead class="table-dark">
                  <tr>

                    <th style="text-align: left">Fecha</th>
                    <th style="text-align: left">Trab.</th>
                    <th style="text-align: center">Tipo</th>

                    <th style="text-align: left">Gravedad</th>

                    <th style="text-align: left">Delt@</th>


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
                      <td style="text-align: left"><b><?php echo $accidentes_dato['fecha_ace']; ?></b></td>
                      <td style="text-align: left"><?php echo $accidentes_dato['nombre_tr']; ?></td>
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

                      <td style="text-align: left"><?php echo $accidentes_dato['gravedad_gr']; ?></td>
                      <td style="text-align: center;"><?php $accidentes_dato['comunicado_ace'];
                                                      if ($accidentes_dato['comunicado_ace'] == "SI") { ?>
                          <span class='badge badge-success'>SI</span>
                        <?php
                                                      } else if ($accidentes_dato['comunicado_ace'] == "NO") { ?>
                          <span class='badge badge-warning'>NO</span>
                        <?php                       }
                        ?>


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
        <!-- /.card -->
      </div>
      <!-- /.col-md-6 -->
    </div>
    <!-- /.row -->
  </div>
  <!-- /.container-fluid -->
</div>
<!-- /.content -->
<!--</div>
  /.content-wrapper -->

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
  <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->


<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE -->
<script src="dist/js/adminlte.js"></script>

<!-- OPTIONAL SCRIPTS -->
<script src="plugins/chart.js/Chart.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard3.js"></script>
</body>

</html>

<script type="text/javascript">
  $(document).ready(function() {
    $('#listaproyecto').val(1);
    recargarLista();

    $('#listaproyecto').change(function() {
      recargarLista();
    });
  })
</script>
<script type="text/javascript">
  function recargarLista() {
    $.ajax({
      type: "POST",
      url: "/app/controllers/actividad/cargardatos.php",
      data: "id_proyecto=" + $('#listaproyecto').val(),
      success: function(r) {
        $('#listatarea').html(r);
      }
    });
  }
</script>
<script>
  $(function() {
    $("#example1").DataTable({
      "pageLength": 4,
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
        "search": "Busc:",
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
      "pageLength": 4,
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
<script>
  $(function() {
    $("#example3").DataTable({
      "pageLength": 4,
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
        "search": "Busc",
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
    }).buttons().container().appendTo("#example3_wrapper .col-md-6:eq(0)");
  });
</script>
<script>
  $(function() {
    $("#example4").DataTable({
      "pageLength": 4,
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
        "search": "Busc",
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
    }).buttons().container().appendTo("#example4_wrapper .col-md-6:eq(0)");
  });
</script>
<script>
  $(function() {
    $("#example5").DataTable({
      "pageLength": 4,
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
        "search": "Busc",
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
    }).buttons().container().appendTo("#example5_wrapper .col-md-6:eq(0)");
  });
</script>
<script>
  $(function() {
    $("#example6").DataTable({
      "pageLength": 4,
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
        "search": "Busc.",
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
    }).buttons().container().appendTo("#example6_wrapper .col-md-6:eq(0)");
  });
</script>

<?php include('../../admin/layout/parte2.php');
