<?php
include('../../app/config.php');
include('../../admin/layout/parte1.php');
include('../../app/controllers/formaciones/listado_formaciones.php');
include('../../app/controllers/maestros/responsables/listado_responsables.php');
include('../../app/controllers/pruebas/listado_trabajadores.php');
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
                <h5 class="m-0"><b>Nueva Formación</b></h5>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                    <li class="breadcrumb-item active">Nueva formación</li>
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
                    <?php
                    $contador_formaciones = 0;
                    foreach ($formaciones_datos as $formaciones_dato) {
                        $contador_formaciones = $contador_formaciones + 1;
                    }
                    ?>
                    <h3 class="card-title"><i class="fa fa-book"></i> Formación Nro. <input type="text" value="<?php echo $contador_formaciones + 1 ?>" style="text-align: center;" disabled></h3>
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
                                <select name="tipo_fr" id="tipo_fr" class="form-control">
                                    <?php
                                    foreach ($tipoformaciones_datos as $tipoformaciones_dato) { ?>
                                        <option value="<?php echo $tipoformaciones_dato['id_tipoformacion']; ?>"><?php echo $tipoformaciones_dato['nombre_tf']; ?></option>
                                    <?php
                                    }
                                    ?>

                                </select>

                            </div>

                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="">Fecha Formacion</label>
                                <input type="date" name="fecha_fr" id="fecha_fr" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="">Valido hasta</label>
                                <input type="date" name="fechacad_fr" id="fechacad_fr" class="form-control">
                            </div>

                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Formador</label>
                                <select name="formador_fr" id="formador_fr" class="form-control">
                                    <?php
                                    foreach ($responsables_datos as $responsables_dato) { ?>
                                        <option value="<?php echo $responsables_dato['id_responsable']; ?>"><?php echo $responsables_dato['nombre_resp']; ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                    </div> <br><br>

                    <!-- modal para visualizar datos de los trabajadores -->
                    <div class="modal-body" style="display: block;">
                        <div style="display: flex">
                            <h5>Trabajadores asistentes: </h5>
                            <div style="width: 20px"></div>
                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-buscar_trabajador"> <i class="fa fa-search"></i> Seleccione trabajador</button>



                            <div class="modal fade" id="modal-buscar_trabajador">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header" style="background-color: #1d36b6;color: white">
                                            <h4 class="modal-title">Busqueda del trabajador</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close;">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">

                                            <div class="table table-responsive">
                                                <table id="example1" class="table table-bordered table-stripped table-sm">
                                                    <thead>
                                                        <tr>
                                                            <th>Seleccionar</th>
                                                            <th>Nro.</th>
                                                            <th>DNI</th>
                                                            <th>Nombre</th>
                                                            <th>Categoria</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $contador = 0;

                                                        foreach ($trabajadores as $trabajador) {
                                                            $id_trabajador = $trabajador['id_trabajador']; ?>
                                                            <tr>
                                                                <?php $contador = $contador + 1; ?>
                                                                <td>
                                                                    <button class="btn btn-primary btn-sm" id="btn_seleccionar<?php echo $id_trabajador ?>"> Seleccionar</button>
                                                                    <script>
                                                                        $('#btn_seleccionar<?php echo $id_trabajador ?>').click(function() {


                                                                            var id_trabajador = "<?php echo $id_trabajador; ?>";
                                                                            $('#id_trabajador').val(id_trabajador);

                                                                            var dni_tr = "<?php echo $trabajador['dni_tr'] ?>";
                                                                            $('#dni_tr').val(dni_tr);

                                                                            var nombre_tr = "<?php echo $trabajador['nombre_tr'] ?>";
                                                                            $('#nombre_tr').val(nombre_tr);

                                                                            var categoria_tr = "<?php echo $trabajador['nombre_cat'] ?>";
                                                                            $('#nombre_cat').val(categoria_tr);

                                                                            //$('#modal-buscar_trabajador').modal('toggle')
                                                                        })
                                                                    </script>
                                                                </td>
                                                                <td><?php echo $trabajador['codigo_tr'] ?></td>
                                                                <td><?php echo $trabajador['dni_tr'] ?></td>
                                                                <td><?php echo $trabajador['nombre_tr'] ?></td>
                                                                <td><?php echo $trabajador['nombre_cat'] ?></td>
                                                            </tr>

                                                        <?php
                                                        }
                                                        ?>
                                                    </tbody>
                                                    </tfoot>
                                                </table>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <input type="text" id="id_trabajador" hidden>
                                                            <label for="">Trabajador</label>
                                                            <input type="text" id="nombre_tr" class="form-control" disabled>
                                                        </div>

                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="">DNI</label>
                                                            <input type="text" id="dni_tr" class="form-control" disabled>
                                                        </div>

                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="">Categoria</label>
                                                            <input type="text" id="nombre_cat" class="form-control" disabled>
                                                        </div>

                                                    </div>

                                                </div>
                                                <button class="btn btn-success" id="btn_insertar_trabajador">Insertar</button>
                                                <div id="respuesta_insertar_trabajador"></div>
                                                <script>
                                                    $('#btn_insertar_trabajador').click(function() {
                                                        var nroformacion = '<?php echo $contador_formaciones + 1; ?>';
                                                        var id_trabajador = $('#id_trabajador').val();

                                                        if (id_trabajador == "") {
                                                            alert("Selecciona un trabajador")
                                                        } else {
                                                            var url = "../../app/controllers/formaciones/insertar_trabajador.php"
                                                            $.get(url, {
                                                                nroformacion: nroformacion,
                                                                id_trabajador: id_trabajador
                                                            }, function(datos) {
                                                                $('#respuesta_insertar_trabajador').html(datos);
                                                            });

                                                        }
                                                    });
                                                </script>
                                                <br><br>



                                            </div>


                                        </div>

                                    </div>
                                </div>
                            </div>

                        </div>

                    </div><br>
                    <!-- modal content-->
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
                                $contador_formaciones = $contador_formaciones + 1;
                                $sql_formasistencia = "SELECT *, tr.codigo_tr as codigo_tr FROM form_asistencia AS fas 
                                INNER JOIN trabajadores AS tr ON fas.idtrabajador_fas = tr.id_trabajador 
                                INNER JOIN categorias as cat ON tr.categoria_tr = cat.id_categoria WHERE nroformacion = '$contador_formaciones' ORDER BY tr.nombre_tr ASC";
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
                                                    <input type="text" name="id_formasistencia" value="<?php echo $id_formasistencia ?>" hidden>
                                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Borrar</button>

                                                </form>
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
                                <button class="btn btn-primary btn-block" id="btn_guardar_formacion">Guardar Formación</button>
                                <div id="respuesta_registro_formacion"></div>
                                <script>
                                    $('#btn_guardar_formacion').click(function() {
                                        var nroformacion = '<?php echo $contador_formaciones ?>';
                                        var tipo_fr = $('#tipo_fr').val();
                                        var fecha_fr = $('#fecha_fr').val();
                                        var fechacad_fr = $('#fechacad_fr').val();
                                        var formador_fr = $('#formador_fr').val();

                                   
                                        if (fecha_fr == "") {
                                            alert("debe indicar la fecha de formacion");

                                        } else {
                                            var url = "../../app/controllers/formaciones/registrar_formacion.php";
                                            $.get(url, {nroformacion:nroformacion, tipo_fr:tipo_fr, fecha_fr:fecha_fr, fechacad_fr:fechacad_fr, formador_fr:formador_fr}, function(datos) {
                                                $('#respuesta_registro_formacion').html(datos);
                                            })

                                        }

                                    });
                                </script>

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