<?php
include('../../app/config.php');
include('../../admin/layout/parte1.php');
include('../../app/controllers/maestros/centros/listado_centros.php');
include('../../app/controllers/maestros/evaluacion/listado_tipoevaluacion.php');
include('../../app/controllers/formaciones/listado_formaciones.php');
include('../../app/controllers/pruebas/listado_trabajadores.php');
include('../../app/controllers/formaciones/tipoformacion/listado_tipoformaciones.php');
include('../../app/controllers/evaluacion/listado_control.php');

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
                <h5 class="m-0"><b>registros Realizadas</b></h5>
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
    <div class="col-lg-2 col-6">
        <!-- small box -->
        <div class="small-box bg-light shadow-sm border">
            <div class="inner">
                <?php $fechahoraentera = strtotime($fechahora);
                $anio = date("Y", $fechahoraentera);
                $contador_de_formaciones = count(array_filter($formaciones_datos, fn ($n) => date("Y", strtotime($n['fecha_fr'])) == $anio)); ?>
                <h2><?php echo $contador_de_formaciones; ?><sup style="font-size: 20px"></h2>
                <p>Formaciones año: <?php echo $anio; ?></p>

            </div>
            <div class="icon">
                <i class="ion bi-person-arms-up"></i>
            </div>

        </div>
    </div>


    <!-- ./col -->
    <div class="col-lg-2 col-6">
        <!-- small box -->
        <div class="small-box bg-light shadow-sm border">
            <div class="inner">
                <?php
                $contador_de_trabajadores = 0;
                foreach ($trabajadores as $trabajador) {
                    if ($trabajador['activo_tr'] == 1) {
                        $contador_de_trabajadores = $contador_de_trabajadores + 1;
                    }
                }
                ?>

                <h2><?php echo $contador_de_trabajadores; ?><sup style="font-size: 20px"></h2>
                <p>Trabajadores activos</p>
            </div>
            <div class="icon">
                <i class="ion bi-person-arms-up"></i>
            </div>

        </div>
    </div>


    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-light shadow-sm border">
            <div class="inner">
                <?php
                $contador_de_trabajadores = 0;
                foreach ($trabajadores as $trabajador) {
                    if ($trabajador['activo_tr'] == 1) {
                        $contador_de_trabajadores = $contador_de_trabajadores + 1;
                    }
                }
                ?>

                <h2><?php echo $contador_de_trabajadores; ?><sup style="font-size: 20px"></h2>
                <p>Trabajadores activos</p>
            </div>
            <div class="icon">
                <i class="ion bi-person-arms-up"></i>
            </div>

        </div>
    </div>
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
    <?php
    // Agrupar evaluaciones por centro
    $evaluaciones_por_centro = [];
    foreach ($control_evaluaciones as $evaluacion) {
        $centro = $evaluacion['nombre_cen'];
        $id_centro = $evaluacion['id_centro'];  // Añadido para recoger id_centro
        $empresa = $evaluacion['nombre_emp'];
        $tipoevaluacion = $evaluacion['tipoevaluacion_tev'];
        $fecha = $evaluacion['fechacad_cev'];
        $noaplica = $evaluacion['noaplica_cev']; // Añadido para recoger noaplica_cev

        if (!isset($evaluaciones_por_centro[$centro])) {
            $evaluaciones_por_centro[$centro] = [
                'id_centro' => $id_centro,  // Añadido para almacenar id_centro
                'empresa' => $empresa,
                'evaluaciones' => []
            ];
        }

        // Almacenar la fecha y el valor de noaplica_cev en un array asociativo
        $evaluaciones_por_centro[$centro]['evaluaciones'][$tipoevaluacion] = [
            'fecha' => $fecha,
            'noaplica' => $noaplica
        ];
    }
    ?>

    <table id="example1" class="table table-striped table-bordered table-hover">
        <colgroup>
            <col width="15%">
            <col width="10%">
            <col width="10%">
            <!-- Ajusta el ancho de las columnas según sea necesario -->
            <?php foreach ($tipoevaluacion_datos as $tipo) : ?>
                <col width="5%">
            <?php endforeach; ?>
            <col width="0%">
        </colgroup>
        <thead>
            <tr>
                <th style="text-align: center">CENTRO</th>
                <th style="text-align: center">EMPRESA</th>
                <?php foreach ($tipoevaluacion_datos as $tipo) : ?>
                    <th style="text-align: center"><?php echo htmlspecialchars($tipo['tipoevaluacion_tev']); ?></th>
                <?php endforeach; ?>
                <th style="text-align: center">..</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($evaluaciones_por_centro as $centro => $datos) : ?>
                <tr>
                    <td style="text-align: center"><?php echo htmlspecialchars($centro); ?></td>
                    <td style="text-align: center"><?php echo htmlspecialchars($datos['empresa']); ?></td>
                    <?php foreach ($tipoevaluacion_datos as $tipo) : ?>
                        <td style="text-align: center">
                            <?php
                            if (isset($datos['evaluaciones'][$tipo['tipoevaluacion_tev']])) {
                                $evaluacion = $datos['evaluaciones'][$tipo['tipoevaluacion_tev']];
                                $fecha = $evaluacion['fecha'];
                                $noaplica = $evaluacion['noaplica'];

                                if ($noaplica == 'NA') {
                                    echo '<span class="resaltado-azul">NA</span>';
                                } elseif (is_null($fecha)) {
                                    echo '<span class="resaltado-azul">NA</span>';
                                } else {
                                    $fecha_date = new DateTime($fecha);
                                    $hoy = new DateTime();
                                    $interval = $hoy->diff($fecha_date);
                                    $meses_restantes = ($interval->y * 12) + $interval->m;

                                    // Definir clase de resaltado según los meses restantes
                                    $clase_resaltado = '';
                                    if ($hoy > $fecha_date) {
                                        $clase_resaltado = 'resaltado-rojo';
                                    } elseif ($meses_restantes < 6) {
                                        $clase_resaltado = 'resaltado-amarillo';
                                    }

                                    echo '<span class="' . $clase_resaltado . '">' . date("d-m-Y", strtotime($fecha)) . '</span>';
                                }
                            } else {
                                echo '';
                            }
                            ?>
                        </td>
                    <?php endforeach; ?>
                    <td style="text-align: center">
                        <div class="d-grid gap-2 d-md-block" role="group" aria-label="Basic mixed styles example">
                            <a href="../../admin/evaluacion/control_centro.php?id_centro=<?php echo $datos['id_centro']; ?>" class="btn btn-success btn-sm" title="Ver detalles"><i class="fa-solid fa-right-to-bracket"></i> Ver</a>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
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