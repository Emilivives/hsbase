<?php
session_start();
include('../../app/config.php');

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['sesion_email'])) {
    header('Location: ' . $URL . '/login.php');
    exit();
}

// Verificar si el usuario tiene permiso para acceder a esta página
if ($_SESSION['perfil_usr'] !== 'ADMINISTRADOR' && $_SESSION['perfil_usr'] !== 'USUARIO_PRL') {
    // Si el usuario no es administrador, redirigirlo a su dashboard de usuario
    header('Location: ' . $URL . '/admin/acceso_nopermitido.php');
    exit();
}
include('../../admin/layout/parte1.php');
include('../../app/controllers/maestros/centros/listado_centros.php');
include('../../app/controllers/actividad/listado_proyectos.php');
include('../../app/controllers/actividad/listado_accionprl.php');
include('../../app/controllers/maestros/responsables/listado_responsables.php');
?>
<html>
<!-- Font Awesome -->
<link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
<!-- Ionicons -->
<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

<style>
    .dropdown-font-size {
        font-size: 12px;
    }

    .btn-font-size {
        font-size: 12px;
    }

    .btn-small {
        font-size: 0.8rem;
        /* Tamaño de fuente más pequeño */
        padding: 0.2rem 0.4rem;
        /* Tamaño de relleno más pequeño */
        border-radius: 0.2rem;
        /* Radio de borde pequeño */
        line-height: 1;
        /* Ajustar la altura de línea para un tamaño de botón más pequeño */
        }

        .small-box {
            padding: 7px;
            text-align: center;
            border-radius: 5px;
        }
        .small-box .inner {
            padding: 0;
        }
        .small-box h2 {
            font-size: 1.5rem;
            margin: 0;
        }
        .small-box p {
            font-size: 0.8rem;
            margin: 0;
        }
     

</style>


<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h3 class="m-0">Acciones PRL (correctoras o preventivas)</h3>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                    <li class="breadcrumb-item"><a href="#">Actividades</a></li>
                    <li class="breadcrumb-item active">Acciones PRL</li>
                </ol>
            </div><!-- /.col -->
            <hr class="border-primary">
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>


</html>


<div class="row">
        <div class="col-lg-2 col-6">
            <!-- small box -->
            <div class="small-box bg-light shadow-sm border">
                <div class="inner">
                    <?php
                    $fechahoraentera = strtotime($fechahora);
                    $anio = date("Y", $fechahoraentera);
                    $contador_de_acciones = 0;
                    foreach ($accionprl_datos as $accionprl_dato) {
                        if ((date("Y", strtotime($accionprl_dato['fecha_acc'])) == $anio)) {
                            $contador_de_acciones = $contador_de_acciones + 1;
                        }
                    }
                    ?>
                    <h2><?php echo $contador_de_acciones; ?><sup style="font-size: 20px"></sup></h2>
                    <p>Acciones Preventivas en <?php echo $anio; ?></p>
                </div>
                
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-1 col-6">
            <!-- small box -->
            <div class="small-box bg-light shadow-sm border">
                <div class="inner">
                    <?php
                    $fechahoraentera = strtotime($fechahora);
                    $anio = date("Y", $fechahoraentera);
                    $contador_de_acciones_abiertas = 0;
                    foreach ($accionprl_datos as $accionprl_dato) {
                        if ($accionprl_dato['estado_acc'] != 'Cerrada') {
                            $contador_de_acciones_abiertas = $contador_de_acciones_abiertas + 1;
                        }
                    }
                    ?>
                    <h2><?php echo $contador_de_acciones_abiertas; ?><sup style="font-size: 20px"></sup></h2>
                    <p>Acciones abiertas</p>
                </div>
              
            </div>
        </div>
        <!-- ./col -->
    </div>

<!-- /.content-header -->

