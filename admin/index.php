<?php
include('../app/config.php');
include('../admin/layout/parte1.php');
include('../app/controllers/trabajadores/listado_trabajadores.php');
include('../app/controllers/formaciones/listado_formaciones.php');
include('../app/controllers/accidentes/listado_accidentes.php') ?>
<link href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-wordpress-admin/wordpress-admin.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>



<body>

  <!-- CALCULOS ESTADISTICO -->

  <!-- CALCULOS num trabajadores activos -->

  <?php
  $contador_de_trabajadores = 0;
  foreach ($trabajadores as $trabajador) {
    if ($trabajador['activo_tr'] == 1) {
      $contador_de_trabajadores = $contador_de_trabajadores + 1;
    }
  }
  ?>

  <!-- CALCULOS trabajadores formados -->

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
  <?php
  $contador_de_trabajadores;
  $contador_tr_formados;
  $porcentage_formados = ($contador_tr_formados * 100) / $contador_de_trabajadores;
  $porcentage_formados = round($porcentage_formados, 1);
  $porcentage_formados;
  ?>


  <!-- CALCULOS trabajadores embarcados -->

  <?php
  $contador_embarcados = 0;
  foreach ($trabajadores as $trabajador) {
    if ($trabajador['nombre_tc'] == 'Embarcacion' and $trabajador['activo_tr'] == 1) {
      $contador_embarcados = $contador_embarcados + 1;
    }
  }
  $contador_embarcados;
  $porcentage_embarcados = ($contador_embarcados * 100) / $contador_de_trabajadores;
  $porcentage_embarcados = round($porcentage_embarcados, 1)
  ?>

  <!-- CALCULOS trabajadores nuevos año vigente -->

  <?php $fechahoraentera = strtotime($fechahora);
  $anio = date("Y", $fechahoraentera);
  $contador_tr_anio = count(array_filter($trabajadores, fn ($n) => date("Y", strtotime($n['inicio_tr'])) == $anio)); ?>

  <!-- CALCULOS formaciones realizadas en 2024 -->

  <?php $fechahoraentera = strtotime($fechahora);
  $anio = date("Y", $fechahoraentera);
  $contador_de_formaciones = count(array_filter($formaciones_datos, fn ($n) => date("Y", strtotime($n['fecha_fr'])) == $anio)); ?>


  <!-- CALCULOS formaciones por mes de año vigente -->


  <?php $fechahoraentera = strtotime($fechahora);
  $anio = date("Y", $fechahoraentera);
  $contador_formacion_pdt = 0;
  foreach ($formaciones_datos as $formaciones_dato) {
    if (date("Y", strtotime($formaciones_dato['fecha_fr'] == $anio)) and $formaciones_dato['tipo_fr'] == 1) {
      $contador_formacion_pdt = $contador_formacion_pdt + 1;
    }
  }
  $porcentage_formpdt = ($contador_formacion_pdt * 100) / $contador_de_formaciones;
  $porcentage_formpdt = round($porcentage_formpdt, 2); ?>


  <?php
  $fechahoraentera = strtotime($fechahora);
  $anio = date("Y", $fechahoraentera);
  $mes = date("m", $fechahoraentera);
  $contador_de_formaciones_en = 0;
  $contador_de_formaciones_fe = 0;
  $contador_de_formaciones_mr = 0;
  $contador_de_formaciones_ab = 0;
  $contador_de_formaciones_my = 0;
  $contador_de_formaciones_jn = 0;
  $contador_de_formaciones_jl = 0;
  $contador_de_formaciones_ag = 0;
  $contador_de_formaciones_st = 0;
  $contador_de_formaciones_oc = 0;
  $contador_de_formaciones_no = 0;
  $contador_de_formaciones_di = 0;


  foreach ($formaciones_datos as $formaciones_dato) {
    $mesformacion = date("m", strtotime($formaciones_dato['fecha_fr']));
    $anioformacion = date("Y", strtotime($formaciones_dato['fecha_fr']));

    if ($anioformacion == $anio and $mesformacion == 1) {
      $contador_de_formaciones_en = $contador_de_formaciones_en + 1;
    }
    if ($anioformacion == $anio and $mesformacion == 2) {
      $contador_de_formaciones_fe = $contador_de_formaciones_fe + 1;
    }
    if ($anioformacion == $anio and $mesformacion == 3) {
      $contador_de_formaciones_mr = $contador_de_formaciones_mr + 1;
    }
    if ($anioformacion == $anio and $mesformacion == 4) {
      $contador_de_formaciones_ab = $contador_de_formaciones_ab + 1;
    }
    if ($anioformacion == $anio and $mesformacion == 5) {
      $contador_de_formaciones_my = $contador_de_formaciones_my + 1;
    }
    if ($anioformacion == $anio and $mesformacion == 6) {
      $contador_de_formaciones_jn = $contador_de_formaciones_jn + 1;
    }
    if ($anioformacion == $anio and $mesformacion == 7) {
      $contador_de_formaciones_jl = $contador_de_formaciones_jl + 1;
    }
    if ($anioformacion == $anio and $mesformacion == 8) {
      $contador_de_formaciones_ag = $contador_de_formaciones_ag + 1;
    }
    if ($anioformacion == $anio and $mesformacion == 9) {
      $contador_de_formaciones_st = $contador_de_formaciones_st + 1;
    }
    if ($anioformacion == $anio and $mesformacion == 10) {
      $contador_de_formaciones_oc = $contador_de_formaciones_oc + 1;
    }
    if ($anioformacion == $anio and $mesformacion == 11) {
      $contador_de_formaciones_no = $contador_de_formaciones_no + 1;
    }
    if ($anioformacion == $anio and $mesformacion == 12) {
      $contador_de_formaciones_di = $contador_de_formaciones_di + 1;
    }
  }
  ?>

  <!-- CALCULOS trabajadores por puesto -->

  <?php
  $tr_marineros = 0;
  $tr_administracion = 0;
  $tr_marineromaquinas = 0;
  $tr_opermantenimiento = 0;
  $tr_taquilla = 0;
  $tr_amarrador = 0;
  $tr_carga = 0;
  $tr_jefedpto = 0;
  $tr_comercial = 0;
  $tr_tecnicobuque = 0;
  $tr_tecnicoprl = 0;
  $tr_gerencia = 0;
  $tr_primeroficial = 0;
  $tr_jefemaquinas = 0;
  $tr_primeromaquinas = 0;
  $tr_mecaniconaval = 0;
  $tr_azafatapuerto = 0;
  $tr_taquillacarga = 0;
  $tr_vigilante = 0;
  $tr_informatico = 0;
  $tr_auxiliarpasaje = 0;
  $tr_sobrecargo = 0;
  $tr_coordinadorpuerto = 0;
  $tr_azafatapuerto = 0;
  $tr_contramaestre = 0;
  $tr_limpieza = 0;


  foreach ($trabajadores as $trabajador) {
    if ($trabajador['activo_tr'] == 1 and $trabajador['nombre_cat'] == 'Administración') {
      $tr_administracion = $tr_administracion + 1;
    }
    if ($trabajador['activo_tr'] == 1 and $trabajador['nombre_cat'] == 'Marinero') {
      $tr_marineros = $tr_marineros + 1;
    }
    if ($trabajador['activo_tr'] == 1 and $trabajador['nombre_cat'] == 'Marinero máquinas') {
      $tr_marineromaquinas = $tr_marineromaquinas + 1;
    }
    if ($trabajador['activo_tr'] == 1 and $trabajador['nombre_cat'] == 'Operario mantenimiento') {
      $tr_opermantenimiento = $tr_opermantenimiento + 1;
    }
    if ($trabajador['activo_tr'] == 1 and $trabajador['nombre_cat'] == 'Oficial de carga') {
      $tr_taquilla = $tr_taquilla + 1;
    }
    if ($trabajador['activo_tr'] == 1 and $trabajador['nombre_cat'] == 'Jefe departamento') {
      $tr_amarrador = $tr_amarrador + 1;
    }
    if ($trabajador['activo_tr'] == 1 and $trabajador['nombre_cat'] == 'Comercial') {
      $tr_carga = $tr_carga + 1;
    }
    if ($trabajador['activo_tr'] == 1 and $trabajador['nombre_cat'] == 'Técnico de buques') {
      $tr_jefedpto = $tr_jefedpto + 1;
    }
    if ($trabajador['activo_tr'] == 1 and $trabajador['nombre_cat'] == 'Técnico de PRL') {
      $tr_comercial = $tr_comercial + 1;
    }
    if ($trabajador['activo_tr'] == 1 and $trabajador['nombre_cat'] == 'Gerencia') {
      $tr_administracion = $tr_administracion + 1;
    }
    if ($trabajador['activo_tr'] == 1 and $trabajador['nombre_cat'] == 'Primer oficial') {
      $tr_administracion = $tr_administracion + 1;
    }
    if ($trabajador['activo_tr'] == 1 and $trabajador['nombre_cat'] == 'Jefe de máquinas') {
      $tr_administracion = $tr_administracion + 1;
    }
    if ($trabajador['activo_tr'] == 1 and $trabajador['nombre_cat'] == 'Primero de máquinas') {
      $tr_administracion = $tr_administracion + 1;
    }
    if ($trabajador['activo_tr'] == 1 and $trabajador['nombre_cat'] == 'Mecánico naval') {
      $tr_administracion = $tr_administracion + 1;
    }
    if ($trabajador['activo_tr'] == 1 and $trabajador['nombre_cat'] == 'Azafata de puerto') {
      $tr_administracion = $tr_administracion + 1;
    }
    if ($trabajador['activo_tr'] == 1 and $trabajador['nombre_cat'] == 'Taquilla - Carga') {
      $tr_administracion = $tr_administracion + 1;
    }
    if ($trabajador['activo_tr'] == 1 and $trabajador['nombre_cat'] == 'Vigilante') {
      $tr_administracion = $tr_administracion + 1;
    }
    if ($trabajador['activo_tr'] == 1 and $trabajador['nombre_cat'] == 'Informático') {
      $tr_administracion = $tr_administracion + 1;
    }
    if ($trabajador['activo_tr'] == 1 and $trabajador['nombre_cat'] == 'Auxiliar de pasaje') {
      $tr_administracion = $tr_administracion + 1;
    }
    if ($trabajador['activo_tr'] == 1 and $trabajador['nombre_cat'] == 'Sobrecargo') {
      $tr_administracion = $tr_administracion + 1;
    }
    if ($trabajador['activo_tr'] == 1 and $trabajador['nombre_cat'] == 'Coordinador de puerto') {
      $tr_administracion = $tr_administracion + 1;
    }
    if ($trabajador['activo_tr'] == 1 and $trabajador['nombre_cat'] == 'Azafata de puerto') {
      $tr_administracion = $tr_administracion + 1;
    }
    if ($trabajador['activo_tr'] == 1 and $trabajador['nombre_cat'] == 'Contramaestre') {
      $tr_administracion = $tr_administracion + 1;
    }
    if ($trabajador['activo_tr'] == 1 and $trabajador['nombre_cat'] == 'Limpieza') {
      $tr_administracion = $tr_administracion + 1;
    }
  }
  ?>

  <!-- CALCULOS tipo accidente -->
  <?php
  $contador_de_accidentesconbaja = 0;
  foreach ($accidentes_datos as $accidentes_dato) {
    if (($accidentes_dato['tipoaccidente_ta'] == "Accidente con baja") && (date("Y", strtotime($accidentes_dato['fecha_ace'])) == $anio)) {
      $contador_de_accidentesconbaja = $contador_de_accidentesconbaja + 1;
    }
  }
  ?>
  <?php
  $contador_de_accidentessinbaja = 0;
  foreach ($accidentes_datos as $accidentes_dato) {
    if (($accidentes_dato['tipoaccidente_ta'] == "Accidente sin baja") && (date("Y", strtotime($accidentes_dato['fecha_ace'])) == $anio)) {
      $contador_de_accidentessinbaja = $contador_de_accidentessinbaja + 1;
    }
  }
  ?>
  <?php
  $contador_de_accidentesinitinere = 0;
  foreach ($accidentes_datos as $accidentes_dato) {
    if (($accidentes_dato['tipoaccidente_ta'] == "Accidente in itinere") && (date("Y", strtotime($accidentes_dato['fecha_ace'])) == $anio)) {
      $contador_de_accidentesinitinere = $contador_de_accidentesinitinere + 1;
    }
  }
  ?>

  <!--CALCULOS ACCIDENTES POR MES-->
  <?php
  $fechahoraentera = strtotime($fechahora);
  $anio = date("Y", $fechahoraentera);

  // Array asociativo para almacenar los contadores de formaciones por mes
  $contador_de_accidentes_mes = array(
    '01' => 0, '02' => 0, '03' => 0, '04' => 0,
    '05' => 0, '06' => 0, '07' => 0, '08' => 0,
    '09' => 0, '10' => 0, '11' => 0, '12' => 0
  );

  foreach ($accidentes_datos as $accidentes_dato) {
    $mesaccidente = date("m", strtotime($accidentes_dato['fecha_ace']));
    $anioaccidente = date("Y", strtotime($accidentes_dato['fecha_ace']));

    if ($anioaccidente == $anio && isset($contador_de_accidentes_mes[$mesaccidente])) {
      $contador_de_accidentes_mes[$mesaccidente]++;
    }
  }
  ?>
  <script>
    $my_json_string = JSON.parse($contador_de_accidentes_mes);
  </script>






  <!-- FIN  CALCULOS ESTADISTICO -->

  <!--avisos automaticos-->

  <?php
  if ($contador_tr_no_formados > 0) { ?>
    <script>
      swal.fire({
        position: "top-end",
        icon: "warning",
        title: "<h4>Dispones de  <?php echo $contador_tr_no_formados ?> trabajadores no formados!</h4>",
        timer: 1500,
      });
    </script>
  <?php
  }
  ?>

  <!--fin avisos-->
  <br>
  <div class="row">
    <!-- ./col -->
    <div class="col-lg-1 col-6">
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
    <!-- small box -->
    <div class="col-lg-1 col-6">
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

  </div>

  <div class="row">
    <div class="col-6 col-md-3 text-center">
      <div class="card card-danger">
        <div class="card-header">
          <h3 class="card-title">Donut Chart</h3>



          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse">
              <i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove">
              <i class="fas fa-times"></i>
            </button>
          </div>
        </div>
        <div class="card-body">
          <canvas id="donutChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
    <div class="col-6 col-md-3 text-center">
      <div class="card card-danger">
        <div class="card-header">
          <h3 class="card-title">Distribución de accidentes</h3>



          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse">
              <i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove">
              <i class="fas fa-times"></i>
            </button>
          </div>
        </div>
        <div class="card-body">
          <div id="main" style="width:450px;height:250px;"></div>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
    <div class="col-6 col-md-3 text-center">
      <div class="card card-danger">
        <div class="card-header">
          <h3 class="card-title">% Formados Riesgos PDT</h3>



          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse">
              <i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove">
              <i class="fas fa-times"></i>
            </button>
          </div>
        </div>
        <div class="card-body">
          <div id="formaciones" style="width:450px;height:250px;"></div>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>

    <div class="col-6 col-md-3 text-center">
      <div class="card card-danger">
        <div class="card-header">
          <h3 class="card-title">Indices</h3>



          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse">
              <i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove">
              <i class="fas fa-times"></i>
            </button>
          </div>
        </div>
        <div class="card-body">
          <div id="main3" style="width:600px;height:250px;"></div>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
  </div>
  <div class="row">

    <div class="col-6 col-md-3 text-center">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">
            <i class="fa-solid fa-chart-simple"></i> Estadísticas trabajadores
          </h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse">
              <i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove">
              <i class="fas fa-times"></i>
            </button>
          </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <div class="row">

            <div class="col-6 col-md-4 text-center">
              <input type="text" class="knob" data-thickness="0.3" data-angleArc="250" data-angleOffset="-125" value="<?php echo $contador_tr_anio ?>" data-width="90" data-height="90" data-fgColor="#00c0ef">
              <div class="knob-label"><b>Nuevos en <?php echo $anio ?></b></div>
            </div>
            <!-- ./col -->

            <div class="col-6 col-md-4 text-center">
              <input type="text" class="knob" value="<?php echo $porcentage_formados; ?>" data-width="90" data-height="90" data-fgColor="#3c8dbc" data-readonly="true">
              <div class="knob-label"><b>% Formados</b></div>
            </div>
            <!-- ./col -->
            <div class="col-6 col-md-4 text-center">


              <input type="text" class="knob" value="<?php echo $porcentage_embarcados; ?>" data-width="90" data-height="90" data-fgColor="#3c8dbc" data-readonly="true">

              <div class="knob-label"><b>% Embarcados</b></div>
            </div>
            <!-- ./col -->

          </div>
          <!-- /.row -->
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
    <div class="col-6 col-md-3 text-center">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">
            <i class="fa-solid fa-chart-pie"></i>
            <b> Kpi's Formaciones</b>
          </h4>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse">
              <i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove">
              <i class="fas fa-times"></i>
            </button>
          </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <div class="row">

            <div class="col-6 col-md-3 text-center">
              <input type="text" class="knob" data-thickness="0.3" data-angleArc="250" data-angleOffset="-125" value="<?php echo $contador_de_formaciones ?>" data-width="90" data-height="90" data-fgColor="#00c0ef">

              <div class="knob-label"><b>Form. en <?php echo $anio ?></b></div>
            </div>

            <!-- ./col -->
            <div class="col-6 col-md-4 text-center">

              <input type="text" class="knob" value="<?php echo $porcentage_formpdt; ?>" data-width="90" data-height="90" data-fgColor="#3c8dbc" data-readonly="true">

              <div class="knob-label"><b>% Puesto Tº</b></div>
            </div>
            <!-- ./col -->
            <div class="col-6 col-md-4 text-center">


              <input type="text" class="knob" value="<?php echo $porcentage_embarcados; ?>" data-width="90" data-height="90" data-fgColor="#3c8dbc" data-readonly="true">

              <div class="knob-label"><b>% Embarcados</b></div>
            </div>
            <!-- ./col -->


          </div>
          <!-- /.row -->
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>

    <div class="col-6 col-md-3 text-center">
      <!-- Donut chart -->
      <div class="card card-primary card-outline">
        <div class="card-header">
          <h3 class="card-title">
            <i class="far fa-chart-bar"></i>
            <b>Formaciones por mes del <?php echo $anio ?> </b>
          </h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse">
              <i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove">
              <i class="fas fa-times"></i>
            </button>
          </div>
        </div>
        <div class="card-body center">
          <div style="width: 500px">
            <canvas id="graficaformaciones"></canvas>
          </div>

        </div>
        <!-- /.card-body-->
      </div>

    </div>

    <div class="col-6 col-md-3 text-center">
      <!-- Donut chart -->
      <div class="card card-primary card-outline">
        <div class="card-header">
          <h3 class="card-title">
            <i class="far fa-chart-bar"></i>
            <b>Accidentes por mes del <?php echo $anio ?> </b>
          </h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse">
              <i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove">
              <i class="fas fa-times"></i>
            </button>
          </div>
        </div>
        <div class="card-body center">

          <canvas id="graficaaccidentes"></canvas>

        </div>
        <!-- /.card-body-->
      </div>

    </div>

  </div>
