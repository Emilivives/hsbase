<?php include(BASE_PATH . '/app/controllers/perfiles/listado_perfiles.php');

include(BASE_PATH . '/app/controllers/trabajadores/listado_trabajadores_alfabet.php');
include(BASE_PATH . '/app/controllers/maestros/centros/listado_centros.php');
include(BASE_PATH . '/app/controllers/maestros/accidentes/listado_actividadfisica.php');
include(BASE_PATH . '/app/controllers/maestros/accidentes/listado_agentematerial.php');
include(BASE_PATH . '/app/controllers/maestros/accidentes/listado_agentematerialdesv.php');
include(BASE_PATH . '/app/controllers/maestros/accidentes/listado_agentematerialles.php');
include(BASE_PATH . '/app/controllers/maestros/accidentes/listado_desviacion.php');
include(BASE_PATH . '/app/controllers/maestros/accidentes/listado_formacontacto.php');
include(BASE_PATH . '/app/controllers/maestros/accidentes/listado_gravedad.php');
include(BASE_PATH . '/app/controllers/maestros/accidentes/listado_partecuerpo.php');
include(BASE_PATH . '/app/controllers/maestros/accidentes/listado_tipolesion.php');
include(BASE_PATH . '/app/controllers/maestros/accidentes/listado_procesotrabajo.php');
include(BASE_PATH . '/app/controllers/maestros/accidentes/listado_tipolugar.php');
include(BASE_PATH . '/app/controllers/maestros/accidentes/listado_tipoaccidente.php');
include(BASE_PATH . '/app/controllers/maestros/accidentes/listado_gravedad.php'); ?>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<div class="modal fade" id="nuevoModalAsistencia" tabindex="-1" aria-labelledby="nuevoModalAsistencia" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-secondary-subtle text-center">
                <h3 class="modal-title w-100 text-center" id="nuevoModalLabel"><b>NUEVO ASISTENCIA MUTUA POR ACCIDENTE LABORAL</b></h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <!--cuerpo del modal-->

                <form action="<?php echo BASE_PATH; ?>/app/controllers/accidentes/create_modal.php" method="post">


                    <div class="well">
                        <div class="row">

                            <div class="col-sm-4">
                                <div class="form-group row">
                                    <label for="nombre" class="col-form-label col-sm-3">Tipo acc:</label>
                                    <div class="col-sm-6">
                                        <select name="1tipoaccidente_ace" id="1tipoaccidente_ace" class="form-control" onchange="selectIdta(event)">
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


                            <div class="col-sm-4">
                                <div class="form-group row">
                                    <label for="nombre" class="col-form-label col-sm-2">Fecha:</label>
                                    <div class="col-sm-5">
                                        <input type="date" name="fecha_ace" id="fecha_ace" class="form-control" tabindex="1" onchange="copiar()" required>
                                    </div>
                                </div>
                                <script type="text/javascript">
                                    function copiar() {
                                        var copiar = document.getElementById("fecha_ace");
                                        var pegar = document.getElementById("fecha_ace2");
                                        pegar.value = copiar.value;

                                        // Calcular el día de la semana
                                        var fecha = new Date(copiar.value);
                                        var dias = ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'];
                                        var dia = dias[fecha.getDay()];

                                        // Asignar el día de la semana al campo correspondiente
                                        diaSemana.value = dia;


                                    }
                                </script>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group row">
                                    <label for="nombre" class="col-form-label col-sm-2">Nombre:</label>
                                    <div class="col-sm-8">
                                        <select name="1trabajador_ace" id="1trabajador_ace" style="width: 120%" class="1trabajador_ace" onchange="selectIdtr(event)">
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
                                        <select name="1centro_ace" id="1btn_centro" class="form-control" onchange="selectIdcen(event)">
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
                                <h3 class="card-title"><i class="bi bi-person-fill" style="text-align: left;"></i> 1. Datos trabajador / Empresa</h3>
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

                                    <div class="col-sm-8">
                                        <div class="form-group row">
                                            <label for="nombre_tr" class="col-form-label col-sm-2">Nombre</label>
                                            <div class="col-sm-8">
                                                <input type="text" id="nombre_tr" class="form-control" disabled>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group row">
                                            <label for="dni_tr" class="col-form-label col-sm-4">DNI/NIE</label>
                                            <div class="col-sm-8">
                                                <input type="text" id="dni_tr" class="form-control" disabled>
                                            </div>
                                        </div>
                                    </div>


                                </div>
                                <div class="row">
                                    <div class="col-sm-8">
                                        <div class="form-group row">
                                            <label for="categoria_tr" class="col-form-label col-sm-2">Puesto</label>
                                            <div class="col-sm-8">
                                                <input type="text" id="categoria_tr" class="form-control" disabled>

                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group row">
                                            <label for="nombre_emp" class="col-form-label col-sm-3">Empresa</label>
                                            <div class="col-sm-8">
                                                <input type="text" id="nombre_emp" class="form-control" disabled>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-8">
                                        <div class="form-group row">
                                            <label for="razonsocial_emp" class="col-form-label col-sm-2">Razon social</label>
                                            <div class="col-sm-10">
                                                <input type="text" id="razonsocial_emp" class="form-control" disabled>
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

                    <div class="card card-outline card-primary">
                        <div class="card-header">
                            <h3 class="card-title"><i class="bi bi-geo-alt-fill" style="text-align: left;"></i> 2. Lugar y/o centro de trabajo donde ha ocurrido</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
               
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group row">
                                        <label for="lugar" class="col-form-label col-sm-3">Lugar</label>
                                        <div class="col-sm-9">
                                            <select class="form-select" name="1lugar_ace" aria-label="Default select example">
                                                <option selected value="No seleccionado">Selecciona lugar</option>
                                                <option value="En el propio centro">En el propio centro</option>
                                                <option value="En otro centro de trabajo">En otro centro de trabajo</option>
                                                <option value="In itinere">In itinere</option>
                                                <option value="Desplazamiento entre centros">Desplazamiento entre centros</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-8">
                                    <div class="form-group row">
                                        <label for="razonsocial_emp" class="col-form-label col-sm-3">Detalles lugar</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="1detalleslugar_ace" id="" class="form-control">
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="row">

                        <div class="card card-outline card-primary">
                            <div class="card-header">
                                <h3 class="card-title"><i class="bi bi-exclamation-triangle-fill" style="text-align: left;"></i> 4. Datos del suceso</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>

                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group row">
                                            <label for="tipoaccidente_ace" class="col-form-label col-sm-2">Tipo</label>
                                            <div class="col-sm-7">
                                                <input type="text" name="1tipoaccidente_ace" id="1tipoaccidente_ta" class="form-control" disabled>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group row">
                                            <label for="nombre" class="col-form-label col-sm-3">Fecha:</label>
                                            <div class="col-sm-6">
                                                <input type="date" id="1fecha_ace2" name="1fecha_ace2" class="form-control" tabindex="1" onchange="diaSemana()" disabled>
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

                                    <div class="col-sm-4">
                                        <div class="form-group row">
                                            <label for="nombre" class="col-form-label col-sm-3">Hora:</label>
                                            <div class="col-sm-4">
                                                <input type="time" name="1hora_ace" class="form-control" tabindex="1" required>
                                            </div>
                                        </div>
                                    </div>



                                </div>

                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group row">
                                            <label for="descripcion_ace" class="col-form-label col-sm-4">Descripcion del suceso</label>
                                            <div class="col-sm-12">
                                                <textarea class="form-control" name="1descripcion_ace" rows="3"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group row">
                                            <label for="nombre" class="col-form-label col-sm-3">Lugar donde se produjo:</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="1zonalugar_ace" class="form-control" tabindex="1">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group row">
                                            <label for="observproceso_ace" class="col-form-label col-sm-3">Trabajo que realizaba</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="1observproceso_ace" class="form-control">
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

                                    <div class="col-sm-6">
                                        <div class="form-group row">
                                            <label for="tipolesion_ace" class="col-form-label col-sm-2">Lesion:</label>
                                            <div class="col-sm-9">
                                                <select name="1tipolesion_ace" class="form-control">
                                                    <option value="1">--Seleccione el tipo lesion--</option>
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

                                    <div class="col-sm-6">
                                        <div class="form-group row">
                                            <label for="partecuerpo_ace" class="col-form-label col-sm-3">Parte cuerpo:</label>
                                            <div class="col-sm-9">
                                                <select name="1partecuerpo_ace" class="form-control">
                                                    <option value="1">--Seleccione la parte del cuerpo afectada--</option>
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
                                    <div class="col-sm-12">
                                        <div class="form-group row">
                                            <label for="causaaccidente_ace" class="col-form-label col-sm-3">Causa del accidente:</label>
                                            <div class="col-sm-9">
                                                <textarea class="form-control" name="1causaaccidente_ace" rows="2"></textarea>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>



                    <div class="row">
                        <div class="col-md-12">
                            <a href="" class="btn btn-secondary">Cancelar</a>
                            <input type="submit" class="btn btn-primary" value="Registrar accidente">
                        </div>
                    </div>


            </div>
            </form>
            <!-- Pie del Modal -->

        </div>

    </div>
</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    $(document).ready(function() {
        $('#1trabajador_ace').select2({
            theme: 'bootstrap4',
        });
    });
 
</script>
