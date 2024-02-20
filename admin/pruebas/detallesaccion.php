<?php
include('../../app/config.php');
include('../../admin/layout/parte1.php');
$id_accion = $_GET['id_accion'];
include('../../app/controllers/actividad/datos_accionprl.php');
include('../../app/controllers/trabajadores/listado_trabajadores.php');
include('../../app/controllers/maestros/responsables/listado_responsables.php');
include('../../app/controllers/maestros/centros/listado_centros.php');
?>
<html>
<!-- Font Awesome -->
<link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
<!-- Ionicons -->
<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h5 class="m-0"><b>Detalles Accion Preventiva / Correctora ||<?php echo $id_accion ?></b></h5>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                    <li class="breadcrumb-item active">Detalles Accion PRL</li>
                </ol>
            </div><!-- /.col -->
            <hr>
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>


</html>

<!-- /.content- -->
<div class="content">
    <form action="../../app/controllers/actividad/update_accion.php" method="post">
        <div class="row">
            <div class="col-md-12">
           

                <div class="col-sm-12">
                    <div class="form-group row">
                        <label for="nombre" class="col-form-label col-sm-1">Accion Nº:</label>
                        <div class="col-sm-1">
                            <input type="text" class="form-control" name="codigo_acc" id="" value="<?php echo $codigo_acc ?>" placeholder="" tabindex="1">
                        </div>
                        <div class="col-sm-1"></div>
                        <label for="nombre" class="col-form-label col-sm-1">Fecha:</label>
                        <div class="col-sm-1">
                            <input type="date" name="fecha_acc" id="fecha_acc" value="<?php echo $fecha_acc ?>" class="form-control" tabindex="1">
                        </div>
                        <div class="col-sm-2"></div>
                        <label for="" class="col-form-label col-sm-1">Centro Trabajo</label>
                        <div class="col-sm-1">
                            <select name="centro_acc" id="" class="form-control">
                                <?php
                                foreach ($centros_datos as $centros_dato) {
                                    $centro_tabla = $centros_dato['nombre_cen'];
                                    $id_centro = $centros_dato['id_centro']; ?>
                                    <option value="<?php echo $id_centro; ?>" <?php if ($centro_tabla == $centro_acc) { ?> selected="selected" <?php } ?>>
                                        <?php echo  $centro_tabla; ?>
                                    </option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-sm-1"></div>
                        <label for="prioridad" class="col-form-label col-sm-1">Prioridad:</label>
                        <div class="col-sm-1">
                            <select class="form-select" name="prioridad_acc" aria-label="Default select example">
                                <option value="<?php echo $prioridad_acc ?>"><?php echo $prioridad_acc ?></option>

                                <option value="0">Selecciona lugar</option>

                                <option value="Baja">Baja (< 3 meses)</option>
                                <option value="Media">Media (< 1 meses)</option>
                                <option value="Alta">Alta (< 10 dias)</option>
                                <option value="Urgente">Urgente (< 24 - 48 hrs)</option>
                            </select>
                        </div>

                    </div>

                </div>

            </div>
            <input type="text" name="id_accion" value="<?php echo $id_accion; ?>" >

        </div>
        <br>
        <div class="card card-outline card-primary">
            <div class="card-header">

                <h3 class="card-title"><i class="fa fa-book"></i> <b>1. Descripcion</b></h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>


            <div class="card-body">
                <div class="row">

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group row">
                                <label for="descripcion_acc" class="col-form-label col-sm-2">Descripcion:</label>
                                <div class="col-sm-12">
                                    <textarea class="form-control" name="descripcion_acc" value="" rows="3"><?php echo $descripcion_acc ?></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group row">
                            <label for="origen_acc" class="col-form-label col-sm-2">Origen:</label>
                            <div class="col-sm-10">
                                <select class="form-select" name="origen_acc" aria-label="Default select example">
                                    <option value="<?php echo $origen_acc ?>"><?php echo $origen_acc ?></option>

                                    <option value="0">Seleccione</option>

                                    <option value="Evaluacion de riesgos">Evaluacion de riesgos</option>
                                    <option value="Accidente de trabajo">Accidente de trabajo</option>
                                    <option value="Propuesta de mejora">Propuesta de mejora</option>
                                    <option value="Comunicado de riesgos">Comunicado de riesgos</option>
                                    <option value="Otros">Otros</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group row">
                            <label for="detalleorigen_acc" class="col-form-label col-sm-4">Informe procedencia / detalles:</label>
                            <div class="col-sm-8">
                                <input type="text" name="detalleorigen_acc" id="" class="form-control" value="<?php echo $detalleorigen_acc ?>">
                            </div>
                        </div>
                    </div>






                </div>
            </div>

        </div>

        <div class="card card-outline card-primary">
            <div class="card-header">

                <h3 class="card-title"><i class="fa fa-book"></i> <b>2. Medidas preventivas / correctoras</b></h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>


            <div class="card-body">
                <div class="row">

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group row">
                                <label for="descripcion_acc" class="col-form-label col-sm-2">Accion Propuesta:</label>
                                <div class="col-sm-12">
                                    <textarea class="form-control" name="accpropuesta_acc" value="" rows="3"><?php echo $accpropuesta_acc ?></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group row">
                            <label for="responsable_acc" class="col-form-label col-sm-1">Responsable:</label>
                            <div class="col-sm-3">
                                <select name="responsable_acc" id="" class="form-control">
                                    <?php
                                    foreach ($responsables_datos as $responsables_dato) {
                                        $responsable_tabla = $responsables_dato['nombre_resp'];
                                        $responsable_tabla2 = $responsables_dato['cargo_resp'];
                                        $id_responsable = $responsables_dato['id_responsable']; ?>
                                        <option value="<?php echo $id_responsable; ?>" <?php if ($responsable_tabla == $responsable_acc) { ?> selected="selected" <?php } ?>>
                                            <?php echo  $responsable_tabla; ?> || <?php echo  $responsable_tabla2; ?>
                                        </option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group row">
                                <label for="accrealizada_acc" class="col-form-label col-sm-2">Accion Realizada:</label>
                                <div class="col-sm-12">
                                    <textarea class="form-control" name="accrealizada_acc" value="" rows="3"><?php echo $accrealizada_acc ?></textarea>
                                </div>
                            </div>
                        </div>
                    </div>






                </div>
            </div>

        </div>

        <div class="card card-outline card-primary">
            <div class="card-header">

                <h3 class="card-title"><i class="fa fa-book"></i> <b>3. Seguimiento / fechas</b></h3>
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
                            <div class="col-sm-9">
                                <label for="fechaprevista_acc" class="col-form-label col-sm-10">Fecha cierre prevista:</label>

                                <input type="date" name="fechaprevista_acc" id="fechaprevista_acc" value="<?php echo $fecha_acc ?>" class="form-control" tabindex="1">
                            </div>
                        </div>
                    </div>



                    <div class="col-sm-2">
                        <div class="form-group row">
                            <div class="col-sm-9">
                                <label for="fecharea_acc" class="col-form-label col-sm-10">Fecha cierre real:</label>

                                <input type="date" name="fecharea_acc" id="fecharea_acc" value="<?php echo $fecharea_acc ?>" class="form-control" tabindex="1">
                            </div>
                        </div>
                    </div>


                    <div class="col-sm-2">
                        <div class="form-group row">
                            <div class="col-sm-9">
                                <label for="fechaveri_acc" class="col-form-label col-sm-10">Fecha verificación:</label>

                                <input type="date" name="fechaveri_acc" id="fechaveri_acc" value="<?php echo $fechaveri_acc ?>" class="form-control" tabindex="1">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-2">

                    </div>
                    <div class="col-sm-2">
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <label for="recursos_acc" class="col-form-label col-sm-10">Recursos económicos (Eur):</label>
                                <div class="col-sm-5">
                                    <input type="text" name="recursos_acc" id="recursos_acc" value="<?php echo $recursos_acc ?>" class="form-control" tabindex="1">
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-7">
                        <div class="form-group row">
                            <label for="seguimiento_acc" class="col-form-label col-sm-2">Seguimiento acción: (fecha y detalles)</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" name="seguimiento_acc" value="" rows="4"><?php echo $seguimiento_acc ?></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-2">
                        <div class="form-group row">
                            <label for="avance_acc" class="col-form-label col-sm-3">Avance:</label>
                            <div class="col-sm-6">
                                <select class="form-select" name="avance_acc" aria-label="Default select example">
                                    <option value="<?php echo $avance_acc ?>"><?php echo $avance_acc ?></option>

                                    <option value="0">-</option>

                                    <option value="0%">0%</option>
                                    <option value="25%">25%</option>
                                    <option value="50%">50%</option>
                                    <option value="85%">85%</option>
                                    <option value="100%">100%</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group row">
                            <label for="estado_acc" class="col-form-label col-sm-3">Estado:</label>
                            <div class="col-sm-7">
                                <select class="form-select" name="estado_acc" aria-label="Default select example">
                                    <option value="<?php echo $estado_acc ?>"><?php echo $estado_acc ?></option>

                                    <option value="0">-</option>

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



            </div>
        </div>

        <div class="card card-outline card-primary">
            <div class="card-header">

                <h3 class="card-title"><i class="fa fa-book"></i> <b>4. Comentarios e imagenes</b></h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>


            <div class="card-body">

                <div class="row">



                </div>



            </div>
        </div>


        <div class="row">
            <div class="col-md-6">
                <a href="" class="btn btn-secondary">Cancelar</a>
                <input type="submit" class="btn btn-warning" value="Guardar Cambios">
                <a href="" class="btn btn-success">Imprimir</a>
            </div>
        </div>
        <br>

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