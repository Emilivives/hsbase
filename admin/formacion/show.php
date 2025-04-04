<?php
$id_formacion_get = $_GET['id_formacion'];
include('../../app/config.php');
include('../../admin/layout/parte1.php');
include('../../app/controllers/formaciones/cargar_formacion.php');
include('../../app/controllers/maestros/responsables/listado_responsables.php');
include('../../app/controllers/trabajadores/listado_trabajadores_alfabet.php');
include('../../app/controllers/formaciones/tipoformacion/listado_tipoformaciones.php');
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
                <h5 class="m-0"><b>Detalles Formación </b></h5>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="../index.php">Inicio</a></li>
                    <li class="breadcrumb-item"><a href="../formacion/index.php">Formaciones</a></li>
                    <li class="breadcrumb-item active">Detalles formación</li>
                </ol>
            </div><!-- /.col -->
            <hr>
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>


</html>

<!-- /.content- -->
<div class="content">

    <div class="row">
        <div class="col-md-7">

            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title"><i class="fa fa-book"></i> Formación Nro. <input type="text" value="<?php echo $nroformacion ?>" style="text-align: center;" disabled></h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row">

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Tipo de Formación</label>
                                <select name="tipo_fr" id="" class="form-control">
                                    <option value="0">--Seleccione Tipo--</option>
                                    <?php
                                    foreach ($tipoformaciones_datos as $tipoformaciones_dato) {
                                        $tipoformaciones_dato_tabla = $tipoformaciones_dato['nombre_tf'];
                                        $id_tipoformacion = $tipoformaciones_dato['id_tipoformacion'];

                                    ?>
                                        <option value="<?php echo $id_tipoformacion ?>" <?php if ($tipoformaciones_dato_tabla == $tipo_fr) { ?> selected="selected" <?php } ?> nombre_tf="<?php echo $tipoformaciones_dato['nombre_tf']; ?>">
                                            <?php echo $tipoformaciones_dato_tabla ?>
                                        <?php
                                    }
                                        ?>

                                </select>


                            </div>

                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="">Fecha Formacion</label>
                                <input type="date" name="fecha_fr" value=<?php echo $fecha_fr ?> class="form-control">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="">Valido hasta</label>
                                <input type="date" name="fechacad_fr" value=<?php echo $fechacad_fr ?> class="form-control">
                            </div>

                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Formador</label>
                                <select name="formador_fr" id="" class="form-control">
                                    <option value="0">--Seleccione Responsable--</option>
                                    <?php
                                    foreach ($responsables_datos as $responsables_dato) {
                                        $responsables_dato_tabla = $responsables_dato['nombre_resp'];
                                        $id_responsable = $responsables_dato['id_responsable'];
                                    ?>
                                        <option value="<?php echo $id_responsable ?>" <?php if ($responsables_dato_tabla == $formador_fr) { ?> selected="selected" <?php } ?> nombre_resp="<?php echo $responsables_dato['nombre_resp']; ?>">
                                            <?php echo $responsables_dato_tabla ?>

                                        <?php
                                    }
                                        ?>
                                </select>

                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="">ANOTACIONES</label>
                                <input type="text" name="detalle_fr" value="<?php echo htmlspecialchars($detalle_fr, ENT_QUOTES, 'UTF-8'); ?>" class="form-control">
                            </div>
                        </div>
                    </div> <br>


                    <label for="">ASISTENTES: </label>
                    <div class="table-responsive">
                        <table class="table table-bordered table-sm table-hover table-stripped">
                            <thead>
                                <tr>
                                    <th style="background-color:darkgray; text-align:center">Nro</th>
                                    <th style="background-color:darkgray; text-align:center">Codigo</th>
                                    <th style="background-color:darkgray; text-align:center">Nombre</th>
                                    <th style="background-color:darkgray; text-align:center">DNI</th>
                                    <th style="background-color:darkgray; text-align:center">Categoria</th>
                                    <th style="background-color:darkgray; text-align:center">Acción</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                $contador_formasistencia = 0;

                                $sql_formasistencia = "SELECT *, tr.codigo_tr as codigo_tr FROM form_asistencia AS fas 
                                INNER JOIN trabajadores AS tr ON fas.idtrabajador_fas = tr.id_trabajador 
                                INNER JOIN categorias as cat ON tr.categoria_tr = cat.id_categoria WHERE nroformacion = '$nroformacion' ORDER BY tr.nombre_tr ASC";
                                $query_formasistencia = $pdo->prepare($sql_formasistencia);
                                $query_formasistencia->execute();
                                $formasistencia_datos = $query_formasistencia->fetchAll(PDO::FETCH_ASSOC);

                                foreach ($formasistencia_datos as $formasistencia_dato) {
                                    $id_formasistencia = $formasistencia_dato['id_formasistencia'];
                                    $contador_formasistencia = $contador_formasistencia + 1;

                                ?>
                                    <tr>
                                        <td>
                                            <center> <?php echo $contador_formasistencia; ?></center>
                                        </td>
                                        <td>
                                            <center><?php echo $formasistencia_dato['codigo_tr'] ?><center>
                                        </td>
                                        <td><?php echo $formasistencia_dato['nombre_tr'] ?></td>
                                        <td>
                                            <center><?php echo $formasistencia_dato['dni_tr'] ?><center>
                                        </td>
                                        <td>
                                            <center><?php echo $formasistencia_dato['nombre_cat'] ?><center>
                                        </td>
                                        <td>
                                            <center>

                                                <form action="../../app/controllers/formaciones/borrar_trabajadorformacion.php" method="POST">
                                                    <input type="hidden" name="id_formasistencia" value="<?php echo $id_formasistencia; ?>">
                                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Borrar</button>
                                                </form>

                                                <a href="../maestros/documentos/pdf_titulo_formacion.php?id_formacion=<?php echo $id_formacion; ?>&id_trabajador=<?php echo $formasistencia_dato['id_trabajador'] ?>" class="btn btn-warning btn-sm" title="Generar titulo" target="_blank"><i class="fa-regular fa-file-lines"></i> Titulo</a>

                                            </center>
                                        </td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>

                        </table>
                        <div class="col-md-12">
                            <div class="form-group">
                                <button class="btn btn-primary btn-block" id="btn_guardar_formacion" onclick="return confirm('Realmente desea actualizar la formación?')">Guardar Formación</button>
                                <div id="respuesta_registro_formacion"></div>
                                <script>
                                    $('#btn_guardar_formacion').click(function(e) {
                                        e.preventDefault();

                                        var nroformacion = '<?php echo $nroformacion ?>';
                                        var tipo_fr = $('select[name="tipo_fr"]').val();
                                        var fecha_fr = $('input[name="fecha_fr"]').val();
                                        var fechacad_fr = $('input[name="fechacad_fr"]').val();
                                        var formador_fr = $('select[name="formador_fr"]').val();
                                        var detalle_fr = $('input[name="detalle_fr"]').val();

                                        // Validation
                                        if (!fecha_fr) {
                                            alert("Debe indicar la fecha de formación");
                                            return false;
                                        }
                                        if (!nroformacion) {
                                            alert("Debe indicar el número de formación");
                                            return false;
                                        }

                                        // Show loading state
                                        $('#respuesta_registro_formacion').html('<div class="alert alert-info">Procesando...</div>');

                                        // Send AJAX request
                                        $.ajax({
                                            url: "../../app/controllers/formaciones/actualizar_formacion.php",
                                            type: "POST",
                                            data: {
                                                nroformacion: nroformacion,
                                                tipo_fr: tipo_fr,
                                                fecha_fr: fecha_fr,
                                                fechacad_fr: fechacad_fr,
                                                formador_fr: formador_fr,
                                                detalle_fr: detalle_fr,
                                            },
                                            success: function(response) {
                                                // Primero intentamos parsear la respuesta como JSON
                                                try {
                                                    // Si es una cadena, intentamos convertirla a objeto
                                                    if (typeof response === 'string') {
                                                        response = JSON.parse(response);
                                                    }

                                                    // Mostramos el mensaje de éxito
                                                    $('#respuesta_registro_formacion').html(
                                                        '<div class="alert alert-success">' + response.message + '</div>'
                                                    );

                                                    // Actualizamos los valores en el formulario
                                                    if (response.data) {
                                                        $('select[name="tipo_fr"]').val(response.data.tipo_fr);
                                                        $('input[name="fecha_fr"]').val(response.data.fecha_fr);
                                                        $('input[name="fechacad_fr"]').val(response.data.fechacad_fr);
                                                        $('select[name="formador_fr"]').val(response.data.formador_fr);
                                                        $('input[name="detalle_fr"]').val(response.data.detalle_fr);
                                                    }

                                                    // Recargamos la página después de 1.5 segundos
                                                    setTimeout(function() {
                                                        location.reload();
                                                    }, 1500);

                                                } catch (e) {
                                                    // Si hay un error al parsear el JSON, asumimos que la actualización fue exitosa
                                                    $('#respuesta_registro_formacion').html(
                                                        '<div class="alert alert-success">Formación actualizada correctamente</div>'
                                                    );
                                                    // Recargamos la página después de 1.5 segundos
                                                    setTimeout(function() {
                                                        location.reload();
                                                    }, 1500);
                                                }
                                            },
                                            error: function(xhr, status, error) {
                                                $('#respuesta_registro_formacion').html(
                                                    '<div class="alert alert-danger">Error: ' + error + '</div>'
                                                );
                                            }
                                        });
                                    });
                                </script>


                            </div>
                        </div>

                    </div>


                </div>

            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <a href="reporte.php?id_formacion=<?php echo $id_formacion; ?>" class="btn btn-warning" title="Generar reporte" target="_blank"><i class="fa-regular fa-file-lines"></i> Imprimir</a>
                </div>
            </div>
        </div>

        <div class="col-md-5">

            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title"><i class="fa fa-book"></i> Contenido Formación</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Formacion: <?php echo $tipo_fr ?></label>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group row">

                            <div class="col-sm-12">
                                <textarea class="form-control" disabled name="detalles_tf" value="" rows="20"><?php echo $detalles_fr ?></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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