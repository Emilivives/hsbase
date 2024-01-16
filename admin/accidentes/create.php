<?php
include('../../app/config.php');
include('../../admin/layout/parte1.php');
include('../../app/controllers/trabajadores/listado_trabajadores.php');
include('../../app/controllers/maestros/centros/listado_centros.php');
include('../../app/controllers/maestros/accidentes/listado_actividadfisica.php');
include('../../app/controllers/maestros/accidentes/listado_agentematerial.php');
include('../../app/controllers/maestros/accidentes/listado_desviacion.php');
include('../../app/controllers/maestros/accidentes/listado_formacontacto.php');
include('../../app/controllers/maestros/accidentes/listado_gravedad.php');
include('../../app/controllers/maestros/accidentes/listado_partecuerpo.php');
include('../../app/controllers/maestros/accidentes/listado_tipolesion.php');
include('../../app/controllers/maestros/accidentes/listado_tipotrabajo.php');
include('../../app/controllers/maestros/accidentes/listado_tipolugar.php');
include('../../app/controllers/maestros/accidentes/listado_tipoaccidente.php');

?>
<html>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h5 class="m-0"><b>Nueva Investigacion accidente laboral</b></h5>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                    <li class="breadcrumb-item active">Nueva investigacion accidente</li>
                </ol>
            </div><!-- /.col -->
            <hr>
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>


</html>

