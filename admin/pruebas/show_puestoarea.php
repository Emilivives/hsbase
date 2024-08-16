<?php
include('../../app/config.php');
include('../../admin/layout/parte1.php');
$id_puestocentro = $_GET['id_puestocentro'];
$id_evaluacion = $_GET['id_evaluacion'];

include('../../app/controllers/evaluacion/datos_evaluacion.php');
include('../../app/controllers/evaluacion/datos_puestoarea.php');
include('../../app/controllers/maestros/centros/listado_centros.php');
include('../../app/controllers/maestros/evaluacion/listado_riesgos.php');
include('../../app/controllers/maestros/evaluacion/listado_medidas.php');
include('../../app/controllers/evaluacion/listado_filaseval.php');
include('../../app/controllers/evaluacion/listado_puestoarea.php');
include('../../app/controllers/maestros/responsables/listado_responsables.php');

?>


<html>

<head>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- select2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@x.x.x/dist/select2-bootstrap4.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <style>
        .btn {
            margin-left: 5px;
            /* Espacio entre los botones */
        }

        .badge-wh-1 {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 150px;
            /* Ancho fijo */
            min-width: 1px;
            padding: 1px 1px;
            font-size: 13px;
            font-weight: bold;
            color: #000000;
            background-color: #ffffb9;
            line-height: 0;
            /* Ajuste de line-height para que no influya en la altura del span */
            white-space: nowrap;
            text-align: center;
            border-radius: 5px;
        }

        .badge-wh-2 {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 150px;
            /* Ancho fijo */
            min-width: 1px;
            padding: 1px 1px;
            font-size: 13px;
            font-weight: bold;
            color: #000000;
            background-color: #ffff00;
            line-height: 0;
            /* Ajuste de line-height para que no influya en la altura del span */
            white-space: nowrap;
            text-align: center;
            border-radius: 5px;
        }

        .badge-wh-3 {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 150px;
            /* Ancho fijo */
            padding: 0 2px;
            /* Reducción de padding horizontal para estrechar el span */
            font-size: 13px;
            font-weight: bold;
            color: #000000;
            background-color: #ff9191;
            line-height: 1;
            /* Ajuste de line-height para que no influya en la altura del span */
            white-space: nowrap;
            text-align: center;
            border-radius: 5px;
        }

        .badge-wh-4 {
            display: inline-block;
            min-width: 1px;
            padding: 1px 1px;
            font-size: 13px;
            font-weight: bold;
            color: #000000;
            width: 150px;
            /* Ancho fijo */
            background-color: #9a9a9a;
            line-height: 6;
            vertical-align: bottom;
            white-space: nowrap;
            text-align: center;
            border-radius: 5px;
        }

        .badge-wh-5 {
            display: inline-block;
            min-width: 1px;
            padding: 1px 1px;
            font-size: 13px;
            font-weight: bold;
            width: 150px;
            /* Ancho fijo */
            color: #ffffff;
            background-color: #ff0000;
            line-height: 6;
            vertical-align: bottom;
            white-space: nowrap;
            text-align: center;
            border-radius: 5px;
        }

        .badge-wh-6 {
            display: inline-block;
            min-width: 1px;
            padding: 1px 1px;
            font-size: 13px;
            font-weight: bold;
            width: 150px;
            /* Ancho fijo */
            color: #fff;
            background-color: #E1B4FC;
            line-height: 6;
            vertical-align: bottom;
            white-space: nowrap;
            text-align: center;
            border-radius: 5px;
        }
    </style>

</head>