</body>
<?php
include('../admin/layout/parte2.php'); ?>

<script>
  //-------------
  //- DONUT CHART -
  //-------------
  // Get context with jQuery - using jQuery's .get() method.
  var donutChartCanvas = $('#donutChart').get(0).getContext('2d')
  var donutData = {
    labels: [
      'Administración',
      'Taquilla',
      'Marinero',
      'Marinero Máquinas',
      'Amarrador',
      'Mantenimiento',
      'Limpieza',
      'Comercial',
      'Capitan',
      'Jefe de Máquinas',
    ],
    datasets: [{
      data: [700, 500, 400, 600, 300, 100, 400, 600, 300, 100],
      backgroundColor: ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de'],
    }]
  }
  var donutOptions = {
    maintainAspectRatio: false,
    responsive: true,
  }
  //Create pie or douhnut chart
  // You can switch between pie and douhnut using the method below.
  new Chart(donutChartCanvas, {
    type: 'doughnut',
    data: donutData,
    options: donutOptions
  })
</script>
<script>
  $(function() {
    /* jQueryKnob */

    $('.knob').knob({
      /*change : function (value) {
       //console.log("change : " + value);
       },
       release : function (value) {
       console.log("release : " + value);
       },
       cancel : function () {
       console.log("cancel : " + this.value);
       },*/
      draw: function() {

        // "tron" case
        if (this.$.data('skin') == 'tron') {

          var a = this.angle(this.cv) // Angle
            ,
            sa = this.startAngle // Previous start angle
            ,
            sat = this.startAngle // Start angle
            ,
            ea // Previous end angle
            ,
            eat = sat + a // End angle
            ,
            r = true

          this.g.lineWidth = this.lineWidth

          this.o.cursor &&
            (sat = eat - 0.3) &&
            (eat = eat + 0.3)

          if (this.o.displayPrevious) {
            ea = this.startAngle + this.angle(this.value)
            this.o.cursor &&
              (sa = ea - 0.3) &&
              (ea = ea + 0.3)
            this.g.beginPath()
            this.g.strokeStyle = this.previousColor
            this.g.arc(this.xy, this.xy, this.radius - this.lineWidth, sa, ea, false)
            this.g.stroke()
          }

          this.g.beginPath()
          this.g.strokeStyle = r ? this.o.fgColor : this.fgColor
          this.g.arc(this.xy, this.xy, this.radius - this.lineWidth, sat, eat, false)
          this.g.stroke()

          this.g.lineWidth = 2
          this.g.beginPath()
          this.g.strokeStyle = this.o.fgColor
          this.g.arc(this.xy, this.xy, this.radius - this.lineWidth + 1 + this.lineWidth * 2 / 3, 0, 2 * Math.PI, false)
          this.g.stroke()

          return false
        }
      }
    })
    /* END JQUERY KNOB */

    //INITIALIZE SPARKLINE CHARTS
    var sparkline1 = new Sparkline($('#sparkline-1')[0], {
      width: 240,
      height: 70,
      lineColor: '#92c1dc',
      endColor: '#92c1dc'
    })
    var sparkline2 = new Sparkline($('#sparkline-2')[0], {
      width: 240,
      height: 70,
      lineColor: '#f56954',
      endColor: '#f56954'
    })
    var sparkline3 = new Sparkline($('#sparkline-3')[0], {
      width: 240,
      height: 70,
      lineColor: '#3af221',
      endColor: '#3af221'
    })

    sparkline1.draw([1000, 1200, 920, 927, 931, 1027, 819, 930, 1021])
    sparkline2.draw([515, 519, 520, 522, 652, 810, 370, 627, 319, 630, 921])
    sparkline3.draw([15, 19, 20, 22, 33, 27, 31, 27, 19, 30, 21])

  })
