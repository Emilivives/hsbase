<?php
include('../app/config.php');
include('../app/controllers/trabajadores/listado_trabajadores.php');
include('../app/controllers/formaciones/listado_formaciones.php');
include('../app/controllers/accidentes/listado_accidentes.php') ?>

  <!-- CALCULOS ESTADISTICOS -->

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
    if(($accidentes_dato['comunicado_ace'] == "NO")){
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