<div class="col-lg-12">
    <div class="row">
        <div class="callout callout-info">

            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-3">
                        <dl>
                            <dt><b class="border-bottom border-primary">Evaluacion </b></dt>
                            <dd><?php echo $nombre_er ?></dd>

                        </dl>
                    </div>
                    <div class="col-md-2">
                        <dl>

                            <dt><b class="border-bottom border-primary">Centro </b></dt>
                            <dd><?php echo $nombre_cen ?></dd>
                        </dl>
                    </div>
                    <div class="col-md-2">
                        <dl>
                            <dt><b class="border-bottom border-primary">Responsable</b></dt>
                            <dd><?php echo $nombre_resp ?></dd>
                        </dl>
                    </div>
                    <div class="col-md-2">
                        <dl>
                            <dt><b class="border-bottom border-primary">Fecha</b></dt>
                            <dd><?php echo $fecha_er = date("d-m-Y", strtotime($fecha_er)) ?></dd>

                        </dl>

                    </div>
                    <div class="col-md-1">
                        <dl><!--
                            <dt><b class="border-bottom border-primary">Estado </b></dt>
                            <dd><?php $estado_ta;
                                if ($estado_ta == 'En curso') { ?>
                                    <span class='badge badge-info'>En Curso</span>
                                <?php
                                } else if ($estado_ta == 'Completado') { ?>
                                    <span class='badge badge-success'>Completado</span>
                                <?php
                                } else if ($estado_ta == 'Parcialmente hecho') { ?>
                                    <span class='badge badge-warning'>Parcialmente hecho</span>
                                <?php
                                } else if ($estado_ta == 'Pospuesto') { ?>
                                    <span class='badge badge-secondary'>Pospuesto</span>
                                <?php
                                } else if ($estado_ta == 'Cancelado') { ?>
                                    <span class='badge badge-danger'>Cancelado</span>
                                <?php
                                }
                                ?>

                            </dd>
                            <dt><b class="border-bottom border-primary">Prioridad</b></dt>
                            <dd><?php $prioridad_ta;
                                if ($prioridad_ta == 'Alta') { ?>
                                    <span class='badge badge-warning'>ALTA</span>
                                <?php
                                } else if ($prioridad_ta == 'Media') { ?>
                                    <span class='badge badge-primary'>MEDIA</span>
                                <?php
                                } else { ?>
                                    <span class='badge badge-secondary'>BAJA</span>
                                <?php
                                }
                                ?>
                            </dd>-->
                        </dl>
                    </div>
                    <div class="col-md-1">

                    </div>


                    <div class="col-md-1">
                        <div class="row">
                            <button type="button" class="btn btn-outline-warning btn-sm"><a href="updatetareas.php?id_tarea=<?php echo $id_tarea ?>&id_proyecto=<?php echo $id_proyecto1 ?>">Editar</a>
                        </div>
                        <div class="row">
                            <button type="button" class="btn btn-outline-primary btn-sm"><a href="show.php?id_proyecto=<?php echo $id_proyecto1 ?>">Volver</a>
                        </div>
                    </div>

                </div>

            </div>

        </div>


    </div>
</div>

