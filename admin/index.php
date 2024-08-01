<?php
include('../app/config.php');
include('../admin/layout/parte1.php');
include('../app/controllers/trabajadores/listado_trabajadores.php');
include('../app/controllers/formaciones/listado_formaciones.php');
include('../app/controllers/accidentes/listado_accidentes.php');
include('../app/controllers/actividad/listado_accionprl.php'); ?>
<link href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-wordpress-admin/wordpress-admin.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
<script src="echarts.js"></script>

<!-- Toastr CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<!-- Toastr JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<style>
        /* Estilo personalizado para el toast */
        .toast-custom .toast-message {
            font-size: 20px; /* Ajusta el tamaño de la fuente según tus necesidades */
        }
    </style>


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
  <!-- CALCULOS num trabajadores activos mujer -->

  <?php
  $contador_tr_mujer = 0;
  foreach ($trabajadores as $trabajador) {
    if ($trabajador['activo_tr'] == 1 and $trabajador['sexo_tr'] == 'Mujer') {
      $contador_tr_mujer = $contador_tr_mujer + 1;
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
  $contador_formacion_esp = 0;
  foreach ($formaciones_datos as $formaciones_dato) {
    if (date("Y", strtotime($formaciones_dato['fecha_fr'] == $anio)) and $formaciones_dato['tipo_fr'] == 1) {
      $contador_formacion_pdt = $contador_formacion_pdt + 1;
    } elseif (date("Y", strtotime($formaciones_dato['fecha_fr'] == $anio)) and $formaciones_dato['tipo_fr'] == 3) {
      $contador_formacion_pdt = $contador_formacion_pdt + 1;
    } elseif (date("Y", strtotime($formaciones_dato['fecha_fr'] == $anio)) and $formaciones_dato['nombre_tf'] <> 1 or 3) {
      $contador_formacion_esp = $contador_formacion_esp + 1;
    }
  }
  $porcentage_formpdt = ($contador_formacion_pdt * 100) / $contador_de_formaciones;
  $porcentage_formpdt = round($porcentage_formpdt, 1);
  $porcentage_formesp = ($contador_formacion_esp * 100) / $contador_de_formaciones;
  $porcentage_formesp = round($porcentage_formesp, 1); ?>


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
  $tr_administracion = 0;
  $tr_embarcados = 0;
  $tr_comercial = 0;
  $tr_puerto = 0;
  $tr_taller = 0;
  $tr_direccion = 0;

  foreach ($trabajadores as $trabajador) {
    if ($trabajador['activo_tr'] == 1 and $trabajador['nombre_dpo'] == 'Administración') {
      $tr_administracion = $tr_administracion + 1;
    }
    if ($trabajador['activo_tr'] == 1 and $trabajador['nombre_dpo'] == 'Embarcado') {
      $tr_embarcados = $tr_embarcados + 1;
    }
    if ($trabajador['activo_tr'] == 1 and $trabajador['nombre_dpo'] == 'Comercial') {
      $tr_comercial = $tr_comercial + 1;
    }
    if ($trabajador['activo_tr'] == 1 and $trabajador['nombre_dpo'] == 'Puerto') {
      $tr_puerto = $tr_puerto + 1;
    }
    if ($trabajador['activo_tr'] == 1 and $trabajador['nombre_dpo'] == 'Taller - mantenimiento') {
      $tr_taller = $tr_taller + 1;
    }
    if ($trabajador['activo_tr'] == 1 and $trabajador['nombre_dpo'] == 'Direccion') {
      $tr_direccion = $tr_direccion + 1;
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
  $contador_de_accidentesinitineresinbaja = 0;
  foreach ($accidentes_datos as $accidentes_dato) {
    if (($accidentes_dato['tipoaccidente_ta'] == "Accidente in itinere sin baja") && (date("Y", strtotime($accidentes_dato['fecha_ace'])) == $anio)) {
      $contador_de_accidentesinitineresinbaja = $contador_de_accidentesinitineresinbaja + 1;
    }
  }
  ?>
  <?php
  $contador_de_accidentesinitinereconbaja = 0;
  foreach ($accidentes_datos as $accidentes_dato) {
    if (($accidentes_dato['tipoaccidente_ta'] == "Accidente in itinere con baja") && (date("Y", strtotime($accidentes_dato['fecha_ace'])) == $anio)) {
      $contador_de_accidentesinitineresconbaja = $contador_de_accidentesinitinereconbaja + 1;
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
  $contador_de_accidentesinitineresinbaja = 0;
  foreach ($accidentes_datos as $accidentes_dato) {
    if (($accidentes_dato['tipoaccidente_ta'] == "Accidente in itinere sin baja") && (date("Y", strtotime($accidentes_dato['fecha_ace'])) == $anio)) {
      $contador_de_accidentesinitineresinbaja = $contador_de_accidentesinitineresinbaja + 1;
    }
  }
  ?>
  <?php
  $contador_de_accidentesinitinereconbaja = 0;
  foreach ($accidentes_datos as $accidentes_dato) {
    if (($accidentes_dato['tipoaccidente_ta'] == "Accidente in itinere con baja") && (date("Y", strtotime($accidentes_dato['fecha_ace'])) == $anio)) {
      $contador_de_accidentesinitinereconbaja = $contador_de_accidentesinitinereconbaja + 1;
    }
  }
  ?>

  <!-- CALCULOS siniestralidad -->

  <?php
  $total_accidentes = $contador_de_accidentessinbaja + $contador_de_accidentesconbaja + $contador_de_accidentesinitineresinbaja + $contador_de_accidentesinitinereconbaja;


  ?>

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

  <?php
  $total_accidentesconbaja = $contador_de_accidentesconbaja + $contador_de_accidentesinitinereconbaja;
  $total_accidentes = $contador_de_accidentesconbaja + $contador_de_accidentessinbaja + $contador_de_accidentesinitineresinbaja + $contador_de_accidentesinitinereconbaja;
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



  <!-- CALCULOS accidentes por mes de año vigente -->

  <?php $fechahoraentera = strtotime($fechahora);
  $fechahoraentera = strtotime($fechahora);
  $anio = date("Y", $fechahoraentera);
  $contador_de_accidentesconbaja = 0;
  $contador_accidentes_sin_comunicar = 0;
  foreach ($accidentes_datos as $accidentes_dato) {
    if (($accidentes_dato['tipoaccidente_ta'] == "Accidente con baja" or $accidentes_dato['tipoaccidente_ta'] == "Accidente in itinere con baja") && (date("Y", strtotime($accidentes_dato['fecha_ace'])) == $anio)) {
      $contador_de_accidentesconbaja = $contador_de_accidentesconbaja + 1;
    }
    if (($accidentes_dato['comunicado_ace'] == "NO")) {
      $contador_accidentes_sin_comunicar =   $contador_accidentes_sin_comunicar + 1;
    }
  }
  $contador_de_accidentesconbaja
  //$siniestralidad = ($contador_accidentes * 100) / $contador_de_formaciones;
  // $porcentage_contador_accidentes = round($siniestralidad, 2); 
  ?>


  <?php
  $fechahoraentera = strtotime($fechahora);
  $anio = date("Y", $fechahoraentera);
  $mes = date("m", $fechahoraentera);
  $contador_de_accidentes_en = 0;
  $contador_de_accidentes_fe = 0;
  $contador_de_accidentes_mr = 0;
  $contador_de_accidentes_ab = 0;
  $contador_de_accidentes_my = 0;
  $contador_de_accidentes_jn = 0;
  $contador_de_accidentes_jl = 0;
  $contador_de_accidentes_ag = 0;
  $contador_de_accidentes_st = 0;
  $contador_de_accidentes_oc = 0;
  $contador_de_accidentes_no = 0;
  $contador_de_accidentes_di = 0;


  foreach ($accidentes_datos as $accidentes_dato) {
    $mesaccidente = date("m", strtotime($accidentes_dato['fecha_ace']));
    $anioaccidente = date("Y", strtotime($accidentes_dato['fecha_ace']));

    if ($anioaccidente == $anio and $mesaccidente == 1) {
      $contador_de_accidentes_en = $contador_de_accidentess_en + 1;
    }
    if ($anioaccidente == $anio and $mesaccidente == 2) {
      $contador_de_accidentes_fe = $contador_de_accidentes_fe + 1;
    }
    if ($anioaccidente == $anio and $mesaccidente == 3) {
      $contador_de_accidentes_mr = $contador_de_accidentes_mr + 1;
    }
    if ($anioaccidente == $anio and $mesaccidente == 4) {
      $contador_de_accidentes_ab = $contador_de_accidentes_ab + 1;
    }
    if ($anioaccidente == $anio and $mesaccidente == 5) {
      $contador_de_accidentes_my = $contador_de_accidentes_my + 1;
    }
    if ($anioaccidente == $anio and $mesaccidente == 6) {
      $contador_de_accidentes_jn = $contador_de_accidentes_jn + 1;
    }
    if ($anioaccidente == $anio and $mesaccidente == 7) {
      $contador_de_accidentes_jl = $contador_de_accidentes_jl + 1;
    }
    if ($anioaccidente == $anio and $mesaccidente == 8) {
      $contador_de_accidentes_ag = $contador_de_accidentes_ag + 1;
    }
    if ($anioaccidente == $anio and $mesaccidente == 9) {
      $contador_de_accidentes_st = $contador_de_accidentes_st + 1;
    }
    if ($anioaccidente == $anio and $mesaccidente == 10) {
      $contador_de_accidentes_oc = $contador_de_accidentes_oc + 1;
    }
    if ($anioaccidente == $anio and $mesaccidente == 11) {
      $contador_de_accidentes_no = $contador_de_accidentes_no + 1;
    }
    if ($anioaccidente == $anio and $mesaccidente == 12) {
      $contador_de_accidentes_di = $contador_de_accidentes_di + 1;
    }
  }
  ?>

  <!-- CALCULOS ACCIONES CORRECTORAS por año vigente -->
  <?php
  $contador_de_acciones = 0;
  $contador_de_acciones_abiertas = 0;
  $contador_de_acciones_cerradas = 0;
  $contador_de_acciones_evaluacion = 0;
  $contador_de_acciones_accidente = 0;
  $contador_de_acciones_propuesta = 0;
  $contador_de_acciones_riesgo = 0;

  foreach ($accionprl_datos as $accionprl_dato) {
    if ((date("Y", strtotime($accionprl_dato['fecha_acc'])) == $anio)) {
      $contador_de_acciones = $contador_de_acciones + 1;
    }
    if ((date("Y", strtotime($accionprl_dato['fecha_acc'])) == $anio and $accionprl_dato['estado_acc'] != 'Cerrada')) {
      $contador_de_acciones_abiertas = $contador_de_acciones_abiertas + 1;
    }

    if ((date("Y", strtotime($accionprl_dato['fecha_acc'])) == $anio and $accionprl_dato['estado_acc'] == 'Cerrada')) {
      $contador_de_acciones_cerradas = $contador_de_acciones_cerradas + 1;
    }
    if ((date("Y", strtotime($accionprl_dato['fecha_acc'])) == $anio and $accionprl_dato['origen_acc'] == 'Evaluacion de riesgos')) {
      $contador_de_acciones_evaluacion = $contador_de_acciones_evaluacion + 1;
    }
    if ((date("Y", strtotime($accionprl_dato['fecha_acc'])) == $anio and $accionprl_dato['origen_acc'] == 'Accidente de trabajo')) {
      $contador_de_acciones_accidente = $contador_de_acciones_accidente + 1;
    }
    if ((date("Y", strtotime($accionprl_dato['fecha_acc'])) == $anio and $accionprl_dato['origen_acc'] == 'Propuesta de mejora')) {
      $contador_de_acciones_propuesta = $contador_de_acciones_propuesta + 1;
    }
    if ((date("Y", strtotime($accionprl_dato['fecha_acc'])) == $anio and $accionprl_dato['origen_acc'] == 'Comunicado de riesgos')) {
      $contador_de_acciones_riesgo = $contador_de_acciones_riesgo + 1;
    }
  }
  ?>





  <!-- FIN  CALCULOS ESTADISTICO -->

  <!--avisos automaticos

  <?php
  if ($contador_tr_no_formados > 0) { ?>
    <script>
      swal.fire({
        position: "top-end",
        icon: "warning",
        title: "<h6>Dispones de  <?php echo $contador_tr_no_formados ?> trabajadores no formados!   <br> <br> <?php if ($contador_accidentes_sin_comunicar > 0) { ?> Tienes <?php echo $contador_accidentes_sin_comunicar ?> accidentes no comunicados!</h6><?php } ?>  ",
        timer: 5000,
      });
    </script>
  <?php
  }
  ?>-->






  <!--fin avisos-->
  <?php echo $contador_de_acciones ?> // <?php echo $contador_de_acciones_abiertas ?> // <?php echo $contador_de_acciones_cerradas ?>

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
      <div class="small-box bg-warning shadow-sm border">
        <div class="inner">
          <h2><?php echo $contador_de_accidentes; ?><sup style="font-size: 20px"></h2>
          <p>Accidentes en <?php echo  $anio ?></p>
        </div>
        <div class="icon">
          <i class="fa-solid fa-person-falling-burst"></i>
        </div>



      </div>
    </div>
    <div class="col-lg-1 col-6">
      <!-- small box -->
      <div class="small-box bg-warning shadow-sm border">
        <div class="inner">
          <h2><?php echo $total_accidentesconbaja; ?><sup style="font-size: 20px"></h2>
          <p>Con baja en <?php echo  $anio ?></p>
        </div>
        <div class="icon">
          <i class="fa-solid fa-user-injured"></i>
        </div>



      </div>
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
              <input type="text" class="knob" value="<?php echo $porcentage_formados; ?>" data-width="90" data-height="90" data-fgColor="#af577b" data-readonly="true">
              <div class="knob-label"><b>% Formados</b></div>
            </div>
            <!-- ./col -->
            <div class="col-6 col-md-4 text-center">


              <input type="text" class="knob" value="<?php echo $porcentage_embarcados; ?>" data-width="90" data-height="90" data-fgColor="#3c8dbc" data-readonly="true">

              <div class="knob-label"><b>% Embarcados</b></div>
            </div>
            <!-- ./col -->

          </div>
          <div class="row">

            <div class="col-6 col-md-4 text-center">
              <input type="text" class="knob" data-thickness="0.3" data-angleArc="250" data-angleOffset="-125" value="<?php echo $contador_tr_mujer ?>" data-width="90" data-height="90" data-fgColor="#00c0ef">

              <div class="knob-label"><b>% Mujeres</b></div>
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
          <div class="row">

            <div class="col-6 col-md-4 text-center">
              <input type="text" class="knob" data-thickness="0.3" data-angleArc="250" data-angleOffset="-125" value="<?php echo $contador_tr_anio ?>" data-width="90" data-height="90" data-fgColor="#C39BD3 ">
              <div class="knob-label"><b>Nuevos en <?php echo $anio ?></b></div>
            </div>
            <!-- ./col -->

            <div class="col-6 col-md-4 text-center">
              <input type="text" class="knob" value="<?php echo $porcentage_formados; ?>" data-width="90" data-height="90" data-fgColor="#C39BD3" data-readonly="true">
              <div class="knob-label"><b>% Formados</b></div>
            </div>
            <!-- ./col -->
            <div class="col-6 col-md-4 text-center">


              <input type="text" class="knob" value="<?php echo $porcentage_embarcados; ?>" data-width="90" data-height="90" data-fgColor="#C39BD3" data-readonly="true">

              <div class="knob-label"><b>% Embarcados</b></div>
            </div>
            <!-- ./col -->

          </div>
          <div class="row">

            <div class="col-6 col-md-4 text-center">
              <input type="text" class="knob" data-thickness="0.3" data-angleArc="250" data-angleOffset="-125" value="<?php echo $contador_de_formaciones ?>" data-width="90" data-height="90" data-fgColor="#C39BD3">

              <div class="knob-label"><b>Form. en <?php echo $anio ?></b></div>
            </div>

            <!-- ./col -->
            <div class="col-6 col-md-4 text-center">

              <input type="text" class="knob" value="<?php echo $porcentage_formpdt; ?>" data-width="90" data-height="90" data-fgColor="#C39BD3" data-readonly="true">

              <div class="knob-label"><b>% Puesto Tº</b></div>
            </div>
            <!-- ./col -->
            <div class="col-6 col-md-4 text-center">


              <input type="text" class="knob" value="<?php echo $porcentage_formesp; ?>" data-width="90" data-height="90" data-fgColor="#C39BD3" data-readonly="true">

              <div class="knob-label"><b>% especif.</b></div>
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
      <div class="card card-success">
        <div class="card-header">
          <h3 class="card-title">ACCIONES PREVENTIVAS / CORRECTORAS</h3>
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
          <div class="row">
            <div id="accionprl" style="width:300px;height:250px;"></div>
            <div id="accionprl2" style="width:300px;height:250px;"></div>
          </div>
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
              <input type="text" class="knob" data-thickness="0.3" data-angleArc="250" data-angleOffset="-125" value="<?php echo $contador_tr_anio ?>" data-width="90" data-height="90" data-fgColor="#C39BD3 ">
              <div class="knob-label"><b>Nuevos en <?php echo $anio ?></b></div>
            </div>
            <!-- ./col -->

            <div class="col-6 col-md-4 text-center">
              <input type="text" class="knob" value="<?php echo $porcentage_formados; ?>" data-width="90" data-height="90" data-fgColor="#C39BD3" data-readonly="true">
              <div class="knob-label"><b>% Formados</b></div>
            </div>
            <!-- ./col -->
            <div class="col-6 col-md-4 text-center">


              <input type="text" class="knob" value="<?php echo $porcentage_embarcados; ?>" data-width="90" data-height="90" data-fgColor="#C39BD3" data-readonly="true">

              <div class="knob-label"><b>% Embarcados</b></div>
            </div>
            <!-- ./col -->

          </div>
          <div class="row">

            <div class="col-6 col-md-4 text-center">
              <input type="text" class="knob" data-thickness="0.3" data-angleArc="250" data-angleOffset="-125" value="<?php echo $contador_de_formaciones ?>" data-width="90" data-height="90" data-fgColor="#C39BD3">

              <div class="knob-label"><b>Form. en <?php echo $anio ?></b></div>
            </div>

            <!-- ./col -->
            <div class="col-6 col-md-4 text-center">

              <input type="text" class="knob" value="<?php echo $porcentage_formpdt; ?>" data-width="90" data-height="90" data-fgColor="#C39BD3" data-readonly="true">

              <div class="knob-label"><b>% Puesto Tº</b></div>
            </div>
            <!-- ./col -->
            <div class="col-6 col-md-4 text-center">


              <input type="text" class="knob" value="<?php echo $porcentage_formesp; ?>" data-width="90" data-height="90" data-fgColor="#C39BD3" data-readonly="true">

              <div class="knob-label"><b>% especif.</b></div>
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
          <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        </div>
        <div class="card-body center">
          <div style="width: 500px">
            <canvas id="graficaaccidentes"></canvas>
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

          <div id="main6" style="width: 300px;height:200px;"></div>

        </div>
        <!-- /.card-body-->
      </div>

    </div>


  </div>
  <div class="row">
    <div class="col-6 col-md-3 text-center">
      <div class="card card-secandary">
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
      <div class="card card-secandary">
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
      <div class="card card-secandary">
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
      <div class="card card-success">
        <div class="card-header">
          <h3 class="card-title">ACCIONES PREVENTIVAS</h3>



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
          <div id="" style="width:450px;height:250px;"></div>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
  </div>
</body>
<?php
include('../admin/layout/parte2.php'); ?>$contador_tr_no_formados
<script>
  //AVISOS AUTOMATICOS TOAST

  document.addEventListener('DOMContentLoaded', (event) => {
        toastr.options = {
            "positionClass": "toast-top-right",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut",
            "toastClass": "toast-custom", // Añadir la clase personalizada
            "onclick": null // Inicialmente nulo, configuraremos el evento nosotros mismos

        };

        <?php if ($contador_tr_no_formados > 0): ?>
            var toast1 = toastr.info('<?= $contador_tr_no_formados ?> Trabajadores pendientes de formar');
            toast1.on('click', function() {
                window.location.href = "<?php echo $URL; ?>/admin/trabajadores/trabajadorshow.php?id_trabajador=1";
            });
        <?php endif; ?>

        <?php if ($contador_accidentes_sin_comunicar > 0): ?>
            var toast2 = toastr.warning('<?= $contador_accidentes_sin_comunicar ?> accidentes sin comunicar');
            toast2.on('click', function() {
                window.location.href = "<?php echo $URL; ?>/admin/accidentes/index.php";
            });
        <?php endif; ?>
    });

   

</script>

<script>
  //-------------
  //- DONUT CHART -
  //-------------
  // Get context with jQuery - using jQuery's .get() method.
  var donutChartCanvas = $('#donutChart').get(0).getContext('2d')
  var donutData = {
    labels: [
      'Administracion',
      'Embarcados',
      'Comercial',
      'Puerto',
      'Taller',
      'Direccion',

    ],
    datasets: [{
      data: [<?php echo $tr_administracion ?>, <?php echo $tr_embarcados ?>, <?php echo $tr_comercial ?>, <?php echo $tr_puerto ?>, <?php echo $tr_taller ?>, <?php echo $tr_direccion ?>],
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
   *  CHART
   * -----------
   */

  const labels2 = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];

  const graphi2 = document.getElementById('graficaaccidentes').getContext('2d');

  const data2 = {
    labels: labels2,
    datasets: [{
      label: "Num. accidentes por mes",
      data: [
        <?php echo $contador_de_accidentes_en; ?>,
        <?php echo $contador_de_accidentes_fe; ?>,
        <?php echo $contador_de_accidentes_mr; ?>,
        <?php echo $contador_de_accidentes_ab; ?>,
        <?php echo $contador_de_accidentes_my; ?>,
        <?php echo $contador_de_accidentes_jn; ?>,
        <?php echo $contador_de_accidentes_jl; ?>,
        <?php echo $contador_de_accidentes_ag; ?>,
        <?php echo $contador_de_accidentes_st; ?>,
        <?php echo $contador_de_accidentes_oc; ?>,
        <?php echo $contador_de_accidentes_no; ?>,
        <?php echo $contador_de_accidentes_di; ?>
      ],
      backgroundColor: 'rgba(9, 129, 176, 0.2)',
      borderColor: 'rgba(9, 129, 176, 1)',
      borderWidth: 1
    }]
  };

  const config2 = {
    type: 'bar',
    data: data2,
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
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

  option && myChart.setOption('option');
</script>

<script>
  //GAUGE CHART//
  var chartDom = document.getElementById('accionprl');
  var myChart = echarts.init(chartDom);
  var option;
  const gaugeData = [{
      value: 20,
      name: 'Total',
      title: {
        offsetCenter: ['0%', '-30%']
      },
      detail: {
        valueAnimation: true,
        offsetCenter: ['0%', '-20%']
      }
    },
    {
      value: 40,
      name: 'Good',
      title: {
        offsetCenter: ['0%', '0%']
      },
      detail: {
        valueAnimation: true,
        offsetCenter: ['0%', '10%']
      }
    },
    {
      value: 100,
      name: 'Commonly',
      title: {
        offsetCenter: ['0%', '30%']
      },
      detail: {
        valueAnimation: true,
        offsetCenter: ['0%', '40%']
      }
    }
  ];
  option = {
    series: [{
      type: 'gauge',
      startAngle: 90,
      endAngle: -270,
      pointer: {
        show: false
      },
      progress: {
        show: true,
        overlap: false,
        roundCap: false,
        clip: false,
        itemStyle: {
          borderWidth: 0,
          borderColor: '#464646'
        }
      },
      axisLine: {
        lineStyle: {
          width: 40
        }
      },
      splitLine: {
        show: false,
        distance: 0,
        length: 10
      },
      axisTick: {
        show: false
      },
      axisLabel: {
        show: false,
        distance: 20
      },
      data: gaugeData,
      title: {
        fontSize: 14
      },
      detail: {
        width: 10,
        height: 10,
        fontSize: 14,
        color: 'inherit',
        borderColor: 'inherit',
        borderRadius: 20,
        borderWidth: 0,
        formatter: '{value}'
      }
    }]
  };

  option && myChart.setOption(option);
</script>

<script>
  var chartDom = document.getElementById('accionprl2');
  var myChart = echarts.init(chartDom);
  var option;

  option = {
    tooltip: {
      trigger: 'item'
    },
    legend: {
      top: '90%',
      left: 'center'
    },
    series: [{
      name: 'Access From',
      type: 'pie',
      radius: ['40%', '70%'],
      avoidLabelOverlap: false,
      padAngle: 5,
      itemStyle: {
        borderRadius: 1
      },
      label: {
        show: false,
        position: 'center'
      },
      emphasis: {
        label: {
          show: true,
          fontSize: 40,
          fontWeight: 'bold'
        }
      },
      labelLine: {
        show: false
      },
      data: [{
          value: <?php echo $contador_de_acciones_evaluacion; ?>,
          name: 'x Eval R.'
        },
        {
          value: <?php echo $contador_de_acciones_propuesta; ?>,
          name: 'x Propuesta.'
        },
        {
          value: <?php echo $contador_de_acciones_riesgo; ?>,
          name: 'x Comunicado'
        },
        {
          value: <?php echo $contador_de_acciones_accidente; ?>,
          name: 'x Accidente'
        }
      ]
    }]
  };

  option && myChart.setOption(option);
</script>