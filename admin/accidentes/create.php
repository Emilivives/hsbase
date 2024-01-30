<?php
include('../../app/config.php');
include('../../admin/layout/parte1.php');
include('../../app/controllers/trabajadores/listado_trabajadores.php');
include('../../app/controllers/maestros/centros/listado_centros.php');
include('../../app/controllers/maestros/accidentes/listado_actividadfisica.php');
include('../../app/controllers/maestros/accidentes/listado_agentematerial.php');
include('../../app/controllers/maestros/accidentes/listado_agentematerialdesv.php');
include('../../app/controllers/maestros/accidentes/listado_agentematerialles.php');
include('../../app/controllers/maestros/accidentes/listado_desviacion.php');
include('../../app/controllers/maestros/accidentes/listado_formacontacto.php');
include('../../app/controllers/maestros/accidentes/listado_gravedad.php');
include('../../app/controllers/maestros/accidentes/listado_partecuerpo.php');
include('../../app/controllers/maestros/accidentes/listado_tipolesion.php');
include('../../app/controllers/maestros/accidentes/listado_procesotrabajo.php');
include('../../app/controllers/maestros/accidentes/listado_tipolugar.php');
include('../../app/controllers/maestros/accidentes/listado_tipoaccidente.php');
include('../../app/controllers/maestros/accidentes/listado_gravedad.php');


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
    <form action="../../app/controllers/accidentes/create.php" method="post">

        <div class="well">
            <div class="row">

                <div class="col-sm-2">
                    <div class="form-group row">
                        <label for="nombre" class="col-form-label col-sm-2">Nº:</label>
                        <div class="col-sm-4">
                            <input type="text" name="nroaccidente_ace" id="nroaccidente_ace" class="form-control" placeholder="nro. accdidente" tabindex="1">
                        </div>
                    </div>
                </div>


                <div class="col-sm-3">
                    <div class="form-group row">
                        <label for="nombre" class="col-form-label col-sm-3">Tipo acc:</label>
                        <div class="col-sm-5">
                            <select name="tipoaccidente_ace" id="tipoaccidente_ace" class="form-control" onchange="selectIdta(event)">
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
                            <select name="trabajador_ace" id="trabajador_ace" class="form-control" onchange="selectIdtr(event)">
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
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title"><i class="bi bi-person-fill" style="text-align: left;"></i> 1. Datos trabajador</h3>
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
                             
                                
                                        <input type="date" id="edad_tr" class="form-control" value="edad_tr" disabled>
                                    </div>
                                </div>
                            </div>


                        </div>

                    </div>
                </div>
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fa fa-book" style="text-align: left;"></i> 2. Datos de la empresa</h3>
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
                            <div class="col-sm-4">
                                <div class="form-group row">
                                    <label for="modalidadprl_emp" class="col-form-label col-sm-2">Modalidad preventiva</label>
                                    <div class="col-sm-10">
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
                        <h3 class="card-title"><i class="bi bi-geo-alt-fill" style="text-align: left;"></i> 3. Lugar y/o centro de trabajo donde ha ocurrido</h3>
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
                                        <select class="form-select" name="lugar_ace" aria-label="Default select example">
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
                        <h3 class="card-title"><i class="bi bi-exclamation-triangle-fill" style="text-align: left;"></i> 4. Datos del suceso (1)</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-2">
                                <div class="form-group row">
                                    <label for="tipoaccidente_ace" class="col-form-label col-sm-2">Tipo</label>
                                    <div class="col-sm-7">
                                        <input type="text" name="tipoaccidente_ace" id="tipoaccidente_ta" class="form-control" disabled>
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
                                            let fechaFormateada = date.toLocaleDateString('es-MX', options);
                                            console.log(fechaFormateada);

                                            var diasemana = document.getElementById("diaSemana").value = fechaFormateada;
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
                                        <input type="text" id="diaSemana" class="form-control" value="diaSemana.value" disabled>
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
                                    <label for="diadescanso_ace" class="col-form-label col-sm-5">Dia ult. descanso:</label>
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
                        <div class="row">

                            <div class="col-sm-3">
                                <div class="form-group row">
                                    <label for="isevaluadoriesgo_ace" class="col-form-label col-sm-4">Riesgo evaluado:</label>
                                    <div class="col-sm-3">
                                        <select class="form-select" name="isevaluadoriesgo_ace" aria-label="Default select example">
                                            <option selected>-</option>
                                            <option value="SI">SI</option>
                                            <option value="NO">NO</option>

                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-3">
                                <div class="form-group row">
                                    <label for="evalconriesgo_ace" class="col-form-label col-sm-5">La evaluacion contempla este riesgo:</label>
                                    <div class="col-sm-3">
                                        <select class="form-select" name="evalconriesgo_ace" aria-label="Default select example">
                                            <option selected>-</option>
                                            <option value="SI">SI</option>
                                            <option value="NO">NO</option>

                                        </select>
                                    </div>
                                </div>
                            </div>



                        </div>
                        <hr>
                        <div class="row">

                            <div class="col-sm-3">
                                <div class="form-group row">
                                    <label for="isrecaida_ace" class="col-form-label col-sm-4">Es una recaida:</label>
                                    <div class="col-sm-3">
                                        <select class="form-select" name="isrecaida_ace" aria-label="Default select example">
                                            <option selected>-</option>
                                            <option value="SI">SI</option>
                                            <option value="NO">NO</option>

                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group row">
                                    <label for="nombre" class="col-form-label col-sm-4">Fecha accidente inicial:</label>
                                    <div class="col-sm-3">
                                        <input type="date" id="fechaantesrecaida_ace" name="fechaantesrecaida_ace" class="form-control" tabindex="1">
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
                        <h3 class="card-title"><i class="bi bi-exclamation-triangle-fill" style="text-align: left;"></i> 4. Datos del suceso (2)</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group row">
                                    <label for="descripcion_ace" class="col-form-label col-sm-2">Descripcion del suceso</label>
                                    <div class="col-sm-12">
                                        <textarea class="form-control" name="descripcion_ace" rows="3"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">

                            <div class="col-sm-5">
                                <div class="form-group row">
                                    <label for="tipolugar_ace" class="col-form-label col-sm-2">Tipo lugar:</label>
                                    <div class="col-sm-9">
                                        <select name="tipolugar_ace" id="tipolugar_ace" class="form-control">
                                            <option value="0">--Seleccione tipo--</option>
                                            <?php
                                            foreach ($ace_tipolugar_datos as $ace_tipolugar_dato) { ?>
                                                <option value="<?php echo $ace_tipolugar_dato['id_tipolugar']; ?>"><?php echo $ace_tipolugar_dato['codtipolugar_tl']; ?> | <?php echo $ace_tipolugar_dato['tipolugar_tl']; ?> </option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group row">
                                    <label for="nombre" class="col-form-label col-sm-4">Zona donde se produjo:</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="zonalugar_ace" name="zonalugar_ace" class="form-control" tabindex="1">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group row">
                                    <label for="observaclugar_ace" class="col-form-label col-sm-3">Observaciones del lugar</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="observaclugar_ace" class="form-control" value="">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">

                            <div class="col-sm-5">
                                <div class="form-group row">
                                    <label for="procesotrabajo_ace" class="col-form-label col-sm-2">Proceso trabajo:</label>
                                    <div class="col-sm-9">
                                        <select name="procesotrabajo_ace" id="tipolugar_ace" class="form-control">
                                            <option value="0">--Seleccione proceso--</option>
                                            <?php
                                            foreach ($ace_procesotrabajo_datos as $ace_procesotrabajo_dato) { ?>
                                                <option value="<?php echo $ace_procesotrabajo_dato['id_procesotrabajo']; ?>"><?php echo $ace_procesotrabajo_dato['codigo_pt']; ?> | <?php echo $ace_procesotrabajo_dato['procesotrabajo_pt']; ?> </option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-7">
                                <div class="form-group row">
                                    <label for="observproceso_ace" class="col-form-label col-sm-3">Observaciones del proceso</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="observproceso_ace" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">

                            <div class="col-sm-5">
                                <div class="form-group row">
                                    <label for="tipoactividad_ace" class="col-form-label col-sm-2">Tipo actividad:</label>
                                    <div class="col-sm-9">
                                        <select name="tipoactividad_ace" id="tipolugar_ace" class="form-control">
                                            <option value="0">--Seleccione la actividad que estaba realizando el trabajador--</option>
                                            <?php
                                            foreach ($ace_actividadfisica_datos as $ace_actividadfisica_dato) { ?>
                                                <option value="<?php echo $ace_actividadfisica_dato['id_actividadfisica']; ?>"><?php echo $ace_actividadfisica_dato['codactivfis_af']; ?> | <?php echo $ace_actividadfisica_dato['activfisica_af']; ?> </option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-7">
                                <div class="form-group row">
                                    <label for="observtipoactiv_ace" class="col-form-label col-sm-3">Observaciones tipo actividad</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="observtipoactiv_ace" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">

                            <div class="col-sm-5">
                                <div class="form-group row">
                                    <label for="agentematerial_ace" class="col-form-label col-sm-2">Agente material a la actividad:</label>
                                    <div class="col-sm-9">
                                        <select name="agentematerial_ace" id="tipolugar_ace" class="form-control">
                                            <option value="0">--Seleccione el agente material asociado a la actividad--</option>
                                            <?php
                                            foreach ($ace_agentematerial_datos as $ace_agentematerial_dato) { ?>
                                                <option value="<?php echo $ace_agentematerial_dato['id_agentematerial']; ?>"><?php echo $ace_agentematerial_dato['codagentemat_am']; ?> | <?php echo $ace_agentematerial_dato['agentematerial_am']; ?> </option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-7">
                                <div class="form-group row">
                                    <label for="observagmaterial_ace" class="col-form-label col-sm-3" title="Observaciones asociadas al agente material">Observaciones Agente material</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="observagmaterial_ace" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">

                            <div class="col-sm-5">
                                <div class="form-group row">
                                    <label for="desviacion_ace" class="col-form-label col-sm-2">Desviacion producida:</label>
                                    <div class="col-sm-9">
                                        <select name="desviacion_ace" id="desviacion_ace" class="form-control">
                                            <option value="0">--Seleccione la desviacion que se ha producido--</option>
                                            <?php
                                            foreach ($ace_desviacion_datos as $ace_desviacion_dato) { ?>
                                                <option value="<?php echo $ace_desviacion_dato['id_desviacion']; ?>"><?php echo $ace_desviacion_dato['coddesviacion_des']; ?> | <?php echo $ace_desviacion_dato['desviacion_des']; ?> </option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-7">
                                <div class="form-group row">
                                    <label for="observdesviacion_ace" class="col-form-label col-sm-3">Observaciones desviacion</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="observdesviacion_ace" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">

                            <div class="col-sm-5">
                                <div class="form-group row">
                                    <label for="agmaterdesv_ace" class="col-form-label col-sm-2">Agente material desviacion:</label>
                                    <div class="col-sm-9">
                                        <select name="agmaterdesv_ace" class="form-control">
                                            <option value="0">--Seleccione el agente material asociado a la actividad--</option>
                                            <?php
                                            foreach ($ace_agentematerialdesv_datos as $ace_agentematerialdesv_dato) { ?>
                                                <option value="<?php echo $ace_agentematerialdesv_dato['id_agentematerialdesv']; ?>"><?php echo $ace_agentematerialdesv_dato['codagentematdesv_amd']; ?> | <?php echo $ace_agentematerialdesv_dato['agentematerialdesv_amd']; ?> </option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-7">
                                <div class="form-group row">
                                    <label for="observagendesv_ace" class="col-form-label col-sm-3" title="Observaciones asociadas al agente material">Observaciones Agente material</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="observagendesv_ace" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">

                            <div class="col-sm-5">
                                <div class="form-group row">
                                    <label for="formacontacto_ace" class="col-form-label col-sm-2">Formad de contacto:</label>
                                    <div class="col-sm-9">
                                        <select name="formacontacto_ace" class="form-control">
                                            <option value="0">--Seleccione la forma de contacto--</option>
                                            <?php
                                            foreach ($ace_formacontacto_datos as $ace_formacontacto_dato) { ?>
                                                <option value="<?php echo $ace_formacontacto_dato['id_formacontacto']; ?>"><?php echo $ace_formacontacto_dato['codformacont_fc']; ?> | <?php echo $ace_formacontacto_dato['formacontacto_fc']; ?> </option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-7">
                                <div class="form-group row">
                                    <label for="observformacont_ace" class="col-form-label col-sm-3" title="Observaciones a la forma de contacto">Observaciones forma contacto:</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="observformacont_ace" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">

                            <div class="col-sm-5">
                                <div class="form-group row">
                                    <label for="matercasusalesi_ace" class="col-form-label col-sm-2">Agente material causa lesion:</label>
                                    <div class="col-sm-9">
                                        <select name="matercasusalesi_ace" class="form-control">
                                            <option value="0">--Seleccione el agente material que ha causado la lesion--</option>
                                            <?php
                                            foreach ($ace_agentematerialles_datos as $ace_agentematerialles_dato) { ?>
                                                <option value="<?php echo $ace_agentematerialles_dato['id_agentematerialles']; ?>"><?php echo $ace_agentematerial_dato['codagentematles_aml']; ?> | <?php echo $ace_agentematerial_dato['agentematerialles_aml']; ?> </option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-7">
                                <div class="form-group row">
                                    <label for="observmatlesi_ace" class="col-form-label col-sm-3" title="Observaciones asociadas al agente material">Observaciones Agente material</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="observmatlesi_ace" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-2">
                                <div class="form-group row">
                                    <label for="numtrafectados_ace" class="col-form-label col-sm-8"> N.Trabajadores afectados:</label>
                                    <div class="col-sm-4">
                                        <input type="text" name="numtrafectados_ace" class="form-control" tabindex="1">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group row">
                                    <label for="declaraciontrab_ace" class="col-form-label col-sm-2">Declaracion del trabajador accidentado</label>
                                    <div class="col-sm-12">
                                        <textarea class="form-control" name="declaraciontrab_ace" rows="3"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="form-group row">
                                    <label for="istestigos_ace" class="col-form-label col-sm-4">Hubo testigos:</label>
                                    <div class="col-sm-3">
                                        <select class="form-select" name="istestigos_ace" aria-label="Default select example">
                                            <option selected>-</option>
                                            <option value="SI">SI</option>
                                            <option value="NO">NO</option>

                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group row">
                                    <label for="detallestestigo_ace" class="col-form-label col-sm-3">Detalles testigo</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="detallestestigo_ace" class="form-control" value="">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group row">
                                    <label for="declaraciontestigo_ace" class="col-form-label col-sm-2">Declaracion del testigo</label>
                                    <div class="col-sm-12">
                                        <textarea class="form-control" name="declaraciontestigo_ace" rows="3"></textarea>
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
                        <h3 class="card-title"><i class="bi bi-plus-square-fill" style="text-align: left;"></i> 5. Datos asistenciales</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row">

                            <div class="col-sm-5">
                                <div class="form-group row">
                                    <label for="tipolesion_ace" class="col-form-label col-sm-2">Lesion:</label>
                                    <div class="col-sm-9">
                                        <select name="tipolesion_ace" class="form-control">
                                            <option value="0">--Seleccione el tipo lesion--</option>
                                            <?php
                                            foreach ($ace_tipolesion_datos as $ace_tipolesion_dato) { ?>
                                                <option value="<?php echo $ace_tipolesion_dato['id_tipolesion']; ?>"><?php echo $ace_tipolesion_dato['codtipolesion_tl']; ?> | <?php echo $ace_tipolesion_dato['tipolesion_tl']; ?> </option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group row">
                                    <label for="gradolesion_ace" class="col-form-label col-sm-4">Gravedad de la lesion:</label>
                                    <div class="col-sm-7">
                                        <select name="gradolesion_ace" class="form-control">
                                            <option value="0">--Seleccione gravedad--</option>
                                            <?php
                                            foreach ($ace_gravedad_datos as $ace_gravedad_dato) { ?>
                                                <option value="<?php echo $ace_gravedad_dato['id_gravedad']; ?>"><?php echo $ace_gravedad_dato['codgravedad_gr']; ?> | <?php echo $ace_gravedad_dato['gravedad_gr']; ?> </option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label for="partecuerpo_ace" class="col-form-label col-sm-3">Parte del cuerpo lesionada:</label>
                                    <div class="col-sm-9">
                                        <select name="partecuerpo_ace" class="form-control">
                                            <option value="0">--Seleccione la parte del cuerpo afectada--</option>
                                            <?php
                                            foreach ($ace_partecuerpo_datos as $ace_partecuerpo_dato) { ?>
                                                <option value="<?php echo $ace_partecuerpo_dato['id_partecuerpo']; ?>"><?php echo $ace_partecuerpo_dato['codpartecuerpo_pc']; ?> | <?php echo $ace_partecuerpo_dato['partecuerpo_pc']; ?> </option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">

                            <div class="col-sm-3">
                                <div class="form-group row">
                                    <label for="isevacuacion_ace" class="col-form-label col-sm-4">Ha sido evacuado:</label>
                                    <div class="col-sm-3">
                                        <select class="form-select" name="isevacuacion_ace" aria-label="Default select example">
                                            <option selected>-</option>
                                            <option value="SI">SI</option>
                                            <option value="NO">NO</option>

                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="form-group row">
                                    <label for="lugarevacuacion_ace" class="col-form-label col-sm-3">Lugar evacuado:</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="lugarevacuacion_ace" class="form-control" value="">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">

                            <div class="col-sm-3">
                                <div class="form-group row">
                                    <label for="centromedico_ace" class="col-form-label col-sm-4">Asistido en centro médico:</label>
                                    <div class="col-sm-3">
                                        <select class="form-select" name="centromedico_ace" aria-label="Default select example">
                                            <option selected>-</option>
                                            <option value="SI">SI</option>
                                            <option value="NO">NO</option>

                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="form-group row">
                                    <label for="detallescentromed_ace" class="col-form-label col-sm-3">Centro médico:</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="detallescentromed_ace" class="form-control" value="">
                                    </div>
                                </div>
                            </div>


                            <div class="col-sm-3">
                                <div class="form-group row">
                                    <label for="recomedincorp_ace" class="col-form-label col-sm-4">Fecha recon. medico incorporacion:</label>
                                    <div class="col-sm-3">
                                        <input type="date" id="recomedincorp_ace" name="recomedincorp_ace" class="form-control" tabindex="1">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group row">
                                    <label for="recinedtrab_ace" class="col-form-label col-sm-4">Fecha recon. medico previo:</label>
                                    <div class="col-sm-3">
                                        <input type="date" id="recinedtrab_ace" name="recinedtrab_ace" class="form-control" tabindex="1">
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
                        <h3 class="card-title"><i class="bi bi-plus-square-fill" style="text-align: left;"></i> 6. Datos del análisis de causas</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row">

                            <div class="col-sm-3">
                                <div class="form-group row">
                                    <label for="istrinformado_ace" class="col-form-label col-sm-4">Ha recibido informacion (Art. 18 LPRL):</label>
                                    <div class="col-sm-3">
                                        <select class="form-select" name="istrinformado_ace" aria-label="Default select example">
                                            <option selected>-</option>
                                            <option value="SI">SI</option>
                                            <option value="NO">NO</option>

                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-3">
                                <div class="form-group row">
                                    <label for="istrformado_ace" class="col-form-label col-sm-4">Ha recibido formacion (Art. 19 LPRL):</label>
                                    <div class="col-sm-3">
                                        <select class="form-select" name="istrformado_ace" aria-label="Default select example">
                                            <option selected>-</option>
                                            <option value="SI">SI</option>
                                            <option value="NO">NO</option>

                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group row">
                                    <label for="protcolectivadisp_ace" class="col-form-label col-sm-3">Proteccion colectiva necesaria:</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="protcolectivadisp_ace" class="form-control" value="">
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="form-group row">
                                    <label for="protcolecnecesa_ace" class="col-form-label col-sm-3">Proteccion colectiva disponible:</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="protcolecnecesa_ace" class="form-control" value="">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group row">
                                    <label for="observprotcol_ace" class="col-form-label col-sm-3">Observaciones:</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="observprotcol_ace" class="form-control" value="">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group row">
                                    <label for="episdispon_ace" class="col-form-label col-sm-3">EPIs necesarios:</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="episdispon_ace" class="form-control" value="">
                                    </div>
                                </div>
                            </div>


                            <div class="col-sm-4">
                                <div class="form-group row">
                                    <label for="episneces_ace" class="col-form-label col-sm-3">EPIs disponibles:</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="episneces_ace" class="form-control" value="">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group row">
                                    <label for="observepis_ace" class="col-form-label col-sm-3">Observaciones:</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="observepis_ace" class="form-control" value="">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group row">
                                    <label for="causaaccidente_ace" class="col-form-label col-sm-1">Causa del accidente:</label>
                                    <div class="col-sm-11">
                                        <textarea class="form-control" name="causaaccidente_ace" rows="3"></textarea>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group row">
                                    <label for="porquecausa_ace" class="col-form-label col-sm-3">Porque se produjo la causa:</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="porquecausa_ace" class="form-control" value="">
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="form-group row">
                                    <label for="quiencontrolcausa_ace" class="col-form-label col-sm-3">Quien tenia control causa:</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="quiencontrolcausa_ace" class="form-control" value="">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-7">
                                <div class="form-group row">
                                    <label for="conclusionacci_ace" class="col-form-label col-sm-2">Conclusiones:</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" name="conclusionacci_ace" rows="3"></textarea>

                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="row">

                            <div class="col-sm-7">
                                <div class="form-group row">
                                    <label for="medidasprev_ace" class="col-form-label col-sm-2">Medidas preventivas:</label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control" name="medidasprev_ace" rows="3"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-5">
                                <div class="form-group row">
                                    <label for="valoracionmedida_ace" class="col-form-label col-sm-2">Valoracion medidas preventivas:</label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control" name="valoracionmedida_ace" rows="2"></textarea>
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
                        <h3 class="card-title"><i class="bi bi-plus-square-fill" style="text-align: left;"></i> 7. Histórico accidente e incidentes</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row">

                            <div class="col-sm-3">
                                <div class="form-group row">
                                    <label for="histaccult12mes_ace" class="col-form-label col-sm-4">Accidentes ultimos 12 meses:</label>
                                    <div class="col-sm-3">
                                        <select class="form-select" name="histaccult12mes_ace" aria-label="Default select example">
                                            <option selected>-</option>
                                            <option value="SI">SI</option>
                                            <option value="NO">NO</option>

                                        </select>
                                    </div>
                                </div>
                            </div>


                            <div class="col-sm-4">
                                <div class="form-group row">
                                    <label for="histpuestoacc_ace" class="col-form-label col-sm-3">En que puesto:</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="histpuestoacc_ace" class="form-control" value="">
                                    </div>
                                </div>
                            </div>


                            <div class="col-sm-4">
                                <div class="form-group row">
                                    <label for="histtrabajosreal_ace" class="col-form-label col-sm-3">Que operaciones realizaba:</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="histtrabajosreal_ace" class="form-control" value="">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group row">
                                    <label for="histcausaacc_ace" class="col-form-label col-sm-3">Causas:</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="histcausaacc_ace" class="form-control" value="">
                                    </div>
                                </div>
                            </div>


                            <div class="col-sm-4">
                                <div class="form-group row">
                                    <label for="histmedidaacc_ace" class="col-form-label col-sm-3">Medidas que adoptaron:</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="histmedidaacc_ace" class="form-control" value="">
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
                        <h3 class="card-title"><i class="bi bi-plus-square-fill" style="text-align: left;"></i> 8. Fechas y firmas</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row">

                            <div class="container-fluid">
                                <div class="row mb-2">
                                    <div class="col-sm-6">
                                        <h5 class="m-0"><b>Persona que realiza el análisis del suceso:</b></h5>
                                    </div><!-- /.col -->
                                    <hr>
                                </div><!-- /.row -->
                            </div><!-- /.container-fluid -->

                            <div class="col-sm-4">
                                <div class="form-group row">
                                    <label for="investigador_ace" class="col-form-label col-sm-3">Nombre y apellidos:</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="investigador_ace" class="form-control" value="">
                                    </div>
                                </div>
                            </div>


                            <div class="col-sm-4">
                                <div class="form-group row">
                                    <label for="cargoinvesiga_ace" class="col-form-label col-sm-3">Cargo:</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="cargoinvesiga_ace" class="form-control" value="">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group row">
                                        <label for="fechainvestiga_ace" class="col-form-label col-sm-3">Fecha investigación:</label>
                                        <div class="col-sm-8">
                                            <input type="date" name="fechainvestiga_ace" class="form-control" value="">
                                        </div>
                                    </div>
                                </div>


                                <div class="col-sm-4">
                                    <div class="form-group row">
                                        <label for="fechacumplimen_ace" class="col-form-label col-sm-3">Fecha cumplimentación</label>
                                        <div class="col-sm-8">
                                            <input type="date" name="fechacumplimen_ace" class="form-control" value="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">

                            <div class="container-fluid">
                                <div class="row mb-2">
                                    <div class="col-sm-6">
                                        <h5 class="m-0"><b>Revisado por:</b></h5>
                                    </div><!-- /.col -->
                                    <hr>
                                </div><!-- /.row -->
                            </div><!-- /.container-fluid -->

                            <div class="col-sm-4">
                                <div class="form-group row">
                                    <label for="revisadopor_ace" class="col-form-label col-sm-3">Nombre y apellidos:</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="revisadopor_ace" class="form-control" value="">
                                    </div>
                                </div>
                            </div>


                            <div class="col-sm-4">
                                <div class="form-group row">
                                    <label for="cargorevisado_ace" class="col-form-label col-sm-3">Cargo:</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="cargorevisado_ace" class="form-control" value="">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group row">
                                        <label for="fecharevision_ace" class="col-form-label col-sm-3">Fecha revisado:</label>
                                        <div class="col-sm-8">
                                            <input type="date" name="fecharevision_ace" class="form-control" value="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>

            </div>
            <hr>
            <div class="row">
                <div class="col-md-12">
                    <a href="" class="btn btn-secondary">Cancelar</a>
                    <input type="submit" class="btn btn-primary" value="Registrar accidente">
                </div>
            </div>


        </div>
    </form>
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