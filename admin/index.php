<?php
include('../app/config.php');
include('../admin/layout/parte1.php');
include('../app/controllers/trabajadores/listado_trabajadores.php');
include('../app/controllers/formaciones/listado_formaciones.php');
include('../app/controllers/reconocimientos/listado_reconocimientos.php');
include('../app/controllers/inventario/listado_revisionoficial_maq.php');
include('../app/controllers/accidentes/listado_accidentes.php');
include('../app/controllers/actividad/listado_accionprl.php'); ?>
<link href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-wordpress-admin/wordpress-admin.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>

<!-- Toastr CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<!-- Toastr JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>


<style>
  /* Estilo personalizado para el toast */
  .toast-custom .toast-message {
    font-size: 20px;
    /* Ajusta el tamaño de la fuente según tus necesidades */
  }
</style>
<html>

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
  $contador_tr_mujer;
  $porcentage_mujer = ($contador_tr_mujer * 100) / $contador_de_trabajadores;
  $porcentage_mujer = round($porcentage_mujer, 1)

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
  $contador_tr_anio = count(array_filter($trabajadores, fn($n) => date("Y", strtotime($n['inicio_tr'])) == $anio)); ?>

  <!-- CALCULOS formaciones realizadas en 2024 -->

  <?php $fechahoraentera = strtotime($fechahora);
  $anio = date("Y", $fechahoraentera);
  $contador_de_formaciones = count(array_filter($formaciones_datos, fn($n) => date("Y", strtotime($n['fecha_fr'])) == $anio)); ?>


  <!-- CALCULOS formaciones por mes de año vigente -->


  <?php 
$fechahoraentera = strtotime($fechahora);
$anio = date("Y", $fechahoraentera);
$contador_formacion_pdt = 0;

// Asegurar que formaciones_datos tiene datos válidos
if (!empty($formaciones_datos)) {
    foreach ($formaciones_datos as $formaciones_dato) {
        if (date("Y", strtotime($formaciones_dato['fecha_fr'])) == $anio && 
           ($formaciones_dato['nombre_tf'] == 1 || $formaciones_dato['nombre_tf'] == 3)) {
            $contador_formacion_pdt++;
        }
    }
}

// Asegurarse de que contador_de_formaciones no es cero
if ($contador_de_formaciones > 0) {
    $porcentage_formpdt = ($contador_formacion_pdt * 100) / $contador_de_formaciones;
    $porcentage_formpdt = round($porcentage_formpdt, 2);
} else {
    $porcentage_formpdt = 0; // Manejar el caso donde no hay formaciones
}
?>


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

  <!-- CALCULOS formaciones por tipo de formacion año vigente -->
  <?php
  $currentYear = date("Y"); // Año vigente

  $sql = "SELECT 
            fr.id_formacion AS id_formacion, 
            fr.fecha_fr AS fecha_fr, 
            fr.fechacad_fr AS fechacad_fr, 
            tf.nombre_tf AS nombre_tf
        FROM formacion AS fr 
        INNER JOIN tipoformacion AS tf ON fr.tipo_fr = tf.id_tipoformacion 
        WHERE YEAR(fr.fecha_fr) = :currentYear";  // Filtrar por año

  $query = $pdo->prepare($sql);
  $query->execute(['currentYear' => date("Y")]);  // Año vigente
  $formaciones = $query->fetchAll(PDO::FETCH_ASSOC);
  ?>

  <?php
  $tipoFormaciones = [];  // Arreglo para contar formaciones por tipo

  // Procesamos los datos obtenidos para contar formaciones por tipo
  foreach ($formaciones as $formacion) {
    $tipo = $formacion['nombre_tf'];  // Tipo de formación

    // Si el tipo de formación no está en el arreglo, lo inicializamos
    if (!isset($tipoFormaciones[$tipo])) {
      $tipoFormaciones[$tipo] = 0;
    }

    // Contamos la formación por tipo
    $tipoFormaciones[$tipo]++;
  }

  // Preparar los datos para el gráfico
  $labels = array_keys($tipoFormaciones);  // Etiquetas: tipos de formación
  $data = array_values($tipoFormaciones);  // Datos: cantidad de formaciones por tipo
  // Generar colores aleatorios
  $colors = [
    'rgba(255, 99, 132, 0.8)',  // Rosa
    'rgba(54, 162, 235, 0.8)',   // Azul
    'rgba(255, 206, 86, 0.8)',   // Amarillo
    'rgba(75, 192, 192, 0.8)',   // Verde aqua
    'rgba(153, 102, 255, 0.8)',  // Lila
    'rgba(255, 159, 64, 0.8)',   // Naranja
    'rgba(255, 99, 71, 0.8)',    // Rojo tomate
    'rgba(106, 90, 205, 0.8)',   // Azul oscuro
    'rgba(255, 165, 0, 0.8)',    // Naranja fuerte
    'rgba(0, 128, 128, 0.8)'     // Verde mar];
  ]
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
// Inicializamos contadores
$grafica_de_accidentesconbaja = 0;
$grafica_de_accidentessinbaja = 0;
$grafica_de_accidentesinitinere_conbaja = 0;
$grafica_de_accidentesinitinere_sinbaja = 0;

