<?php
include('../app/config.php');
include('../admin/layout/parte1.php');
include('../app/controllers/trabajadores/listado_trabajadores.php');
include('../app/controllers/formaciones/listado_formaciones.php'); ?>

<body>

  <!-- CALCULOS ESTADISTICO -->

  <?php
  $contador_de_trabajadores = 0;
  foreach ($trabajadores as $trabajador) {
    if ($trabajador['activo_tr'] == 1) {
      $contador_de_trabajadores = $contador_de_trabajadores + 1;
    }
  }
  ?>
  <?php
  $contador_tr_formados = 0;
  foreach ($trabajadores as $trabajador) {
    if ($trabajador['activo_tr'] == 1 and $trabajador['formacionpdt_tr'] == 'Si') {
      $contador_tr_formados = $contador_tr_formados + 1;
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


  <?php $fechahoraentera = strtotime($fechahora);
  $anio = date("Y", $fechahoraentera);
  $contador_tr_anio = count(array_filter($trabajadores, fn ($n) => date("Y", strtotime($n['inicio_tr'])) == $anio)); ?>


  <?php $fechahoraentera = strtotime($fechahora);
  $anio = date("Y", $fechahoraentera);
  $contador_de_formaciones = count(array_filter($formaciones_datos, fn ($n) => date("Y", strtotime($n['fecha_fr'])) == $anio)); ?>



  
  <?php $fechahoraentera = strtotime($fechahora);
  $anio = date("Y", $fechahoraentera);
  $contador_formacion_pdt = 0;
  foreach ($formaciones_datos as $formaciones_dato) {
    if (date("Y", strtotime($formaciones_dato['fecha_fr'] == $anio))and $formaciones_dato['tipo_fr'] == 1) {
      $contador_formacion_pdt = $contador_formacion_pdt + 1;
    }
  }
  $porcentage_formpdt = ($contador_formacion_pdt * 100) / $contador_de_formaciones;
  $porcentage_formpdt = round($porcentage_formpdt, 2);?>


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

  </div>
  <div class="col-6 col-md-6 text-center">
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


  <div class="row">

    <div class="col-6 col-md-3 text-center">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">
          <i class="fa-solid fa-chart-simple"></i>            Estadísticas trabajadores
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

    <div class="col-6 col-md-6 text-center">
      <!-- Donut chart -->
      <div class="card card-primary card-outline">
        <div class="card-header">
          <h3 class="card-title">
            <i class="far fa-chart-bar"></i>
            Donut Chart
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
        <div class="card-body">
          <div id="donut-chart" style="height: 300px;"></div>
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
  /*
   * END DONUT CHART
   */
</script>