</script>



<script>
  /*
   * DONUT CHART
   * -----------
   */

  var donutData = [{
      label: 'Series2',
      data: 30,
      color: '#3c8dbc'
    },
    {
      label: 'Series3',
      data: 20,
      color: '#0073b7'
    },
    {
      label: 'Series4',
      data: 50,
      color: '#00c0ef'
    }
  ]
  $.plot('#donut-chart', donutData, {
    series: {
      pie: {
        show: true,
        radius: 1,
        innerRadius: 0.5,
        label: {
          show: true,
          radius: 2 / 3,
          formatter: labelFormatter,
          threshold: 0.1
        }

      }
    },
    legend: {
      show: false
    }
  })
</script>



<script>
  /*
   *  CHART
   * -----------
   */

  const labels = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre']

  const graphi = document.querySelector("#graficaformaciones");

  const data1 = {
    labels: labels,
    datasets: [{
      label: "Num. formaciones x mes",
      data: [<?php echo $contador_de_formaciones_en ?>, <?php echo $contador_de_formaciones_fe ?>, <?php echo $contador_de_formaciones_mr ?>, <?php echo $contador_de_formaciones_ab ?>, <?php echo $contador_de_formaciones_my ?>, <?php echo $contador_de_formaciones_jn ?>, <?php echo $contador_de_formaciones_jl ?>, <?php echo $contador_de_formaciones_ag ?>, <?php echo $contador_de_formaciones_st ?>, <?php echo $contador_de_formaciones_oc ?>, <?php echo $contador_de_formaciones_no ?>, <?php echo $contador_de_formaciones_di ?>],
      backgroundColor: 'rgba(9, 129, 176, 0.2)'
    }]
  };

  const config1 = {
    type: 'bar',
    data: data1,
  };
  new Chart(graphi, config1);
