<?php
include('../app/config.php');
include('../admin/layout/parte1.php');
include('../app/controllers/trabajadores/listado_trabajadores.php'); ?>

<body>





  <hr>
  <div class="row">
    <div class="col-6 col-md-6 text-center">
      <p><b>Registro trabajadores</b></p>

      <?php
      $contador_de_trabajadores = 0;
      foreach ($trabajadores as $trabajador) {
        if ($trabajador['activo_tr'] == 1) {
          $contador_de_trabajadores = $contador_de_trabajadores + 1;
        }
      }
      ?>

      <div style="display:inline;width:120px;height:120px;"><canvas width="80" height="80" style="width: 120px; height: 120px;"></canvas><input type="text" class="knob" data-thickness="0.2" data-anglearc="250" data-angleoffset="-125" value="<?php echo $contador_de_trabajadores; ?>" data-width="120" data-height="120" data-fgcolor="#00c0ef" style="width: 64px; height: 40px; position: absolute; vertical-align: middle; margin-top: 40px; margin-left: -92px; border: 0px; background: none; font: bold 24px Arial; text-align: left; color: rgb(0, 192, 239); padding: 0px; appearance: none;"></div>


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

  </div>
  <div class="row">
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