// Iteramos solo una vez sobre los datos
foreach ($accidentes_datos as $accidentes_dato) {
    if (date("Y", strtotime($accidentes_dato['fecha_ace'])) == $anio) {
        switch ($accidentes_dato['tipoaccidente_ta']) {
            case "Accidente con baja":
                $grafica_de_accidentesconbaja++;
                break;
            case "Accidente sin baja":
                $grafica_de_accidentessinbaja++;
                break;
            case "Accidente in itinere con baja":
                $grafica_de_accidentesinitinere_conbaja++;
                break;
            case "Accidente in itinere sin baja":
                $grafica_de_accidentesinitinere_sinbaja++;
                break;
        }
    }
}
?>
 
  <!-- CALCULOS siniestralidad -->
  <?php
  $total_accidentesconbaja = $grafica_de_accidentesconbaja + $grafica_de_accidentesinitinere_conbaja;
  $total_accidentes = $grafica_de_accidentesconbaja + $grafica_de_accidentessinbaja + $grafica_de_accidentesinitinere_sinbaja + $grafica_de_accidentesinitinere_conbaja;
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


  <!--CALCULOS ACCIDENTES POR MES-->
  <?php
  $fechahoraentera = strtotime($fechahora);
  $anio = date("Y", $fechahoraentera);

  // Array asociativo para almacenar los contadores de formaciones por mes
  $contador_de_accidentes_mes = array(
    '01' => 0,
    '02' => 0,
    '03' => 0,
    '04' => 0,
    '05' => 0,
    '06' => 0,
    '07' => 0,
    '08' => 0,
    '09' => 0,
    '10' => 0,
    '11' => 0,
    '12' => 0
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
      $contador_de_accidentes_en = $contador_de_accidentes_en + 1;
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

  <!-- CALCULO MAQUINARIA PENDIENTE REVISION OFICIAL-->

  <?php
  $contador_mantenimientos_caducados = 0; // Contador de mantenimientos caducados
  $mantenimientos_caducados = []; // Array para almacenar detalles de caducados

  foreach ($listarevisionoficial_datos as $revision) {
    // Comprobar si la fecha de caducidad es anterior a hoy
    if ($revision['vigente_revof'] == 1 && strtotime($revision['caducidad_revof']) < strtotime(date('Y-m-d'))) {
      $contador_mantenimientos_caducados++;
      $mantenimientos_caducados[] = $revision; // Guardar el mantenimiento caducado
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

  <!-- CALCULOS RECONOCIMIENTOS MEDICOS PENDIENTES -->
  <?php
  $newdate_future = strtotime('+15 day', strtotime($fechahora));
  $newdate_future = date('d-m-Y', $newdate_future);
  $newdate_future;
  $fechahoraentera = strtotime($fechahora);
  $anio = date("Y", $fechahoraentera);
  $contador_tr_no_citarm = 0;
  foreach ($reconocimientos as $reconocimiento) {
    if ($reconocimiento['vigente_rm'] == 1 and $reconocimiento['caducidad_rm'] < $fechahora and $reconocimiento['cita_rm'] == 0) {
      $contador_tr_no_citarm = $contador_tr_no_citarm + 1;
    }
  }
  ?>


  <!-- evolucion siniestralidad -->
  <?php
  // Recuperar el año actual
  $year_selected = isset($_GET['year']) ? $_GET['year'] : date("Y");

  // Consulta para obtener datos mensuales
  $sql_mensual = "SELECT 
        MONTH(ace.fecha_ace) AS mes,
        COUNT(CASE WHEN ta.tipoaccidente_ta = 'Accidente con baja' THEN 1 END) AS accidentes_con_baja,
        COUNT(CASE WHEN ta.tipoaccidente_ta = 'Accidente sin baja' THEN 1 END) AS accidentes_sin_baja,
        SUM(CASE WHEN ta.tipoaccidente_ta = 'Accidente con baja' THEN ace.diasbaja_ace ELSE 0 END) AS dias_baja_totales,
        est.mediatr_est AS total_trabajadores,
        SUM(est.horastranual_est * est.mediatr_est) AS horas_trabajo_totales,
        MAX(est.indinciden_est) AS indice_sector
    FROM accidentes AS ace
    LEFT JOIN ace_tipoaccidente AS ta ON ace.tipoaccidente_ace = ta.id_tipoaccidente
    INNER JOIN estadisticas AS est ON YEAR(ace.fecha_ace) = est.anio_est
    WHERE YEAR(ace.fecha_ace) = :year_selected
    GROUP BY MONTH(ace.fecha_ace)
    ORDER BY mes;";

  try {
    // Preparar y ejecutar la consulta
    $stmt = $pdo->prepare($sql_mensual);
    $stmt->bindParam(':year_selected', $year_selected, PDO::PARAM_INT);
    $stmt->execute();
    $result_mensual = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Inicializar arrays para el gráfico
    $meses = [];
    $indice_frecuencia = [];
    $indice_frecuencia_sin_baja = [];
    $indice_gravedad = [];
    $indice_incidencia = [];
    $duracion_media = [];
    $indice_sector = [];

    // Variables acumulativas
    $acumulado_accidentes_con_baja = 0;
    $acumulado_accidentes_sin_baja = 0;
    $acumulado_dias_baja = 0;

    foreach ($result_mensual as $row) {
      $meses[] = date("F", mktime(0, 0, 0, $row['mes'], 1)); // Nombre del mes

      // Actualizar acumulados
      $acumulado_accidentes_con_baja += $row['accidentes_con_baja'];
      $acumulado_accidentes_sin_baja += $row['accidentes_sin_baja'];
      $acumulado_dias_baja += $row['dias_baja_totales'];

      $horas_trabajo_totales = $row['horas_trabajo_totales'];
      $total_trabajadores = $row['total_trabajadores'];

      // Cálculos acumulativos
      $indice_frecuencia[] = ($acumulado_accidentes_con_baja / $horas_trabajo_totales) * 1000000;
      $indice_frecuencia_sin_baja[] = ($acumulado_accidentes_sin_baja / $horas_trabajo_totales) * 1000000;
      $indice_gravedad[] = ($acumulado_dias_baja / $horas_trabajo_totales) * 1000;
      $indice_incidencia[] = ($acumulado_accidentes_con_baja * 100000) / $total_trabajadores;
      $duracion_media[] = $acumulado_accidentes_con_baja > 0 ? $acumulado_dias_baja / $acumulado_accidentes_con_baja : 0;
      $indice_sector[] = $row['indice_sector']; // No acumulativo (se toma el valor más reciente).
    }
  } catch (PDOException $e) {
    echo "<div class='alert alert-danger text-center'>Error en la consulta mensual: " . $e->getMessage() . "</div>";
  }
  ?>


  <!-- grafico actividades PRL -->
  <?php
  // Consulta para obtener proyectos del año actual con nombre de empresa y total de tareas
  $anio_actual = date('Y');
  $sql_proyectos = "SELECT 
                    py.id_proyecto, 
                    emp.nombre_emp as nombre_empresa,
                    (SELECT COUNT(*) FROM ag_tareas WHERE id_proyecto = py.id_proyecto) as total_tareas
                  FROM ag_proyecto py
                  INNER JOIN empresa emp ON py.empresa_py = emp.id_empresa
                  WHERE YEAR(py.fechainicio_py) = :anio OR YEAR(py.fechafin_py) = :anio";
  $stmt_proyectos = $pdo->prepare($sql_proyectos);
  $stmt_proyectos->execute(['anio' => $anio_actual]);

  $datos_graficos = [];
  $estados_unicos = ['En curso', 'Completado', 'Parcialmente hecho', 'Pospuesto', 'Cancelado'];

  while ($proyecto = $stmt_proyectos->fetch(PDO::FETCH_ASSOC)) {
    $id_proyecto = $proyecto['id_proyecto'];

    // Consulta para contar tareas por estado para cada proyecto
    $sql_tareas = "SELECT estado_ta, 
                   COUNT(*) as total_tareas,
                   ROUND(COUNT(*) * 100.0 / (
                       SELECT COUNT(*) FROM ag_tareas 
                       WHERE id_proyecto = :id_proyecto
                   ), 2) as porcentaje
                   FROM ag_tareas 
                   WHERE id_proyecto = :id_proyecto
                   GROUP BY estado_ta";

    $stmt_tareas = $pdo->prepare($sql_tareas);
    $stmt_tareas->execute(['id_proyecto' => $id_proyecto]);

    $estados_tareas = $stmt_tareas->fetchAll(PDO::FETCH_ASSOC);

    // Asegurar que todos los estados estén representados
    $estados_proyecto = [];
    foreach ($estados_unicos as $estado) {
      $encontrado = false;
      foreach ($estados_tareas as $estado_tarea) {
        if ($estado_tarea['estado_ta'] == $estado) {
          $estados_proyecto[] = $estado_tarea;
          $encontrado = true;
          break;
        }
      }
      if (!$encontrado) {
        $estados_proyecto[] = [
          'estado_ta' => $estado,
          'porcentaje' => 0
        ];
      }
    }

    $datos_graficos[] = [
      'empresa' => $proyecto['nombre_empresa'],
      'total_tareas' => $proyecto['total_tareas'],
      'estados' => $estados_proyecto
    ];
  }
  ?>



  <!-- FIN  CALCULOS ESTADISTICO -->


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
          <hr>
          <div class="row">

            <div class="col-6 col-md-4 text-center">
              <input type="text" class="knob" value="<?php echo $porcentage_mujer; ?>" data-width="90" data-height="90" data-fgColor="#3c8dbc" data-readonly="true">


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
      <div class="card card-secandary">
        <div class="card-header">
          <h3 class="card-title">Distribucion departamentos</h3>
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
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">ESTADOS DE TAREAS POR PROYECTO</h3>
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
            <div class="col-12">
              <canvas id="graficoEstadosTareas"></canvas>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-6 col-md-3 text-center">
      <div class="card">
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
          </div>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
  </div>
  <div class="row">
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
          <div id="main" style="width:480px;height:270px;"></div>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>


    <div class="col-6 col-md-3 text-center">
      <!-- Donut chart -->
      <div class="card card-danger">
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
          <div style="width: 500px">
            <canvas id="graficaaccidentes"></canvas>
          </div>

        </div>
        <!-- /.card-body-->
      </div>

    </div>

    <div class="col-6 col-md-3 text-center">
      <div class="card card-danger">
        <div class="card-header">
          <h3 class="card-title">Indice Incidencia</h3>
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
          <canvas id="graficoIncidenciaSector" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
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
          <canvas id="graficoIndicesPrincipales" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>




  </div>
  <div class="row">
    <div class="col-6 col-md-3 text-center">
      <div class="card card-secondary">
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
        <div class="card-body d-flex justify-content-center align-items-center">
          <!-- Ajusta el tamaño del gráfico -->
          <div id="formaciones" style="width: 250px; height: 250px;"></div>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
    <div class="col-6 col-md-3 text-center">
      <!-- Donut chart -->
      <div class="card card-secondary">
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
      <div class="card card-secondary">
        <div class="card-header">
          <h3 class="card-title">
            <i class="far fa-chart-bar"></i>
            <b>Formaciones por tipo <?php echo $anio ?> </b>
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
            <canvas id="barChart"></canvas>
          </div>

        </div>
        <!-- /.card-body-->
      </div>

    </div>



    <div class="col-6 col-md-3 text-center">
      <div class="card card-secondary">
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
</body>

</html>
<?php
include('../admin/layout/parte2.php'); ?>
<!-- Agregar Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

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
      var toast2 = toastr.error('<?= $contador_accidentes_sin_comunicar ?> accidentes sin comunicar');
      toast2.on('click', function() {
        window.location.href = "<?php echo $URL; ?>/admin/accidentes/index.php";
      });
    <?php endif; ?>

    <?php if ($contador_tr_no_citarm > 0): ?>
      var toast1 = toastr.warning('<?= $contador_tr_no_citarm ?> Trabajadores pendientes de citar a RM');
      toast1.on('click', function() {
        window.location.href = "<?php echo $URL; ?>/admin/reconocimientos/index.php";
      });
    <?php endif; ?>
    
    <?php if ($contador_mantenimientos_caducados > 0): ?>
      var toast_caducado = toastr.error('<?= $contador_mantenimientos_caducados ?> Revision oficial está caducada');
      toast_caducado.on('click', function() {
        window.location.href = "<?php echo $URL; ?>/admin/inventario/revisionoficial.php";
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
      backgroundColor: 'rgba(9, 129, 176, 0.2)',
      borderColor: 'rgba(9, 129, 176, 1)',
      borderWidth: 1

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
      radius: ['50%', '80%'],
      center: ['60%', '80%'],
      // adjust the start and end angle
      startAngle: 180,
      endAngle: 360,
      data: [{
          value: <?php echo $grafica_de_accidentesconbaja ?>,
          name: 'Acc. con Baja'
        },
        {
          value: <?php echo $grafica_de_accidentessinbaja ?>,
          name: 'Acc. sin Baja'
        },
        {
          value: <?php echo $grafica_de_accidentesinitinere_conbaja ?>,
          name: 'Itinere baja'
        },
        {
          value: <?php echo $grafica_de_accidentesinitinere_sinbaja ?>,
          name: 'Itinere NO baja'
        },

      ]
    }]
  };




  option && myChart.setOption(option);
</script>

<script type="text/javascript">
  var chartDom = document.getElementById('formaciones');
  var myChart = echarts.init(chartDom);
  var porcentaje = <?php echo $porcentage_formados; ?>; // Valor dinámico del porcentaje

  var option = {
    tooltip: {
      formatter: '{a} <br/>{b}: {c}%'
    },
    series: [{
      name: 'Cumplimiento',
      type: 'gauge',
      startAngle: 210,
      endAngle: -30,
      radius: '90%',
      pointer: {
        show: true,
        width: 5
      },
      progress: {
        show: true,
        width: 10,
        itemStyle: {
          color: porcentaje <= 50 ?
            '#ff4d4d' // Rojo para 0-50%
            :
            porcentaje <= 75 ?
            '#ffc107' // Amarillo para 51-75%
            :
            '#28a745' // Verde para 76-100%
        }
      },
      axisLine: {
        lineStyle: {
          width: 10,
          color: [
            [0.5, '#ff4d4d'], // Rojo (0-50%)
            [0.75, '#ffc107'], // Amarillo (50-75%)
            [1, '#28a745'] // Verde (75-100%)
          ]
        }
      },
      axisTick: {
        show: true,
        distance: -15,
        length: 8,
        lineStyle: {
          color: '#000',
          width: 1
        }
      },
      splitLine: {
        distance: -22,
        length: 15,
        lineStyle: {
          color: '#000',
          width: 2
        }
      },
      axisLabel: {
        distance: -30,
        color: '#000',
        fontSize: 12
      },
      detail: {
        valueAnimation: true,
        formatter: '{value}%',
        color: '#000',
        fontSize: 24,
        fontWeight: 'bold',
        offsetCenter: [0, '70%']
      },
      data: [{
        value: porcentaje,
        name: 'Cumplimiento'
      }]
    }]
  };

  // Aplicar configuración al gráfico
  myChart.setOption(option);
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

<script>
  //GAUGE CHART//
  var chartDom = document.getElementById('accionprl');
  var myChart = echarts.init(chartDom);
  var option;




  const gaugeData = [{
      value: <?php echo $contador_de_acciones ?>,
      name: 'Total',
      title: {
        offsetCenter: ['0%', '-40%']
      },
      detail: {
        valueAnimation: true,
        offsetCenter: ['0%', '-25%']
      }
    },
    {
      value: <?php echo $contador_de_acciones_cerradas ?>,
      name: 'Cerradas',
      title: {
        offsetCenter: ['0%', '-8%']
      },
      detail: {
        valueAnimation: true,
        offsetCenter: ['0%', '9%']
      }
    },
    {
      value: <?php echo $contador_de_acciones_abiertas ?>,
      name: 'Pendientes',
      title: {
        offsetCenter: ['0%', '25%']
      },
      detail: {
        valueAnimation: true,
        offsetCenter: ['0%', '42%']
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
<script>
  // Datos desde PHP
  const meses = <?php echo json_encode($meses); ?>;

  // Gráfico 1: Índices principales
  const indiceFrecuencia = <?php echo json_encode($indice_frecuencia); ?>;
  const indiceFrecuenciaSinBaja = <?php echo json_encode($indice_frecuencia_sin_baja); ?>;
  const indiceGravedad = <?php echo json_encode($indice_gravedad); ?>;
  const duracionMedia = <?php echo json_encode($duracion_media); ?>;

  // Gráfico 2: Índice de Incidencia y Sector
  const indiceIncidencia = <?php echo json_encode($indice_incidencia); ?>;
  const indiceSector = <?php echo json_encode($indice_sector); ?>;

  // Configuración del Gráfico 1
  const ctx1 = document.getElementById('graficoIndicesPrincipales').getContext('2d');
  const graficoIndicesPrincipales = new Chart(ctx1, {
    type: 'line',
    data: {
      labels: meses,
      datasets: [{
          label: 'Índice de Frecuencia (Acumulado)',
          data: indiceFrecuencia,
          borderColor: 'rgba(255, 99, 132, 1)',
          backgroundColor: 'rgba(255, 99, 132, 0.2)',
          borderWidth: 2,
          fill: true
        },
        {
          label: 'Índice de Frecuencia Sin Baja (Acumulado)',
          data: indiceFrecuenciaSinBaja,
          borderColor: 'rgba(54, 162, 235, 1)',
          backgroundColor: 'rgba(54, 162, 235, 0.2)',
          borderWidth: 2,
          fill: true
        },
        {
          label: 'Índice de Gravedad (Acumulado)',
          data: indiceGravedad,
          borderColor: 'rgba(75, 192, 192, 1)',
          backgroundColor: 'rgba(75, 192, 192, 0.2)',
          borderWidth: 2,
          fill: true
        },
        {
          label: 'Duración Media (Acumulado)',
          data: duracionMedia,
          borderColor: 'rgba(255, 159, 64, 1)',
          backgroundColor: 'rgba(255, 159, 64, 0.2)',
          borderWidth: 2,
          fill: true
        }
      ]
    },
    options: {
      responsive: true,
      plugins: {
        legend: {
          display: true,
          position: 'top'
        }
      },
      scales: {
        x: {
          title: {
            display: true,
            text: 'Meses'
          }
        },
        y: {
          beginAtZero: true,
          title: {
            display: true,
            text: 'Valores acumulados'
          }
        }
      }
    }
  });

  // Configuración del Gráfico 2
  const ctx2 = document.getElementById('graficoIncidenciaSector').getContext('2d');
  const graficoIncidenciaSector = new Chart(ctx2, {
    type: 'line',
    data: {
      labels: meses,
      datasets: [{
          label: 'Índice de Incidencia (Acumulado)',
          data: indiceIncidencia,
          borderColor: 'rgba(153, 102, 255, 1)',
          backgroundColor: 'rgba(153, 102, 255, 0.2)',
          borderWidth: 2,
          fill: true
        },
        {
          label: 'Índice del Sector',
          data: indiceSector,
          borderColor: 'rgba(201, 203, 207, 1)',
          backgroundColor: 'rgba(201, 203, 207, 0.2)',
          borderWidth: 2,
          fill: true
        }
      ]
    },
    options: {
      responsive: true,
      plugins: {
        legend: {
          display: true,
          position: 'top'
        }
      },
      scales: {
        x: {
          title: {
            display: true,
            text: 'Meses'
          }
        },
        y: {
          beginAtZero: true,
          title: {
            display: true,
            text: 'Valores acumulados'
          }
        }
      }
    }
  });
</script>
<canvas id="estadoTareas" style="width: 100%; max-width: 800px; height: 400px;"></canvas>
<script>
  var ctx = document.getElementById('estadoTareas').getContext('2d');

  var chart = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: <?php echo json_encode($proyectos); ?>, // Nombres de proyectos
      datasets: [{
          label: 'Completadas',
          data: <?php echo json_encode($data_estados['Completadas']); ?>,
          backgroundColor: 'rgba(75, 192, 192, 0.8)'
        },
        {
          label: 'En curso',
          data: <?php echo json_encode($data_estados['En curso']); ?>,
          backgroundColor: 'rgba(54, 162, 235, 0.8)'
        },
        {
          label: 'Parcialmente hechas',
          data: <?php echo json_encode($data_estados['Parcialmente hechas']); ?>,
          backgroundColor: 'rgba(255, 206, 86, 0.8)'
        },
        {
          label: 'Pospuestas',
          data: <?php echo json_encode($data_estados['Pospuestas']); ?>,
          backgroundColor: 'rgba(255, 159, 64, 0.8)'
        },
        {
          label: 'Canceladas',
          data: <?php echo json_encode($data_estados['Canceladas']); ?>,
          backgroundColor: 'rgba(255, 99, 132, 0.8)'
        }
      ]
    },
    options: {
      plugins: {
        title: {
          display: true,
          text: 'Estado de Tareas por Proyecto (Año Vigente)'
        },
        tooltip: {
          mode: 'index',
          intersect: false
        }
      },
      responsive: true,
      scales: {
        x: {
          stacked: true // Gráfico apilado
        },
        y: {
          stacked: true,
          title: {
            display: true,
            text: 'Número de Tareas'
          }
        }
      }
    }
  });
</script>

<!-- Inclusión de Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


<script>
  document.addEventListener('DOMContentLoaded', function() {
    const proyectos = <?php echo json_encode($datos_graficos); ?>;

    const backgroundColors = {
      'En curso': '#36A2EB', // Azul
      'Completado': '#4CAF50', // Verde
      'Parcialmente hecho': '#FFC107', // Amarillo
      'Pospuesto': '#FF9800', // Naranja
      'Cancelado': '#F44336' // Rojo
    };

    // Preparar datos para Chart.js
    const labels = proyectos.map(p => `${p.empresa} (${p.total_tareas} trs.)`);
    const datasets = [
      'En curso', 'Completado', 'Parcialmente hecho', 'Pospuesto', 'Cancelado'
    ].map(estado => ({
      label: estado,
      backgroundColor: backgroundColors[estado],
      data: proyectos.map(proyecto =>
        proyecto.estados.find(e => e.estado_ta === estado)?.porcentaje || 0
      )
    }));

    const ctx = document.getElementById('graficoEstadosTareas').getContext('2d');

    new Chart(ctx, {
      type: 'bar',
      data: {
        labels: labels,
        datasets: datasets
      },
      options: {
        responsive: true,
        plugins: {
          title: {
            display: true,
            text: 'Distribución de Estados de Tareas por Empresa'
          },
          tooltip: {
            callbacks: {
              label: function(context) {
                return `${context.dataset.label}: ${context.parsed.y}%`;
              }
            }
          }
        },
        scales: {
          x: {
            stacked: true,
          },
          y: {
            stacked: true,
            max: 100,
            title: {
              display: true,
              text: 'Porcentaje de Tareas'
            }
          }
        }
      }
    });
  });
</script>



<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  const ctx = document.getElementById('barChart').getContext('2d');

  const barChart = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: <?php echo json_encode($labels); ?>, // Tipos de formación
      datasets: [{
        label: 'Número de Formaciones',
        data: <?php echo json_encode($data); ?>, // Total de formaciones por tipo
        backgroundColor: <?php echo json_encode($colors); ?>, // Colores aleatorios para las barras
        borderColor: 'rgba(255, 255, 255, 1)', // Borde blanco para cada barra
        borderWidth: 1
      }]
    },
    options: {
      plugins: {
        title: {
          display: true,
          text: 'Número de Formaciones por Tipo (Año <?php echo date("Y"); ?>)'
        },
        tooltip: {
          callbacks: {
            label: function(context) {
              return `${context.label}: ${context.raw} formaciones`; // Mostrar en formato "X formaciones"
            }
          }
        }
      },
      responsive: true,
      scales: {
        x: {
          title: {
            display: true,
            text: 'Tipo de Formación'
          },
          ticks: {
            display: false, // No mostrar las etiquetas debajo de las barras
          }
        },
        y: {
          title: {
            display: true,
            text: 'Número de Formaciones'
          },
          beginAtZero: true
        }
      }
    }
  });
</script>