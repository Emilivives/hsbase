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
$id_accion = $_GET['id_accion'];
include('../../app/controllers/actividad/datos_accionprl.php');
include('../../app/controllers/trabajadores/listado_trabajadores.php');
include('../../app/controllers/maestros/responsables/listado_responsables.php');
include('../../app/controllers/maestros/centros/listado_centros.php');



?>
<html>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
	<style>
        .btn-small {
            font-size: 0.8rem; /* Tamaño de fuente más pequeño */
            padding: 0.2rem 0.4rem; /* Tamaño de relleno más pequeño */
            border-radius: 0.2rem; /* Radio de borde pequeño */
            line-height: 1; /* Ajustar la altura de línea para un tamaño de botón más pequeño */
        }
    </style>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h5 class="m-0"><b>Accion preventiva / correctora</b></h5>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                    <li class="breadcrumb-item active">Accion preventiva / correctora</li>
                </ol>
            </div><!-- /.col -->
            <hr>
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>


</html>
<div class="col-md-12">
    <a href="reporte.php?id_accion=<?php echo $id_accion; ?>" class="btn btn-warning" title="Generar reporte" target="_blank"><i class="fa-regular fa-file-lines"></i> Imprimir</a>
</div>
<!-- /.content- -->
<div class="content">
    <form action="../../app/controllers/actividad/update_accion.php" method="post" enctype="multipart/form-data">

        <input type="text" name="id_accion" value="<?php echo $id_accion; ?>" hidden>

        <div class="well">
            <div class="row">

                <div class="col-sm-3">
                    <div class="form-group row">
                        <label for="nombre" class="col-form-label col-sm-3">Accion Nº:</label>
                        <div class="col-sm-5">
                            <input type="text" name="codigo_acc" id="codigo_acc" value="<?php echo $codigo_acc ?>" class="form-control" placeholder="nro. accdidente" tabindex="1">
                        </div>
                    </div>
                </div>


                <div class="col-sm-3">
                    <div class="form-group row">
                        <label for="nombre" class="col-form-label col-sm-2">Fecha:</label>
                        <div class="col-sm-5">
                            <input type="date" name="fecha_acc" id="fecha_acc" value="<?php echo $fecha_acc ?>" class="form-control" tabindex="1" onchange="copiar()">
                        </div>
                    </div>

                </div>


                <div class="col-sm-3">
                    <div class="form-group row">
                        <label for="centro" class="col-form-label col-sm-2">Centro:*</label>
                        <div class="col-sm-7">
                            <select name="centro_acc" id="" class="form-control" required>
                                <option value="0">--Seleccione centro--</option>
                                <?php
                                foreach ($centros_datos as $centros_dato) {
                                    $centros_dato_tabla = $centros_dato['nombre_cen'];
                                    $id_centro = $centros_dato['id_centro'];

                                ?>
                                    <option value="<?php echo $id_centro ?>" <?php if ($centros_dato_tabla == $centro_acc) { ?> selected="selected" <?php } ?> nombre_cen="<?php echo $centros_dato['nombre_cen']; ?>">
                                        <?php echo $centros_dato_tabla; ?> </option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>

                    </div>

                </div>

                <div class="col-sm-3">
                    <div class="form-group row">
                        <label for="prioridad" class="col-form-label col-sm-3">Prioridad:</label>
                        <div class="col-sm-6">
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



                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title"><i class="bi bi-person-fill" style="text-align: left;"></i> 1. Detalles / Descripción</h3>
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
                        <h3 class="card-title"><i class="fa fa-book" style="text-align: left;"></i> 2. Medidas preventivas / correctoras</h3>
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
                            <div class="col-sm-12">
                                <div class="form-group row">
                                    <label for="accpropuesta_acc" class="col-form-label col-sm-2">Accion propuesta:</label>
                                    <div class="col-sm-12">
                                        <textarea class="form-control" name="accpropuesta_acc" value="" rows="2"><?php echo $accpropuesta_acc ?></textarea>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-5">
                                <div class="form-group">
                                    <label for="" class="col-form-label col-sm-2">Responsable:</label>
                                    <div class="col-sm-9">
                                        <select name="responsable_acc" id="" class="form-control" required>
                                            <?php
                                            foreach ($responsables_datos as $responsable_dato) {
                                                $responsable_tabla = $responsable_dato['nombre_resp'];
                                                $id_responsable = $responsable_dato['id_responsable']; ?>
                                                <option value="<?php echo $id_responsable; ?>" <?php if ($responsable_tabla == $responsable_acc) { ?> selected="selected" <?php } ?> nombre_resp="<?php echo $responsable_dato['nombre_resp']; ?>">
                                                    <?php echo  $responsable_tabla; ?>
                                                </option>
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
                                    <label for="accrealizada_acc" class="col-form-label col-sm-2">Acción realizada:</label>
                                    <div class="col-sm-12">
                                        <textarea class="form-control" name="accrealizada_acc" value="" rows="2"><?php echo $accrealizada_acc ?></textarea>
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
                        <h3 class="card-title"><i class="bi bi-geo-alt-fill" style="text-align: left;"></i> 3. Seguimiento</h3>
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
                                    <div class="col-sm-9">
                                        <label for="fechaprevista_acc" class="col-form-label col-sm-10">Fecha cierre prevista:</label>

                                        <input type="date" name="fechaprevista_acc" id="fechaprevista_acc" value="<?php echo $fecha_acc ?>" class="form-control" tabindex="1">
                                    </div>
                                </div>
                            </div>



                            <div class="col-sm-2">
                                <div class="form-group row">
                                    <div class="col-sm-9">
                                        <label for="fechaprevista_acc" class="col-form-label col-sm-10">Fecha cierre real:</label>

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
            </div>
            <div class="row">


                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title"><i class="bi bi-plus-square-fill" style="text-align: left;"></i> 4. Comentarios y imagenes</h3>
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
                                    <label for="accrealizada_acc" class="col-form-label col-sm-2">Comentarios y anotaciones:</label>
                                    <div class="col-sm-12">
                                        <textarea class="form-control" name="accrealizada_acc" value="" rows="2"><?php echo $accrealizada_acc ?></textarea>
                                    </div>

                                </div>
                            </div>

                        </div>

                        <div class="row">

                            <div class="container-fluid">
                                <div class="row mb-2">
                                    <div class="col-sm-6">
                                        <h6 class="m-0"><b>Imágenes:</b></h>
                                    </div><!-- /.col -->
                                    <hr>
                                </div><!-- /.row -->
                            </div><!-- /.container-fluid -->
                        </div>
                        <div class="row">
                            <div class="col-sm-2">
                            </div>
                          <!--  <div class="col-sm-4">
                                <div class="form-group row">
                                    <div class="col-md-8">
                                        <label for="">Imagen 1 </label>
                                        <input type="file" name="imagen1_acc" class="form-control" id="file1">
                                        <br>
                                        <output id="list1">
                                            <img src="<?php echo $URL . "/admin/accionprl/image/" . $imagen1_acc; ?>" width="100%" alt="">
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
                            </div> -->
							<div class="col-sm-4">
        <div class="form-group row">
            <div class="col-md-8">
                <label for="">Imagen 1 </label>
                <input type="file" name="imagen1_acc" class="form-control" id="file1">
				<a href="https://www.iloveimg.com/es/comprimir-imagen/comprimir-jpg" class="btn btn-outline-danger btn-small" role="button" target="_blank">
            Max. 1Mb
        </a>
                <br>
                <output id="list1">
                    <img src="<?php echo $URL . "/admin/accionprl/image/" . $imagen1_acc; ?>" width="100%" alt="">
                </output>
                <input type="hidden" name="imagen1_actual" value="<?php echo $imagen1_acc; ?>">
                <script>
                    function archivo1(evt) {
                        var files = evt.target.files; // FileList object
                        for (var i = 0, f; f = files[i]; i++) {
                            if (!f.type.match('image.*')) {
                                continue;
                            }
                            var reader = new FileReader();
                            reader.onload = (function(theFile) {
                                return function(e) {
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
                            <div class="col-sm-1">
                            </div>
							
							 <div class="col-sm-4">
        <div class="form-group row">
            <div class="col-md-8">
                <label for="">Imagen 2</label>
                <input type="file" name="imagen2_acc" class="form-control" id="file2">
				<a href="https://www.iloveimg.com/es/comprimir-imagen/comprimir-jpg" class="btn btn-outline-danger btn-small" role="button" target="_blank">
            Max. 1Mb
        </a>
                <br>
                <output id="list2">
                    <img src="<?php echo $URL . "/admin/accionprl/image/" . $imagen2_acc; ?>" width="100%" alt="">
                </output>
                <input type="hidden" name="imagen2_actual" value="<?php echo $imagen2_acc; ?>">
                <script>
                    function archivo2(evt) {
                        var files = evt.target.files; // FileList object
                        for (var i = 0, f; f = files[i]; i++) {
                            if (!f.type.match('image.*')) {
                                continue;
                            }
                            var reader = new FileReader();
                            reader.onload = (function(theFile) {
                                return function(e) {
                                    document.getElementById("list2").innerHTML = ['<img class="thumb thumbnail" src="', e.target.result, '" width="100%" title="', escape(theFile.name), '"/>'].join('');
                                };
                            })(f);
                            reader.readAsDataURL(f);
                        }
                    }
                    document.getElementById('file2').addEventListener('change', archivo2, false);
                </script>
          
							
                      <!--   <div class="col-sm-4">
                                <div class="form-group row">
                                    <div class="col-md-8">
                                        <label for="">Imagen 2 </label>
                                        <input type="file" name="imagen2_acc" class="form-control" id="file2">
                                        <br>
                                        <output id="list2">
                                            <img src="<?php echo $URL . "/admin/accionprl/image/" . $imagen2_acc; ?>" width="100%" alt="">
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
                            </div> -->
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
				  <a href="reporte.php?id_accion=<?php echo $id_accion; ?>" class="btn btn-warning" title="Generar reporte" target="_blank"><i class="fa-regular fa-file-lines"></i> Imprimir</a>
            </div>
        </div>
    </form>

</div>

</div>







<?php
include('../../admin/layout/parte2.php');
include('../../admin/layout/mensaje.php');
?>


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