</script>




<script>
  /*
   *  CHART ACCIDENTES POR MES
   * -----------
   */
  const labels2 = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre']

  const graphi2 = document.querySelector("#graficaaccidentes");

  const data2 = {
    labels: labels,
    datasets: [{
      label: "Num. formaciones x mes",
      data: [JSON.parse($contador_de_accidentes_mes)],
      backgroundColor: 'rgba(9, 129, 176, 0.2)'
    }]
  };

  const config2 = {
    type: 'bar',
    data: data1,
  };
  new Chart(graphi2, config2);
</script>



<script>
  /* DONUT CHART*/

  const graph = document.querySelector("#doughnutchart");

  const DATA_COUNT = 5;
  const NUMBER_CFG = {
    count: DATA_COUNT,
    min: 0,
    max: 100
  };

  const data = {
    labels: ['Red', 'Orange', 'Yellow', 'Green', 'Blue'],
    datasets: [{
      label: 'Dataset 1',
      data: Utils.numbers(NUMBER_CFG),
      backgroundColor: Object.values(Utils.CHART_COLORS),
    }]
  };

  const config = {
    type: 'doughnut',
    data: data,
    options: {
      responsive: true,
      plugins: {
        legend: {
          position: 'top',
        },
        title: {
          display: true,
          text: 'Chart.js Doughnut Chart'
        }
      }
    },
  };