<div class="col-lg-12">
    <div class="row">
        <div class="callout callout-info">

            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-2">
                        <dl>
                            <dt><b class="border-bottom border-primary">Descripcion</b></dt>
                            <h5><b><?php echo $puestoarea_pc ?></b></h5>
                    </div>
                    </dl>
                    <div class="col-md-5">
                        <dl>
                            <dt><b class="border-bottom border-primary">Descripcion</b></dt>
                            <dd>
                                <?php
                                // Dividir el texto en palabras
                                $palabras = explode(' ', $descripcion_pc);

                                // Obtener las primeras 5 palabras
                                $primeras_palabras = array_slice($palabras, 0, 20);

                                // Unir las palabras nuevamente en un string
                                $descripcion_corta = implode(' ', $primeras_palabras);

                                // Mostrar el texto abreviado
                                echo $descripcion_corta;
                                ?> ...
                            </dd>
                        </dl>
                    </div>
                    <div class="col-md-1">
                        <dl>
                            <dt><b class="border-bottom border-primary">EPIS </b></dt>
                            <dd></dd>
                        </dl>
                    </div>

                    <div class="col-md-2">
                        <dl>
                            <dt><b class="border-bottom border-primary">Equipos Tº</b></dt>
                            <dd></dd>



                        </dl>
                    </div>
                    <div class="col-md-1">
                        <dl>
                            <dt><b class="border-bottom border-primary">Prod. Q. </b></dt>
                            <dd></dd>
                        </dl>
                    </div> <!--boton modal modificar proyecto-->
                    <div class="col-md-1">

                        <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" title="Modificar detalles" data-target="#modal-editarevaluacion<?php echo $id_evaluacion; ?>"><i class="bi bi-pencil-square"></i>Editar</button>
                        <?php include('../../app/controllers/evaluacion/datos_evaluacion.php');
                        include('../../app/controllers/maestros/responsables/listado_responsables.php');
                        include('../../app/controllers/maestros/centros/listado_centros.php');
                        ?>


                        <a class="btn btn-text-right btn-outline-dark btn-sm" title="Ver anterior" href="../actividad/proyectos.php">Volver</a>
                        <a class="btn btn-danger btn-sm" href="../../admin/actividad/reporte_memoria.php?id_proyecto=<?php echo $id_proyecto; ?>"><i class="fa-regular fa-file-lines"></i> Imprimir report</a>

                        <!--inicio modal modificar proyecto-->
                        <div class="modal fade" id="modal-editarevaluacion<?php echo $id_evaluacion; ?>" tabindex="-1" aria-labelledby="exampleModalLabel">
                            <div class="modal-dialog modal-xl">
                                <div class="modal-content">
                                    <div class="modal-header" style="background-color:gold">
                                        <h5 class="modal-title" id="modal-editarproyecto" style="color: black;"><i class="fa-solid fa-hands-holding-circle"></i>Proyecto: <?php echo $proyecto['nombre_py'] ?></h5>
                                        <button type="button" class="close" style="color:black;" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">

                                        <form action="../../app/controllers/actividad/update_proyecto.php" method="post" enctype="multipart/form-data">


                                            <div class="row">
                                                <div class="form-group row">
                                                    <input type="text" value="<?php echo $proyecto['id_proyecto'] ?>" name="id_proyecto" class="form-control" hidden>


                                                    <div class="col-md-5">
                                                        <label for="">Nombre</label>
                                                        <input type="text" value="<?php echo $proyecto['nombre_py'] ?>" name="nombre_py" class="form-control">
                                                    </div>


                                                    <div class="col-sm-5">
                                                        <label for="" class="col-form-label col-sm-3">Responsable:</label>
                                                        <div class="col-sm-9">
                                                            <select name="responsable_py" id="" class="form-control" required>
                                                                <?php
                                                                foreach ($responsables_datos as $responsable_dato) {
                                                                    $responsable_tabla = $responsable_dato['nombre_resp'];
                                                                    $id_responsable = $responsable_dato['id_responsable']; ?>
                                                                    <option value="<?php echo $id_responsable; ?>" <?php if ($responsable_tabla == $responsable_py) { ?> selected="selected" <?php } ?> nombre_resp="<?php echo $responsable_dato['nombre_resp']; ?>">
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
                                                <div class="form-group row">
                                                    <div class="col-md-12">
                                                        <label for="">Descripción:</label>
                                                        <input type="text" value="<?php echo $proyecto['descripcion_py'] ?>" name="descripcion_py" class="form-control">
                                                    </div>



                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label for="">Fecha Inicio</label>
                                                        <input type="date" value="<?php echo $proyecto['fechainicio_py'] ?>" name="fechainicio_py" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label for="">Fecha Fin</label>
                                                        <input type="date" value="<?php echo $proyecto['fechafin_py'] ?>" name="fechafin_py" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-md-1"> </div>
                                                <div class="col-sm-2">

                                                    <label for="estado" class="col-form-label col-sm-2">Estado:</label>
                                                    <div class="col-sm-10">
                                                        <select class="form-select" name="estado_py" aria-label="Default select example">
                                                            <option value="<?php echo $estado_py ?>"><?php echo $estado_py ?></option>

                                                            <option value="0">Selecciona estado</option>

                                                            <option value="Activo">Activo</option>
                                                            <option value="Finalizado">Finalizado</option>
                                                            <option value="Cancelado">Cancelado</option>
                                                        </select>
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
                        </div>

                        <!--fin modal-->


                    </div>
                </div>

            </div>

        </div>


    </div>

</div>

<div class="row">
    <div class="col-md-12">
        <div class="card card-outline card-primary">
            <div class="card-header col-md-12">
                <?php
                $contador_riesgos = 0;
                foreach ($filaseval_datos as $filaseval_dato) {
                    $contador_riesgos++;
                } ?>
                <h3 class="card-title"><b>Riesgos y Medidas :</b> <?php echo $contador_riesgos ?></h3>
                <style>
                    .btn-text-right {
                        text-align: right;
                    }
                </style>
                <!--boton modal-->
                <div class="btn-text-right">
                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-nuevoriesgo">Nuevo Riesgo</button>
                </div>
            </div>
            <!--inicio modal nuevo trabajador-->
            <div class="modal fade" id="modal-nuevoriesgo">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header" style="background-color:whitesmoke">
                            <h5 class="modal-title" id="modal-nuevoriesgo"><i class="bi bi-plus-lg"></i> Nueva Riesgo</h5>
                            <button type="button" class="close" style="color: white;" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            <form action="../../app/controllers/evaluacion/create_filariesgo.php" method="post" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Evaluacion: <?php echo $codigo_er ?></label>
                                            <input type="text" value="<?php echo $id_evaluacion ?>" name="id_evaluacion" class="form-control" hidden>

                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Puesto: <?php echo $puestoarea_pc ?></label>
                                            <input type="text" value="<?php echo $id_puestocentro ?>" name="puestocentro_fer" class="form-control" hidden>

                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-11">
                                        <label for="riesgo">Riesgo</label>
                                        <div class="input-group">
                                            <select name="riesgo_fer" id="id_riesgo" class="id_riesgo">
                                                <option value="">Seleccione un riesgo</option>
                                                <?php
                                                foreach ($riesgos_datos as $riesgos_dato) { ?>
                                                    <option value="<?php echo $riesgos_dato['id_riesgo']; ?>">
                                                        <?php echo $riesgos_dato['codigoriesgo']; ?> - <?php echo  $riesgos_dato['fraseriesgo'];  ?>


                                                    </option>
                                                <?php
                                                }
                                                ?>
                                            </select>

                                        </div>
                                    </div>
                                </div>
                                </br>

                                <div class="row">
                                    <div class="form-group">
                                        <label for="">Descripción</label>
                                        <textarea class="form-control" name="frasefila_fer" rows="4"></textarea>
                                    </div>
                                </div>

                                <!-- Nueva sección para Probabilidad, Gravedad y Nivel de Riesgo -->
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="probabilidad_fer">Probabilidad</label>
                                            <select name="probabilidad_fer" id="probabilidad_fer" class="form-control">
                                                <option value="">Seleccione</option>
                                                <option value="Baja">Baja</option>
                                                <option value="Media">Media</option>
                                                <option value="Alta">Alta</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="gravedad_fer">Consecuencias</label>
                                            <select name="gravedad_fer" id="gravedad_fer" class="form-control">
                                                <option value="">Seleccione</option>
                                                <option value="Ligeramente Dañino">Ligeramente Dañino</option>
                                                <option value="Dañino">Dañino</option>
                                                <option value="Extremadamente Dañino">Extremadamente Dañino</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="nivelriesgo_fer">Nivel de Riesgo</label>
                                            <input type="text" id="nivelriesgo_fer" name="nivelriesgo_fer" class="form-control" readonly>
                                        </div>
                                    </div>
                                </div>



                                <div class="row">
                                    <div class="col-md-11">
                                        <label for="riesgo">Medidas</label>
                                        <div class="input-group">
                                            <select name="medida_fm[]" id="medida_fm" class="medida_fm" multiple="multiple">
                                                <option value="">Seleccione Medidas</option>
                                                <?php
                                                foreach ($medidas_datos as $medidas_dato) { ?>
                                                    <option value="<?php echo $medidas_dato['id_medida']; ?>">
                                                        <?php echo $medidas_dato['codigomedida']; ?> - <?php echo  $medidas_dato['frasemedida'];  ?>


                                                    </option>
                                                <?php
                                                }
                                                ?>
                                            </select>

                                        </div>
                                    </div>
                                </div>

                                <br>

                                <div class="modal-footer">

                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                    <button type="submit" class="btn btn-primary"><i class="bi bi-floppy"></i> Guardar</button>

                                </div>
                            </form>
                        </div>
                    </div>

                </div>

                <!--fin modal-->


            </div>
            <div class="card-body">
                <table id="example1" class="table compact hover">
                    <colgroup>
                        <col width="1%">
                        <col width="15%">
                        <col width="40%">
                        <col width="10%">
                        <col width="10%">
                        <col width="10%">
                        <col width="5%">
                    </colgroup>
                    <thead class="table-secondary">
                        <tr>
                            <th style="text-align: center">#</th>
                            <th style="text-align: left">RIESGO</th>
                            <th style="text-align: left">Descripcion</th>
                            <th style="text-align: center">Probabilidad</th>
                            <th style="text-align: center">Consecuencias</th>
                            <th style="text-align: center">Nivel Riesgo</th>
                            <th style="text-align: center">-</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $contador_riesgos = 0;
                        foreach ($filaseval_datos as $filaseval_dato) {
                            $contador_riesgos++;
                            $id_filaeval = $filaseval_dato['id_filaeval'];
                        ?>
                            <tr>
                                <td style="text-align: center; color:#ffffff; background-color: #0080c0"><?php echo $contador_riesgos ?></td>
                                <td style="text-align: left"><b><?php echo $filaseval_dato['codigoriesgo']; ?> - <?php echo $filaseval_dato['fraseriesgo']; ?></b></td>
                                <td style="text-align: left"><?php echo $filaseval_dato['frasefila_fer']; ?></td>
                                <td style="text-align: center"><?php echo $filaseval_dato['probabilidad_fer']; ?></td>
                                <td style="text-align: center"><?php echo $filaseval_dato['gravedad_fer']; ?></td>
                                <td style="text-align: center">
                                    <?php
                                    $nivelriesgo = $filaseval_dato['nivelriesgo_fer'];
                                    switch ($nivelriesgo) {
                                        case 'Riesgo Trivial':
                                            echo "<span class='badge-wh-1'><h6><b>Riesgo Trivial</b></h6></span>";
                                            break;
                                        case 'Riesgo Tolerable':
                                            echo "<span class='badge-wh-2'><h6><b>Riesgo Tolerable</b></h6></span>";
                                            break;
                                        case 'Riesgo Moderado':
                                            echo "<span class='badge-wh-3'><h6><b>Riesgo Moderado</b></h6></span>";
                                            break;
                                        case 'Riesgo Importante':
                                            echo "<span class='badge-wh-4'><h6><b>Riesgo Importante</b></h6></span>";
                                            break;
                                        case 'Riesgo Intolerable':
                                            echo "<span class='badge-wh-5'><h6><b>Riesgo Intolerable</b></h6></span>";
                                            break;
                                        default:
                                            echo "<span class='badge-wh-6'><h6><b>Desconocido</b></h6></span>";
                                            break;
                                    }
                                    ?>
                                </td>
                                </td>
                                <td style="text-align: right">
                                    <div class="dropdown">
                                        <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
                                            Opciones
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="dropdownMenuButton2">
                                            <li><a class="dropdown-item active" href="#">Ver</a></li>
                                            <li><a class="dropdown-item" href="#">Eliminar</a></li>
                                            <li>
                                                <hr class="dropdown-divider">
                                            </li>
                                            <li><a class="dropdown-item" href="#">Duplicar</a></li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            <!-- Fila para las medidas preventivas -->
                            <tr>
                                <td colspan="7" style="text-align: left; background-color: #eaeaea; border: 1px solid #ddd;">
                                    <strong style="color: #007bff;">Medidas preventivas:</strong><br>
                                    <?php foreach ($filaseval_dato['medidas'] as $medida) { ?>
                                        <div style="border-bottom: 1px solid #ccc; padding: 5px 0; display: flex; justify-content: space-between; align-items: center;">
                                            <!-- Mostrar la frasemedida -->
                                            <span><?php echo nl2br(htmlspecialchars($medida['frasemedida'], ENT_QUOTES, 'UTF-8')); ?></span>

                                            <!-- Preparar la frasemedida para JavaScript -->
                                            <?php $frasemedida_js = str_replace(array("\r", "\n"), array("\\r", "\\n"), addslashes($medida['frasemedida'])); ?>

                                            <!-- Contenedor de botones para asegurar la alineación -->
                                            <div style="display: flex; gap: 5px;">
                                                <!-- Botón para editar -->
                                                <button class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                                    data-bs-target="#editMedidaModal"
                                                    onclick="loadMedidaData(<?php echo $medida['id_medida']; ?>, '<?php echo addslashes($medida['codigomedida']); ?>', '<?php echo $frasemedida_js; ?>')">
                                                    <i class="fas fa-pencil-alt"></i> <!-- Ícono de lápiz -->
                                                </button>

                                                <!-- Botón para eliminar -->
                                                <button class="btn btn-sm btn-danger" onclick="confirmDelete(<?php echo $medida['id_medida']; ?>)">
                                                    <i class="fas fa-trash-alt"></i> <!-- Ícono de papelera -->
                                                </button>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </td>

                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                    <!-- Modal para editar la medida -->
                    <div class="modal fade" id="editMedidaModal" tabindex="-1" aria-labelledby="editMedidaModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-xl">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editMedidaModalLabel">Editar Medida</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form id="editMedidaForm">
                                        <input type="hidden" name="id_medida" id="id_medida">

                                        <div class="mb-3">
                                            <label for="codigomedida" class="form-label">Código Medida</label>
                                            <input type="text" class="form-control" id="codigomedida" name="codigomedida" required>
                                        </div>

                                        <div class="mb-3">
                                            <label for="frasemedida" class="form-label">Frase Medida</label>
                                            <textarea class="form-control" id="frasemedida" name="frasemedida" rows="10" required></textarea>
                                        </div>

                                        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                </table>
            </div>

        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('#id_riesgo').select2({
            dropdownParent: $('#modal-nuevoriesgo .modal-body'),
            theme: 'bootstrap4',
        });
    });

    $(document).ready(function() {
        $('#medida_fm').select2({
            dropdownParent: $('#modal-nuevoriesgo .modal-body'),
            theme: 'bootstrap4',
        });
    });

    document.addEventListener('DOMContentLoaded', function() {
        const probabilidad = document.getElementById('probabilidad_fer');
        const gravedad = document.getElementById('gravedad_fer');
        const nivelRiesgo = document.getElementById('nivelriesgo_fer');

        function actualizarNivelRiesgo() {
            const probabilidadValue = probabilidad.value;
            const gravedadValue = gravedad.value;

            let riesgoValue = '';
            let riesgoColor = '';

            if (probabilidadValue === 'Baja' && gravedadValue === 'Ligeramente Dañino') {
                riesgoValue = 'Riesgo Trivial';
                riesgoColor = 'yellow';
            } else if (probabilidadValue === 'Baja' && gravedadValue === 'Dañino') {
                riesgoValue = 'Riesgo Tolerable';
                riesgoColor = 'orange';
            } else if (probabilidadValue === 'Baja' && gravedadValue === 'Extremadamente Dañino') {
                riesgoValue = 'Riesgo Moderado';
                riesgoColor = 'magenta';
            } else if (probabilidadValue === 'Media' && gravedadValue === 'Ligeramente Dañino') {
                riesgoValue = 'Riesgo Tolerable';
                riesgoColor = 'orange';
            } else if (probabilidadValue === 'Media' && gravedadValue === 'Dañino') {
                riesgoValue = 'Riesgo Moderado';
                riesgoColor = 'magenta';
            } else if (probabilidadValue === 'Media' && gravedadValue === 'Extremadamente Dañino') {
                riesgoValue = 'Riesgo Importante';
                riesgoColor = 'red';
            } else if (probabilidadValue === 'Alta' && gravedadValue === 'Ligeramente Dañino') {
                riesgoValue = 'Riesgo Moderado';
                riesgoColor = 'magenta';
            } else if (probabilidadValue === 'Alta' && gravedadValue === 'Dañino') {
                riesgoValue = 'Riesgo Importante';
                riesgoColor = 'red';
            } else if (probabilidadValue === 'Alta' && gravedadValue === 'Extremadamente Dañino') {
                riesgoValue = 'Riesgo Intolerable';
                riesgoColor = 'darkgray';
            }

            nivelRiesgo.value = riesgoValue;
            nivelRiesgo.style.backgroundColor = riesgoColor;
            nivelRiesgo.style.color = (riesgoValue === 'Riesgo Importante' || riesgoValue === 'Riesgo Intolerable') ? 'white' : 'black';
        }

        probabilidad.addEventListener('change', actualizarNivelRiesgo);
        gravedad.addEventListener('change', actualizarNivelRiesgo);
    });

    function loadMedidaData(id_medida, codigomedida, frasemedida) {
        document.getElementById('id_medida').value = id_medida;
        document.getElementById('codigomedida').value = codigomedida;
        document.getElementById('frasemedida').value = frasemedida;
    }

    document.getElementById('editMedidaForm').addEventListener('submit', function(e) {
        e.preventDefault();

        const formData = new FormData(this);

        fetch('guardar_nueva_medida.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Medida actualizada correctamente');
                    location.reload(); // Recarga la página para reflejar los cambios
                } else {
                    alert('Error al actualizar la medida');
                }
            })
            .catch(error => console.error('Error:', error));
    });


    $(function() {
        $("#example1").DataTable({
            "pageLength": 15,
            "order": [
                [9, 'desc'],
                [7, "asc"]
            ],
            "language": {
                "emptyTable": "No hay información",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ Usuarios",
                "infoEmpty": "Mostrando 0 a 0 de 0 Usuarios",
                "infoFiltered": "(Filtrado de MAX total Usuarios)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_ Usuarios",
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





<?php
include('../../admin/layout/parte2.php');
include('../../admin/layout/mensaje.php');
?>