<div class="row">
    <div class="col-md-12">
        <div class="card card-outline card-info">
            <div class="card-header col-md-12">
                <h3 class="card-title"><b>Acciones Preventivas</b></h3>
                <style>
                    .btn-text-right {
                        text-align: right;
                    }
                </style>
                <!--boton modal-->
                <div class="btn-text-right">
                    <button type="button" class="btn btn-primary btn-sm btn-font-size" data-toggle="modal" data-target="#modal-nuevaaccion">NUEVA ACCIÓN</button>
                </div>

                <!--inicio modal nuev accion prl-->
                <div class="modal fade" id="modal-nuevaaccion">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <div class="modal-header" style="background-color:#0000a0;color:white">
                                <h5 class="modal-title" id="modal-nuevtrabajador">Nuevo Accion Correctora o Preventiva</h5>
                                <button type="button" class="close" style="color: white;" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">

                                <form action="../../app/controllers/actividad/create_accion.php" method="post" enctype="multipart/form-data">


                                    <div class="well">
                                        <div class="row">

                                            <div class="col-sm-6">
                                                <div class="form-group row">
                                                    <label for="nombre" class="col-form-label col-sm-3">Accion Nº:</label>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control" name="codigo_acc" id="" value="" placeholder="" tabindex="1">
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="col-sm-6">
                                                <div class="form-group row">
                                                    <label for="nombre" class="col-form-label col-sm-3">Fecha:</label>
                                                    <div class="col-sm-5">
                                                        <input type="date" name="fecha_acc" id="fecha_acc" value="" class="form-control" tabindex="1" required>
                                                    </div>
                                                </div>


                                            </div>
                                        </div>
                                        <div class="row">


                                            <div class="col-sm-6">
                                                <div class="form-group row">
                                                    <label for="centro" class="col-form-label col-sm-3">Centro: *</label>
                                                    <div class="col-sm-7">
                                                        <select name="centro_acc" id="btn_centro" class="form-control" required>
                                                            <option value="0">--Seleccione centro--</option>
                                                            <?php
                                                            foreach ($centros_datos as $centros_dato) { ?>
                                                                <option value="<?php echo $centros_dato['id_centro']; ?>" nombre_cen="<?php echo $centros_dato['nombre_cen']; ?>">
                                                                    <?php echo $centros_dato['nombre_cen']; ?> </option>
                                                            <?php
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>

                                                </div>

                                            </div>

                                            <div class="col-sm-6">
                                                <div class="form-group row">
                                                    <label for="prioridad" class="col-form-label col-sm-3">Prioridad:</label>
                                                    <div class="col-sm-6">
                                                        <select class="form-select" name="prioridad_acc" aria-label="Default select example">
                                                            <option value="-">Selecciona lugar</option>

                                                            <option value="Baja">Baja (< 3 meses)</option>
                                                            <option value="Media">Media (< 1 meses)</option>
                                                            <option value="Alta">Alta (< 10 dias)</option>
                                                            <option value="Urgente">Urgente (< 24 - 48 hrs)</option>
                                                        </select>




                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group row">

                                                    <label for="" class="col-form-label col-sm-3">Responsable *</label>
                                                    <div class="col-sm-9">
                                                        <select name="responsable_acc" id="" class="form-control" required>
                                                            <option value="">--Seleccione Responsable--</option>
                                                            <?php
                                                            foreach ($responsables_datos as $responsables_dato) { ?>
                                                                <option value="<?php echo $responsables_dato['id_responsable']; ?>"><?php echo $responsables_dato['nombre_resp']; ?> | <?php echo $responsables_dato['cargo_resp']; ?> </option>
                                                            <?php
                                                            }
                                                            ?>
                                                        </select>


                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div id="accordion">

                                                <div class="card card-outline card-primary" id="panelsStayOpen-headingone">
                                                    <div class="card-header">
                                                        <h3 class="card-title"><i class="bi bi-person-fill" style="text-align: left;"></i> 1. Detalles / Descripción</h3>
                                                        <div class="card-tools">
                                                            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="collapse" data-target="#panelsStayOpen-collapseOne" aria-expanded="false" aria-controls="panelsStayOpen-collapseOne">
                                                                <i class="fas fa-list"></i>
                                                            </button>
                                                        </div>

                                                        <div class="row">

                                                        </div>

                                                    </div>
                                                    <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show" aria-labelledby="panelsStayOpen-headingOne">


                                                        <div class="card-body">
                                                            <div class="row">

                                                                <div class="row">
                                                                    <div class="col-sm-12">
                                                                        <div class="form-group row">
                                                                            <label for="descripcion_acc" class="col-form-label col-sm-2">Descripcion:</label>
                                                                            <div class="col-sm-12">
                                                                                <textarea class="form-control" name="descripcion_acc" value="" rows="3"></textarea>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-sm-5">
                                                                    <div class="form-group row">
                                                                        <label for="origen_acc" class="col-form-label col-sm-3">Origen:</label>
                                                                        <div class="col-sm-9">
                                                                            <select class="form-select" name="origen_acc" aria-label="Default select example">

                                                                                <option value="-">Seleccione</option>

                                                                                <option value="Evaluacion de riesgos">Evaluacion de riesgos</option>
                                                                                <option value="Accidente de trabajo">Accidente de trabajo</option>
                                                                                <option value="Propuesta de mejora">Propuesta de mejora</option>
                                                                                <option value="Comunicado de riesgos">Comunicado de riesgos</option>
                                                                                <option value="Otros">Otros</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-7">
                                                                    <div class="form-group row">
                                                                        <label for="detalleorigen_acc" class="col-form-label col-sm-5">Informe procedencia / detalles:</label>
                                                                        <div class="col-sm-7">
                                                                            <input type="text" name="detalleorigen_acc" id="" class="form-control" value="">
                                                                        </div>
                                                                    </div>
                                                                </div>


                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="card card-outline card-primary" id="headingtwo">
                                                    <div class="card-header">
                                                        <h3 class="card-title"><i class="fa fa-book" style="text-align: left;"></i> 2. Medidas preventivas / correctoras</h3>
                                                        <div class="card-tools">
                                                            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                                                                <i class="fas fa-minus"></i>
                                                            </button>
                                                        </div>

                                                        <div class="row">

                                                        </div>

                                                    </div>
                                                    <div id="collapseTwo" class="collapse" aria-labelledby="collapseTwo">
                                                        <div class="card-body">
                                                            <div class="row">
                                                                <div class="col-sm-12">
                                                                    <div class="form-group row">
                                                                        <label for="accpropuesta_acc" class="col-form-label col-sm-2">Accion propuesta:</label>
                                                                        <div class="col-sm-12">
                                                                            <textarea class="form-control" name="accpropuesta_acc" value="" rows="2"></textarea>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">



                                                            </div>
                                                            <div class="row">
                                                                <div class="col-sm-12">
                                                                    <div class="form-group row">
                                                                        <label for="accrealizada_acc" class="col-form-label col-sm-2">Acción realizada:</label>
                                                                        <div class="col-sm-12">
                                                                            <textarea class="form-control" name="accrealizada_acc" value="" rows="2"></textarea>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="card card-outline card-primary" id="headingthree">
                                                    <div class="card-header">
                                                        <h3 class="card-title"><i class="bi bi-geo-alt-fill" style="text-align: left;"></i> 3. Seguimiento</h3>
                                                        <div class="card-tools">
                                                            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                                                <i class="fas fa-minus"></i>
                                                            </button>
                                                        </div>

                                                        <div class="row">

                                                        </div>

                                                    </div>
                                                    <div id="collapseThree" class="collapse" aria-labelledby="headingthree">
                                                        <div class="card-body">
                                                            <div class="row">
                                                                <div class="col-sm-4">
                                                                    <div class="form-group row">

                                                                        <label for="fechaprevista_acc" class="col-form-label col-sm-6">Fecha cierre prevista:</label>
                                                                        <div class="col-sm-6">
                                                                            <input type="date" name="fechaprevista_acc" id="fechaprevista_acc" value="" class="form-control" tabindex="1">
                                                                        </div>
                                                                    </div>
                                                                </div>



                                                                <div class="col-sm-4">
                                                                    <div class="form-group row">

                                                                        <label for="fechaprevista_acc" class="col-form-label col-sm-6">Fecha cierre real:</label>
                                                                        <div class="col-sm-6">
                                                                            <input type="date" name="fecharea_acc" id="fecharea_acc" value="" class="form-control" tabindex="1">
                                                                        </div>
                                                                    </div>
                                                                </div>


                                                                <div class="col-sm-4">
                                                                    <div class="form-group row">

                                                                        <label for="fechaveri_acc" class="col-form-label col-sm-6">Fecha verificación:</label>
                                                                        <div class="col-sm-6">
                                                                            <input type="date" name="fechaveri_acc" id="fechaveri_acc" value="<?php echo $fechaveri_acc ?>" class="form-control" tabindex="1">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-sm-4">
                                                                    <div class="form-group row">
                                                                        <label for="recursos_acc" class="col-form-label col-sm-5">Recursos (Eur):</label>
                                                                        <div class="col-sm-4">
                                                                            <input type="text" name="recursos_acc" id="" value="" class="form-control" tabindex="1">
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-4">
                                                                    <div class="form-group row">
                                                                        <label for="avance_acc" class="col-form-label col-sm-3">Avance:</label>
                                                                        <div class="col-sm-6">
                                                                            <select class="form-select" name="avance_acc" aria-label="Default select example">
                                                                                <option value="-">-</option>

                                                                                <option value="0%">0%</option>
                                                                                <option value="25%">25%</option>
                                                                                <option value="50%">50%</option>
                                                                                <option value="85%">85%</option>
                                                                                <option value="100%">100%</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-4">
                                                                    <div class="form-group row">
                                                                        <label for="estado_acc" class="col-form-label col-sm-3">Estado:</label>
                                                                        <div class="col-sm-7">
                                                                            <select class="form-select" name="estado_acc" aria-label="Default select example">
                                                                                <option value="-">-</option>

                                                                                <option value="Abierta">Abierta</option>
                                                                                <option value="Comunicada">Comunicada</option>
                                                                                <option value="En curso">En curso</option>
                                                                                <option value="Finalizada">Finalizada</option>
                                                                                <option value="Cerrada">Cerrada</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>


                                                            </div>
                                                            <hr>
                                                            <div class="row">
                                                                <div class="col-sm-12">
                                                                    <div class="form-group row">
                                                                        <label for="seguimiento_acc" class="col-form-label col-sm-3">Seguimiento acción: (fecha y detalles)</label>
                                                                        <div class="col-sm-9">
                                                                            <textarea class="form-control" name="seguimiento_acc" value="" rows="4"></textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>


                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>



                                                <div class="card card-outline card-primary" id="headingfour">
                                                    <div class="card-header">
                                                        <h3 class="card-title"><i class="bi bi-plus-square-fill" style="text-align: left;"></i> 4. Comentarios y imagenes</h3>
                                                        <div class="card-tools">
                                                            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                                                <i class="fas fa-minus"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                    <div id="collapseFour" class="collapse" aria-labelledby="headingfour">
                                                        <div class="card-body">
                                                            <div class="row">
                                                                <div class="col-sm-12">
                                                                    <div class="form-group row">
                                                                        <label for="accrealizada_acc" class="col-form-label col-sm-6">Comentarios y anotaciones:</label>
                                                                        <div class="col-sm-12">
                                                                            <textarea class="form-control" name="accrealizada_acc" value="" rows="2"></textarea>
                                                                        </div>

                                                                    </div>
                                                                </div>

                                                            </div>


                                                            <div class="row">
                                                                <div class="col-sm-6">
                                                                    <div class="form-group row">
                                                                        <div class="col-md-8">
                                                                            <label for="">Imagen 1 </label>
                                                                            <input type="file" name="imagen1_acc" class="form-control" id="file1">
                                                                            <a href="https://www.iloveimg.com/es/comprimir-imagen/comprimir-jpg" class="btn btn-outline-danger btn-small" role="button" target="_blank">
                                                                                Max. 1Mb
                                                                            </a>
                                                                            <br>
                                                                            <output id="list1">
                                                                            </output>
                                                                            <script>
                                                                                function archivo1(evt) {
                                                                                    var files = evt.target.files; // FileList object
                                                                                    // Obtenemos la imagen del campo "file1".
                                                                                    for (var i = 0, f; f = files[i]; i++) {
                                                                                        //Solo admitimos imágenes.
                                                                                        if (!f.type.match('image.*')) {
                                                                                            continue;
                                                                                        }
                                                                                        var reader = new FileReader();
                                                                                        reader.onload = (function(theFile) {
                                                                                            return function(e) {
                                                                                                // Insertamos la imagen
                                                                                                document.getElementById("list1").innerHTML = ['<img class="thumb thumbnail" src="', e.target.result, '" width="100%" title="', escape(theFile.name), '"/>'].join('');
                                                                                            };
                                                                                        })(f);
                                                                                        reader.readAsDataURL(f);
                                                                                    }
                                                                                }
                                                                                document.getElementById('file1').addEventListener('change', archivo1, false);
                                                                            </script>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="col-sm-6">
                                                                    <div class="form-group row">
                                                                        <div class="col-md-8">
                                                                            <label for="">Imagen 2 </label>
                                                                            <input type="file" name="imagen2_acc" class="form-control" id="file2">
                                                                            <a href="https://www.iloveimg.com/es/comprimir-imagen/comprimir-jpg" class="btn btn-outline-danger btn-small" role="button" target="_blank">
                                                                                Max. 1Mb
                                                                            </a>
                                                                            <br>
                                                                            <output id="list2">
                                                                            </output>
                                                                            <script>
                                                                                function archivo2(evt) {
                                                                                    var files = evt.target.files; // FileList object
                                                                                    // Obtenemos la imagen del campo "file2".
                                                                                    for (var i = 0, f; f = files[i]; i++) {
                                                                                        //Solo admitimos imágenes.
                                                                                        if (!f.type.match('image.*')) {
                                                                                            continue;
                                                                                        }
                                                                                        var reader = new FileReader();
                                                                                        reader.onload = (function(theFile) {
                                                                                            return function(e) {
                                                                                                // Insertamos la imagen
                                                                                                document.getElementById("list2").innerHTML = ['<img class="thumb thumbnail" src="', e.target.result, '" width="100%" title="', escape(theFile.name), '"/>'].join('');
                                                                                            };
                                                                                        })(f);
                                                                                        reader.readAsDataURL(f);
                                                                                    }
                                                                                }
                                                                                document.getElementById('file2').addEventListener('change', archivo2, false);
                                                                            </script>
                                                                        </div>
                                                                    </div>
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
                                            <input type="submit" class="btn btn-primary" value="Guardar">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>

                    <!--fin modal-->


                </div>

                <div class="card-body">
                    <table id="example1" class="table table-hover table-condensed">
                        <colgroup>
                            <col width="3%">
                            <col width="5%">
                            <col width="3%">
                            <col width="3%">
                            <col width="7%">
                            <col width="25%">
                            <col width="5%">
                            <col width="15%">
                            <col width="4%">
                            <col width="3%">
                            <col width="3%">
                            <col width="3%">
                        </colgroup>
                        <thead class="table-dark">
                            <tr>
                                <th style="text-align: left">Codigo</th>
                                <th style="text-align: left">Fecha</th>
                                <th style="text-align: center">Prioridad</th>
                                <th style="text-align: center">Empresa</th>
                                <th style="text-align: left">Centro</th>
                                <th style="text-align: left">Descripción</th>
                                <th style="text-align: left">Responsable</th>
                                <th style="text-align: left">Medida</th>
                                <th style="text-align: left">Realizada</th>
                                <th style="text-align: left">Estado</th>
                                <th style="text-align: left">Avance</th>
                                <th style="text-align: left">ACCIONES</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th><input type="text" placeholder="Filtrar Código" /></th>
                                <th><input type="text" placeholder="Filtrar Fecha" /></th>
                                <th>
                                    <select>
                                        <option value="">Todos</option>
                                        <option value="Baja">Baja</option>
                                        <option value="Media">Media</option>
                                        <option value="Alta">Alta</option>
                                        <option value="Urgente">Urgente</option>
                                    </select>
                                </th>
                                <th><input type="text" placeholder="Filtrar empresa" /></th>
                                <th><input type="text" placeholder="Filtrar Centro" /></th>
                                <th><input type="text" placeholder="Filtrar Descripción" /></th>
                                <th><input type="text" placeholder="Filtrar Responsable" /></th>
                                <th><input type="text" placeholder="Filtrar Medida" /></th>
                                <th><input type="text" placeholder="Filtrar Fecha" /></th>
                                <th>
                                    <select>
                                        <option value="">Todos</option>
                                        <option value="Cerrada">Cerrada</option>
                                        <option value="En curso">En curso</option>
                                        <option value="Comunicada">Comunicada</option>
                                        <option value="Abierta">Abierta</option>
                                        <option value="Finalizada">Finalizada</option>
                                    </select>
                                </th>
                                <th>
                                    <select>
                                        <option value="">Todos</option>
                                        <option value="0%">0%</option>
                                        <option value="25%">25%</option>
                                        <option value="50%">50%</option>
                                        <option value="85%">85%</option>
                                        <option value="100%">100%</option>
                                    </select>
                                </th>
                                <th></th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php
                            $contador = 0;
                            foreach ($accionprl_datos as $accionprl_dato) {
                                $contador = $contador + 1;
                                $id_accion = $accionprl_dato['id_accion'];
                            ?>
                                <tr>
                                    <td style="text-align: left"><b><?php echo $accionprl_dato['codigo_acc']; ?></b></td>
                                    <td style="text-align: left"><b><?php echo $accionprl_dato['fecha_acc']; ?></b></td>
                                    <td style="text-align: center"><?php $accionprl_dato['prioridad_acc']; ?>
                                        <?php if ($accionprl_dato['prioridad_acc'] == "Baja") { ?>
                                            <span class='badge badge-secondary'>Baja</span>
                                        <?php
                                        } else if ($accionprl_dato['prioridad_acc'] == "Media") { ?>
                                            <span class='badge badge-info'>Media</span>
                                        <?php                       } else if ($accionprl_dato['prioridad_acc'] == "Alta") { ?>
                                            <span class='badge badge-warning'>Alta</span>
                                        <?php                       } else if ($accionprl_dato['prioridad_acc'] == "Urgente") { ?>
                                            <span class='badge badge-danger'>Urgente</span>
                                        <?php                       }
                                        ?>
                                    </td>
                                    <td style="text-align: left"><?php echo $accionprl_dato['nombre_emp']; ?></td>

                                    <td style="text-align: left"><?php echo $accionprl_dato['nombre_cen']; ?></td>
                                    <td style="text-align: left"><?php echo $accionprl_dato['descripcion_acc']; ?></td>
                                    <td style="text-align: left"><?php echo $accionprl_dato['nombre_resp']; ?></td>
                                    <td style="text-align: left"><?php echo $accionprl_dato['accpropuesta_acc']; ?></td>
                                    <td style="text-align: left"><?php echo $accionprl_dato['fecharea_acc']; ?></td>
                                    <td style="text-align: left"><?php $accionprl_dato['estado_acc']; ?>
                                        <?php if ($accionprl_dato['estado_acc'] == "Cerrada") { ?>
                                            <span class='badge badge-success'>Cerrada</span>
                                        <?php
                                        } else if ($accionprl_dato['estado_acc'] == "En curso") { ?>
                                            <span class='badge badge-info'>En curso</span>
                                        <?php                       } else if ($accionprl_dato['estado_acc'] == "Comunicada") { ?>
                                            <span class='badge badge-secondary'>Comunicada</span>
                                        <?php                       } else if ($accionprl_dato['estado_acc'] == "Abierta") { ?>
                                            <span class='badge badge-warning'>Abierta</span>
                                        <?php                       } else if ($accionprl_dato['estado_acc'] == "Finalizada") { ?>
                                            <span class='badge badge-primary'>Finalizada</span>
                                        <?php                       }
                                        ?>
                                    </td>
                                    <td style="text-align: left"><?php $accionprl_dato['avance_acc']; ?>
                                        <?php if ($accionprl_dato['avance_acc'] == "0%") { ?>
                                            <span class='badge badge-danger'>0%</span>
                                        <?php
                                        } else if ($accionprl_dato['avance_acc'] == "25%") { ?>
                                            <span class='badge badge-warning'>25%</span>
                                        <?php                       } else if ($accionprl_dato['avance_acc'] == "50%") { ?>
                                            <span class='badge badge-primary'>50%</span>
                                        <?php                       } else if ($accionprl_dato['avance_acc'] == "85%") { ?>
                                            <span class='badge badge-info'>85%</span>
                                        <?php                       } else if ($accionprl_dato['avance_acc'] == "100%") { ?>
                                            <span class='badge badge-success'>100%</span>
                                        <?php                       }
                                        ?>
                                    </td>
                                    <td style="text-align: left">
                                        <div class="dropdown">
                                            <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Acciones
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-dark" aria-labelledby="dropdownMenuButton">
                                                <a class="dropdown-item" href="show.php?id_accion=<?php echo $id_accion; ?>" class="btn btn-warning btn-sm" title="Accede"> <i class="bi bi-folder"></i> Ver</a></a>
                                                <a class="dropdown-item" href="../../app/controllers/actividad/delete_accion.php?id_accion=<?php echo $id_accion; ?>" class="btn btn-danger btn-sm btn-font-size" onclick="return confirm('¿Realmente desea eliminar la evalucion PRL?')" title="Eliminar Evaluacion PRL"><i class="bi bi-trash-fill"></i> Eliminar</a>
                                                <a class="dropdown-item" href="reporte.php?id_accion=<?php echo $id_accion; ?>" target="_blank"><i class="bi bi-printer"></i> Imprimir</a>
                                            </div>
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
    </div>
</div>

<?php
include('../../admin/layout/parte2.php');
include('../../admin/layout/mensaje.php');
?>



<script>
    $(function() {
        // Configuración de DataTables con filtros por columna
        var table = $("#example1").DataTable({
            "pageLength": 5,
            "order": [
                [1, 'desc'],
                [0, 'desc']
            ],
            "language": {
                "emptyTable": "No hay información",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ Acciones PRL",
                "infoEmpty": "Mostrando 0 a 0 de 0 acciones PRL",
                "infoFiltered": "(Filtrado de MAX total Usuarios)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_ Acciones",
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
            // Inicializamos los filtros por columna
            initComplete: function() {
                // Aplicar búsqueda por columna
                this.api().columns().every(function(index) {
                    var column = this;
                    var input = $('tfoot th:eq(' + index + ') input, tfoot th:eq(' + index + ') select');

                    // No configuramos el filtro para la columna de acciones
                    if (index === 10) return;

                    input.on('keyup change', function() {
                        column
                            .search($(this).val())
                            .draw();
                    });
                });
            },
            buttons: [{
                    extend: "collection",
                    text: "Reportes",
                    buttons: [{
                            text: "Copiar",
                            extend: "copy"
                        },
                        {
                            extend: "pdf",
                            orientation: "landscape",
                            pageSize: "A4",
                            title: "ACCIONES PREVENTIVAS - CORRECTORAS"
                        },
                        {
                            extend: "csv"
                        },
                        {
                            extend: "excel"
                        },
                        {
                            text: "Imprimir",
                            extend: "print",
                            orientation: "landscape",
                            pageSize: "A4"
                        }
                    ]
                },
                {
                    extend: "colvis",
                    text: "Visor de columnas",
                    orientation: "landscape"
                }
            ],
        }).buttons().container().appendTo("#example1_wrapper .col-md-6:eq(0)");

        // Estilos para los filtros
        $("#example1 tfoot th").each(function() {
            $(this).css('padding', '10px 5px');
        });

        $("#example1 tfoot input").css({
            'width': '100%',
            'font-size': '12px',
            'border': '4px solid #ddd',
            'border-radius': '4px',
            'padding': '5px'
        });

        $("#example1 tfoot select").css({
            'width': '100%',
            'font-size': '12px',
            'border': '4px solid #ddd',
            'border-radius': '4px',
            'padding': '5px'
        });
    });
</script>