</script>

<script type="text/javascript">
  var chartDom = document.getElementById('main');
  var myChart = echarts.init(chartDom);
  var option;

  // This example requires ECharts v5.5.0 or later
  option = {
    tooltip: {
      trigger: 'item'
    },
    legend: {
      top: '5%',
      left: 'center'
    },
    series: [{
      name: '',
      type: 'pie',
      radius: ['40%', '70%'],
      center: ['50%', '70%'],
      // adjust the start and end angle
      startAngle: 180,
      endAngle: 360,
      data: [{
          value: <?php echo $contador_de_accidentesconbaja ?>,
          name: 'Acc. con Baja'
        },
        {
          value: <?php echo $contador_de_accidentessinbaja ?>,
          name: 'Acc. sin Baja'
        },
        {
          value: <?php echo $contador_de_accidentesinitinere ?>,
          name: 'Acc. Itinere'
        },

      ]
    }]
  };

  option && myChart.setOption(option);
</script>

<script type="text/javascript">
  var chartDom = document.getElementById('formaciones');
  var myChart = echarts.init(chartDom);
  var option;

  option = {
    tooltip: {
      formatter: '{a} <br/>{b} : {c}%'
    },
    series: [{
      name: 'Pressure',
      type: 'gauge',
      detail: {
        formatter: '{value}'
      },
      data: [{
        value: <?php echo $porcentage_formados; ?>,
        name: '%'
      }]
    }]
  };

  option && myChart.setOption(option);