<!-- /.content- -->
<div class="content">
    <form action="../../app/controllers/accidente/create.php" method="post">

        <div class="well">
            <div class="row">

                <div class="col-sm-2">
                    <div class="form-group row">
                        <label for="nombre" class="col-form-label col-sm-2">Nº:</label>
                        <div class="col-sm-4">
                            <input type="text" name="nroaccidente" id="nroaccidente" class="form-control" placeholder="nro. accdidente" tabindex="1">
                        </div>
                    </div>
                </div>


                <div class="col-sm-3">
                    <div class="form-group row">
                        <label for="nombre" class="col-form-label col-sm-3">Tipo acc:</label>
                        <div class="col-sm-5">
                            <select name="btn_tipoaccidente" id="btn_tipoaccidente" class="form-control" onchange="selectIdta(event)">
                                <option value="0">--Seleccione tipo--</option>
                                <?php
                                foreach ($ace_tipoaccidente_datos as $ace_tipoaccidente_dato) { ?>
                                    <option value="<?php echo $ace_tipoaccidente_dato['id_tipoaccidente']; ?>" tipoaccidente_ta="<?php echo $ace_tipoaccidente_dato['tipoaccidente_ta']; ?>">
                                        <?php echo $ace_tipoaccidente_dato['tipoaccidente_ta']; ?> </option>
                                <?php
                                }
                                ?>
                            </select>

                            <script>
                                function selectIdta(e) {
                                    var tipoaccidente_ta = e.target.selectedOptions[0].getAttribute("tipoaccidente_ta")
                                    document.getElementById("tipoaccidente_ta").value = tipoaccidente_ta
                                }
                            </script>
                        </div>
                    </div>
                </div>


                <div class="col-sm-2">
                    <div class="form-group row">
                        <label for="nombre" class="col-form-label col-sm-2">Fecha:</label>
                        <div class="col-sm-5">
                            <input type="date" name="fecha_ace" id="fecha_ace" class="form-control" tabindex="1" onchange="copiar()">
                        </div>
                    </div>
                    <script type="text/javascript">
                        function copiar() {
                            var copiar = document.getElementById("fecha_ace");
                            var pegar = document.getElementById("fecha_ace2");
                            pegar.value = copiar.value;
                        }
                    </script>
                </div>
                <div class="col-sm-3">
                    <div class="form-group row">
                        <label for="nombre" class="col-form-label col-sm-2">Nombre:</label>
                        <div class="col-sm-8">
                            <select name="btn_trabajador" id="btn_trabajador" class="form-control" onchange="selectIdtr(event)">
                                <option value="0">--Seleccione trabajador--</option>
                                <?php
                                foreach ($trabajadores as $trabajador) { ?>
                                    <option value="<?php echo $trabajador['id_trabajador']; ?>" nombre_tr="<?php echo $trabajador['nombre_tr']; ?>" dni_tr="<?php echo $trabajador['dni_tr']; ?>" sexo_tr="<?php echo $trabajador['sexo_tr']; ?>" inicio_tr="<?php echo $trabajador['inicio_tr']; ?>" fechanac_tr="<?php echo $trabajador['fechanac_tr']; ?>" categoria_tr="<?php echo $trabajador['nombre_cat']; ?>" sexo_tr="<?php echo $trabajador['sexo_tr']; ?>" inicio_tr="<?php echo $trabajador['inicio_tr']; ?>" fechanac_tr="<?php echo $trabajador['fechanac_tr']; ?>" departamento_tr="<?php echo $trabajador['departamento_cat']; ?>">
                                        <?php echo $trabajador['nombre_tr']; ?> </option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>

                    </div>

                </div>

                <script>
                    function selectIdtr(e) {
                        var nombre_tr = e.target.selectedOptions[0].getAttribute("nombre_tr")
                        document.getElementById("nombre_tr").value = nombre_tr
                        var dni_tr = e.target.selectedOptions[0].getAttribute("dni_tr")
                        document.getElementById("dni_tr").value = dni_tr
                        var sexo_tr = e.target.selectedOptions[0].getAttribute("sexo_tr")
                        document.getElementById("sexo_tr").value = sexo_tr
                        var inicio_tr = e.target.selectedOptions[0].getAttribute("inicio_tr")
                        document.getElementById("inicio_tr").value = inicio_tr
                        var fechanac_tr = e.target.selectedOptions[0].getAttribute("fechanac_tr")
                        document.getElementById("fechanac_tr").value = fechanac_tr
                        var categoria_tr = e.target.selectedOptions[0].getAttribute("categoria_tr")
                        document.getElementById("categoria_tr").value = categoria_tr
                        var departamento_tr = e.target.selectedOptions[0].getAttribute("departamento_tr")
                        document.getElementById("departamento_tr").value = departamento_tr

                    }
                </script>
                <div class="col-sm-2">
                    <div class="form-group row">
                        <label for="centro" class="col-form-label col-sm-2">Centro:</label>
                        <div class="col-sm-7">
                            <select name="centro_ace" id="btn_centro" class="form-control" onchange="selectIdcen(event)">
                                <option value="0">--Seleccione centro--</option>
                                <?php
                                foreach ($centros_datos as $centros_dato) { ?>
                                    <option value="<?php echo $centros_dato['id_centro']; ?>" nombre_cen="<?php echo $centros_dato['nombre_cen']; ?>" nombre_emp="<?php echo $centros_dato['nombre_emp']; ?> " razonsocial_emp="<?php echo $centros_dato['razonsocial_emp']; ?> " modalidadprl_emp="<?php echo $centros_dato['modalidadprl_emp']; ?> ">
                                        <?php echo $centros_dato['nombre_cen']; ?> </option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>

                    </div>

                </div>

                <script>
                    function selectIdcen(e) {
                        var nombre_cen = e.target.selectedOptions[0].getAttribute("nombre_cen")
                        document.getElementById("nombre_cen").value = nombre_cen
                        var nombre_emp = e.target.selectedOptions[0].getAttribute("nombre_emp")
                        document.getElementById("nombre_emp").value = nombre_emp
                        var razonsocial_emp = e.target.selectedOptions[0].getAttribute("razonsocial_emp")
                        document.getElementById("razonsocial_emp").value = razonsocial_emp
                        var modalidadprl_emp = e.target.selectedOptions[0].getAttribute("modalidadprl_emp")
                        document.getElementById("modalidadprl_emp").value = modalidadprl_emp


                    }
                </script>
            </div>

            <div class="row">

                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title"><i class="bi bi-person-fill" style="text-align: left;"></i> Datos trabajador</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>

                        <div class="row">

                        </div>

                    </div>
                    <div class="card-body">
                        <div class="row">

                            <div class="col-sm-3">
                                <div class="form-group row">
                                    <label for="nombre_tr" class="col-form-label col-sm-2">Nombre</label>
                                    <div class="col-sm-8">
                                        <input type="text" id="nombre_tr" class="form-control" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group row">
                                    <label for="dni_tr" class="col-form-label col-sm-2">DNI/NIE</label>
                                    <div class="col-sm-8">
                                        <input type="text" id="dni_tr" class="form-control" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group row">
                                    <label for="sexo_tr" class="col-form-label col-sm-3">Sexo</label>
                                    <div class="col-sm-3">
                                        <input type="text" id="sexo_tr" class="form-control" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group row">
                                    <label for="inicio_tr" class="col-form-label col-sm-3">Inicio</label>
                                    <div class="col-sm-6">
                                        <input type="text" id="inicio_tr" class="form-control" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group row">
                                    <label for="fechanac_tr" class="col-form-label col-sm-4">Fecha Nac.</label>
                                    <div class="col-sm-6">
                                        <input type="text" id="fechanac_tr" class="form-control" disabled>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="form-group row">
                                    <label for="categoria_tr" class="col-form-label col-sm-2">Puesto</label>
                                    <div class="col-sm-7">
                                        <input type="text" id="categoria_tr" class="form-control" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group row">
                                    <label for="departamento_tr" class="col-form-label col-sm-2">Depto.</label>
                                    <div class="col-sm-7">
                                        <input type="text" id="departamento_tr" class="form-control" disabled>
                                    </div>
                                </div>
                            </div>


                            <div class="col-sm-3">
                                <div class="form-group row">
                                    <label for="edad" class="col-form-label col-sm-2">Edad</label>
                                    <div class="col-sm-2">

                                        <input type="text" id="edad" class="form-control" disabled>
                                    </div>
                                </div>
                            </div>


                        </div>

                    </div>


                    <div class="row">

                        <div class="card card-outline card-primary">
                            <div class="card-header">
                                <h3 class="card-title"><i class="fa fa-book" style="text-align: left;"></i> Datos de la empresa</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>

                                <div class="row">

                                </div>

                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <div class="form-group row">
                                            <label for="nombre_emp" class="col-form-label col-sm-2">Empresa</label>
                                            <div class="col-sm-8">
                                                <input type="text" id="nombre_emp" class="form-control" disabled>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group row">
                                            <label for="razonsocial_emp" class="col-form-label col-sm-2">Razon social</label>
                                            <div class="col-sm-10">
                                                <input type="text" id="razonsocial_emp" class="form-control" disabled>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-5">
                                        <div class="form-group row">
                                            <label for="modalidadprl_emp" class="col-form-label col-sm-2">Modalidad PRL</label>
                                            <div class="col-sm-5">
                                                <input type="text" id="modalidadprl_emp" class="form-control" disabled>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-5">
                                        <div class="form-group row">
                                            <label for="nombre_cen" class="col-form-label col-sm-2" hidden>Centro PRL</label>
                                            <div class="col-sm-5">
                                                <input type="text" id="nombre_cen" class="form-control" hidden>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">

                        <div class="card card-outline card-primary">
                            <div class="card-header">
                                <h3 class="card-title"><i class="bi bi-geo-alt-fill" style="text-align: left;"></i> Lugar y/o centro de trabajo donde ha ocurrido</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>

                                <div class="row">

                                </div>

                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <div class="form-group row">
                                            <label for="lugar" class="col-form-label col-sm-2">Lugar</label>
                                            <div class="col-sm-8">
                                                <select class="form-select" aria-label="Default select example">
                                                    <option selected>Selecciona lugar</option>
                                                    <option value="1">En el propio centro</option>
                                                    <option value="2">En otro centro de trabajo</option>
                                                    <option value="3">In itinero</option>
                                                    <option value="4">Desplazamiento entre centros</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-9">
                                        <div class="form-group row">
                                            <label for="razonsocial_emp" class="col-form-label col-sm-1">Detalles lugar</label>
                                            <div class="col-sm-10">
                                                <input type="text" name="detalleslugar_ace" id="" class="form-control">
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">

                        <div class="card card-outline card-primary">
                            <div class="card-header">
                                <h3 class="card-title"><i class="bi bi-building-fill" style="text-align: left;"></i> Datos del suceso (1)</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>

                                <div class="row">

                                </div>

                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-2">
                                        <div class="form-group row">
                                            <label for="tipoaccidente_ta" class="col-form-label col-sm-2">Tipo</label>
                                            <div class="col-sm-7">
                                                <input type="text" id="tipoaccidente_ta" class="form-control" disabled>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group row">
                                            <label for="nombre" class="col-form-label col-sm-3">Fecha:</label>
                                            <div class="col-sm-6">
                                                <input type="date" id="fecha_ace2" name="fecha_ace2" class="form-control" tabindex="1" onchange="diaSemana()" disabled>
                                            </div>
                                            <script>
                                                function diaSemana() {
                                                    var x = document.getElementById("fecha_ace2");
                                                    let date = new Date(x.value.replace(/-+/g, '/'));

                                                    let options = {
                                                        weekday: 'long',
                                                        year: 'numeric',
                                                        month: 'long',
                                                        day: 'numeric'
                                                    };
                                                    console.log(date.toLocaleDateString('es-MX', options));

                                                    $('#diaSemana').trigger('input')
                                                }
                                            </script>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group row">
                                            <label for="nombre" class="col-form-label col-sm-4">Fecha Baja medica:</label>
                                            <div class="col-sm-6">
                                                <input type="date" id="fechabaja_ace" name="fechabaja_ace" class="form-control" tabindex="1">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group row">
                                            <label for="diaSemana" class="col-form-label col-sm-3">Dia</label>
                                            <div class="col-sm-6">
                                                <input type="text" id="diaSemana" class="form-control" value="" disabled>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group row">
                                            <label for="nombre" class="col-form-label col-sm-3">Hora:</label>
                                            <div class="col-sm-4">
                                                <input type="time" name="hora_ace" class="form-control" tabindex="1">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-2">
                                        <div class="form-group row">
                                            <label for="nombre" class="col-form-label col-sm-5">Hora trabajo:</label>
                                            <div class="col-sm-4">
                                                <select class="form-select" name="horatrabajo_ace" aria-label="Default select example">
                                                    <option selected>-</option>
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                    <option value="4">4</option>
                                                    <option value="5">5</option>
                                                    <option value="6">6</option>
                                                    <option value="7">7</option>
                                                    <option value="8">8</option>
                                                    <option value="9">9</option>
                                                    <option value="10">10</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">

                                    <div class="col-sm-3">
                                        <div class="form-group row">
                                            <label for="trabajohabitual_ace" class="col-form-label col-sm-4">Trabajo habitual:</label>
                                            <div class="col-sm-3">
                                                <select class="form-select" name="trabajohabitual_ace" aria-label="Default select example">
                                                    <option selected>-</option>
                                                    <option value="SI">SI</option>
                                                    <option value="NO">NO</option>

                                                </select>
                                            </div>
                                        </div>
                                    </div>

           
                                <div class="col-sm-3">
                                    <div class="form-group row">
                                        <label for="diadescanso_ace" class="col-form-label col-sm-4">Dia ult. descanso:</label>
                                        <div class="col-sm-3">
                                            <select class="form-select" name="diadescanso_ace" aria-label="Default select example">
                                                <option selected>Seleccione</option>
                                                <option value="Lunes">Lunes</option>
                                                <option value="Martes">Martes</option>
                                                <option value="Miércoles">Miércoles</option>
                                                <option value="Jueves">Jueves</option>
                                                <option value="Viernes">Viernes</option>
                                                <option value="Sábado">Sábado</option>
                                                <option value="Domingo">Domingo</option>

                                            </select>
                                        </div>
                                    </div>
                                </div>

                  
                                <div class="col-sm-2">
                                        <div class="form-group row">
                                            <label for="nombre" class="col-form-label col-sm-5">Semanas descanso:</label>
                                            <div class="col-sm-4">
                                                <select class="form-select" name="semanadescanso_ace" aria-label="Default select example">
                                                    <option selected>-</option>
                                                    <option value="0">0</option>
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                    <option value="4">4</option>
                                                    <option value="5">5</option>
                                                    <option value="6">6</option>
                                                    <option value="7">7</option>
                                                    <option value="8">8</option>

                                                </select>
                                            </div>
                                        </div>
                                    </div>

              
                        <div class="col-sm-3">
                            <div class="form-group row">
                                <label for="trabajohabitual_ace" class="col-form-label col-sm-4">Trabajo habitual:</label>
                                <div class="col-sm-3">
                                    <select class="form-select" name="trabajohabitual_ace" aria-label="Default select example">
                                        <option selected>-</option>
                                        <option value="SI">SI</option>
                                        <option value="NO">NO</option>

                                    </select>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>

            </div>
        </div>
</div>

</div>

</form>
</div>




</form>
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
            "pageLength": 5,
            "language": {
                "emptyTable": "No hay información",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ trabajadores",
                "infoEmpty": "Mostrando 0 a 0 de 0 Trabajadores",
                "infoFiltered": "(Filtrado de MAX total Trabajadores)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_ Trabajadores",
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