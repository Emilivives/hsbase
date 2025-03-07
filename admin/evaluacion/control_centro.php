<?php
include('../../app/config.php');

$id_centro = $_GET['id_centro'];

include('../../admin/layout/parte1.php');
include('../../app/controllers/maestros/centros/listado_centros.php');
include('../../app/controllers/maestros/evaluacion/listado_tipoevaluacion.php');
include('../../app/controllers/formaciones/tipoformacion/listado_tipoformaciones.php');
include('../../app/controllers/evaluacion/listado_control_centro.php');

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
                <h5 class="m-0"><b>Registro de evaluaciones: <?php echo $centro ?> / <?php echo $empresa ?> </b></h5>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="../index.php">Inicio</a></li>
                    <li class="breadcrumb-item active">Control registros</li>
                </ol>
            </div><!-- /.col -->

        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>

<style>
    .form-check-input {
        width: 70px;
        /* Hacer el switch más largo */
        height: 20px;
        /* Aumentar la altura */
        cursor: pointer;
        position: relative;
    }

    .form-check-input:checked {
        background-color: red;
        border-color: red;
    }

    .form-check-label {
        font-size: 1.25em;
        /* Aumentar el tamaño del texto */
    }

    .resaltado-rojo {
        background-color: red;
        font-weight: bold;
        color: white;
    }

    .resaltado-amarillo {
        background-color: yellow;
        font-weight: bold;
        color: black;
    }

    .resaltado-azul {
        background-color: blue;
        font-weight: bold;
        color: white;
    }
</style>


</html>

<div class="row">






    <!-- ./col -->
 
</div>
<!-- /.content-header -->


<div class="col-md-12">
    <div class="card card-outline card-primary">
        <div class="card-header col-md-12">
            <h3 class="card-title"><b>registros Realizadas</b></h3>
            <style>
                .btn-text-right {
                    text-align: right;
                }
            </style>
            <!-- Button trigger modal -->
            <div class="btn-text-right">
                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-nuevocontrol">Añadir control</button>
            </div>
            <!-- Modal -->
            <div class="modal fade" id="modal-nuevocontrol">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header" style="background-color:#0080ff ;color:white">
                            <h5 class="modal-title" id="modal-nuevocontrol">EVALUACION REALIZADA</h5>
                            <button type="button" class="close" style="color: white;" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="../../app/controllers/evaluacion/create_control.php" method="post" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label for="">Centro Trabajo</label>
                                            <select name="centro_cev" class="form-control">
                                                <?php foreach ($centros_datos as $centros_dato) : ?>
                                                    <option value="<?php echo htmlspecialchars($centros_dato['id_centro']); ?>">
                                                        <?php echo htmlspecialchars($centros_dato['nombre_cen']); ?> - <?php echo htmlspecialchars($centros_dato['nombre_emp']); ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label for="">Tipo evaluación</label>
                                            <select name="tipoevaluacion_cev" class="form-control">
                                                <?php foreach ($tipoevaluacion_datos as $tipoevaluacion_dato) : ?>
                                                    <option value="<?php echo htmlspecialchars($tipoevaluacion_dato['id_tipoevaluacion']); ?>">
                                                        <?php echo htmlspecialchars($tipoevaluacion_dato['tipoevaluacion_tev']); ?> - <?php echo htmlspecialchars($tipoevaluacion_dato['especialidad_tev']); ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2"></div>
                                    <input type="hidden" name="noaplica_cev" value="NULL">
                                    <div class="col-md-4">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" name="noaplica_cev" id="flexSwitchCheckDefault" value="NA">
                                            <label class="form-check-label" for="flexSwitchCheckDefault">No Aplica</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group row">
                                        <div class="col-sm-4">
                                            <label for="fecha_cev" class="col-form-label col-sm-4">Fecha doc.:</label>
                                            <input type="date" id="fecha_cev" name="fecha_cev" class="form-control" tabindex="1">
                                        </div>
                                        <div class="col-sm-4">
                                            <label for="fechacad_cev" class="col-form-label col-sm-4">Fecha cad.:</label>
                                            <input type="date" id="fechacad_cev" name="fechacad_cev" class="form-control" tabindex="1">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group row">
                                            <label for="anotaciones_cev" class="col-form-label col-sm-2">Anotaciones</label>
                                            <div class="col-sm-12">
                                                <textarea class="form-control" name="anotaciones_cev" rows="3"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                    <button type="submit" class="btn btn-primary"><i class="bi bi-floppy"></i> Guardar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <table id="example2" class="table table-striped table-bordered table-hover">
                        <colgroup>
                            <col width="5%">
                            <col width="20%">
                            <col width="10%">
                            <col width="10%">
                            <col width="10%">
                            <col width="35%">
                            <col width="10%">
                        </colgroup>
                        <thead>
                            <tr>
                                <th style="text-align: center">N.</th>
                                <th style="text-align: center">Evaluacion</th>
                                <th style="text-align: center">Fecha</th>
                                <th style="text-align: center">Fecha Cad.</th>
                                <th style="text-align: center">N/A</th>
                                <th style="text-align: center">Anotaciones</th>
                                <th style="text-align: center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $contador = 0;
                            foreach ($control_evaluaciones_centro as $control_evaluaciones) {
                                $contador = $contador + 1;
                            ?>

                                <tr>
                                    <td style="text-align: center"><?php echo $contador ?></td>
                                    <td style="text-align: center"><?php echo $control_evaluaciones['tipoevaluacion_tev']; ?></td>
                                    <td><?php echo $control_evaluaciones['fecha_cev']; ?></td>
                                    <td><?php echo $control_evaluaciones['fechacad_cev']; ?></td>
                                    <td><?php echo $control_evaluaciones['noaplica_cev']; ?></td>
                                    <td><?php echo $control_evaluaciones['anotaciones_cev']; ?></td>
                                  
                                    </td>
                                    <td style="text-align: center;"> <a href="../../admin/trabajadores/trabajadorshow.php?id_trabajador=<?php echo $id_trabajador; ?>" class="btn btn-primary btn-sm" title="Ver detalles"><i class="bi bi-folder-fill"></i> Ver</a>
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

<!-- JavaScript para manejar el checkbox -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const checkbox = document.getElementById('flexSwitchCheckDefault');
        const fechaDoc = document.getElementById('fecha_cev');
        const fechaCad = document.getElementById('fechacad_cev');

        checkbox.addEventListener('change', function() {
            if (checkbox.checked) {
                fechaDoc.value = '';
                fechaCad.value = '';
                fechaDoc.disabled = true;
                fechaCad.disabled = true;
            } else {
                fechaDoc.disabled = false;
                fechaCad.disabled = false;
            }
        });
    });
</script>


<script>
    $(function() {
        $("#example1").DataTable({
            "pageLength": 20,
            "language": {
                "emptyTable": "No hay información",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ registros",
                "infoEmpty": "Mostrando 0 a 0 de 0 registros",
                "infoFiltered": "(Filtrado de MAX total registros)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_ registros",
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