</script>

<script>
  //indices de siniestralidad, frecuencia  y gravedad
  var chartDom = document.getElementById('main3');
  var myChart = echarts.init(chartDom);
  var option;

  option = {
    title: {
      text: ''
    },
    tooltip: {
      trigger: 'axis'
    },
    legend: {
      data: ['Email', 'Union Ads', 'Video Ads', 'Direct', 'Search Engine']
    },
    grid: {
      left: '3%',
      right: '4%',
      bottom: '3%',
      containLabel: true
    },
    toolbox: {
      feature: {
        saveAsImage: {}
      }
    },
    xAxis: {
      type: 'category',
      boundaryGap: false,
      data: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Set', 'Oct', 'Nov', 'Dic']
    },
    yAxis: {
      type: 'value'
    },
    series: [{
        name: 'Email',
        type: 'line',
        stack: 'Total',
        data: [120, 132, 101, 134, 90, 230, 210, 210, 210, 210, 210, 210]
      },
      {
        name: 'Union Ads',
        type: 'line',
        stack: 'Total',
        data: [220, 182, 191, 234, 290, 330, 310, 290, 290, 290, 290, 290]
      },
      {
        name: 'Video Ads',
        type: 'line',
        stack: 'Total',
        data: [150, 232, 201, 154, 190, 330, 410, 190, 190, 190, 190, 190]
      },
      {
        name: 'Direct',
        type: 'line',
        stack: 'Total',
        data: [320, 332, 301, 334, 390, 330, 320, 334, 334, 334, 334, 334]
      },
      {
        name: 'Search Engine',
        type: 'line',
        stack: 'Total',
        data: [820, 932, 901, 934, 1290, 1330, 1320, 934, 934, 934, 934, 934]
      }
    ]
  };

  option && myChart.setOption(option);
</script>