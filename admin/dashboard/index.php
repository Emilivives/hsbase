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
        <!-- small box -->
        <div class="card">
          <div class="card-header">
            <h5 class="card-title">Accesos directos</h5>
          </div>
          <div class="card-body">

            <a class="btn btn-sm-app bg-secondary">

              <i class="fas fa-regular fa-calendar-plus"></i> Actividad

            </a>
            <!--boton modal-->
            <div class="btn-text-right">
              <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-nuevaactividad">Añadir progreso</button>
            </div>

            <!--inicio modal nueva tarea-->
            <div class="modal fade" id="modal-nuevaactividad">
              <div class="modal-dialog modal-xl">
                <div class="modal-content">
                  <div class="modal-header" style="background-color:#eeeeee ;color:black">
                    <h5 class="modal-title" id="modal-nuevaactividad">Nueva actividad realizada </h5>
                    <button type="button" class="close" style="color: white;" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">

                    <form action="../../app/controllers/actividad/create_actividad.php" method="post" enctype="multipart/form-data">

                      <div class="form-group">
                        <label for="">Proyecto</label>
                        <select name="id_proyecto" id="listaproyecto" class="form-control">
                          <?php
                          foreach ($proyectos as $proyecto) { ?>
                            <option value="<?php echo $proyecto['nombre_py']; ?>"><?php echo $proyecto['nombre_py'] ?></option>
                          <?php
                          }
                          ?>
                        </select>
                      </div>
                      <hr>
                      <br>
                      <div class="form-group">
                        <label for="">Tarea</label>
                        <select name="id_proyecto" id="listaproyecto" class="form-control">
                          <?php
                          foreach ($tareas as $tarea) { ?>
                            <option value="<?php echo $tarea['nombre_ta']; ?>"><?php echo $tarea['nombre_ta'] ?> | <?php $tarea['nombre_py'] ?></option>
                          <?php
                          }
                          ?>
                        </select>
                      </div>
                      <br>
                      <div id="listatarea"></div>


                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="">Fecha <b>*</b></label>
                            <input type="date" name="fecha_acc" class="form-control" required>
                          </div>
                        </div>

                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="">Responsable</label>
                            <input type="text" name="responsable_acc" class="form-control">
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="">Hora Inicio <b>*</b></label>
                            <input type="time" name="horain_acc" class="form-control" required>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="">Hora Fin <b>*</b></label>
                            <input type="time" name="horafin_acc" class="form-control" required>
                          </div>
                        </div>
                        <div class="col-md-12">
                          <div class="form-group">
                            <label for="">Detalles <b>*</b></label>
                            <textarea class="form-control" name="detalles_acc" rows="5"></textarea>
                          </div>
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
            <a class="btn btn-sm-app bg-secondary">

              <i class="fas fa-solid fa-user-plus"></i> Trabajador

            </a>

            <a class="btn btn-sm-app bg-warning">

              <i class="fas fa-envelope"></i> Inbox
            </a>

          </div>
          <!-- /.card-body -->

        </div>
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
            <div class="card-header border-0">
              <div class="d-flex justify-content-between">
                <h3 class="card-title">Online Store Visitors</h3>
                <a href="javascript:void(0);">View Report</a>
              </div>
            </div>
            <div class="card-body">
              <div class="d-flex">
                <p class="d-flex flex-column">
                  <span class="text-bold text-lg">820</span>
                  <span>Visitors Over Time</span>
                </p>
                <p class="ml-auto d-flex flex-column text-right">
                  <span class="text-success">
                    <i class="fas fa-arrow-up"></i> 12.5%
                  </span>
                  <span class="text-muted">Since last week</span>
                </p>
              </div>
              <!-- /.d-flex -->

              <div class="position-relative mb-4">
                <canvas id="visitors-chart" height="200"></canvas>
              </div>

              <div class="d-flex flex-row justify-content-end">
                <span class="mr-2">
                  <i class="fas fa-square text-primary"></i> This Week
                </span>

                <span>
                  <i class="fas fa-square text-gray"></i> Last Week
                </span>
              </div>
            </div>
          </div>
        </div>
        <!-- /.col-md-6 -->
        <div class="col-lg-6">
          <div class="card">
            <div class="card-header border-0">
              <div class="d-flex justify-content-between">
                <h3 class="card-title">Sales</h3>
                <a href="javascript:void(0);">View Report</a>
              </div>
            </div>
            <div class="card-body">
              <div class="d-flex">
                <p class="d-flex flex-column">
                  <span class="text-bold text-lg">$18,230.00</span>
                  <span>Sales Over Time</span>
                </p>
                <p class="ml-auto d-flex flex-column text-right">
                  <span class="text-success">
                    <i class="fas fa-arrow-up"></i> 33.1%
                  </span>
                  <span class="text-muted">Since last month</span>
                </p>
              </div>
              <!-- /.d-flex -->

              <div class="position-relative mb-4">
                <canvas id="sales-chart" height="200"></canvas>
              </div>

              <div class="d-flex flex-row justify-content-end">
                <span class="mr-2">
                  <i class="fas fa-square text-primary"></i> This year
                </span>

                <span>
                  <i class="fas fa-square text-gray"></i> Last year
                </span>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- /.card -->
      <!-- /.card -->
      <div class="row">
        <div class="col-lg-6">
          <div class="card">
            <div class="card-header border-0">
              <div class="d-flex justify-content-between">
                <h3 class="card-title">Tareas PRL</h3>
              </div>
            </div>
            <div class="card-body">
              <table id="example1" class="table tabe-hover table-condensed">
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
                    <th style="text-align: left">Proyecto</th>
                    <th style="text-align: left">Tarea</th>
                    <th style="text-align: left">Centro</th>
                    <th style="text-align: left">Responsable</th>
                    <th style="text-align: left">Fecha Vencim.</th>
                    <th style="text-align: left">Estado</th>
                    <th style="text-align: left"></th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $contador = 0;
                  foreach ($tareaspendientes as $tareapendiente) {
                    $contador = $contador + 1;
                    $id_tarea = $tareapendiente['id_tarea'];
                  ?>

                    <tr>
                      <td style="text-align: center"><b><?php echo $contador; ?></b></td>
                      <td style="text-align: left"><b><?php echo $tareapendiente['nombre_py']; ?></b></td>
                      <td style="text-align: left"><b><?php echo $tareapendiente['nombre_ta']; ?></b></td>
                      <td style="text-align: left"><?php echo $tareapendiente['nombre_cen']; ?></td>
                      <td style="text-align: left"><?php echo $tareapendiente['nombre_resp']; ?></td>
                      <td style="text-align: left"><?php echo $tareapendiente['fecha_ta']; ?></td>
                      <td style="text-align: left"><?php echo $tareapendiente['estado_ta']; ?></td>

                      </td>


                      <td style="text-align: center">
                        <div class="dropdown">
                          <button class="btn btn-secondary btn-sm dropdown-toggle dropdown-font-size" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
                            Opciones
                          </button>
                          <ul class="dropdown-menu dropdown-menu-dark dropdown-font-size" aria-labelledby="dropdownMenuButton2">
                            <li><a class="dropdown-item" href="#">Ver</a></li>
                            <li><a class="dropdown-item" href="#">Editar</a></li>
                            <li>
                              <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="#">Eliminar</a></li>
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




        <!-- /.col-md-6 -->
        <div class="col-lg-6">
          <div class="card">
            <div class="card-header border-0">
              <div class="d-flex justify-content-between">
                <h3 class="card-title">Sales</h3>
                <a href="javascript:void(0);">View Report</a>
              </div>
            </div>
            <div class="card-body">
              <div class="d-flex">
                <p class="d-flex flex-column">
                  <span class="text-bold text-lg">$18,230.00</span>
                  <span>Sales Over Time</span>
                </p>
                <p class="ml-auto d-flex flex-column text-right">
                  <span class="text-success">
                    <i class="fas fa-arrow-up"></i> 33.1%
                  </span>
                  <span class="text-muted">Since last month</span>
                </p>
              </div>
              <!-- /.d-flex -->

              <div class="position-relative mb-4">
                <canvas id="sales-chart" height="200"></canvas>
              </div>

              <div class="d-flex flex-row justify-content-end">
                <span class="mr-2">
                  <i class="fas fa-square text-primary"></i> This year
                </span>

                <span>
                  <i class="fas fa-square text-gray"></i> Last year
                </span>
              </div>
            </div>
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

<?php include('../../admin/layout/parte2.php');
